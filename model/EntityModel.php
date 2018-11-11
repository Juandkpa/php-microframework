<?php

include '../managers/DatabaseFactory.php';

class EntityModel {

    public static function getAllEntities() {
        $db = DatabaseFactory::getFactory()->getConnection();

        $sql = "SELECT * FROM entity";
        $query = $db->prepare($sql);
        $query->execute();

        return $query->fetchAll();
    }


}