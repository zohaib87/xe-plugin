
This `static class` is especially used to set default values for [Class Plugin Options](/class-plugin-options/).

## Path

    /plugin-folder/helpers/class-defaults.php

## Add variable

Simply add `public static` variables inside class and assign default values to it in `__construct()` function.

    // General
    public static $default;

    function __construct() {

      // General
      Self::$default = 'default';

    }

## Use variable

1. Add `use Helpers\Plugin_Name_Defaults as De` on top of the `.php` file.
2. Use it like `De::var_name` anywhere you want in your `.php` file.

<br>
