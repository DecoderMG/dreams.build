<?php
/**
 * Apphope functions and definitions
 *
 * @package WordPress
 * @subpackage Apphope
 * @since Apphope 0.0.1
 */

/**
 * Set the content width based on the theme's design and stylesheet.
 * @since Apphope 0.0.1
 */
 if ( ! function_exists('write_log')) {
   function write_log ( $log )  {
      if ( is_array( $log ) || is_object( $log ) ) {
         error_log( print_r( $log, true ) );
      } else {
         error_log( $log );
      }
   }
}
function bbp_enable_visual_editor( $args = array() ) {
    $args['tinymce'] = true;
    $args['quicktags'] = false;
    return $args;
}
add_filter( 'bbp_after_get_the_content_parse_args', 'bbp_enable_visual_editor' );
//In some cases, text pasted into the visual editor will bring along unwanted styles and HTML markup. You can use another function to force pasted text to be cleaned up. This will remove things like stray HTML but leave in basics like bold and italics.
function bbp_tinymce_paste_plain_text( $plugins = array() ) {
    $plugins[] = 'paste';
    return $plugins;
}
add_filter( 'bbp_get_tiny_mce_plugins', 'bbp_tinymce_paste_plain_text' );

add_theme_support( 'post-thumbnails' );
// define the bbp_pre_get_user_profile_url callback
/*function filter_bbp_pre_get_user_profile_url( $array ) {
    // make filter magic happen here...
    return '123';
};
// add the filter
add_filter( 'bbp_pre_get_user_profile_url', 'filter_bbp_pre_get_user_profile_url', 10, 1 );*/
/*add_filter( 'bbp_get_user_slug', 'my_custom_author_link',10,1 );
function my_custom_author_link( $slug, $user_id, $user_nicename ) {
	//print_r($array);die();
	return 'author';//$user_id;
}*/
add_filter( 'bbp_get_topic_author_link', 'my_custom_author_link',10,2 );
function my_custom_author_link( $url, $r ){
$url = str_replace('/members/', '/author/', $url);
return $url;
}
add_filter( 'bbp_get_reply_author_link', 'my_custom_author_link',10,2 );
function bnfw_insert_post_hook_for_theme( $themes ) {
    $themes[] = 'Apphope';
    return $themes;
}
add_filter( 'bnfw_insert_post_themes', 'bnfw_insert_post_hook_for_theme' );
#add_action( 'all', create_function( '', 'write_log( current_filter() );' ) );
if ( ! isset( $content_width ) ) {
	$content_width = 660;
}

/**Twenty Fifteen only works in WordPress 4.1 or later.*/
if ( version_compare( $GLOBALS['wp_version'], '4.1-alpha', '<' ) ) {
	require get_stylesheet_directory() . '/inc/back-compat.php';
}
function convertYoutube($string) {
	
	if (strpos($string, 'vimeo') !== false) {
		$lastSegment = preg_replace("/[^\/]+[^0-9]|(\/)/", "", rtrim($string, "/"));
		$source = "https://player.vimeo.com/video/".$lastSegment;
		//return preg_replace(
		//	"vimeo\.com/(\w*/)*(\d+)",
		//	"<iframe src=\"//www.player.vimeo.com/video/$2\" allowfullscreen frameborder='0'></iframe>",
		//	$string
		//);
		return "<iframe src=\"$source\" frameborder='0' webkitallowfullscreen mozallowfullscreen allowfullscreen></iframe>";
		//return "<iframe src=\"https://player.vimeo.com/video/203803551\" width=\"640\" height=\"338\" frameborder=\"0\" webkitallowfullscreen mozallowfullscreen allowfullscreen></iframe>";
	}
	else {
		return preg_replace(
			"/\s*[a-zA-Z\/\/:\.]*youtu(be.com\/watch\?v=|.be\/)([a-zA-Z0-9\-_]+)([a-zA-Z0-9\/\*\-\_\?\&\;\%\=\.]*)/i",
			"<iframe src=\"//www.youtube.com/embed/$2\" allowfullscreen frameborder='0'></iframe>",
			$string
		);
	}
}
if ( ! function_exists( 'comradeweb_setup' ) ) :
/**
 * Sets up theme defaults and registers support for various WordPress features.
 * Note that this function is hooked into the after_setup_theme hook, which runs before the init hook. The init hook is too late for some features, such  as indicating support for post thumbnails.
 * @since Comradeweb 0.0.1
 */
function comradeweb_setup() {
	// Add default posts and comments RSS feed links to head.
	add_theme_support( 'automatic-feed-links' );
	/* Let WordPress manage the document title.
	 * By adding theme support, we declare that this theme does not use a hard-coded <title> tag in the document head, and expect WordPress to provide it for us.*/
	//add_theme_support( 'title-tag' );

	/*Enable support for Post Thumbnails on posts and pages.
	 * See: https://codex.wordpress.org/Function_Reference/add_theme_support#Post_Thumbnails */
	add_theme_support( 'post-thumbnails' );
	set_post_thumbnail_size( 825, 510, true );

	// This theme uses wp_nav_menu() in two locations.
	register_nav_menus( array(
		'primary' => __( 'Primary Menu',      'comradeweb' ),
		'social'  => __( 'Social Links Menu', 'comradeweb' ),
	) );

	/*Switch default core markup for search form, comment form, and comments to output valid HTML5. */
	add_theme_support( 'html5', array('search-form', 'comment-form', 'comment-list', 'gallery', 'caption'));
	/* Enable support for Post Formats.See: https://codex.wordpress.org/Post_Formats */
	add_theme_support( 'post-formats', array('aside', 'image', 'video', 'quote', 'link', 'gallery', 'status', 'audio', 'chat') );
}
endif; // comradeweb_setup
add_action( 'after_setup_theme', 'comradeweb_setup' );

function get_meta_values( $key = '', $type = 'post', $status = 'publish' ) {
    global $wpdb;
    if( empty( $key ) ) return;
    $r = $wpdb->get_results( $wpdb->prepare( "
        SELECT pm.meta_value FROM {$wpdb->postmeta} pm
        LEFT JOIN {$wpdb->posts} p ON p.ID = pm.post_id
        WHERE pm.meta_key = '%s' 
        AND p.post_status = '%s' 
        AND p.post_type = '%s' GROUP BY pm.meta_value
    ", $key, $status, $type ));

    foreach ( $r as $my_r )
        $metas[] = $my_r->meta_value;

    return $metas;
}

/**
 * Register widget area.
 * @link https://codex.wordpress.org/Function_Reference/register_sidebar
 */
function comradeweb_widgets_init() {
	register_sidebar( array(
		'name'          => __( 'Widget Area', 'comradeweb' ),
		'id'            => 'sidebar-1',
		'description'   => __( 'Add widgets here to appear in your sidebar.', 'comradeweb' ),
		'before_widget' => '<aside id="%1$s" class="widget %2$s">',
		'after_widget'  => '</aside>',
		'before_title'  => '<h2 class="widget-title">',
		'after_title'   => '</h2>',
	) );
}
add_action( 'widgets_init', 'comradeweb_widgets_init' );

/**
 * Display descriptions in main navigation.
 *
 * @since Comradeweb 0.0.1
 *
 * @param string  $item_output The menu item output.
 * @param WP_Post $item        Menu item object.
 * @param int     $depth       Depth of the menu.
 * @param array   $args        wp_nav_menu() arguments.
 * @return string Menu item with possible description.
 */
function comradeweb_nav_description( $item_output, $item, $depth, $args ) {
	if ( 'primary' == $args->theme_location && $item->description ) {
		$item_output = str_replace( $args->link_after . '</a>', '<div class="menu-item-description">' . $item->description . '</div>' . $args->link_after . '</a>', $item_output );
	}
	return $item_output;
}
add_filter( 'walker_nav_menu_start_el', 'comradeweb_nav_description', 10, 4 );

/*function dev_scripts() {
	if ( is_page('8736') ) {
		wp_deregister_script('about');
		wp_register_script('about-dev', get_template_directory_uri() . '/js/about-grid-dev.js', array(), null, $in_footer =false); 
		wp_enqueue_script('about-dev');
	}
}
function dev_styles() {
	if ( is_page('8736') ) {
		wp_deregister_style('styles');
		wp_register_style('styles-dev', get_template_directory_uri() . '/css/styles-dev.css' ); 
		wp_enqueue_style('styles-dev');
	}
}
add_action( 'wp_print_scripts', 'dev_scripts');
add_action( 'wp_print_styles', 'dev_styles');*/
/*--------------------------------------------------------------------------------------------------
	All Required Files
--------------------------------------------------------------------------------------------------*/
//include_once(get_stylesheet_directory().'/inc/custom-posts.php');
//include_once(get_stylesheet_directory().'/inc/metabox.php');
function the_project_summary($id) {
	$post = get_post($id);
	$project_id = get_post_meta($id, 'ign_project_id', true);
	$project = new ID_Project($project_id);
	$image_url = the_project_image($id, "1");
	$name = $post->post_title;
	$short_desc = html_entity_decode(get_post_meta($id, 'ign_project_description', true));
	$currency = get_post_meta($id, 'ign_currency', true);
	$total_ = $project->get_project_raised();
//	$total = apply_filters('id_funds_raised', $total_, $id); -- old
	$total = currencyConverter($total_, $currency); //$currency);
	$total_ =  floatval(str_replace(',','',str_replace('$','',$total_)));
	$raised = get_post_meta($id, 'ign_raised', true);
	$goal_ = $project->the_goal();
	$goal = currencyConverter($goal_, $currency); //$currency);
	$goal_ =  floatval(str_replace(',','',str_replace('$','',$goal_)));
	$end = get_post_meta($id, 'ign_fund_end', true);
	$ratio = get_post_meta($id, 'ign_ratio', true);
	$end2 = get_post_meta($id, 'ign_fund_end2', true);
	$end_type = get_post_meta($id, 'ign_end_type', true);
	$stage = get_post_meta($id, 'ign_stage', true);
	$ratio = get_post_meta($id, 'ign_ratio', true);
    if($stage == 1){
        $days_left = $project->days_left();
    }

    if($stage == 2){
        $days_left = $project->days_left_2();
    }

	$pledgers = apply_filters('id_number_pledges', $project->get_project_orders(), $id);
	// ID Function
	// GETTING product default settings
	$default_prod_settings = getProductDefaultSettings();

	// Getting product settings and if they are not present, set the default settings as product settings
	$prod_settings = getProductSettings($project_id);
	if (empty($prod_settings)) {
		$prod_settings = $default_prod_settings;
	}
	$currency_code = getSymbolCurr();
	//GETTING the currency symbols
	$cCode = setCurrencyCode($currency_code);

	if ($end !== '') {
		$show_dates = true;
	}
	else {
		$show_dates = false;
	}
	
	// percentage bar
	$percentage = apply_filters('id_percentage_raised', $project->percent(), apply_filters('id_funds_raised', $project->get_project_raised(), $id, true), $id, apply_filters('id_project_goal', $project->the_goal(), $id, true));
	$successful = get_post_meta($id, 'ign_project_success', true);
	
	$summary =  new stdClass;
	$summary->end1 = $end;
	$summary->end2 = $end2;
	$summary->end_type = $end_type;
	$summary->image_url = $image_url;
	$summary->name = $name;
	$summary->short_description = $short_desc;
	$summary->total = $total;
	$summary->ratio = $ratio;
	$summary->goal = $goal;

	// Understanding stage condition
	$summary->stageState = array();

	if (time() > strtotime($end)) {
		$summary->stageState[1] = 'expired';
	} else {
		$summary->stageState[1] = 'running';
	}
	if (time() > strtotime($end2)) {
		$summary->stageState[2] = 'expired';
	} else {
		$summary->stageState[2] = 'running';
	}

//	$summary->stage = ($total_ >=$goal_)?'2':'1'; -- old version
	$summary->stage = $stage;
//	if($summary->stage!=$stage){ update_post_meta($id, 'ign_stage', $summary->stage); } // make CRON!!!!
//	if(!$days_left){
//		$_post = array( 'ID' => $id, 'post_status' => 'closed' );
//		wp_update_post($_post);
//	}
	$new_ratio = ($goal_>0)?floatval($total_/$goal_)*100:0;
//	if($ratio!==$new_ratio){update_post_meta($id, 'ign_ratio', $new_ratio);}//make CRON
//	if($total_!==$raised){update_post_meta($id, 'ign_raised', $total_);}//make CRON
	//$summary->ratio = $ratio;
	$summary->pledgers = $pledgers;
	$summary->show_dates = $show_dates;
	if ($show_dates == true) {
		$summary->days_left = $days_left;
	}
	$summary->percentage = $percentage;
	$summary->successful = $successful;
	$summary->currency_code = $cCode;
	return $summary;
}
/* Reqister styles and scripts */
//add_action( 'after_setup_theme', 'remove_parent_theme_stuff', 100 );
if ( function_exists( 'add_image_size' ) ) { 
	add_image_size( 'grid-thumb', 260, 215, true ); // For Grid
}

function parse_shortcode_content( $content ) { 
 
    /* Parse nested shortcodes and add formatting. */ 
    $content = trim( wpautop( do_shortcode( $content ) ) ); 
 
    /* Remove '</p>' from the start of the string. */ 
    if ( substr( $content, 0, 4 ) == '</p>' ) 
        $content = substr( $content, 4 ); 
 
    /* Remove '<p>' from the end of the string. */ 
    if ( substr( $content, -3, 3 ) == '<p>' ) 
        $content = substr( $content, 0, -3 ); 
 
    /* Remove any instances of '<p></p>'. */ 
    $content = str_replace( array( '<p></p>' ), '', $content ); 
 
    return $content; 
} 

function my_delete_user($user_id) {
	global $wpdb;
	$email = $wpdb->get_var("SELECT user_email FROM $wpdb->users WHERE ID = '" . $user_id . "' LIMIT 1");

	$headers = 'From: ' . get_bloginfo("name") . ' <' . get_bloginfo("admin_email") . '>' . "\r\n";
	wp_mail($email, 'You are being deleted, brah', 'Your account at ' . get_bloginfo("name") . ' is being deleted right now.', $headers);
}
add_action( 'delete_user', 'my_delete_user');

require_once( get_stylesheet_directory() . '/inc/custom-ajax-auth.php' );
add_action( 'wp_enqueue_scripts', 'child_overwrite_styles', 100 );
remove_filter('wp_title', 'fh_wp_title',0);
function child_overwrite_styles() {wp_deregister_style( 'font-awesome' );}
wp_enqueue_script( 'ajax_js', get_stylesheet_directory_uri(). '/js/ajax-category.js', array( 'jquery'), '', true ); 
wp_localize_script( 'ajax_js', 'ajax_posts', array( 'ajaxurl' => admin_url( 'admin-ajax.php' ), 'noposts' => __('No older posts found', 'apphope'), ));
function more_post_ajax(){
	global $current_user;
	//parse_str($_POST['Data'],$_POST);
    $ppp = 8; // posts per page
    $page = (!empty($_POST['pageNumber'])) ? intval($_POST['pageNumber']) : 0;
    if(!empty($_POST['category']&&$_POST['category']!='all')) $current_category= get_category_by_slug( esc_attr($_POST['category']) );
	$cat = (!empty($current_category)) ? $current_category->term_id : '';
	$key = (!empty($_POST['key'])) ? esc_attr($_POST['key']) : '';
	$state = (!empty($_POST['place']) && $_POST['place']!='any') ? $_POST['place'] : '';
	$orderby = (!empty($_POST['orderby'])) ? esc_attr($_POST['orderby']) : '';
	$stage = (!empty($_POST['stage'])) ? intval($_POST['stage']) : '';
	$author = (!empty($_POST['aut'])) ? intval($_POST['aut']) : 0;
	$backed = (!empty($_POST['backed'])) ? intval($_POST['backed']) : 0;
	$funded = (!empty($_POST['funded'])) ? esc_attr($_POST['funded']) : '';
	$goal = (!empty($_POST['goal'])) ? esc_attr($_POST['goal']) : '';
	$tags = (!empty($_POST['tags'])) ? $_POST['tags'] : '';
	$order = 'ASC';
	$orderby = 'ign_fund_end';
	//$myb = (!empty($_POST['myb'])) ? 1 : 0;
	if($orderby=='newest') $orderby = 'ign_start_date';
	elseif($orderby=='popularity') {$orderby = 'ign_sponsor_count';$order = 'ASC';}
	elseif($orderby=='end date') $orderby = 'ign_fund_end';
	elseif($orderby=='most funded') $orderby = 'ign_fund_goal';
    //header("Content-Type: text/html");
    header('Content-Type: application/json');
    $str = explode(',', $state);
	$state = esc_attr(trim($str[0]));
    $args = array( 'suppress_filters' => true,'post_type' => 'ignition_product','posts_per_page' => $ppp,'order'=>$order,
        'cat' => $cat,'post_status'=>'publish', 'meta_key' => $orderby,'orderby'=> 'meta_key_value', 'paged'    => $page,'meta_query' => array(),'tax_query' => array()  );
    if(!empty($state)){ $args['meta_query'][] =array('key'     => 'ign_city','value'   => $state,'compare' => '=');}
    if(!empty($myb)){ $args['author'] = get_current_user_id();}
    if(!empty($key)){ $args['s'] = $key;}
    if($author){ $args['author'] = $author;}
    if(!empty($stage)){ $args['meta_query'][] =array('key'     => 'ign_stage','value'   => $stage,'compare' => '=');}
    if(!empty($funded)){
	    switch ($funded) {
		    case 'below50': $compare = '<=';$ratio = 50;break;
		    case 'above50': $compare = '>=';$ratio = 50;break;
		    case 'above75': $compare = '>=';$ratio = 75;break;
		} 
	    $args['meta_query'][] =array('key'     => 'ign_ratio','value'   => $ratio,'compare' => $compare, 'type' => 'numeric');
	 }
    if(!empty($goal)){
	    switch ($goal) {
		    case 'below5': $compare = '<=';$goal = 5000;break;
		    case 'above5': $compare = '>=';$goal = 5000;break;
		    case 'below25': $compare = '<=';$goal = 25000;break;
		    case 'above25': $compare = '>=';$goal = 25000;break;
		    case 'below50': $compare = '<=';$goal = 50000;break;
		    case 'above50': $compare = '>=';$goal = 50000;break;
		    case 'below100': $compare = '<=';$goal = 100000;break;
		    case 'above100': $compare = '>=';$goal = 100000;break;
		} 
	    $args['meta_query'][] =array('key' => 'ign_fund_goal','value'   => $goal,'compare' => $compare, 'type' => 'numeric');
	 }
	 
	if(!empty($backed)){
		$misc = ' WHERE user_id = "'.$backed.'"';$listed = array();$wp_ids = array();
		$orders = ID_Member_Order::get_orders(null, null, $misc);
		if (!empty($orders)) {
			$mdid_orders = array();
			foreach ($orders as $order) {
				$mdid_order = mdid_by_orderid($order->id);
				if (!empty($mdid_order)) {$mdid_orders[] = $mdid_order;}
			}
			if (!empty($mdid_orders)) {
				$id_orders = array();
				foreach ($mdid_orders as $payment) {
					$order = new ID_Order($payment->pay_info_id);$the_order = $order->get_order();
					if (!empty($the_order)) { $id_orders[] = $the_order;}
				}
			}
			foreach ($id_orders as $id_order) {
				$project = new ID_Project($id_order->product_id);
				if(!in_array($id_order->product_id, $listed)){
					$listed[] = $id_order->product_id;$wp_ids[] = $project->get_project_postid();
				}
			}
		}
		$args['post__in'] = $wp_ids;
	}

    if(!empty($tags)){ 
	    foreach($tags as $tag){$tag = intval($tag);$args['tax_query'][] =array('taxonomy'=>'post_tag','field'=> 'term_id','terms' => $tag);}
	}
    $loop = new WP_Query($args);
    $out = '';
    
	ob_start();
    if ($loop -> have_posts()) :  
    	while ($loop -> have_posts()) : $loop -> the_post();
    		get_template_part('entry');
		endwhile;
	elseif($_POST['pageNumber']<=1):?><p>No dreams found</p><?php endif;
    wp_reset_postdata();
    $out .= ob_get_contents();ob_end_clean();
    //echo $out;
    echo json_encode(array('str' => $out, 'total'=>$loop->found_posts));
    die();
}

add_action('wp_ajax_nopriv_more_post_ajax', 'more_post_ajax');
add_action('wp_ajax_more_post_ajax', 'more_post_ajax');
function limit_posts_per_archive_page() {
	if ( is_category() ){
		if(is_category()!='blog' ) set_query_var('posts_per_archive_page', 8); // or use variable key: posts_per_page
		else set_query_var('posts_per_archive_page', 7);
	}
}
add_filter('pre_get_posts', 'limit_posts_per_archive_page');

wp_enqueue_script( 'ajax_blog_js', get_stylesheet_directory_uri(). '/js/blog.js', array( 'jquery'), '', true ); 
wp_localize_script( 'ajax_blog_js', 'ajax_blog_posts', array( 'ajaxurl' => admin_url( 'admin-ajax.php' ), 'noposts' => __('No older posts found', 'apphope'), ));
function more_blog_post_ajax(){
    $ppp = 8; // posts per page
    $offset = (isset($_POST['pageNumber'])) ? (($_POST['pageNumber']-2)*8+7) : 7;
    header("Content-Type: text/html");

    if(!empty($_POST['category']&&$_POST['category']!='all')) $current_category= get_category_by_slug( esc_attr($_POST['category']) );
		$cat = (!empty($current_category)) ? $current_category->term_id : '';
	
    $args = array( 'suppress_filters' => true,'post_type' => 'post','post_status'=>'publish','posts_per_page' => $ppp,'orderby'=>'date', 'order'=>'DESC', 'offset'    => $offset );
    if(!empty($cat)) $args['cat'] = $cat;
    $loop = new WP_Query($args);?>
    <?php $i=0; if ( $loop->have_posts() ) : while ( $loop->have_posts() ) : $i++;$loop->the_post();?>
		<?php if($i===1||$i===5):?><div class="row"><?php endif;?>
		<div class="col-lg-3">
			<div class="entry-content">
				<?php if(has_post_thumbnail()):?>
					<a href="<?=the_permalink();?>"><figure class="featured-thumbnail"><span class="img-wrap"><?=the_post_thumbnail();?></span></figure></a>
				<?php endif;?>
				<div class="desc">
					<h2><?php the_title();?></h2>
					<?php the_excerpt();?>
				</div>
			</div>
		</div>
		<?php if($i===4||$i===8):?></div><?php endif;?>
	<?php endwhile;
		elseif($_POST['pageNumber']==0):?>
		<p>No posts found</p>
	<?php endif; 
    wp_reset_postdata();
    die();
}

add_action('wp_ajax_nopriv_more_blog_post_ajax', 'more_blog_post_ajax');
add_action('wp_ajax_more_blog_post_ajax', 'more_blog_post_ajax');

function new_subcategory_hierarchy() {  
    $category = get_queried_object();
 
    $parent_id = $category->category_parent;
 
    $templates = array();
     if($parent_id == 36) {
        // Create replacement $templates array
        $parent = get_category( $parent_id );
 
        // Current first
        $templates[] = "category-{$category->slug}.php";
        $templates[] = "category-{$category->term_id}.php";
 
        // Parent second
        $templates[] = "category-{$parent->slug}.php";
        $templates[] = "category-{$parent->term_id}.php";
        $templates[] = 'category.php';  
    } else {
        // Use default values from get_category_template()
        $templates[] = "category-{$category->slug}.php";
        $templates[] = "category-{$category->term_id}.php";
        $templates[] = 'category.php';
    } 
    return locate_template( $templates );
}
 
add_filter( 'category_template', 'new_subcategory_hierarchy' );
function add_parent_category($classes) {
if (is_single() ) {
	global $post;
	foreach((get_the_category($post->ID)) as $category) {
		// add category slug to the $classes array
		$classes[] = 'category-'.$category->slug;
		$parent = $category->category_parent;
		if( $parent ) {
		  $parent_cat_slug = 'parent-'.get_category( $parent )->slug;
		  if( !in_array( $parent_cat_slug, $classes ) ) $classes[] = $parent_cat_slug;
		}
	}
}
if( is_category() ) {
	$cat_id = get_query_var('cat');
	//get category parent slug if exists
	$parent_id = get_category( $cat_id )->category_parent;
	if ( $parent_id ) $classes[] = 'category-child category-' . get_category( $parent_id )->slug;
	//get top level category ancestor slug if grandparent etc exists
	/*$ancestors = get_ancestors( $cat_id, 'category' );
	if( count( $ancestors ) > 1 ) $classes[] = 'cat-ancestor-' . get_category(array_pop($ancestors))->slug;*/
}
// return the $classes array
return $classes;
}
add_filter('body_class','add_parent_category');
function add_query_vars($aVars) {
$aVars[] = "catslug";
$aVars[] = "tags";
$aVars[] = "query";
$aVars[] = "stage";
$aVars[] = "myb";
$aVars[] = "goal";
$aVars[] = "friendb";
$aVars[] = "funded";
$aVars[] = "search";
$aVars[] = "category";
$aVars[] = "entry";
$aVars[] = "var1";
$aVars[] = "var2";
$aVars[] = "sort";
$aVars[] = "place";
$aVars[] = "author";
$aVars[] = "aut";
$aVars[] = "backed";
return $aVars;
}
/*function add_rewrite_rules($aRules) {
$aNewRules = array('faq/cat/([^/]+)/?$' => 'index.php?pagename=faq');
$aRules = $aNewRules + $aRules;
return $aRules;
}*/
function change_search_url_rewrite() {
	$search = get_query_var( 'search' );
	$category = get_query_var( 'category' );
	global $post;
	if ( ! empty( $_POST['search'] ) && !empty($_POST['faqsubmit']) ) {
		wp_redirect( home_url( 'faqs/'. (!empty($category)?$category:'all')) .'/'. urlencode(get_query_var('search')));
		exit();
	}
	if ( ! empty( $_POST['search'] ) && !empty($_POST['guidesubmit']) ) {
		wp_redirect( home_url('/guidebook/'.$post->post_name) .'/'. urlencode(get_query_var('search')));
		exit();
	}	
}
add_action( 'template_redirect', 'change_search_url_rewrite' );
add_action( 'init', 'add_faq_rules' );
function add_faq_rules() { 
	global $wp_rewrite;
     add_rewrite_rule(
        'faqs/view/([0-9]+)?/?',
        'index.php?pagename=faqs&entry=$matches[1]',
        'top'
    );
     add_rewrite_rule(
        'faqs(/([^/]+))?(/([^/]+))?/?',
        'index.php?pagename=faqs&category=$matches[2]&search=$matches[4]',
        'top'
    );
     add_rewrite_rule(
        'guidebook/([^/]+)/([^/]+)?',
        'index.php?pagename=guidebook/$matches[1]&search=$matches[2]',
        'top'
    );
     add_rewrite_rule(
        'category/([^/]+)(/([^/]+))?(/([^/]+))?',
        'index.php?pagename=category&catslug=$matches[1]&place=$matches[3]&sort=$matches[5]',
        'top'
    );
     add_rewrite_rule(
        'blog/category/([^/]+)?/?',
        'index.php?pagename=blog&catslug=$matches[1]',
        'top'
    );
     /*add_rewrite_rule(
        'blog/events/?',
        'index.php?pagename=blog&catslug=events',
        'top'
    );
     add_rewrite_rule(
        'blog/news/?',
        'index.php?pagename=blog&catslug=news',
        'top'
    );*/
       $wp_rewrite->flush_rules();
}
add_filter('query_vars', 'add_query_vars');
// Our filter callback function
function wsl_render_auth_widget_alter_provider_name_callback( $string ) {
    $string = str_ireplace('facebook', '<i class="fa fa-facebook"></i> Login Using Facebook', $string);
    $string = str_ireplace('google', '<i class="fa fa-google"></i> Login Using Google', $string);
    $string = str_ireplace('twitter', '<i class="fa fa-twitter"></i> Login Using Twitter', $string);
    return $string;
}
add_filter( 'wsl_render_auth_widget_alter_provider_name', 'wsl_render_auth_widget_alter_provider_name_callback', 10 );

	// HOOKABLE: This action runs just after a wordpress user has been created
	// > Note: At this point, the user has been added to wordpress database, but NOT CONNECTED.
	//do_action( 'wsl_hook_process_login_after_wp_insert_user', $user_id, $provider, $hybridauth_user_profile );
add_action('wsl_hook_process_login_after_wp_insert_user',  'wsl_hook_process_login_after_wp_insert_user_func', 10, 3);
function wsl_hook_process_login_after_wp_insert_user_func($user_id, $provider, $hybridauth_user_profile){
	if(!empty($hybridauth_user_profile->city)) update_user_meta($user_id, 'city', esc_attr($hybridauth_user_profile->city));
	if(!empty($hybridauth_user_profile->region)) update_user_meta($user_id, 'state', esc_attr($hybridauth_user_profile->region));
	if(!empty($hybridauth_user_profile->zip)) update_user_meta($user_id, 'zipcode', esc_attr($hybridauth_user_profile->zip));
	if(!empty($hybridauth_user_profile->country)) update_user_meta($user_id, 'country', esc_attr($hybridauth_user_profile->country));
}

function wpb_set_post_views($postID) {
    $count_key = 'wpb_post_views_count';
    $count = get_post_meta($postID, $count_key, true);
    if($count==''){
        $count = 0;
        delete_post_meta($postID, $count_key);
        add_post_meta($postID, $count_key, '0');
    }else{
        $count++;
        update_post_meta($postID, $count_key, $count);
    }
}
//To keep the count accurate, lets get rid of prefetching
remove_action( 'wp_head', 'adjacent_posts_rel_link_wp_head', 10, 0);

function wpb_get_post_views($postID){
    $count_key = 'wpb_post_views_count';
    $count = get_post_meta($postID, $count_key, true);
    if($count==''){
        delete_post_meta($postID, $count_key);
        add_post_meta($postID, $count_key, '0');
        return "0 View";
    }
    return $count.' Views';
}

require_once (get_stylesheet_directory().'/inc/id-handler.php');
require_once (get_stylesheet_directory().'/inc/notify.php');
require_once (get_stylesheet_directory().'/inc/conv.php');
require_once (get_stylesheet_directory().'/inc/custom-types.php');
require_once (get_stylesheet_directory().'/inc/scripts.php');
require_once (get_stylesheet_directory().'/inc/styles.php');


