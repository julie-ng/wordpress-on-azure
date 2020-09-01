<?php
/**
 * Blog Customizer panel
 *
 * @package Airi
 */

/**
 * Index
 */
Airi_Kirki::add_panel( 'airi_panel_blog', array(
    'title'       	 => __( 'Blog', 'airi' ),
    'priority'       => 17,
) );
Airi_Kirki::add_section( 'airi_section_blog_index', array(
	'title'       	 => __( 'Index&amp;archives', 'airi' ),
	'panel'			 => 'airi_panel_blog',
    'priority'       => 17,
) );
Airi_Kirki::add_field( 'airi', array(
	'type'        => 'radio',
	'settings'    => 'blog_layout',
	'label'       => __( 'Blog layout', 'airi' ),
	'section'     => 'airi_section_blog_index',
	'default'     => 'layout-default',
	'choices'     => array(
		'layout-default' 	=> esc_attr__( 'Default', 'airi' ),
		'layout-grid' 		=> esc_attr__( 'Grid', 'airi' ),
		'layout-list-2' 		=> esc_attr__( 'Classic', 'airi' ),
		'layout-two-columns' 		=> esc_attr__( 'Two Columns', 'airi' ),
	),
) );
Airi_Kirki::add_field( 'airi', array(
	'type'        => 'number',
	'settings'    => 'excerpt_length',
	'label'       => esc_attr__( 'Excerpt length', 'airi' ),
	'section'     => 'airi_section_blog_index',
	'default'     => 20,
	'priority'    => 10,
	'choices'     => array(
		'min'  => 5,
		'max'  => 60,
		'step' => 1,
	),
) );
Airi_Kirki::add_field( 'airi', array(
	'type'        => 'text',
	'settings'    => 'read_more_text',
	'label'       => esc_attr__( 'Read more text', 'airi' ),
	'description' => esc_attr__( 'Leave empty to hide', 'airi' ),
	'section'     => 'airi_section_blog_index',
	'default'     => esc_attr__( 'Read more', 'airi' ),
	'priority'    => 10,
) );

Airi_Kirki::add_field( 'airi', array(
	'type'        => 'checkbox',
	'settings'    => 'index_hide_thumb',
	'label'       => esc_attr__( 'Hide post thumbnail?', 'airi' ),
	'section'     => 'airi_section_blog_index',
	'default'     => '0',
	'priority'    => 10,
) );
Airi_Kirki::add_field( 'airi', array(
	'type'        => 'checkbox',
	'settings'    => 'index_hide_date',
	'label'       => esc_attr__( 'Hide post date?', 'airi' ),
	'section'     => 'airi_section_blog_index',
	'default'     => '0',
	'priority'    => 10,
) );
Airi_Kirki::add_field( 'airi', array(
	'type'        => 'checkbox',
	'settings'    => 'index_hide_cats',
	'label'       => esc_attr__( 'Hide post categories?', 'airi' ),
	'section'     => 'airi_section_blog_index',
	'default'     => '0',
	'priority'    => 10,
) );
Airi_Kirki::add_field( 'airi', array(
	'type'        => 'checkbox',
	'settings'    => 'index_hide_author',
	'label'       => esc_attr__( 'Hide post author?', 'airi' ),
	'section'     => 'airi_section_blog_index',
	'default'     => '0',
	'priority'    => 10,
) );
Airi_Kirki::add_field( 'airi', array(
	'type'        => 'checkbox',
	'settings'    => 'index_hide_comments',
	'label'       => esc_attr__( 'Hide comments number?', 'airi' ),
	'section'     => 'airi_section_blog_index',
	'default'     => '0',
	'priority'    => 10,
) );


/**
 * Single posts
 */
Airi_Kirki::add_section( 'airi_section_blog_single', array(
	'title'       	 => __( 'Single posts', 'airi' ),
	'panel'			 => 'airi_panel_blog',	
    'priority'       => 17,
) );
Airi_Kirki::add_field( 'airi', array(
	'type'        => 'radio',
	'settings'    => 'single_post_layout',
	'label'       => __( 'Single post layout', 'airi' ),
	'section'     => 'airi_section_blog_single',
	'default'     => 'layout-default',
	'choices'     => array(
		'layout-default' 	=> esc_attr__( 'Default', 'airi' ),
		'layout-full' 		=> esc_attr__( 'No sidebar', 'airi' ),
	),
) );
Airi_Kirki::add_field( 'airi', array(
	'type'        => 'radio',
	'settings'    => 'single_post_content_layout',
	'label'       => __( 'Content layout', 'airi' ),
	'section'     => 'airi_section_blog_single',
	'default'     => 'layout-default',
	'choices'     => array(
		'layout-default' 	=> esc_attr__( 'Default', 'airi' ),
		'layout-2' 		=> esc_attr__( 'Layout 2', 'airi' ),
		'layout-3' 		=> esc_attr__( 'Layout 3', 'airi' ),
	),
) );
Airi_Kirki::add_field( 'airi', array(
	'type'        => 'radio',
	'settings'    => 'single_comment_form_layout',
	'label'       => __( 'Comment Form Layout', 'airi' ),
	'section'     => 'airi_section_blog_single',
	'default'     => 'layout-default',
	'choices'     => array(
		'layout-default' 	=> esc_attr__( 'Default', 'airi' ),
		'layout-2' 		=> esc_attr__( 'Layout 2', 'airi' ),
		'layout-3' 		=> esc_attr__( 'Layout 3', 'airi' ),
	),
) );
Airi_Kirki::add_field( 'airi', array(
	'type'        => 'checkbox',
	'settings'    => 'single_hide_thumb',
	'label'       => esc_attr__( 'Hide post thumbnail?', 'airi' ),
	'section'     => 'airi_section_blog_single',
	'default'     => '0',
	'priority'    => 10,
) );
Airi_Kirki::add_field( 'airi', array(
	'type'        => 'checkbox',
	'settings'    => 'single_hide_date',
	'label'       => esc_attr__( 'Hide post date?', 'airi' ),
	'section'     => 'airi_section_blog_single',
	'default'     => '0',
	'priority'    => 10,
) );
Airi_Kirki::add_field( 'airi', array(
	'type'        => 'checkbox',
	'settings'    => 'single_hide_cats',
	'label'       => esc_attr__( 'Hide post categories?', 'airi' ),
	'section'     => 'airi_section_blog_single',
	'default'     => '0',
	'priority'    => 10,
) );
Airi_Kirki::add_field( 'airi', array(
	'type'        => 'checkbox',
	'settings'    => 'single_hide_author',
	'label'       => esc_attr__( 'Hide post author?', 'airi' ),
	'section'     => 'airi_section_blog_single',
	'default'     => '0',
	'priority'    => 10,
) );