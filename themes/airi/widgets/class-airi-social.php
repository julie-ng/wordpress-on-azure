<?php
/**
 * Social widget
 *
 * @package Airi
 */

class Airi_Social extends WP_Widget {

    function __construct() {
        $widget_ops = array( 'description' => __('Display your social profile', 'airi') );
        parent::__construct( 'athemes_social_widget', __('Airi: Social Profile', 'airi'), $widget_ops );
    }

    function widget($args, $instance) {
        $nav_menu = ! empty( $instance['nav_menu'] ) ? wp_get_nav_menu_object( $instance['nav_menu'] ) : false;
        if ( !$nav_menu )
            return;
        $instance['title'] = apply_filters( 'widget_title', empty( $instance['title'] ) ? '' : $instance['title'], $instance, $this->id_base );
        echo $args['before_widget'];
        ?>
        <?php
        if ( !empty($instance['title']) )
            echo $args['before_title'] . $instance['title'] . $args['after_title'];
        ?>
        <?php wp_nav_menu(
            array(
                'fallback_cb'   => false,
                'menu'          => $nav_menu,
                'theme_location' => 'dummylocation',
                'link_before'   => '<span class="screen-reader-text">',
                'link_after'    => '</span>',
                'menu_class'    => 'menu social-media-list clearfix'
            )
        ); ?>
        <?php
        echo $args['after_widget'];
    }

    function update( $new_instance, $old_instance ) {
        $instance['title'] = sanitize_text_field($new_instance['title']);
        $instance['nav_menu'] = (int) $new_instance['nav_menu'];
        return $instance;
    }

    function form( $instance ) {
        $title 		= isset( $instance['title'] ) ? $instance['title'] : '';
        $nav_menu 	= isset( $instance['nav_menu'] ) ? $instance['nav_menu'] : '';
        $menus = wp_get_nav_menus( array( 'orderby' => 'name' ) );
        if ( !$menus ) {
            echo '<p>'. sprintf( __('No menus have been created yet. <a href="%s">Create some</a>.', 'airi'), admin_url('nav-menus.php') ) .'</p>';
            return;
        }
        ?>
        <p>
            <label for="<?php echo $this->get_field_id('title'); ?>"><?php _e('Title:', 'airi') ?></label>
            <input type="text" class="widefat" id="<?php echo $this->get_field_id('title'); ?>" name="<?php echo $this->get_field_name('title'); ?>" value="<?php echo $title; ?>" />
        </p>
        <p><em><?php _e('In order to display your social icons in a widget, all you need to do is go to <strong>Appearance > Menus</strong> and create a menu containing links to your social profiles, then assign that menu here. Supported networks: Facebook, Twitter, Google Plus, Instagram, Dribble, Vimeo, Linkedin, Youtube, Flickr, Pinterest, Tumblr, Foursquare, Behance.', 'airi'); ?></em></p>
        <p>
            <label for="<?php echo $this->get_field_id('nav_menu'); ?>"><?php _e('Select your social menu:', 'airi'); ?></label>
            <select id="<?php echo $this->get_field_id('nav_menu'); ?>" name="<?php echo $this->get_field_name('nav_menu'); ?>">
                <option value="0"><?php _e( '&mdash; Select &mdash;', 'airi' ) ?></option>
                <?php
                foreach ( $menus as $menu ) {
                    echo '<option value="' . $menu->term_id . '"'
                        . selected( $nav_menu, $menu->term_id, false )
                        . '>'. esc_html( $menu->name ) . '</option>';
                }
                ?>
            </select>
        </p>
        <?php
    }
}