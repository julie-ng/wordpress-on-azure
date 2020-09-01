<?php

/**
 * Integration with WPML for aThemes: Testimonials block
 */
class Airi_WPML_Elementor_Hero_Slider extends WPML_Elementor_Module_With_Items {
	
	/**
	 * @return string
	 */
	public function get_items_field() {
	   return 'slides_control';
	}
   
	/**
	 * @return array
	 */
	public function get_fields() {
	   return array( 'slide_title', 'slide_text', 'linktext', 'link' => array( 'url' ), );
	}
   
	/**
	 * @param string $field
	 *
	 * @return string
	 */
	protected function get_title( $field ) {
	   switch( $field ) {
			case 'slide_title':
				return esc_html__( '[aThemes Slider] Slide title', 'airi' );
   
		  	case 'slide_text':
				return esc_html__( '[aThemes Slider] Slide text', 'airi' );
   
			case 'linktext':
				return esc_html__( '[aThemes Slider] Link text', 'airi' );

			case 'link':
				return esc_html__( '[aThemes Slider] Link URL', 'airi' );				
   
			default:
				return '';
	   }
	}
   
	/**
	 * @param string $field
	 *
	 * @return string
	 */
	protected function get_editor_type( $field ) {
	   switch( $field ) {
			case 'slide_title':
			case 'slide_text':
			case 'linktext':	
			case 'link':	
				return 'LINE';
   
			default:
				return '';
	   }
	}

}