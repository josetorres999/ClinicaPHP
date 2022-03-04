<?php


spl_autoload_register(function($clase){
    $directorio_clase = str_replace('\\','/',$clase);
    if(file_exists('controllers/'.$directorio_clase.'.php')){
        require 'controllers/'.$directorio_clase.'.php';
    }
});