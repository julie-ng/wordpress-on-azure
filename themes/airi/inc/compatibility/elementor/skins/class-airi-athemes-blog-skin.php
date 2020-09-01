<?php

/**
 * Skin for the aThemes: Blog module
 */

	
	class Airi_aThemes_Blog_Skin extends Elementor\Skin_Base {
		
		public function __construct( Elementor\Widget_Base $parent ) {
			parent::__construct( $parent );
			add_action( 'elementor/element/athemes-blog/section_style_content/after_section_start', [ $this, 'register_controls' ] );
		}
     
		public function get_id() {
			return 'airi_athemes_blog_skin';
		}

		public function get_title() {
			return __( 'Style 2', 'airi' );
		}

		public function register_controls( $controls ) {

		//Author
		$controls->add_control(
			'heading_rm',
			[
				'label' => __( 'Read more link', 'airi' ),
				'type' => \Elementor\Controls_Manager::HEADING,
				'separator' => 'before',
				'condition' => [
					'_skin' => $this->get_id(),
				],				
			]
		);

		$controls->add_control(
			'read_more_color',
			[
				'label' => __( 'Color', 'airi' ),
				'type' => \Elementor\Controls_Manager::COLOR,
				'default' => '',
				'selectors' => [
					'{{WRAPPER}} .athemes-blog .read-more' => 'color: {{VALUE}};',
				],
				'condition' => [
					'_skin' => $this->get_id(),
				],					
				'scheme' => [
					'type' => \Elementor\Scheme_Color::get_type(),
					'value' => \Elementor\Scheme_Color::COLOR_1,
				],
			]
		);

		$controls->add_group_control(
			\Elementor\Group_Control_Typography::get_type(),
			[
				'name' => 'rm_typography',
				'selector' => '{{WRAPPER}} .athemes-blog .read-more',
				'scheme' => \Elementor\Scheme_Typography::TYPOGRAPHY_1,
				'condition' => [
					'_skin' => $this->get_id(),
				],					
			]
		);		

		}

		public function render() {
			$settings = $this->parent->get_settings();

			$cats = is_array( $settings['categories'] ) ? implode( ',', $settings['categories'] ) : $settings['categories'];

			$query = new \WP_Query( array(
				'posts_per_page'      => $settings['number'],
				'no_found_rows'       => true,
				'post_stairis'         => 'publish',
				'ignore_sticky_posts' => true,
				'cat' 			      => $cats
			) ); ?>

			<div class="athemes-blog <?php echo $this->get_id(); ?>">
				<div class="row">	
				<?php if ( $query->have_posts() ) : ?>
					<?php $counter = 0; ?>
					<?php while ( $query->have_posts() ) : $query->the_post(); ?>
						
						<?php if ( $counter == 0 || $counter == 1 ) : ?>
						<div class="col-md-6">
						<?php endif; ?>		

						<?php if ( $counter == 0 ) : ?>
							<div class="col-md-12">
								<div class="post-item large-post">
									<?php if ( has_post_thumbnail() ) : ?>
										<div class="entry-thumb">
											<a href="<?php the_permalink(); ?>" title="<?php the_title_attribute(); ?>"><?php the_post_thumbnail(); ?></a>
										</div>
									<?php endif; ?>					
									<div class="post-content">	
										<?php the_title( '<h3 class="entry-title"><a href="' . esc_url( get_permalink() ) . '" rel="bookmark">', '</a></h3>' ); ?>
										<?php airi_posted_on(); ?>
										<?php echo wp_trim_words( get_the_content(), 12 ); ?>
										<a class="read-more" href="<?php the_permalink(); ?>" title="<?php the_title_attribute(); ?>"><?php esc_html_e( 'Read more >>', 'airi' ); ?></a>
									</div>	
								</div>				
							</div>
						</div><?php //End first column ?>
						<?php else : ?>
						<div class="post-item">
							<div class="row">
								<?php if ( has_post_thumbnail() ) : ?>
								<div class="col-md-3 col-sm-3 col-xs-3">
									<?php the_post_thumbnail( 'airi-360-360' ); ?>
								</div>
								<?php endif; ?>			
								<div class="post-content col-md-9 col-sm-9 col-xs-9">	
									<?php the_title( '<h3 class="entry-title"><a href="' . esc_url( get_permalink() ) . '" rel="bookmark">', '</a></h3>' ); ?>
									<?php airi_posted_on(); ?>
									<?php echo wp_trim_words( get_the_content(), 12 ); ?>
									<a class="read-more" href="<?php the_permalink(); ?>" title="<?php the_title_attribute(); ?>"><?php esc_html_e( 'Read more >>', 'airi' ); ?></a>
								</div>	
							</div>				
						</div>
						<?php endif; ?>		

					<?php
					$counter++;
					endwhile;
					wp_reset_postdata();
					endif; ?>
					</div><?php //End second column ?>
				</div>
			</div>	
			<?php
		}

	}

add_action( 'elementor/widget/athemes-blog/skins_init', function( $widget ) {
   $widget->add_skin( new Airi_aThemes_Blog_Skin( $widget ) );
} );







