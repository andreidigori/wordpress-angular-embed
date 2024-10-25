<?php
/*
 * Plugin Name: Angular embed
 * Plugin URI: https://github.com/andreidigori/wordpress-angular-embed
 * Description: Wordpress plugin for embedding Angular apps.
 * Version: 1.0.0
 * Author: Andrei Digori
 * Author URI: https://github.com/andreidigori
 * License: MIT
 */

defined('ABSPATH') || exit;

class Angular_Embed {
  static function init() {
    self::init_elementor();
  }

  static function init_elementor() {
    add_action('elementor/widgets/register', array(self::class, 'register_elementor_widgets'));
  }

  static function register_elementor_widgets($widgets_manager) {
    require_once plugin_dir_path(__FILE__) . '/elementor/widgets/angular-app-widget.php';
    
    $widgets_manager->register(new \Elementor_Angular_App_Widget());
  }
}

Angular_Embed::init();
