<?php

namespace Endocore\Core;

use Endocore\App\Configs\AppConfig;
use Endocore\App\Route;
use Endocore\Core\Constants\Environment;

class App
{
    /**
     * Sınıf içerisinde tutulacak değerler
     * __construct metodu ile belirleyip
     * run metodu ile kullanacağız
     */
    public $controller, $action, $params, $routes;

    /**
     * Controller ve Action'ı belirleyen başlatıcı metod
     * @param array $routes Rota değerlerini alır
     */
    public function __construct()
    {
        /**
         * Eğer url sorgusu varsa, başındaki ve
         * sonundaki / işaretlerini siliyoruz
         * yoksa geçerli olarak default/index
         */
        $url = isset($_GET['url']) && !empty($_GET['url']) ?
            trim($_GET['url'], '/') : 'default/index';

        /**
         * URL dizgesini / karakterleriyle bölüyoruz
         * Böylelikle her bölüme ulaşabileceğiz
         */
        $url = explode('/', $url);

        /**
         * Controller ve Action'ı belirliyoruz
         * Eğer $url[0] varsa onu $url[0].'Controller' yani $url[0]'ın default olduğunu varsayalım
         * indexController olacaktır, eğer yoksa defaultController olarak ayarla dedik
         * Aynı işlemi action için de yapıyoruz. Action $url[1]'de yer alıyor
         */
        $this->controller = isset($url[0]) ? $url[0] . 'Controller' : 'DefaultController';
        $this->action = isset($url[1]) ? $url[1] . 'Action' : 'indexAction';

        /**
         * array_shift fonksiyonu, dizedeki ilk elemanı siler/kaldırır
         */
        array_shift($url);
        array_shift($url);

        /**
         * $url[0] ve $url[1]'i aldık, gerisi parametre.
         * Yani default/index/1/2/3'ün 1/2/3 olan yeri.
         */
        $this->params = $url;

        /**
         * Rotaları sınıfa dahil ediyoruz, başka bir metod içinde kullanmak üzere
         */
        $this->routes = Route::$routes;

        if (AppConfig::ENV == Environment::DEV) {
            $whoops = new \Whoops\Run();

            // Configure the PrettyPageHandler:
            $errorPage = new \Whoops\Handler\PrettyPageHandler();

            $errorPage->setPageTitle("It's broken!"); // Set the page's title
            $errorPage->setEditor("sublime");         // Set the editor used for the "Open" link
            $whoops->pushHandler($errorPage);
            $whoops->register();
        }


        \ActiveRecord\Config::initialize(function ($cfg) {
            $cfg->set_model_directory(AppConfig::MDIR);
            $cfg->set_connections(
                array(
                    Constants\Environment::DEV => 'mysql://root:1@localhost/blsh',
                    Constants\Environment::TEST => 'mysql://username:password@localhost/test_database_name',
                    Constants\Environment::PROD => 'mysql://username:password@localhost/production_database_name'
                )
            );
            $cfg->set_default_connection(AppConfig::ENV);
        });


    }

    /**
     * Uygulamayı başlatır
     */
    public function run()
    {
        // Eğer Controller dosyası varsa $file değişkenini yol olarak belirle
        if (file_exists($file = AppConfig ::CDIR . AppConfig::DS . "{$this->controller}.php")) {
            // Dosyayı sistemimize dahil edelim
            require_once $file;
            // Eğer sınıf yaratılmışsa/varsa controller'ımızı çağıralım
            $controller = "\\App\Controllers\\{$this->controller}";
            if (class_exists($controller)) {
                // controller'ı çağıralım:
                $controllerInstance = new $controller;
                // Eğer metod varsa ve yaratılmışsa
                if (method_exists($controllerInstance, $this->action)) {
                    // call_user_func ile controller ve metodu çağırıyoruz
                    call_user_func_array([$controllerInstance, $this->action], $this->params);
                    // Eğer method yoksa rotacıyı başlat
                } else {
                    return $this->startRouter();
                }
                // Sınıf yoksa ve yaratılmamışsa rotacıyı başlat
            } else {
                return $this->startRouter();
            }
            // Controller dosyası yoksa rotacıyı başlat
        } else {
            return $this->startRouter();
        }
    }

    protected function startRouter()
    {
        // Eğer $routes doluysa (boş değilse) ve dize (array) ise
        if (!empty($this->routes) && is_array($this->routes)) {

            // URL'yi alıyoruz
            $url = rtrim(@$_GET['url'], '/');

            // Sayfa bulunamadı değişkeni false ise sıkıntı yok
            // Ama true olursa en sonda sayfa bulunamadı hatasını göstereceğiz
            $notFound = false;

            // index.php dosyasındaki $routes dizesindeki değerleri işlemek için
            // foreach döngüsüne sokuyoruz bunun manası şu
            // "/rota" => "kontrolcü:aksiyon"
            // $path => $controller : $action

            foreach ($this->routes as $route) {
                foreach ($route as $path => $controllerAction) {
                    // list fonksiyonu ve explode fonksiyonu ne işe yarar öğrenin
                    list($controller, $action) = explode(':', $controllerAction);

                    $path = str_replace('?', '([^/]+)', $path);

                    // Eğer ki orta URL'deki değerle eşleşirse işlem yapalım
                    if (preg_match("@^$path$@ixs", $url, $params)) {

                        // Eğer controller dosyası varsa
                        if (file_exists($file = AppConfig::CDIR . AppConfig::DS . "{$controller}.php")) {
                            // Dosyayı çağır
                            require_once $file;
                            // Eğer sınıf mevcutsa
                            $controller = "\\App\Controllers\\{$controller}";
                            if (class_exists($controller)) {
                                // sınıfı $class değişkenine ata
                                $class = new $controller;
                                // Eğer method mevcutsa her şey tamam
                                if (method_exists($class, $action)) {
                                    // $params dizesinden ilk öğeyi at/çıkar
                                    array_shift($params);
                                    // controller ve aksiyonu çalıştır! bitti.
                                    return call_user_func_array([$class, $action], array_values($params));
                                } else {
                                    $notFound = true;
                                } // çünkü method mevcut değil
                            } else {
                                $notFound = true;
                            } // çünkü sınıf mevcut değil
                        } else {
                            $notFound = true;
                        } // çünkü controller mevcut değil
                    } else {
                        $notFound = true;
                    } // çünkü böyle bir rota tanımlanmamış!
                }
            }

            // Eğer ki $notFound true ise
            if ($notFound) {
                // İstemciye göndereceğimiz istek kodu 404 yani sayfa bulunamadı
                http_response_code(404);
                echo '<meta charset="utf-8">';
                echo 'Aradığınız sayfa bulunamadı!';
                exit; // çık/sonrasını gösterme
            }
        }
    }
}