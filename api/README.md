## Setup

1. Instalar o PHP conforme as instruções do site https://www.php.net

2. Instalar o Composer conforme as instruções do site https://getcomposer.org

3. Instalar as dependências do projeto Laravel com o seguinte comando:

```
composer install
```

4. Copie o arquivo com as configurações do ambiente de desenvolvimento:
```
cp .env.example .env
```

5. Criar o arquivo database.sqlite com o seguinte comando:
```
touch database/database.sqlite
```

6. Execute o servidor web de desenvolvimento:
```
php artisan serve
```

7. Em um segundo terminal, execute o cron de desenvolvimento:
```
php artisan schedule:work
```

## Tests
Os testes implementados se encontram na pasta  [tests](https://github.com/joao-salomao/originsro-market-watcher/tree/main/api/tests)

Para executa-los basta rodar o comando:
```
./vendor/bin/phpunit --testdox
```
