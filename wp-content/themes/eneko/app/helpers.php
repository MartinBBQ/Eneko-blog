<?php

namespace App;

use Roots\Sage\Container;

/**
 * Get the sage container.
 *
 * @param string $abstract
 * @param array  $parameters
 * @param Container $container
 * @return Container|mixed
 */
function sage($abstract = null, $parameters = [], Container $container = null)
{
	$container = $container ?: Container::getInstance();
	if (!$abstract) {
		return $container;
	}
	return $container->bound($abstract)
		? $container->makeWith($abstract, $parameters)
		: $container->makeWith("sage.{$abstract}", $parameters);
}

/**
 * Get / set the specified configuration value.
 *
 * If an array is passed as the key, we will assume you want to set an array of values.
 *
 * @param array|string $key
 * @param mixed $default
 * @return mixed|\Roots\Sage\Config
 * @copyright Taylor Otwell
 * @link https://github.com/laravel/framework/blob/c0970285/src/Illuminate/Foundation/helpers.php#L254-L265
 */
function config($key = null, $default = null)
{
	if (is_null($key)) {
		return sage('config');
	}
	if (is_array($key)) {
		return sage('config')->set($key);
	}
	return sage('config')->get($key, $default);
}

/**
 * @param string $file
 * @param array $data
 * @return string
 */
function template($file, $data = [])
{
	if (remove_action('wp_head', 'wp_enqueue_scripts', 1)) {
		wp_enqueue_scripts();
	}

	return sage('blade')->render($file, $data);
}

/**
 * Retrieve path to a compiled blade view
 * @param $file
 * @param array $data
 * @return string
 */
function template_path($file, $data = [])
{
	return sage('blade')->compiledPath($file, $data);
}

/**
 * @param $asset
 * @return string
 */
function asset_path($asset)
{
	return sage('assets')->getUri($asset);
}

/**
 * @param string|string[] $templates Possible template files
 * @return array
 */
function filter_templates($templates)
{
	$paths = apply_filters('sage/filter_templates/paths', [
		'views',
		'resources/views'
	]);
	$paths_pattern = "#^(" . implode('|', $paths) . ")/#";

	return collect($templates)
		->map(function ($template) use ($paths_pattern) {
			/** Remove .blade.php/.blade/.php from template names */
			$template = preg_replace('#\.(blade\.?)?(php)?$#', '', ltrim($template));

			/** Remove partial $paths from the beginning of template names */
			if (strpos($template, '/')) {
				$template = preg_replace($paths_pattern, '', $template);
			}

			return $template;
		})
		->flatMap(function ($template) use ($paths) {
			return collect($paths)
				->flatMap(function ($path) use ($template) {
					return [
						"{$path}/{$template}.blade.php",
						"{$path}/{$template}.php",
						"{$template}.blade.php",
						"{$template}.php",
					];
				});
		})
		->filter()
		->unique()
		->all();
}

/**
 * @param string|string[] $templates Relative path to possible template files
 * @return string Location of the template
 */
function locate_template($templates)
{
	return \locate_template(filter_templates($templates));
}

/**
 * Determine whether to show the sidebar
 * @return bool
 */
function display_sidebar()
{
	static $display;
	isset($display) || $display = apply_filters('sage/display_sidebar', false);
	return $display;
}

function getCustomQuery($args){
	//Fix homepage pagination
	if ( get_query_var('paged') ) {
		$paged = get_query_var('paged');
	} else if ( get_query_var('page') ) {
		$paged = get_query_var('page');
	} else {
		$paged = 1;
	}
	$args['paged'] = $paged;
	$query = new \WP_Query($args);
	return $query;
}

function getHomeCover() {
	$homeId = get_option('page_on_front');
	$homePost = get_post($homeId);
	$thumb = wp_get_attachment_image_src( get_post_thumbnail_id($homePost->ID), 'full');
	return $thumb[0];
}

function getArticleNameAndDate() {
	$fullName = get_the_author_meta('first_name').' '.get_the_author_meta('last_name');
	$date = get_the_date('d M Y');
	if(!empty($fullName)) {
		return $fullName.' - '.$date;
	} else {
		return $date;
	}
}

function getOwnerId() {
	$admins = get_users([
		'roles' => 'administrator'
	]);
	foreach($admins as $admin) {
		$adminId = $admin->data->ID;
		$isOwner = get_the_author_meta('isOwner', $adminId);
		if($isOwner) {
			return $adminId;
		}
	}
}

function getPermanenceAddress(array $fullAddress) {
	return explode(',',$fullAddress['address'])[0];
}

function getPermanenceLocation(array $fullAddress) {
	return explode(',',$fullAddress['address'])[1];
}

function date_fr($format,$date) {
	$date_en = date($format,$date);
	$text_en = array(
		"Monday", "Tuesday", "Wednesday", "Thursday",
		"Friday", "Saturday", "Sunday", "January",
		"February", "March", "April", "May",
		"June", "July", "August", "September",
		"October", "November", "December"
	);
	$text_fr = array(
		"Lundi", "Mardi", "Mercredi", "Jeudi",
		"Vendredi", "Samedi", "Dimanche", "Janvier",
		"F&eacute;vrier", "Mars", "Avril", "Mai",
		"Juin", "Juillet", "Ao&ucirc;t", "Septembre",
		"Octobre", "Novembre", "D&eacute;cembre"
	);
	$date_fr = str_replace($text_en, $text_fr, $date_en);

	$text_en = array(
		"Mon", "Tue", "Wed", "Thu", "Fri", "Sat", "Sun",
		"Jan", "Feb", "Mar", "Apr", "May", "Jun", "Jul",
		"Aug", "Sep", "Oct", "Nov", "Dec"
	);
	$text_fr = array(
		"Lun", "Mar", "Mer", "Jeu", "Ven", "Sam", "Dim",
		"Jan", "F&eacute;v", "Mar", "Avr", "Mai", "Jui",
		"Jui", "Ao&ucirc;", "Sep", "Oct", "Nov", "D&eacute;c"
	);
	$date_fr = str_replace($text_en, $text_fr, $date_fr);

	return $date_fr;
}

function getNextPermanenceRawDate(array $dates) {
	usort($dates, function ($a,$b) {
		return strtotime($a['day']) - strtotime($b['day']);
	});
	return $dates;
}
function getNextPermanenceDate(array $dates) {
	if(is_array($dates)) {
		$nextDate  = getNextPermanenceRawDate($dates)[0];
		$sentence = getDateToString($nextDate);
		return $sentence;
	}
}

function getDateToString($date) {
	$dayFr = date_fr('l j F',strtotime($date['day']));
	$startHour = $date['starting_hour'];
	$endHour = $date['ending_hour'];
	$sentence = [
		'day' => $dayFr,
		'hour' => $startHour.' - '.$endHour
	];
	return $sentence;
}
function getPermanenceDates(array $dates) {
	$sortedDates = getNextPermanenceRawDate($dates);
	unset($sortedDates[0]);
	return array_map(function ($date) {
		return getDateToString($date);
	}, $sortedDates,[]);
}

function getArticleClasses() {
	$classes = ['article'];
	$url = CFS()->get('url');
	if($url) {
		array_push($classes, 'is-url-article');
	}
	return $classes;
}