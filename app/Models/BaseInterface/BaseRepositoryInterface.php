<?php

namespace App\Models\BaseInterface;

interface BaseRepositoryInterface
{
    public function getAll();

    public function findOrFail($id);

    public function search($q);


    public function createWithAlertMessage($collection, $alertMessage, $extraAttributes = []);

    // public function getUserById($id);

    // public function createOrUpdate($id = null, $collection = []);

    // public function deleteUser($id);
}
