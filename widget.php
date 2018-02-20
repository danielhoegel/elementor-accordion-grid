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
    
    /**
     * CONTENT
     */
    protected function _register_controls() {
        $this->start_controls_section(
            'section_title',
            [
                'label' => __( 'Accordion Grid', 'elementor-accordion-grid' ),
            ]
        );

        $this->add_control(
            'columns',
            [
                'label' => __( 'Columns', 'elementor-accordion-grid' ),
                'type' => Controls_Manager::SELECT,
                'default' => 'four',
                'options' => [
                    'one' => __( 'One column', 'elementor-accordion-grid' ),
                    'two' => __( 'Two columns', 'elementor-accordion-grid' ),
                    'three' => __( 'Three columns', 'elementor-accordion-grid' ),
                    'four' => __( 'Four columns', 'elementor-accordion-grid' ),
                    'five' => __( 'Five columns', 'elementor-accordion-grid' ),
                    'six' => __( 'Six columns', 'elementor-accordion-grid' ),
                ],
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
                        'label' => __( 'Title', 'elementor-accordion-grid' ),
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
                        'name' => 'tab_background_image',
                        'label' => __( 'Background Image', 'elementor' ),
                        'type' => Controls_Manager::MEDIA,
                        'default' => [ 'url' => '' ]
                    ],
                    [
                        'name' => 'tab_content',
                        'label' => __( 'Content', 'elementor-accordion-grid' ),
                        'type' => Controls_Manager::WYSIWYG,
                        'default' => __( 'Tab Content', 'elementor-accordion-grid' ),
                        'show_label' => true,
                    ],
                ],
                'title_field' => '{{{ tab_title }}}',
            ]
        );
        
		$this->end_controls_section();


        /*
         * TITLE STYLE
         */
        /* $this->start_controls_section(
			'section_toggle_style_title',
			[
				'label' => __( 'Title', 'elementor' ),
				'tab' => Controls_Manager::TAB_STYLE,
			]
		);

		$this->add_control(
			'title_color',
			[
				'label' => __( 'Color', 'elementor' ),
				'type' => Controls_Manager::COLOR,
				'selectors' => [
					'{{WRAPPER}} .elementor-accordion .elementor-tab-title' => 'color: {{VALUE}};',
				],
				'scheme' => [
					'type' => Scheme_Color::get_type(),
					'value' => Scheme_Color::COLOR_1,
				],
			]
		);

		$this->add_control(
			'tab_active_color',
			[
				'label' => __( 'Active Color', 'elementor' ),
				'type' => Controls_Manager::COLOR,
				'selectors' => [
					'{{WRAPPER}} .elementor-accordion .elementor-tab-title.elementor-active' => 'color: {{VALUE}};',
				],
				'scheme' => [
					'type' => Scheme_Color::get_type(),
					'value' => Scheme_Color::COLOR_4,
				],
			]
		);

		$this->add_group_control(
			Group_Control_Typography::get_type(),
			[
				'name' => 'title_typography',
				'selector' => '{{WRAPPER}} .elementor-accordion .elementor-tab-title',
				'scheme' => Scheme_Typography::TYPOGRAPHY_1,
			]
		);

		$this->add_responsive_control(
			'title_padding',
			[
				'label' => __( 'Padding', 'elementor' ),
				'type' => Controls_Manager::DIMENSIONS,
				'size_units' => [ 'px', 'em', '%' ],
				'selectors' => [
					'{{WRAPPER}} .elementor-accordion .elementor-tab-title' => 'padding: {{TOP}}{{UNIT}} {{RIGHT}}{{UNIT}} {{BOTTOM}}{{UNIT}} {{LEFT}}{{UNIT}};',
				],
			]
		);

        $this->end_controls_section(); */
     
        /**
         * CONTENT STYLE
         */
        /* $this->start_controls_section(
			'section_toggle_style_content',
			[
				'label' => __( 'Content', 'elementor' ),
				'tab' => Controls_Manager::TAB_STYLE,
				'condition' => [
					'icon!' => '',
				],
			]
		);

		$this->add_control(
			'content_background_color',
			[
				'label' => __( 'Background', 'elementor' ),
				'type' => Controls_Manager::COLOR,
				'selectors' => [
					'{{WRAPPER}} .elementor-accordion .elementor-tab-content' => 'background-color: {{VALUE}};',
				],
			]
		);

		$this->add_control(
			'content_color',
			[
				'label' => __( 'Color', 'elementor' ),
				'type' => Controls_Manager::COLOR,
				'selectors' => [
					'{{WRAPPER}} .elementor-accordion .elementor-tab-content' => 'color: {{VALUE}};',
				],
				'scheme' => [
					'type' => Scheme_Color::get_type(),
					'value' => Scheme_Color::COLOR_3,
				],
			]
		);

		$this->add_group_control(
			Group_Control_Typography::get_type(),
			[
				'name' => 'content_typography',
				'selector' => '{{WRAPPER}} .elementor-accordion .elementor-tab-content',
				'scheme' => Scheme_Typography::TYPOGRAPHY_3,
			]
		);

		$this->add_responsive_control(
			'content_padding',
			[
				'label' => __( 'Padding', 'elementor' ),
				'type' => Controls_Manager::DIMENSIONS,
				'size_units' => [ 'px', 'em', '%' ],
				'selectors' => [
					'{{WRAPPER}} .elementor-accordion .elementor-tab-content' => 'padding: {{TOP}}{{UNIT}} {{RIGHT}}{{UNIT}} {{BOTTOM}}{{UNIT}} {{LEFT}}{{UNIT}};',
				],
			]
		);

		$this->end_controls_section(); */

   }

    protected function render() {
        $settings = $this->get_settings();
        $id_int = substr( $this->get_id_int(), 0, 3 );
        ?>
        <div class="accordion-grid accordion-grid__columns--<?= $settings['columns'] ?>" role="tablist">
            <?php foreach ($settings['tabs'] as $index => $item):
                // $tab_count = $index + 1;
				// $tab_title_setting_key = $this->get_repeater_setting_key( 'tab_title', 'tabs', $index );
				// $tab_content_setting_key = $this->get_repeater_setting_key( 'tab_content', 'tabs', $index );

				// $this->add_render_attribute( $tab_title_setting_key, [
				// 	'id' => 'accordion-grid-tab-title-' . $id_int . $tab_count,
				// 	'class' => [ 'accordion-grid__tab__title' ],
				// 	'tabindex' => $id_int . $tab_count,
				// 	'data-tab' => $tab_count,
				// 	'role' => 'tab',
				// 	'aria-controls' => 'accordion-grid--tab-content-' . $id_int . $tab_count,
				// ] );

				// $this->add_render_attribute( $tab_content_setting_key, [
				// 	'id' => 'accordion-grid-tab-content-' . $id_int . $tab_count,
				// 	'class' => [ 'accordion-grid-tab-content', 'elementor-clearfix' ],
				// 	'data-tab' => $tab_count,
				// 	'role' => 'tabpanel',
				// 	'aria-labelledby' => 'accordion-grid-tab-title-' . $id_int . $tab_count,
				// ] );

                // $this->add_inline_editing_attributes( $tab_content_setting_key, 'advanced' );
            ?>
                
                <div class="accordion-grid__tab">
                    <div class="accordion-grid__tab__preview">
                        <?php if (!empty($item['tab_background_image']['url'] !== '') ) : ?>
                            <div
                                class="accordion-grid__tab__preview__inside accordion-grid__tab__preview__inside--bg-image"
                                style="background-image: url('<?= $item['tab_background_image']['url'] ?>')"
                            >
                        <?php else: ?>
                            <div class="accordion-grid__tab__preview__inside">
                        <?php endif; ?>
                            <?php if ($item['tab_icon'] !== ''): ?>
                                <div class="accordion-grid__tab__icon">
                                    <i class="<?= $item['tab_icon'] ?>"></i>
                                </div>
                            <?php endif; ?>
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