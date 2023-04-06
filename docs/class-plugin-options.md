
Unlike `Default Class` this class is not static and is especially used to get values using [get_option()](#.) for [Plugin Options Page](/plugin-options/).

## Path

    /plugin-folder/helpers/class-plugin-options.php

## Initialize variables

Simply add `public` variables inside class and assign values to it in `init_vars()` function.

    $this->var_name = get_option('unique_id', De::$default);

## How to use?

This class is initialized by default into a global variable. You can see the variable name at the end of the class.

    global $xep_opt;
    $xep_opt = new Xe_Plugin_Options();

You will be able to use any where in your plugin after calling it.

    global $xep_opt;
    echo $xep_opt->default;

## Built-in variables

Here are some variables that are already added. You can either use them or remove them if not needed.

### localhost

* Returns true if the current environment is localhost, and false if its live server.
* Useful for point of sale plugins.

<br>
