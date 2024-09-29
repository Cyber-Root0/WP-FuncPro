<?php

namespace WP\FuncPro\Command;
class Compile
{  
    private array $files = [];
    private string $modules_dir = __DIR__.'/../../modules';
    private string $generated_dir = __DIR__.'/../../generated';    
    /**
     * Main function
     *
     * @return void
     */
    public function execute(){
        $this->interceptFiles($this->modules_dir);
        $this->generate();
        echo "Arquivos gerados com sucesso!";
    }    
    /**
     * search all path files from modules folder
     *
     * @param  string $diretorio
     * @return void
     */
    private function interceptFiles($diretorio) {
        $arquivos = scandir($diretorio);
        foreach($arquivos as $arquivo) {
            if ($arquivo == '.' || $arquivo == '..') {
                continue;
            }
            $caminhoCompleto = $diretorio . '/' . $arquivo;
            if (is_dir($caminhoCompleto)) {
                $this->interceptFiles($caminhoCompleto);
            }
            if (is_file($caminhoCompleto) && pathinfo($caminhoCompleto, PATHINFO_EXTENSION) == 'php') {
                $arquivo = str_replace($this->modules_dir, "", $caminhoCompleto);
                $this->files[] = $arquivo;
            }
        }
    }    
    /**
     * generate new files from modules folder
     *
     * @return void
     */
    private function generate(){
        $this->delete_allfiles();
        foreach($this->files as $file){
            $filename = $this->rename($file);
            copy($this->modules_dir.$file , $this->generated_dir.'/'.$filename);
        }

    }     
    /**
     * delete all files in generated folder
     *
     * @return void
     */
    private function delete_allfiles(){
        $files = glob($this->generated_dir . '/*');
        foreach ($files as $file) {
            if (is_file($file)) {
              // Deleting the given file
              unlink($file);
            }
        }
    }    
    /**
     * rename filepath
     *
     * @param string $filepath
     * @return void
     */
    private function rename($filepath){
        return str_replace("/", "_", $filepath);
    }
}