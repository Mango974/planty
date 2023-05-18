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
 * @link https://wordpress.org/documentation/article/editing-wp-config-php/
 *
 * @package WordPress
 */

// ** Réglages MySQL - Votre hébergeur doit vous fournir ces informations. ** //
/** Nom de la base de données de WordPress. */
define( 'DB_NAME', 'planty' );

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
 * {@link https://api.wordpress.org/secret-key/1.1/salt/ le service de clefs secrètes de WordPress.org}.
 * Vous pouvez modifier ces phrases à n’importe quel moment, afin d’invalider tous les cookies existants.
 * Cela forcera également tous les utilisateurs à se reconnecter.
 *
 * @since 2.6.0
 */
define( 'AUTH_KEY',         'SS%;MOC!nkP*;l)dyx8K@XkaQvO3}4 lOQlq*t]e8#H7,I7 BzZ;Hy5k?F|o*o2%' );
define( 'SECURE_AUTH_KEY',  '(*Xdm+O$l04[pVGB(t,S{h0=lkqKiv}8mjW`YObq,&^z57V<nQniM*)myR[{N6{P' );
define( 'LOGGED_IN_KEY',    'vvEl-pdM.=D))D>^]sI[uuD;MDsDMg-!OWuKs8nTq&(D,*^n2XRMR{<sFODHOZ7|' );
define( 'NONCE_KEY',        '3}1{yLn.ubcBB#t!Gh&Su8}eB)tart84%?*r)f@l&(H[+c3DXv 77q9SSo nL?Px' );
define( 'AUTH_SALT',        'm6IL:}5MyeZ.*r DK@|r`2?#9DFGw,DB.98p7B2>-6F{3(.5l0Bt=Rg#n3lsy24A' );
define( 'SECURE_AUTH_SALT', '9+u-M!JOW(eI;rI`~PxM6!nn49Q5`O/b`_<7w!{{y%d<m]PNW)W/czHa/VF<48z^' );
define( 'LOGGED_IN_SALT',   'ljr+/J_8&%fyC#`=Q`kR`PmX0kG[C<{2KP%SFxvu}G3%;zNyV=E$Y|(NC$#w@,mc' );
define( 'NONCE_SALT',       'wbEQBu8ony>SkA3q6^6s-B3 Xfab1#FEFi99n],$L1}ind8{Z<o-}to?&8U`Xr I' );
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
 * Il est fortemment recommandé que les développeurs d’extensions et
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
