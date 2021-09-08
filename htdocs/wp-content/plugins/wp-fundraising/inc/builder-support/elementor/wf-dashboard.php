<?php

namespace Elementor;

if ( ! defined( 'ABSPATH' ) ) exit;

class WF_Dashboard_Widget extends Widget_Base {

  public $base;

    public function get_name() {
        return 'wf-dashboard';
    }


    public function get_categories() {
        return [ 'wf-elements' ];
    }
    public function get_title() {
        return esc_html__( 'WF Dashboard', 'wp-fundraising' );
    }

    public function get_icon() {
        return 'eicon-posts-grid';
    }

    protected function _register_controls() {

    }

    protected function render( ) {

        echo do_shortcode('[wp_fundraising_dashboard]');
    }

    protected function _content_template() { }
}