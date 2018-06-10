<?php
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
define('DB_NAME', 'japan');

/** MySQL database username */
define('DB_USER', 'root');

/** MySQL database password */
define('DB_PASSWORD', 'admin');

/** MySQL hostname */
define('DB_HOST', 'localhost');

/** Database Charset to use in creating database tables. */
define('DB_CHARSET', 'utf8mb4');

/** The Database Collate type. Don't change this if in doubt. */
define('DB_COLLATE', '');

/**#@+
 * Authentication Unique Keys and Salts.
 *
 * Change these to different unique phrases!
 * You can generate these using the {@link https://api.wordpress.org/secret-key/1.1/salt/ WordPress.org secret-key service}
 * You can change these at any point in time to invalidate all existing cookies. This will force all users to have to log in again.
 *
 * @since 2.6.0
 */
define('AUTH_KEY',         ':P@i:A^B-Ry]&n!E] n@V/^ROChY(iUU32}}s+qyHF@}Xbk2IK$#p17y,[:e348(');
define('SECURE_AUTH_KEY',  '2$t@-&y R3:FcmiF-pOt?nkTeU)?IK[$]7kD-,)4>j5?UpR?$l:KIoY_UcDV0^C/');
define('LOGGED_IN_KEY',    'U9KCo_CmE~3nhyHhD<pRW5w:S?hn6-}CpB@%AA/k,O6}|WxxKG<Q;0v/ 6X~j6Ve');
define('NONCE_KEY',        '/;x[=p9P|OR<p8y-*;Elnbvu.A{|Ku:zwJI7:}I%NBwJMPuy?AM}Wl=b}j2ou7hT');
define('AUTH_SALT',        '@DK<.(2c=$dtr8A8pq~;U;]*SKP0q.`Sl~%8UE%6fWPHb*RPU/wg@7hLv]m-(7H>');
define('SECURE_AUTH_SALT', '!_NnNei^ I;gpJn{NiD6hZ|o.=H*<(o1dj]jV^xwB.BD`,st~pmoM$CSXnVSFe&!');
define('LOGGED_IN_SALT',   'kV)yF9!|]{8d+L6ZO9n[1@qvLaCc%LkDU<6.:MhBNej^4%NqrtYYoZO s2nH=;}e');
define('NONCE_SALT',       ';nO5[r,Ub;:-s [5Refi6>xOY=UZL945G_--6T%C<Uy;W]!&VvQ<sWkjfQ5sspE,');

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
define('WP_DEBUG', true);
define('WP_DEBUG_DISPLAY', false);
define('WP_DEBUG_LOG', true);

/* That's all, stop editing! Happy blogging. */

/** Absolute path to the WordPress directory. */
if ( !defined('ABSPATH') )
	define('ABSPATH', dirname(__FILE__) . '/');

/** Sets up WordPress vars and included files. */
require_once(ABSPATH . 'wp-settings.php');
