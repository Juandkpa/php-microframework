<?php

require '../managers/Controller.php';
require '../model/EntityModel.php';

class EntityController extends Controller {

    public function index() {
        //echo "constructing entity index";
        $this->View->render('entity/index', [
            'entities' => EntityModel::getAllEntities()
        ]);
    }   
}