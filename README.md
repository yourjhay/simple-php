# The Simple PHP Framewrok

## About Simple
The Simple PHP is lightweight web application framework.
- Uses Model, View, Controller Pattern
- Simple Routing engine
- Using namespace in classes with autoloading
- Controllers with method filters
- Beatiful and Elegant Syntax
- Uses Twig Template Engine (optional)
- Models with resource-friendly connectivity
- Evironment Configuration
- Error Handling and Reporting
- Easily manage dependency using composer

# Simple PHP dependencies
- [TwigTemplateEngine](https://twig.symfony.com)

# Installation
Via Git:
```
git clone https://gitlab.com/jhayann/simple.git
```
Via Composer: 
```
composer create-project reyjhon/simple-php
```
# Serving Simple-PHP
PHP-simple doesn't need a real web server to run when in development.

**NOTE: YOU MUST BE IN /public directory of your project** then run the following command:
```
php -S localhost:8000
```
then you can now navigate _localhost:8000_ to to your browser. Awesome!

# Using the Simple Framework

## configuration:
Configuraion file is located at: App/Config/global.php
```md
-
|-App
   '-|Config
       '-|global.php
```
## Directory Structure:
```md
The root directory:
|-App
    The App directory:
    '-|Config
    '-|Controllers
    '-|Helper
    '-|Model
    '-|Views
|-Logs
|-public
|-Simple
|-vendor
```
**The App directory:**
- **Config**: This is the folder where the application configuration is located. You can create your own.
- **Controllers:** The _Controllers_ DIR contains all your application controllers. 
- **Helper:** You can create your own class helper in this folder.
- **Model:** All your application models must be place in here.Simple use Models to communicate with the database.
- **Views:** Your Frontend is located here. All html, php files needed for presentation.
- 
**The root Directory**
- **App:** Most of your application logic is here. Eg.Controllers, Models & Views.
- **Logs:** Application Error logs is store in this folder.
- **public:** The _public_ DIR contains the index.php as the central entry point and front controller of the framework.
- **simple:** Contains all the files running the framework.
- **vendor:** Contains all your composer dependencies.

# The Basics
## Routing
The basic url route accepts **_url_**. and parameters: **_controller_**, **_action_**, **_namespace_**:
```php
Router::set('home',[
  'controller' => 'home',
  'action'     => 'index'
]);
```

Parameters can be pass as **_variables_** along with the URL:
```php
Router::set('{controller:home}',[
 'action'=>'index' 
]);
```
if you want to specify the controller/method in the url:

Example: thesimplephp.com/**controller**/**method**
```php
Router::set('{controller}/{action}');
```
Simple will automatically find the controller and method to run.

The **_namespace_** parameter tell the router where too look for that controller in the namespace given.
```php
Router::set('admin/{controller}/{action}',[
  'namespace' => 'Admin'
]);
```
And your directory should look like this:
```md
|-App
    '-|Controllers
        '-|Admin
            '-YourController.php
```

Passing Parameters from url to the router. Eg. id,name,prodct etc.
```php
Router::set('{controller:users}/{action:show}/{id:\w+}',[
```

on variable id. to be able to accept letters and numbers, you need to set the regex(regular expression).

BY default it varible only accepts letters.

example: 
```php
{variableName: regex}
```
- **_\w+_**   accepts _letters_ and _numbers_
- **_\d+_**   accepts only _numbers_
- **show** accepts _show_ only
- **\bSHOW|\bEDIT|\bUPDATE** accepts _show_, _edit_ and _update_ (case insensitive).
- You can set your own regex.






