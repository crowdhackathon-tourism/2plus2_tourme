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
define('DB_NAME', 'tourme');

/** MySQL database username */
//define('DB_USER', 'root');
define('DB_USER', 'tourme');

/** MySQL database password */
//define('DB_PASSWORD', '');
define('DB_PASSWORD', 't0urm3');


/** MySQL hostname */
//define('DB_HOST', 'localhost');
define('DB_HOST', '192.168.29.1');

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
define('AUTH_KEY',         'C`&gRCMIHL2A-Q9`BfLCAFq*cZ;ebBmE`Upc.+}H-ogF.!r}Gtk|6IT(`*R[&wm}');
define('SECURE_AUTH_KEY',  ',k5i/|<h$0ObcxyXT.kWg0z4ze1dI$dmE-;{pg-$e~C ]8v+&ycv&)KGaa4K=_`[');
define('LOGGED_IN_KEY',    'ly GK)xsO$lM,tIq$!|R$+?r4VI8S}47|-cRd|L7*GBZ,P|W.;17!|3C*ybH8e>0');
define('NONCE_KEY',        'B}r:!C)5}nSw/_lla1.`P@d?qa?H;otr=Q[Gxfe.%uR|^H|OCjZ}<&Y?ah=D[IJ.');
define('AUTH_SALT',        '?B)0G9d)+N/Hk}1m{+C][+z)bx5L>~e$!U/J%ut1EEwEXc]XD`7j)Iz8:SHjRQdC');
define('SECURE_AUTH_SALT', '-$#:kc9svhPuD3BDo}O{gs-Eqn+v2>i>0Hp;P1R?l~j5e6-S1DrcZHi@$>CG{DW;');
define('LOGGED_IN_SALT',   'Fgd1M@)gy8U-}Al$-gkkd.QWQ{+hj:mlMv;Ht+/c9!5kPE%sCp+G6qB~J^vqt-HX');
define('NONCE_SALT',       '(n|YPuUtkw8A)8m8E#.)8iSE$] +Vx`U!zv.X=>qdH.}FPQ%$B_|}KQ+uD`C]W_R');

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
define('WP_DEBUG', false);

/* That's all, stop editing! Happy blogging. */

/** Absolute path to the WordPress directory. */
if ( !defined('ABSPATH') )
	define('ABSPATH', dirname(__FILE__) . '/');

/** Sets up WordPress vars and included files. */
require_once(ABSPATH . 'wp-settings.php');
