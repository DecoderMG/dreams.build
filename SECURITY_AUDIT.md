# Security Vulnerability Audit Report

**Date:** 2026-02-14
**Platform:** dreams.build (WordPress-based Community & E-Commerce Platform)
**Scope:** Full source code review of custom themes, plugins, and configuration

---

## Summary

| Severity | Count | Categories |
|----------|-------|------------|
| CRITICAL | 4 | SQL Injection, Unsafe Deserialization, Remote Code Execution |
| HIGH | 5 | XSS, Missing CSRF, SSRF, CORS Misconfiguration, Outdated Dependencies |
| MEDIUM | 4 | Missing Security Headers, Insecure Sessions, Missing Rate Limiting, Weak Input Validation |
| LOW | 2 | User Enumeration, Console Logging |

---

## CRITICAL Vulnerabilities

### 1. SQL Injection via Direct `$_POST` Concatenation

**Files & Locations:**

- `wp-content/plugins/ignitiondeck-crowdfunding/ignitiondeck-admin.php` (Lines 687-727)
- `wp-content/plugins/idmsg/idmsg-admin.php` (Lines 47-50)
- `wp-content/plugins/idcommerce/idcommerce-functions.php` (Line 6989)
- `wp-content/themes/apphope/inc/_myFriends.php` (Lines 11-14, 48-49)
- `wp-content/themes/apphope/inc/notify.php` (Line 14)

**Description:**

Multiple locations directly concatenate `$_POST` and `$_GET` values into SQL queries without using `$wpdb->prepare()`. This is the most critical vulnerability category in the codebase.

**Example (ignitiondeck-admin.php:687-699):**
```php
$sql="INSERT INTO ".$wpdb->prefix."ign_adaptive_pay_settings (...) VALUES (
    '".$_POST['adaptive_email']."',
    '".$_POST['application_id']."',
    '".$_POST['api_username']."',
    '".$_POST['api_password']."',
    '".$_POST['api_signature']."',
    '".$_POST['fund_type']."'
)";
$res = $wpdb->query( $sql );
```

**Example (idcommerce-functions.php:6989):**
```php
$sql = 'INSERT INTO '.$wpdb->prefix.'mdid_project_levels (levels) VALUES ("'.mysql_real_escape_string(serialize($levels)).'")';
```
Uses deprecated `mysql_real_escape_string()` (removed in PHP 7.0+).

**Impact:** Attackers can inject arbitrary SQL to extract user credentials, payment data, PII, modify records, or potentially execute system commands.

**Remediation:**
```php
// Replace all raw SQL with $wpdb->prepare():
$sql = $wpdb->prepare(
    "INSERT INTO {$wpdb->prefix}ign_adaptive_pay_settings (...) VALUES (%s, %s, %s, %s, %s, %s)",
    sanitize_text_field($_POST['adaptive_email']),
    sanitize_text_field($_POST['application_id']),
    sanitize_text_field($_POST['api_username']),
    sanitize_text_field($_POST['api_password']),
    sanitize_text_field($_POST['api_signature']),
    sanitize_text_field($_POST['fund_type'])
);
```

---

### 2. Unsafe PHP Deserialization (Object Injection)

**Files & Locations:**

- `wp-content/themes/fivehundred/functions.php` (Lines 42, 69)
- `wp-content/themes/apphope/inc/id-handler.php` (Lines 39, 47)
- `wp-content/plugins/ignitiondeck-crowdfunding/ignitiondeck-admin.php` (Lines 407-420, 434, 460-461, 538-548)
- `wp-content/themes/fivehundred/front-page-moved.php` (Line 9)

**Description:**

Multiple files use PHP's `unserialize()` on untrusted data from API responses, database records, and user input. Combined with the SQL injection vulnerabilities, an attacker could inject malicious serialized objects into the database.

**Example (ignitiondeck-admin.php:538-548):**
```php
$serializedForm = serialize($_POST['ignitiondeck_form']);
$sql_insert = "INSERT INTO ".$wpdb->prefix."ign_form(form_settings) values ('".$serializedForm."')";
// Later:
$form = unserialize($row->form_settings);
```

**Example (fivehundred/functions.php:42):**
```php
$response = unserialize($raw_response['body']);
```

**Impact:** Remote Code Execution through PHP Object Injection. Attackers can craft serialized payloads that trigger destructive magic methods (`__destruct()`, `__wakeup()`), leading to arbitrary file operations, privilege escalation, or full system compromise.

**Remediation:**
```php
// Replace unserialize() with json_decode():
$data = json_decode($raw_data, true);

// For WordPress metadata, use maybe_unserialize():
$user_projects = maybe_unserialize($user_projects);

// If unserialize must be used (PHP 7.0+), restrict allowed classes:
$data = unserialize($raw_data, ['allowed_classes' => false]);
```

---

### 3. Remote Code Execution via Deprecated `preg_replace` `/e` Modifier

**File:** `wp-content/plugins/ignitiondeck-crowdfunding/paypal/lib/OAuth_Signature/OAuth.php` (Lines 132, 142)

**Description:**

The PayPal OAuth library uses the `/e` modifier with `preg_replace()`, which evaluates the replacement string as PHP code. This modifier was deprecated in PHP 5.5 and removed in PHP 7.0.

```php
$base_string = preg_replace("/(%[A-Za-z0-9]{2})/e", "strtolower('\\0')", $base_string);
$key = preg_replace("/(%[A-Za-z0-9]{2})/e", "strtolower('\\0')", $key);
```

**Impact:**
- **PHP < 5.5:** Direct Remote Code Execution if input strings are attacker-controlled
- **PHP 7.0+:** Fatal error, breaking PayPal payment integration entirely

**Remediation:**
```php
$base_string = preg_replace_callback("/(%[A-Za-z0-9]{2})/", function($matches) {
    return strtolower($matches[0]);
}, $base_string);
```

---

### 4. Deprecated MySQL Extension Functions

**Files & Locations:**

- `wp-content/plugins/idcommerce/idcommerce-functions.php` (Line 6989)
- `wp-content/plugins/idmsg/idmsg.php` (Line 81)
- `wp-content/plugins/contact-form-7-to-database-extension/CFDBQueryResultIterator.php` (Lines 47, 59, 85, 87)

**Description:**

Multiple files use the `mysql_*` extension which was removed in PHP 7.0. Functions like `mysql_real_escape_string()`, `mysql_connect()`, `mysql_query()`, and `mysql_fetch_assoc()` are non-functional on modern PHP and were always insufficient against advanced SQL injection.

**Impact:** Code is completely non-functional on PHP 7.0+. On older PHP versions, it provides inadequate SQL injection protection.

**Remediation:** Replace all `mysql_*` calls with `$wpdb` methods or PDO/MySQLi with prepared statements.

---

## HIGH Vulnerabilities

### 5. Cross-Site Scripting (XSS) via Unsanitized GET Parameters

**File:** `wp-content/themes/apphope/inc/custom-types.php` (Line 266)

**Description:**

Unsanitized `$_GET` parameters are directly output into HTML without escaping:

```php
foreach ($terms as $term) {
    echo '<option value='. $term->slug, $_GET[$tax_slug] == $term->slug ? ' selected="selected"' : '','>' . $term->name .' (' . $term->count .')</option>';
}
```

**Impact:** Attackers can inject malicious JavaScript via crafted URLs, stealing session cookies, redirecting users, or performing actions on their behalf.

**Remediation:**
```php
$selected_value = isset($_GET[$tax_slug]) ? sanitize_text_field($_GET[$tax_slug]) : '';
echo '<option value="'. esc_attr($term->slug) .'" '. selected($selected_value, $term->slug, false) .'>'. esc_html($term->name) .' ('. intval($term->count) .')</option>';
```

---

### 6. Missing CSRF Protection on Admin Forms and AJAX Endpoints

**Files & Locations:**

- `wp-content/plugins/idmsg/idmsg-admin.php` (Lines 28-83)
- `wp-content/themes/apphope/functions.php` (Lines 337-436, 450-481)
- `wp-content/themes/apphope/inc/notify.php` (Lines 3-40)

**Description:**

Multiple admin settings forms and AJAX handlers process `$_POST` data without verifying WordPress nonces (`wp_verify_nonce()` / `check_ajax_referer()`). Several AJAX handlers are registered with `wp_ajax_nopriv_*`, making them accessible to unauthenticated users.

**Example (idmsg-admin.php):**
```php
if (isset($_POST['submit'])) {
    // Direct processing without nonce verification
    $notification_email = $_POST['notification-email'];
    // ... updates database settings
}
```

**Example (functions.php:438-439):**
```php
add_action('wp_ajax_nopriv_more_post_ajax', 'more_post_ajax');
// No check_ajax_referer() in the handler
```

**Impact:** Attackers can trick authenticated administrators into submitting malicious forms that change email notification settings, payment configurations, or other sensitive options.

**Remediation:**
```php
// Add nonce to forms:
wp_nonce_field('idmsg_settings_action', 'idmsg_settings_nonce');

// Verify in handler:
if (!wp_verify_nonce($_POST['idmsg_settings_nonce'], 'idmsg_settings_action')) {
    wp_die('Security check failed');
}

// For AJAX handlers:
check_ajax_referer('my_action_nonce', 'security');
```

---

### 7. Server-Side Request Forgery (SSRF) and IP Spoofing

**File:** `wp-content/themes/apphope/inc/conv.php` (Lines 76-77, 110-167)

**Description:**

The `get_client_ip()` function trusts user-supplied HTTP headers (`HTTP_CLIENT_IP`, `HTTP_X_FORWARDED_FOR`, `HTTP_X_FORWARDED`, `HTTP_X_CLUSTER_CLIENT_IP`, `HTTP_FORWARDED_FOR`, `HTTP_FORWARDED`) which can be spoofed by attackers. This IP address is then used to construct URLs for `file_get_contents()` calls:

```php
$remote_IP_url = 'http://ip-api.com/json/' . get_client_ip();
$remote_user_data = json_decode(file_get_contents($remote_IP_url, 0, stream_context_create(...)));
```

**Impact:** Attackers can spoof their IP address and potentially redirect server-side requests to internal network resources (SSRF), bypassing network security controls.

**Remediation:**
```php
function get_client_ip() {
    // Only trust REMOTE_ADDR or configure trusted proxy headers
    return filter_var($_SERVER['REMOTE_ADDR'], FILTER_VALIDATE_IP);
}

// Validate URL before fetching:
$ip = get_client_ip();
if (filter_var($ip, FILTER_VALIDATE_IP, FILTER_FLAG_NO_PRIV_RANGE | FILTER_FLAG_NO_RES_RANGE)) {
    $remote_IP_url = 'http://ip-api.com/json/' . urlencode($ip);
}
```

---

### 8. Overly Permissive CORS Configuration

**File:** `wp-content/plugins/wp-rocket/inc/functions/htaccess.php` (Lines 513, 521)

**Description:**

The WP Rocket cache configuration sets `Access-Control-Allow-Origin: *` which allows any domain to make cross-origin requests:

```php
$rules .= 'Header set Access-Control-Allow-Origin "*" env=IS_CORS' . PHP_EOL;
$rules .= 'Header set Access-Control-Allow-Origin "*"' . PHP_EOL;
```

**Impact:** Any website can make authenticated cross-origin requests to the platform, potentially accessing sensitive data or performing actions on behalf of logged-in users.

**Remediation:** Restrict CORS to specific trusted domains:
```php
$rules .= 'Header set Access-Control-Allow-Origin "https://dreams.build"' . PHP_EOL;
```

---

### 9. Severely Outdated Dependencies with Known CVEs

**Files & Locations:**

- `wp-content/plugins/idcommerce/lib/AWS/vendor/aws/aws-sdk-php/composer.json` — AWS SDK v2.x (circa 2013-2014)
- AWS SDK requires `guzzle/guzzle: ~3.7.0` — Guzzle 3.x has multiple known CVEs
- `wp-content/themes/apphope/js/jquery.min.js` — jQuery 1.12.1 (EOL, multiple known XSS vulnerabilities)
- `wp-content/plugins/contact-form-7-to-database-extension/` — Uses deprecated `mysql_*` functions

**Impact:** Known vulnerabilities in these libraries can be exploited by attackers. Guzzle 3.x has multiple security advisories. jQuery 1.x has known XSS vulnerabilities (CVE-2020-11022, CVE-2020-11023, CVE-2019-11358).

**Remediation:**
- Update AWS SDK to v3.x
- Update Guzzle to 7.x
- Update jQuery to 3.7.x+
- Replace CF7-to-DB extension with a maintained alternative

---

## MEDIUM Vulnerabilities

### 10. Missing Security Headers

**File:** `.htaccess` (global configuration)

**Description:**

The following security headers are not configured:

| Header | Purpose | Status |
|--------|---------|--------|
| `Content-Security-Policy` | Prevents XSS, data injection | Missing |
| `X-Frame-Options` | Prevents clickjacking | Missing |
| `X-Content-Type-Options` | Prevents MIME-type sniffing | Missing |
| `Strict-Transport-Security` | Forces HTTPS connections | Missing |
| `Referrer-Policy` | Controls referrer information | Missing |
| `Permissions-Policy` | Restricts browser features | Missing |

**Remediation:** Add to `.htaccess`:
```apache
<IfModule mod_headers.c>
    Header always set X-Frame-Options "SAMEORIGIN"
    Header always set X-Content-Type-Options "nosniff"
    Header always set Strict-Transport-Security "max-age=31536000; includeSubDomains"
    Header always set Referrer-Policy "strict-origin-when-cross-origin"
    Header always set Content-Security-Policy "default-src 'self'; script-src 'self' 'unsafe-inline'; style-src 'self' 'unsafe-inline';"
    Header always set Permissions-Policy "camera=(), microphone=(), geolocation=()"
</IfModule>
```

---

### 11. Insecure Session Management

**File:** `wp-content/plugins/ignitiondeck-crowdfunding/ignitiondeck-admin.php` (Lines 545, 637, 848, 1042, 1440)

**Description:**

Multiple calls to `session_start()` without configuring secure session parameters. No explicit `httpOnly`, `secure`, or `SameSite` cookie flags are set, and no session timeout is configured.

**Impact:** Vulnerable to session hijacking, session fixation, and cookie theft attacks.

**Remediation:**
```php
ini_set('session.cookie_httponly', 1);
ini_set('session.cookie_secure', 1);
ini_set('session.cookie_samesite', 'Lax');
ini_set('session.gc_maxlifetime', 1800); // 30 minutes
session_start();
```

---

### 12. Missing Rate Limiting on Authentication and AJAX Endpoints

**Files & Locations:**

- `wp-content/themes/apphope/inc/custom-ajax-auth.php` (ajax_login, ajax_register)
- `wp-content/themes/apphope/functions.php` (more_post_ajax, more_blog_post_ajax)
- `wp-content/themes/apphope/inc/notify.php` (notify_action)

**Description:**

No rate limiting is implemented on login, registration, or public AJAX endpoints. Attackers can make unlimited requests.

**Impact:** Enables brute-force password attacks, credential stuffing, user enumeration, and denial of service.

**Remediation:** Implement rate limiting using WordPress transients or a plugin like Wordfence (already installed but may need configuration):
```php
function rate_limit_check($action, $limit = 5, $window = 300) {
    $ip = $_SERVER['REMOTE_ADDR'];
    $key = 'rate_limit_' . $action . '_' . md5($ip);
    $attempts = get_transient($key) ?: 0;
    if ($attempts >= $limit) {
        wp_die('Too many attempts. Please try again later.', 429);
    }
    set_transient($key, $attempts + 1, $window);
}
```

---

### 13. Weak Input Validation

**File:** `wp-content/plugins/ignitiondeck-crowdfunding/ignitiondeck.php` (Lines 546-573)

**Description:**

Uses `esc_attr()` (HTML attribute escaping) for data that requires type-specific validation:

```php
$email = esc_attr($_POST['email']); // Should use sanitize_email() and is_email()
$first_name = esc_attr($_POST['first_name']); // Should use sanitize_text_field()
```

**Impact:** Invalid data may pass through validation, potentially causing downstream issues.

**Remediation:**
```php
$email = sanitize_email($_POST['email']);
if (!is_email($email)) { wp_die('Invalid email'); }
$first_name = sanitize_text_field($_POST['first_name']);
```

---

## LOW Vulnerabilities

### 14. User Enumeration via Login Error Messages

**File:** `wp-content/themes/apphope/inc/custom-ajax-auth.php` (Line 46)

**Description:**

Failed login responses include the submitted username:
```php
echo json_encode(array('loggedin'=>false, 'message'=>__('Wrong username or password.').$info['user_login']));
```

**Impact:** Attackers can confirm which usernames exist in the system, facilitating targeted brute-force attacks.

**Remediation:**
```php
echo json_encode(array('loggedin'=>false, 'message'=>__('Invalid credentials.')));
```

---

### 15. Console.log Statements Exposing Data

**Files:**

- `wp-content/themes/apphope/js/anchors.js` (Line 31): `console.log(hashv);`
- `wp-content/themes/apphope/inc/mc-validate.js` (Line 121): `console.log($fields.eq(0));`

**Impact:** Variable contents and form field data exposed in browser developer console.

**Remediation:** Remove `console.log()` statements or wrap in a development mode check.

---

## Hardcoded Credentials & Configuration Exposure

### Configuration Concerns

**File:** `wp-config.php` (Lines 26-35)

Database credentials and WordPress salt keys use placeholder values. While this may be intentional for the repository, ensure:
1. Production credentials are never committed to version control
2. `.gitignore` includes `wp-config.php` if using environment-specific configs
3. Use environment variables for sensitive configuration

**File:** `wp-content/plugins/wp-rocket/min/config.php` (Line 42)

Hardcoded password in minifier configuration:
```php
$min_builderPassword = 'admin';
```

**File:** `wp-config.php` (Line 76)

Error log path exposure:
```php
ini_set('error_log', '/home/betadreams/logs/php-errors.log');
```

---

## Remediation Priority

### Immediate (Week 1)
1. Fix all SQL injection vulnerabilities using `$wpdb->prepare()`
2. Replace `preg_replace` `/e` modifier with `preg_replace_callback()`
3. Replace all `unserialize()` with `json_decode()` or `maybe_unserialize()`
4. Remove deprecated `mysql_*` function calls

### Short-Term (Week 2-3)
5. Add CSRF nonce verification to all forms and AJAX handlers
6. Fix XSS vulnerability in custom-types.php with proper escaping
7. Fix SSRF vulnerability in conv.php
8. Add security headers to `.htaccess`

### Medium-Term (Month 1-2)
9. Update all outdated dependencies (AWS SDK, Guzzle, jQuery)
10. Implement rate limiting on authentication endpoints
11. Configure secure session parameters
12. Restrict CORS to specific domains

### Ongoing
13. Fix user enumeration in login responses
14. Remove console.log statements
15. Regular security audits of custom code
16. Implement automated dependency scanning
