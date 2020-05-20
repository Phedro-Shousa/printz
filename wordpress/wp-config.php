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
define( 'DB_NAME', 'printz' );

/** MySQL database username */
define( 'DB_USER', 'root' );

/** MySQL database password */
define( 'DB_PASSWORD', '' );

/** MySQL hostname */
define( 'DB_HOST', 'localhost' );

/** Database Charset to use in creating database tables. */
define( 'DB_CHARSET', 'utf8mb4' );

/** The Database Collate type. Don't change this if in doubt. */
define( 'DB_COLLATE', '' );

/**#@+
 * Authentication Unique Keys and Salts.
 *
 * Change these to different unique phrases!
 * You can generate these using the {@link https://api.wordpress.org/secret-key/1.1/salt/ WordPress.org secret-key service}
 * You can change these at any point in time to invalidate all existing cookies. This will force all users to have to log in again.
 *
 * @since 2.6.0
 */
define( 'AUTH_KEY',         '4n7:+2Jx 0u?TD~O<&2#MFrdW(aI*Y792_&O1SkY4(z!9!^E|umnW}O2s_2%8D4%' );
define( 'SECURE_AUTH_KEY',  '8qKoc=J_b{*#`yIFF9>m%NT1~By<[U|)Mk*U8c)n~o~ sG6l&OOYV9l2/|uZN,dw' );
define( 'LOGGED_IN_KEY',    'v;5@%XAv/XqNf$C^@3)TmjYZ/G8?7GfsZoj(q><[p:oGv}BpOHW!,Tlx;#rlbob5' );
define( 'NONCE_KEY',        'VC8aUZ{yX:y(CIbf:VUdn~4j~3;;P9BhI#(bA?hz,t@*GwH}]hJfhE&?lkU[O);X' );
define( 'AUTH_SALT',        'w`u=/tia+6mY$mp;[C}@c:,=1`A@[Me6uOX!0s#m&X|NGJH+%:0eQ:(%.l=ChMxC' );
define( 'SECURE_AUTH_SALT', '-i`(QC0Ox;ciP. #qW{cQSX3p>30N8j+zoKc;xsoEY6/k 2fD6o^6_VJUVWste?R' );
define( 'LOGGED_IN_SALT',   'o>^ezZKbc9.c#S.Q,Jgc5[+:#FwNd9Y|Oa`_&LMBTL>iE`+>III0=VjKZV,!;&vg' );
define( 'NONCE_SALT',       'hEDEaz8]8alkMW!?:h:}UkYvD%HR^:cAFp*SL>YhpszB|ut4G)A^v8sM$SRUQ_3a' );

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
define( 'WP_DEBUG', false );

/* That's all, stop editing! Happy publishing. */

/** Absolute path to the WordPress directory. */
if ( ! defined( 'ABSPATH' ) ) {
	define( 'ABSPATH', __DIR__ . '/' );
}

/** Sets up WordPress vars and included files. */
require_once ABSPATH . 'wp-settings.php';
