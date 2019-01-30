<?php

namespace App\Models;

use Endocore\Core\Model;

/**
 * Örnek bir model dosyası
 * post tablosunu temsil edecek
 */
class Post extends Model
{
    /**
     * Bütün gönderileri (postları) getirmesini sağlayalım
     * $this->fetchAll'ı genişlettiğimiz (extend) model sınıfı aracılığıyla kullanıyoruz
     * @return array
     */
    public function getAll()
    {
        $q = $this->query('SELECT * FROM user u');
        if ($q->num_rows) {
            return $q->rows;
        }
    }
}
