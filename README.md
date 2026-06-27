# The Simply PHP Framework
[![Latest Stable Version](https://poser.pugx.org/simplyphp/framework/v/stable)](https://packagist.org/packages/simplyphp/framework)
[![Total Downloads](https://poser.pugx.org/simplyphp/framework/downloads)](https://packagist.org/packages/simplyphp/framework)
[![License](https://poser.pugx.org/simplyphp/framework/license)](https://packagist.org/packages/simplyphp/framework)
[![Monthly Downloads](https://poser.pugx.org/simplyphp/framework/d/monthly)](https://packagist.org/packages/simplyphp/framework)

## About Simple
The Simple PHP is a lightweight web application micro framework.

- Model, View, Controller Pattern
- Simple Routing engine with regex variables, groups, HTTP method filters
- Auto-wiring controller method arguments (Request, FormRequest, services)
- FormRequest validation with automatic validation before controller execution
- Full-featured validation library (76+ rules, 16+ filters, custom callbacks)
- CLI console with generators (controllers, models, requests, observers, auth)
- Uses Twig Template Engine (optional, plain HTML also supported)
- Resource-friendly database connectivity (PDO)
- Environment Configuration (.env)
- Error handling and logging (Whoops for dev, clean error pages for production)
- Controller action suffix for auth middleware (`before`/`after` hooks)
- Encryption library (defuse/php-encryption)
- Resource routes
- PSR-4 autoloading with namespaces

## FULL DOCUMENTATION
https://simply.rjhon.net

# Installation
Via Composer (recommended):
```
composer create-project reyjhon/simple-php
cd simple-php
```

# Quick Start

## Basic Route
```php
Router::set('/', ['controller' => 'home', 'action' => 'index']);
```

## Controller with Auto-wired Request
```php
use Simple\Request;

class HomeController extends Controller
{
    public function index(Request $request)
    {
        $name = $request->get('name');
        return view('home.index', ['name' => $name]);
    }
}
```

## FormRequest Validation
Generate a form request:
```
php cli make:request StoreProductRequest
```

Use it in a controller:
```php
use App\Requests\StoreProductRequest;

class ProductController extends Controller
{
    public function store(StoreProductRequest $request)
    {
        $data = $request->validated();
        Product::create($data);
        return view('product.show', ['product' => $data]);
    }
}
```

# VIEWS
This micro framework uses Twig for the template engine. But it is *optional*. You can use plain HTML without Twig.

- Views must be located in *app/Views* directory.
- All views must be named with suffix *view* before the file extension.
   e.g.: *welcome.**view**.html*, *product.**view**.html*
- View cache can be enabled or disabled in the application config.

## When rendering a view (with Twig):
```php
return view('welcome');
```

When a view is inside a folder, include the *folder* then *view name* separated by a *period*:
```php
return view('your_folder.welcome');
```

Please read the Twig documentation for more information:
https://twig.symfony.com/doc/3.x/

**NOTE:**
- Views must be a valid HTML file: e.g. *welcome.view.html*
- Layout files can be Twig files: e.g. *layout.twig*, *master.twig*

## When rendering a plain HTML view:
Pass a third parameter `'normal'` to render without the template engine:
```php
return view('welcome', [], 'normal');
```

**NOTE:**
- Views must be valid PHP files: e.g. *welcome.view.php*
- Normal rendering does not support inheritance
- The second parameter holds variables to pass. If empty, it must be initialized.

# Validation
Simply includes a full validation library with 76+ validation rules and 16+ filters.

```php
use Simple\Validation\Validator as Validate;

$result = Validate::is_valid($_POST, [
    'name'  => 'required|min_len:3|max_len:255',
    'email' => 'required|valid_email',
    'age'   => 'required|numeric|min_numeric:18',
]);
```

Read the full validation documentation at:
https://simply.rjhon.net/documentation/v1/lib/validation

# Encryption
Simply offers encryption using defuse/php-encryption.

Run this command **once**:
```
php cli key:generate
```

## Encrypt
```php
use Simple\Security\SimplyEncrypt;

$encrypted = SimplyEncrypt::encrypt('secret text');
```

## Decrypt
```php
use Simple\Security\SimplyDecrypt;

$decrypted = SimplyDecrypt::decrypt($ciphertext);
```

# CLI Commands
| Command | Description |
|---------|-------------|
| `php cli make:controller` | Generate a controller |
| `php cli make:model` | Generate a model |
| `php cli make:request` | Generate a FormRequest class |
| `php cli make:observer` | Generate an observer |
| `php cli make:auth` | Scaffold authentication |
| `php cli serve` | Start PHP development server |
| `php cli key:generate` | Generate application key |
| `php cli route:list` | List all registered routes |

# Routing

## Basic
```php
Router::set('products', [
    'controller' => 'ProductController',
    'action'     => 'index'
]);
```

## With variables
```php
Router::set('products/{id:\d+}', [
    'controller' => 'ProductController',
    'action'     => 'show'
]);
```

## Resource routes
```php
Router::resource('products', 'ProductController');
// Generates: index, create, store, show, edit, update, destroy
```

## Route groups
```php
Router::group('admin', function () {
    Router::get('users', ['controller' => 'AdminController', 'action' => 'users']);
});
```

## Full FQCN
```php
Router::set('admin/{action}', [
    'controller' => 'App\Controllers\Admin\AdminController'
]);
```

# Coding Style
PSR-12 Extended Coding Standard: https://www.php-fig.org/psr/psr-12/

# Dependencies
- [Twig Template Engine](https://twig.symfony.com)
- [vlucas/phpdotenv](https://github.com/vlucas/phpdotenv)
