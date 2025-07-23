<?php

use CodeIgniter\Router\RouteCollection;

/**
 * @var RouteCollection $routes
 */
$routes->group('', static function ($routes) {
    $routes->get('/', 'Home::index');
    $routes->match(['get', 'post'], 'agregar-usuario', 'Home::agregarUsuario');
    $routes->get('reportes', 'Home::reportes');
    $routes->get('ver-usuario/(:num)', 'Home::verUsuario/$1');
    $routes->match(['get', 'post'], 'editar-usuario/(:num)', 'Home::editarUsuario/$1');
    $routes->match(['get', 'post'], 'cambiar-estatus/(:num)', 'Home::cambiarEstatus/$1');
    $routes->get('exportar-excel', 'Home::exportarExcel');
    $routes->get('buscar-cp/(:num)', 'Home::buscarCp/$1');
});