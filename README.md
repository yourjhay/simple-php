# The Simply PHP Framework
[![Latest Stable Version](https://poser.pugx.org/simplyphp/framework/v/stable)](https://packagist.org/packages/simplyphp/framework)
[![Total Downloads](https://poser.pugx.org/simplyphp/framework/downloads)](https://packagist.org/packages/simplyphp/framework)
[![License](https://poser.pugx.org/simplyphp/framework/license)](https://packagist.org/packages/simplyphp/framework)
[![Monthly Downloads](https://poser.pugx.org/simplyphp/framework/d/monthly)](https://packagist.org/packages/simplyphp/framework)

## About Simple
The Simple PHP is lightweight web application micro framework.
- Uses Model, View, Controller Pattern
- Simple Routing engine
- Using namespace in classes with autoloading
- Controllers with method filters
- Elegant Syntax
- Uses Twig Template Engine (optional)
- Models with resource-friendly connectivity
- Evironment Configuration
- Error Handling and Reporting
- Easily manage dependency using composer

## DOCUMENTATION
https://simply-docs.herokuapp.com


# Simple PHP dependencies
- [Twig Template Engine](https://twig.symfony.com)

# Coding Style Guide
You must follow this standard: https://www.php-fig.org/psr/psr-2/ HAPPY CODING :)

# Installation
Via Composer: (recommended) 
```
composer create-project reyjhon/simple-php
cd simple-php
```

# VIEWS
This micro framework uses twig for the template engine. But it is *OPTIONAL*. Yes, you can use the plain html only without using twig.

- views must be located at *app/Views* directory.
- all views must be name with suffix *view* before the file extension.
   eg: *welcome.**view**.html*, *product.**view**.html*
- view cache can be enable or disable in the application config

## When rendering a view: (uses twig)
```php
return view('welcome');
```
when a view is inside a folder, include the *folder* then *view name* separated by *period*
```php
return view('your_folder.welcome');
```
Please read the twig documentation for more information:
https://twig.symfony.com/doc/2.x/

**NOTE:** 
- You views must be a valid html file. eg: *welcome.view.html*
- layout files can be be a twig file. eg: *layout.twig*, *master.twig*

## When rendering normal view: (plain html)

Pass a third parameter *normal* to recognize it that you want to render without template engine.
```php
return view('welcome', [], 'normal');
```
**NOTE:** 
- You views must be a valid php file. eg: *welcome.view.php*
- normal rendering doesn't support inheretance
- Second parameter is the variables you want to passed. If empty, it must be initialize when rendering normal view.

### restrict controller to authenticated users only
add the _Action_ suffix into your method name.  

example: if you have a method index in your controller:
```php
   public function index()
```
Make it:
```php
public function indexAction()
```
Then add this to 'App/Controllers/Controller.php':
```php
use App\Helper\Auth\AuthHelper as auth;
use Simple\Request;
```
And create a new method _before_ in *Controller.php* like this:
```php
    public function before()
    {
        if(!auth::user()) {
           Request::redirect('/auth/index');
        }
    }
```
The un-authenticated user tries to access your restricted controller will be redirected to login page.

## Using auth in views
If the user is authenticated the user variable is not null.:
```html
  {% if user is null %}
      <p> Please login </p>
  {% else %}
      <p> Hello {{ user.name }} </p>  
  {% endif %}
```
- {{ user.name }} display name of current logged in user.
- {{ user.email }} display email of current logged in user.
- {{ user.id }} display ID of current logged in user.

# Validation
Read documentation at https://github.com/jhayann/simple-php/blob/master/validation.md

# Database Query
Read documentation at https://github.com/jhayann/simple-php/blob/master/queryBuilder.md

# File Upload (on development)
Using the file upload object in controller

Example in your store action:
```php
public function store(Request $request)
{
   $file = $request->file('profile_photo'); // profile_photo is the field name of the input type="file" element
   $file->upload('folder_name'); // specify the folder where the file is going to store, if upload success it wil return true otherwise false.
}
```
**Available Methods:**
- *getFileName()* returns the original filename of the uploaded file
- *getUploadedFileName()* returns the filename of the file when uploaded.
- *getFileSize()* returns the size of the uploaded file
- *getFileExtension()* returns the extension of the uploaded file
- *getFileType()* returns the file type of the uploaded file
- *upload($path)* upload to specified path

# Simply Cryptography 
Simply Framework offers encryption library using a KEY. This uses defuse/php-encryption you can read more at https://github.com/defuse/php-encryption

Before using encryption please run this command **ONCE**:
```
php cli key:generate
```
## Encryption
To encryp a text or string:
```php
use Simple\Security\SimplyEncrypt;
```
Then you can use is as:
```php
$encrypted = SimplyEncrypt::encrypt('secret text');
```
## Decryption
To decrypt a text or string:
```php
use Simple\Security\SimplyDecrypt;
```
Then you can use is as:
```php
$decrypted = SimplyDecrypt::decrypt($ciphertext);
```

## DUMPING VARIABLES
in replace of var_dump, use *dump* instead.
```php
dd($var)
```
## Documentation will be updated soon... 




