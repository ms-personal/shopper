# shopper

Sistema básico para guardar informações pessoais de clientes. O sistema permite entrar com os dados do cliente e persisti-los em um banco de dados, também permite atualizar os dados de cada cliente cadastrado, e excluir cliente caso necessário.

# Especificações

- Sistema: PHP
- Banco de dados: MYSQL

# Pré-requisitos

- Webservice (preferencialmente Apache)
- Módulo Rewrite URL configurado
- PHP 5+
- MySQL

# Estrutura básica de diretórios

- /assets - Arquivos CSS.
- /banco  - Arquivo de script que cria a base de dados.
- /core   - Arquivos responsáveis por todo o funcionamento do sistema.
- /pages  - Views do sistema.

# Instalação

1. Após clonar o repositório acesse seu banco de dados MySQL e excute/importe o script SQL que se encontra na pasta 'banco'. 

2. Edite o arquivo 'database.php' que está na raiz do projeto com suas configurações de acesso do MySQL.

3. Configure um hostname como por exemplo 'shopper.dev' e faça com o seu Webserivce aponte-o para a pasta da aplicação.

# Observações

Todo o sistema foi desenvolvido com caminhos relativos para todas as chamadas de arquivos, portanto é preciso acessa-lo pelo navegador através de uma URL absoluta, exemplo: 'shopper.dev'. Se tentar acessar especifindo um sub-diretório na URL (exemplo: 'localhost/shopper/'), não vai funcionar.
