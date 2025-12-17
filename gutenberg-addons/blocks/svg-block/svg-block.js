(function (blocks, element, blockEditor, components, i18n) {
    var el = element.createElement;
    var TextareaControl = components.TextareaControl;
    var InspectorControls = blockEditor.InspectorControls;
    var PanelBody = components.PanelBody;
    var useBlockProps = blockEditor.useBlockProps;
    var __ = i18n.__;

    blocks.registerBlockType('custom/svg-block', {
        title: __('SVG', 'gutenberg-addons'),
        description: __('Añade código SVG personalizado', 'gutenberg-addons'),
        icon: 'art',
        category: 'widgets',
        supports: {
            align: true,
            html: false
        },
        attributes: {
            svgCode: {
                type: 'string',
                default: '<svg width="100" height="100" xmlns="http://www.w3.org/2000/svg"><circle cx="50" cy="50" r="40" fill="#0073aa" /></svg>'
            }
        },

        edit: function (props) {
            var attributes = props.attributes;
            var setAttributes = props.setAttributes;
            var blockProps = useBlockProps ? useBlockProps() : {};

            function onChangeSVGCode(newCode) {
                setAttributes({ svgCode: newCode });
            }

            return el(
                'div',
                blockProps,
                el(InspectorControls, {},
                    el(PanelBody, { title: __('Configuración SVG', 'gutenberg-addons') },
                        el(TextareaControl, {
                            label: __('Código SVG', 'gutenberg-addons'),
                            help: __('Pega tu código SVG aquí', 'gutenberg-addons'),
                            value: attributes.svgCode,
                            onChange: onChangeSVGCode,
                            rows: 10
                        })
                    )
                ),
                el('div', { className: 'svg-preview' },
                    el('p', {}, el('strong', {}, __('Vista previa:', 'gutenberg-addons'))),
                    el('div', {
                        className: 'svg-preview-content',
                        dangerouslySetInnerHTML: { __html: attributes.svgCode }
                    })
                )
            );
        },

        save: function (props) {
            var blockProps = useBlockProps ? useBlockProps.save() : {};
            
            if (!props.attributes.svgCode) {
                return null;
            }

            // Renderizar solo el SVG sin div contenedor
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
