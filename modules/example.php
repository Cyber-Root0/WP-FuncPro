<?php
 if ( ! defined( 'ABSPATH' ) ) {
    exit; // Exit if accessed directly
}
use WP\FuncPro\register\RegisterHooks;
use WP\FuncPro\util\Type;
use WP\FuncPro\util\Hook;
/*
* Description: Hook de teste para criação do plugin
*
*/
$call = function(){
    echo "Hello World";
};

$builder = new Hook(Type::ACTION);
$hook = $builder->setHookName('init')
    ->setPriority(10)
    ->setCallback(
       $call
)->setId('example')->setDescription('Hook de exemplo: exibi um hello world em todas as paginas do site')
->build();

RegisterHooks::set($hook);