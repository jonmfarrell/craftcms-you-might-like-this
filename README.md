# craftcms-you-might-like-this

## Description

This is a Craft plugin that is designed to enhance Craft Commerce. It allows you to show products that other users have purchased in addition to the product currently being viewed. This plugin is under active development so free to send requests for additional features.

> This plugin is in *beta*, so please test that this plugin works as expected on a *development* environment _before_ pushing to a production site.

## How it Works

This plugin keeps track of which products have been purchased and what they've been purchased with. So if one user purchases product Foo and Bar together, you can show on the Foo product page that when purchasing this product other users have also purchased Bar, and vice versa. Then if second person comes and purchases Foo, Bar, and Baz together the Foo product page will show that other users have purchased both Bar and Baz with it in that order because Bar was purchased twice with Foo and Baz was purchased once with Foo.

## Installation

To install, follow these steps:

1. Download & unzip the file.
2. Copy the `mightlike` directory into your `craft/plugins` directory
3. Go to the Craft admin panel and enable the plugin from the plugins section

## Usage

To see products that other customers have purchased in addition to a given item you would add something like this to the product entry template:

```
<div>
  <h3>Along with this, customers have also purchased:</h3>
  <ul class="products">
  {% for product in craft.mightlike.getRelatedProductsByCount(product.id) %}
    <li class="product">{{ product.title }}</li>
  {% endfor %}
  </ul>
</div>
```
