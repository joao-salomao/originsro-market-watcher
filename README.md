# OriginsRo Market Watcher

O [Origins Online (OriginsRO)](https://originsro.org) é emulador privado do MMORPG [Ragnarok Online](https://pt.wikipedia.org/wiki/Ragnar%C3%B6k_Online). O jogo foi desenvolvido originalmente pela empresa [Gravity Corporation](https://pt.wikipedia.org/wiki/Gravity_Corporation), ele é um mix de elementos que incluem referências à mitologia nórdica e visuais característicos do mundo oriental, tendo sido lançado oficialmente no brasil em 2005.

No jogo é possível realizar a comercialização de itens e equipamentos que são obtidos através da realização de missões, derrotando monstros e participando da guerra do império onde as guildas de jogadores competem pela posse dos castelos do jogo.

É possível verificar as ofertas de compra e venda de itens dentro do jogo no painel de controle da conta, que podem ser acessados através de um navegador de internet e da [API REST do jogo](https://gitlab.com/originsro/originsro/tree/master/doc/api). Essa API pode ser acessada através de um token de autenticação associado à conta dos jogadores.

Apesar de serem oferecidas várias interfaces para que os jogadores acessem o mercado e realizem a comercialização de itens do jogo, não existe uma funcionalidade que verifique a disposição de um item ou equipamento no mercado, sendo necessário acessar uma das interfaces fornecidas e verificar manualmente se existe algum jogador disponibilizando o item requerido para venda no mercado. Para automatizar esse processo estou criando o **OriginsRO Market Watcher**, cuja principal função é notificar o usuário sobre a oferta de um item desejado no mercado do jogo passando como parâmetro o preço máximo que se deseja pagar, com esse dado o programa é capaz de executar uma rotina em segundo plano que verificar o mercado periodicamente, removendo, assim, a necessidade de acesso manual as interfaces padrões do jogo. 

## Requisitos:

-   PHP ^7.2.5
-   Composer ^2
-   Node ^10

## Como executar a aplicação:

### Docker composer
Execute a aplicação com o seguinte comando:
```
docker-compose up
```

### Manual

1. Instalar o PHP conforme as instruções do site https://www.php.net

2. Instalar o Composer conforme as instruções do site https://getcomposer.org

3. Instalar o Node conforme as instruções do site https://nodejs.org

4. Instalar as dependências do projeto Laravel com o seguinte comando:

```
composer install
```

5. Copie o arquivo com as configurações do ambiente de desenvolvimento:
```
cp .env.example .env
```

6. Criar o arquivo database.sqlite com o seguinte comando:
```
touch database/database.sqlite
```

7. Executar a migração e população do banco de dados com o seguinte comando:
```
php artisan migrate --seed
```

8. Instalar as dependências do projeto Vue com o seguinte comando:
```
npm install
```

9. Fazer a construção da aplicação Vue com o seguinte comando:
```
npm run production
```

10. Execute o servidor web de desenvolvimento:
```
php artisan serve
```

11. Em um segundo terminal, execute o cron de desenvolvimento:
```
npm run cron
```

12. Realize o login usando o usuário padrão com as seguintes credenciais:
```
e-mail => teste@teste.com
Senha  => 1234
```
## Links relacionados:

[OriginsRo API](https://gitlab.com/originsro/originsro/tree/master/doc/api)

[Community Market Sale Tracker of Originsro](http://www.originsro-market.de)
