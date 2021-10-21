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
define( 'DB_NAME', 'samyonacom_wp410' );

/** MySQL database username */
define( 'DB_USER', 'samyonacom_wp410' );

/** MySQL database password */
define( 'DB_PASSWORD', '0D4-pJ!98S' );

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
define( 'AUTH_KEY',         'kwbkagtzmqvbesjuybl7bf8gz3ydlzepy5hiikuj10tm0gixhre1nmqtigyq16lw' );
define( 'SECURE_AUTH_KEY',  'x49x1ikd1up7ub1p8dw5ffo6igegshlgbifgufnfpkjbdz4uqfnmyflsalleycat' );
define( 'LOGGED_IN_KEY',    'tlhppett5iftm4nqisz01ekhdpmep3cvl1ndnjv6z9o3mdswvvwclpgkc0vqtbxa' );
define( 'NONCE_KEY',        '5wv9zmwnqqnfxl9kxn40zgbjlsjfxeela9gp0k2akwcdvhi23n11nbxpmtclcjv5' );
define( 'AUTH_SALT',        'uiq7facdoiptbhp1rgggmqjuolla3epnvatvssoftha7mzjysdmhazt8z4iny7vx' );
define( 'SECURE_AUTH_SALT', '0awyhbswlqckhkb41lk7hadurroyqrqv4uiyyuzeg8bxjbtxfnduiqkbh6khote0' );
define( 'LOGGED_IN_SALT',   'pvrhtyandus0ehgx6qu5dn1dgoi2ihsospdc8sad301bvqwn5j0rxsqbelkjvqua' );
define( 'NONCE_SALT',       'dieig2xod9ky4clsy8hufyu9kmixppwlizsk4leaaphx8ejub1cz8dikgh7ushoz' );

/**#@-*/

/**
 * WordPress Database Table prefix.
 *
 * You can have multiple installations in one database if you give each
 * a unique prefix. Only numbers, letters, and underscores please!
 */
$table_prefix = 'wplv_';

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

define( 'WP_CACHE', true ); // Added by Hummingbird
/* That's all, stop editing! Happy publishing. */

/** Absolute path to the WordPress directory. */
if ( ! defined( 'ABSPATH' ) ) {
	define( 'ABSPATH', __DIR__ . '/' );
}

/** Sets up WordPress vars and included files. */
require_once ABSPATH . 'wp-settings.php';
