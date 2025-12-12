# Gutenberg Addons

Una colección modular de bloques personalizados de Gutenberg que mejoran y amplían las capacidades del editor de bloques de WordPress.

## 📋 Descripción

Gutenberg Addons unifica tres extensiones de Gutenberg en una solución modular, profesional y fácil de mantener. Este plugin incluye:

### 🎯 Bloques Incluidos

1. **Custom Block Attributes** - Añade atributos HTML personalizados a cualquier bloque
   - Añade `data-*`, `aria-*` y otros atributos HTML
   - Panel de configuración en opciones avanzadas
   - Sanitización automática de seguridad

2. **Custom Button Block** - Crea botones HTML nativos
   - Elemento `<button>` nativo (no un enlace estilizado)
   - Editor de texto enriquecido
   - Soporte para clases CSS personalizadas

3. **Link Wrapper Block** - Contenedor que convierte cualquier elemento en un enlace
   - Contiene otros bloques dentro
   - Soporte para Query Loops de WordPress
   - Modo permalink o URL personalizada
   - Opción de abrir en nueva pestaña

## 🚀 Instalación

1. Descarga o clona este repositorio
2. Copia la carpeta `gutenberg-addons` a `/wp-content/plugins/`
3. Activa el plugin desde el menú de Plugins en WordPress
4. Los bloques aparecerán automáticamente en el editor de Gutenberg

## 📁 Estructura del Plugin

```
gutenberg-addons/
├── gutenberg-addons.php          # Archivo principal del plugin
├── readme.txt                     # Documentación de WordPress
├── blocks/                        # Todos los bloques
│   ├── custom-block-attributes/
│   ├── custom-button-block/
│   └── link-wrapper-block/
├── includes/                      # Clases PHP compartidas
├── assets/                        # Recursos compartidos
└── languages/                     # Traducciones
```

Ver [STRUCTURE.md](STRUCTURE.md) para más detalles sobre la arquitectura.

## 💻 Desarrollo

### Requisitos

- WordPress 6.0 o superior
- PHP 7.4 o superior

### Build del Custom Button Block

Si necesitas recompilar el bloque de botón:

```bash
cd blocks/custom-button-block
npm install
npm run build  # o npm run start para modo desarrollo
```

## 🔧 Uso

### Custom Block Attributes

1. Selecciona cualquier bloque en el editor
2. Ve a "Opciones avanzadas" en el panel lateral
3. Añade tus atributos HTML en el campo "Atributos HTML personalizados"
4. Ejemplo: `data-id="123" aria-label="Mi elemento"`

### Custom Button Block

1. Añade el bloque "Botón Personalizado" desde el inserter
2. Escribe el texto del botón
3. Añade clases CSS o atributos personalizados según necesites

### Link Wrapper Block

1. Añade el bloque "Link Wrapper"
2. Añade otros bloques dentro del contenedor
3. Configura la URL en el panel lateral
4. En Query Loops, puedes seleccionar "Permalink del post" para enlaces dinámicos

## 🔒 Seguridad

- Sanitización automática de atributos HTML
- Eliminación de eventos JavaScript inseguros (`onclick`, etc.)
- Sin vulnerabilidades detectadas por CodeQL

## 📝 Changelog

### 1.0.0 (2024)
- ✨ Versión inicial del plugin unificado
- ✅ Migración completa de tres plugins independientes
- 🏗️ Arquitectura modular y escalable
- 📚 Documentación completa

## 🤝 Contribución

Las contribuciones son bienvenidas. Por favor:

1. Fork el proyecto
2. Crea una rama para tu feature (`git checkout -b feature/AmazingFeature`)
3. Commit tus cambios (`git commit -m 'Add some AmazingFeature'`)
4. Push a la rama (`git push origin feature/AmazingFeature`)
5. Abre un Pull Request

## 📄 Licencia

GPL v2 o posterior - Ver [LICENSE](https://www.gnu.org/licenses/gpl-2.0.html)

## 👤 Autor

Matt Delgado - [@mattdlgado](https://github.com/mattdlgado)

## 🙏 Agradecimientos

Este plugin consolida y mejora tres plugins independientes originales:
- custom-block-attributes
- custom-button-block  
- link-wrapper-block

---

**¿Te resultó útil este plugin?** ⭐ ¡Dale una estrella al repositorio!
