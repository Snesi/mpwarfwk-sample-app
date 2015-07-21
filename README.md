# mpwarfwk-standard-edition
Sample app for my MPWAR's Framework

## Installation

To begin a project with snesi's mpwarfwk, all you need to do is clone the sample app.

Everything you need to interact with the framework's API is in the sample.

## Configuration

All configuration should go in the src/config file.

There are two config files you can access:
* app.php
* database.php

### app.php
This file uses AppConfig, which is a simple container for all of your app's configurations.

Because it's used statically, you can access your stored configuration from anywhere in the
project, all you need to do is include the AppConfig class.

There are a three main configurations that are required to be set up:

* debug --> Set to true if you want errors printed and a stack trace.
* locales --> Expects an array with the supported locales.
* defaultLocale --> Expects string with the fallback locale.

Here's a sample:
```php
use \MPWAR\AppConfig;

AppConfig::debug(true)
    ->appName("MPWAR-TEST")
    ->locales(["es", "en"])
    ->defaultLocale("es");

```

### database.php
This file uses the Database class to set up all of your databases.

For now, only MySQL is truly supported.

Here's some sample code with how to setup your database:

```php
use MPWAR\Database\Database;

Database::mysql("main_db")
    ->host(getenv("DB_HOST"))
    ->database(getenv("DB_NAME"))
    ->user(getenv("DB_USER"))
    ->password(getenv("DB_PASSWORD"));
```

## Routing

To create routes for your application all you need to do is use the Route class.

Sample:
```php
use MPWAR\Routing\Route;

Route::get("/")
    ->execute("index@WelcomeController")
    ->respondWith("html")
    ->expireAfter(5, Route::MINUTES);

Route::post("/hello")
    ->execute("hello@WelcomeController")
    ->respondWith("json")
    ->expireAfter(5, Route::MINUTES);
```

## i18n
All of your app's strings should go in the strings array in locale/strings.php

The way the strings are organized is by the Controllers name. Here's a sample:

```php
return [

    'WelcomeController' => [
        'greeting' => [
            'es' => 'Hola mundo!',
            'en' => 'Hello World!',
        ],
    ],

];
```

## Controllers

All controllers should go into the controllers folder and extend BaseController.
Also, all controllers have access to the request as a protected variable, the kernel and the controller's strings.

Sample:
```php
class WelcomeController extends BaseController
{
    public function index()
    {
        echo "Hello World";
    }

    public function hello($name)
    {
        if($this->request->isJson()) {
            return Json::make(["greeting" => "hello", "receiver" => $name]);
        } else {
            return View::make("hello.twig", [
                "name" => $name,
                "strings" => $this->strings,
                "locale" => $this->request->locale
            ]);
        }
    }

    public function dbTest() {
        $db = Database::get("main_db");
        $result = $db->runQuery("select * from city");
        return Json::make($result);
    }
}
```

## Views
Views should all go in the views folder. There are some error templates included, but
they should be modified.

Only two template engines are supported, Twig and Smarty.

## Environment configuration

All environment configuration in development and in production should go in the .env file.
Configuration is a json key value object. Sample:

```json
{
    "DB_DRIVER": "mysql",
    "DB_HOST": "localhost",
    "DB_NAME": "sakila",
    "DB_USER": "homestead",
    "DB_PASSWORD": "secret"
}
```
