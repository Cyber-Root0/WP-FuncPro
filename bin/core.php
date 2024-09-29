<?php
require_once(__DIR__.'/../vendor/autoload.php');
use WP\FuncPro\Command\Compile;
if (count($argv) <2 ){
    throw new InvalidArgumentException('Argumento: compile não presente');
}

if ($argv[1] === "app:compile"){
    (new Compile())->execute();

}

