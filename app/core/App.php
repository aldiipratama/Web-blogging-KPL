<?php

class App
{
    protected $controller = 'Home';
    protected $method = 'index';
    protected $params = [];

    public function __construct()
    {
        $url = $this->parseURL();

        
        $controller_name = $this->controller; 
        $method_name = $this->method;         
        $is_404 = false;

        
        if (isset($url[0]) && !empty($url[0])) {
            $proposed_controller = ucfirst($url[0]);
            $controllerFile = '../app/controllers/' . $proposed_controller . '.php';

            if (file_exists($controllerFile)) {
                $controller_name = $proposed_controller;
                unset($url[0]); 
                
                
                if (isset($url[1])) {
                    $proposed_method = $url[1];
                    
                    require_once $controllerFile; 
                    if (method_exists($proposed_controller, $proposed_method)) {
                        $method_name = $proposed_method;
                        unset($url[1]); 
                    } else {
                        
                        $is_404 = true;
                    }
                }
            } else {
                
                $is_404 = true;
            }
        }
        
        
        if ($is_404) {
            $controller_name = 'NotFound';
            $method_name = 'index';
            
            $this->params = [];
        }

        
        $this->controller = $controller_name;
        $this->method = $method_name;

        
        require_once '../app/controllers/' . $this->controller . '.php';
        
        
        
        $controllerClass = $this->controller;
        
        if (method_exists($controllerClass, '__construct')) {
            $reflectionMethod = new ReflectionMethod($controllerClass, '__construct');
            
            if ($reflectionMethod->getNumberOfParameters() > 0) {
                 
                 
                 if ($this->controller === 'Artikel') { 
                    $this->controller = new $controllerClass($this->method);
                 } else { 
                    $this->controller = new $controllerClass();
                 }
            } else {
                 $this->controller = new $controllerClass(); 
            }
        } else {
            
            $this->controller = new $controllerClass();
        }

        
        if (!$is_404 && !empty($url)) {
            $this->params = array_values($url);
        }
        

        
        call_user_func_array([$this->controller, $this->method], $this->params);
    }

    public function parseURL()
    {
        $url = '';
        
        if (isset($_GET['url'])) {
            $url = $_GET['url'];
        }
        
        
        else if (isset($_SERVER['REQUEST_URI'])) {
            $request_uri = $_SERVER['REQUEST_URI'];
            $base_url_path = parse_url(BASEURL, PHP_URL_PATH); 

            
            
            
            if (strpos($request_uri, $base_url_path) === 0) {
                $url = substr($request_uri, strlen($base_url_path));
                
                if (strpos($url, '/') === 0) {
                    $url = substr($url, 1);
                }
            } else {
                
                $url = $request_uri;
                if (strpos($url, '/') === 0) {
                    $url = substr($url, 1);
                }
            }
            
            $url = strtok($url, '?');
        }

        $url = rtrim($url, '/');
        $url = filter_var($url, FILTER_SANITIZE_URL);

        
        if (empty($url)) {
            return ['']; 
        }

        return explode('/', $url);
    }
}
