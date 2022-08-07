<?php

use Illuminate\Support\Facades\Route;
use Illuminate\Support\Facades\App;

if (!function_exists("gallery")) {
    function gallery($filename)
    {
        return asset("gallery/{$filename}");
    }
}
if (!function_exists('areActiveRoutes')) {


    function areActiveRoutes(array $routes, $output = "active")
    {
        foreach ($routes as $route) {
            if (Route::currentRouteName() == $route) return $output;
            if (str_contains($route, "*")) {
                $params = explode(".", $route);
                $currentRouteParams = explode(".", Route::currentRouteName());
                if ($params[0] == $currentRouteParams[0] && $params[1] == '*') return $output;
            }
        }
    }
}


if (!function_exists("title")) {
    /**
     * @param string $title
     * @return string
     */
    function title($title = ""): string
    {
        if (isset($title) && $title != "") {
            return env("SITE_NAME", "Mail") . " | " . $title;
        }
        else {
            $routeArray = app('request')->route()->getAction();
            $controllerAction = class_basename($routeArray['controller']);
            list($controller, $action) = explode('@', $controllerAction);
            $controller = str_replace("Controller", "", $controller);
            return env("SITE_NAME", "Mail") . " | " . $controller;
        }
    }
}


if (!function_exists("changeEnvironmentVariable")) {
    function changeEnvironmentVariable($key,$value)
    {
        $path = base_path('.env');

        if(is_bool(env($key)))
        {
            $old = env($key)? 'true' : 'false';
        }
        elseif(env($key)===null){
            $old = 'null';
        }
        else{
            $old = env($key);
        }

        if (file_exists($path)) {
            file_put_contents($path, str_replace(
                "$key=".$old, "$key=".$value, file_get_contents($path)
            ));
        }
    }
}
