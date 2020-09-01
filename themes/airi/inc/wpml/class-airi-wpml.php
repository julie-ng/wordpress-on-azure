<?php

/**
 * Integration with WPML for custom Elementor blocks
 */

class Airi_WPML {

    public function __construct() {
		add_filter( 'wpml_elementor_widgets_to_translate', array( $this, 'translatable_widgets' ) );
	}

	public function translatable_widgets( $widgets ) {

		if ( !$this->is_pro() ) { //free version doesn't contain any Elementor fields that need integration with WPML
			return;
		}

		$widgets[ 'athemes-portfolio' ] = [
			'conditions' => [ 'widgetType' => 'athemes-portfolio' ],
			'fields'     => [
				[
					'field'       => 'show_all_text',
					'type'        => __( '[aThemes Portfolio] Show all text', 'airi' ),
					'editor_type' => 'LINE'
				],			 		  
			],
			'integration-class' => 'Airi_WPML_Elementor_Portfolio',
		];

		$widgets[ 'athemes-hero-slider' ] = [
			'conditions' => [ 'widgetType' => 'athemes-hero-slider' ],
			'fields'     => [],
			'integration-class' => 'Airi_WPML_Elementor_Hero_Slider',
		];		

		$widgets[ 'athemes-categories-grid' ] = [
			'conditions' => [ 'widgetType' => 'athemes-categories-grid' ],
			'fields'     => [
				[
					'field'       => 'title1',
					'type'        => __( '[aThemes: Shop category grid] Box 1 title', 'airi' ),
					'editor_type' => 'LINE'
				],
				[
					'field'       => 'link1',
					'type'        => __( '[aThemes: Shop category grid] Box 1 link', 'airi' ),
					'editor_type' => 'LINE'
				],		
                [
					'field'       => 'title2',
					'type'        => __( '[aThemes: Shop category grid] Box 2 title', 'airi' ),
					'editor_type' => 'LINE'
				],
				[
					'field'       => 'link2',
					'type'        => __( '[aThemes: Shop category grid] Box 2 link', 'airi' ),
					'editor_type' => 'LINE'
				],	
                [
					'field'       => 'title3',
					'type'        => __( '[aThemes: Shop category grid] Box 3 title', 'airi' ),
					'editor_type' => 'LINE'
				],
				[
					'field'       => 'link3',
					'type'        => __( '[aThemes: Shop category grid] Box 3 link', 'airi' ),
					'editor_type' => 'LINE'
				],	
                [
					'field'       => 'title4',
					'type'        => __( '[aThemes: Shop category grid] Box 4 title', 'airi' ),
					'editor_type' => 'LINE'
				],
				[
					'field'       => 'link4',
					'type'        => __( '[aThemes: Shop category grid] Box 4 link', 'airi' ),
					'editor_type' => 'LINE'
				],	
                [
					'field'       => 'title5',
					'type'        => __( '[aThemes: Shop category grid] Box 5 title', 'airi' ),
					'editor_type' => 'LINE'
				],
				[
					'field'       => 'link5',
					'type'        => __( '[aThemes: Shop category grid] Box 5 link', 'airi' ),
					'editor_type' => 'LINE'
				],																					 		  
			],
		];
					
		$this->load_integration_classes();

		return $widgets;
	}
	
	private function load_integration_classes() {
		require get_template_directory() . '/inc/wpml/class-airi-wpml-portfolio.php';
		require get_template_directory() . '/inc/wpml/class-airi-wpml-hero-slider.php';
	}

	public function is_pro() {
		if ( class_exists( 'Airi_Pro' ) ) {
			return true;
		}
	}
}

$Airi_WPML = new Airi_WPML();