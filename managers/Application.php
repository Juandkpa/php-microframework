<?php

class Application {    
    
    private $controller;
    private $parameters = [];
    private $controllerName;
    private $actionName;
    private const DEFAULT_CONTROLLER = 'index';
    private const DEFAULT_ACTION = 'index';
    


    public function __construct() {        
        $this->pathController = realpath(dirname(__FILE__).'/..') . '/controller/';
        $this->splitUrl();
        $this->createControllerAndActions();

        echo "construction " . $this->controllerName . " " . $this->actionName;
        
        
        if(file_exists($this->pathController . $this->controllerName . '.php')) {
            require $this->pathController . $this->controllerName . '.php';
            $this->controller = new $this->controllerName();

            if(method_exists($this->controller, $this->actionName)) {
                if(!empty($this->parameters)) {
                    call_user_func_array([$this->controller,$this->actionName], $this->parameters);
                }else{
                    $this->controller->{$this->actionName}();
                }
            }
        }else{
            echo "controller not found";
            //to do: error controller implementation
            //require $this->pathController . 'ErrorController.php';
            
        }
        
    }

    private function splitUrl() {
        if( isset($_GET['url']) ) {
            $wholeUrl = $_GET['url'];
            // split URL
            $url = trim($wholeUrl, '/');
            $url = filter_var($url, FILTER_SANITIZE_URL);
            $url = explode('/', $url);
            
            $this->controllerName = isset($url[0]) ? $url[0] : null;
            $this->actionName = isset($url[1]) ? $url[1] : null;
            

            unset($url[0], $url[1]);
            
            $this->parameters = array_values($url);
        }
    }

    private function createControllerAndActions()
    {        
        if (!$this->controllerName) {
            $this->controllerName = self::DEFAULT_CONTROLLER;
        }
        
        
        if (!$this->actionName OR (strlen($this->actionName) == 0)) {
            $this->actionName = self::DEFAULT_ACTION;
        }
        

        $this->controllerName = ucwords($this->controllerName) . 'Controller';
    }
}