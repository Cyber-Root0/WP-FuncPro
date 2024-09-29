<?php

namespace WP\FuncPro\register;
if ( ! defined( 'ABSPATH' ) ) {
    exit; // Exit if accessed directly
}
class Ajax
{
    private string $ajaxname = 'wp_funcpro';
    public function __construct(){
        add_action( 'wp_ajax_nopriv_'.$this->ajaxname, array($this, 'execute') );
        add_action( 'wp_ajax_'.$this->ajaxname, array($this, 'execute') );
    }
    public function execute(){
        if (isset($_POST['status']) && isset($_POST['hookname']) ){
            $hook = $_POST['hookname'];
            $status = (int) $_POST['status'];

            $config = get_option($this->ajaxname);
            if (isset($config[$hook])){
                $config[$hook] = $status === 1 ? true : false;
                update_option($this->ajaxname, $config);
            }else{
                $config[$hook] = $status === 1 ? true : false;
                update_option($this->ajaxname, $config);
            }

        }else{
            echo json_encode(
                [
                    'status' => 'fail'
                ]
            );
        }
    }
}