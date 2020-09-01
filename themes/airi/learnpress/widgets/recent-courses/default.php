<?php
/**
 * Template for displaying content of Recent Courses widget.
 *
 * This template can be overridden by copying it to yourtheme/learnpress/widgets/recent-courses/default.php.
 *
 * @author  ThimPress
 * @category Widgets
 * @package  Learnpress/Templates
 * @version  3.0.0
 */

/**
 * Prevent loading this file directly
 */
defined( 'ABSPATH' ) || exit();

/**
 * Prevent loading this file directly
 */
defined( 'ABSPATH' ) || exit();

if ( ! isset( $airi_courses ) ) {
	esc_html_e( 'No courses', 'airi' );

	return;
}

global $post;
//widget instance
$instance = $this->instance; // phpcs:ignore WPThemeReview.CoreFunctionality.PrefixAllGlobals.NonPrefixedVariableFound
?>

<div class="archive-course-widget-outer airi-course <?php esc_attr( $instance["css_class"] ); ?>">

    <div class="widget-body clearfix">
    <div class="row">
		<?php foreach ( $airi_courses as $airi_course_id ) {

			$airi_post = get_post( $airi_course_id );
			setup_postdata( $airi_post );
			$airi_course = learn_press_get_course( $airi_course_id );

			?>
            
            <div class="course-entry col-md-4">
                <div class="course-entry-inner">
                    <!-- course thumbnail -->
                    <?php if ( ! empty( $instance['show_thumbnail'] ) && $airi_image = $airi_course->get_image( 'large' ) ) { ?>
                        <div class="course-cover">
                            <a href="<?php echo $airi_course->get_permalink(); ?>">
                                <?php echo $airi_image; ?>
                            </a>
                        </div>
                    <?php } ?>

                    <div class="course-detail">
                        <!-- course title -->
                        <h3 class="course-title"><a href="<?php echo get_the_permalink( $airi_course->get_id() ) ?>"><?php echo $airi_course->get_title(); ?></a></h3>

                        <!-- instructor -->
                        <?php if ( ! empty( $instance['show_teacher'] ) ) { ?>
                            <div class="course-meta-field course-instructor"><?php echo esc_html( 'By', 'airi' ); ?>&nbsp;<?php echo $airi_course->get_instructor_html(); ?></div>
                        <?php } ?>

                        <div class="course-meta-data">                           

                            <!-- price -->
                            <?php if ( ! empty( $instance['show_price'] ) ) { ?>
                                <div class="course-meta-field"><?php echo $airi_course->get_price_html(); ?></div>
                            <?php } ?>

                            <!-- number students -->
                            <?php if ( ! empty( $instance['show_enrolled_students'] ) ) { ?>
                                <div class="course-student-number course-meta-field">
                                    <i class="fa fa-users"></i><?php echo $airi_course->get_users_enrolled(); ?>
                                </div>
                            <?php } ?>

                            <!-- number lessons -->
                            <?php if ( ! empty( $instance['show_lesson'] ) ) { ?>
                                <div class="course-lesson-number course-meta-field">
                                    <?php
                                    $airi_lesson_count = $airi_course->count_items( LP_LESSON_CPT );
                                    echo $airi_lesson_count > 1 ? sprintf( __( '%d lessons', 'airi' ), $airi_lesson_count ) : sprintf( __( '%d lesson', 'airi' ), $airi_lesson_count ); ?>
                                </div>
                            <?php } ?>
                        </div>
                    </div>
                </div>
            </div>
		<?php } ?>

        </div>
    </div>

	<?php wp_reset_postdata();?>

</div>