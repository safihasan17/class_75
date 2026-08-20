<?php
/**
 * The base configuration for WordPress
 *
 * The wp-config.php creation script uses this file during the installation.
 * You don't have to use the website, you can copy this file to "wp-config.php"
 * and fill in the values.
 *
 * This file contains the following configurations:
 *
 * * Database settings
 * * Secret keys
 * * Database table prefix
 * * ABSPATH
 *
 * @link https://developer.wordpress.org/advanced-administration/wordpress/wp-config/
 *
 * @package WordPress
 */

// ** Database settings - You can get this info from your web host ** //
/** The name of the database for WordPress */
define( 'DB_NAME', 'wordpress_db' );

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
define( 'AUTH_KEY',         'c)WXT&P-TZjM!48Sgm_NA/uBL|2e ]h8/T^,2P[Adr^L?fGvqoy2u/5eK@&KJ|eA' );
define( 'SECURE_AUTH_KEY',  'sIx{Md88_C=z+o%k_Dd+R!RHp0n$^pOFley8_VT9X<&x;zV<=j0HMd/7G^|$mx O' );
define( 'LOGGED_IN_KEY',    '5A@&}6_(v7;vk+6gqI_ZG|>S^#rw.7dsGzbyp0 -o@,YI:iYe7HbA6YxwFe=_]!v' );
define( 'NONCE_KEY',        ']{#qrg0RY<{-@ feaF<g<;-!toeO1G8 fjSP^<>C-_Gu9@6HvLP3k;Lc)Eebi-1}' );
define( 'AUTH_SALT',        ')W9X2<M/%~8&EZd:@sljo4%Lm#TxD6=xmTT2>w2Dmd{VjwxwSg!JZT&8TM[z2SdH' );
define( 'SECURE_AUTH_SALT', 'Df/3_{-u^XJs}sCaI3( &p,LcWV4B2.`+<t5F[PNL47<szo!|}hh@)Yww1V=,S;P' );
define( 'LOGGED_IN_SALT',   ';x!A1S~QS ,um>4dJv~vnX$z,3N)hOZk|WrOU);aS;)><]C#53ZJUTy[cK>Lr1rc' );
define( 'NONCE_SALT',       'Eu HNm3<vfV;)`F86s5W1B=S]C{^KkW>E|}Tp@}fXP%kd?:@]kJW<GCxzo&CwLgZ' );

/**#@-*/

/**
 * WordPress database table prefix.
 *
 * You can have multiple installations in one database if you give each
 * a unique prefix. Only numbers, letters, and underscores please!
 *
 * At the installation time, database tables are created with the specified prefix.
 * Changing this value after WordPress is installed will make your site think
 * it has not been installed.
 *
 * @link https://developer.wordpress.org/advanced-administration/wordpress/wp-config/#table-prefix
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
 * @link https://developer.wordpress.org/advanced-administration/debug/debug-wordpress/
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
