#!/bin/bash
# Security Issue Creator for dreams.build
# Run this script after authenticating with: gh auth login
# Usage: ./create-security-issues.sh

set -e

REPO="DecoderMG/dreams.build"

echo "Creating security issues for $REPO..."
echo "Ensure you are authenticated: gh auth status"
echo ""

# Issue 1: SQL Injection
gh issue create --repo "$REPO" \
  --title "[CRITICAL] SQL Injection via Direct \$_POST Concatenation in Multiple Plugins" \
  --label "security" \
  --body "$(cat <<'ISSUE_BODY'
## Security Vulnerability: SQL Injection

**Severity:** CRITICAL
**OWASP:** A03:2021 – Injection

### Description

Multiple SQL injection vulnerabilities exist where `$_POST` and `$_GET` values are directly concatenated into SQL queries without using `$wpdb->prepare()`.

### Affected Files

| File | Lines | Issue |
|------|-------|-------|
| `wp-content/plugins/ignitiondeck-crowdfunding/ignitiondeck-admin.php` | 687-727 | Direct `$_POST` in INSERT/UPDATE for PayPal API settings and payment gateway |
| `wp-content/plugins/idmsg/idmsg-admin.php` | 47-50 | Direct `$_POST` in UPDATE/INSERT for notification settings |
| `wp-content/plugins/idcommerce/idcommerce-functions.php` | 6989 | Uses deprecated `mysql_real_escape_string()` |
| `wp-content/themes/apphope/inc/_myFriends.php` | 11-14, 48-49 | Direct `$_GET` and user ID concatenation |
| `wp-content/themes/apphope/inc/notify.php` | 14 | Direct string concatenation in SELECT |

### Example (ignitiondeck-admin.php:687-699)

```php
$sql="INSERT INTO ".$wpdb->prefix."ign_adaptive_pay_settings (...) VALUES (
    '".$_POST['adaptive_email']."',
    '".$_POST['api_username']."',
    '".$_POST['api_password']."'
)";
$res = $wpdb->query( $sql );
```

### Impact

Attackers can inject arbitrary SQL to extract credentials, payment data, PII, modify records, or execute system commands.

### Remediation

Replace all raw SQL concatenation with `$wpdb->prepare()`:
```php
$sql = $wpdb->prepare(
    "INSERT INTO {$wpdb->prefix}ign_adaptive_pay_settings (...) VALUES (%s, %s, %s)",
    sanitize_text_field($_POST['adaptive_email']),
    sanitize_text_field($_POST['api_username']),
    sanitize_text_field($_POST['api_password'])
);
```

See `SECURITY_AUDIT.md` for full details.
ISSUE_BODY
)"
echo "Created: SQL Injection issue"

# Issue 2: Unsafe Deserialization
gh issue create --repo "$REPO" \
  --title "[CRITICAL] Unsafe PHP Deserialization (Object Injection) in Multiple Files" \
  --label "security" \
  --body "$(cat <<'ISSUE_BODY'
## Security Vulnerability: Unsafe PHP Deserialization

**Severity:** CRITICAL
**OWASP:** A08:2021 – Software and Data Integrity Failures

### Description

Multiple files use PHP's `unserialize()` on untrusted data from API responses, database records, and user input.

### Affected Files

| File | Lines | Data Source |
|------|-------|------------|
| `wp-content/themes/fivehundred/functions.php` | 42, 69 | Remote API response bodies |
| `wp-content/themes/apphope/inc/id-handler.php` | 39, 47 | User metadata from database |
| `wp-content/plugins/ignitiondeck-crowdfunding/ignitiondeck-admin.php` | 407-548 | User POST data serialized then stored/unserialized |
| `wp-content/themes/fivehundred/front-page-moved.php` | 9 | Remote API response |

### Most Dangerous Example (ignitiondeck-admin.php:538-548)

```php
$serializedForm = serialize($_POST['ignitiondeck_form']);
$sql_insert = "INSERT INTO ".$wpdb->prefix."ign_form(form_settings) values ('".$serializedForm."')";
// Later:
$form = unserialize($row->form_settings);
```

Combined with SQL injection, attackers can inject malicious serialized objects into the database.

### Impact

Remote Code Execution through PHP Object Injection — attackers can trigger destructive magic methods, leading to arbitrary file operations, privilege escalation, or full system compromise.

### Remediation

- Replace `unserialize()` with `json_decode()` or `maybe_unserialize()`
- If unserialize must be used (PHP 7.0+): `unserialize($data, ['allowed_classes' => false])`
- Never serialize user input — validate and store as JSON

See `SECURITY_AUDIT.md` for full details.
ISSUE_BODY
)"
echo "Created: Unsafe Deserialization issue"

# Issue 3: RCE via preg_replace /e
gh issue create --repo "$REPO" \
  --title "[CRITICAL] Remote Code Execution via Deprecated preg_replace /e Modifier" \
  --label "security" \
  --body "$(cat <<'ISSUE_BODY'
## Security Vulnerability: RCE via preg_replace /e Modifier

**Severity:** CRITICAL
**OWASP:** A03:2021 – Injection

### Description

The PayPal OAuth library uses the deprecated `/e` modifier with `preg_replace()`, which evaluates the replacement string as PHP code.

### Affected File

`wp-content/plugins/ignitiondeck-crowdfunding/paypal/lib/OAuth_Signature/OAuth.php` (Lines 132, 142)

```php
$base_string = preg_replace("/(%[A-Za-z0-9]{2})/e", "strtolower('\\0')", $base_string);
$key = preg_replace("/(%[A-Za-z0-9]{2})/e", "strtolower('\\0')", $key);
```

### Impact

- **PHP < 5.5:** Direct Remote Code Execution
- **PHP 7.0+:** Fatal error, breaking PayPal payment integration

### Remediation

```php
$base_string = preg_replace_callback("/(%[A-Za-z0-9]{2})/", function($matches) {
    return strtolower($matches[0]);
}, $base_string);
```

See `SECURITY_AUDIT.md` for full details.
ISSUE_BODY
)"
echo "Created: RCE preg_replace issue"

# Issue 4: Deprecated MySQL Functions
gh issue create --repo "$REPO" \
  --title "[CRITICAL] Deprecated mysql_* Extension Functions (Removed in PHP 7.0)" \
  --label "security" \
  --body "$(cat <<'ISSUE_BODY'
## Security Vulnerability: Deprecated MySQL Extension

**Severity:** CRITICAL
**OWASP:** A06:2021 – Vulnerable and Outdated Components

### Description

Multiple files use the `mysql_*` extension which was removed in PHP 7.0.

### Affected Files

| File | Lines | Functions Used |
|------|-------|---------------|
| `wp-content/plugins/idcommerce/idcommerce-functions.php` | 6989 | `mysql_real_escape_string()` |
| `wp-content/plugins/idmsg/idmsg.php` | 81 | `mysql_real_escape_string()` |
| `wp-content/plugins/contact-form-7-to-database-extension/CFDBQueryResultIterator.php` | 47, 59, 85, 87 | `mysql_connect()`, `mysql_query()`, `mysql_fetch_assoc()`, `mysql_free_result()` |

### Impact

- Code is completely non-functional on PHP 7.0+
- On older PHP, `mysql_real_escape_string()` provides inadequate SQL injection protection

### Remediation

Replace all `mysql_*` calls with `$wpdb` methods using prepared statements, or use PDO/MySQLi.

See `SECURITY_AUDIT.md` for full details.
ISSUE_BODY
)"
echo "Created: Deprecated MySQL issue"

# Issue 5: XSS
gh issue create --repo "$REPO" \
  --title "[HIGH] Cross-Site Scripting (XSS) via Unsanitized GET Parameters" \
  --label "security" \
  --body "$(cat <<'ISSUE_BODY'
## Security Vulnerability: Cross-Site Scripting (XSS)

**Severity:** HIGH
**OWASP:** A03:2021 – Injection

### Description

Unsanitized `$_GET` parameters are directly output into HTML without escaping.

### Affected File

`wp-content/themes/apphope/inc/custom-types.php` (Line 266)

```php
foreach ($terms as $term) {
    echo '<option value='. $term->slug, $_GET[$tax_slug] == $term->slug ? ' selected="selected"' : '','>';
}
```

### Impact

Attackers can inject malicious JavaScript via crafted URLs to steal session cookies, redirect users, or perform actions on their behalf.

### Remediation

```php
$selected_value = isset($_GET[$tax_slug]) ? sanitize_text_field($_GET[$tax_slug]) : '';
echo '<option value="'. esc_attr($term->slug) .'" '. selected($selected_value, $term->slug, false) .'>';
```

See `SECURITY_AUDIT.md` for full details.
ISSUE_BODY
)"
echo "Created: XSS issue"

# Issue 6: Missing CSRF Protection
gh issue create --repo "$REPO" \
  --title "[HIGH] Missing CSRF Protection on Admin Forms and AJAX Endpoints" \
  --label "security" \
  --body "$(cat <<'ISSUE_BODY'
## Security Vulnerability: Missing CSRF Protection

**Severity:** HIGH
**OWASP:** A01:2021 – Broken Access Control

### Description

Multiple admin forms and AJAX handlers process POST data without verifying WordPress nonces.

### Affected Files

| File | Lines | Issue |
|------|-------|-------|
| `wp-content/plugins/idmsg/idmsg-admin.php` | 28-83 | Admin settings form without nonce verification |
| `wp-content/themes/apphope/functions.php` | 337-481 | AJAX handlers without `check_ajax_referer()` |
| `wp-content/themes/apphope/inc/notify.php` | 3-40 | Registered with `wp_ajax_nopriv_*` (unauthenticated access) |

### Impact

Attackers can trick administrators into submitting forms that change email settings, payment configurations, or other sensitive options.

### Remediation

Add nonce verification to all forms and AJAX handlers:
```php
// In form: wp_nonce_field('action_name', 'nonce_field');
// In handler: wp_verify_nonce($_POST['nonce_field'], 'action_name');
// For AJAX: check_ajax_referer('action_nonce', 'security');
```

See `SECURITY_AUDIT.md` for full details.
ISSUE_BODY
)"
echo "Created: Missing CSRF issue"

# Issue 7: SSRF
gh issue create --repo "$REPO" \
  --title "[HIGH] Server-Side Request Forgery (SSRF) and IP Spoofing in conv.php" \
  --label "security" \
  --body "$(cat <<'ISSUE_BODY'
## Security Vulnerability: SSRF and IP Spoofing

**Severity:** HIGH
**OWASP:** A10:2021 – Server-Side Request Forgery

### Description

The `get_client_ip()` function in `conv.php` trusts user-supplied HTTP headers that can be spoofed. The spoofed IP is used to construct URLs for server-side `file_get_contents()` calls.

### Affected File

`wp-content/themes/apphope/inc/conv.php` (Lines 76-77, 110-167)

```php
$remote_IP_url = 'http://ip-api.com/json/' . get_client_ip();
$remote_user_data = json_decode(file_get_contents($remote_IP_url, ...));
```

Where `get_client_ip()` reads spoofable headers: `HTTP_CLIENT_IP`, `HTTP_X_FORWARDED_FOR`, etc.

### Impact

Attackers can redirect server-side requests to internal network resources, bypassing security controls.

### Remediation

Only trust `$_SERVER['REMOTE_ADDR']` and validate IPs before using in URL construction. Filter out private/reserved IP ranges.

See `SECURITY_AUDIT.md` for full details.
ISSUE_BODY
)"
echo "Created: SSRF issue"

# Issue 8: CORS Misconfiguration
gh issue create --repo "$REPO" \
  --title "[HIGH] Overly Permissive CORS Configuration (Access-Control-Allow-Origin: *)" \
  --label "security" \
  --body "$(cat <<'ISSUE_BODY'
## Security Vulnerability: CORS Misconfiguration

**Severity:** HIGH
**OWASP:** A05:2021 – Security Misconfiguration

### Description

WP Rocket configuration sets `Access-Control-Allow-Origin: *` allowing any domain to make cross-origin requests.

### Affected File

`wp-content/plugins/wp-rocket/inc/functions/htaccess.php` (Lines 513, 521)

```php
$rules .= 'Header set Access-Control-Allow-Origin "*"' . PHP_EOL;
```

### Impact

Any website can make authenticated cross-origin requests, potentially accessing sensitive data or performing actions on behalf of logged-in users.

### Remediation

Restrict to specific trusted domains:
```php
$rules .= 'Header set Access-Control-Allow-Origin "https://dreams.build"' . PHP_EOL;
```

See `SECURITY_AUDIT.md` for full details.
ISSUE_BODY
)"
echo "Created: CORS issue"

# Issue 9: Outdated Dependencies
gh issue create --repo "$REPO" \
  --title "[HIGH] Severely Outdated Dependencies with Known CVEs" \
  --label "security" \
  --body "$(cat <<'ISSUE_BODY'
## Security Vulnerability: Outdated Dependencies

**Severity:** HIGH
**OWASP:** A06:2021 – Vulnerable and Outdated Components

### Description

Multiple severely outdated libraries with known CVEs are in use.

### Affected Dependencies

| Component | Current Version | Issue |
|-----------|----------------|-------|
| AWS SDK PHP | v2.x (circa 2013) | Multiple known CVEs, EOL |
| Guzzle HTTP | ~3.7.0 (circa 2013) | Multiple CVEs, EOL |
| jQuery | 1.12.1 | CVE-2020-11022, CVE-2020-11023, CVE-2019-11358 |
| CF7-to-DB Extension | N/A | Uses deprecated mysql_* functions |

### Files

- `wp-content/plugins/idcommerce/lib/AWS/vendor/aws/aws-sdk-php/composer.json`
- `wp-content/themes/apphope/js/jquery.min.js`
- `wp-content/plugins/contact-form-7-to-database-extension/`

### Remediation

- Update AWS SDK to v3.x
- Update Guzzle to 7.x
- Update jQuery to 3.7.x+
- Replace CF7-to-DB extension with a maintained alternative

See `SECURITY_AUDIT.md` for full details.
ISSUE_BODY
)"
echo "Created: Outdated Dependencies issue"

# Issue 10: Missing Security Headers
gh issue create --repo "$REPO" \
  --title "[MEDIUM] Missing Security Headers (CSP, X-Frame-Options, HSTS)" \
  --label "security" \
  --body "$(cat <<'ISSUE_BODY'
## Security Vulnerability: Missing Security Headers

**Severity:** MEDIUM
**OWASP:** A05:2021 – Security Misconfiguration

### Description

No security headers are configured in .htaccess:

- Content-Security-Policy (prevents XSS)
- X-Frame-Options (prevents clickjacking)
- X-Content-Type-Options (prevents MIME sniffing)
- Strict-Transport-Security (forces HTTPS)
- Referrer-Policy
- Permissions-Policy

### Remediation

Add to `.htaccess`:
```apache
<IfModule mod_headers.c>
    Header always set X-Frame-Options "SAMEORIGIN"
    Header always set X-Content-Type-Options "nosniff"
    Header always set Strict-Transport-Security "max-age=31536000; includeSubDomains"
    Header always set Referrer-Policy "strict-origin-when-cross-origin"
    Header always set Permissions-Policy "camera=(), microphone=(), geolocation=()"
</IfModule>
```

See `SECURITY_AUDIT.md` for full details.
ISSUE_BODY
)"
echo "Created: Missing Security Headers issue"

# Issue 11: Insecure Sessions
gh issue create --repo "$REPO" \
  --title "[MEDIUM] Insecure Session Management (Missing Secure Cookie Flags)" \
  --label "security" \
  --body "$(cat <<'ISSUE_BODY'
## Security Vulnerability: Insecure Session Management

**Severity:** MEDIUM

### Description

Multiple calls to `session_start()` in `ignitiondeck-admin.php` (Lines 545, 637, 848, 1042, 1440) without configuring secure session parameters. No `httpOnly`, `secure`, or `SameSite` flags.

### Impact

Vulnerable to session hijacking, fixation, and cookie theft attacks.

### Remediation

```php
ini_set('session.cookie_httponly', 1);
ini_set('session.cookie_secure', 1);
ini_set('session.cookie_samesite', 'Lax');
session_start();
```

See `SECURITY_AUDIT.md` for full details.
ISSUE_BODY
)"
echo "Created: Insecure Sessions issue"

# Issue 12: Missing Rate Limiting
gh issue create --repo "$REPO" \
  --title "[MEDIUM] Missing Rate Limiting on Authentication and AJAX Endpoints" \
  --label "security" \
  --body "$(cat <<'ISSUE_BODY'
## Security Vulnerability: Missing Rate Limiting

**Severity:** MEDIUM

### Description

No rate limiting on login, registration, or public AJAX endpoints.

### Affected Files

- `wp-content/themes/apphope/inc/custom-ajax-auth.php` (ajax_login, ajax_register)
- `wp-content/themes/apphope/functions.php` (more_post_ajax, more_blog_post_ajax)
- `wp-content/themes/apphope/inc/notify.php` (notify_action)

### Impact

Enables brute-force password attacks, credential stuffing, user enumeration, and denial of service.

### Remediation

Implement rate limiting using WordPress transients or configure Wordfence (already installed) to protect these endpoints.

See `SECURITY_AUDIT.md` for full details.
ISSUE_BODY
)"
echo "Created: Missing Rate Limiting issue"

echo ""
echo "All 12 security issues created successfully!"
echo "See SECURITY_AUDIT.md for the full vulnerability report."
