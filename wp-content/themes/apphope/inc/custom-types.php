<?php 
function projects_post_status(){
	register_post_status( 'closed', array(
		'label'                     => _x( 'Closed', 'post' ),
		'public'                    => true,
		'exclude_from_search'       => false,
		'show_in_admin_all_list'    => true,
		'show_in_admin_status_list' => true,
		'label_count'               => _n_noop( 'Closed <span class="count">(%s)</span>', 'Closed <span class="count">(%s)</span>' ),
	) );
}
add_action( 'init', 'projects_post_status' );
add_action('admin_footer-post.php', 'jc_append_post_status_list');
function jc_append_post_status_list(){
     global $post;
     $complete = '';
     $label = '';
     if($post->post_type == 'ignition_product'){
          if($post->post_status == 'closed'){
               $complete = ' selected=\"selected\"';
               $label = '<span id=\"post-status-display\"> Closed</span>';
          }
          echo '<script>jQuery(document).ready(function($){
               $("select#post_status").append(\'<option value="closed" '.$complete.'>Closed</option>\');
               $(".misc-pub-section label").append("'.$label.'");
          });</script>';
     }
}
//add_action('admin_init', 'flush_rewrite_rules'); //!!!!!!
	// Register Custom Post Type FAQ

function custom_post_type_faq() {
   $args = array(
       "label" 						   => _x("Categories","category label","apphope"), 
       "singular_label" 			   => _x("Category","category_singular_label","apphope"), 
       'public'                        => true,'hierarchical'   => true,'show_ui'  => true,
       'show_in_nav_menus'             => false,
       'args'                          => array( 'orderby' => 'term_order' ),
       'rewrite'                       => array('slug'         => _x( 'faq_category', 'slug', 'apphope') ,'with_front'   => false,'hierarchical' => true),
       'query_var'                     => true
      );
     register_taxonomy( 'faq_category', 'faq', $args );
	$labels = array(
		'name'                  => _x( 'FAQ', 'Post Type General Name', 'apphope' ),
		'singular_name'         => _x( 'FAQ', 'Post Type Singular Name', 'apphope' ),
		'menu_name'             => __( 'FAQ', 'apphope' ),
		'name_admin_bar'        => __( 'FAQ', 'apphope' ),
		'archives'              => __( 'Item Archives', 'apphope' ),
		'parent_item_colon'     => __( 'Parent Item:', 'apphope' ),
		'all_items'             => __( 'All Items', 'apphope' ),
		'add_new_item'          => __( 'Add New Item', 'apphope' ),
		'add_new'               => __( 'Add New', 'apphope' ),
		'new_item'              => __( 'New Item', 'apphope' ),
		'edit_item'             => __( 'Edit Item', 'apphope' ),
		'update_item'           => __( 'Update Item', 'apphope' ),
		'view_item'             => __( 'View Item', 'apphope' ),
		'search_items'          => __( 'Search Item', 'apphope' ),
		'not_found'             => __( 'Not found', 'apphope' ),
		'not_found_in_trash'    => __( 'Not found in Trash', 'apphope' ),
		'featured_image'        => __( 'Featured Image', 'apphope' ),
		'set_featured_image'    => __( 'Set featured image', 'apphope' ),
		'remove_featured_image' => __( 'Remove featured image', 'apphope' ),
		'use_featured_image'    => __( 'Use as featured image', 'apphope' ),
		'insert_into_item'      => __( 'Insert into item', 'apphope' ),
		'uploaded_to_this_item' => __( 'Uploaded to this item', 'apphope' ),
		'items_list'            => __( 'Items list', 'apphope' ),
		'items_list_navigation' => __( 'Items list navigation', 'apphope' ),
		'filter_items_list'     => __( 'Filter items list', 'apphope' ),
	);
	$args = array(
		'label'                 => __( 'FAQ', 'apphope' ),
		'description'           => __( 'FAQ', 'apphope' ),
		'labels'                => $labels,
		'supports'              => array( 'title', 'editor','page-attributes', 'custom-fields'),
		'taxonomies'            => array( 'faq_category'),
		'hierarchical'          => false,
		'public'                => true,
		'show_ui'               => true,
		'show_in_menu'          => true,
		'menu_position'         => 20,
		'show_in_admin_bar'     => true,
		'show_in_nav_menus'     => true,
		'can_export'            => true,
		'has_archive'           => false,		
		'exclude_from_search'   => false,
		'publicly_queryable'    => true,
		'show_in_rest'			=> true,
		'capability_type'       => 'page',
	);
	register_post_type( 'faq', $args );

}
add_action( 'init', 'custom_post_type_faq', 0 );


	// Register Custom Post Type Guidebook
function custom_post_type_guide() {
   $args = array(
       "label" 						   => _x("Categories","category label","apphope"), 
       "singular_label" 			   => _x("Category","category_singular_label","apphope"), 
       'public'                        => true,'hierarchical'   => true,'show_ui'  => true,
       'show_in_nav_menus'             => false,
       'args'                          => array( 'orderby' => 'term_order' ),
       'rewrite'                       => array('slug'         => _x( 'guide_category', 'slug', 'apphope') ,'with_front'   => false,'hierarchical' => true),
       'query_var'                     => true
      );
     register_taxonomy( 'guide_category', 'guide', $args );
	$labels = array(
		'name'                  => _x( 'Guidebook', 'Post Type General Name', 'apphope' ),
		'singular_name'         => _x( 'Guidebook', 'Post Type Singular Name', 'apphope' ),
		'menu_name'             => __( 'Guidebook', 'apphope' ),
		'name_admin_bar'        => __( 'Guidebook', 'apphope' ),
		'archives'              => __( 'Item Archives', 'apphope' ),
		'parent_item_colon'     => __( 'Parent Item:', 'apphope' ),
		'all_items'             => __( 'All Items', 'apphope' ),
		'add_new_item'          => __( 'Add New Item', 'apphope' ),
		'add_new'               => __( 'Add New', 'apphope' ),
		'new_item'              => __( 'New Item', 'apphope' ),
		'edit_item'             => __( 'Edit Item', 'apphope' ),
		'update_item'           => __( 'Update Item', 'apphope' ),
		'view_item'             => __( 'View Item', 'apphope' ),
		'search_items'          => __( 'Search Item', 'apphope' ),
		'not_found'             => __( 'Not found', 'apphope' ),
		'not_found_in_trash'    => __( 'Not found in Trash', 'apphope' ),
		'featured_image'        => __( 'Featured Image', 'apphope' ),
		'set_featured_image'    => __( 'Set featured image', 'apphope' ),
		'remove_featured_image' => __( 'Remove featured image', 'apphope' ),
		'use_featured_image'    => __( 'Use as featured image', 'apphope' ),
		'insert_into_item'      => __( 'Insert into item', 'apphope' ),
		'uploaded_to_this_item' => __( 'Uploaded to this item', 'apphope' ),
		'items_list'            => __( 'Items list', 'apphope' ),
		'items_list_navigation' => __( 'Items list navigation', 'apphope' ),
		'filter_items_list'     => __( 'Filter items list', 'apphope' ),
	);
	$args = array(
		'label'                 => __( 'Guidebook', 'apphope' ),
		'description'           => __( 'Guidebook', 'apphope' ),
		'labels'                => $labels,
		'supports'              => array( 'title', 'page-attributes','editor', 'custom-fields'),
		'taxonomies'            => array( 'guide_category'),
		'hierarchical'          => false,
		'public'                => true,
		'show_ui'               => true,
		'show_in_menu'          => true,
		'menu_position'         => 20,
		'show_in_admin_bar'     => true,
		'show_in_nav_menus'     => true,
		'can_export'            => true,
		'has_archive'           => false,		
		'exclude_from_search'   => false,
		'publicly_queryable'    => true,
		'show_in_rest'			=> true,
		'capability_type'       => 'page',
	);
	register_post_type( 'guide', $args );

}
add_action( 'init', 'custom_post_type_guide', 0 );


function custom_post_type_slides() {
   $args = array(
       "label" 						   => _x("Categories","category label","apphope"), 
       "singular_label" 			   => _x("Category","category_singular_label","apphope"), 
       'public'                        => true,'hierarchical'   => true,'show_ui'  => true,
       'show_in_nav_menus'             => false,
       'args'                          => array( 'orderby' => 'term_order' ),
       'rewrite'                       => array('slug'         => _x( 'slides_category', 'slug', 'apphope') ,'with_front'   => false,'hierarchical' => true),
       'query_var'                     => true
      );
     register_taxonomy( 'slides_category', 'slides', $args );
	$labels = array(
		'name'                  => _x( 'Slides', 'Post Type General Name', 'apphope' ),
		'singular_name'         => _x( 'Slides', 'Post Type Singular Name', 'apphope' ),
		'menu_name'             => __( 'Slides', 'apphope' ),
		'name_admin_bar'        => __( 'Slides', 'apphope' ),
		'archives'              => __( 'Item Archives', 'apphope' ),
		'parent_item_colon'     => __( 'Parent Item:', 'apphope' ),
		'all_items'             => __( 'All Items', 'apphope' ),
		'add_new_item'          => __( 'Add New Item', 'apphope' ),
		'add_new'               => __( 'Add New', 'apphope' ),
		'new_item'              => __( 'New Item', 'apphope' ),
		'edit_item'             => __( 'Edit Item', 'apphope' ),
		'update_item'           => __( 'Update Item', 'apphope' ),
		'view_item'             => __( 'View Item', 'apphope' ),
		'search_items'          => __( 'Search Item', 'apphope' ),
		'not_found'             => __( 'Not found', 'apphope' ),
		'not_found_in_trash'    => __( 'Not found in Trash', 'apphope' ),
		'featured_image'        => __( 'Featured Image', 'apphope' ),
		'set_featured_image'    => __( 'Set featured image', 'apphope' ),
		'remove_featured_image' => __( 'Remove featured image', 'apphope' ),
		'use_featured_image'    => __( 'Use as featured image', 'apphope' ),
		'insert_into_item'      => __( 'Insert into item', 'apphope' ),
		'uploaded_to_this_item' => __( 'Uploaded to this item', 'apphope' ),
		'items_list'            => __( 'Items list', 'apphope' ),
		'items_list_navigation' => __( 'Items list navigation', 'apphope' ),
		'filter_items_list'     => __( 'Filter items list', 'apphope' ),
	);
	$args = array(
		'label'                 => __( 'Slides', 'apphope' ),
		'description'           => __( 'Slides', 'apphope' ),
		'labels'                => $labels,
		'supports'              => array( 'title', 'editor', 'thumbnail', 'custom-fields'),
		'taxonomies'            => array( 'slides_category'),
		'hierarchical'          => false,
		'public'                => true,
		'show_ui'               => true,
		'show_in_menu'          => true,
		'menu_position'         => 20,
		'show_in_admin_bar'     => true,
		'show_in_nav_menus'     => true,
		'can_export'            => true,
		'has_archive'           => false,		
		'exclude_from_search'   => false,
		'publicly_queryable'    => true,
		'show_in_rest'			=> true,
		'capability_type'       => 'page',
	);
	register_post_type( 'slides', $args );

}
add_action( 'init', 'custom_post_type_slides', 0 );
// GET FEATURED IMAGE
function app_get_featured_image($post_ID) {
    $post_thumbnail_id = get_post_thumbnail_id($post_ID);
    if ($post_thumbnail_id) {
        $post_thumbnail_img = wp_get_attachment_image_src($post_thumbnail_id, 'thumbnail');
        return $post_thumbnail_img[0];
    }
}

// ADD NEW COLUMN
function app_columns_head($columns){
  global $post;
  if( $post->post_type != 'slides' ) return $columns;
  $columns['featured_image'] = 'Featured Image';
  return $columns;
}
// SHOW THE FEATURED IMAGE
function app_columns_content($column_name, $post_ID) {
  global $post;
  if( $post->post_type != 'slides' ) return;
    if ($column_name == 'featured_image') {
        $post_featured_image = app_get_featured_image($post_ID);
        if ($post_featured_image) {
            echo '<img src="' . $post_featured_image . '" />';
        }
    }
}

add_filter('manage_posts_columns', 'app_columns_head');
add_action('manage_posts_custom_column', 'app_columns_content', 10, 2);

add_action( 'restrict_manage_posts', 'my_restrict_manage_posts' );
function my_restrict_manage_posts() {
	global $typenow;
	$taxonomy = $typenow.'_category';
	if( $typenow == "faq" || $typenow == "guide" ){
		$filters = array($taxonomy);
		foreach ($filters as $tax_slug) {
			$tax_obj = get_taxonomy($tax_slug);
			$tax_name = $tax_obj->labels->name;
			$terms = get_terms($tax_slug);
			echo "<select name='$tax_slug' id='$tax_slug' class='postform'>";
			echo "<option value=''>Show All $tax_name</option>";
			foreach ($terms as $term) { echo '<option value='. $term->slug, $_GET[$tax_slug] == $term->slug ? ' selected="selected"' : '','>' . $term->name .' (' . $term->count .')</option>'; }
			echo "</select>";
		}
	}
}
?>