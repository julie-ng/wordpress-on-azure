<?php
/**
 * Footer Customizer panel
 *
 * @package Airi
 */


Airi_Kirki::add_section( 'airi_section_footer', array(
    'title'       	 => __( 'Footer', 'airi' ),
    'priority'       => 16,
) );

Airi_Kirki::add_field( 'airi', array(
	'type'        => 'radio',
	'settings'    => 'footer_widget_areas',
	'label'       => __( 'Footer widget areas', 'airi' ),
	'section'     => 'airi_section_footer',
	'default'     => '4',
	'priority'    => 10,
	'choices'     => array(
		'1'   	=> esc_attr__( '1', 'airi' ),
		'2'   	=> esc_attr__( '2', 'airi' ),
		'3'	 	=> esc_attr__( '3', 'airi' ),
		'4'  	=> esc_attr__( '4', 'airi' ),
	),
) );

//Santize function
function airi_sanitize_text( $input ) {
    return wp_kses_post( force_balance_tags( $input ) );
}