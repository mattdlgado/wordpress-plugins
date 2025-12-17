<?php

/**
 * Plugin Name: Gutenberg Addons
 * Description: Una colección modular de bloques personalizados de Gutenberg que incluye atributos HTML personalizados, bloques de botón y contenedores de enlaces
 * Version: 1.0.0
 * Author: Matt Delgado
 * Text Domain: gutenberg-addons
 * Requires at least: 6.0
 * Requires PHP: 7.4
 */

// Evitar acceso directo
if (!defined('ABSPATH')) {
    exit;
}

/**
 * Clase principal del plugin Gutenberg Addons
 */
class Gutenberg_Addons
{
    /**
     * Ruta del plugin
     */
    private $plugin_path;

    /**
     * URL del plugin
     */
    private $plugin_url;

    /**
     * Constructor
     */
    public function __construct()
    {
        $this->plugin_path = plugin_dir_path(__FILE__);
        $this->plugin_url = plugin_dir_url(__FILE__);

        // Inicializar el plugin
        add_action('init', array($this, 'init'));
    }

    /**
     * Inicializar el plugin
     */
    public function init()
    {
        // Cargar funcionalidades de atributos personalizados
        $this->load_custom_block_attributes();

        // Registrar bloques
        $this->register_blocks();
    }

    /**
     * Cargar funcionalidad de atributos personalizados para bloques
     */
    private function load_custom_block_attributes()
    {
        require_once $this->plugin_path . 'includes/class-custom-block-attributes.php';
        new Custom_Block_Attributes($this->plugin_url . 'blocks/custom-block-attributes/');
    }

    /**
     * Registrar todos los bloques
     */
    private function register_blocks()
    {
        // Registrar Custom Button Block
        $this->register_custom_button_block();

        // Registrar Link Wrapper Block
        $this->register_link_wrapper_block();

        // Registrar SVG Block
        $this->register_svg_block();
    }

    /**
     * Registrar el bloque de botón personalizado
     */
    private function register_custom_button_block()
    {
        $block_path = $this->plugin_path . 'blocks/custom-button-block';
        
        if (file_exists($block_path . '/block.json')) {
            register_block_type($block_path);
        }
    }

    /**
     * Registrar el bloque contenedor de enlace
     */
    private function register_link_wrapper_block()
    {
        $block_path = $this->plugin_path . 'blocks/link-wrapper-block/';

        wp_register_script(
            'gutenberg-addons-link-wrapper-block',
            $this->plugin_url . 'blocks/link-wrapper-block/link-wrapper-block.js',
            array('wp-blocks', 'wp-element', 'wp-block-editor', 'wp-components', 'wp-i18n'),
            filemtime($block_path . 'link-wrapper-block.js')
        );

        wp_register_style(
            'gutenberg-addons-link-wrapper-block-editor',
            $this->plugin_url . 'blocks/link-wrapper-block/editor.css',
            array('wp-edit-blocks'),
            filemtime($block_path . 'editor.css')
        );

        wp_register_style(
            'gutenberg-addons-link-wrapper-block-style',
            $this->plugin_url . 'blocks/link-wrapper-block/style.css',
            array(),
            filemtime($block_path . 'style.css')
        );

        register_block_type('custom/link-wrapper', array(
            'editor_script' => 'gutenberg-addons-link-wrapper-block',
            'editor_style' => 'gutenberg-addons-link-wrapper-block-editor',
            'style' => 'gutenberg-addons-link-wrapper-block-style',
            'render_callback' => array($this, 'link_wrapper_block_render'),
        ));
    }

    /**
     * Render callback para el bloque Link Wrapper
     * Procesa permalinks en Query Loops
     */
    public function link_wrapper_block_render($attributes, $content, $block)
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

    /**
     * Registrar el bloque SVG
     */
    private function register_svg_block()
    {
        $block_path = $this->plugin_path . 'blocks/svg-block/';

        wp_register_script(
            'gutenberg-addons-svg-block',
            $this->plugin_url . 'blocks/svg-block/svg-block.js',
            array('wp-blocks', 'wp-element', 'wp-block-editor', 'wp-components', 'wp-i18n'),
            filemtime($block_path . 'svg-block.js')
        );

        wp_register_style(
            'gutenberg-addons-svg-block-editor',
            $this->plugin_url . 'blocks/svg-block/editor.css',
            array('wp-edit-blocks'),
            filemtime($block_path . 'editor.css')
        );

        wp_register_style(
            'gutenberg-addons-svg-block-style',
            $this->plugin_url . 'blocks/svg-block/style.css',
            array(),
            filemtime($block_path . 'style.css')
        );

        register_block_type('custom/svg-block', array(
            'editor_script' => 'gutenberg-addons-svg-block',
            'editor_style' => 'gutenberg-addons-svg-block-editor',
            'style' => 'gutenberg-addons-svg-block-style',
        ));
    }
}

// Inicializar el plugin
new Gutenberg_Addons();
