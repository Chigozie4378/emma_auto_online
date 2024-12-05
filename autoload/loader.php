<?php
session_start();
error_reporting(E_ERROR);

  function myAutoload($name){
    if (file_exists("./classes/".$name.".php")) {
      require_once "./classes/".$name.".php";
    }elseif (file_exists("../classes/".$name.".php")) {
      require_once "../classes/".$name.".php";
    }elseif (file_exists("./classes/Controllers/".$name.".php")) {
      require_once "./classes/Controllers/".$name.".php";
    }elseif (file_exists("../classes/Controllers/".$name.".php")) {
      require_once "../classes/Controllers/".$name.".php";
    }
    
  }
  spl_autoload_register('myAutoload');
