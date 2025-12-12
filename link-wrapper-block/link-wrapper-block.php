<?php

/**
 * Plugin Name: Link Wrapper Block
 * Description: Bloque contenedor que convierte cualquier elemento en un enlace clickeable
 * Version: 1.0.0
 * Author: Tu Nombre
 * Text Domain: link-wrapper
 */

if (!defined('ABSPATH')) {
    exit;
}

function link_wrapper_block_register()
{
    wp_register_script(
        'link-wrapper-block',
        plugins_url('link-wrapper-block.js', __FILE__),
        array('wp-blocks', 'wp-element', 'wp-block-editor', 'wp-components', 'wp-i18n'),
        filemtime(plugin_dir_path(__FILE__) . 'link-wrapper-block.js')
    );

    wp_register_style(
        'link-wrapper-block-editor',
        plugins_url('editor.css', __FILE__),
        array('wp-edit-blocks'),
        filemtime(plugin_dir_path(__FILE__) . 'editor.css')
    );

    wp_register_style(
        'link-wrapper-block-style',
        plugins_url('style.css', __FILE__),
        array(),
        filemtime(plugin_dir_path(__FILE__) . 'style.css')
    );

    register_block_type('custom/link-wrapper', array(
        'editor_script' => 'link-wrapper-block',
        'editor_style' => 'link-wrapper-block-editor',
        'style' => 'link-wrapper-block-style',
        'render_callback' => 'link_wrapper_block_render',
    ));
}
add_action('init', 'link_wrapper_block_register');

/**
 * Render callback para procesar permalinks en Query Loops
 */
function link_wrapper_block_render($attributes, $content, $block)
{
    if (strpos($content, 'data-link-type="permalink"') !== false && isset($block->context['postId'])) {
        $post_id = $block->context['postId'];
        $permalink = get_permalink($post_id);

        if ($permalink) {
            $content = str_replace('href="#"', 'href="' . esc_url($permalink) . '"', $content);
            $content = str_replace(' data-link-type="permalink"', '', $content);
        }
    }

    return $content;
}
