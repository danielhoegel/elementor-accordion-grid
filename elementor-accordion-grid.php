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
        add_action( 'elementor/controls/controls_registered', [$this, 'modify_icon_control'], 10, 1 );
    }

    public function enqueue_assets() {
        wp_enqueue_style('accordion_grid_styles', plugin_dir_url(__FILE__) . '/assets/css/accordion-grid-styles.css', [], true, false);
        wp_enqueue_script('accordion_grid_scripts', plugin_dir_url(__FILE__) . '/assets/js/accordion-grid.js', [], true, true);
        wp_enqueue_style('custom_icon_font', plugin_dir_url(__FILE__) . '/assets/fonts/custom-icon-font/style.css');
    }

    public function modify_icon_control( $controls_registry ) {
        $icons = $controls_registry->get_control( 'icon' )->get_settings( 'options' );
        $new_icons = [
            'custom-icon custom-icon-diversity' => 'diversity',
            'custom-icon custom-icon-diversity-o' => 'diversity-o',
            'custom-icon custom-icon-diversity-circles' => 'diversity-circles',
            'custom-icon custom-icon-link' => 'link'
        ];
        $combined_icons = array_merge($new_icons , $icons );
        $controls_registry->get_control( 'icon' )->set_settings( 'options', $combined_icons );
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