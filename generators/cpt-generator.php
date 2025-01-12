<?php
defined( 'ABSPATH' ) or die( 'No script kiddies please!' );

add_shortcode('cpt_generator_shortcode', 'cpt_generator');
function cpt_generator() {
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
			'tab' => 'tab_post_type',
			'icon' => 'fa-regular fa-file-lines',
			'label' => 'Post Type',
		),
		'tab4' => array(
			'tab' => 'tab_options',
			'icon' => 'fa-solid fa-gears',
			'label' => 'Options',
		),
		'tab5' => array(
			'tab' => 'tab_visibility',
			'icon' => 'fa-solid fa-eye',
			'label' => 'Visibility',
		),
		'tab6' => array(
			'tab' => 'tab_query',
			'icon' => 'fa-solid fa-file-code',
			'label' => 'Query',
		),
		'tab7' => array(
			'tab' => 'tab_permalinks',
			'icon' => 'fa-solid fa-link',
			'label' => 'Permalinks',
		),
		'tab8' => array(
			'tab' => 'tab_capabilities',
			'icon' => 'fa-solid fa-toolbox',
			'label' => 'Capabilities',
		),
		'tab9' => array(
			'tab' => 'tab_rest_api',
			'icon' => 'fa-solid fa-square-poll-horizontal',
			'label' => 'Rest API',
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
	                            <p>
	                                Use this tool to create custom code for <a href="https://wordpress.org/support/article/post-types/" target="_blank">Post Types</a> with
	                                <a href="https://developer.wordpress.org/reference/functions/register_post_type/" target="_blank">register_post_type()</a> function.
	                            </p>
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
	                            <ul>
	                                <li><a href="?cpt=testimonials">Testimonials</a></li>
	                                <li><a href="?cpt=property">Property</a></li>
	                                <li><a href="?cpt=team">Team members</a></li>
	                            </ul>
	                        </div>
	                    </div>
		            </div>

		            <div class="tab-pane fade" id="tab_general" role="tabpanel" aria-labelledby="tab1" aria-hidden="true" tabindex="0">
		            	<div class="field-group-info grid gap-4 md-grid-cols-2 lg-grid-cols-3">
			                <div class="field-group-col">
			                    <div class="form-group function_name">
			                        <label title="Function Name.">Function Name</label>
			                        <input type="text" class="form-control" name="function_name" value="custom_post_type" />
			                        <span class="help-block">The function name.</span>
			                    </div>
			                </div>
			                <div class="field-group-col">
			                    <div class="form-group function_name">
			                        <label title="Post Type Slug.">Post Type Slug</label>
			                        <input type="text" class="form-control" name="cpt_name" value="movie" placeholder="(e.g. movie)" />
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

		            <div class="tab-pane fade" id="tab_post_type" role="tabpanel" aria-labelledby="tab1" aria-hidden="true" tabindex="0">
		            	<div class="field-group-info grid gap-4 md-grid-cols-2 lg-grid-cols-3">
			                <div class="field-group-col">
			                    <div class="form-group plural_name">
			                        <label title="Name (Plural).">Name (Plural)</label>
			                        <input type="text" class="form-control" name="plural_name" value="Movies" placeholder="(e.g. Movies)"/>
			                        <span class="help-block">Used for the post type admin menu item.</span>
			                    </div>
			                    <div class="form-group singular_name">
			                        <label title="Name (Singular).">Name (Singular)</label>
			                        <input type="text" class="form-control" name="singular_name" value="Movie" placeholder="(e.g. Movie)" />
			                        <span class="help-block">Used when a singular label is needed and for generate post_type name.</span>
			                    </div>
			                </div>
			                <div class="field-group-col">
			                    <div class="form-group description">
			                        <label title="Description.">Description</label>
									<textarea class="form-control" name="description" rows="5">Post Type Description</textarea>
			                        <span class="help-block">A short descriptive summary of what the post type is.</span>
			                    </div>
			                </div>
			                <div class="field-group-col">
			                    <div class="form-group taxonomies">
			                        <label title="Link To Taxonomies.">Taxonomies</label>
			                        <input type="text" class="form-control" name="taxonomies" value="category,post_tag" />
			                        <span class="help-block">Add support for available registered taxonomies. Comma separated list of <a href="https://codex.wordpress.org/Taxonomies" target="_blank">Taxonomies</a>.</span>
			                    </div>
			                    <div class="form-group hierarchical">
			                        <label title="Hierarchical.">Hierarchical</label>
			                        <select class="form-control" name="hierarchical" id="hierarchical">
			                            <option value="false">No (like posts)</option>
			                            <option value="true">Yes (like pages)</option>
			                        </select>
			                        <span class="help-block">Whether or not the post type can have parent-child relationships.</span>
			                    </div>
			                </div>
			            </div>
		            </div>

		            <div class="tab-pane fade" id="tab_options" role="tabpanel" aria-labelledby="tab1" aria-hidden="true" tabindex="0">
		            	<div class="field-group-info grid gap-4 md-grid-cols-2 lg-grid-cols-3">
			                <div class="field-group-col">
			                    <div class="form-group supports">
			                        <label title="Supports.">Supports</label>
			                        <div class="row">
			                            <div class="col-6">
			                                <label class="checkbox"><input type="checkbox" name="supports[]" value="title" checked="" /> Title</label>
			                                <label class="checkbox"><input type="checkbox" name="supports[]" value="editor" checked="" /> Content (editor)</label>
			                                <label class="checkbox"><input type="checkbox" name="supports[]" value="comments" /> Comments</label>
			                                <label class="checkbox"><input type="checkbox" name="supports[]" value="revisions" /> Revisions</label>
			                                <label class="checkbox"><input type="checkbox" name="supports[]" value="trackbacks" /> Trackbacks</label>
			                                <label class="checkbox"><input type="checkbox" name="supports[]" value="author" /> Author</label>
			                            </div>
			                            <div class="col-6">
			                            	<label class="checkbox"><input type="checkbox" name="supports[]" value="excerpt" /> Excerpt</label>
			                                <label class="checkbox"><input type="checkbox" name="supports[]" value="page-attributes" /> Page Attributes</label>
			                                <label class="checkbox"><input type="checkbox" name="supports[]" value="thumbnail" /> Featured Image</label>
			                                <label class="checkbox"><input type="checkbox" name="supports[]" value="custom-fields" /> Custom Fields</label>
			                                <label class="checkbox"><input type="checkbox" name="supports[]" value="post-formats" /> Post Formats</label>
			                            </div>
			                        </div>
			                    </div>
			                </div>
			                <div class="field-group-col">
			                    <div class="form-group exclude_from_search">
			                        <label title="Exclude From Search.">Exclude From Search</label>
			                        <select class="form-control" name="exclude_from_search" id="exclude_from_search">
			                            <option value="false">No</option>
			                            <option value="true">Yes</option>
			                        </select>
			                        <span class="help-block">Posts of this type should be excluded from search results.</span>
			                    </div>
			                    <div class="form-group can_export">
			                        <label title="Enable Export.">Enable Export</label>
			                        <select class="form-control" name="can_export" id="can_export">
			                            <option value="false">No</option>
			                            <option value="true">Yes</option>
			                        </select>
			                        <span class="help-block">Enables post type export.</span>
			                    </div>
			                    <div class="form-group delete_with_user">
			                        <label title="Enable Export.">Delete with user</label>
			                        <select class="form-control" name="delete_with_user" id="delete_with_user">
			                            <option value="false">No</option>
			                            <option value="true">Yes</option>
			                        </select>
			                        <span class="help-block">Whether to delete posts of this type when deleting a user.</span>
			                    </div>
			                </div>
			                <div class="field-group-col">
			                    <div class="form-group has_archive">
			                        <label title="Enable Archives.">Enable Archives</label>
			                        <select class="form-control" name="has_archive" id="has_archive">
			                            <option value="false">No (prevent archive pages)</option>
			                            <option selected="" value="true">Yes (use default slug)</option>
			                            <option value="custom">Yes (set custom archive slug)</option>
			                        </select>
			                        <span class="help-block">Enables post type archives. Post type key is used as defauly archive slug.</span>
			                    </div>
			                    <div class="form-group custom_archive_slug">
			                        <label title="Custom Archive Slug.">Custom Archive Slug</label>
			                        <input type="text" class="form-control" name="custom_archive_slug" value="" disabled="disabled" />
			                        <span class="help-block">Set custom archive slug.</span>
			                    </div>
			                </div>
			            </div>
		            </div>

		            <div class="tab-pane fade" id="tab_visibility" role="tabpanel" aria-labelledby="tab1" aria-hidden="true" tabindex="0">
		            	<div class="field-group-info grid gap-4 md-grid-cols-2 lg-grid-cols-3">
			                <div class="field-group-col">
			                    <div class="form-group public">
			                        <label title="Public.">Public</label>
			                        <select class="form-control" name="public" id="public">
			                            <option selected="" value="true">Yes</option>
			                            <option value="false">No</option>
			                        </select>
			                        <span class="help-block">Show post type in the admin UI.</span>
			                    </div>
			                    <div class="form-group show_ui">
			                        <label title="Show UI.">Show UI</label>
			                        <select class="form-control" name="show_ui" id="show_ui">
			                            <option selected="" value="true">Yes</option>
			                            <option value="false">No</option>
			                        </select>
			                        <span class="help-block">Whether or not to generate a default UI for managing this post type.</span>
			                    </div>
			                </div>
			                <div class="field-group-col">
			                    <div class="form-group show_in_admin_sidebar">
			                        <label title="Show in Admin Sidebar.">Show in Admin Sidebar</label>
			                        <select class="form-control" name="show_in_menu" id="show_in_menu" style="width: 20%;">
			                            <option selected="" value="true">Yes</option>
			                            <option value="false">No</option>
			                        </select>
			                        <select class="form-control" name="menu_position" id="menu_position" style="width: 78%;" data-select2-current-value="5">
			                            <option selected="" value="5">5 - below Posts</option>
			                            <option value="10">10 - below Posts</option>
			                            <option value="15">15 - below Links</option>
			                            <option value="20">20 - below Pages</option>
			                            <option value="25">25 - below Comments</option>
			                            <option value="60">60 - below first separator</option>
			                            <option value="65">65 - below Plugins</option>
			                            <option value="70">70 - below Users</option>
			                            <option value="75">75 - below Tools</option>
			                            <option value="80">80 - below Settings</option>
			                            <option value="100">100 - below second separator</option>
			                        </select>
			                        <span class="help-block">Show post type in admin sidebar.</span>
			                    </div>
			                    <div class="form-group menu_icon">
			                        <label title="Admin Sidebar Icon.">Admin Sidebar Icon</label>
			                        <input type="text" class="form-control" name="menu_icon" value="" placeholder="i.e. dashicons-admin-post" />
			                        <span class="help-block">Post type icon. Use <a href="https://developer.wordpress.org/resource/dashicons/" target="_blank">dashicon</a> name or full icon URL (http://.../icon.png).</span>
			                    </div>
			                </div>
			                <div class="field-group-col">
			                    <div class="form-group show_in_admin_bar">
			                        <label title="Show in Admin Bar.">Show in Admin Bar</label>
			                        <select class="form-control" name="show_in_admin_bar" id="show_in_admin_bar">
			                            <option selected="" value="true">Yes</option>
			                            <option value="false">No</option>
			                        </select>
			                        <span class="help-block">Show post type in <a href="https://codex.wordpress.org/Toolbar" target="_blank">admin bar</a>.</span>
			                    </div>
			                    <div class="form-group show_in_nav_menus">
			                        <label title="Show in Navigation Menus.">Show in Navigation Menus</label>
			                        <select class="form-control" name="show_in_nav_menus" id="show_in_nav_menus">
			                            <option selected="" value="true">Yes</option>
			                            <option value="false">No</option>
			                        </select>
			                        <span class="help-block">Show post type in <a href="https://codex.wordpress.org/Navigation_Menus" target="_blank">Navigation Menus</a>.</span>
			                    </div>
			                </div>
			            </div>
		            </div>

		            <div class="tab-pane fade" id="tab_query" role="tabpanel" aria-labelledby="tab1" aria-hidden="true" tabindex="0">
		            	<div class="field-group-info grid gap-4 md-grid-cols-2 lg-grid-cols-3">
			                <div class="field-group-col">
			                    <div class="form-group query_var">
			                        <label title="Query.">Query var</label>
			                        <select class="form-control" name="query_var" id="query_var">
			                            <option selected="" value="false">Default (post type key)</option>
			                            <option value="true">Custom query variable</option>
			                        </select>
			                        <span class="help-block">
			                            Direct query variable used in <a href="https://developer.wordpress.org/reference/classes/wp_query/#post-type-parameters" target="_blank">WP_Query</a>. e.g. WP_Query( array(
			                            <strong>'post_type' =&gt; 'product'</strong>, 'term' =&gt; 'disk' ) )
			                        </span>
			                    </div>
			                </div>
			                <div class="field-group-col">
			                    <div class="form-group custom_query_variable">
			                        <label title="Custom Query.">Custom Query</label>
			                        <input type="text" class="form-control" name="custom_query_variable" value="post_type" />
			                        <span class="help-block">Custom query variable. Query var needs to be true to use.</span>
			                    </div>
			                </div>
			                <div class="field-group-col">
			                    <div class="form-group publicly_queryable">
			                        <label title="Publicly Queryable.">Publicly Queryable</label>
			                        <select class="form-control" name="publicly_queryable" id="publicly_queryable">
			                            <option selected="" value="true">Yes</option>
			                            <option value="false">No</option>
			                        </select>
			                        <span class="help-block">Enable front end queries as part of parse_request().</span>
			                    </div>
			                </div>
			            </div>
		            </div>

		            <div class="tab-pane fade" id="tab_permalinks" role="tabpanel" aria-labelledby="tab1" aria-hidden="true" tabindex="0">
		            	<div class="field-group-info grid gap-4 md-grid-cols-2 lg-grid-cols-3">
			                <div class="field-group-col">
			                    <div class="form-group rewrite">
			                        <label title="Permalink Rewrite.">Permalink Rewrite</label>
			                        <select class="form-control" name="rewrite" id="rewrite">
			                            <option value="false">No permalink (prevent URL rewriting)</option>
			                            <option selected="" value="true">Default permalink (post type key)</option>
			                            <option value="custom">Custom permalink</option>
			                        </select>
			                        <span class="help-block">
			                            Use Default <a href="https://codex.wordpress.org/Using_Permalinks" target="_blank">Permalinks</a> (using post type key), prevent automatic URL rewriting (no pretty permalinks), or set custom permalinks.
			                        </span>
			                    </div>
			                </div>
			                <div class="field-group-col">
			                    <div class="form-group rewrite_slug">
			                        <label title="URL Slug.">URL Slug</label>
			                        <input type="text" class="form-control" name="rewrite_slug" value="post_type" disabled="disabled" />
			                        <span class="help-block">
			                            Pretty permalink base text. i.e.<br />
			                            www.example.com/product/
			                        </span>
			                    </div>
			                    <div class="form-group rewrite_with_front">
			                        <label title="Use URL Slug.">Use URL Slug</label>
			                        <select class="form-control" name="rewrite_with_front" id="rewrite_with_front" disabled="disabled">
			                            <option selected="" value="true">Yes</option>
			                            <option value="false">No</option>
			                        </select>
			                        <span class="help-block">
			                            Use Post Type slug as URL base.<br />
			                            Default: Yes
			                        </span>
			                    </div>
			                </div>
			                <div class="field-group-col">
			                    <div class="form-group rewrite_pages">
			                        <label title="Pagination.">Pagination</label>
			                        <select class="form-control" name="rewrite_pages" id="rewrite_pages" disabled="disabled">
			                            <option selected="" value="true">Yes</option>
			                            <option value="false">No</option>
			                        </select>
			                        <span class="help-block">
			                            Allow post-type pagination.<br />
			                            Default: Yes
			                        </span>
			                    </div>
			                    <div class="form-group rewrite_feeds">
			                        <label title="Feeds.">Feeds</label>
			                        <select class="form-control" name="rewrite_feeds" id="rewrite_feeds" disabled="disabled">
			                            <option selected="" value="true">Yes</option>
			                            <option value="false">No</option>
			                        </select>
			                        <span class="help-block">
			                            Build feed permastruct.<br />
			                            Default: Yes
			                        </span>
			                    </div>
			                </div>
			            </div>
		            </div>

		            <div class="tab-pane fade" id="tab_capabilities" role="tabpanel" aria-labelledby="tab1" aria-hidden="true" tabindex="0">
		            	<div class="field-group-info grid gap-4 md-grid-cols-2 lg-grid-cols-3">
			                <div class="field-group-col">
			                    <div class="form-group capabilities">
			                        <label title="Capabilities.">Capabilities</label>
			                        <select class="form-control" name="capabilities" id="capabilities" data-select2-current-value="base">
			                            <option selected="" value="base">Base capabilities</option>
			                            <option value="custom">Custom capabilities</option>
			                        </select>
			                        <span class="help-block">Set <a href="https://codex.wordpress.org/Roles_and_Capabilities" target="_blank">user capabilities</a> to manage post type.</span>
			                    </div>
			                    <div class="form-group capability_type">
			                        <label title="Base Capability Type.">Base Capability Type</label>
			                        <select class="form-control" name="capability_type" id="capability_type" data-select2-current-value="page">
			                            <option value="post">Posts</option>
			                            <option selected="" value="page">Pages</option>
			                        </select>
			                        <span class="help-block">Used as a base to construct capabilities.</span>
			                    </div>
			                </div>
			                <div class="field-group-col">
			                    <div class="form-group capabilities_read_post">
			                        <label title="Read Post.">Read Post</label>
			                        <input type="text" class="form-control" name="capabilities_read_post" value="read_post" disabled="disabled" />
			                    </div>
			                    <div class="form-group capabilities_read_private_posts">
			                        <label title="Read Private Posts.">Read Private Posts</label>
			                        <input type="text" class="form-control" name="capabilities_read_private_posts" value="read_private_posts" disabled="disabled" />
			                    </div>
			                    <div class="form-group capabilities_publish_posts">
			                        <label title="Publish Posts.">Publish Posts</label>
			                        <input type="text" class="form-control" name="capabilities_publish_posts" value="publish_posts" disabled="disabled" />
			                    </div>
			                </div>
			                <div class="field-group-col">
			                    <div class="form-group capabilities_delete_post">
			                        <label title="Delete Post.">Delete Post</label>
			                        <input type="text" class="form-control" name="capabilities_delete_post" value="delete_post" disabled="disabled" />
			                    </div>
			                    <div class="form-group capabilities_edit_post">
			                        <label title="Edit Post.">Edit Post</label>
			                        <input type="text" class="form-control" name="capabilities_edit_post" value="edit_post" disabled="disabled" />
			                    </div>
			                    <div class="form-group capabilities_edit_posts">
			                        <label title="Edit Posts.">Edit Posts</label>
			                        <input type="text" class="form-control" name="capabilities_edit_posts" value="edit_posts" disabled="disabled" />
			                    </div>
			                    <div class="form-group capabilities_edit_others_posts">
			                        <label title="Edit Others Posts.">Edit Others Posts</label>
			                        <input type="text" class="form-control" name="capabilities_edit_others_posts" value="edit_others_posts" disabled="disabled" />
			                    </div>
			                </div>
			            </div>
		            </div>
		            
		            <div class="tab-pane fade" id="tab_rest_api" role="tabpanel" aria-labelledby="tab1" aria-hidden="true" tabindex="0">
		            	<div class="field-group-info grid gap-4 md-grid-cols-2 lg-grid-cols-3">
							<div class="field-group-col">
								<div class="form-group show_in_rest">
									<label title="Show in Rest.">Show in Rest</label>
									<select name="show_in_rest" class="form-control" id="show_in_rest" data-select2-current-value="">
										<option selected="" value="">Choose...</option>
										<option value="true">Yes</option>
										<option value="false">No</option>
									</select>
									<span class="help-block">Whether to add the post type route in the REST API 'wp/v2' namespace.</span>
								</div>
							</div>

							<div class="field-group-col">
								<div class="form-group rest_base">
									<label title="Rest Base.">Rest Base</label>
									<input type="text" class="form-control" name="rest_base" value="">
									<span class="help-block">To change the base url of REST API route. Default is the post type key.</span>
								</div>
							</div>

							<div class="field-group-col">
								<div class="form-group rest_controller_class">
									<label title="Rest Controller Class.">Rest Controller Class</label>
									<input type="text" class="form-control" name="rest_controller_class" value="">
									<span class="help-block">REST API Controller class name. Default is 'WP_REST_Posts_Controller'.</span>
								</div>
							</div>
						</div>
					</div>
		        </div>
		    </div>
		    <div class="btn-box">
		        <input type="hidden" name="generator" id="generator" value="post-type" />
		        <input type="hidden" name="action" id="action" value="posttypegenerator" />
                <input type="hidden" name="wpg-security" value="<?php echo wp_create_nonce()?>"/>
		        <button type="submit" class="btn btn-success" id="update-snippet" data-loading-text="Updating …">Update Code</button>
		    </div>
		</form>
	</div>

	<div class="section-code">
		<pre class="prettyprint">
			<?php 
			$type = isset($_GET['cpt']) ? $_GET['cpt'] : '';
			echo load_cpt_templates($type);
			?>
		</pre>
	</div>
	<?php
}