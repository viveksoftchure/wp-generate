<?php
/**
 * Plugin Name:       WP Generate
 * Plugin URI:        www.wpwebguru.com
 * Description:       This is a short description of what the plugin does. It's displayed in the WordPress admin area.
 * Version:           1.0.0
 * Author:            Wpwebguru
 * Author URI:        www.wpwebguru.com
 * License:           GPL-2.0+
 * License URI:       http://www.gnu.org/licenses/gpl-2.0.txt
 * Text Domain:       wp-enerate
 */

// Load the file if exist
require_once dirname(__FILE__) . '/inc/functions.php';

require_once dirname(__FILE__) . '/generators/cpt-generator.php';
require_once dirname(__FILE__) . '/generators/wp-query-generator.php';
require_once dirname(__FILE__) . '/generators/wp-options.php';



// https://www.wp-hasty.com/tools/wordpress-settings-options-page-generator/
/* ==========================================================================
================== Register Plugin Css/js
========================================================================== */
function wpg_plugin_scripts() {
	if ( is_page( 'post-type-generator' ) || is_page( 'wp_query-generator' ) || is_page( 'setting-page' ) ) {
	    wp_enqueue_style( 'user-css', plugin_dir_url ( __FILE__ ) . 'assets/css/plugin.css' );
	    wp_enqueue_style( 'prettify', plugin_dir_url ( __FILE__ ) . 'assets/css/prettify/desert.css' );
	    wp_enqueue_style( 'font-awesome', 'https://cdnjs.cloudflare.com/ajax/libs/font-awesome/6.2.0/css/all.min.css' );

		wp_enqueue_script( 'user_script', plugin_dir_url ( __FILE__ ) . 'assets/js/user-scripts.js', array( 'jquery' ), '1.0.0', true );
		wp_localize_script( 'user_script', 'wpgenerate', 
			array( 
				'ajaxurl' => admin_url( 'admin-ajax.php' ),
				// 'shopurl' => get_permalink( woocommerce_get_page_id( 'shop' ) ),
			) 
		);

		wp_enqueue_script( 'prettify', plugin_dir_url ( __FILE__ ) . 'assets/js/prettify/prettify.js', array( 'jquery' ), '1.0.0', true );
	}

	if ( is_page( 'setting-page' ) ) {
		wp_enqueue_script( 'setting_page', plugin_dir_url ( __FILE__ ) . 'assets/js/setting-page.js', array( 'jquery' ), '1.0.0', true );
	}
}
add_action( 'wp_enqueue_scripts', 'wpg_plugin_scripts' );

/*===================================================================
========= genrate cpt by ajax
====================================================================*/
add_action('wp_ajax_nopriv_posttypegenerator', 'wp_cpt_generator');
add_action('wp_ajax_posttypegenerator', 'wp_cpt_generator');
function wp_cpt_generator() {
	// here we are verifying does this request is post back and have correct nonce
    if ( isset($_REQUEST['wpg-security']) && wp_verify_nonce($_REQUEST['wpg-security'])):

    	$function_name 		= ifset($_POST, 'function_name');
		$cpt_name 			= ifset($_POST, 'cpt_name');
		$text_domain 		= ifset($_POST, 'text_domain');
		
		$plural_name 		= ifset($_POST, 'plural_name');
		$singular_name 		= ifset($_POST, 'singular_name');
		$description 		= ifset($_POST, 'description');
		$taxonomies 		= ifset($_POST, 'taxonomies');
		$hierarchical 		= ifset($_POST, 'hierarchical', 'false');
		
		$supports 			= $_POST['supports'] ? implode("', '", $_POST['supports']) : '';
		$exclude_from_search 			 = ifset($_POST, 'exclude_from_search', 'false');
		$can_export 					 = ifset($_POST, 'can_export');
		$delete_with_user 				 = ifset($_POST, 'delete_with_user');
		$has_archive 					 = isset($_POST['has_archive']) ? ($_POST['has_archive']=='custom' ? "'".$_POST['custom_archive_slug']."'" : $_POST['has_archive']) : '';
		
		$public 						 = ifset($_POST, 'public');
		$show_ui 						 = ifset($_POST, 'show_ui');
		$show_in_menu 					 = ifset($_POST, 'show_in_menu');
		$menu_position 					 = ifset($_POST, 'menu_position');
		$menu_icon 						 = ifset($_POST, 'menu_icon');
		$show_in_admin_bar 				 = ifset($_POST, 'show_in_admin_bar');
		$show_in_nav_menus 				 = ifset($_POST, 'show_in_nav_menus');
		
		$query_var 						 = ifset($_POST, 'query_var');
		$custom_query_variable 			 = ifset($_POST, 'custom_query_variable');
		$publicly_queryable 			 = ifset($_POST, 'publicly_queryable');

		// Rewrite functionality
		$rewrite 						 = ifset($_POST, 'rewrite');
		$rewrite_slug 					 = ifset($_POST, 'rewrite_slug');
		$rewrite_with_front 			 = ifset($_POST, 'rewrite_with_front');
		$rewrite_pages 					 = ifset($_POST, 'rewrite_pages');
		$rewrite_feeds 					 = ifset($_POST, 'rewrite_feeds');

		// Capabilities functionality
		$capabilities 					 = ifset($_POST, 'capabilities');
		$capability_type 				 = ifset($_POST, 'capability_type');
		$capabilities_read_post 		 = ifset($_POST, 'capabilities_read_post');
		$capabilities_read_private_posts = ifset($_POST, 'capabilities_read_private_posts');
		$capabilities_publish_posts 	 = ifset($_POST, 'capabilities_publish_posts');
		$capabilities_delete_post 		 = ifset($_POST, 'capabilities_delete_post');
		$capabilities_edit_post 		 = ifset($_POST, 'capabilities_edit_post');
		$capabilities_edit_posts 		 = ifset($_POST, 'capabilities_edit_posts');
		$capabilities_edit_others_posts  = ifset($_POST, 'capabilities_edit_others_posts');

		// Rest Api functionality
		$show_in_rest 					 = ifset($_POST, 'show_in_rest', 'true');
		$rest_base 						 = ifset($_POST, 'rest_base');
		$rest_controller_class 			 = ifset($_POST, 'rest_controller_class');
    	
    	// Read the content of the template file
		$templateContent = file_get_contents(dirname(__FILE__) . '/generators/templates/cpt.php');

		// Replace placeholders in the template with form data
		$templateContent = str_replace('{{function_name}}', $function_name, $templateContent);
		$templateContent = str_replace('{{cpt_name}}', $cpt_name, $templateContent);
		$templateContent = str_replace('{{text_domain}}', $text_domain, $templateContent);

		$templateContent = str_replace('{{plural_name}}', $plural_name, $templateContent);
		$templateContent = str_replace('{{singular_name}}', $singular_name, $templateContent);
		$templateContent = str_replace('{{description}}', $description, $templateContent);
		$templateContent = str_replace('{{taxonomies}}', $taxonomies, $templateContent);
		$templateContent = str_replace('{{hierarchical}}', $hierarchical, $templateContent);

		$templateContent = str_replace('{{public}}', $public, $templateContent);
		$templateContent = str_replace('{{show_ui}}', $show_ui, $templateContent);
		$templateContent = str_replace('{{show_in_menu}}', $show_in_menu, $templateContent);
		$templateContent = str_replace('{{menu_position}}', $menu_position, $templateContent);
		$templateContent = str_replace('{{menu_icon}}', $menu_icon, $templateContent);
		$templateContent = str_replace('{{show_in_admin_bar}}', $show_in_admin_bar, $templateContent);
		$templateContent = str_replace('{{show_in_nav_menus}}', $show_in_nav_menus, $templateContent);

		$templateContent = str_replace('{{can_export}}', $can_export, $templateContent);
		$templateContent = str_replace('{{has_archive}}', $has_archive, $templateContent);
		$templateContent = str_replace('{{exclude_from_search}}', $exclude_from_search, $templateContent);

		$templateContent = str_replace('{{publicly_queryable}}', $publicly_queryable, $templateContent);
		$templateContent = str_replace('{{capability_type}}', $capability_type, $templateContent);

		// Rewrite functionality
		// $templateContent = str_replace('{{rewrite}}', $rewrite, $templateContent);
		$templateContent = str_replace('{{rewrite_slug}}', $rewrite_slug, $templateContent);
		$templateContent = str_replace('{{rewrite_with_front}}', $rewrite_with_front, $templateContent);
		$templateContent = str_replace('{{rewrite_pages}}', $rewrite_pages, $templateContent);
		$templateContent = str_replace('{{rewrite_feeds}}', $rewrite_feeds, $templateContent);

		// Conditionally include the rewrite rule
        if ($delete_with_user) {
            $deleteRule = "'delete_with_user'	=> ".$delete_with_user.",";
        } else {
            $deleteRule = '';
        }
        $templateContent = str_replace('{{Delete_With_User}}', $deleteRule, $templateContent);

		// Conditionally include the rewrite rule
        if ($supports) {
            $suportsRule = "'supports'		=> array('".$supports."'),";
        } else {
            $suportsRule = '';
        }
        $templateContent = str_replace('{{supports}}', $suportsRule, $templateContent);

        if ($rewrite=='custom') {
	$rewrite_array = "
	\$rewrite = array(
		'slug'			=> '".$rewrite_slug."',
		'with_front'		=> '".$rewrite_with_front."',
		'feeds'			=> '".$rewrite_feeds."',
		'pages'          	=> '".$rewrite_pages."',
	);";

        	$rewriteRule = "'rewrite'		=> \$rewrite,";
        } elseif ($rewrite=='false'){
        	$rewrite_array = "";
        	$rewriteRule = "'rewrite'		=> ".$rewrite;
        } else {
        	$rewrite_array = "";
        	$rewriteRule = "'rewrite'		=> true";
        }

        $templateContent = str_replace('{{rewriteArray}}', $rewrite_array, $templateContent);
        $templateContent = str_replace('{{rewrite}}', $rewriteRule, $templateContent);

		// Save the updated content to a new file or overwrite the template file
		file_put_contents('updated_template.php', $templateContent);

		// Return the updated content
		echo $templateContent;
	endif;
	exit;
}


/*===================================================================
========= genrate wp_query by ajax
====================================================================*/
add_action('wp_ajax_nopriv_querygenerator', 'wp_query_generator_callback');
add_action('wp_ajax_querygenerator', 'wp_query_generator_callback');
function wp_query_generator_callback()
{
	// here we are verifying does this request is post back and have correct nonce
    if ( isset($_REQUEST['wpg-security']) && wp_verify_nonce($_REQUEST['wpg-security'])):

    	$query_name 	= isset($_POST['query_name']) ? $_POST['query_name'] : '';
    	$the_loop 		= isset($_POST['the_loop']) ? $_POST['the_loop'] : '';
    	$text_domain 	= isset($_POST['text_domain']) ? $_POST['text_domain'] : '';
    	
    	$q_post_id 		= isset($_POST['q_post_id']) ? $_POST['q_post_id'] : '';
    	$q_name 		= isset($_POST['q_name']) ? $_POST['q_name'] : '';
    	$q_page_id 		= isset($_POST['q_page_id']) ? $_POST['q_page_id'] : '';
    	$q_pagename		= isset($_POST['q_pagename']) ? $_POST['q_pagename'] : '';
    	$parent			= isset($_POST['parent']) ? $_POST['parent'] : '';

    	$q_cat			= isset($_POST['q_cat']) ? $_POST['q_cat'] : '';
    	$q_category_name	= isset($_POST['q_category_name']) ? $_POST['q_category_name'] : '';
    	$q_category__in		= isset($_POST['q_category__in']) ? $_POST['q_category__in'] : '';
    	$q_category__not_in	= isset($_POST['q_category__not_in']) ? $_POST['q_category__not_in'] : '';

    	$post_type		= isset($_POST['post_type']) ? $_POST['post_type'] : '';
    	$post_status	= isset($_POST['post_status']) ? $_POST['post_status'] : '';
    	
    	$has_password	= isset($_POST['has_password']) ? $_POST['has_password'] : '';
    	$post_password	= isset($_POST['post_password']) ? $_POST['post_password'] : '';
    	
    	$q_author_id	= isset($_POST['q_author_id']) ? $_POST['q_author_id'] : '';
    	$q_author_name	= isset($_POST['q_author_name']) ? $_POST['q_author_name'] : '';
    	$q_author__in	= isset($_POST['author__in']) ? $_POST['author__in'] : '';
    	$q_author__not_in	= isset($_POST['author__not_in']) ? $_POST['author__not_in'] : '';
    	
    	$search			= isset($_POST['search']) ? $_POST['search'] : '';
    	
    	$use_pagination	= isset($_POST['use_pagination']) ? $_POST['use_pagination'] : '';
    	$paged			= isset($_POST['paged']) ? $_POST['paged'] : '';
    	$posts_per_page	= isset($_POST['posts_per_page']) ? $_POST['posts_per_page'] : '';
    	$posts_per_archive_page	= isset($_POST['posts_per_archive_page']) ? $_POST['posts_per_archive_page'] : '';
    	$ignore_sticky_posts	= isset($_POST['ignore_sticky_posts']) ? $_POST['ignore_sticky_posts'] : '';
    	$offset			= isset($_POST['offset']) ? $_POST['offset'] : '';
    	
    	$order			= isset($_POST['order']) ? $_POST['order'] : '';
    	$orderby		= isset($_POST['orderby']) ? $_POST['orderby'] : '';
    	
    	$q_show_relation = isset($_POST['q_show_relation']) ? $_POST['q_show_relation'] : 'false';
    	$q_relation		= isset($_POST['q_relation']) ? $_POST['q_relation'] : '';

    	$taxonomy1		= isset($_POST['taxonomy1']) ? $_POST['taxonomy1'] : '';
    	$terms1			= isset($_POST['terms1']) ? $_POST['terms1'] : '';
    	$field1			= isset($_POST['field1']) ? $_POST['field1'] : '';
    	$operator1		= isset($_POST['operator1']) ? $_POST['operator1'] : '';

    	$taxonomy2		= isset($_POST['taxonomy2']) ? $_POST['taxonomy2'] : '';
    	$terms2			= isset($_POST['terms2']) ? $_POST['terms2'] : '';
    	$field2			= isset($_POST['field2']) ? $_POST['field2'] : '';
    	$operator2		= isset($_POST['operator2']) ? $_POST['operator2'] : '';

    	$taxonomy3		= isset($_POST['taxonomy3']) ? $_POST['taxonomy3'] : '';
    	$terms3			= isset($_POST['terms3']) ? $_POST['terms3'] : '';
    	$field3			= isset($_POST['field3']) ? $_POST['field3'] : '';
    	$operator3		= isset($_POST['operator3']) ? $_POST['operator3'] : '';

    	$taxonomy4		= isset($_POST['taxonomy4']) ? $_POST['taxonomy4'] : '';
    	$terms4			= isset($_POST['terms4']) ? $_POST['terms4'] : '';
    	$field4			= isset($_POST['field4']) ? $_POST['field4'] : '';
    	$operator4		= isset($_POST['operator4']) ? $_POST['operator4'] : '';

echo "
// WP_Query arguments
\$args = array(";

	if($q_post_id):
		echo "\n\t" ."'p'			=> '".$q_post_id."',";
	endif;

	if($q_name):
		echo "\n\t" ."'name'			=> '".$q_name."',";
	endif;

	if($q_page_id):
		echo "\n\t" ."'page_id'		=> '".$q_page_id."',";
	endif;

	if($q_pagename):
		echo "\n\t" ."'pagename'		=> '".$q_pagename."',";
	endif;

	if($parent):
		echo "\n\t" ."'post_parent'		=> '".$parent."',";
	endif;

	if($q_cat):
		echo "\n\t" ."'cat'			=> ".$q_cat.",";
	endif;

	if($q_category_name):
		echo "\n\t" ."'category_name'		=> '".$q_category_name."',";
	endif;

	if($q_category__in):
		echo "\n\t" ."'category__in'		=> array( ".$q_category__in." ),";
	endif;

	if($q_category__not_in):
		echo "\n\t" ."'category__not_in'	=> array( ".$q_category__not_in." ),";
	endif;

	if($post_type):
		echo "\n\t" ."'post_type'		=> array( '".$post_type."' ),";
	endif;

	if($post_status):
		echo "\n\t" ."'post_status'		=> array( '".$post_status."' ),";
	endif;

	if($has_password=='true'):
		echo "\n\t" ."'has_password'		=> '".$has_password."',";
	endif;

	if($has_password=='true' && $post_password):
		echo "\n\t" ."'post_password'		=> '".$post_password."',";
	endif;

	if($q_author_id):
		echo "\n\t" ."'author'		=> '".$q_author_id."',";
	endif;

	if($q_author_name):
		echo "\n\t" ."'author_name'		=> '".$q_author_name."',";
	endif;

	if($q_author__in):
		echo "\n\t" ."'author__in'		=> array( '".$q_author__in."' ),";
	endif;

	if($q_author__not_in):
		echo "\n\t" ."'author__not_in'	=> array( '".$q_author__not_in."' ),";
	endif;

	if($search):
		echo "\n\t" ."'s'			=> '".$search."',";
	endif;

	if($use_pagination == 'true'):
		echo "\n\t" ."'nopaging'		=> '".$use_pagination."',";
	endif;

	if($paged):
		echo "\n\t" ."'paged'			=> '".$paged."',";
	endif;

	if($posts_per_page):
		echo "\n\t" ."'posts_per_page'	=> '".$posts_per_page."',";
	endif;

	if($posts_per_archive_page):
		echo "\n\t" ."'posts_per_archive_page' => '".$posts_per_archive_page."',";
	endif;

	if($ignore_sticky_posts == 'true'):
		echo "\n\t" ."'ignore_sticky_posts'	=> '".$ignore_sticky_posts."',";
	endif;

	if($offset):
		echo "\n\t" ."'offset'		=> '".$offset."',";
	endif;

	if($order):
		echo "\n\t" ."'order'			=> '".$order."',";
	endif;

	if($orderby):
		echo "\n\t" ."'orderby'		=> '".$orderby."',";
	endif;

	if($q_show_relation == 'true'):
		echo "\n\t" ."'tax_query'		=> array(";
		echo $q_relation ? "\n\t\t" ."'relation'	=> '".$q_relation."'," : '';

		if($taxonomy1):
		echo "\n\t\tarray(
			'taxonomy' => '".$taxonomy1."',
			'field'    => '".$field1."',
			'terms'    => '".$terms1."',";
			echo $operator1 ? "\n\t\t\t" ."'operator' => '".$operator1."'," : '';
		echo "\n\t\t),";
		endif;

		if($taxonomy2):
		echo "\n\t\tarray(
			'taxonomy' => '".$taxonomy2."',
			'field'    => '".$field2."',
			'terms'    => '".$terms2."',";
			echo $operator2 ? "\n\t\t\t" ."'operator' => '".$operator2."'," : '';
		echo "\n\t\t),";
		endif;

		if($taxonomy3):
		echo "\n\t\tarray(
			'taxonomy' => '".$taxonomy3."',
			'field'    => '".$field3."',
			'terms'    => '".$terms3."',";
			echo $operator3 ? "\n\t\t\t" ."'operator' => '".$operator3."'," : '';
		echo "\n\t\t),";
		endif;

		if($taxonomy4):
		echo "\n\t\tarray(
			'taxonomy' => '".$taxonomy4."',
			'field'    => '".$field4."',
			'terms'    => '".$terms4."',";
			echo $operator4 ? "\n\t\t\t" ."'operator' => '".$operator4."'," : '';
		echo "\n\t\t),";
		endif;

	echo "\n\t),";
	endif;

echo "\n);

// The Query
".$query_name." = new WP_Query( \$args );\n";

if ($the_loop=='true'):
echo "
// The Loop
if ( ".$query_name."->have_posts() ) {
	while ( ".$query_name."->have_posts() ) {
		" .$query_name."->the_post();
		echo get_the_title(); // get the post title
	}
} else {
	// no posts found
}

// Restore original Post Data
wp_reset_postdata();";
endif;

	endif;
	exit;
}


/*===================================================================
========= genrate wp_query by ajax
====================================================================*/
add_action('wp_ajax_nopriv_settingpagegenerator', 'wp_setting_page_generator_callback');
add_action('wp_ajax_settingpagegenerator', 'wp_setting_page_generator_callback');
function wp_setting_page_generator_callback() {
	
	// here we are verifying does this request is post back and have correct nonce
    if ( isset($_REQUEST['wpg-security']) && wp_verify_nonce($_REQUEST['wpg-security'])):

    	$class_name		= ifset($_POST, 'class_name', 'Custom_Settings_Page');
    	$settings_group = ifset($_POST, 'settings_group', 'Custom_Settings_Page');
    	$settings		= ifset($_POST, 'settings', 'Custom_Settings_Page');
    	$text_domain	= ifset($_POST, 'text_domain', 'text_domain');

    	$menu_type		= ifset($_POST, 'menu_type');
    	$submenu		= ifset($_POST, 'submenu');
    	$page_title 	= ifset($_POST, 'page-title', 'Theme Options');
    	$menu_title 	= ifset($_POST, 'menu-title', 'Theme Options');
    	$capability 	= ifset($_POST, 'capability', 'manage_options');
    	$menu_slug 		= ifset($_POST, 'menu_slug');
    	$menu_slug 		= $menu_slug != '' ? $menu_slug : strtolower(str_replace([' '], ['-'], $page_title));
    	$menu_slug 		= $menu_type == 'add_submenu_page' ? $submenu : $menu_slug;
    	$callback 		= ifset($_POST, 'callback', 'theme_options_callback');
    	$menu_icon 		= ifset($_POST, 'menu_icon', 'dashicons-admin-tools');
    	$menu_position 	= ifset($_POST, 'menu_position', 2);
    	

    	// Read the content of the template file
		$templateContent = file_get_contents(dirname(__FILE__) . '/generators/templates/setting.php');

		// Replace placeholders in the template with form data
		$templateContent = str_replace('{{class_name}}', $class_name, $templateContent);
		$templateContent = str_replace('{{settings_group}}', $settings_group, $templateContent);
		$templateContent = str_replace('{{settings}}', $settings, $templateContent);
		$templateContent = str_replace('{{text_domain}}', $text_domain, $templateContent);

		$templateContent = str_replace('{{menu_type}}', $menu_type, $templateContent);
		$templateContent = str_replace('{{page_title}}', $page_title, $templateContent);
		$templateContent = str_replace('{{menu_title}}', $menu_title, $templateContent);
		$templateContent = str_replace('{{capability}}', $capability, $templateContent);
		$templateContent = str_replace('{{menu_slug}}', $menu_slug, $templateContent);
		$templateContent = str_replace('{{menu_icon}}', $menu_icon, $templateContent);
		$templateContent = str_replace('{{menu_position}}', $menu_position, $templateContent);
		$templateContent = str_replace('{{callback}}', $callback, $templateContent);

		if (in_array($menu_type, ['add_menu_page'])) {
			$templateContent = str_replace('{{add_menu}}', $menu_type.'($page_title, $menu_title, $capability, $slug, $callback, $icon, $position);', $templateContent);
		} else {
			$templateContent = str_replace('{{add_menu}}', $menu_type.'($page_title, $menu_title, $capability, $slug, $callback, $position);', $templateContent);
		}

		$fields = '';
		if (isset($_POST['fieldtype']) && $_POST['fieldtype']) {
			foreach ($_POST['fieldtype'] as $key => $value) {
		    	$fieldtype		= isset($_POST['fieldtype'][$key]) ? $_POST['fieldtype'][$key] : '';
		    	$id				= isset($_POST['id'][$key]) ? $_POST['id'][$key] : '';
		    	$label			= isset($_POST['label'][$key]) ? $_POST['label'][$key] : '';
		    	$placeholder	= isset($_POST['placeholder'][$key]) ? $_POST['placeholder'][$key] : '';
		    	$description 	= isset($_POST['description'][$key]) ? $_POST['description'][$key] : '';
		    	$options 		= isset($_POST['options'][$key]) ? $_POST['options'][$key] : '';

		    	$options_array = [];
		    	if ($options) {
		    		$opt_array = explode("\n", $options);

		    		foreach ($opt_array as $key => $value) {
		    			$opt_childs = explode('|', $value);
		    			$options_array[] = "'".trim($opt_childs[0])."' => '". trim($opt_childs[1]) . "'";
		    		}
		    	}

		    	if (in_array($fieldtype, ["checkboxes", "radio", "select"])) {
	    	$fields.= "array(
				'type' => '".$fieldtype."',
				'id' => '".$id."',
				'label' => '".$label."',
				'desc' => '".$description."',
				'options' => array(";
					if ($options_array) {
						$fields.= implode(',', $options_array);
					}
			$fields.= "),
				'section' => 'themeoptions_section',
			),";
		    	} else {
	    	$fields.= "array(
				'type' => '".$fieldtype."',
				'id' => '".$id."',
				'label' => '".$label."',
				'placeholder' => '".$placeholder."',
				'desc' => '".$description."',
				'section' => 'themeoptions_section',
			),";
		    	}
			}
		}
			
		$templateContent = str_replace('{{fields}}', $fields, $templateContent);

		// Save the updated content to a new file or overwrite the template file
		file_put_contents('updated_template.php', $templateContent);

		// Return the updated content
		echo $templateContent;
	endif;
	exit;
}