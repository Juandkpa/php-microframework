<?php

require '../managers/View.php';

class Controller {
    
    public $View;

    public function __construct() {
        $this->View = new View();
    }

}