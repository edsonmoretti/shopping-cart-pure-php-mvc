# # Carrinho de compras, simples com PHP Puro, JQuery e Ajax

Carrinho de compras simples com conceitos MVC, utilizando PHP Puro, Bootstrap, JQuery e Ajax

## Requerimentos
- PHP 7.4

# Instalação

 - Logar no MySQL e criar um banco de dados, por exemplo: lojinha
 - Rodar o arquivo start-server.bat
 - Acessar a url: **http://localhost:8013/admin**
 - Configurar com usuário, senha e nome do banco de dados e salvar.
 - Você será redirecionado para tela de login:
	 - Usuário e senha padrão: CPF: 01234567890 SENHA: 123

## Estrutura

Para loja, temos apenas uma página index com HTML, Bootstrap, JQuery. O carregamento dos dados são feitos através de requisições Ajax dentro do arquivo **cart.js** .
No para o painel Admin foi utilizado o template SB Admin 2 (disponível em https://startbootstrap.com/theme/sb-admin-2).
Principais arquivos e pastas:
 - **app**
	 - **App.php** - Arquivo responsável por tratar as rotas GETs e POSts e as chamadas dos models
	 - **layout** - Diretório contendo a estrutura do template.
	 - **models** - diretório contendo os Models
		 - Model.php - Modelo padrão com métodos para abstração de dados do banco.
 - **views** - Páginas que serão acionadas automaticamente pelo parâmetro ?p=nomeDaPagina. Ex.: Página **localhost:8013/?p=users** carregará automaticamente o arquivo users.php dentro do template.
 - **config\configuration.php** - Arquivo de configuração do sistema

> **OBS:** As **Views** do painel Admin são carregadas dinamicamente de acordo com as rotas passadas na URL.


