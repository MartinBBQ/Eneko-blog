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
define('DB_NAME', 'eneko');

/** Utilisateur de la base de données MySQL. */
define('DB_USER', 'root');

/** Mot de passe de la base de données MySQL. */
define('DB_PASSWORD', 'root');

/** Adresse de l’hébergement MySQL. */
define('DB_HOST', '172.20.0.2');

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
define('AUTH_KEY',         'W i}WL0%fT<v-Q]89!aps4vF3!ECf*+ >% apOe0Kj=gPF^oI@2>4Edb{n?}SpP-');
define('SECURE_AUTH_KEY',  '<5Q4cjt89sn;=`;b_FJTmX%]?Wc3U-.98v1]E*]90F:8fsIN/_zm#;V5|~%y3KO_');
define('LOGGED_IN_KEY',    '3|ZWb7;m%zBgS):ui/x>8cB3_s&a[1N>(z(5}Txeqd>4{6.+}w{`~S0owC0VNc(g');
define('NONCE_KEY',        'VUjoN~~Bnk5~gueYxnA}XF]e};amDihI>*39e_)R.dFqI79cE67HrNSCqYYtk@nn');
define('AUTH_SALT',        '>BgfevY)uS)P.{sEPmZ(UAq$fqr0Peq0$`oD6W,wUjY<[nh#,1:DXS!BJQ`8u5g(');
define('SECURE_AUTH_SALT', 'ptNRc4`G195$zdwh%H^CvhQOPjAi{pP@z{2 bEV3_J$HO:d>6<ve65*M_jxNe~:$');
define('LOGGED_IN_SALT',   'fDL]6m>~%7L&[`n%_tpu^0{`%@FnqkX#)z_fTv]1?:E_A}<&~`CU;gPRbA[nW$o4');
define('NONCE_SALT',       '7X/d4V&WHo[rLKS}*Fa_rR=zHjitK/E+_YPHP(.-j+]GR6hN1]az=y0#</AY&,t}');
/**#@-*/

/**
 * Préfixe de base de données pour les tables de WordPress.
 *
 * Vous pouvez installer plusieurs WordPress sur une seule base de données
 * si vous leur donnez chacune un préfixe unique.
 * N’utilisez que des chiffres, des lettres non-accentuées, et des caractères soulignés !
 */
$table_prefix  = 'wp_';

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
