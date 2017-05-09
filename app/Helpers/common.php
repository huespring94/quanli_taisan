<?php

/**
 * Detect Active Routes
 *
 * @param array $routes route
 * @param type  $output output
 *
 * @return string
 */
function areActiveRoutes(array $routes, $output = "active")
{
    foreach ($routes as $route) {
        if (Route::currentRouteName() == $route) {
            return $output;
        }
    }
}
