<?php

namespace Endocore\App\Configs;


use Endocore\Core\Constants\Environment;

class AppConfig
{

    const APP = 'Endo PHP Framework';
    const VERSION = '1.1';
    const DS = DIRECTORY_SEPARATOR;

    const ENV = Environment::DEV;

    const BASE_URL = 'http://localhost/endocore'; // Sistemin çalışacağı URL

    //tum hardcodedlar dynamic olacak constants yani
    const ROOT_DIR = __DIR__ . '/app'; // Kök dizin
    const APP_DIR = self::ROOT_DIR; // Uygulama dizini
    const CONFIG_DIR = self::APP_DIR . self::DS . 'Configs'; // Conf dizini
    const INIT_CONFIG_FILE = self::CONFIG_DIR . self::DS . 'InitConfig.php'; // InitConfig file
    //const CORE_DIR = Config::ROOT_DIR . Config::DS . 'core'; // Çekirdek dizini
    const HELPERS_DIR = self::APP_DIR . self::DS . 'Helpers'; // Helpers dizini
    const LIBRARIES_DIR = self::APP_DIR . self::DS . 'Libraries'; // Helpers dizini
    const MDIR = self::APP_DIR . self::DS . 'Models'; // Model dizini
    const VDIR = self::APP_DIR . self::DS . 'Views'; // View dizini
    const CDIR = self::APP_DIR . self::DS . 'Controllers'; // Controller dizini


    const HEADER_FILE = 'header.php';// header file.
    const FOOTER_FILE = 'footer.php';// footer file

// Veritabanı ayarlamalarını yapıyoruz
// Eğer ki veritabanı işlemi yapmayacaksak ayarlamak şart değil
    const DB_TYPE = 'mysqli';
    const DB_HOST = 'localhost';
    const DB_USR = 'root';
    const DB_PWD = '1';
    const DB_NAME = 'blsh';
    const DB_PORT = '3306';
    const DB_CHARSET = 'utf8';

}