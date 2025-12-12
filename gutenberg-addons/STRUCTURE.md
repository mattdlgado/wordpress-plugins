# Gutenberg Addons - Plugin Structure

## Directory Tree

```
gutenberg-addons/
├── gutenberg-addons.php          # Main plugin file with centralized registration
├── readme.txt                     # WordPress plugin documentation
├── .gitignore                     # Git ignore rules
│
├── blocks/                        # All Gutenberg blocks
│   ├── custom-block-attributes/   # Custom HTML attributes for all blocks
│   │   └── editor.js             # Editor script for attribute control
│   │
│   ├── custom-button-block/       # Native HTML button block
│   │   ├── block.json            # Block metadata
│   │   ├── package.json          # NPM dependencies
│   │   └── build/                # Compiled assets
│   │       ├── index.js          # Compiled block script
│   │       └── index.asset.php   # Asset dependencies
│   │
│   └── link-wrapper-block/        # Link container block
│       ├── link-wrapper-block.js # Block registration and logic
│       ├── editor.css            # Editor-only styles
│       └── style.css             # Frontend styles
│
├── includes/                      # PHP classes and utilities
│   └── class-custom-block-attributes.php  # Custom attributes handler
│
├── assets/                        # Shared assets (CSS/JS globals)
│   └── (empty - reserved for future use)
│
└── languages/                     # Internationalization files
    └── (empty - reserved for future use)
```

## Plugin Components

### 1. Custom Block Attributes
- **Purpose**: Adds custom HTML attributes to any Gutenberg block
- **Files**: 
  - `blocks/custom-block-attributes/editor.js`
  - `includes/class-custom-block-attributes.php`
- **Features**:
  - Adds control in Advanced panel of all blocks
  - Sanitizes attributes for security
  - Supports data-* and aria-* attributes

### 2. Custom Button Block
- **Namespace**: `custom/button-block`
- **Files**: 
  - `blocks/custom-button-block/block.json`
  - `blocks/custom-button-block/build/index.js`
- **Features**:
  - Creates native HTML `<button>` elements
  - Editable text content
  - Supports custom CSS classes

### 3. Link Wrapper Block
- **Namespace**: `custom/link-wrapper`
- **Files**: 
  - `blocks/link-wrapper-block/link-wrapper-block.js`
  - `blocks/link-wrapper-block/editor.css`
  - `blocks/link-wrapper-block/style.css`
- **Features**:
  - Container block that makes content clickable
  - Query Loop support with dynamic permalinks
  - Custom URL or post permalink modes
  - Open in new tab option

## Registration System

All blocks are registered through the main plugin class (`Gutenberg_Addons`) in `gutenberg-addons.php`:

1. **Custom Block Attributes**: Loaded as a class and instantiated
2. **Custom Button Block**: Registered via `register_block_type()` with block.json
3. **Link Wrapper Block**: Registered with custom scripts/styles and render callback

## Development

- The plugin follows WordPress Coding Standards
- Each block is modular and self-contained
- The structure supports easy addition of new blocks
- Build tools (for custom-button-block): `npm run build` or `npm run start`

## Migration Notes

This plugin consolidates three separate plugins:
- `custom-block-attributes` → `blocks/custom-block-attributes/`
- `custom-button-block` → `blocks/custom-button-block/`
- `link-wrapper-block` → `blocks/link-wrapper-block/`

All functionality has been preserved while improving:
- Organization and maintainability
- Code reusability
- Plugin management (single activation)
- Update distribution
