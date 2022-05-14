# Susina Twig Extensions

![](https://github.com/susina/twig-extensions/workflows/Tests/badge.svg)
[![License](https://img.shields.io/badge/License-Apache%202.0-blue.svg)](https://opensource.org/licenses/Apache-2.0)

Susina Twig Extensions is a set of extensions for [Twig](https://twig.symfony.com) template engine.
It contains some useful functions, tests and filters missing in the original library. 

## Installation

Firstly, install the package via Composer:

```
composer require susina/twig-extensions
```

Then add the extension you want to Twig Engine. Suppose you want to load `VariablesExtension`:

```php
<?php declare(strict_types=1);

$loader = new Twig\Loader\FileLoader(__DIR__ . '/templates');
$twig = new \Twig\Environment($loader);

$twig->addExtension(new \Susina\TwigExtensions\VariablesExtension());
```

Or, if you are working with Symfony, register the extensions you want as services and tag them as `twig.extension`:

```yaml
// In your `services.yml` file
services:
    Susina\TwigExtensions\GravatarExtension:
        tags: [twig.extension]
```

## VariablesExtension

VariablesExtension contains some tests and functions useful for manipulating variables.

### Tests

When you register this extension you can use the following type tests:

-  `array` to test if a variable is an array; Twig also has `Iterable` test but it returns true also for iterable objects.
-  `boolean` to test if a variable is boolean.
-  `float` and `double` to test if a variable is a floating point number.
-  `integer` to test if a variable is integer.
-  `object` to test if a variable is an object.
-  `scalar` to test if a variable is a scalar (see https://www.php.net/manual/en/function.is-scalar.php).
-  `string` to test if a variable is a string.
-  `instanceOf(class_name)` to test if an object is an instance of _class_name_ class  

and you can use them in your templates:

```twig
{% if variable is string %}
    The variable {{ variable }} is a string.
{% endif %}

{% if object is instanceOf('\SplStack') %}
    Object is a Stack
{% endif %}
```

### Functions

`get_type` function returns the variable type:

```twig
The variable `variable` is a {{ get_type(variable) }}.
```

`var_export` function is a wrapper for PHP [var_export](https://www.php.net/manual/en/function.var-export.php) and it
behaves in the same way. It can be useful if you want to generate some valid php code from a variable.


### Filters

`bool_to_string` filter returns the string 'true' if the variable filtered can be evaluated as _true_, otherwise
it returns the string _false_:

```twig
The "boolVariable" is {{ boolVariable|bool_to_string }}.
```
it returns `The "boolVariable" is true`.

You can customize the _true/false_ strings by passing two variables to the filter: the first one represents the 
_true_ value, the second one the _false_ value, i.e.:

```twig
The "boolVariable" is {{ boolVariable|bool_to_string('yes', 'no' }}.
```
it returns `The "boolVariable" is yes`.

## StringExtension

### Filters

You can apply `quote` filter to a string, if you want to surround it with quotes:

```twig
{% set variable = 'Donald Duck' %}

{{ variable|quote }} 
```
it returns the quoted string `'Donald Duck'`.

By default, the filter applies single quotes `'` but you can pass any character you want, as the argument of the filter:
```twig
{% set variable = 'Donald Duck' %}

{{ variable|quote('"') }} 
```
then it returns `"Donald Duck"`.


## Gravatar Extension

Gravatar extension contain a filter to retrieve the [Gravatar](https://www.gravatar.com) image from a given email.
`gravatar` filter returns the uri for the avatar and you can easily use it in your html:

```twig
<img src="{{ me@my-email.com | gravatar }}" alt="My avatar" />
```

You can also pass some options to the filter, i.e.:
```twig
<img src="{{ me@my-email.com | gravatar({ size: 200, default: mp }) }}" alt="My avatar" />
```

For a full options description, please see [https://en.gravatar.com/site/implement/images/](https://en.gravatar.com/site/implement/images/).

## Issues

We manage issues and feature requests via [Github repository issues](https://github.com/susina/twig-extensions/issues).

## Contributing

Feel free to fork and submit pull requests: all contributions are welcome!

This library includes some useful composer scripts for developers:

-  `composer test` to run the test suite
-  `composer analytics` to run [Psalm](https://psalm.dev/) static analysis tool
-  `composer cs:fix` to fix coding standard
-  `composer cs:check` to check the coding standard (see https://github.com/susina/coding-standard for details)
-  `composer coverage:html` to generate code coverage report in html format (into `/coverage` directory)
-  `composer coverage:clover` to generate code coverage report in xml format
-  `composer check` runs the first three commands

Before submitting a pull request, please run `composer check` and fix all errors.

## License

This library is released under [Apache 2.0](LICENSE) license.
