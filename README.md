# CakePHP 3 Feedback Plugin

[![Join the chat at https://gitter.im/akkaweb/AKKA-CakePHP-Feedback-Plugin](https://badges.gitter.im/akkaweb/AKKA-CakePHP-Feedback-Plugin.svg)](https://gitter.im/akkaweb/AKKA-CakePHP-Feedback-Plugin?utm_source=badge&utm_medium=badge&utm_campaign=pr-badge&utm_content=badge)

A CakePHP 3 Plugin used in conjunction with the jQuery Sliiide Plugin that allows easy implementation of a feedback system within a website. Feedback will collect the following: `name, email, feedback, IP, browser and referrer`.

This plugin can be seen in action at this website: https://www.kidzwl.com

[![Total Downloads](https://poser.pugx.org/akkaweb/cakephp-feedback/downloads.svg)](https://packagist.org/packages/akkaweb/cakephp-feedback)
[![License](https://poser.pugx.org/akkaweb/cakephp-feedback/license.svg)](https://packagist.org/packages/akkaweb/cakephp-feedback)

## Requirements #######################################################
- CakePHP 3
- PHP 5.4.6+
- jQuery
- * Sliiide jQuery Plugin - This is included and loaded by the Feedback Plugin. More details about this plugin can be found here: https://github.com/ahmedrad/sliiide

NOTE: Sliiide jQuery Plugin is also needed, but it is included and loaded by the Feedback Plugin. More details about this plugin can be found here: https://github.com/ahmedrad/sliiide

## Included #######################################################
- Feedback Helper

## Installation #######################################################

##### Composer

### Run the following Composer command from the root of your application

```php composer.phar require akkaweb/cakephp-feedback```

Or Add the following to your `composer.json` file located in the root of your application, in the `require` section . ie. `/var/www/domain.com/composer.json`

```php
"require": {
	"akkaweb/cakephp-feedback": "2.0.*"
}
```

### Then run the following command at the root of your application

```
php composer.phar update
```
Note: if `composer.phar` is not found, you need to install it. Follow CakePHP's documentation here -> http://book.cakephp.org/3.0/en/installation.html. Refer to Installing Cakephp section

## Configuration #######################################################

### Load the plugin in your application's `bootstrap.php` file:

Using command-line

```bin/cake plugin load -r AkkaFeedback```

or

```php
Plugin::load('AkkaFeedback', ['bootstrap' => false, 'routes' => true]);
```

### Schema Migrations

This Feedback plugin uses the `feedbacks` database table to save feedbacks. Please use the following command to run the migrations file included

```bin/cake migrations migrate -p AkkaFeedback```

If you would rather create this table directly using phpMyAdmin, Workbench or other Database Tools, you can use the file provided in `AkkaFeedback/config/Schema/feedback.sql`

### Load the plugin's helper in `src/View/AppView.php` inside the `initialize()` hook method

```php
parent::initialize();
$this->loadHelper('AkkaFeedback.Feedback');
```

### Add Default Element to your Layout file

Add the following to the bottom of your layout file right before the end body tag `</body>`

```<?php echo $this->Element('AkkaFeedback.feedback_form'); ?>```

NOTE: You need to ensure the following is also added within the <head> tag of your application

```
	<?= $this->fetch('css') ?>
	<?= $this->fetch('script') ?>
```

### Adding reCaptacha to Forms

To enabled reCaptacha in your forms, you need to add the following to application bootstrap files. ie. `bootstrap.php`.

```Configure::write('Feedbacks.reCaptcha.enable', true); //to enable reCatpcha login```
```Configure::write('Feedbacks.reCaptcha.key', 'xxxxxxxxxxxxxxxxxxxx'); //reCatpcha key```
```Configure::write('Feedbacks.reCaptcha.secret', 'xxxxxxxxxxxxxxxxxxxx'); //reCatpcha secret```


At this point the default Feedback Form will start showing on your site.

If you would like a different form, you can copy this element, make the necessary changes and create a new element in your application's Element folder

## Administration #######################################################

This plugin comes with a set of controller files that allows an administrator to view Feedbacks added to the site using the `admin` prefix.

The preferred method is thru using `src/Controller/Admin/FeedbacksController.php` which requires your application to have an `AdminsController.php` but the file `src/Controller/FeedbacksController.php` also includes prefixed `admin` actions. ie `admin_index`.

By default the plugin provides the following route that allows the following URLs to be accessible:
```
    /admin/feedbacks
    /admin/feedbacks/index ([/edit/:id] and [/view/:id])
```

## Disclaimer
Although we have done many tests to ensure this plugin works as intended, we advise you to use it at your own risk. As with anything else, you should first test any addition to your application in a test environment. Please provide any fixes or enhancements via issue or pull request.
