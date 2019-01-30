<?php

namespace Endocore\Core;

use Endocore\App\Configs\AppConfig;
use Endocore\Core\Constants\Dml;
use Fleshgrinder\Core\Formatter;

class Model implements IModel
{

    private $row;
    private $rows;
    private $num_rows;

    /**
     * Veritabanını nesnesini tutar
     * @var void
     */
    private $link;
    private $diModel;

    public function __construct(IModel $model = null)
    {
        $this->diModel = $model;
        $this->link = new \mysqli(AppConfig::DB_HOST, AppConfig::DB_USR, AppConfig::DB_PWD, AppConfig::DB_NAME, AppConfig::DB_PORT);
        if ($this->link->connect_error) {
            trigger_error('Error: Could not make a database link (' . $this->link->connect_errno . ') ' . $this->link->connect_error);
            exit();
        }
        $this->link->set_charset(AppConfig::DB_CHARSET);
        $this->link->query("SET SQL_MODE = ''");

        return $this;
    }

    final public function all()
    {
        // @TODO side-effects for table_name , will be fixed ??
        $sql = Formatter::format(Dml::SELECT_ALL_FROM, ['table' => $this->getTableName()]);
        $this->query($sql);
        return $this;

    }

    private function getTableName()
    {
        $backtrace = debug_backtrace();


        if (!empty($this->diModel)) {
            return $this->diModel->table;
        } elseif (!empty($backtrace[0]['object']->table)) {
            return $backtrace[0]['object']->table;
        } else if (empty($backtrace[0]['object']->table) && empty($this->diModel)) {
            $namespace = explode('\\', get_called_class());
            return strtolower(array_pop($namespace));
        } else {
            throw new \Exception("Tablo adi girilmedi");
        }
    }

    public function query($sql)
    {
        $query = $this->link->query($sql);
        if (!$this->link->errno) {
            if ($query instanceof \mysqli_result) {
                $data = array();
                while ($row = $query->fetch_assoc()) {
                    $data[] = $row;
                }

                $this->num_rows = $query->num_rows;
                $this->row = isset($data[0]) ? $data[0] : array();
                $this->rows = $data;

                $query->close();
                return $this;
            } else {
                return true;
            }
        } else {
            trigger_error('Hata: ' . $this->link->error . '<br />Hata No: ' . $this->link->errno . '<br />' . $sql);
        }
    }

    public function escape($value)
    {
        return $this->link->real_escape_string($value);
    }

    public function count_affected()
    {
        return $this->link->affected_rows;
    }

    public function get_last_id()
    {
        return $this->link->insert_id;
    }

    public function __destruct()
    {
        $this->link->close();
    }

    /**
     * @return mixed
     */
    public function getRows()
    {
        return $this->rows;
    }

    /**
     * @return mixed
     */
    public function getRow()
    {
        return $this->row;
    }

    /**
     * @return mixed
     */
    public function getNumRows()
    {
        return $this->num_rows;
    }
}
