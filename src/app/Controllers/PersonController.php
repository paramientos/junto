<?php

namespace App\Controllers;

use App\Models\Area;
use Endocore\Core\Controller;

class PersonController extends Controller
{

    public function indexAction($id)
    {

        $area = new Area();
        var_dump($area->all()->getRows());


        //$user=$this->model('user');
        //var_dump($user->all()->getRows());

        //echo $id;
        //redirect('default','index');
        //var_dump($this->url->redirect('default', 'index'));
        //var_dump($this->request->get);
        /*$data['title'] = 'Person';
        $data['text'] = 'Person sayfasından merhaba!';

        $this->render('home', $data);*/
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
