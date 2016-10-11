# Skydrop PHP
This is a library to easily consume the Skydrop REST API

## Installation

Require the skydrop-php in your composer.json:

```json
{
    "require": {
        "skydropx/skydrop-php": "1.0.*"
    }
}
```

And then execute:

    $ composer install

## Usage

Set your Skydrop API key

```php
Skydrop\Configs::setApiKey('your_api_key');

// Use any of the resources
$shippingRate = new Skydrop\ShippingRates();
$shippingRate->all();
```

## Installation

to run testing, install php-timecop:
```
https://github.com/hnw/php-timecop
```

License
-------
Developed by [Skydrop](http://www.skydrop.com.mx). Available with [MIT License](LICENSE).

We are hiring
-------------

If you are a comfortable working with a range of backend languages (Ruby, Node.js, Vuejs, Javascript, PHP) and frameworks,
you have solid foundation in data structures, algorithms and software design with strong analytical and debugging skills.
Send your CV, github url to arnoldo@skydrop.com.mx
