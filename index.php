<?php
date_default_timezone_set('America/Argentina/Buenos_Aires');
require_once __DIR__ . '\controllers\ClientController.php';
require_once __DIR__ . '\controllers\TeacherController.php';

$path_info = $_SERVER['PATH_INFO'] ?? '';

$resource = '/' . (explode('/', $path_info)[1] ?? '');


switch ($resource) {

    case '/usuario':
        $controller = new ClientController();
        $controller->start();
    break;

    case '/login':
        $controller = new ClientController();
        $controller->start();
    break;

    case '/materia':
        $controller = new SubjectController();
        $controller->start();
    break;

    case '/profesor':
        $controller = new TeacherController();
        $controller->start();
    break;

    default:

        echo 'Requested URL:' . $path_info . "\n";
        echo $resource . ' is not a valid resource';
        //$controller = new PersonasController();
        //$controller->start();
    break;
}