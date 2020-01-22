<?php

namespace App\Controllers;

use App\Models\Area;
use Endocore\Core\Controller;

class ServerController extends Controller
{

    public function indexAction()
    {
        $this->render('server');
    }


}
