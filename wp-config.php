<?php
/**
 * La configuration de base de votre installation WordPress.
 *
 * Ce fichier contient les réglages de configuration suivants : réglages MySQL,
 * préfixe de table, clés secrètes, langue utilisée, et ABSPATH.
 * Vous pouvez en savoir plus à leur sujet en allant sur
 * {@link http://codex.wordpress.org/fr:Modifier_wp-config.php Modifier
 * wp-config.php}. C’est votre hébergeur qui doit vous donner vos
 * codes MySQL.
 *
 * Ce fichier est utilisé par le script de création de wp-config.php pendant
 * le processus d’installation. Vous n’avez pas à utiliser le site web, vous
 * pouvez simplement renommer ce fichier en "wp-config.php" et remplir les
 * valeurs.
 *
 * @package WordPress
 */

// ** Réglages MySQL - Votre hébergeur doit vous fournir ces informations. ** //
/** Nom de la base de données de WordPress. */
define('DB_NAME', 'tastetauram36e1');

/** Utilisateur de la base de données MySQL. */
define('DB_USER', 'tastetauram36e1');

/** Mot de passe de la base de données MySQL. */
define('DB_PASSWORD', 'Wat7eA67');

/** Adresse de l’hébergement MySQL. */
define('DB_HOST', 'tastetauram36e1.mysql.db');

/** Jeu de caractères à utiliser par la base de données lors de la création des tables. */
define('DB_CHARSET', 'utf8mb4');

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
define('AUTH_KEY',         'UJ?Bm-8MeY0hHnV$/Se.`qb,J]{B;mj|+ekh@?Jnu<^X{IT^=zQZSDp#gtH5r,j4');
define('SECURE_AUTH_KEY',  '$!}AgcWG^b&(gz0?N^PF+dvyFE;dCY|s:mlk6C}VP=VVgGu7wF arQ[e|fAkw}57');
define('LOGGED_IN_KEY',    '1Spzvo[ZHS^6}e8,IeXIHdh}z.3F7A$}jr#`D$w1szllmAw(#rZqX=r,Zn5pWgBc');
define('NONCE_KEY',        'njWv63c2:,AHlRaB(3XkfR*DN>EeC}@MW wONm]7(P4t@X.S(:>W,,_#/8(LV{n~');
define('AUTH_SALT',        '4ILmK&d51olUrVx&u9fXp[e:*.V%(fl3[TRDbI|m}E6<jq/0Qg[Ov?_DV<R#a+4?');
define('SECURE_AUTH_SALT', '_,>!8Ne3Z!3xYLt-qZ$GPj9Zq[|ZEs+`RX*P5sNkjf>f>LC`~#Z|1G6iY%?uLNO?');
define('LOGGED_IN_SALT',   '#7p#p!m_m$U)XU%XoOSh_l<2PsSUrWc[jmF^TCGp&Cm7*v: {:nU+OG<E,k)K[]*');
define('NONCE_SALT',       'l6hF>TFJF!z:ZlRQ_Hxp<8F[ @[fK)_0cqtp,r#@8sapDD$Z+A]Yx!^kw)9EMVTS');
/**#@-*/

/**
 * Préfixe de base de données pour les tables de WordPress.
 *
 * Vous pouvez installer plusieurs WordPress sur une seule base de données
 * si vous leur donnez chacune un préfixe unique.
 * N’utilisez que des chiffres, des lettres non-accentuées, et des caractères soulignés !
 */
$table_prefix  = 'flo2d_';

/**
 * Pour les développeurs : le mode déboguage de WordPress.
 *
 * En passant la valeur suivante à "true", vous activez l’affichage des
 * notifications d’erreurs pendant vos essais.
 * Il est fortemment recommandé que les développeurs d’extensions et
 * de thèmes se servent de WP_DEBUG dans leur environnement de
 * développement.
 *
 * Pour plus d’information sur les autres constantes qui peuvent être utilisées
 * pour le déboguage, rendez-vous sur le Codex.
 *
 * @link https://codex.wordpress.org/Debugging_in_WordPress
 */
define('WP_DEBUG', false);

/* C’est tout, ne touchez pas à ce qui suit ! */

/** Chemin absolu vers le dossier de WordPress. */
if ( !defined('ABSPATH') )
	define('ABSPATH', dirname(__FILE__) . '/');

/** Réglage des variables de WordPress et de ses fichiers inclus. */
require_once(ABSPATH . 'wp-settings.php');