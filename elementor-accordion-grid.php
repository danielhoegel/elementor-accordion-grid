<?php

/**
 * Plugin Name: Elementor Accordion Grid
 * Description: Accordion in a grid layout for the Elementor PageBuilder
 * Plugin URI: 
 * Version: 0.0.1
 * Author: Daniel Högel (HHC)
 * Author URI: https://hhc-duesseldorf.de
 * Text Domain: elementor-accordion-grid
 */

if ( ! defined( 'ABSPATH' ) ) exit;

class ElementorAccordionGrid {

   private static $instance = null;

   public static function get_instance() {
        if ( ! self::$instance )
            self::$instance = new self;
        return self::$instance;
   }

   public function init(){
        add_action('elementor/widgets/widgets_registered', [$this, 'widgets_registered']);
        add_action('wp_enqueue_scripts', [$this, 'enqueue_assets']);
    }

    public function enqueue_assets() {
        wp_enqueue_style('accordion_grid_styles', plugin_dir_url(__FILE__) . '/assets/css/accordion-grid-styles.css', [], true, false);
        wp_enqueue_script('accordion_grid_scripts', plugin_dir_url(__FILE__) . '/assets/js/accordion-grid.js', [], true, true);
    }

    public function widgets_registered() {

        // We check if the Elementor plugin has been installed / activated.
        if(defined('ELEMENTOR_PATH') && class_exists('Elementor\Widget_Base')){

            // We look for any theme overrides for this custom Elementor element.
            // If no theme overrides are found we use the default one in this plugin.

            $widget_file = 'plugins/elementor/widget.php';
            $template_file = locate_template($widget_file);
            if ( !$template_file || !is_readable( $template_file ) ) {
                $template_file = plugin_dir_path(__FILE__).'widget.php';
            }
            if ( $template_file && is_readable( $template_file ) ) {
                require_once $template_file;
            }
        }
    }
}

ElementorAccordionGrid::get_instance()->init();