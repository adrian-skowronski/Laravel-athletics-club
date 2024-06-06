<?php
protected $routeMiddleware = [
    'can:admin' => \App\Http\Middleware\EnsureAdmin::class,
];