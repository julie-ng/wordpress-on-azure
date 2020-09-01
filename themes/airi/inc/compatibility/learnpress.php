<?php
/**
 * Learnpress compatibility
 *
 * @package Airi
 */

/**
 * Wraps free course label in span
 *
 */
function airi_learnpress_free_course_label() {

	return '<span class="free-course-label">' . __( 'Free', 'airi' ) . '</span>';

}
add_filter( 'learn_press_course_price_html_free', 'airi_learnpress_free_course_label' );

/**
 * Wraps paid course label in span
 *
 */
function airi_learnpress_paid_course_label( $price ) {

	return '<span class="paid-course-label">' . $price . '</span>';

}
add_filter( 'learn_press_course_price_html', 'airi_learnpress_paid_course_label' );