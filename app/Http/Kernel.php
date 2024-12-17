<?php

protected $routeMiddleware = [
    // Middleware Laravel lainnya
    'role' => \App\Http\Middleware\RoleMiddleware::class,
];