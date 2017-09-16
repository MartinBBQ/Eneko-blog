<?php
/**
 * Created by PhpStorm.
 * User: Ismaël
 * Date: 16/09/2017
 * Time: 17:24
 */



// Register Custom Taxonomy
function custom_taxonomy() {

	$labels = array(
		'name'                       => _x( 'Rôle', 'Taxonomy General Name', 'text_domain' ),
		'singular_name'              => _x( 'Rôle', 'Taxonomy Singular Name', 'text_domain' ),
		'menu_name'                  => __( 'Rôles', 'text_domain' ),
		'all_items'                  => __( 'Tous les rôles', 'text_domain' ),
		'parent_item'                => __( 'Rôle parent', 'text_domain' ),
		'parent_item_colon'          => __( 'Rôle parent:', 'text_domain' ),
		'new_item_name'              => __( 'New Item Name', 'text_domain' ),
		'add_new_item'               => __( 'Ajouter un rôle', 'text_domain' ),
		'edit_item'                  => __( 'Edit Item', 'text_domain' ),
		'update_item'                => __( 'Update Item', 'text_domain' ),
		'separate_items_with_commas' => __( 'Separate items with commas', 'text_domain' ),
		'search_items'               => __( 'Search Items', 'text_domain' ),
		'add_or_remove_items'        => __( 'Add or remove items', 'text_domain' ),
		'choose_from_most_used'      => __( 'Choose from the most used items', 'text_domain' ),
		'not_found'                  => __( 'Not Found', 'text_domain' ),
	);
	$args = array(
		'labels'                     => $labels,
		'hierarchical'               => true,
		'public'                     => true,
		'show_ui'                    => true,
		'show_admin_column'          => true,
		'show_in_menu'                  => true,
		'show_in_nav_menus'          => true,
		'show_tagcloud'              => true
	);
	register_taxonomy( 'rolesp', array( 'employees' ), $args );
}


// Hook into the 'init' action
add_action( 'init', __NAMESPACE__.'\\custom_taxonomy');
