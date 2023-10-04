<?php

namespace App\Core\Database;
use App\Core\Http\Request;

abstract class Model
{
    static string $tableName;

    static function getAll()
    {
        $tableName = static::$tableName;
        $sql = "SELECT * FROM $tableName";
        $pdo = DBConnection::getInstance()->getPDO();
        $result = $pdo->query($sql);

        $objects = [];
        foreach ($result as $row) {
            $object = new static();
            foreach ($row as $key => $value) {
                if (str_contains($key, '_id')) {
                    $key = substr($key, 0, -3);
                    $className = 'App\Models\\'.ucfirst($key);
                    $value = $className::get($value);
                }
                $setMethod = 'set'.ucfirst($key);
                if (method_exists($object, $setMethod)) {
                    $object->$setMethod($value);
                }              
            }

            $objects[] = $object;
        }

        return $objects;
    }

    static function get(int $id)
    {
        $tableName = static::$tableName;
        $sql = "SELECT * FROM $tableName WHERE id=$id";
        $pdo = DBConnection::getInstance()->getPDO();
        $result = $pdo->query($sql);

        $object = new static();
        foreach ($result as $row) {
            foreach ($row as $key => $value) {
                if (str_contains($key, '_id')) {
                    $key = substr($key, 0, -3);
                    $className = 'App\Models\\'.ucfirst($key);
                    $value = $className::get($value);
                }
                $setMethod = 'set'.ucfirst($key);
                if (method_exists($object, $setMethod)) {
                    $object->$setMethod($value);
                }              
            }
        }

        return $object;
    }

    static function filter(Request $request)
    {
        $tableName = static::$tableName;
        $sql = "SELECT * FROM $tableName";

        if (isset($request->getParams()['filterBy'])) {
            $categoryId = $request->getParams()['filterBy'];
            $sql.=" WHERE category_id=$categoryId";
        }

        if (isset($request->getParams()['search'])) {
            $search = $request->getParams()['search'];
            $sql.=" HAVING MATCH (title) AGAINST ('$search')";
        }

        if (isset($request->getParams()['orderBy'])) {
            $orderBy = $request->getParams()['orderBy'];
            $sql.=" ORDER BY title $orderBy";
        }

        $page = $request->getParams()['page'] ?? 1;
        $perPage = 20;
        $offset = ($page - 1) * $perPage;

        $sql.=" LIMIT $offset, $perPage";

        $pdo = DBConnection::getInstance()->getPDO();
        $result = $pdo->query($sql);

        $objects = [];
        foreach ($result as $row) {
            $object = new static();
            foreach ($row as $key => $value) {
                if (str_contains($key, '_id')) {
                    $key = substr($key, 0, -3);
                    $className = 'App\Models\\'.ucfirst($key);
                    $value = $className::get($value);
                }
                $setMethod = 'set'.ucfirst($key);
                if (method_exists($object, $setMethod)) {
                    $object->$setMethod($value);
                }              
            }

            $objects[] = $object;
        }

        return $objects;
    }
}