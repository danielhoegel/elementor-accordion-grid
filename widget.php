<?php
namespace Elementor;

if ( ! defined( 'ABSPATH' ) ) exit; // Exit if accessed directly

class Widget_Elementor_Accordion_Grid extends Widget_Base {

    public function get_id() {
        return 'accordion-grid';
    }

    public function get_title() {
        return __( 'Accordion Grid', 'elementor-accordion-grid' );
    }

    public function get_icon() {
        // Icon name from the Elementor font file, as per http://dtbaker.net/web-development/creating-your-own-custom-elementor-widgets/
        return 'eicon-posts-grid';
    }

    public function get_name() {
        return 'accordion-grid';
    }
    
    
    protected function _register_controls() {
        $this->start_controls_section(
			'section_title',
			[
				'label' => __( 'Accordion Grid', 'elementor-accordion-grid' ),
			]
		);

        $this->add_control(
			'tabs',
			[
				'label' => __( 'Accordion Grid Items', 'elementor-accordion-grid' ),
				'type' => Controls_Manager::REPEATER,
				'default' => [
					[
						'tab_title' => __( 'Item #1', 'elementor-accordion-grid' ),
						'tab_icon' => __( 'fa fa-home', 'elementor-accordion-grid' ),
						'tab_content' => __( 'I am item content. Click edit button to change this text. Lorem ipsum dolor sit amet, consectetur adipiscing elit. Ut elit tellus, luctus nec ullamcorper mattis, pulvinar dapibus leo.', 'elementor-accordion-grid' ),
					],
					[
						'tab_title' => __( 'Item #2', 'elementor-accordion-grid' ),
						'tab_icon' => __( 'fa fa-group', 'elementor-accordion-grid' ),
						'tab_content' => __( 'I am item content. Click edit button to change this text. Lorem ipsum dolor sit amet, consectetur adipiscing elit. Ut elit tellus, luctus nec ullamcorper mattis, pulvinar dapibus leo.', 'elementor-accordion-grid' ),
					],
				],
				'fields' => [
					[
						'name' => 'tab_title',
						'label' => __( 'Title & Content', 'elementor-accordion-grid' ),
						'type' => Controls_Manager::TEXT,
						'default' => __( 'Tab Title' , 'elementor-accordion-grid' ),
						'label_block' => true,
                    ],
                    [
                        'name' => 'tab_icon',
                        'label' => __( 'Icon', 'elementor' ),
                        'type' => Controls_Manager::ICON,
                        'default' => 'fa fa-home',
                        'label_block' => true,
                    ],
					[
						'name' => 'tab_content',
						'label' => __( 'Content', 'elementor-accordion-grid' ),
						'type' => Controls_Manager::WYSIWYG,
						'default' => __( 'Tab Content', 'elementor-accordion-grid' ),
						'show_label' => false,
					],
				],
				'title_field' => '{{{ tab_title }}}',
			]
        );
        
		$this->end_controls_section();

   }

    protected function render() {
        $settings = $this->get_settings();
        $id_int = substr( $this->get_id_int(), 0, 3 );
        ?>
        <div class="accordion-grid" role="tablist">
            <?php foreach ($settings['tabs'] as $index => $item):
                $tab_count = $index + 1;
				$tab_title_setting_key = $this->get_repeater_setting_key( 'tab_title', 'tabs', $index );
				$tab_content_setting_key = $this->get_repeater_setting_key( 'tab_content', 'tabs', $index );

				$this->add_render_attribute( $tab_title_setting_key, [
					'id' => 'accordion-grid-tab-title-' . $id_int . $tab_count,
					'class' => [ 'accordion-grid__tab__title' ],
					'tabindex' => $id_int . $tab_count,
					'data-tab' => $tab_count,
					'role' => 'tab',
					'aria-controls' => 'accordion-grid--tab-content-' . $id_int . $tab_count,
				] );

				$this->add_render_attribute( $tab_content_setting_key, [
					'id' => 'accordion-grid-tab-content-' . $id_int . $tab_count,
					'class' => [ 'accordion-grid-tab-content', 'elementor-clearfix' ],
					'data-tab' => $tab_count,
					'role' => 'tabpanel',
					'aria-labelledby' => 'accordion-grid-tab-title-' . $id_int . $tab_count,
				] );

                // $this->add_inline_editing_attributes( $tab_content_setting_key, 'advanced' );
            ?>
                <div class="accordion-grid__tab">
                    <div class="accordion-grid__tab__preview">
                        <div class="accordion-grid__tab__preview__inside">
                            <div class="accordion-grid__tab__icon">
                                <i class="<?= $item['tab_icon'] ?>"></i>
                            </div>
                            <div class="accordion-grid__tab__title">
                                <?= $item['tab_title'] ?>
                            </div>
                        </div>
                    </div>
                    <div class="accordion-grid__tab__content" style="height: 0px;">
                        <div class="accordion-grid__tab__content__inside">
                            <?= $item['tab_content'] ?>
                        </div>
                    </div>
                </div>
            <?php endforeach; ?>
        </div>
        <?php
   }

    protected function content_template() {}

    public function render_plain_content( $instance = [] ) {}

}

Plugin::instance()->widgets_manager->register_widget_type( new Widget_Elementor_Accordion_Grid() );