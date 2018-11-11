<?php

class View {

    private $pathView;

    function __construct() {
        $this->pathView = realpath(dirname(__FILE__).'../../') . '/view/';
    } 

    public function render($filename, $data = null) {
        
        if($data) {
            foreach($data as $key => $value) {
                $this->{$key} = $value;
            }
        }
        require $this->pathView . $filename . '.php';
    }
}