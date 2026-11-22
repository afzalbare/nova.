# Nova WordPress Theme 🚀

**Nova** is a modern, high-performance, developer-first custom WordPress theme built for WooCommerce stores and dynamic marketing websites. It is engineered with **Tailwind CSS v4**, **ACF Pro Blocks (Block.json Architecture)**, and **GSAP Animations** to give you maximum flexibility and code reusability.

---

## ✨ Key Features

- **⚡ Tailwind CSS v4**: Built with the latest CSS-first configuration, instant JIT compilation, and zero-config utility classes.
- **🧩 Reusable Dynamic ACF Blocks**: Create a section once and use it across any page (Home, About, Shop, Landing Pages) via WordPress Gutenberg Block Editor.
- **🛒 WooCommerce Support**: Fully ready for custom eCommerce store designs, product sliders, and dynamic shopping experiences.
- **🎬 GSAP & ScrollTrigger Ready**: Pre-configured GreenSock animation platform for high-end interactive scroll reveals and effects.
- **⚙️ ACF Options Page ("Site Settings")**: Easily manage global content such as header logos, contact information, and social links in one central place.
- **📁 Clean Modular Architecture**: Structured includes (`_gutenberg.php`, `_register-navs.php`, `_woocommerce.php`) and separate asset folders.

---

## 🛠️ Prerequisites

Before you start, make sure you have the following installed on your machine:

1. **Local WordPress Environment**:
   - [Local (by Flywheel)](https://localwp.com/) *(Highly Recommended - free, fast, 1-click setup)*
   - or **XAMPP** / **WAMP** / **MAMP** / **Docker**
2. **Node.js & npm**:
   - Node.js (v18 or newer)
   - npm (v9 or newer)
3. **Required WordPress Plugins**:
   - **Advanced Custom Fields PRO (ACF Pro)** *(Essential for custom dynamic blocks & Site Settings)*
   - **WooCommerce** *(If building an eCommerce store)*

---

## 📥 Local Installation & Setup Guide

### Step 1: Set Up Local WordPress Site
1. Download and install **[Local](https://localwp.com/)**.
2. Open Local, click **"Create a new site"** (e.g. name it `nova`).
3. Choose the Preferred environment (PHP 8.2+, MySQL, Nginx/Apache).
4. Set up your WordPress username and password, then click **Add Site**.
5. Once installed, click **"Open Site Shell"** or open the site folder in File Explorer.

---

### Step 2: Clone the Theme
Open your terminal and navigate to the WordPress themes directory of your local site:

```bash
cd "path/to/your/site/app/public/wp-content/themes"
```

Clone this repository into a folder named `nova`:

```bash
git clone https://github.com/afzalbare/nova..git nova
```

---

### Step 3: Install Frontend Dependencies
Navigate into the theme's asset directory (`_`) and install npm packages:

```bash
cd nova/_
npm install
```

---

### Step 4: Run Tailwind CSS Compiler

#### For Active Development (Watch Mode):
To automatically scan your PHP files and compile CSS as you write code:
```bash
npm run dev
# or
npm run watch
```

#### For Production (Minified Build):
```bash
npm run build
```

---

### Step 5: Activate Theme & Plugins in WordPress

1. Log in to your WordPress Admin dashboard (`/wp-admin`).
2. Go to **Plugins > Add New** and activate:
   - **Advanced Custom Fields PRO**
   - **WooCommerce** (optional for shop)
3. Go to **Appearance > Themes**.
4. Activate the **Nova** theme.

---

## 🧩 How to Create Reusable Dynamic Blocks

Nova uses WordPress's native `block.json` standard combined with ACF Pro.

### 1. Create a Block Folder
Inside `wp-content/themes/nova/blocks/`, create a new folder (e.g. `promo-block`):

```text
blocks/
└── promo-block/
    ├── block.json
    └── promo-block.php
```

### 2. Configure `block.json`
```json
{
  "name": "acf/promo-block",
  "title": "Promo Block",
  "description": "Custom promotional banner section",
  "category": "layout",
  "icon": "megaphone",
  "keywords": ["promo", "banner", "offer"],
  "acf": {
    "mode": "preview",
    "renderTemplate": "promo-block.php"
  },
  "supports": {
    "align": false,
    "anchor": true
  }
}
```
*Note: Any folder added inside `blocks/` with a valid `block.json` is **automatically registered** by `_gutenberg.php`.*

### 3. Write Template Markup in `promo-block.php`
```php
<?php
$title = get_field('promo_title');
$desc  = get_field('promo_description');
$btn   = get_field('promo_button');
?>

<section class="py-16 bg-blue-600 text-white text-center">
    <div class="max-w-4xl mx-auto px-4">
        <?php if ($title) : ?>
            <h2 class="text-3xl md:text-5xl font-bold mb-4"><?php echo esc_html($title); ?></h2>
        <?php endif; ?>
        <?php if ($desc) : ?>
            <p class="text-lg opacity-90 mb-6"><?php echo esc_html($desc); ?></p>
        <?php endif; ?>
    </div>
</section>
```

### 4. Link Fields in ACF Pro Admin
1. Go to **Custom Fields > Field Groups > Add New**.
2. Add fields matching the template (`promo_title`, `promo_description`, etc.).
3. In **Location Rules**, set:  
   `Block` -> `is equal to` -> `Promo Block`.
4. Click **Save Changes** (ACF will automatically sync the configuration to `acf-json/`).

---

## 📂 Theme Directory Structure

```text
nova/
├── acf-json/                     # Automatic ACF field group JSON synchronization
├── blocks/                       # Dynamic ACF Gutenberg blocks
│   └── .gitkeep
├── layout-modules/               # Global layout parts (e.g., banners, sliders)
├── page-templates/               # Custom page templates
├── woocommerce/                  # WooCommerce template overrides
├── _/                            # Source assets and build pipeline
│   ├── css/
│   │   └── nova.min.css          # Compiled Tailwind CSS output
│   ├── js/
│   │   └── main.js               # Main custom theme script
│   ├── src/
│   │   └── input.css             # Tailwind v4 entry file with @source rules
│   ├── inc/                      # Theme setup modules
│   │   ├── _gutenberg.php        # Auto-block registration & options page
│   │   ├── _register-navs.php    # Navigation menu registration
│   │   └── _woocommerce.php      # WooCommerce theme support
│   └── package.json              # NPM scripts and dependencies
├── functions.php                 # Enqueues, theme setup & includes
├── header.php                    # Header markup with wp_head()
├── footer.php                    # Footer markup with wp_footer()
├── index.php                     # Fallback template
├── page.php                      # Standard page template (renders blocks)
├── single.php                    # Single post template
├── style.css                     # WordPress theme metadata
└── README.md                     # Documentation
```

---

## 📜 Available NPM Scripts

Inside the `wp-content/themes/nova/_` directory:

| Command | Description |
| :--- | :--- |
| `npm run dev` | Runs Tailwind CSS CLI in **watch mode** for real-time CSS rebuilding. |
| `npm run build` | Compiles and minifies Tailwind CSS for production release. |

---

## 👨‍💻 Author

- **Afzal**
- Website: [afzalbare.free.nf](https://afzalbare.free.nf/)
- GitHub: [@afzalbare](https://github.com/afzalbare)

---

## 📄 License
This project is licensed under the [ISC License](https://opensource.org/licenses/ISC).
