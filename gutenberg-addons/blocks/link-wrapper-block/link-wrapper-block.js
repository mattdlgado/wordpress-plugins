/**
 * Link Wrapper Block - Bloque contenedor de enlace para Gutenberg
 */

(function (blocks, blockEditor, components, i18n, element) {
  const { registerBlockType } = blocks;
  const { InnerBlocks, InspectorControls, useBlockProps } = blockEditor;
  const { PanelBody, TextControl, ToggleControl, RadioControl } = components;
  const { __ } = i18n;
  const { createElement: el, Fragment } = element;

  registerBlockType("custom/link-wrapper", {
    title: __("Link Wrapper", "link-wrapper"),
    description: __(
      "Un contenedor de enlace que puede contener otros bloques",
      "link-wrapper"
    ),
    icon: "admin-links",
    category: "layout",
    attributes: {
      linkType: {
        type: "string",
        default: "custom",
      },
      url: {
        type: "string",
        default: "",
      },
      opensInNewTab: {
        type: "boolean",
        default: false,
      },
    },
    supports: {
      html: false,
    },
    usesContext: ["queryId"],

    edit: function (props) {
      const { attributes, setAttributes, context } = props;
      const { linkType, url, opensInNewTab } = attributes;
      const blockProps = useBlockProps();
      const isInQueryLoop = context.queryId !== undefined;

      return el(
        Fragment,
        null,
        el(
          InspectorControls,
          null,
          el(
            PanelBody,
            { title: __("Enlace", "link-wrapper") },
            isInQueryLoop &&
              el(RadioControl, {
                label: __("Tipo de enlace", "link-wrapper"),
                selected: linkType,
                options: [
                  {
                    label: __("Permalink del post", "link-wrapper"),
                    value: "permalink",
                  },
                  {
                    label: __("URL personalizada", "link-wrapper"),
                    value: "custom",
                  },
                ],
                onChange: function (value) {
                  setAttributes({ linkType: value });
                },
              }),
            linkType === "custom" &&
              el(TextControl, {
                label: __("URL", "link-wrapper"),
                value: url,
                onChange: function (value) {
                  setAttributes({ url: value });
                },
                placeholder: "https://ejemplo.com",
                type: "url",
              }),
            el(ToggleControl, {
              label: __("Abrir en nueva pestaña", "link-wrapper"),
              checked: opensInNewTab,
              onChange: function (value) {
                setAttributes({ opensInNewTab: value });
              },
            })
          )
        ),
        el("div", blockProps, el(InnerBlocks))
      );
    },

    save: function (props) {
      const { attributes } = props;
      const { linkType, url, opensInNewTab } = attributes;
      const blockProps = useBlockProps.save();

      if (linkType === "permalink") {
        return el(
          "a",
          Object.assign({}, blockProps, {
            href: "#",
            target: opensInNewTab ? "_blank" : undefined,
            rel: opensInNewTab ? "noopener noreferrer" : undefined,
            "data-link-type": "permalink",
          }),
          el(InnerBlocks.Content)
        );
      }

      if (!url) {
        return el("div", blockProps, el(InnerBlocks.Content));
      }

      return el(
        "a",
        Object.assign({}, blockProps, {
          href: url,
          target: opensInNewTab ? "_blank" : undefined,
          rel: opensInNewTab ? "noopener noreferrer" : undefined,
        }),
        el(InnerBlocks.Content)
      );
    },
  });
})(
  window.wp.blocks,
  window.wp.blockEditor,
  window.wp.components,
  window.wp.i18n,
  window.wp.element
);
