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
 * @link https://wordpress.org/support/article/editing-wp-config-php/
 *
 * @package WordPress
 */

// ** MySQL settings - You can get this info from your web host ** //
/** The name of the database for WordPress */
define('DB_NAME', 'bdswiss');

/** MySQL database username */
define('DB_USER', 'root');

/** MySQL database password */
define('DB_PASSWORD', '');

/** MySQL hostname */
define('DB_HOST', 'localhost');

/** Database Charset to use in creating database tables. */
define('DB_CHARSET', 'utf8');

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
define('AUTH_KEY',         'o-<Z1/oO2#zJ-vTthPz.Xiq|?-Zl|/nTOIKIY):[@|-D>W`Hpx8aLEn+)rBl+z_P');
define('SECURE_AUTH_KEY',  '0!l?ILTj-zK)`1QIJ-BO$tHRC$2-hL*?(L,[oY`LGtrB/=%s[4si-S+v+~zLk1`O');
define('LOGGED_IN_KEY',    'u7*1RfZ|HVrBR9n[v4:Aiz3F=O@R$=;6+INYTVu@}}hd{ug:mEGHOHX#N4^%aLJR');
define('NONCE_KEY',        '?~cI5]y[klnNa;rfgP-e{HXSX|f6L^ C8Xe 4(U%+[JlwZ2]5f$>s`!m-1PBW7T<');
define('AUTH_SALT',        'x7?nJK0V;(W<={>v+XahZ+P30?g5Odbb_#;Q/coaA+>xP>v_=>1mrFA} ]%Psx-Z');
define('SECURE_AUTH_SALT', 'vF%8_YJiMh@{J-VUO!!C3lP}wI/O0%h!5[abgE3Z}s!LB3{CvJyx}HBv@@0%eD?B');
define('LOGGED_IN_SALT',   'zby+b+!+3g(k?Q2vT]h=FmGW^LANs83f,jM|#PT4[,KskG$iCakVQs[E=p8<-#uu');
define('NONCE_SALT',       'K_NV#,7Za1]%FojND>kL^/rTs)=0sNM>}$=8{]N>PY-*S)&ie[!r+l^NDg?)?iT/');

/**#@-*/

/**
 * WordPress Database Table prefix.
 *
 * You can have multiple installations in one database if you give each
 * a unique prefix. Only numbers, letters, and underscores please!
 */
$table_prefix = 'wp_';

/**
 * For developers: WordPress debugging mode.
 *
 * Change this to true to enable the display of notices during development.
 * It is strongly recommended that plugin and theme developers use WP_DEBUG
 * in their development environments.
 *
 * For information on other constants that can be used for debugging,
 * visit the documentation.
 *
 * @link https://wordpress.org/support/article/debugging-in-wordpress/
 */
define('WP_DEBUG', false);

/* That's all, stop editing! Happy publishing. */

/** Absolute path to the WordPress directory. */
if (!defined('ABSPATH')) {
	define('ABSPATH', __DIR__ . '/');
}

/** Sets up WordPress vars and included files. */
require_once ABSPATH . 'wp-settings.php';
