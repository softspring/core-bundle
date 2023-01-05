# Base template

There is a general purpose twig base template that provides a common structure:

```twig
{# templates/base.html.twig #}
{% extends '@SfsComponents/base.html.twig' %} 
```

Also you can define as optional in your bundles:

```twig
{% extends ['@SfsComponents/base.html.twig', 'base.html.twig'] %} 
```