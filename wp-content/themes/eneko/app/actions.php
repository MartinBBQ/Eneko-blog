<?php


function wpse_edit_post_show_excerpt( $user_login, $user ) {
	$unchecked = get_user_meta( $user->ID, 'metaboxhidden_post', true );
	$key = array_search( 'postexcerpt', $unchecked );
	if ( false !== $key ) {
		array_splice( $unchecked, $key, 1 );
		update_user_meta( $user->ID, 'metaboxhidden_post', $unchecked );
	}
}
add_action( 'wp_login', 'wpse_edit_post_show_excerpt', 10, 2 );

add_action( 'user_register', 'registerToCrm', 10, 1 );

function registerToCrm( $user_id ) {

}

add_action( 'profile_update', 'updateCrm', 10, 2 );

function updateCrm( $user_id, $old_user_data ) {
	// Do something
}