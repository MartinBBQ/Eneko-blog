<?php

namespace App;

/**
 * Add <body> classes
 */
add_filter('body_class', function (array $classes) {
    /** Add page slug if it doesn't exist */
    if (is_single() || is_page() && !is_front_page()) {
        if (!in_array(basename(get_permalink()), $classes)) {
            $classes[] = basename(get_permalink());
        }
    }

    /** Add class if sidebar is active */
    if (display_sidebar()) {
        $classes[] = 'sidebar-primary';
    }

    /** Clean up class names for custom templates */
    $classes = array_map(function ($class) {
        return preg_replace(['/-blade(-php)?$/', '/^page-template-views/'], '', $class);
    }, $classes);

    return array_filter($classes);
});

/**
 * Add "… Continued" to the excerpt
 */
add_filter('excerpt_more', function () {
    return ' &hellip; <a href="' . get_permalink() . '">' . __('Continued', 'sage') . '</a>';
});

/**
 * Template Hierarchy should search for .blade.php files
 */
collect([
    'index', '404', 'archive', 'author', 'category', 'tag', 'taxonomy', 'date', 'home',
    'frontpage', 'page', 'paged', 'search', 'single', 'singular', 'attachment'
])->map(function ($type) {
    add_filter("{$type}_template_hierarchy", __NAMESPACE__.'\\filter_templates');
});

/**
 * Render page using Blade
 */
add_filter('template_include', function ($template) {
    $data = collect(get_body_class())->reduce(function ($data, $class) use ($template) {
        return apply_filters("sage/template/{$class}/data", $data, $template);
    }, []);
    if ($template) {
        echo template($template, $data);
        return get_stylesheet_directory().'/index.php';
    }
    return $template;
}, PHP_INT_MAX);

/**
 * Tell WordPress how to find the compiled path of comments.blade.php
 */
add_filter('comments_template', function ($comments_template) {
    $comments_template = str_replace(
        [get_stylesheet_directory(), get_template_directory()],
        '',
        $comments_template
    );
    return template_path(locate_template(["views/{$comments_template}", $comments_template]) ?: $comments_template);
});

add_filter('user_contactmethods', function ($fields) {
	if(!current_user_can('administrator')) {
		return;
	}
	$fields['twitter'] = 'Twitter';
	$fields['facebook'] = 'Facebook';
	$fields['group'] = 'Groupe Politique';
	$fields['tinyName'] = 'Abbréviation du nom';
	return $fields;
});


function is_owner( $user ) {
	if( !current_user_can('administrator')) {
		return;
	}
	$isChecked = !empty(get_the_author_meta( 'isOwner', $user->ID));
	?>
	<h3><?php _e('Propriété'); ?></h3>
	<table class="form-table">
		<tr>
			<th>
				<label for="isOwner"><?php _e("La page m'appartient"); ?>
				</label>
			</th>
			<td>
				<input type="checkbox" name="isOwner" <?php echo $isChecked ? 'checked' : '' ?> />
			</td>
		</tr>
	</table>

<?php }


function save_ownership_option( $user_id ) {
	if ( !current_user_can( 'edit_user', $user_id ) ) {
		return false;
	}
	update_user_meta( $user_id, 'isOwner', $_POST['isOwner'] );

}
add_action( 'show_user_profile', __NAMESPACE__.'\\is_owner' );
add_action( 'edit_user_profile', __NAMESPACE__.'\\is_owner' );
add_action( 'personal_options_update', __NAMESPACE__.'\\save_ownership_option' );
add_action( 'edit_user_profile_update', __NAMESPACE__.'\\save_ownership_option' );


function my_acf_google_map_api( $api ){

	$api['key'] = get_option('google_api_key');
	return $api;

}

add_filter('acf/fields/google_map/api', __NAMESPACE__.'\\my_acf_google_map_api');

add_filter('wp_terms_checklist_args', __NAMESPACE__.'\\htmlandcms_select_one_category');
function htmlandcms_select_one_category($args) {
    $taxonomy = $args['taxonomy'];
	if (isset($args['taxonomy']) &&  ($taxonomy == 'roles' || $taxonomy == 'types')) {
		$args['walker'] = new Walker_Category_Radios;
		$args['checked_ontop'] = false;
	}
	return $args;
}
add_filter('pre_option_default_role', function($default_role){
	$default_role = 'subscriber';
	return $default_role;
});

add_filter( 'comment_form_logged_in', function () {
    return '';
});






class Walker_Category_Radios extends \Walker {
	var $tree_type = 'category';
	var $db_fields = array ('parent' => 'parent', 'id' => 'term_id');

	function start_lvl( &$output, $depth = 0, $args = array() ) {
		$indent = str_repeat("\t", $depth);
		$output .= "$indent<ul class='children'>\n";
	}

	function end_lvl( &$output, $depth = 0, $args = array() ) {
		$indent = str_repeat("\t", $depth);
		$output .= "$indent</ul>\n";
	}

	function start_el( &$output, $category, $depth = 0, $args = [], $id = 0 ) {
		extract($args);
		if ( empty($taxonomy) )
			$taxonomy = 'category';

		if ( $taxonomy == 'category' )
			$name = 'post_category';
		else
			$name = 'tax_input['.$taxonomy.']';

		/** @var $popular_cats */
		$class = in_array( $category->term_id, $popular_cats ) ? ' class="popular-category"' : '';
		/** @var $selected_cats */
		$output .= "\n<li id='{$taxonomy}-{$category->term_id}'$class>" . '<label class="selectit"><input value="' . $category->term_id . '" type="radio" name="'.$name.'[]" id="in-'.$taxonomy.'-' . $category->term_id . '"' . checked( in_array( $category->term_id, $selected_cats ), TRUE, FALSE ) . disabled( empty( $args['disabled'] ), FALSE, FALSE ) . ' /> ' . esc_html( apply_filters('the_category', $category->name )) . '</label>';
	}

	function end_el( &$output, $category, $depth = 0, $args = array() ) {
		$output .= "</li>\n";
	}
}