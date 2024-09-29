<?php

namespace WP\FuncPro\register;
use WP\FuncPro\register\RegisterHooks;
use WP\FuncPro\register\Permission;
use Twig\Loader\FilesystemLoader;
use Twig\Environment;
if ( ! defined( 'ABSPATH' ) ) {
    exit; // Exit if accessed directly
}
class Layout
{   
    private string $template_dir = __DIR__.'/../../view';
    private string $setting_id = 'bring-core-settings';
    protected Environment $twig;
    public function __construct(){
        $function = new \Twig\TwigFunction('hookPermission', function ($hookid) {
            return Permission::getInstance()->has($hookid);
        });
        $loader = new \Twig\Loader\FilesystemLoader($this->template_dir);
            $this->twig = new Environment($loader, [
        ]);
        $this->twig->addFunction($function);
    }
    public function execute(){
        add_action('admin_menu', array($this, 'menu_setting'));
    }
    public function render($template = '',$vars = []){
        return $this->twig->render($template, $vars);
    }
    public function menu_setting(){
        add_menu_page(
            'WP FuncPRO',
            'WP FuncPRO',
            'administrator',
            $this->setting_id,
            array($this, 'form_layout'),
            plugins_url('/images/icon.png', __FILE__)
        );
    }
    public function form_layout(){
        
        $hooks = RegisterHooks::getInstance()->getHooks();
        $hooks_id = [];
        foreach($hooks as $hook){
            $hooks_id[] = $hook->getData();
        }
        echo $this->render('config_page.twig', [
            'hooks' => $hooks_id,
            'ajax_url' => admin_url( 'admin-ajax.php')
        ]);
        
    }
}