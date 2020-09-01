<?php

/**
 * Skin for the Image-Icon box module
 */
	
	class Airi_Image_Icon_Box_Skin extends Elementor\Skin_Base {
		
		public function __construct( Elementor\Widget_Base $parent ) {
			parent::__construct( $parent );
			add_action( 'elementor/element/athemes-image-icon-box/section_style_content/after_section_start', [ $this, 'register_controls' ] );		
		}
     
		public function get_id() {
			return 'airi_image_icon_skin';
		}

		public function get_title() {
			return __( 'List style', 'airi' );
		}

		public function register_controls( $controls ) {

		    $controls->add_control( 'general_color',
		        [
			        'label' => __( 'General color', 'airi' ),
			        'type' => \Elementor\Controls_Manager::COLOR,
			        'default' => '#f89121',
					'condition' => [
						'_skin' => $this->get_id(),
					],
					'selectors' => [
						'{{WRAPPER}} .icon-wrapper i' 				=> 'color: {{VALUE}};',
						'{{WRAPPER}}:hover .icon-wrapper i' 		=> 'color: #fff;',
						'{{WRAPPER}}:hover .icon-wrapper' 			=> 'background-color: {{VALUE}};',
						'{{WRAPPER}}:hover .icon-wrapper::after' 	=> 'border-left-color: {{VALUE}};',
					],
		        ]
		    );

		}

		public function render() {
			$settings = $this->parent->get_settings();


			$has_content = ! empty( $settings['title_text'] ) || ! empty( $settings['description_text'] );

			$html = '<div class="elementor-image-box-wrapper" style="background-image:url(' . $settings['image']['url'] . ');">';

			if ( ! empty( $settings['link']['url'] ) ) {
				$this->add_render_attribute( 'link', 'href', $settings['link']['url'] );

				if ( $settings['link']['is_external'] ) {
					$this->add_render_attribute( 'link', 'target', '_blank' );
				}

				if ( ! empty( $settings['link']['nofollow'] ) ) {
					$this->add_render_attribute( 'link', 'rel', 'nofollow' );
				}
			}

			$html .= '<span class="icon-wrapper"><i class="' . $settings['icon'] . '"></i></span>';

			if ( $has_content ) {
				$html .= '<div class="elementor-image-box-content">';

				if ( ! empty( $settings['title_text'] ) ) {
					$this->parent->add_render_attribute( 'title_text', 'class', 'elementor-image-box-title' );

					$title_html = $settings['title_text'];

					if ( ! empty( $settings['link']['url'] ) ) {
						$title_html = '<a ' . $this->get_render_attribute_string( 'link' ) . '>' . $title_html . '</a>';
					}

					$html .= sprintf( '<%1$s %2$s>%3$s</%1$s>', $settings['title_size'], $this->parent->get_render_attribute_string( 'title_text' ), $title_html );
				}

				if ( ! empty( $settings['description_text'] ) ) {
					$this->parent->add_render_attribute( 'description_text', 'class', 'elementor-image-box-description' );

					$html .= sprintf( '<p %1$s>%2$s</p>', $this->parent->get_render_attribute_string( 'description_text' ), $settings['description_text'] );
				}

				$html .= '</div>';
			}

			$html .= '</div>';

			echo $html;
		}


	}

add_action( 'elementor/widget/athemes-image-icon-box/skins_init', function( $widget ) {
   $widget->add_skin( new Airi_Image_Icon_Box_Skin( $widget ) );
} );







