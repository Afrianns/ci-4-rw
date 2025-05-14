<?php

use CodeIgniter\Router\RouteCollection;

/**
 * @var RouteCollection $routes
 */
$routes->get('/', 'Home::index');

$routes->group("api", function ($routes) {
    $routes->get("users/(:id)", "ManagementUser::index/$1");
    $routes->post("register", "Register::index");
    $routes->post("users", "Login::index");
    $routes->get("users", "Users::index", ['filter' => 'authFilter']);
});