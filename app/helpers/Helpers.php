<?php

namespace App\helpers;

class Helpers
{

    public static function perPage($perPage = 10)
    {
        return $perPage;
    }

    public static function isRead($isRead)
    {
        if ($isRead == 0) {
            echo " <span class='badge bg-danger'>Not Read</span>";
        } else {
            echo " <span class='badge bg-success'>Readed</span>";
        }
    }
}
