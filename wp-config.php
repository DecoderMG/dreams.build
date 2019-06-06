<?php
define('WP_CACHE', true); // Added by WP Rocket

// Added by WP Rocket
/**
 * The base configuration for WordPress
 *
 * The wp-config.php creation script uses this file during the
 * installation. You don't have to use the web site, you can
 * copy this file to "wp-config.php" and fill in the values.
 *
 * This file contains the following configurations:
 *
 * * MySQL settings
 * * Secret keys
 * * Database table prefix
 * * ABSPATH
 *
 * @link https://codex.wordpress.org/Editing_wp-config.php
 *
 * @package WordPress
 */

// ** MySQL settings - You can get this info from your web host ** //
/** The name of the database for WordPress */
define('DB_NAME', 'YOUR_NAME_HERE');

/** MySQL database username */
define('DB_USER', 'DB_USER_NAME_HERE');

/** MySQL database password */
define('DB_PASSWORD', 'THE_LOVELY_PASSWORD_HERE');

/** MySQL hostname */
define('DB_HOST', 'LOCATION_OF_DB');

/** Database Charset to use in creating database tables. */
define('DB_CHARSET', 'utf8');

/** The Database Collate type. Don't change this if in doubt. */
define('DB_COLLATE', '');

define( 'MYCRED_DEFAULT_TYPE_KEY', 'dbPointKey' );
define( 'MYCRED_DEFAULT_LABEL', 'dbPoints' );

/**#@+
 * Authentication Unique Keys and Salts.
 *
 * Change these to different unique phrases!
 * You can generate these using the {@link https://api.wordpress.org/secret-key/1.1/salt/ WordPress.org secret-key service}
 * You can change these at any point in time to invalidate all existing cookies. This will force all users to have to log in again.
 *
 * @since 2.6.0
 */
define('AUTH_KEY',         'AUTH_KEY_STRING_VALUE_HERE');
define('SECURE_AUTH_KEY',  'SECURE_AUTH_KEY_VALUE_HERE');
define('LOGGED_IN_KEY',    'LOGGED_IN_KEY_VALUE_HERE');
define('NONCE_KEY',        'NONCE_KEY_VALUE_HERE');
define('AUTH_SALT',        'AUTH_SALT_VALUE_HERE');
define('SECURE_AUTH_SALT', 'SECURE_AUTH_SALT_VALUE_HERE');
define('LOGGED_IN_SALT',   'LOGGED_IN_SALT_VALUE_HERE');
define('NONCE_SALT',       'NONCE_SALT_VALUE_HERE');

/**
 * Other customizations.
 */
define('FS_METHOD','direct');define('FS_CHMOD_DIR',0755);define('FS_CHMOD_FILE',0644);
define('WP_TEMP_DIR',dirname(__FILE__).'/wp-content/uploads');

/**
 * Turn off automatic updates since these are managed upstream.
 */
define('AUTOMATIC_UPDATER_DISABLED', true);

ini_set('log_errors', 'On');
ini_set('error_log', '/home/betadreams/logs/php-errors.log');


/**#@-*/

/**
 * WordPress Database Table prefix.
 *
 * You can have multiple installations in one database if you give each
 * a unique prefix. Only numbers, letters, and underscores please!
 */
$table_prefix  = 'wp_';

/**
 * For developers: WordPress debugging mode.
 *
 * Change this to true to enable the display of notices during development.
 * It is strongly recommended that plugin and theme developers use WP_DEBUG
 * in their development environments.
 *
 * For information on other constants that can be used for debugging,
 * visit the Codex.
 *
 * @link https://codex.wordpress.org/Debugging_in_WordPress
 */
//define('WP_DEBUG', true);
//define( 'WP_DEBUG_LOG', true );
//define( 'SCRIPT_DEBUG', false );
//define( 'SAVEQUERIES', true );

/* That's all, stop editing! Happy blogging. */

/** Absolute path to the WordPress directory. */
if ( !defined('ABSPATH') )
	define('ABSPATH', dirname(__FILE__) . '/');

/** Sets up WordPress vars and included files. */
require_once(ABSPATH . 'wp-settings.php');
