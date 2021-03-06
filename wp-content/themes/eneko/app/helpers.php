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

function getBottomInformations($excludeComments = false) {
	$excludeComments = (bool) $excludeComments;
	if(!$excludeComments) {
		$comments = get_comments(array(
			'post_id' => get_the_ID(),
			'status' => 'approve',
		));
		$commentsLength = count($comments);
		if($commentsLength == 0) {
			$commentsLabel = '';
		} elseif ($commentsLength == 1) {
			$commentsLabel = '1 COMMENTAIRE';
		} else {
			$commentsLabel = $commentsLength.' COMMENTAIRES';
		}
	}
	$date = get_the_date();
	if(!$excludeComments && $commentsLength > 0) {
		return $date.' • '.$commentsLabel;
	} else {
		return $date;
	}
}

function scrapeImage($text) {
	$pattern = '/src=[\'"]?([^\'" >]+)[\'" >]/';
	preg_match($pattern, $text, $link);
	$link = $link[1];
	$link = urldecode($link);
	return $link;
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
	$addressParts = explode(',',$fullAddress['address']);
	$count = count($addressParts);
	if($count > 2) {
		$index = 1;
		$pickedAddress = explode(' ',ltrim($addressParts[$index]));
		if(count($pickedAddress) >= 2 && is_integer(intval($pickedAddress[0]))) {
			unset($pickedAddress[0]);
			$addressParts[$index] = implode(' ',$pickedAddress);
		}
	} elseif ($count == 2) {
		$index = 0;
	}
	return $addressParts[$index];
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
function getNextPermanenceDate($dates = [], $isPermanent = false) {
	if(!$isPermanent) {
		if(!empty($dates) && is_array($dates)) {
			$nextDate  = getNextPermanenceRawDate($dates)[0];
			$sentence = getDateToString($nextDate);
			return $sentence;
		}
	} else {
		$days = ['Dimanche','Lundi','Mardi','Mercredi','Jeudi','Vendredi','Samedi'];
		$today = new \DateTime();
		$timestamp = $today->getTimeStamp();
		$dayIndex = idate('w', $timestamp);
		$i = 0;
		$isOpen = false;
		foreach ($dates as $date) {
			$pickedDay = reset($date['day']);
			$pickedDayIndex = array_search($pickedDay,$days);
			$morningStart = $date['morning_start_hour'] ?? '';
			$morningEnd = $date['morning_end_hour'] ?? '';
			$afternoonStart = $date['afternoon_start_hour'] ?? '';
			$afternoonEnd = $date['afternoon_end_hour'] ?? '';
			if($pickedDayIndex==$dayIndex) {
				$nextDay = [
					'day' => "Ouvert aujourd'hui",
					'hour' => $morningStart.' - '.$morningEnd.', '.$afternoonStart.' - '.$afternoonEnd
				];
				// If I got my day I return the array.
				return $nextDay;
			}
			$i++;
		}
		$nextDay = [
			'day' => 'FERMÉ',
			'hour' => ''
		];
		// If i looped over the whole array without find my day, I return this
		return $nextDay;
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

function isToday(string $day, bool $found): bool {
	if($found) {
		return false;
	}
	$days = [
		"Lundi", "Mardi", "Mercredi", "Jeudi",
		"Vendredi", "Samedi", "Dimanche"];
	$dayIndex = array_search($day, $days) + 1;
	$today = getdate()['wday'];
	return $dayIndex === $today;
}
function getPermanenceDates($dates) {
	if(empty($dates)) {
		return [];
	}
	$sortedDates = getNextPermanenceRawDate($dates);
	unset($sortedDates[0]);
	return array_map(function ($date) {
		return getDateToString($date);
	}, $sortedDates,[]);
}

function isUrlOrVideo(): array {
	$url = CFS()->get('url');
	$video = get_field('video');
	return [
		'url' => $url,
		'video' => $video
	];
}
function getArticleClasses(array $newClasses) {
	$classes = ['article'];
	$predicates = isUrlOrVideo();
	$url = $predicates['url'];
	$video = $predicates['video'];
	if($url) {
		array_push($classes, 'is-url-article');
	}
	if($video) {
		array_push($classes, 'is-video-article');
	}
	foreach ($newClasses as $key => $class) {
		if($newClasses[$key]) {
			array_push($classes, $key);
		}
	}
	return $classes;
}

function getCommentField() {
	if(is_user_logged_in()) {
		return '<textarea name="comment" maxlength="65525" required placeholder="Ajouter un commentaire..."></textarea>';
	} else {
		return '<a class="comment-field__register" href="'.wp_registration_url().'">Veuillez vous connecter pour pouvoir commenter</a>';
	}

}

function getPageTerms(string $slug): array {
	$parentTerm = get_term_by('slug', $slug, 'category');
	$termsId = get_term_children($parentTerm->term_id,'category');
	$terms = [];
	foreach($termsId as $termId) {
		$term = get_term_by('id', $termId, 'category');
		$terms[] = $term;
	}
	return $terms;
}

function postHasFilter(array $terms): bool {
	$postTerms = get_the_terms(get_post(),'category');
	foreach ($terms as $term) {
		foreach ($postTerms as $postTerm) {
			$parentId = $term->parent;
			if(!empty($parentId) && $parentId !== 0) {
				$parent = get_term_by('id', $parentId, 'category');
				if($postTerm->slug === $parent->slug) {
					return true;
				}
			}
			if($postTerm->slug === $term->slug) {
				return true;
			}
		}
	}
	return false;
}

function isPressPost(): bool {
	$postTerms = get_the_terms(get_post(),'category');
	foreach ($postTerms as $term) {
		if(strpos($term->slug, 'presse') !== false) {
			return true;
		}
	}
	return false;
}
