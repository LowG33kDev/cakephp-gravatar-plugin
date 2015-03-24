# cakephp-gravatar-plugin [![Build Status](https://travis-ci.org/LowG33kDev/cakephp-gravatar-plugin.svg?branch=master)](https://travis-ci.org/LowG33kDev/cakephp-gravatar-plugin)
It's a CakePHP plugin for easily use Gravatar service.

## Installation
_[Manual]_

* Download the [Gravatar archive](https://github.com/LowG33kDev/cakephp-gravatar-plugin/zipball/master).
* Unzip that download.
* Rename the resulting folder to `Gravatar`
* Then copy this folder into `app/Plugin/`

_[GIT Submodule]_

In your app directory type:

```bash
git submodule add git://github.com/LowG33kDev/cakephp-gravatar-plugin.git Plugin/Gravatar
git submodule init
git submodule update
```

_[GIT Clone]_

In your plugin directory type

```bash
git clone git://github.com/LowG33kDev/cakephp-gravatar-plugin.git Gravatar
```

### Enable plugin

* In 2.x you need to enable the plugin your `app/Config/bootstrap.php` file. If you are already using `CakePlugin::loadAll();`, then the following is not necessary.:
```php
    CakePlugin::load('Gravatar');
```

## Reporting Issues

If you have a problem with Grvatar please open an issue on [GitHub](https://github.com/LowG33kDev/cakephp-gravatar-plugin/issues).

# Documentation
This plugin uses [Gravatar](http://en.gravatar.com/site/implement/images/) configurations

- secure : true to use https, false otherwise (default is false)
- extension : .jpg, .jpeg, .png or .gif (default is empty)
- size : beetween 1 and 2048 (default is 80)
- default : mm, identicon, monsterid, wavatar, retro, blank or custom url picture (default is mm)
- forcedefault : true to force default picture, false otherwise (default is false)
- rating : g, pg, r or x (default is g)
- image-options : is an array. It's the same like HTMLHelper::image
