<?php

use Zend\Expressive\Helper;

return [
    'dependencies'        => [
        'factories' => [
            Helper\ServerUrlMiddleware::class    => Helper\ServerUrlMiddlewareFactory::class,
            Helper\UrlHelperMiddleware::class    => Helper\UrlHelperMiddlewareFactory::class,

            // Register custom Middlewares
            Core\Middleware\Error::class         => Core\Factory\Middleware\ErrorFactory::class,
            Core\Middleware\ErrorNotFound::class => Core\Factory\Middleware\ErrorNotFoundFactory::class,
            Core\Middleware\AdminAuth::class     => Core\Factory\Middleware\AdminAuthFactory::class,
            Web\Middleware\Layout::class         => Web\Factory\Middleware\LayoutFactory::class,
        ],
    ],
    // This can be used to seed pre- and/or post-routing middleware
    'middleware_pipeline' => [
        // An array of middleware to register. Each item is of the following
        // specification:
        //
        // [
        //  Required:
        //     'middleware' => 'Name or array of names of middleware services and/or callables',
        //  Optional:
        //     'path'     => '/path/to/match', // string; literal path prefix to match
        //                                     // middleware will not execute
        //                                     // if path does not match!
        //     'error'    => true, // boolean; true for error middleware
        //     'priority' => 1, // int; higher values == register early;
        //                      // lower/negative == register last;
        //                      // default is 1, if none is provided.
        // ],
        //
        // While the ApplicationFactory ignores the keys associated with
        // specifications, they can be used to allow merging related values
        // defined in multiple configuration files/locations. This file defines
        // some conventional keys for middleware to execute early, routing
        // middleware, and error middleware.
        'always'     => [
            'middleware' => [
                // Add more middleware here that you want to execute on
                // every request:
                // - bootstrapping
                // - pre-conditions
                // - modifications to outgoing responses
                Helper\ServerUrlMiddleware::class,
            ],
            'priority'   => 10000,
        ],

        // execute this middlweare on every /admin[*] path
        'permission' => [
            'middleware' => [Core\Middleware\AdminAuth::class],
            'priority'   => 100,
            'path'       => '/admin'
        ],

        'routing' => [
            'middleware' => [
                Zend\Expressive\Container\ApplicationFactory::ROUTING_MIDDLEWARE,
                Helper\UrlHelperMiddleware::class,
                Web\Middleware\Layout::class, // change layout dynamically

                // Add more middleware here that needs to introspect the routing
                // results; this might include:
                // - route-based authentication
                // - route-based validation
                // - etc.
                Zend\Expressive\Container\ApplicationFactory::DISPATCH_MIDDLEWARE,
            ],
            'priority'   => 1,
        ],

        'error404' => [
            'middleware' => [Core\Middleware\ErrorNotFound::class],
            'priority'   => -10,
        ],

        'error' => [
            'middleware' => [Core\Middleware\Error::class],
            'error'      => true,
            'priority'   => -1,
        ],

    ],
];
