<?php

defined('ABSPATH') || exit;

class Elementor_Angular_App_Widget extends \Elementor\Widget_Base {
	public function get_name() {
		return 'angular_app';
	}

	public function get_title() {
		return esc_html__('Angular App', 'angular-embed');
	}

	public function get_icon() {
		return 'eicon-code';
	}

	public function get_categories() {
		return ['general'];
	}

	public function get_keywords() {
		return ['angular', 'app', 'embed'];
	}

	protected function register_controls() {
		$this->start_controls_section(
			'content_section',
			[
				'label' => esc_html__('Content', 'angular-embed'),
				'tab' => \Elementor\Controls_Manager::TAB_CONTENT,
			]
		);

		$this->add_control(
			'html_root_name',
			[
				'type' => \Elementor\Controls_Manager::TEXT,
				'label' => esc_html__('HTML root name', 'angular-embed'),
        'label_block' => true,
        'placeholder' => 'app-root',
        'default' => 'app-root',
      ],
		);

		$this->add_control(
			'html_cloak',
			[
				'type' => \Elementor\Controls_Manager::CODE,
				'label' => esc_html__('HTML cloak code', 'angular-embed'),
      ],
		);

		$this->end_controls_section();

		$this->start_controls_section(
			'dependencies_section',
			[
				'label' => esc_html__('Dependencies', 'angular-embed'),
				'tab' => \Elementor\Controls_Manager::TAB_CONTENT,
			]
		);

		$this->add_control(
			'scripts_list',
			[
				'type' => \Elementor\Controls_Manager::REPEATER,
				'label' => esc_html__('Script modules', 'angular-embed'),
				'fields' => [
					[
						'name' => 'script_source',
						'type' => \Elementor\Controls_Manager::TEXT,
						'label' => esc_html__('Source', 'angular-embed'),
						'label_block' => true,
						'placeholder' => '/wp-content/...',
						'default' => '',
					],
				],
				'title_field' => '{{{ script_source }}}',
				'prevent_empty' => false,
			],
		);

		$this->end_controls_section();
	}

	protected function render() {
		$settings = $this->get_settings_for_display();

    $html_root_name = esc_html($settings['html_root_name']);

    echo '<' . $html_root_name . '>' . $this->get_settings_for_display('html_cloak') . '</' . $html_root_name . '>';
	}

  public function after_render() {
    $settings = $this->get_settings_for_display();

    $scripts_list = $settings['scripts_list'];
    foreach ($scripts_list as $index => $script_item) {
      $script_id = 'ng-script-' . $index;
      $script_source = $script_item['script_source'];
      wp_enqueue_script_module($script_id, $script_source, array(), null);
    }
  }
}