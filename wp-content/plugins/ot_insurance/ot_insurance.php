<?php
/*
Plugin Name: OT Insurances
Plugin URI: http://oceanthemes.net/
Description: Declares a plugin that will create a custom post type displaying insurance.
Version: 1.0
Author: OceanThemes Team
Author URI: http://oceanthemes.net/
License: GPLv2
*/

add_action( 'init', 'register_ocean_insurance' );

function register_ocean_insurance() {

    $labels = array( 

        'name' => __( 'Insurances', 'ot_insurance' ),

        'singular_name' => __( 'Insurance', 'ot_insurance' ),

        'add_new' => __( 'Add New Insurance', 'ot_insurance' ),

        'add_new_insurance' => __( 'Add New Insurance', 'ot_insurance' ),

        'edit_insurance' => __( 'Edit Insurance', 'ot_insurance' ),

        'new_insurance' => __( 'New Insurance', 'ot_insurance' ),

        'view_insurance' => __( 'View Insurance', 'ot_insurance' ),
		'all_items'          => __( 'All Insurances', 'ot_insurance' ),
        'search_insurances' => __( 'Search Insurances', 'ot_insurance' ),

        'not_found' => __( 'No Insurances found', 'ot_insurance' ),

        'not_found_in_trash' => __( 'No Insurances found in Trash', 'ot_insurance' ),

        'parent_insurance_colon' => __( 'Parent Insurance:', 'ot_insurance' ),

        'menu_name' => __( 'Insurances', 'ot_insurance' ),

    );



    $args = array( 

        'labels' => $labels,

        'hierarchical' => true,

        'description' => 'List insurance',

        'supports' => array( 'title', 'editor', 'thumbnail', 'comments', 'post-formats', 'excerpt' ),

        'taxonomies' => array('category_insurance' ),

        'public' => true,

        'show_ui' => true,

        'show_in_menu' => true,     
        'menu_position' => null,  

        'menu_icon' => 'dashicons-groups',	

        'show_in_nav_menus' => true,

        'publicly_queryable' => true,

        'exclude_from_search' => false,

        'has_archive' => true,

        'query_var' => true,

        'can_export' => true,

        'rewrite' => true,

        'capability_type' => 'post'

    );
    register_post_type( 'insurance', $args );
}

add_action( 'init', 'insurance_category_hierarchical_taxonomy', 0 );
//create a custom taxonomy name it Skillss for your posts
function insurance_category_hierarchical_taxonomy() {



// Add new taxonomy, make it hierarchical like Category

//first do the translations part for GUI



  $labels = array(

    'name' => __( 'Categories', 'ot_insurance' ),

    'singular_name' => __( 'Categories', 'ot_insurance' ),

    'search_insurances' =>  __( 'Search Categories','ot_insurance' ),

    'all_insurances' => __( 'All Categories','ot_insurance' ),

    'parent_insurance' => __( 'Parent Categories','ot_insurance' ),

    'parent_insurance_colon' => __( 'Parent Categories:','ot_insurance' ),

    'edit_insurance' => __( 'Edit Category','ot_insurance' ), 

    'update_insurance' => __( 'Update','ot_insurance' ),

    'add_new_insurance' => __( 'Add New Category','ot_insurance' ),

    'new_insurance_name' => __( 'New Category Name','ot_insurance' ),

    'menu_name' => __( 'Categories','ot_insurance' ),
  );     
// Now register the taxonomy
  register_taxonomy('category_insurance',array('insurance'), array(

    'hierarchical' => true,

    'labels' => $labels,

    'show_ui' => true,

    'show_admin_column' => true,

    'query_var' => true,

    'rewrite' => array( 'slug' => 'category_insurance' ),

  ));
}

?>