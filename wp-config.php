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
 * * Localized language
 * * ABSPATH
 *
 * @link https://wordpress.org/support/article/editing-wp-config-php/
 *
 * @package WordPress
 */

// ** Database settings - You can get this info from your web host ** //
/** The name of the database for WordPress */
define( 'DB_NAME', 'local' );

/** Database username */
define( 'DB_USER', 'root' );

/** Database password */
define( 'DB_PASSWORD', 'root' );

/** Database hostname */
define( 'DB_HOST', 'localhost' );

/** Database charset to use in creating database tables. */
define( 'DB_CHARSET', 'utf8' );

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
define( 'AUTH_KEY',          'FE#,,yS:0I?V1E#B5!S2#R}-I=]|zJ`#3=H.k`u-rNJc@HW=aNY$OVG.@HD|DPNZ' );
define( 'SECURE_AUTH_KEY',   'w#0pxP<%A9b`l)4`f}+5*8na?vv~NP1fT0*wGtV7-01VY5&n[ipPiP.oF^(:gNBF' );
define( 'LOGGED_IN_KEY',     '26E1W9RmnB+`,ld@{|A&xRZmO)[[RtSZ*n4q:,5{1}k2AteNoX< YtR^~-+{hO*,' );
define( 'NONCE_KEY',         'eL,7_=QE|xd6/,gnfQSa;^a_w?0h`*kwR2{9nrisol](I0m$kpsuik:1:,cTfDE?' );
define( 'AUTH_SALT',         'F7t.o#GMPne4z&lMbaJH8&>,*Z7)wE[%Id0+GOStMs1TUdAjsbb4sd7cV|j%cGet' );
define( 'SECURE_AUTH_SALT',  'rY[thG>6N2)PUE:nUE7Zu^[)J#,2v6^}haODBbMV+VMu)A^InboT?{6M?M_#&PM]' );
define( 'LOGGED_IN_SALT',    '|x%::$Lm?jjI0%wbB}Duq8VkRW}*OSj(RD48>o6CTo1f=*!4+l;51{YFa&89yH_A' );
define( 'NONCE_SALT',        'hdI+5fjq9U^y m[XbqlRzF+kw%v9#: /{xSgV@bryUaBtv(e.}b8#A&?&rq$lv#&' );
define( 'WP_CACHE_KEY_SALT', 'Ft^Uh#ajwv(dwM(j&);%ljEgLZ.t1qWeQlFKR=DTG)T4DC|nD=(o+nb_OPxT^39M' );


/**#@-*/

/**
 * WordPress database table prefix.
 *
 * You can have multiple installations in one database if you give each
 * a unique prefix. Only numbers, letters, and underscores please!
 */
$table_prefix = 'wp_';


/* Add any custom values between this line and the "stop editing" line. */



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
if ( ! defined( 'WP_DEBUG' ) ) {
	define( 'WP_DEBUG', false );
}

define( 'WP_ENVIRONMENT_TYPE', 'local' );
/* That's all, stop editing! Happy publishing. */

/** Absolute path to the WordPress directory. */
if ( ! defined( 'ABSPATH' ) ) {
	define( 'ABSPATH', __DIR__ . '/' );
}

/** Sets up WordPress vars and included files. */
require_once ABSPATH . 'wp-settings.php';
