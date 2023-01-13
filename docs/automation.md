
## Setup

1. Remember to work on `css`, `js` and `images` inside `/assets_dev/` folder. 
2. Navigate to `node_scripts`, open `config.json` to add list of `css` and `js` files for concatenation and minification. Files will be concatenated in the order you provide.

        "concat_css": [
          "assets_dev/css/general.css",
          "assets_dev/css/blog.css",
          "assets_dev/css/pages.css",
          "assets_dev/css/widgets.css",
          "assets_dev/css/comments.css",
          "assets_dev/css/woocommerce.css",
          "assets_dev/css/forms.css"
        ],
        "min_css": [
          "assets/css/main.css"
        ],
        "concat_js": [
          "assets_dev/js/main.js"
        ],
        "min_js": [
          "assets/js/main.js"
        ],

## Start Automation

Run the following command to watch your theme files for changes and start making an awesome WordPress theme :wink:

    gulp

*To stop automation use `CTRL+C` in Windows and `CMD+C` on Mac.*

## Concatenate CSS

* Gulp will watch `CSS` files you have added in `"concat_css"` and will concatenate them on changes in the order you provided in `config.json`.

## Concatenate JS

* Gulp will watch `JS` files you have added in `"concat_js"` and will concatenate them on changes in the order you provided in `config.json`.

## Minify CSS

* Gulp will watch `main.css` files you have added in `"min_css"` and will minify it on changes.

## Minify JS

* Gulp will watch `main.js` files you have added in `"min_js"` and will minify it on changes.

## Image Optimization

* Gulp will watch `Images` inside `/assets_dev/img/` and will optimize them.

## Browser Reload

* Gulp will also watch all your files for changes and will reload the browser automatically.

<br>
