<?php

error_reporting(E_ALL & ~E_DEPRECATED & ~E_USER_DEPRECATED);

/**
 * Laravel - A PHP Framework For Web Artisans
 *
 * @package  Laravel
 * @author   Taylor Otwell <taylor@laravel.com>
 */
 
 // Force redirect before Laravel boots
$requestUri = $_SERVER['REQUEST_URI'] ?? '/';

// Allow /count-down and assets to load normally
// if ($requestUri !== '/count-down' && !preg_match('#\.(css|js|png|jpg|jpeg|gif|svg|ico)$#', $requestUri)) {
//     header('Location: /count-down', true, 302);
//     exit();
//      }

// Fixed launch date
// $launchDate = new DateTime("2025-09-01");
// $today = new DateTime();

// if ($today < $launchDate) {
//     $requestUri = $_SERVER['REQUEST_URI'] ?? '';

//     if (
//         $requestUri !== '/count-down' &&
//         $requestUri !== '/launch' && // allow /launch too
//         !preg_match('#\.(css|js|png|jpg|jpeg|gif|svg|ico)$#', $requestUri)
//     ) {
//         header('Location: /count-down', true, 302);
//         exit();
//     }
// }

define('LARAVEL_START', microtime(true));

/*
|--------------------------------------------------------------------------
| Register The Auto Loader
|--------------------------------------------------------------------------
|
| Composer provides a convenient, automatically generated class loader for
| our application. We just need to utilize it! We'll simply require it
| into the script here so that we don't have to worry about manual
| loading any of our classes later on. It feels great to relax.
|
*/

require __DIR__.'/../vendor/autoload.php';

/*
|--------------------------------------------------------------------------
| Turn On The Lights
|--------------------------------------------------------------------------
|
| We need to illuminate PHP development, so let us turn on the lights.
| This bootstraps the framework and gets it ready for use, then it
| will load up this application so that we can run it and send
| the responses back to the browser and delight our users.
|
*/

$app = require_once __DIR__.'/../bootstrap/app.php';

/*
|--------------------------------------------------------------------------
| Run The Application
|--------------------------------------------------------------------------
|
| Once we have the application, we can handle the incoming request
| through the kernel, and send the associated response back to
| the client's browser allowing them to enjoy the creative
| and wonderful application we have prepared for them.
|
*/

$kernel = $app->make(Illuminate\Contracts\Http\Kernel::class);

$response = $kernel->handle(
    $request = Illuminate\Http\Request::capture()
);

$response->send();

$kernel->terminate($request, $response);
