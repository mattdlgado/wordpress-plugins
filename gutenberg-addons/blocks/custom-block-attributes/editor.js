/**
 * Script del editor para añadir el campo de atributos personalizados
 */
(function () {
  // Verificar que WordPress esté disponible
  if (typeof wp === "undefined" || !wp.blocks || !wp.element) {
    console.error("Custom Block Attributes: WordPress no está disponible");
    return;
  }

  const { createHigherOrderComponent } = wp.compose;
  const { Fragment, createElement } = wp.element;
  const { InspectorAdvancedControls } = wp.blockEditor || wp.editor;
  const { TextareaControl } = wp.components;
  const { addFilter } = wp.hooks;

  /**
   * Añadir el atributo personalizado a todos los bloques
   */
  function addCustomAttribute(settings) {
    if (typeof settings.attributes !== "undefined") {
      settings.attributes = Object.assign(settings.attributes, {
        customHtmlAttributes: {
          type: "string",
          default: "",
        },
      });
    }
    return settings;
  }

  addFilter(
    "blocks.registerBlockType",
    "custom-block-attributes/add-attribute",
    addCustomAttribute
  );

  /**
   * Añadir el control en el Inspector (opciones avanzadas)
   */
  const withAdvancedControls = createHigherOrderComponent((BlockEdit) => {
    return (props) => {
      const { attributes, setAttributes, isSelected } = props;
      const { customHtmlAttributes } = attributes;

      return createElement(
        Fragment,
        {},
        createElement(BlockEdit, props),
        isSelected &&
          createElement(
            InspectorAdvancedControls,
            {},
            createElement(TextareaControl, {
              label: "Atributos HTML personalizados",
              help: "Añade atributos HTML adicionales (ejemplo: data-id='123' aria-label='Mi etiqueta')",
              value: customHtmlAttributes || "",
              onChange: (value) => {
                setAttributes({ customHtmlAttributes: value });
              },
              placeholder: "data-ejemplo='valor' aria-label='texto'",
            })
          )
      );
    };
  }, "withAdvancedControls");

  addFilter(
    "editor.BlockEdit",
    "custom-block-attributes/with-advanced-controls",
    withAdvancedControls
  );
})();
