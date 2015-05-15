<?php
// ===================================================
// Load database info and local development parameters
// ===================================================
define( 'WP_LOCAL_DEV', true );
define( 'DB_NAME', 'wordpressvanilla' );
define( 'DB_USER', 'root' );
define( 'DB_PASSWORD', '' );
define( 'DB_HOST', 'localhost' ); // Probably 'localhost'

// ===================================================
// Default theme - Based on the foundation theme - a responsive starter theme
// ===================================================
define( 'WP_DEFAULT_THEME', 'twentyfourteen' );
define( 'WP_MEMORY_LIMIT', '64M' );
// ========================
// Custom Content Directory
// ========================
define( 'WP_CONTENT_DIR', '/home/yourname/sites/wordpressvanilla/code/wp-content' );
define( 'WP_CONTENT_URL', 'http://' . $_SERVER['HTTP_HOST'] . '/wp-content' );

// ================================================
// You almost certainly do not want to change these
// ================================================
define( 'DB_CHARSET', 'utf8' );
define( 'DB_COLLATE', '' );

// ==============================================================
// Salts, for security
// Grab these from: https://api.wordpress.org/secret-key/1.1/salt
// ==============================================================
define('AUTH_KEY',         'Y[>X,#7%ftM}:5VHHs~K@8gh(,V<)W>E|Nr+p`[J#tsA7,pM(7W%:hyCq&qN9 =z');
define('SECURE_AUTH_KEY',  'P[osNHy|>|Xu2/H! km+nG%(%zwuqL44kj)0v#3^S+I/4AS}0G+PN/J<zW ^KmBF');
define('LOGGED_IN_KEY',    'rO|*c{@WvlL2I+w1hFZ|NL+h|s7[>TG-V`tpI1TPW|c5|SqG68mPlQ4Q:G7@9K77');
define('NONCE_KEY',        '@!6ir>}YOw]INfjwi~:bN4%|-drE5CCy2+U~!SuHy<P-:~Gf?HS~+z|2&l)B#]6A');
define('AUTH_SALT',        '(Mbnq5|RT}4$+o{Q)eQ5R{_E<b>XX+37u5++_fcFT+x_c`_7EuKt6=Lf>IvOOuL_');
define('SECURE_AUTH_SALT', 'qNDPwr86-f8`tTY(UGr|mxqC<J(lCzeG|1Kn2cC8/qN-`Ueo=wl|L1]To{2X6%3Y');
define('LOGGED_IN_SALT',   '%x`f|iH21+tp8G+S=iKtw:O1)8T}m9|X?^NC!#Zw:~|jlRJp0}FNaB9%+`A01XbR');
define('NONCE_SALT',       'kIy~EaMk@|nw73vVW_aGT] r87~A{O-Rixyxg<+BC$zuYZg[=OF~_w~oq,dzI||/');

// ==============================================================
// Table prefix
// Change this if you have multiple installs in the same database
// ==============================================================
$table_prefix  = 'wp_';

// ================================
// Language
// Leave blank for American English
// ================================
define( 'WPLANG', '' );

// ===========
// Show errors
// ===========
ini_set( 'display_errors', 1 );
define( 'WP_DEBUG_DISPLAY', false );

// =================================================================
// Debug mode
// Debugging? Enable these. Can also enable them in local-config.php
// =================================================================
define( 'SAVEQUERIES', true );
define( 'WP_DEBUG', true );


// ===========================================================================================
// This can be used to programatically set the stage when deploying (e.g. production, staging)
// ===========================================================================================
define( 'WP_STAGE', '%%WP_STAGE%%' );
define( 'STAGING_DOMAIN', '%%WP_STAGING_DOMAIN%%' ); // Does magic in WP Stack to handle staging domain rewriting

// ===================
// Bootstrap WordPress
// ===================
if ( !defined( 'ABSPATH' ) )
    define( 'ABSPATH', '/home/yourname/sites/wordpressvanilla/code/wp/' );
require_once( ABSPATH . 'wp-settings.php' );
