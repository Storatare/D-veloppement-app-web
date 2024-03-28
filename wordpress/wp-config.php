<?php
/**
 * La configuration de base de votre installation WordPress.
 *
 * Ce fichier contient les réglages de configuration suivants : réglages MySQL,
 * préfixe de table, clés secrètes, langue utilisée, et ABSPATH.
 * Vous pouvez en savoir plus à leur sujet en allant sur
 * {@link https://fr.wordpress.org/support/article/editing-wp-config-php/ Modifier
 * wp-config.php}. C’est votre hébergeur qui doit vous donner vos
 * codes MySQL.
 *
 * Ce fichier est utilisé par le script de création de wp-config.php pendant
 * le processus d’installation. Vous n’avez pas à utiliser le site web, vous
 * pouvez simplement renommer ce fichier en "wp-config.php" et remplir les
 * valeurs.
 *
 * @link https://fr.wordpress.org/support/article/editing-wp-config-php/
 *
 * @package WordPress
 */

// ** Réglages MySQL - Votre hébergeur doit vous fournir ces informations. ** //
/** Nom de la base de données de WordPress. */
define( 'DB_NAME', 'wordpressbdd' );

/** Utilisateur de la base de données MySQL. */
define( 'DB_USER', 'root' );

/** Mot de passe de la base de données MySQL. */
define( 'DB_PASSWORD', '' );

/** Adresse de l’hébergement MySQL. */
define( 'DB_HOST', 'localhost' );

/** Jeu de caractères à utiliser par la base de données lors de la création des tables. */
define( 'DB_CHARSET', 'utf8mb4' );

/** Type de collation de la base de données.
  * N’y touchez que si vous savez ce que vous faites.
  */
define('DB_COLLATE', '');

/**#@+
 * Clés uniques d’authentification et salage.
 *
 * Remplacez les valeurs par défaut par des phrases uniques !
 * Vous pouvez générer des phrases aléatoires en utilisant
 * {@link https://api.wordpress.org/secret-key/1.1/salt/ le service de clés secrètes de WordPress.org}.
 * Vous pouvez modifier ces phrases à n’importe quel moment, afin d’invalider tous les cookies existants.
 * Cela forcera également tous les utilisateurs à se reconnecter.
 *
 * @since 2.6.0
 */
define( 'AUTH_KEY',         '?ps{TxW{{bv&:DH/Ay6bAlqMa-H0{;FJc*>8aU!Y4?8~t]Fjmyxvoc_ks8nbTO-A' );
define( 'SECURE_AUTH_KEY',  'E)U9|zBn3w]dYLGtS@:V(o^x7jOV%fG2Php,hxoU]<{{ENsnBMY?I:=o_U;iG4>H' );
define( 'LOGGED_IN_KEY',    '+{HLC`d:TxtM+*cA2:z,*`IkO?*MIi*5!Bc#pN`:35%4k%N;%GoAp>kbuNO7S:)A' );
define( 'NONCE_KEY',        '|uP>yD;_t{[ypV l$[AF62]SLF^ew(/f$Y2&#[qC:Symgm%z#)g5rrzN(tNG.B}!' );
define( 'AUTH_SALT',        '){sDI&II2>?ey5[IC[zWheF=~o(F%(Woso^w!~BTav<)x>bSCh)KPwJJS2oXS-,G' );
define( 'SECURE_AUTH_SALT', 'S8@umO=&bh/V(A-kI~*#nl`T:4$2CezN*oL}P%Bb:4ivo0xSi{lQg#Ig;Gn|=||1' );
define( 'LOGGED_IN_SALT',   'kRcQ>?zguwtgKY0tDI2pY 8<@:;!Joms+YlmE&FYqO55g#.&s=|On=yuv92&`dqK' );
define( 'NONCE_SALT',       '9i3Kt| Sn:*T8xVQ$kz>u*|[OL?BJen:bJ;ZDu$PA}pErV>KI*V)p60E$AIH9)sg' );
/**#@-*/

/**
 * Préfixe de base de données pour les tables de WordPress.
 *
 * Vous pouvez installer plusieurs WordPress sur une seule base de données
 * si vous leur donnez chacune un préfixe unique.
 * N’utilisez que des chiffres, des lettres non-accentuées, et des caractères soulignés !
 */
$table_prefix = 'wp_';

/**
 * Pour les développeurs et développeuses : le mode déboguage de WordPress.
 *
 * En passant la valeur suivante à "true", vous activez l’affichage des
 * notifications d’erreurs pendant vos essais.
 * Il est fortement recommandé que les développeurs et développeuses d’extensions et
 * de thèmes se servent de WP_DEBUG dans leur environnement de
 * développement.
 *
 * Pour plus d’information sur les autres constantes qui peuvent être utilisées
 * pour le déboguage, rendez-vous sur la documentation.
 *
 * @link https://fr.wordpress.org/support/article/debugging-in-wordpress/
 */
define('WP_DEBUG', false);

/* C’est tout, ne touchez pas à ce qui suit ! Bonne publication. */

/** Chemin absolu vers le dossier de WordPress. */
if ( !defined('ABSPATH') )
	define('ABSPATH', dirname(__FILE__) . '/');

/** Réglage des variables de WordPress et de ses fichiers inclus. */
require_once(ABSPATH . 'wp-settings.php');
