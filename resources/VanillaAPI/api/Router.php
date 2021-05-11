<?php

function router($endpoint, $callback)
{
    if (substr($_SERVER['REQUEST_URI'], 0, strlen($endpoint)) == $endpoint) {
        $callback();
    }
}

include_once "Routes.php";

function getId()
{
    return explode("/", $_SERVER['REQUEST_URI'])[2];
}

$data = json_decode(file_get_contents('php://input'));
switch ($_SERVER['REQUEST_METHOD']) {
    case 'GET':
        echo $model->get(getId());
        break;
    case 'POST':
        echo $model->post($data);
        break;
    case 'PATCH':
        echo $model->patch(getId(), $data);
        break;
    case 'DEL':
        echo $model->del(getId());
        break;

    default:
        # code...
        break;
}
