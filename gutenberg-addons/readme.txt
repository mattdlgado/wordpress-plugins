=== Gutenberg Addons ===
Contributors: mattdlgado
Tags: gutenberg, blocks, custom attributes, button, link wrapper
Requires at least: 6.0
Tested up to: 6.4
Requires PHP: 7.4
Stable tag: 1.0.0
License: GPLv2 or later
License URI: https://www.gnu.org/licenses/gpl-2.0.html

Una colección modular de bloques personalizados de Gutenberg que mejoran y amplían las capacidades del editor de bloques de WordPress.

== Description ==

Gutenberg Addons es un plugin completo que unifica múltiples extensiones de Gutenberg en una solución modular, profesional y fácil de mantener. Este plugin incluye tres componentes principales:

= Características principales =

**1. Custom Block Attributes (Atributos HTML Personalizados)**
Añade un campo para atributos HTML personalizados en las opciones avanzadas de cualquier bloque de Gutenberg. Permite agregar atributos como `data-*`, `aria-*`, y otros atributos HTML estándar a cualquier bloque.

* Añade atributos personalizados a través del panel de opciones avanzadas
* Sanitización automática de seguridad
* Compatible con todos los bloques de Gutenberg

**2. Custom Button Block (Bloque de Botón Personalizado)**
Un bloque Gutenberg para crear elementos button HTML simples con texto editable.

* Crea botones HTML nativos (`<button>`)
* Editor de texto enriquecido
* Soporte para clases CSS personalizadas

**3. Link Wrapper Block (Bloque Contenedor de Enlace)**
Un bloque contenedor que convierte cualquier elemento en un enlace clickeable, incluyendo soporte especial para Query Loops.

* Contenedor que puede contener otros bloques
* Dos modos: URL personalizada o permalink del post
* Soporte para Query Loops de WordPress
* Opción de abrir en nueva pestaña
* Estilos optimizados para editor y frontend

= Casos de uso =

* Añadir atributos `data-*` para integración con JavaScript
* Añadir atributos `aria-*` para mejorar la accesibilidad
* Crear botones HTML nativos en lugar de enlaces estilizados
* Convertir tarjetas de blog completas en enlaces clickeables
* Crear diseños de grid donde cada elemento es clickeable

= Estructura modular =

El plugin está diseñado con una arquitectura modular que facilita el mantenimiento y la expansión futura:

* Cada bloque está en su propia carpeta
* Sistema de registro centralizado
* Código organizado siguiendo las mejores prácticas de WordPress

== Installation ==

1. Sube la carpeta `gutenberg-addons` al directorio `/wp-content/plugins/`
2. Activa el plugin a través del menú 'Plugins' en WordPress
3. Los nuevos bloques aparecerán automáticamente en el editor de Gutenberg

== Frequently Asked Questions ==

= ¿Este plugin funciona con cualquier tema? =

Sí, Gutenberg Addons funciona con cualquier tema que soporte Gutenberg/Block Editor.

= ¿Puedo usar estos bloques con bloques nativos de WordPress? =

Sí, los bloques de este plugin se integran perfectamente con todos los bloques nativos de WordPress.

= ¿Los atributos personalizados son seguros? =

Sí, el plugin incluye sanitización automática que elimina eventos JavaScript inseguros como `onclick`, `onload`, etc.

= ¿El Link Wrapper Block funciona en Query Loops? =

Sí, el Link Wrapper Block tiene soporte especial para Query Loops y puede usar automáticamente el permalink del post actual.

== Screenshots ==

1. Panel de opciones avanzadas mostrando el campo de atributos HTML personalizados
2. Bloque de botón personalizado en el editor
3. Link Wrapper Block con opciones de configuración
4. Ejemplo de Link Wrapper en un Query Loop

== Changelog ==

= 1.0.0 =
* Versión inicial del plugin unificado
* Incluye Custom Block Attributes (atributos HTML personalizados)
* Incluye Custom Button Block (bloque de botón)
* Incluye Link Wrapper Block (contenedor de enlace)
* Arquitectura modular y profesional
* Compatibilidad con WordPress 6.0+

== Upgrade Notice ==

= 1.0.0 =
Versión inicial del plugin unificado Gutenberg Addons.

== Technical Details ==

= Custom Block Attributes =
* Añade el atributo `customHtmlAttributes` a todos los bloques
* Hook de filtro: `render_block`
* Sanitización automática de seguridad

= Custom Button Block =
* Namespace: `custom/button-block`
* Usa `@wordpress/scripts` para compilación
* Elemento HTML: `<button>`

= Link Wrapper Block =
* Namespace: `custom/link-wrapper`
* Usa contexto de Query Loop cuando está disponible
* Render callback para procesamiento dinámico de permalinks

== Development ==

El código fuente está organizado de la siguiente manera:

* `/blocks/` - Contiene todos los bloques individuales
* `/includes/` - Funcionalidades PHP compartidas
* `/assets/` - Recursos compartidos (CSS/JS globales)
* `/languages/` - Archivos de traducción

Para contribuir o reportar problemas, visita el repositorio del proyecto.
