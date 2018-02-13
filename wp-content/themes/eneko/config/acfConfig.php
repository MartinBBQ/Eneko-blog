<?php
/**
 * Created by PhpStorm.
 * User: Ismaël
 * Date: 06/11/2017
 * Time: 23:43
 */

if(function_exists("register_field_group"))
{
	register_field_group(array (
		'id' => 'acf_agenda',
		'title' => 'Agenda',
		'fields' => array (
			array (
				'key' => 'field_59aaad43dc9aa',
				'label' => 'Lieu',
				'name' => 'place',
				'type' => 'google_map',
				'center_lat' => '',
				'center_lng' => '',
				'zoom' => '',
				'height' => '',
			),
		),
		'location' => array (
			array (
				array (
					'param' => 'post_type',
					'operator' => '==',
					'value' => 'agenda',
					'order_no' => 0,
					'group_no' => 0,
				),
			),
		),
		'options' => array (
			'position' => 'normal',
			'layout' => 'no_box',
			'hide_on_screen' => array (
			),
		),
		'menu_order' => 0,
	));
	register_field_group(array (
		'id' => 'acf_articles',
		'title' => 'Articles',
		'fields' => array (
			array (
				'key' => 'field_59eb93ac87d75',
				'label' => 'Vidéo',
				'name' => 'video',
				'type' => 'text',
				'instructions' => 'Url d\'un lien de vidéo embarquée. (exemple : https://www.youtube.com/embed/tOqKeAjX-KE) ',
				'default_value' => '',
				'placeholder' => '',
				'prepend' => '',
				'append' => '',
				'formatting' => 'html',
				'maxlength' => '',
			),
		),
		'location' => array (
			array (
				array (
					'param' => 'post_type',
					'operator' => '==',
					'value' => 'post',
					'order_no' => 0,
					'group_no' => 0,
				),
			),
		),
		'options' => array (
			'position' => 'normal',
			'layout' => 'no_box',
			'hide_on_screen' => array (
			),
		),
		'menu_order' => 0,
	));
	register_field_group(array (
		'id' => 'acf_employe',
		'title' => 'Employé',
		'fields' => array (
			array (
				'key' => 'field_59b460b491c09',
				'label' => 'Nom ',
				'name' => 'name',
				'type' => 'text',
				'instructions' => 'Le nom de la personne',
				'required' => 1,
				'default_value' => '',
				'placeholder' => '',
				'prepend' => '',
				'append' => '',
				'formatting' => 'html',
				'maxlength' => '',
			),
			array (
				'key' => 'field_59b4618191c0b',
				'label' => 'Description',
				'name' => 'description',
				'type' => 'textarea',
				'instructions' => 'Description de la personne ',
				'default_value' => '',
				'placeholder' => '',
				'maxlength' => '',
				'rows' => '',
				'formatting' => 'br',
			),
			array (
				'key' => 'field_59b461c291c0c',
				'label' => 'Téléphone',
				'name' => 'phone',
				'type' => 'text',
				'default_value' => '',
				'placeholder' => '',
				'prepend' => '',
				'append' => '',
				'formatting' => 'html',
				'maxlength' => '',
			),
			array (
				'key' => 'field_59b461d891c0d',
				'label' => 'Mail',
				'name' => 'mail',
				'type' => 'email',
				'default_value' => '',
				'placeholder' => '',
				'prepend' => '',
				'append' => '',
			),
			array (
				'key' => 'field_59b461e991c0e',
				'label' => 'Présent dans la sidebar',
				'name' => 'isOnSidebar',
				'type' => 'true_false',
				'instructions' => 'Est ce que la personne est présente dans la sidebar du site ?',
				'message' => '',
				'default_value' => 0,
			),
			array (
				'key' => 'field_59b4625c91c0f',
				'label' => 'Présent sur la page à propos ',
				'name' => 'isOnAbout',
				'type' => 'true_false',
				'message' => '',
				'default_value' => 0,
			),
		),
		'location' => array (
			array (
				array (
					'param' => 'post_type',
					'operator' => '==',
					'value' => 'employees',
					'order_no' => 0,
					'group_no' => 0,
				),
			),
		),
		'options' => array (
			'position' => 'normal',
			'layout' => 'no_box',
			'hide_on_screen' => array (
			),
		),
		'menu_order' => 0,
	));
	register_field_group(array (
		'id' => 'acf_permanences',
		'title' => 'Permanences',
		'fields' => array (
			array (
				'key' => 'field_59a815fbc7c69',
				'label' => 'Code postal',
				'name' => 'city_ref',
				'type' => 'number',
				'instructions' => 'Le code postal de la ville ou a lieu la permanence.',
				'default_value' => '',
				'placeholder' => '',
				'prepend' => '',
				'append' => '',
				'min' => '',
				'max' => '',
				'step' => '',
			),
			array (
				'key' => 'field_59a75239fd24f',
				'label' => 'Adresse',
				'name' => 'fulladdress',
				'type' => 'google_map',
				'center_lat' => '',
				'center_lng' => '',
				'zoom' => '',
				'height' => '',
			),
			array (
				'key' => 'field_59da2c46b919e',
				'label' => 'Téléphone',
				'name' => 'phone',
				'type' => 'text',
				'default_value' => '',
				'placeholder' => '',
				'prepend' => '',
				'append' => '',
				'formatting' => 'html',
				'maxlength' => '',
			),
		),
		'location' => array (
			array (
				array (
					'param' => 'post_type',
					'operator' => '==',
					'value' => 'permanencies',
					'order_no' => 0,
					'group_no' => 0,
				),
			),
		),
		'options' => array (
			'position' => 'normal',
			'layout' => 'default',
			'hide_on_screen' => array (
			),
		),
		'menu_order' => 0,
	));
}
