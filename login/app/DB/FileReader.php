<?php

namespace Mano\DB;
use App\DB\DataBase;

class FileReader implements DataBase {

    private $data, $name;

    public function __construct($name)
    {
        $this->name = $name;
        if(!file_exists(__DIR__ . '/' .$this->name)){
            $this->data = [];
        } else {
            $this->data = unserialize(file_get_contents(__DIR__ . '/' .$this->name));
        }
    }

    public function _destruct()
    {
        file_put_contents(__DIR__ . '/' .$this->name, serialize($this->data));
    }

    private function getId()
    {
    if(!file_exists(__DIR__ . '/' .$this->name .'_id'))
        {
            file_put_contents(__DIR__ . '/' .$this->name .'_id', serialize(1));
            return 1;
        }
    else {
        $id = unserialize(file_get_contents(__DIR__ . '/' .$this->name .'_id'));
        $id++;
        file_put_contents(__DIR__ . '/' .$this->name .'_id', serialize($id));
        return $id;
    }
    }

    public function create(array $userData) : void
    {
        $userData['id'] = $this->getId();
        $this->data[] = $userData;
    }

    public function update(int $userId, array $userData) : void
    {
        $userData['id'] = $userId;
        $this->data = array_map(fn($data) => $userId == $data['id'] ? $userData : $data, $this->data);
    }

    public function delete(int $userId) : void
    {
        $this->data = array_filter($this->data, fn($data) => $userId != $data['id']);
    }

    public function show(int $userId) : array
    {
        return $this->data[$userId] ?? [];
    }

    public function showAll() : array
    {
        return $this->data;
    }


}    