<?php
/**
 * Created by PhpStorm.
 * User: Ismaël
 * Date: 16/09/2017
 * Time: 17:24
 */

function add_role_taxonomy() {

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
		'show_in_menu'               => true,
		'show_in_nav_menus'          => true,
		'show_tagcloud'              => false
	);
	register_taxonomy( 'roles', array( 'employees' ), $args );
}


// Hook into the 'init' action
add_action( 'init', __NAMESPACE__.'\\add_role_taxonomy');



// Register Custom Taxonomy
function add_type_taxonomy() {

	$labels = array(
		'name'                       => _x( 'Type', 'Taxonomy General Name', 'text_domain' ),
		'singular_name'              => _x( 'Type', 'Taxonomy Singular Name', 'text_domain' ),
		'menu_name'                  => __( 'Types', 'text_domain' ),
		'all_items'                  => __( 'Tous les types', 'text_domain' ),
		'parent_item'                => __( 'Type parent', 'text_domain' ),
		'parent_item_colon'          => __( 'Type parent:', 'text_domain' ),
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
		'show_in_menu'               => true,
		'show_in_nav_menus'          => true,
		'show_tagcloud'              => false
	);
	$taxonomyName = 'types';
	register_taxonomy( $taxonomyName, array( 'permanencies' ), $args );
	$default_terms = ['Éphémère', 'Permanente'];
	foreach($default_terms as $default_term) {
		if(!term_exists($default_term,$taxonomyName)) {
			wp_insert_term(
				$default_term, // the term
				$taxonomyName // the taxonomy
			);
		}
	}
}


// Hook into the 'init' action
add_action( 'init', __NAMESPACE__.'\\add_type_taxonomy');


