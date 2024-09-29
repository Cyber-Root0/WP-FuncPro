<?php

namespace WP\FuncPro;
use WP\FuncPro\register\RegisterHooks;
use WP\FuncPro\register\Layout;
use WP\FuncPro\register\Ajax;
use WP\FuncPro\register\Permission;
if ( ! defined( 'ABSPATH' ) ) {
    exit;
}
class Load
{    
    private static $instance = null;
    private string $hookspath = __DIR__.'/../generated';
    /**
     * don't direct instance class
     *
     * @return void
     */
    private function __construct(){
        $this->load_hooks();
        $this->execute();
        (new Layout())->execute();
        (new Ajax());
    }    
    /**
     * get unic shared instance
     *
     * @return Load
     */
    public static function getInstance(){
        if (self::$instance === null){
            self::$instance = new self();
        }
        return self::$instance;
    }    
    /**
     * initialize all hooks before start
     *
     * @return void
     */
    public function load_hooks(){
        $path = $this->hookspath;
        $this->includeFiles($path);
        
    }    
    /**
     * include all hooks files in php
     *
     * @param  string $diretorio
     * @return void
     */
    private function includeFiles($diretorio) {
        $files = glob($diretorio . '/*');
        foreach($files as $file){
            require_once($file);
        }
    }    
    /**
     * Excute all hooks
     *
     * @return void
     */
    public function execute(){
        $register = RegisterHooks::getInstance();
        $hooks = $register->getHooks();
        foreach($hooks as $hook){
            $id = $hook->getData()['id'];
            if ($this->rules($id)){
                $hook();
            }
            continue;
        }
    }
    private function rules(string $id){
        return $permisson = Permission::getInstance()->has($id);
    }
}