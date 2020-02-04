<p align="center">
    <a href="https://github.com/yiimaker" target="_blank">
        <img src="https://avatars1.githubusercontent.com/u/24204902" height="100px">
    </a>
    <h1 align="center">Email templates module (fork)</h1>
    <br>
</p>

Extension for creating email templates and managing by using your site dashboard.
You can create email templates with CRUD module in your backend or Gii generator.

Documentation is at [docs/guide/README.md](docs/guide/README.md).

[![SymfonyInsight](https://insight.symfony.com/projects/01cd8c6b-428c-4fc1-927b-0cd28ec6d565/big.svg)](https://insight.symfony.com/projects/01cd8c6b-428c-4fc1-927b-0cd28ec6d565)

[![Build Status](https://travis-ci.org/yiimaker/yii2-email-templates.svg?branch=master)](https://travis-ci.org/yiimaker/yii2-email-templates)
[![Scrutinizer Code Quality](https://scrutinizer-ci.com/g/yiimaker/yii2-email-templates/badges/quality-score.png?b=master)](https://scrutinizer-ci.com/g/yiimaker/yii2-email-templates/?branch=master)
[![Total Downloads](https://img.shields.io/packagist/dt/yiimaker/yii2-email-templates.svg)](https://packagist.org/packages/yiimaker/yii2-email-templates)
[![Latest Stable Version](https://img.shields.io/packagist/v/yiimaker/yii2-email-templates.svg)](https://packagist.org/packages/yiimaker/yii2-email-templates)

Installation
------------

The preferred way to install this extension is through [composer](http://getcomposer.org/download/).

Either run

```
$ composer require yiimaker/yii2-email-templates
```

or add

```
"yiimaker/yii2-email-templates": "~4.1"
```

to the `require` section of your `composer.json`.

Usage
-----

1. Create template with placeholders using your site dashboard or Gii generator

    ##### Key
    
    `register-notification` - this is unique key of this template for using in your code

    ##### Subject
    
    `Notification from {siteName}`
    
    In this example email subject has one placeholder `{siteName}`
    
    ##### Body
    
    `Hello, {username}! Welcome to {siteName} :)`
    
    Email body has two placeholders: `{username}` and `{siteName}`.
    
    > All keys should be wrapped by `{}`.
    
2. Now you can get this template in your code

    ```php
    $template = Yii::$app->get('templateManager')->getTemplate('register-notification');
    ```
    
    This method returns a template model object.
    
3. Create a class that implements the ymaker\email\templates\templates interface.

######Property names are equal to placeholders.

    ```php
       use ymaker\email\templates\templates\TemplateInterface;
       
       class NotificationTemplate implements TemplateInterface
       {
           /**
            * @var string
            */
           private $username;
           /**
            * @var string
            */
           private $siteName;
       
           public function __construct(string $username, string $siteName)
           {
       
               $this->username = $username;
               $this->siteName = $siteName;
           }
       }
    ```
    
4. Then you should parse this template   
    ```php
    $template->parse(new NotificationTemplate(
        Yii::$app->getIdentity()->username,
        Yii::$app->name
    ));
    ```
    
    this methods replace placeholders in template with real data.
    
5. Now you can use data of this template in your logic

    ```php
    Yii::$app->get('mailer')->compose()
        ->setSubject($template->subject())
        ->setHtmlBody($template->body())
        // ...
    ```

Tests
-----
You can run tests with composer command

```
$ composer test
```

or using following command

```
$ codecept build && codecept run
```

Contributing
------------
For information about contributing please read [CONTRIBUTING.md](CONTRIBUTING.md).

License
-------
[![License](https://img.shields.io/github/license/yiimaker/yii2-email-templates.svg)](LICENSE)

This project is released under the terms of the BSD-3-Clause [license](LICENSE).

Copyright (c) 2017-2018, Yii Maker
