# OriginsRo Market Watcher

Requisitos:

-   PHP ^7.2.5
-   Composer ^2
-   Node ^10

Como executar a aplicação:

1. Instalar o PHP conforme as instruções do site https://www.php.net

2. Instalar o Composer conforme as instruções do site https://getcomposer.org

3. Instalar o Node conforme as instruções do site https://nodejs.org

4. Instalar as dependências do projeto Laravel com o seguinte comando:
   composer install

5. Copie o arquivo com as configurações do ambiente de desenvolvimento:
   cp .env.example .env

6. Criar o arquivo database.sqlite com o seguinte comando:
   touch database/database.sqlite

7. Executar a migração e população do banco de dados com o seguinte comando:
   php artisan migrate --seed

8. Instalar as dependências do projeto Vue com o seguinte comando:
   npm install

9. Fazer a construção da aplicação Vue com o seguinte comando:
   npm run production

10. Execute o servidor web de desenvolvimento:
   php artisan serve

11. Em um segundo terminal, execute o cron de desenvolvimento:
   npm run cron

12. Realize o login usando o usuário padrão com as seguintes credenciais:
   e-mail => teste@teste.com
   Senha  => 1234

Links relacionados:

[OriginsRo API](https://gitlab.com/originsro/originsro/tree/master/doc/api)

[Community Market Sale Tracker of Originsro](http://www.originsro-market.de)
