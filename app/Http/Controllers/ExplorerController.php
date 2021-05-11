<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;

class ExplorerController extends Controller
{
    public $fileList = [
        0 => '.gitignore',
        1 => 'Dockerfile',
        2 => 'docker-compose.yml',
        3 => 'api/Database.php',
        4 => 'api/Headers.php',
        5 => 'api/Loader.php',
        6 => 'api/Model.php',
        7 => 'api/ModelInterface.php',
        8 => 'api/Product.php',
        9 => 'api/Router.php',
        10 => 'api/Routes.php',
        11 => 'public/.htaccess',
        12 => 'public/index.php'
    ];
    public function show(Request $request)
    {
        $id = $request->input('id');
        echo file_get_contents("../resources/VanillaAPI/".$this->fileList[$id], "r");      
    }

    public function getList(){
        return json_encode($this->fileList);
    }
}
