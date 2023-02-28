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
 * @link https://wordpress.org/support/article/editing-wp-config-php/
 *
 * @package WordPress
 */

// ** Database settings - You can get this info from your web host ** //
/** The name of the database for WordPress */
define( 'DB_NAME', 'task' );

/** Database username */
define( 'DB_USER', 'root' );

/** Database password */
define( 'DB_PASSWORD', '' );

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
define( 'AUTH_KEY',         'Lc-ay&WDtom!p$*fqSP0!0Il!o}BqDkN_wAuRhcC+Lb_?I$qHH!agE]`9m(rJdQO' );
define( 'SECURE_AUTH_KEY',  'hx:>pZS4+STn6@O#2p{id5! JWN`#Lor;><@]^`kHILViz8; PErzmcvmvxa3J~F' );
define( 'LOGGED_IN_KEY',    '&mZ^o4]sGIv5c?[>#,Y!-i3![*J<_;`*mjmT:V~.E13.U^Dl3Do9W&pt{wCsL_%U' );
define( 'NONCE_KEY',        'Z%&!|){S)*+h? }etptT@Z1ne#0(dAj@cxp#lMb^O0=j2yP~;e3W7-Xx+?6+G]&G' );
define( 'AUTH_SALT',        'RM%EtIj9Y3zZLv46d0~o#gMushSiS.?P|YV?z}S_fssYb!^JdD7s9ZZ>(]7jK&B0' );
define( 'SECURE_AUTH_SALT', 'w7h;5@7cR^Uv/g#WE)OT]-(6P*-f%n-)XQe<,r.+Y;@?mAf[`Ghy>y&9W8h7]nCZ' );
define( 'LOGGED_IN_SALT',   '$*(^VJ(IRQ=[;%7pY^:j=8j$(n{nAXwkhAeXLT2n}k4^YBE5d<7]BD0.h$||Cr7=' );
define( 'NONCE_SALT',       'APt(ir%[0`6bkJ6_|-:&3{Yjsk}S{eZ<bSFB>:g>K7+=X&F>MeRB}ATiS#}Pk4sL' );

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
 * @link https://wordpress.org/support/article/debugging-in-wordpress/
 */
define( 'WP_DEBUG', false );

/* Add any custom values between this line and the "stop editing" line. */



/* That's all, stop editing! Happy publishing. */

/** Absolute path to the WordPress directory. */
if ( ! defined( 'ABSPATH' ) ) {
	define( 'ABSPATH', __DIR__ . '/' );
}

/** Sets up WordPress vars and included files. */
require_once ABSPATH . 'wp-settings.php';
