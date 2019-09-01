
[![Latest Version on Packagist](https://poser.pugx.org/reecem/ignition-git/v/stable)](https://packagist.org/packages/ReeceM/ignition-git)
[![Build Status](https://travis-ci.com/ReeceM/ignition-git.svg?branch=master)](https://travis-ci.com/ReeceM/ignition-git)
[![codecov](https://codecov.io/gh/ReeceM/ignition-git/branch/master/graph/badge.svg)](https://codecov.io/gh/ReeceM/ignition-git)
[![Total Downloads](https://poser.pugx.org/reecem/ignition-git/downloads)](https://packagist.org/packages/reecem/ignition-git)
<!-- [![Quality Score](https://img.shields.io/scrutinizer/g/reecem/ignition-git.svg?style=flat-square)](https://scrutinizer-ci.com/g/reecem/ignition-git) -->


This package adds the ability to open a new issue from your ignition tab and edit the data that would be set for the issue

![Screenshot of ignition git tab](https://reecem.github.io/ignition-git/screenshot.png)

## Installation

You can install the package in to a Laravel app that uses [Ignition](https://flareapp.io) via composer:

```bash
composer require reecem/ignition-git-tab
```

If you would like to edit the configs you can publish the service provider

```bash
php artisan vendor:publish --tag=ignition-git
```
You can then see the base template for the issue, you can edit it, the thins between `:   :` are the strings replace. 
(More complex thing coming)

## Usage

1. Generate a new OAuth Token for your account 
    - on GitHub [GitHub Personal Tokens](https://github.com/settings/tokens) (Only need to tick repo access !!)
    - on Gitlab [Gitlab Personal Token](https://gitlab.com/profile/personal_access_tokens) (Only give repo access to write)
    - ? others... PR pls

2. Add the token to you environment with `IGNITION_GIT_TOKEN="token_me_here"`

3. Make an error somewhere 

Click on the "Open Issue" tab on your Ignition screen to see the tool provided by this package.

Once there edit the data and click submit :)

### Testing

``` bash
composer test
```

### Changelog

Please see [CHANGELOG](CHANGELOG.md) for more information on what has changed recently.

## Contributing

Please see [CONTRIBUTING](CONTRIBUTING.md) for details.

### Security

If you discover any security related issues, please email ziggyelec@gmail.com instead of using the issue tracker.

## Credits

- [ReeceM](https://github.com/ReeceM)

## License

The MIT License (MIT). Please see [License File](LICENSE.md) for more information.
