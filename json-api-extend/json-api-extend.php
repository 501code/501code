<?php
// Add a custom controller
add_filter('json_api_controllers', 'add_dev_controller');
function add_dev_controller($controllers) {
    // Corresponds to the class JSON_API_DEV_Controller
    $controllers[] = 'DEV';
    return $controllers;
}
//set path for custom controller
function set_dev_controller_path() {
    return  plugin_dir_path(  dirname( __FILE__ )  ) . "json-api-extend/json-api-dev-controller.php";
}
add_filter('json_api_dev_controller_path', 'set_dev_controller_path');
?>