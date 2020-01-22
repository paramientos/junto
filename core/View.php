<?php

namespace Endocore\Core;

use Endocore\App\Config;
use Endocore\App\Configs\AppConfig;

class View
{

    /**
     * @param $view
     * @param array $params
     * @throws \Exception
     */
    public static function render($view, array $params = []) : void
    {
        // check header file
        if (file_exists($file = AppConfig::VDIR . AppConfig::DS . AppConfig::HEADER_FILE)) {
            extract($params);
            ob_start();
            require $file;
            echo ob_get_clean();
        } else {
            throw new \Exception("Header görünüm dosyası bulunamadı: $view");
        }

        if (file_exists($file = AppConfig::VDIR . AppConfig::DS . "{$view}.php")) {
            extract($params);
            ob_start();
            require $file;
            echo ob_get_clean();
        } else {
            throw new \Exception("Görünüm dosyası bulunamadı: $view");
        }

        // check footer file
        if (file_exists($file = AppConfig::VDIR . AppConfig::DS . AppConfig::FOOTER_FILE)) {
            extract($params);
            ob_start();
            require $file;
            echo ob_get_clean();
        } else {
            throw new \Exception("Footer görünüm dosyası bulunamadı: $view");
        }
    }


    /**
     * Parcali görünüm dosyasını yorumlayan metod
     * Header ve footer yok
     * @param $view
     * @param array $params
     */
    public static function partialRender($view, array $params = []) : void
    {
        /**
         * Eğer dosya varsa
         */
        if (file_exists($file = AppConfig::VDIR . AppConfig::DS . "{$view}.php")) {
            /**
             * $params dizesindeki verileri extract fonksiyonu
             * ile değişken haline döndürüyoruz
             */
            extract($params);

            /**
             * Çıktı tamponlamasını başlatıyoruz
             */
            ob_start();

            /**
             * View dosyası içeriğini çağırıyoruz
             */
            require $file;

            /**
             * Çıktı tamponun içeriğini döndürüp siliyoruz
             */
            echo ob_get_clean();
            /**
             * Dosya yoksa programı sonlandır
             */
        } else {
            throw new \Exception("Görünüm dosyası bulunamadı: $view");
        }
    }
}
