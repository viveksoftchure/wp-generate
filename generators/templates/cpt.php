function {{function_name}}() {
	$labels = array(
		'name'			=> __( '{{plural_name}}', '{{text_domain}}' ),
		'singular_name'         => __( '{{singular_name}}', '{{text_domain}}' ),
		'menu_name'             => __( '{{plural_name}}', '{{text_domain}}' ),
		'name_admin_bar'        => __( '{{singular_name}}', '{{text_domain}}' ),
		'archives'              => __( 'Item Archives', '{{text_domain}}' ),
		'attributes'            => __( 'Item Attributes', '{{text_domain}}' ),
		'parent_item_colon'     => __( 'Parent Item:', '{{text_domain}}' ),
		'all_items'             => __( 'All Items', '{{text_domain}}' ),
		'add_new_item'          => __( 'Add New Item', '{{text_domain}}' ),
		'add_new'               => __( 'Add New', '{{text_domain}}' ),
		'new_item'              => __( 'New Item', '{{text_domain}}' ),
		'edit_item'             => __( 'Edit Item', '{{text_domain}}' ),
		'update_item'           => __( 'Update Item', '{{text_domain}}' ),
		'view_item'             => __( 'View Item', '{{text_domain}}' ),
		'view_items'            => __( 'View Items', '{{text_domain}}' ),
		'search_items'          => __( 'Search Item', '{{text_domain}}' ),
		'not_found'             => __( 'Not found', '{{text_domain}}' ),
		'not_found_in_trash'    => __( 'Not found in Trash', '{{text_domain}}' ),
		'featured_image'        => __( 'Featured Image', '{{text_domain}}' ),
		'set_featured_image'    => __( 'Set featured image', '{{text_domain}}' ),
		'remove_featured_image' => __( 'Remove featured image', '{{text_domain}}' ),
		'use_featured_image'    => __( 'Use as featured image', '{{text_domain}}' ),
		'insert_into_item'      => __( 'Insert into item', '{{text_domain}}' ),
		'uploaded_to_this_item' => __( 'Uploaded to this item', '{{text_domain}}' ),
		'items_list'            => __( 'Items list', '{{text_domain}}' ),
		'items_list_navigation' => __( 'Items list navigation', '{{text_domain}}' ),
		'filter_items_list'     => __( 'Filter items list', '{{text_domain}}' ),
	);

	{{rewriteArray}}

	$capabilities = array(
		'edit_post'		=> '{{capabilities_edit_post}}',
		'read_post'             => '{{capabilities_read_post}}',
		'delete_post'           => '{{capabilities_delete_post}}',
		'edit_posts'            => '{{capabilities_edit_posts}}',
		'edit_others_posts'     => '{{capabilities_edit_others_posts}}',
		'publish_posts'         => '{{capabilities_publish_posts}}',
		'read_private_posts'    => '{{capabilities_read_private_posts}}',
	);

	$args = array(
		'label'                 => __( '{{singular_name}}', '{{text_domain}}' ),
		'description'           => __( '{{description}}', '{{text_domain}}' ),
		'labels'                => $labels,
		{{supports}}
		'taxonomies'            => array( {{taxonomies}} ),
		'hierarchical'          => {{hierarchical}},
		'public'                => {{public}},
		'show_ui'               => {{show_ui}},
		'show_in_menu'          => {{show_in_menu}},
		'menu_position'         => {{menu_position}},
		'menu_icon'		=> '{{menu_icon}}',
		'show_in_admin_bar'     => {{show_in_admin_bar}},
		'show_in_nav_menus'     => {{show_in_nav_menus}},
		'can_export'            => {{can_export}},
		'has_archive'           => {{has_archive}},
		'exclude_from_search'   => {{exclude_from_search}},
		'publicly_queryable'    => {{publicly_queryable}},
		'capability_type'       => '{{capability_type}}',
		{{Delete_With_User}}
		{{rewrite}}
	);
	register_post_type( '{{cpt_name}}', $args );

}
add_action( 'init', '{{function_name}}', 0 );