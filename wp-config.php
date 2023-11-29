<?php
/**
 * The base configuration for WordPress
 *
 * The wp-config.php creation script uses this file during the installation.
 * You don't have to use the web site, you can copy this file to "wp-config.php"
 * and fill in the values.
 *
 * This file contains the following configurations:
 *
 * * Database settings
 * * Secret keys
 * * Database table prefix
 * * ABSPATH
 *
 * @link https://wordpress.org/documentation/article/editing-wp-config-php/
 *
 * @package WordPress
 */

// ** Database settings - You can get this info from your web host ** //
/** The name of the database for WordPress */
define( 'DB_NAME', 'vencrfstzv' );

/** Database username */
define( 'DB_USER', 'vencrfstzv' );

/** Database password */
define( 'DB_PASSWORD', '4c24tRqcFE' );

/** Database hostname */
define( 'DB_HOST', 'localhost' );

/** Database charset to use in creating database tables. */
define( 'DB_CHARSET', 'utf8mb4' );

/** The database collate type. Don't change this if in doubt. */
define( 'DB_COLLATE', '' );

/**#@+
 * Authentication unique keys and salts.
 *
 * Change these to different unique phrases! You can generate these using
 * the {@link https://api.wordpress.org/secret-key/1.1/salt/ WordPress.org secret-key service}.
 *
 * You can change these at any point in time to invalidate all existing cookies.
 * This will force all users to have to log in again.
 *
 * @since 2.6.0
 */
define('AUTH_KEY',         'ik+t5o+}ao-L)&T~QFMDl_|I,^I_l^r||i2^~.Wrk+-gms*8nuhg0ah mhx!%Pgf');
define('SECURE_AUTH_KEY',  ' =Cf|~C@Dw(6xDcVA.F5t|z3}4>qI824Yu-]_P%V_Y=DkX|4Yy|BpeDibzFy~Rr^');
define('LOGGED_IN_KEY',    'rq;HMZydiU?UiEO(%qT8Ym$m|k}N~6F-6El|hX.O|/M3uo6AclJx{`LmqPle3J0~');
define('NONCE_KEY',        '}%H=%q>=*O%uI|xz*rGKyzCO$a6t.huk/-o;BRDx}x<9,(.&.]q[.r&d)a+U rV#');
define('AUTH_SALT',        '1w$Vy-+PFylc1t@W+O5xJ=Ww=tmGeF;#`u*<&m>^ 0.CGbLSfH5-;`E#.D:|E>_=');
define('SECURE_AUTH_SALT', 'NVj=|.z$EY{:f]-x:*=NLAk[!h#JI+|E|u/?.G<#b=Q/B`NmR@E*}lxa@B|tUo^I');
define('LOGGED_IN_SALT',   'i3EbCFj9Na6Yej4IutQ~pEwB)l*q#o}X5U0}UY~tAX1</;(Vc`wAqz4z~:yrbxJ*');
define('NONCE_SALT',       '7d/vRcyL|9@qi%+@9e|S=9a{klRfT>4j[O{&g]`l8nKMQ<~7V-=;TpjL#sQ@v+]g');

/**#@-*/

/**
 * WordPress database table prefix.
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
 * @link https://wordpress.org/documentation/article/debugging-in-wordpress/
 */
define( 'WP_DEBUG', false );

/* Add any custom values between this line and the "stop editing" line. */

define( 'WP_DEBUG_LOG', false );
define( 'WP_DEBUG_DISPLAY', false );

/* That's all, stop editing! Happy publishing. */

/** Absolute path to the WordPress directory. */
if ( ! defined( 'ABSPATH' ) ) {
	define( 'ABSPATH', __DIR__ . '/' );
}

/** Sets up WordPress vars and included files. */
require_once ABSPATH . 'wp-settings.php';
