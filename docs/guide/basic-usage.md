Basic usage
===========

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