
* * *

WP FuncPro
==========

**WP FuncPro** é um plugin para WordPress que organiza as customizações do arquivo `functions.php` de forma modular e encapsulada, utilizando uma estrutura de classes e permitindo a ativação e desativação de funções diretamente pelo painel administrativo.

Características
---------------

*   Organização de funções personalizadas em módulos PHP.
*   Utiliza classes para encapsulamento e melhor gerenciamento de hooks e ações.
*   Interface no painel administrativo para ativação e desativação de funções.
*   Gerenciamento e compilação de módulos via CLI.

Instalação
----------

1.  Faça o download do plugin ou clone este repositório no diretório de plugins do WordPress:
    
    `wp-content/plugins/`
    
2.  Ative o plugin através do painel de administração do WordPress, em **Plugins** > **WP FuncPro**.

Estrutura do Plugin
-------------------

Após a instalação, o plugin possui a seguinte estrutura de pastas:

bash

Copy code

Parece que a formatação do bloco de código ficou desalinhada. Aqui está a correção para a estrutura do diretório no `README`:

```plaintext
/wp-content/plugins/wp-funcpro/
│
├── bin/core.php              # Arquivo principal do CLI
├── generated/            # Arquivos compilados para ativação no WordPress
├── modules/              # Pasta para os arquivos de customização
│   └── my-custom-hook.php # Exemplo de um módulo de hook personalizado
│
└── README.md             # Arquivo de documentação
```

Agora a formatação está correta, com a estrutura de diretório clara e bem definida.

### Criando Customizações

As customizações devem ser criadas dentro da pasta `modules`. Cada arquivo PHP deve seguir a estrutura abaixo:

```php
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
    ->setCallback($call)
    ->setId('example')
    ->setDescription('Hook de exemplo: exibe um Hello World em todas as páginas do site')
    ->build();

RegisterHooks::set($hook);
```

Agora o código está bem estruturado e legível.

### Compilação dos Hooks

Após criar todos os arquivos na pasta `modules`, é necessário compilar os módulos para que fiquem disponíveis no WordPress.

Para isso, execute o seguinte comando via CLI:

`php bin/core.php app:compile`

Este comando irá gerar os arquivos compilados na pasta `generated`, e consequentemente, criar as opções no painel administrativo para ativar ou desativar os hooks.

Painel Administrativo
---------------------

Depois de compilar os hooks, você poderá gerenciá-los no painel administrativo do WordPress. No painel, acesse **WP FuncPro** e habilite ou desabilite os hooks conforme necessário.

Contribuição
------------

Contribuições são bem-vindas! Sinta-se à vontade para abrir uma issue ou enviar um pull request para melhorar o **WP FuncPro**.

Licença
-------

Este projeto está licenciado sob a licença MIT - veja o arquivo LICENSE para mais detalhes.

* * *

Isso descreve todos os detalhes do plugin, incluindo a criação de customizações, compilação via CLI, e gestão de hooks no painel administrativo.