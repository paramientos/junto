<?php

namespace App\Controllers;

use App\Models\Area;
use Endocore\Core\Controller;

class PersonController extends Controller
{

    public function indexAction($id)
    {

        $data['area'] = Area::first();
        $data['title'] = 'Person';
        $data['text'] = 'Person sayfasından merhaba!';


        //Area::create(['name' => 'Soysal']);

        $this->render('home', $data);
    }

    public function postAction($id)
    {
        var_dump($this->request->get);
        echo $id;
    }

    public function putAction($id)
    {
        echo $id;
    }

    public function deleteAction($id)
    {
        echo $id;
    }


}
