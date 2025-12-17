(function (blocks, element, blockEditor, components, i18n) {
    var el = element.createElement;
    var TextareaControl = components.TextareaControl;
    var useBlockProps = blockEditor.useBlockProps || blockEditor.__experimentalUseBlockProps;
    var __ = i18n.__;

    blocks.registerBlockType('custom/svg-block', {
        title: __('SVG', 'gutenberg-addons'),
        description: __('Añade código SVG personalizado', 'gutenberg-addons'),
        icon: 'art',
        category: 'embed',
        supports: {
            align: true,
            alignWide: true,
            html: false
        },
        attributes: {
            svgCode: {
                type: 'string',
                default: ''
            }
        },

        edit: function (props) {
            var attributes = props.attributes;
            var setAttributes = props.setAttributes;
            var blockProps = useBlockProps ? useBlockProps() : {};

            function onChangeSVGCode(newCode) {
                setAttributes({ svgCode: newCode });
            }

            // Si no hay código SVG, mostrar el placeholder
            if (!attributes.svgCode || attributes.svgCode.trim() === '') {
                return el(
                    'div',
                    blockProps,
                    el('div', { className: 'components-placeholder' },
                        el('div', { className: 'components-placeholder__label' },
                            el('span', { className: 'dashicon dashicons dashicons-art' }),
                            __('SVG', 'gutenberg-addons')
                        ),
                        el('div', { className: 'components-placeholder__instructions' },
                            __('Introduce tu código SVG', 'gutenberg-addons')
                        ),
                        el(TextareaControl, {
                            label: '',
                            value: attributes.svgCode,
                            onChange: onChangeSVGCode,
                            placeholder: '<svg>...</svg>',
                            rows: 8,
                            className: 'svg-code-input'
                        })
                    )
                );
            }

            // Si hay código SVG, mostrar preview con opción de editar
            return el(
                'div',
                blockProps,
                el('div', { className: 'wp-block-svg-preview' },
                    el('div', {
                        className: 'svg-preview-content',
                        dangerouslySetInnerHTML: { __html: attributes.svgCode }
                    }),
                    el('div', { className: 'svg-edit-controls' },
                        el(components.Button, {
                            isSecondary: true,
                            onClick: function() {
                                setAttributes({ svgCode: '' });
                            }
                        }, __('Editar SVG', 'gutenberg-addons'))
                    )
                )
            );
        },

        save: function (props) {
            var blockProps = useBlockProps ? useBlockProps.save() : {};
            
            // Renderizar solo el SVG sin contenedores adicionales
            if (!props.attributes.svgCode) {
                return null;
            }

            // Retornar el SVG directamente usando RawHTML
            return el(element.RawHTML, blockProps, props.attributes.svgCode);
        }
    });
})(
    window.wp.blocks,
    window.wp.element,
    window.wp.blockEditor,
    window.wp.components,
    window.wp.i18n
);
