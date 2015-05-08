Tc Pjax Bundle
==============

[![Latest Stable Version](https://poser.pugx.org/tc/pjax-bundle/v/stable)](https://packagist.org/packages/tc/pjax-bundle)

[![SensioLabsInsight](https://insight.sensiolabs.com/projects/bbd5db07-5a61-4ca2-b081-2dc0c94e7cb4/big.png)](https://insight.sensiolabs.com/projects/bbd5db07-5a61-4ca2-b081-2dc0c94e7cb4)

Integrates Pjax to Symfony


Installation
------------

```
composer require tc/pjax-bundle
```

Enable the bundle in your `AppKernel.php`

```php
$bundles = array(
    // ...
    
    new Tc\Bundle\Pjax\TcPjaxBundle(),
    
    // ...
);
```

Include the scripts in your templates

```twig
<script src="{{ asset('bundles/tcpjax/vendor/jquery.js') }}"></script>
<script src="{{ asset('bundles/tcpjax/vendor/jquery.pjax.js') }}"></script>
<script src="{{ asset('bundles/tcpjax/js/tc-pjax.js') }}"></script>

{# OR #}

{% javascripts
 '@TcPjaxBundle/Resources/public/vendor/jquery.js'
 '@TcPjaxBundle/Resources/public/vendor/jquery.pjax.js'
 '@TcPjaxBundle/Resources/public/js/tc-pjax.js'
%}
<script src="{{ asset_url }}"></script>
{% endjavascripts %}
```


Usage
------

You will now want to create a pjax container, and different layouts for `full` and `pjax`

#### base.html.twig

```twig
<!DOCTYPE html>
<html lang="en">
<head>
  <meta http-equiv="X-UA-Compatible" content="IE=edge"/>
  <meta charset="utf-8">
  <title>{% block title %}{% endblock %}</title>
</head>
<body>
{% block body %}{% endblock %}
<script src="{{ asset('bundles/tcpjax/vendor/jquery.js') }}"></script>
<script src="{{ asset('bundles/tcpjax/vendor/jquery.pjax.js') }}"></script>
<script src="{{ asset('bundles/tcpjax/js/tc-pjax.js') }}"></script>
</body>
</html>
```

#### base-pjax.html.twig

```twig
<title>{% block title %}{% endblock %}</title>
{% block body_inner %}{% endblock %}
```

#### your-layout.html.twig

```twig
{% extends pjax('#your-layout', '::base.html.twig', '::base-pjax.html.twig') %}

{% block title %}Your Title{% endblock %}

{% block body %}

	<div {{ pjaxContainer('#your-layout', app.debug) }}>

    {% block body_inner %}

      <h1>Your Content</h1>

    {% endblock %}

	</div>

{% endblock %}

```


License
-------

TcPjaxBundle is licensed with the MIT license.

See LICENSE for more details.
