<?php

Class App
{
    // Default constants
    private $controller = "home";
    private $method = "index";
    private $params = [];

    public function __construct()
    {
        $url = $this->splitURL();

        if (file_exists("../app/controllers/". strtolower($url[0]) .".php"))
        {
            $this->controller = strtolower($url[0]);
            unset($url[0]);
        }

        require "../app/controllers/". $this->controller .".php";
        $this->controller = new $this->controller;

        if (isset($url[1]))
        {
            if (method_exists($this->controller, $url[1]))
            {
                $this->method = $url[1];
                unset($url[1]);
            }
        }
        // If the url is set it "skips" the [0] and [1] in splitURL array because we don't show it anymore
        $this->params = array_values($url);

        // Run the class method:
        call_user_func_array([$this->controller, $this->method], $this->params);
    }

    /* splitURL Returns:
     * Array
     * (
     *      [0] => user // Represents class name (Default class is Home)
     *      [1] => Tom  // Represents method/function
     *      [2] => 1
     * )
    */
    private function splitURL()
    {
        $url = isset($_GET['url']) ? $_GET['url'] : "home"; // If there is nothing in the url assign "home"
        return explode("/", filter_var(trim($url, "/"), FILTER_SANITIZE_URL)); // explode url and if there's a / trim it and sanitize
    }
}
