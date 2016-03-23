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

1. Run the following Composer command from the root of your application

```php composer.phar require akkaweb/cakephp-feedback```

Or Add the following to your `composer.json` file located in the root of your application, in the `require` section . ie. `/var/www/domain.com/composer.json`

```php
"require": {
	"akkaweb/cakephp-feedback": "dev-master"
}
```

2. Then run the following command at the root of your application

```
php composer.phar update
```
Note: if `composer.phar` is not found, you need to install it. Follow CakePHP's documentation here -> http://book.cakephp.org/3.0/en/installation.html. Refer to Installing Cakephp section

## Configuration #######################################################

1. Load the plugin in your application's `bootstrap.php` file:

Using command-line

```bin/cake plugin load -r AkkaFeedback```

or

```php
Plugin::load('AkkaFeedback', ['bootstrap' => false, 'routes' => true]);
```

2. Schema Migrations

This Feedback plugin uses the `feedbacks` database table to save feedbacks. Please use the following command to run the migrations file included

```bin/cake migrations migrate -p AkkaFeedback```

If you would rather create this table directly using phpMyAdmin, Workbench or other Database Tools, you can use the file provided in `AkkaFeedback/config/Schema/feedback.sql`

3. Load the plugin's helper in `AppController.php`

```php
public $helpers = [
      'AkkaFeedback.Feedback'
  ];
```

4. Add Default Element to your Layout file

Add the following to the bottom of your layout file right before the end body tag `</body>`

```<?php echo $this->Element('AkkaFeedback.feedback_form'); ?>```

NOTE: You need to ensure the following is also added within the <head> tag of your application

```
	<?= $this->fetch('css') ?>
	<?= $this->fetch('script') ?>
```

At this point the default Feedback Form will start showing on your site.

If you would like a different form, you can copy this element, make the necessary changes and create a new element in your application's Element folder

## Administration #######################################################

This plugin comes with a set of controller files that allows an administrator to view Feedbacks added to the site using the `admin` prefix.

The preferred method is thru using `src/Controller/Admin/FeedbacksController.php` which requires your application to have an `AdminsController.php` but the file `src/Controller/FeedbacksController.php` also includes prefixed `admin` actions. ie `admin_index`.

Optionally you can add the following routes to your Application's `routes.php`:

```
Router::prefix('admin', function ($routes) {
  $routes->connect('/feedbacks', ['plugin' => 'AkkaFeedback', 'controller' => 'Feedbacks', 'action' => 'index']);
  $routes->connect('/feedbacks/:action/*', ['plugin' => 'AkkaFeedback', 'controller' => 'Feedbacks']);
  $routes->fallbacks('InflectedRoute');
});
```

## Disclaimer
Although we have done many tests to ensure this plugin works as intended, we advise you to use it at your own risk. As with anything else, you should first test any addition to your application in a test environment. Please provide any fixes or enhancements via issue or pull request.
