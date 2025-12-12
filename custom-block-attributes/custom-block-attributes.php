<?php

/**
 * Plugin Name: Custom Block Attributes
 * Description:  Añade un campo para atributos HTML personalizados en las opciones avanzadas de Gutenberg
 * Version: 1.0.0
 * Author: Tu Nombre
 * Text Domain: custom-block-attributes
 */

// Evitar acceso directo
if (!defined('ABSPATH')) {
    exit;
}

class Custom_Block_Attributes
{

    public function __construct()
    {
        add_action('enqueue_block_editor_assets', array($this, 'enqueue_editor_assets'));
        add_filter('render_block', array($this, 'render_custom_attributes'), 10, 2);
    }

    /**
     * Cargar el script del editor
     */
    public function enqueue_editor_assets()
    {
        wp_enqueue_script(
            'custom-block-attributes-editor',
            plugins_url('editor.js', __FILE__),
            array('wp-blocks', 'wp-element', 'wp-editor', 'wp-components', 'wp-compose', 'wp-hooks'),
            filemtime(plugin_dir_path(__FILE__) . 'editor.js')
        );
    }

    /**
     * Añadir los atributos personalizados al renderizar el bloque
     */
    public function render_custom_attributes($block_content, $block)
    {
        if (!empty($block['attrs']['customHtmlAttributes'])) {
            $custom_attrs = $block['attrs']['customHtmlAttributes'];

            // Sanitizar los atributos
            $custom_attrs = trim($custom_attrs);
            $custom_attrs = str_replace(array("\r", "\n", "\t"), ' ', $custom_attrs);

            // Eliminar eventos JavaScript inseguros
            $custom_attrs = preg_replace('/on\w+\s*=/i', '', $custom_attrs);

            if (!empty($custom_attrs)) {
                // Intentar insertar en la primera etiqueta HTML
                // Soporta etiquetas con o sin atributos existentes
                $modified = preg_replace(
                    '/^(\s*)(<[a-z][a-z0-9]*\b)([^>]*)(\/?>)/is',
                    '$1$2$3 ' . $custom_attrs . '$4',
                    $block_content,
                    1,
                    $count
                );

                // Si la regex funcionó, usar el contenido modificado
                if ($count > 0) {
                    $block_content = $modified;
                }
            }
        }

        return $block_content;
    }
}

// Inicializar el plugin
new Custom_Block_Attributes();
