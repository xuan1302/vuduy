<?php

// Register Custom Post Type
function reg_testimonial()
{
    //postype seminar
    $service = array(
        'name' => _x('Dịch vụ', 'Post Type General Name', 'hello-theme'),
        'singular_name' => _x('Dịch vụ', 'Post Type Singular Name', 'hello-theme'),
        'menu_name' => __('Dịch vụ', 'hello-theme'),
        'parent_item_colon' => __('Dịch vụ ', 'hello-theme'),
        'all_items' => __('Tất cả Dịch vụ', 'hello-theme'),
        'view_item' => __('Display', 'hello-theme'),
        'add_new_item' => __('Add Dịch vụ', 'hello-theme'),
        'add_new' => __('Thêm Dịch vụ ', 'hello-theme'),
        'edit_item' => __('Edit', 'hello-theme'),
        'update_item' => __('Update', 'hello-theme'),
        'search_items' => __('Search', 'hello-theme'),
        'not_found' => __('Not found', 'hello-theme'),
        'not_found_in_trash' => __('Not found in trash', 'hello-theme'),
    );
    $service_cat = array(
        'labels' => $service,
        'supports' => array('title', 'editor', 'thumbnail'),
        'hierarchical' => false,
        'public' => true,
        'show_ui' => true,
        'show_in_menu' => true,
        'show_in_nav_menus' => true,
        'show_in_admin_bar' => true,
        'menu_position' => 9,
        'can_export' => true,
        'has_archive' => true,
        'menu_icon' => 'dashicons-format-aside',
        'exclude_from_search' => false,
        'publicly_queryable' => true,
        'capability_type' => 'post',
        'rewrite' => array('slug' => 'service'),
    );
    register_post_type('service', $service_cat);



}


//postype document
$construction = array(
    'name' => _x('Công trình tiêu biểu', 'Post Type General Name', 'hello-theme'),
    'singular_name' => _x('Công trình tiêu biểu', 'Post Type Singular Name', 'hello-theme'),
    'menu_name' => __('Công trình tiêu biểu', 'hello-theme'),
    'parent_item_colon' => __('Công trình tiêu biểu ', 'hello-theme'),
    'all_items' => __('Tất cả Công trình tiêu biểu', 'hello-theme'),
    'view_item' => __('Display', 'hello-theme'),
    'add_new_item' => __('Thêm Công trình tiêu biểu', 'hello-theme'),
    'add_new' => __('Thêm Công trình tiêu biểu ', 'hello-theme'),
    'edit_item' => __('Edit', 'hello-theme'),
    'update_item' => __('Update', 'hello-theme'),
    'search_items' => __('Search', 'hello-theme'),
    'not_found' => __('Not found', 'hello-theme'),
    'not_found_in_trash' => __('Not found in trash', 'hello-theme'),
);
$construction_cat = array(
    'labels' => $construction,
    'supports' => array('title', 'editor', 'thumbnail'),
    'hierarchical' => false,
    'public' => true,
    'show_ui' => true,
    'show_in_menu' => true,
    'show_in_nav_menus' => true,
    'show_in_admin_bar' => true,
    'menu_position' => 5,
    'can_export' => true,
    'has_archive' => true,
    'menu_icon' => 'dashicons-media-document',
    'exclude_from_search' => false,
    'publicly_queryable' => true,
    'capability_type' => 'post',
    'rewrite' => array('slug' => 'construction'),
);
register_post_type('construction', $construction_cat);


//postype survey
// $survey = array(
//     'name' => _x('アンケート', 'Post Type General Name', 'hello-theme'),
//     'singular_name' => _x('アンケート', 'Post Type Singular Name', 'hello-theme'),
//     'menu_name' => __('アンケート', 'hello-theme'),
//     'parent_item_colon' => __('アンケート ', 'hello-theme'),
//     'all_items' => __('All アンケート', 'hello-theme'),
//     'view_item' => __('Display', 'hello-theme'),
//     'add_new_item' => __('Add アンケート', 'hello-theme'),
//     'add_new' => __('Add アンケート ', 'hello-theme'),
//     'edit_item' => __('Edit', 'hello-theme'),
//     'update_item' => __('Update', 'hello-theme'),
//     'search_items' => __('Search', 'hello-theme'),
//     'not_found' => __('Not found', 'hello-theme'),
//     'not_found_in_trash' => __('Not found in trash', 'hello-theme'),
// );
// $survey_cat = array(
//     'labels' => $survey,
//     'supports' => array('title'),
//     'hierarchical' => false,
//     'public' => true,
//     'show_ui' => true,
//     'show_in_menu' => true,
//     'show_in_nav_menus' => true,
//     'show_in_admin_bar' => true,
//     'menu_position' => 5,
//     'can_export' => true,
//     'has_archive' => true,
//     'menu_icon' => 'dashicons-media-document',
//     'exclude_from_search' => false,
//     'publicly_queryable' => true,
//     'capability_type' => 'post',
//     'rewrite' => array('slug' => 'survey'),
// );
// register_post_type('survey', $survey_cat);

add_action('init', 'reg_testimonial', 0);




//function ssls_register_taxonomy()
//{
//
//    //taxonomy new
//    $taxonomy_news = array(
//        'name' => _x('New Category', 'Taxonomy General Name', 'hello-theme'),
//        'singular_name' => _x('New Category', 'Taxonomy Singular Name', 'hello-theme'),
//        'menu_name' => __('New Category', 'hello-theme'),
//        'all_items' => __('All Items', 'hello-theme'),
//        'parent_item' => __('Parent Item', 'hello-theme'),
//        'parent_item_colon' => __('Parent Item:', 'hello-theme'),
//        'new_item_name' => __('New Item Name', 'hello-theme'),
//        'add_new_item' => __('Add New Item', 'hello-theme'),
//        'edit_item' => __('Edit Item', 'hello-theme'),
//        'update_item' => __('Update Item', 'hello-theme'),
//        'view_item' => __('View Item', 'hello-theme'),
//        'separate_items_with_commas' => __('Separate items with commas', 'hello-theme'),
//        'add_or_remove_items' => __('Add or remove items', 'hello-theme'),
//        'choose_from_most_used' => __('Choose from the most used', 'hello-theme'),
//        'popular_items' => __('Popular Items', 'hello-theme'),
//        'search_items' => __('Search Items', 'hello-theme'),
//        'not_found' => __('Not Found', 'hello-theme'),
//        'no_terms' => __('No items', 'hello-theme'),
//        'items_list' => __('Items list', 'hello-theme'),
//        'items_list_navigation' => __('Items list navigation', 'hello-theme'),
//    );
//    $tax_news = array(
//        'slug' => 'category-news',
//        'with_front' => true,
//        'hierarchical' => false,
//    );
//    $cat_tax = array(
//        'labels' => $taxonomy_news,
//        'hierarchical' => true,
//        'public' => true,
//        'show_ui' => true,
//        'show_admin_column' => true,
//        'show_in_nav_menus' => true,
//        'show_tagcloud' => true,
//        'rewrite' => $tax_news,
//    );
//    register_taxonomy('news_cat', array('news'), $cat_tax);
//
//    //taxonomy solution
//    $taxonomy_solution = array(
//        'name' => _x('New Solution', 'Taxonomy General Name', 'hello-theme'),
//        'singular_name' => _x('New Solution', 'Taxonomy Singular Name', 'hello-theme'),
//        'menu_name' => __('New Solution', 'hello-theme'),
//        'all_items' => __('All Items', 'hello-theme'),
//        'parent_item' => __('Parent Item', 'hello-theme'),
//        'parent_item_colon' => __('Parent Item:', 'hello-theme'),
//        'new_item_name' => __('New Item Name', 'hello-theme'),
//        'add_new_item' => __('Add New Item', 'hello-theme'),
//        'edit_item' => __('Edit Item', 'hello-theme'),
//        'update_item' => __('Update Item', 'hello-theme'),
//        'view_item' => __('View Item', 'hello-theme'),
//        'separate_items_with_commas' => __('Separate items with commas', 'hello-theme'),
//        'add_or_remove_items' => __('Add or remove items', 'hello-theme'),
//        'choose_from_most_used' => __('Choose from the most used', 'hello-theme'),
//        'popular_items' => __('Popular Items', 'hello-theme'),
//        'search_items' => __('Search Items', 'hello-theme'),
//        'not_found' => __('Not Found', 'hello-theme'),
//        'no_terms' => __('No items', 'hello-theme'),
//        'items_list' => __('Items list', 'hello-theme'),
//        'items_list_navigation' => __('Items list navigation', 'hello-theme'),
//    );
//    $tax_solution = array(
//        'slug' => 'category-solution',
//        'with_front' => true,
//        'hierarchical' => false,
//    );
//    $cat_tax_solution = array(
//        'labels' => $taxonomy_solution,
//        'hierarchical' => true,
//        'public' => true,
//        'show_ui' => true,
//        'show_admin_column' => true,
//        'show_in_nav_menus' => true,
//        'show_tagcloud' => true,
//        'rewrite' => $tax_solution,
//    );
//    register_taxonomy('solution_cat', array('cs_solution'), $cat_tax_solution);
//
//    //taxonomy service
//    $taxonomy_service = array(
//        'name' => _x('New Service', 'Taxonomy General Name', 'hello-theme'),
//        'singular_name' => _x('New Service', 'Taxonomy Singular Name', 'hello-theme'),
//        'menu_name' => __('New Service', 'hello-theme'),
//        'all_items' => __('All Items', 'hello-theme'),
//        'parent_item' => __('Parent Item', 'hello-theme'),
//        'parent_item_colon' => __('Parent Item:', 'hello-theme'),
//        'new_item_name' => __('New Item Name', 'hello-theme'),
//        'add_new_item' => __('Add New Item', 'hello-theme'),
//        'edit_item' => __('Edit Item', 'hello-theme'),
//        'update_item' => __('Update Item', 'hello-theme'),
//        'view_item' => __('View Item', 'hello-theme'),
//        'separate_items_with_commas' => __('Separate items with commas', 'hello-theme'),
//        'add_or_remove_items' => __('Add or remove items', 'hello-theme'),
//        'choose_from_most_used' => __('Choose from the most used', 'hello-theme'),
//        'popular_items' => __('Popular Items', 'hello-theme'),
//        'search_items' => __('Search Items', 'hello-theme'),
//        'not_found' => __('Not Found', 'hello-theme'),
//        'no_terms' => __('No items', 'hello-theme'),
//        'items_list' => __('Items list', 'hello-theme'),
//        'items_list_navigation' => __('Items list navigation', 'hello-theme'),
//    );
//    $tax_service = array(
//        'slug' => 'category-service',
//        'with_front' => true,
//        'hierarchical' => false,
//    );
//    $cat_tax_service = array(
//        'labels' => $taxonomy_service,
//        'hierarchical' => true,
//        'public' => true,
//        'show_ui' => true,
//        'show_admin_column' => true,
//        'show_in_nav_menus' => true,
//        'show_tagcloud' => true,
//        'rewrite' => $tax_service,
//    );
//    register_taxonomy('service_cat', array('service'), $cat_tax_service);
//
//    //taxonomy security
//    $taxonomy_security = array(
//        'name' => _x('New Security', 'Taxonomy General Name', 'hello-theme'),
//        'singular_name' => _x('New Security', 'Taxonomy Singular Name', 'hello-theme'),
//        'menu_name' => __('New Security', 'hello-theme'),
//        'all_items' => __('All Items', 'hello-theme'),
//        'parent_item' => __('Parent Item', 'hello-theme'),
//        'parent_item_colon' => __('Parent Item:', 'hello-theme'),
//        'new_item_name' => __('New Item Name', 'hello-theme'),
//        'add_new_item' => __('Add New Item', 'hello-theme'),
//        'edit_item' => __('Edit Item', 'hello-theme'),
//        'update_item' => __('Update Item', 'hello-theme'),
//        'view_item' => __('View Item', 'hello-theme'),
//        'separate_items_with_commas' => __('Separate items with commas', 'hello-theme'),
//        'add_or_remove_items' => __('Add or remove items', 'hello-theme'),
//        'choose_from_most_used' => __('Choose from the most used', 'hello-theme'),
//        'popular_items' => __('Popular Items', 'hello-theme'),
//        'search_items' => __('Search Items', 'hello-theme'),
//        'not_found' => __('Not Found', 'hello-theme'),
//        'no_terms' => __('No items', 'hello-theme'),
//        'items_list' => __('Items list', 'hello-theme'),
//        'items_list_navigation' => __('Items list navigation', 'hello-theme'),
//    );
//    $tax_security = array(
//        'slug' => 'category-security',
//        'with_front' => true,
//        'hierarchical' => false,
//    );
//    $cat_tax_security = array(
//        'labels' => $taxonomy_security,
//        'hierarchical' => true,
//        'public' => true,
//        'show_ui' => true,
//        'show_admin_column' => true,
//        'show_in_nav_menus' => true,
//        'show_tagcloud' => true,
//        'rewrite' => $tax_security,
//    );
//    register_taxonomy('security_cat', array('security'), $cat_tax_security);
//}
//
//add_action('init', 'ssls_register_taxonomy', 0);

