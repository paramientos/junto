<?php

namespace App\Controllers;

use App\Models\User;
use Endocore\Core\Controller;

class PersonController extends Controller
{

    public function indexAction($id)
    {

        $user=new User();
        $user->all();





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
