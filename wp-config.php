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
define( 'DB_NAME', 'resaneh360' );

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
define( 'AUTH_KEY',         ':>C[zs:`o@67U3GViwEe[NX2qE7C!SAP?8zWI]QExz?.[p=vPxwX7XImU_%SD[9)' );
define( 'SECURE_AUTH_KEY',  'I,gfl.cKAwTda?sD&@W{0-@FPX8x=s<+LCQ0q~OA*<lT.DD)qtL*gsB2JVzo,;jg' );
define( 'LOGGED_IN_KEY',    '!K9wuJSX^w>DYBy|y8nU!P+u{?[2F,yU#4i$T,#^cxL4(!{m&AM>R-a-O%bl.#gY' );
define( 'NONCE_KEY',        'FtG5kvuwc,_rL97mFhm=B`>4D<8 ?WC}WHUsc^s~j+<ISgdg~4Zr&EOh`+-p[b#j' );
define( 'AUTH_SALT',        '4t>:78;4e;$we0&^aX{jHDNL{pY W~;a.Zml#+iW|JlRw@HjZ*-`1dQnJj+wZEcf' );
define( 'SECURE_AUTH_SALT', 'RXWry*KQE@^?-CZ,//|%yr]9nSq4^zSq^eiS^igv[&$wfcoi2D(t`@TAUahW#8T=' );
define( 'LOGGED_IN_SALT',   '@Bj/!&r3gwf4^aUD$-4wU-Qc1A7]`L7K9z%+]@F7/c)yU<;r%=`#1]>?O]!}kOLe' );
define( 'NONCE_SALT',       '2S]y=8EfXj;iFtO1#zc|zlXMH$=nh5`eq&PhvF.E^PjG=%B)ewsY-w2!3`5x{rC~' );

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
