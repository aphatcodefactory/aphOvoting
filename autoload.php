<?php

$locations = [
  'app' . DS . 'controller',
  'app' . DS . 'core',
  'app' . DS . 'model'
];

spl_autoload_register(function($name) use($locations) {
  foreach ($locations as $location) {
    $classfilepath = $location . DS . "$name.php";

    if (is_readable($classfilepath)) {
      require_once $classfilepath;
    }

    // $lastNameSpacePos = strpos($classfilepath, '\\', -1);
    // $namespace = str_replace();

    if (class_exists($name, false)) {
      return;
    }
  }
});
