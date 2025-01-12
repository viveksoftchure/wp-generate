<?php
defined( 'ABSPATH' ) or die( 'No script kiddies please!' );

add_shortcode('wp_options_generator_shortcode', 'wp_options_generator');
function wp_options_generator() {
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
			'tab' => 'tab_add_menu',
			'icon' => 'fa-solid fa-signs-post',
			'label' => 'Menu Settings',
		),
		'tab3' => array(
			'tab' => 'tab_fields',
			'icon' => 'fa-solid fa-signs-post',
			'label' => 'Fields',
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
	                            <p>Use this tool to create custom code for <a href="https://codex.wordpress.org/Administration_Menus" target="_blank" rel="noopener">Settings Pages</a> with <a href="https://developer.wordpress.org/reference/functions/add_options_page/" target="_blank" rel="noopener">add_options_page</a> function.</p>
	                        </div>
	                        <div class="field-group-col">
	                            <p><strong>Usage</strong></p>
	                            <ul>
									<li>Fill in the user-friendly form.</li>
									<li>Click the “Update Code” button.</li>
									<li>Copy the code to your project.</li>
									<li>Or save it as a snippet and share with the community.</li>
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
		            	<div class="field-group-info grid gap-4 md-grid-cols-2 lg-grid-cols-4">
			                <div class="field-group-col">
			                    <div class="form-group query_name">
			                        <label title="Class Name.">Class Name</label>
			                        <input type="text" name="class_name" class="form-control" value="Custom_Settings_Page">
			                        <span class="help-block">The class name used in the code.</span>
			                    </div>
			                </div>
			                <div class="field-group-col">
			                    <div class="form-group the_loop">
			                        <label title="Setting Group.">Setting Group</label>
			                        <input type="text" name="settings_group" class="form-control" value="settings_group">
			                        <span class="help-block">Name of the settings group used in <a href="https://developer.wordpress.org/reference/functions/register_setting/" target="_blank">register_setting</a>.</span>
			                    </div>
			                </div>
			                <div class="field-group-col">
			                    <div class="form-group text_domain">
			                        <label title="Setting Name.">Setting Name</label>
			                        <input type="text" name="settings" class="form-control" value="settings_name">
			                        <span class="help-block">Name of the <a href="https://developer.wordpress.org/reference/functions/get_option/" target="_blank">options</a> saved in the database.</span>
			                    </div>
			                </div>
			                <div class="field-group-col">
			                    <div class="form-group text_domain">
			                        <label title="Text Domain.">Text Domain</label>
			                        <input type="text" name="text_domain" class="form-control" value="text_domain">
			                        <span class="help-block">Translation file <a href="https://developer.wordpress.org/reference/functions/load_textdomain/" target="_blank">Text Domain</a>. Optional.</span>
			                    </div>
			                </div>
			            </div>
		            </div>

		            <div class="tab-pane fade" id="tab_add_menu" role="tabpanel" aria-labelledby="tab1" aria-hidden="true" tabindex="0">
		            	<div class="field-group-info grid gap-4 md-grid-cols-2 lg-grid-cols-4">
			                <div class="field-group-col">
			                    <div class="form-group menu_type">
			                    	<label title="Menu Type.">Menu Type</label>
									<select name="menu_type" id="menu_type" class="form-control" >
										<optgroup label="New">
											<option value="add_menu_page">New Menu</option>
											<option value="add_submenu_page">New Submenu</option>
										</optgroup>
										<optgroup label="Builtin Menus">
											<option value="add_dashboard_page">Dashboard Submenu</option>
											<option selected="" value="add_posts_page">Posts Submenu</option>
											<option value="add_media_page">Media Submenu</option>
											<option value="add_pages_page">Pages Submenu</option>
											<option value="add_comments_page">Comments Submenu</option>
											<option value="add_theme_page">Appearance Submenu</option>
											<option value="add_plugins_page">Plugins Submenu</option>
											<option value="add_users_page">Users Submenu</option>
											<option value="add_management_page">Tools Submenu</option>
											<option value="add_options_page">Settings Submenu</option>
										</optgroup>
									</select>
									<span class="help-block">.</span>
								</div>

								<div class="form-group submenu">
									<label title="Parent Menu.">Parent Menu</label>
									<input type="text" name="submenu" class="form-control" value="" disabled="disabled">
									<span class="help-block">Slug of the parent menu.</span>
								</div>
			                </div>
			                <div class="field-group-col">
			                    <div class="form-group page-title">
			                        <label title="Page Title.">Page Title</label>
									<input type="text" name="page-title" class="form-control" value="">
									<span class="help-block">Settings page title.</span>
			                    </div>

			                    <div class="form-group menu-title">
			                    	<label title="Menu Title.">Menu Title</label>
									<input type="text" name="menu-title" class="form-control" value="">
									<span class="help-block">Admin sidebar menu title.</span>
								</div>
			                </div>
			                <div class="field-group-col">
		                    	<div class="form-group capability">
		                    		<label title="User Capability.">User Capability</label>
									<input type="text" name="capability" class="form-control" value="manage_options">
									<span class="help-block">Access permision <a href="https://codex.wordpress.org/Roles_and_Capabilities#Capabilities" target="_blank">capability</a>.</span>
		                    	</div>

		                    	<div class="form-group menu_slug">
		                    		<label title="Slug.">Slug</label>
									<input type="text" name="menu_slug" class="form-control" value="">
									<span class="help-block">Unique slug for the admin page.</span>
								</div>
			                </div>
			                <div class="field-group-col">
			                    <div class="form-group callback_function">
			                        <label title="Callback Function.">Callback Function</label>
									<input type="text" name="callback_function" class="form-control" value="page_layout">
									<span class="help-block">The name of the layout function.</span>
			                    </div>

			                    <div class="form-group menu_icon">
			                    	<label title="Sidebar Icon.">Sidebar Icon</label>
									<input type="text" name="menu_icon" class="form-control" value="" placeholder="i.e. dashicons-admin-tools" disabled="disabled">
									<span class="help-block">Use <a href="https://developer.wordpress.org/resource/dashicons/" target="_blank">dashicon</a> or full icon URL.</span>
								</div>

								<div class="form-group menu_position">
									<label title="Menu Position.">Menu Position</label>
									<select name="menu_position" id="menu_position" class="form-control"  disabled="disabled">
										<option value="2">2 - below Dashboard</option>
										<option value="4">4 - below Separator</option>
										<option value="5">5 - below Posts</option>
										<option value="10">10 - below Media</option>
										<option value="15">15 - below Links</option>
										<option value="20">20 - below Pages</option>
										<option value="25">25 - below Comments</option>
										<option value="59">59 - below Separator</option>
										<option value="60">60 - below Appearance</option>
										<option value="65">65 - below Plugins</option>
										<option value="70">70 - below Users</option>
										<option value="75">75 - below Tools</option>
										<option value="80">80 - below Settings</option>
										<option selected="" value="99">99 - below Separator</option>
									</select>
									<span class="help-block">Sidebar menu position.</span>
								</div>
			                </div>
			            </div>
		            </div>

		            <div class="tab-pane fade" id="tab_fields" role="tabpanel" aria-labelledby="tab1" aria-hidden="true" tabindex="0">
		            	<div class="field-container">
			            	<div id="field_group_info_0" class="field-group-info grid gap-4 md-grid-cols-2 lg-grid-cols-4">
					            <div class="field-group-col">
					                <div class="form-group fieldtype">
					                	<label title="Type.">Type</label>
										<select name="fieldtype[0]" class="form-control field-type" data-parent-id="#field_group_info_0">
											<option value=" ">- Select -</option>
											<optgroup label="Basic">
												<option selected="" value="text">Text</option>
												<option value="number">Number</option>
												<option value="email">Email</option>
												<option value="url">URL</option>
												<option value="password">Password</option>
												<option value="textarea">Text Area</option>
												<option value="checkbox">True/False</option>
											</optgroup>
											<optgroup label="Multiple Choice">
												<option value="checkboxes">Checkboxes</option>
												<option value="radio">Radio</option>
												<option value="select">Select</option>
											</optgroup>
											<optgroup label="Date / Time">
												<option value="date">Date</option>
												<option value="time">Time</option>
											</optgroup>
											<optgroup label="Media">
												<option value="media">File</option>
											</optgroup>
											<optgroup label="Other">
												<option value="color">Color</option>
											</optgroup>
										</select>
										<span class="help-block">Select field type.</span>
									</div>

									<div class="form-group id">
										<label title="ID.">ID / Name</label>
										<input type="text" name="id[0]" class="form-control id" value="">
										<span class="help-block">Single word, no spaces. Underscores and dashes allowed</span>
									</div>
					            </div>
					            <div class="field-group-col">
					                <div class="form-group">
					                	<label title="Label.">Label</label>
										<input type="text" name="label[0]" class="form-control label" value="">
										<span class="help-block">Text appears before the field.</span>
									</div>
									<div class="form-group description">
										<label title="Description.">Description</label>
										<input type="text" name="description[0]" class="form-control description" value="">
										<span class="help-block">Text appears below the field.</span>
									</div>
					            </div>
					            <div class="field-group-col">
					                <div class="form-group placeholder">
					                	<label title="Field Placeholder.">Field Placeholder</label>
										<input type="text" name="placeholder[0]" class="form-control placeholder" value="">
										<span class="help-block">Text appears within the input.</span>
									</div>
					            </div>
					            <div class="field-group-col">
					                <div class="form-group options1">
					                	<label title="Multiple Options.">Multiple Options</label>
										<textarea style="width:100%; height:120px;" placeholder="value1|Label 1
										value2|Label 2
										value3|Label 3" name="options[0]" class="form-control options" disabled="disabled"></textarea>
										<span class="help-block">For select and radio fields. Set value|label, each fields in new line.</span>
									</div>
					            </div>
					        </div>
					    </div>
					    <button class="btn add-field-block" type="button">Add Field</button>
		            </div>

		        </div>
		    </div>
		    <div class="btn-box">
		        <input type="hidden" name="generator" id="generator" value="wp_options" />
		        <input type="hidden" name="action" id="action" value="settingpagegenerator" />
                <input type="hidden" name="wpg-security" value="<?php echo wp_create_nonce()?>"/>
		        <button type="submit" class="btn btn-success" id="update-snippet" data-loading-text="Updating …">Update Code</button>
		    </div>
		</form>
	</div>

	<div id="clone_fields" class="hidden">
		<div id="field_group_info_%KEY%" class="field-group-info grid gap-4 md-grid-cols-2 lg-grid-cols-4">
            <div class="field-group-col">
                <div class="form-group fieldtype">
                	<label title="Type.">Type</label>
					<select name="fieldtype[%KEY%]" class="form-control field-type" data-parent-id="#field_group_info_%KEY%">
						<option value=" ">- Select -</option>
						<optgroup label="Basic">
							<option selected="" value="text">Text</option>
							<option value="number">Number</option>
							<option value="email">Email</option>
							<option value="url">URL</option>
							<option value="password">Password</option>
							<option value="textarea">Text Area</option>
							<option value="checkbox">True/False</option>
						</optgroup>
						<optgroup label="Multiple Choice">
							<option value="checkboxes">Checkboxes</option>
							<option value="radio">Radio</option>
							<option value="select">Select</option>
						</optgroup>
						<optgroup label="Date / Time">
							<option value="date">Date</option>
							<option value="time">Time</option>
						</optgroup>
						<optgroup label="Media">
							<option value="media">File</option>
						</optgroup>
						<optgroup label="Other">
							<option value="color">Color</option>
						</optgroup>
					</select>
					<span class="help-block">Select field type.</span>
				</div>

				<div class="form-group id">
					<label title="ID.">ID / Name</label>
					<input type="text" name="id[%KEY%]" class="form-control id" value="">
					<span class="help-block">Single word, no spaces. Underscores and dashes allowed</span>
				</div>
            </div>
            <div class="field-group-col">
                <div class="form-group">
                	<label title="Label.">Label</label>
					<input type="text" name="label[%KEY%]" class="form-control label" value="">
					<span class="help-block">Text appears before the field.</span>
				</div>
				<div class="form-group description">
					<label title="Description.">Description</label>
					<input type="text" name="description[%KEY%]" class="form-control description" value="">
					<span class="help-block">Text appears below the field.</span>
				</div>
            </div>
            <div class="field-group-col">
                <div class="form-group placeholder">
                	<label title="Field Placeholder.">Field Placeholder</label>
					<input type="text" name="placeholder[%KEY%]" class="form-control placeholder" value="">
					<span class="help-block">Text appears within the input.</span>
				</div>
            </div>
            <div class="field-group-col">
                <div class="form-group options1">
                	<label title="Multiple Options.">Multiple Options</label>
					<textarea style="width:100%; height:120px;" placeholder="value1|Label 1
					value2|Label 2
					value3|Label 3" name="options[%KEY%]" class="form-control options" disabled="disabled"></textarea>
					<span class="help-block">For select and radio fields. Set value|label, each fields in new line.</span>
				</div>
            </div>
        </div>
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