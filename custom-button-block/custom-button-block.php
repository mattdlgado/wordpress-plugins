<?php

/**
 * Plugin Name: Custom Button Block
 * Description: Bloque Gutenberg para crear elementos button HTML simples
 * Version: 1.0.0
 * Author: Tu Nombre
 * Text Domain: custom-button-block
 */

if (!defined('ABSPATH')) {
    exit;
}

function custom_button_block_init()
{
    register_block_type(__DIR__ . '/block.json');
}
add_action('init', 'custom_button_block_init');
