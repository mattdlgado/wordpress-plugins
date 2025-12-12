<?php

/**
 * Clase para añadir atributos HTML personalizados en las opciones avanzadas de Gutenberg
 */
class Custom_Block_Attributes
{
    /**
     * URL base para los assets
     */
    private $assets_url;

    /**
     * Constructor
     * 
     * @param string $assets_url URL base para los assets del bloque
     */
    public function __construct($assets_url)
    {
        $this->assets_url = $assets_url;

        add_action('enqueue_block_editor_assets', array($this, 'enqueue_editor_assets'));
        add_filter('render_block', array($this, 'render_custom_attributes'), 10, 2);
    }

    /**
     * Cargar el script del editor
     */
    public function enqueue_editor_assets()
    {
        $editor_js_file = $this->get_editor_file_path();

        wp_enqueue_script(
            'gutenberg-addons-custom-block-attributes-editor',
            $this->assets_url . 'editor.js',
            array('wp-blocks', 'wp-element', 'wp-editor', 'wp-components', 'wp-compose', 'wp-hooks'),
            filemtime($editor_js_file)
        );
    }

    /**
     * Obtener la ruta del archivo editor.js
     * 
     * @return string Ruta completa al archivo editor.js
     */
    private function get_editor_file_path()
    {
        $plugin_dir = plugin_dir_path(dirname(__DIR__));
        return $plugin_dir . 'blocks/custom-block-attributes/editor.js';
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
