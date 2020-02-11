Template manager
================

## Configuration

Configure repository in DI container

```php
    'components' => [
        ...
        'templateManager' => [
            'class' => 'ymaker\email\templates\components\TemplateManager'
        ],
        ...
    ]
```

## Template manager methods

| Method                                    | Description                                                           | Returns                           |
|-------------------------------------------|-----------------------------------------------------------------------|-----------------------------------|
|`getTemplate($key, $language = null)`      |Returns template by key and language                                   |`null` or `EmailTemplateModel`     |
|`getAllTemplates($key)`                    |Returns templates on all languages                                     |`null` or `EmailTemplateModel[]`   |
|`getFirstOrDefault($key, $default = null)` |Returns template on first founded language by key or default value     |`mixed`                            |
|`hasTemplate($key)`                        |Check whether template with current key exists                         |`bool`                             |
