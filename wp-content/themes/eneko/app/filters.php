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