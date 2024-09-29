<?php

namespace WP\FuncPro\register;
if ( ! defined( 'ABSPATH' ) ) {
    exit;
}
class Permission
{
    private static $instance = null;
    private $permissions = [];
    private function __construct(){
        $this->permissions = get_option('wp_funcpro');
    }    
    /**
     * getInstance
     *
     * @return Permission
     */
    public static function getInstance(){
        if (self::$instance === null){
            self::$instance = new self();
        }
        return self::$instance;
    }
    public function has(string $id){
        if (isset($this->permissions[$id])){
            return $this->permissions[$id] == true;
        }
        return false;
    }
}