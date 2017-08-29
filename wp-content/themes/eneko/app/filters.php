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

add_filter('user_contactmethods', function ($profile_fields) {
	// Add new fields
	$profile_fields['twitter'] = 'Twitter';
	$profile_fields['facebook'] = 'Facebook';
	$profile_fields['group'] = 'Groupe Politique';
	return $profile_fields;
});

add_action( 'show_user_profile', __NAMESPACE__.'\extra_user_profile_fields' );
add_action( 'edit_user_profile', __NAMESPACE__.'\extra_user_profile_fields' );

function extra_user_profile_fields( $user ) {
	?>
	<h3><?php _e("Couverture", "blank"); ?></h3>
	<table class="form-table">
		<tr>
			<th scope="row">Photo de couverture</th>
			<td><input type="file" name="cover" value="" />
				<?php
				$cover = get_user_meta( $user->ID, 'my_document', true );
				var_dump($cover);
				if (!empty($cover)) {
//					$cover = $cover['url'];
					echo "<img src='$cover' />";
				} else {
					echo $cover;
				}
				?>
			</td>
		</tr>
	</table>

	<?php
}

add_action( 'personal_options_update', __NAMESPACE__.'\yoursite_save_extra_user_profile_fields' );
add_action( 'edit_user_profile_update', __NAMESPACE__.'\yoursite_save_extra_user_profile_fields' );

function yoursite_save_extra_user_profile_fields( $user_id ) {
	if ( !current_user_can( 'edit_user', $user_id ) )
		return false;
	var_dump($_FILES['cover'], UPLOAD_ERR_OK);
	if( $_FILES['cover']['error'] === UPLOAD_ERR_OK ) {
		$_POST['action'] = 'wp_handle_upload';
		$upload_overrides = array( 'test_form' => false );
		$upload = wp_handle_upload( $_FILES['cover'], $upload_overrides );
		update_user_meta( $user_id, 'cover', $upload );
	}
}