# Transient plugin for Craft CMS 3.x

Store variables in Twig code, which will be available to other templates for the duration of the page load. This can be used to share values or states between multiple templates. Keep in mind that a value will only be available in templates that are parsed _after_ it was set.

No data is persisted betwen page loads. This is strictly for storing data that will be used at a later point within the same request.

### Example Use Cases

- Set a variable in an included template, and have access to it from the parent (or layout).
- Multiple "related posts" areas that should never show the same post. Store the entry IDs as they are output, and exclude them from later queries.
- Increment a counter inside an included partial, then output the total after the last item.
- Use your imagination!

## Requirements

This plugin requires Craft CMS 3.0.0 or later.

## Installation

To install the plugin, follow these instructions.

1.  Open your terminal and go to your Craft project. Then tell Composer to load the plugin:

        composer require elivz/transient

2.  In the Control Panel, go to Settings → Plugins and click the “Install” button for Transient.

## Using Transient

### Set a Variable

```twig
{% do set_transient('title', entry.title) %}
```

or

```twig
{% do craft.transient.set('title', entry.title) %}
```

This stores a variable for later use. The first parameter is the key to store it under, or key. The second parameter is the value to save.

### Output a Variable

```twig
{{ get_transient('title') }}
```

or

```twig
{{ craft.transient.get('title') }}
```

This gets a previously-stored variable. The first and only parameter is the key to retrieve.

### Append to a Variable

```twig
{% do append_transient('viewed articles', entry.id) %}
```

or

```twig
{% do craft.transient.append('viewed articles', entry.id) %}
```

Append a new value to an existing item. This only works with arrays and strings. The the existing value is an array, you are able to append either an simple string value or another array, in which case they will be merged.

### Increment a Variable

```twig
{% do increment_transient('times') %}
```

or

```twig
{% do craft.transient.increment('times') %}
```

Increment a counter. There is an optional second parameter, which is the step size to increment by. If it is left off, the value will be incremented by 1.
