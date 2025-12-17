(function (blocks, element, blockEditor, components, i18n) {
	var el = element.createElement;
	var registerBlockType = blocks.registerBlockType;
	var InspectorControls = blockEditor.InspectorControls;
	var useBlockProps = blockEditor.useBlockProps;
	var PanelBody = components.PanelBody;
	var TextareaControl = components.TextareaControl;
	var __ = i18n.__;

	registerBlockType('gutenberg-addons/svg-block', {
		title: __('SVG Block', 'gutenberg-addons'),
		icon: 'art',
		category: 'media',
		attributes: {
			svgCode: {
				type: 'string',
				default: ''
			}
		},
		edit: function (props) {
			var attributes = props.attributes;
			var setAttributes = props.setAttributes;

			function onChangeSVGCode(newCode) {
				setAttributes({ svgCode: newCode });
			}

			var blockProps = useBlockProps();

			return el(
				'div',
				blockProps,
				el(
					InspectorControls,
					{},
					el(
						PanelBody,
						{
							title: __('Configuración SVG', 'gutenberg-addons')
						},
						el(TextareaControl, {
							label: __('Código SVG', 'gutenberg-addons'),
							help: __('Pega tu código SVG aquí', 'gutenberg-addons'),
							value: attributes.svgCode,
							onChange: onChangeSVGCode,
							rows: 10
						})
					)
				),
				el('div', {
					dangerouslySetInnerHTML: { __html: attributes.svgCode }
				})
			);
		},
		save: function (props) {
			var attributes = props.attributes;
			var blockProps = useBlockProps.save();

			return el('div', {
				...blockProps,
				dangerouslySetInnerHTML: { __html: attributes.svgCode }
			});
		}
	});
})(
	window.wp.blocks,
	window.wp.element,
	window.wp.blockEditor,
	window.wp.components,
	window.wp.i18n
);
