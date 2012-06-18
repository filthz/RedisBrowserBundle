Overriding Default Templates
============================


As you start to incorporate FilthRedisBrowserBundle into your application, you will probably
find that you need to override the default templates that are provided by
the bundle. Although the template names are not configurable, the Symfony2
framework provides ways to override the templates of a bundle.


### Example: Overriding The Default layout.html.twig

It is highly recommended that you override the `Resources/views/layout.html.twig`
template so that the pages provided by the FilthRedisBrowserBundle have a similar look and
feel to the rest of your application. An example of overriding this layout template
is demonstrated below using both of the overriding options listed above.

Here is the default `layout.html.twig` provided by the FilthRedisBrowserBundle:

``` html+jinja
<!DOCTYPE html>
<html>
<head>
    <meta charset="UTF-8" />
    <style type="text/css">
        li { list-style: none; }
        ul.alt li { padding: 5px 7px;font-size: 13px; }
        ul.alt li.even { background: #F1F7E2; }
    </style>
</head>
<body>

<div>
    {% block filth_redis_browser_content %}
    {% endblock filth_redis_browser_content %}
</div>
</body>
</html>

```

As you can see its pretty basic and doesn't really have much structure, so you will
want to replace it with a layout file that is appropriate for your application. The
main thing to note in this template is the block named `filth_redis_browser_content`. This is
the block where the content from each of the different bundle's actions will be
displayed, so you must make sure to include this block in the layout file you will
use to override the default one.

The following Twig template file is an example of a layout file that might be used
to override the one provided by the bundle.

``` html+jinja
{% extends 'MyFoo::layout.html.twig' %}

{% block content %}
    <style type="text/css">
        li { list-style: none; word-break: break-all; }
        ul.alt li { padding: 5px 7px;font-size: 13px; }
        ul.alt li.even { background: #F1F7E2; }
    </style>
    {% block filth_redis_browser_content %}
    {% endblock filth_redis_browser_content %}
{% endblock %}
```

This example extends the layout template from a fictional application bundle named
`MyFoo`. The `content` block is where the main content of each page is rendered.
This is why the `filth_redis_browser_content` block has been placed inside of it. This will
lead to the desired effect of having the output from the FilthRedisBrowserBundle actions
integrated into our applications layout, preserving the look and feel of the
application.

**a) Define New Template In app/Resources**

The easiest way to override a bundle's template is to simply place a new one in
your `app/Resources` folder. To override the layout template located at
`Resources/views/layout.html.twig` in the `FilthRedisBrowserBundle` directory, you would place
you new layout template at `app/Resources/FilthRedisBrowserBundle/views/layout.html.twig`.

As you can see the pattern for overriding templates in this way is to
create a folder with the name of the bundle class in the `app/Resources` directory.
Then add your new template to this folder, preserving the directory structure from the
original bundle.
