<p align="center"><a href="https://laravel.com" target="_blank"><img src="www/logo_maisvoip.png" width="200px"></a></p>

## Sobre o Contact Cleaner

O Contact Cleaner é um sistema cujo objetivo principal é armazenar, reciclar e preparar mailings com base nos dados fornecidos, que podem ser recebidos via API ou por meio de arquivos CSV.

O sistema permite acesso por três meios distintos:
- Painel de administrador: acesso interno da Maisvoip;
- Painel do cliente: acesso concedido aos usuários de empresas clientes (as empresas podem ter mais de 1 usuário);
- API: acesso único por empresa.

## Stack do Projeto

- **[PHP 8.2](https://www.php.net/releases/8.2/pt_BR.php)**;
- **[Laravel 11](https://laravel.com/docs/11.x/readme)**;
- **[Blade](https://laravel.com/docs/11.x/blade)**;
- **[BladeWindUI](https://bladewindui.com/install)**;
- **[Postgres 16](https://www.postgresql.org/docs/16/index.html)**:
- **[Nginx](https://nginx.org/en/docs/)**;
- **[Docker](https://docs.docker.com)**;
- **[Docker Compose](https://docs.docker.com/compose)**;
- **[Pest](https://pestphp.com/docs/installation)**;

## O que é necessário para preparar o ambiente de desenvolvimento?

A princípio, não será necessário instalar tantas ferramentas para que o projeto funcione no ambinete de desenvolvimento. Sendo assim, você deverá instalar as seguintes ferramentas:

- **Docker - [Instalação](https://www.digitalocean.com/community/tutorials/how-to-install-and-use-docker-on-ubuntu-20-04-pt)**
- **Docker Compose - [Instalação](https://www.digitalocean.com/community/tutorials/how-to-install-and-use-docker-compose-on-ubuntu-20-04-pt)**
- **Composer - [Instalação](https://www.digitalocean.com/community/tutorials/how-to-install-and-use-composer-on-ubuntu-20-04-pt)**

## Proseguindo na preparação do ambiente de desenvolvimento

Depois de instalar os itens acima e clonar o repositório, execute os seguinte comando:

```bash
docker compose up
```

O processo deve demorar alguns poucos minutos, pois fara o download da imgem do php-fpm, nginx e postgres.

Na sequencia instale as dependências do projeto com o composer:

```bash
docker compose exec php composer install --no-interaction --prefer-dist --optimize-autoloader
```

## Configurando o Host

O próximo passo é adicionar o site ao arquivo hosts do seu computador, para que possa ser acessado pelo navegador.
Abra o seu terminal e digite o seguinte comando.

```bash
sudo vim /etc/hosts
```

Adicione a seguinte linha ao arquivo:

```bash
127.0.0.1 dev.contact-cleaner.com
```

Depois de salvar o arquivo, acesse o navegador de sua preferência e acesse o endereço https://dev.contact-cleaner.com.
Você verá uma página de aviso indicando que a conexão não é privada. Clique em "Avançado". Clique em "Prosseguir para dev.contact-cleaner.com (não seguro)".

## Código de Conduta

Não deixe de atualizar essa documentação se houver atualizações, principalmente relacionadas a stack, ferramentas utilizadas e o passo a passo para preparar o ambiente de desenvolvimento.

## Vulnerabilidades de Segurança

Se você descobrir alguma vulnerabilidade de segurança, por favor, mande um e-mail para [gian@maisvoip.com.br](mailto:gian@maisvoip.com.br). Todas as vulnerabilidades de segurança serão prnontamente resolvidas.

## License

The Laravel framework is open-sourced software licensed under the [MIT license](https://opensource.org/licenses/MIT).
