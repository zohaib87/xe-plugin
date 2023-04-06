
As the name suggests this `static class` is for to add all the functions that will ease your plugin development and functionality.

## Path

    /plugin-folder/helpers/class-helpers.php

## How to use?

Simply add `public static` methods and use them as `PHP` namespace classes are used.

    use Helpers\Plugin_Name_Helpers as Helper;

    Helper::method_name();

## Built-in methods

Here are some methods that are already added. You can either use them or remove them if not needed.

### enqueue

Enqueue style or script with auto version control. Wrapped on top of both WordPress `wp_enqueue_style` and `wp_enqueue_script` functions.

    enqueue($script, $handle, $src = '', $deps = array(), $media = 'all', $in_footer = true, $ver = '')

* **$script** Accepts 'style' or 'script'
* **$handle** Name of the script. Should be unique.
* **$src** Path of the script relative to plugins folder.
* **$deps** An array of registered script handles this script depends on.
* **$media** The media for which this stylesheet has been defined.
* **$in_footer** Whether to enqueue the script before `</body>` instead of in the `<head>`. Default is `true`.
* **$ver** Version of the script. File time will be used if empty.

<br>
