<?php
defined( 'ABSPATH' ) or die( 'No script kiddies please!' );

add_shortcode('wp_query_generator_shortcode', 'wp_query_generator');
function wp_query_generator() {
	$nav_list = array(
		'tab0' => array(
			'tab' => 'tab_info',
			'icon' => 'fa-solid fa-circle-info',
			'label' => 'Connect',
		),
		'tab1' => array(
			'tab' => 'tab_general',
			'icon' => 'fa-solid fa-signs-post',
			'label' => 'General',
		),
		'tab2' => array(
			'tab' => 'tab_post_and_page',
			'icon' => 'fa-solid fa-signs-post',
			'label' => 'Post & Page',
		),
		'tab3' => array(
			'tab' => 'tab_cat',
			'icon' => 'fa-solid fa-signs-post',
			'label' => 'Category',
		),
		'tab4' => array(
			'tab' => 'tab_type_and_status',
			'icon' => 'fa-regular fa-file-lines',
			'label' => 'Type & Status',
		),
		'tab5' => array(
			'tab' => 'tab_password',
			'icon' => 'fa-solid fa-unlock',
			'label' => 'Password',
		),
		'tab6' => array(
			'tab' => 'tab_author',
			'icon' => 'fa-solid fa-user',
			'label' => 'Author',
		),
		'tab7' => array(
			'tab' => 'tab_search ',
			'icon' => 'fa-brands fa-searchengin',
			'label' => 'Search',
		),
		'tab8' => array(
			'tab' => 'tab_pagination',
			'icon' => 'fa-regular fa-file-lines',
			'label' => 'Pagination',
		),
		'tab9' => array(
			'tab' => 'tab_order',
			'icon' => 'fa-solid fa-arrow-up-a-z',
			'label' => 'Order',
		),
		'tab10' => array(
			'tab' => 'tab_taxonomy',
			'icon' => 'fa-regular fa-file-lines',
			'label' => 'Taxonomy',
		),
	);
	?>

    <script type="text/javascript">
    jQuery(document).on('ready', function() {
    	jQuery('.tabs_item').on('click', function() {
			var tab = jQuery(this).data('href');
			
    		jQuery('.tabs_item').removeClass('tab__is-active');
    		jQuery(this).addClass('tab__is-active');
			
    		jQuery('.tab-pane').removeClass('active');
    		jQuery('#'+tab).addClass('active');
    	});
    });
    </script>

	<div class="wp-generator">
		<form name="generator_form" id="generator_form" action="" method="post">
		    <div class="wp-generator-tabs">
		        
				<div class="nav">
			        <ul class="tabs">
			        	<?php $i = 1; ?>
			        	<?php foreach ($nav_list as $id => $list): ?>
				            <li id="<?= $id ?>" class="tabs_item tab tab__bookmark <?= $i==1?'tab__is-active':'' ?>" data-href="<?= $list['tab'] ?>"> 
				                <i class="<?= $list['icon'] ?> tab_icon"></i>
				                <span class="tab_name"> <?= $list['label'] ?></span>
				            </li>
				            <?php $i++; ?>
				        <?php endforeach; ?>
			        </ul>
			    </div>

		        <div id="generator_Content" class="tab-content" aria-live="polite">
		            <div class="tab-pane fade active in" id="tab_info" role="tabpanel" aria-labelledby="tab0" aria-hidden="false" tabindex="0">
	                    <div class="field-group-info grid gap-4 md-grid-cols-2 lg-grid-cols-3">
	                        <div class="field-group-col">
	                            <p><strong>Overview</strong></p>
	                            <p>Use this tool to create custom code for WordPress Query with <a href="https://developer.wordpress.org/reference/classes/wp_query/" target="_blank">WP_Query</a> class.</p>
	                        </div>
	                        <div class="field-group-col">
	                            <p><strong>Usage</strong></p>
	                            <ul>
	                                <li>Fill in the user-friendly form.</li>
	                                <li>Click the “Update Code” button.</li>
	                                <li>Copy the code to your project.</li>
	                            </ul>
	                        </div>
	                        <div class="field-group-col">
	                            <p><strong>Examples</strong></p>
	                            <p>If you are still learning how to use this tool, check out the following examples:</p>
<!-- 	                            <ul>
	                                <li><a href="?cpt=testimonials">Testimonials</a></li>
	                                <li><a href="?cpt=property">Property</a></li>
	                                <li><a href="?cpt=team">Team members</a></li>
	                            </ul> -->
	                        </div>
	                    </div>
		            </div>

		            <div class="tab-pane fade" id="tab_general" role="tabpanel" aria-labelledby="tab1" aria-hidden="true" tabindex="0">
		            	<div class="field-group-info grid gap-4 md-grid-cols-2 lg-grid-cols-3">
			                <div class="field-group-col">
			                    <div class="form-group query_name">
			                        <label title="Query Variable Name<">Query Variable Name</label>
			                        <input type="text" class="form-control" name="query_name" value="$query" />
			                        <span class="help-block">The variable used in the code.</span>
			                    </div>
			                </div>
			                <div class="field-group-col">
			                    <div class="form-group the_loop">
			                        <label title="Show The Loop">Show The Loop</label>
			                        <select class="form-control" name="the_loop" id="the_loop">
			                            <option value="false">No</option>
			                            <option value="true">Yes</option>
			                        </select>
			                        <span class="help-block">The post type name/slug. Used for various queries for post type content.</span>
			                    </div>
			                </div>
			                <div class="field-group-col">
			                    <div class="form-group text_domain">
			                        <label title="Text Domain.">Text Domain</label>
			                        <input type="text" class="form-control" name="text_domain" value="text_domain" />
			                        <span class="help-block">Translation file <a href="https://developer.wordpress.org/reference/functions/load_textdomain/" target="_blank">Text Domain</a>. Optional.</span>
			                    </div>
			                </div>
			            </div>
		            </div>

		            <div class="tab-pane fade" id="tab_post_and_page" role="tabpanel" aria-labelledby="tab2" aria-hidden="true" tabindex="0">
		            	<div class="field-group-info grid gap-4 md-grid-cols-2 lg-grid-cols-3">
			                <div class="field-group-col">
			                    <div class="form-group q_post_id">
			                        <label title="Post ID">Post ID</label>
			                        <input type="text" class="form-control" name="q_post_id" value="" >
			                        <span class="help-block">Display post by ID.</span>
			                    </div>
			                    <div class="form-group q_name">
			                        <label title="Post Name">Post Name</label>
			                        <input type="text" class="form-control" name="q_name" value="" >
			                        <span class="help-block">Display post by slugs.</span>
			                    </div>
			                </div>
			                <div class="field-group-col">
			                    <div class="form-group q_page_id">
			                        <label title="Page ID">Page ID</label>
			                        <input type="text" class="form-control" name="q_page_id" value="" >
			                        <span class="help-block">Display page by ID.</span>
			                    </div>
			                    <div class="form-group q_pagename">
			                        <label title="Page Name">Page Name</label>
			                        <input type="text" class="form-control" name="q_pagename" value="" >
			                        <span class="help-block">Display page by slugs.</span>
			                    </div>
			                </div>
			                <div class="field-group-col">
			                    <div class="form-group parent">
			                        <label title="Parent">Parent</label>
			                        <input type="text" class="form-control" name="parent" value="" >
			                        <span class="help-block">Display child-pages of a parent-page id.</span>
			                    </div>
			                </div>
			            </div>
		            </div>

		            <div class="tab-pane fade" id="tab_cat" role="tabpanel" aria-labelledby="tab3" aria-hidden="true" tabindex="0">
		            	<div class="field-group-info grid gap-4 md-grid-cols-2 lg-grid-cols-3">
			                <div class="field-group-col">
			                    <div class="form-group q_cat">
			                        <label title="Category ID">Category ID</label>
			                        <input type="number" class="form-control" name="q_cat" value="" >
			                        <span class="help-block">Display post by category id.</span>
			                    </div>
			                    <div class="form-group q_category_name">
			                        <label title="Category Name">Category Name</label>
			                        <input type="text" class="form-control" name="q_category_name" value="" >
			                        <span class="help-block">Display post by category slug. Can also insert multiple slug. Single string or comma seperated. e.g. staff,news</span>
			                    </div>
			                </div>
			                <div class="field-group-col">
			                    <div class="form-group q_category__in">
			                        <label title="Multiple Category ID">Multiple Category ID</label>
			                        <input type="text" class="form-control" name="q_category__in" value="" >
			                        <span class="help-block">Display posts that are in multiple categories. e.g. 1,2</span>
			                    </div>
			                    <div class="form-group q_category__not_in">
			                        <label title="Exclude Category ID">Exclude Category ID</label>
			                        <input type="text" class="form-control" name="q_category__not_in" value="" >
			                        <span class="help-block">Exclude posts by multiple categories. e.g. 1,2</span>
			                    </div>
			                </div>
			            </div>
		            </div>

		            <div class="tab-pane fade" id="tab_type_and_status" role="tabpanel" aria-labelledby="tab4" aria-hidden="true" tabindex="0">
		            	<div class="field-group-info grid gap-4 md-grid-cols-2 lg-grid-cols-3">
			                <div class="field-group-col">
			                    <div class="form-group post_type">
			                        <label title="Post Type">Post Type</label>
			                        <input type="text" class="form-control" name="post_type" value="" >
			                        <span class="help-block">Display posts by <a href="https://codex.wordpress.org/Post_Types" target="_blank">post type</a>.</span>
			                    </div>
			                </div>
			                <div class="field-group-col">
			                    <div class="form-group post_status">
			                        <label title="Post Status">Post Status</label>
			                        <input type="text" class="form-control" name="post_status" value="" >
			                        <span class="help-block">Display posts by <a href="https://codex.wordpress.org/Post_Status" target="_blank">post status</a>.</span>
			                    </div>
			                </div>
			            </div>
		            </div>

		            <div class="tab-pane fade" id="tab_password" role="tabpanel" aria-labelledby="tab5" aria-hidden="true" tabindex="0">
		            	<div class="field-group-info grid gap-4 md-grid-cols-2 lg-grid-cols-3">
			                <div class="field-group-col">
			                    <div class="form-group has_password">
			                        <label title="Has Password">Has Password</label>
			                        <select class="form-control" name="has_password" id="has_password">
			                            <option value="false">No</option>
			                            <option value="true">Yes</option>
			                        </select>
			                        <span class="help-block">Display password protected posts.</span>
			                    </div>
			                </div>
			                <div class="field-group-col">
			                    <div class="form-group post_password">
			                        <label title="Post Password">Post Password</label>
			                        <input type="text" class="form-control" name="post_password" value="" >
			                        <span class="help-block">Display posts with a particular password.</span>
			                    </div>
			                </div>
			            </div>
		            </div>

		            <div class="tab-pane fade" id="tab_author" role="tabpanel" aria-labelledby="tab6" aria-hidden="true" tabindex="0">
		            	<div class="field-group-info grid gap-4 md-grid-cols-2 lg-grid-cols-3">
			                <div class="field-group-col">
			                    <div class="form-group q_author_id">
			                        <label title="Author ID">Author ID</label>
			                        <input type="number" class="form-control" name="q_author_id" value="" >
			                        <span class="help-block">Display posts by author ID</span>
			                    </div>
			                </div>
			                <div class="field-group-col">
			                    <div class="form-group q_author_name">
			                        <label title="Author Name">Author Name</label>
			                        <input type="text" class="form-control" name="q_author_name" value="" >
			                        <span class="help-block">Display posts by author 'user_nicename'.</span>
			                    </div>
			                </div>
			                <div class="field-group-col">
			                    <div class="form-group author__in">
			                        <label title="Multiple Author Id">Author ID In</label>
			                        <input type="text" class="form-control" name="author__in" value="" >
			                        <span class="help-block">Display posts from multiple authors. Enter Multiple id coma seprated. e.g. 1,2</span>
			                    </div>
			                </div>
			                <div class="field-group-col">
			                    <div class="form-group author__not_in">
			                        <label title="Exclude Multiple Author Id">Author ID Not In</label>
			                        <input type="text" class="form-control" name="author__not_in" value="" >
			                        <span class="help-block">Exclude posts from multiple authors. Enter Multiple id coma seprated. e.g. 1,2</span>
			                    </div>
			                </div>
			            </div>
		            </div>

		            <div class="tab-pane fade" id="tab_search" role="tabpanel" aria-labelledby="tab7" aria-hidden="true" tabindex="0">
		            	<div class="field-group-info grid gap-4 md-grid-cols-2 lg-grid-cols-3">
			                <div class="field-group-col">
			                    <div class="form-group q_author_id">
			                        <label title="Search Keyword">Search Keyword</label>
			                        <input type="text" class="form-control" name="search" value="" >
			                        <span class="help-block">Display post by keywords.</span>
			                    </div>
			                </div>
			            </div>
		            </div>

		            <div class="tab-pane fade" id="tab_pagination" role="tabpanel" aria-labelledby="tab8" aria-hidden="true" tabindex="0">
		            	<div class="field-group-info grid gap-4 md-grid-cols-2 lg-grid-cols-3">
			                <div class="field-group-col">
			                    <div class="form-group use_pagination">
			                        <label title="Use Pagination">Use Pagination</label>
			                        <select class="form-control" name="use_pagination" id="use_pagination">
			                            <option value="false">No</option>
			                            <option value="true">Yes</option>
			                        </select>
			                        <span class="help-block">Show all posts or use pagination.</span>
			                    </div>
			                    <div class="form-group paged">
			                        <label title="Paged">Paged</label>
			                        <input type="text" class="form-control" name="paged" value="" >
			                        <span class="help-block">Show posts in page number X.</span>
			                    </div>
			                </div>
			                <div class="field-group-col">
			                    <div class="form-group posts_per_page">
			                        <label title="Posts per page">Posts per page</label>
			                        <input type="text" class="form-control" name="posts_per_page" value="" >
			                        <span class="help-block">Number of post to show per page.</span>
			                    </div>
			                    <div class="form-group posts_per_archive_page">
			                        <label title="Posts per archive page">Posts per archive page</label>
			                        <input type="text" class="form-control" name="posts_per_archive_page" value="" >
			                        <span class="help-block">Number of post to show per archive page.</span>
			                    </div>
			                </div>
			                <div class="field-group-col">
			                    <div class="form-group ignore_sticky_posts">
			                        <label title="Sticky Post">Sticky Post</label>
			                        <select class="form-control" name="ignore_sticky_posts" id="ignore_sticky_posts">
			                            <option value="false">No</option>
			                            <option value="true">Yes</option>
			                        </select>
			                        <span class="help-block">Show or ignore sticky posts.</span>
			                    </div>
			                    <div class="form-group offset">
			                        <label title="Offset">Offset</label>
			                        <input type="text" class="form-control" name="offset" value="" >
			                        <span class="help-block">Number of post to displace or pass over.</span>
			                    </div>
			                </div>
			            </div>
		            </div>

		            <div class="tab-pane fade" id="tab_order" role="tabpanel" aria-labelledby="tab9" aria-hidden="true" tabindex="0">
		            	<div class="field-group-info grid gap-4 md-grid-cols-2 lg-grid-cols-3">
			                <div class="field-group-col">
			                    <div class="form-group order">
			                        <label title="Order">Order</label>
			                        <select class="form-control" name="order" id="order">
										<option value="">Choose..</option>
			                            <option value="ASC">ASC</option>
			                            <option value="DESC">DESC - Default</option>
			                        </select>
			                        <span class="help-block">Ascending or Descending order.</span>
			                    </div>
			                </div>
			                <div class="field-group-col">
			                    <div class="form-group orderby">
			                        <label title="Order by">Order by</label>
			                        <select class="form-control" name="orderby" id="orderby">
										<option value="">Choose..</option>
										<option value="none">None</option>
										<option value="rand">Random</option>
										<option value="id">ID</option>
										<option value="title">Title</option>
										<option value="name">Slug</option>
										<option value="date">Date - Default</option>
										<option value="modified">Modified Date</option>
										<option value="parent">Parent ID</option>
										<option value="menu_order">Menu Order</option>
										<option value="comment_count">Comment Count</option>
									</select>
			                        <span class="help-block">Sort retrieved posts by.</span>
			                    </div>
			                </div>
			            </div>
		            </div>

		            <div class="tab-pane fade" id="tab_taxonomy" role="tabpanel" aria-labelledby="tab10" aria-hidden="true" tabindex="0">
		            	<div class="field-group-info grid gap-4 md-grid-cols-2 lg-grid-cols-3">
			                <div class="field-group-col">
			                    <div class="form-group order">
			                        <label title="Tax Relation" for="q_show_relation">Show Tax Relation</label>
			                        <select class="form-control" name="q_show_relation" id="q_show_relation">
										<option value="false">No</option>
										<option value="true">Yes</option>
			                        </select>
			                        <span class="help-block">Whether to show or hide Tax Query</span>
			                    </div>
			                </div>
			                <div class="field-group-col">
			                    <div class="form-group order">
			                        <label title="Tax Relation" for="q_relation">Tax Relation</label>
			                        <select class="form-control" name="q_relation" id="q_relation">
										<option value="">Choose...</option>
										<option value="and">AND (default)</option>
										<option value="or">OR</option>
			                        </select>
			                        <span class="help-block">The MySQL keyword used to join the clauses of the query.</span>
			                    </div>
			                </div>
			            </div>
		            	<div class="field-group-info grid gap-4 md-grid-cols-2 lg-grid-cols-4">
			                <div class="field-group-col">
			                    <div class="form-group posts_per_page">
			                        <label title="Taxonomy">Taxonomy</label>
			                        <input type="text" class="form-control" name="taxonomy1" value="" >
			                        <span class="help-block">Taxonomy being queried (e.g. category, post_format, movie).</span>
			                    </div>
			                </div>
			                <div class="field-group-col">
			                    <div class="form-group posts_per_page">
			                        <label title="Terms">Terms</label>
			                        <input type="text" class="form-control" name="terms1" value="" >
			                        <span class="help-block">Term or terms to filter by. Single string or comma seperated.</span>
			                    </div>
			                </div>
			                <div class="field-group-col">
			                    <div class="form-group posts_per_page">
			                        <label title="Field">Field</label>
			                        <select class="form-control" name="field1" id="field1">
										<option selected="" value="">Choose...</option>
										<option value="term_id">term_id (Default)</option>
										<option value="slug">slug</option>
										<option value="name">name</option>
										<option value="term_taxonomy_id">term_taxonomy_id</option>
									</select>
			                        <span class="help-block">Field to match terms against.</span>
			                    </div>
			                </div>
			                <div class="field-group-col">
			                    <div class="form-group posts_per_page">
			                        <label title="Field">Operator</label>
			                        <select class="form-control" name="operator1" id="operator1">
										<option selected="" value="">Choose...</option>
										<option value="AND">AND</option>
										<option value="IN">IN (Default)</option>
										<option value="NOT IN">NOT IN</option>
										<option value="EXISTS">EXISTS</option>
										<option value="NOT EXISTS">NOT EXISTS</option>
									</select>
			                        <span class="help-block">MySQL operator used with terms in the WHERE clause</span>
			                    </div>
			                </div>
			            </div>
		            	<div class="field-group-info grid gap-4 md-grid-cols-2 lg-grid-cols-4">
			                <div class="field-group-col">
			                    <div class="form-group posts_per_page">
			                        <label title="Taxonomy">Taxonomy</label>
			                        <input type="text" class="form-control" name="taxonomy2" value="" >
			                        <span class="help-block">Taxonomy being queried (e.g. category, post_format, movie).</span>
			                    </div>
			                </div>
			                <div class="field-group-col">
			                    <div class="form-group posts_per_page">
			                        <label title="Terms">Terms</label>
			                        <input type="text" class="form-control" name="terms2" value="" >
			                        <span class="help-block">Term or terms to filter by. Single string or comma seperated.</span>
			                    </div>
			                </div>
			                <div class="field-group-col">
			                    <div class="form-group posts_per_page">
			                        <label title="Field">Field</label>
			                        <select class="form-control" name="field2" id="field2">
										<option selected="" value="">Choose...</option>
										<option value="term_id">term_id (Default)</option>
										<option value="slug">slug</option>
										<option value="name">name</option>
										<option value="term_taxonomy_id">term_taxonomy_id</option>
									</select>
			                        <span class="help-block">Field to match terms against.</span>
			                    </div>
			                </div>
			                <div class="field-group-col">
			                    <div class="form-group posts_per_page">
			                        <label title="Field">Operator</label>
			                        <select class="form-control" name="operator2" id="operator2">
										<option selected="" value="">Choose...</option>
										<option value="AND">AND</option>
										<option value="IN">IN (Default)</option>
										<option value="NOT IN">NOT IN</option>
										<option value="EXISTS">EXISTS</option>
										<option value="NOT EXISTS">NOT EXISTS</option>
									</select>
			                        <span class="help-block">MySQL operator used with terms in the WHERE clause</span>
			                    </div>
			                </div>
			            </div>
		            	<div class="field-group-info grid gap-4 md-grid-cols-2 lg-grid-cols-4">
			                <div class="field-group-col">
			                    <div class="form-group posts_per_page">
			                        <label title="Taxonomy">Taxonomy</label>
			                        <input type="text" class="form-control" name="taxonomy3" value="" >
			                        <span class="help-block">Taxonomy being queried (e.g. category, post_format, movie).</span>
			                    </div>
			                </div>
			                <div class="field-group-col">
			                    <div class="form-group posts_per_page">
			                        <label title="Terms">Terms</label>
			                        <input type="text" class="form-control" name="terms3" value="" >
			                        <span class="help-block">Term or terms to filter by. Single string or comma seperated.</span>
			                    </div>
			                </div>
			                <div class="field-group-col">
			                    <div class="form-group posts_per_page">
			                        <label title="Field">Field</label>
			                        <select class="form-control" name="field3" id="field3">
										<option selected="" value="">Choose...</option>
										<option value="term_id">term_id (Default)</option>
										<option value="slug">slug</option>
										<option value="name">name</option>
										<option value="term_taxonomy_id">term_taxonomy_id</option>
									</select>
			                        <span class="help-block">Field to match terms against.</span>
			                    </div>
			                </div>
			                <div class="field-group-col">
			                    <div class="form-group posts_per_page">
			                        <label title="Field">Operator</label>
			                        <select class="form-control" name="operator3" id="operator3">
										<option selected="" value="">Choose...</option>
										<option value="AND">AND</option>
										<option value="IN">IN (Default)</option>
										<option value="NOT IN">NOT IN</option>
										<option value="EXISTS">EXISTS</option>
										<option value="NOT EXISTS">NOT EXISTS</option>
									</select>
			                        <span class="help-block">MySQL operator used with terms in the WHERE clause</span>
			                    </div>
			                </div>
			            </div>
		            	<div class="field-group-info grid gap-4 md-grid-cols-2 lg-grid-cols-4">
			                <div class="field-group-col">
			                    <div class="form-group posts_per_page">
			                        <label title="Taxonomy">Taxonomy</label>
			                        <input type="text" class="form-control" name="taxonomy4" value="" >
			                        <span class="help-block">Taxonomy being queried (e.g. category, post_format, movie).</span>
			                    </div>
			                </div>
			                <div class="field-group-col">
			                    <div class="form-group posts_per_page">
			                        <label title="Terms">Terms</label>
			                        <input type="text" class="form-control" name="terms4" value="" >
			                        <span class="help-block">Term or terms to filter by. Single string or comma seperated.</span>
			                    </div>
			                </div>
			                <div class="field-group-col">
			                    <div class="form-group posts_per_page">
			                        <label title="Field">Field</label>
			                        <select class="form-control" name="field4" id="field4">
										<option selected="" value="">Choose...</option>
										<option value="term_id">term_id (Default)</option>
										<option value="slug">slug</option>
										<option value="name">name</option>
										<option value="term_taxonomy_id">term_taxonomy_id</option>
									</select>
			                        <span class="help-block">Field to match terms against.</span>
			                    </div>
			                </div>
			                <div class="field-group-col">
			                    <div class="form-group posts_per_page">
			                        <label title="Field">Operator</label>
			                        <select class="form-control" name="operator4" id="operator4">
										<option selected="" value="">Choose...</option>
										<option value="AND">AND</option>
										<option value="IN">IN (Default)</option>
										<option value="NOT IN">NOT IN</option>
										<option value="EXISTS">EXISTS</option>
										<option value="NOT EXISTS">NOT EXISTS</option>
									</select>
			                        <span class="help-block">MySQL operator used with terms in the WHERE clause</span>
			                    </div>
			                </div>
			            </div>
		            </div>

		        </div>
		    </div>
		    <div class="btn-box">
		        <input type="hidden" name="generator" id="generator" value="wp_query" />
		        <input type="hidden" name="action" id="action" value="querygenerator" />
                <input type="hidden" name="wpg-security" value="<?php echo wp_create_nonce()?>"/>
		        <button type="submit" class="btn btn-success" id="update-snippet" data-loading-text="Updating …">Update Code</button>
		    </div>
		</form>
	</div>

	<div class="section-code">
		<pre class="prettyprint">
			<?php 
			$type = isset($_GET['query']) ? $_GET['query'] : '';
			echo load_wp_query_templates($type);
			?>
		</pre>
	</div>
	<?php
}