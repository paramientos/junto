<?php

namespace App\Controllers;

use Endocore\Core\Controller;

class DefaultController extends Controller
{
    /**
     * ?url=default/index için aksiyon yazalım
     */
    public function indexAction()
    {
        $data['title'] = 'Ana Sayfa';
        $data['text'] = 'Ana sayfadan merhaba!';

        $this->render('home', $data);
    }

    public function testAction($name)
    {
        $data['title'] = 'Test Sayfası';
        $data['text'] = 'Şu an test sayfasındasınız ' . $name;

        return $this->render('home', $data);
    }
}
