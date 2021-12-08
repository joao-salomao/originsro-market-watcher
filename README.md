# OriginsRo Market Watcher
[![Tests API](https://github.com/joao-salomao/originsro-market-watcher/actions/workflows/tests-api.yml/badge.svg?branch=main)](https://github.com/joao-salomao/originsro-market-watcher/actions/workflows/tests-api.yml)

O [Origins Online (OriginsRO)](https://originsro.org) é emulador privado do MMORPG [Ragnarok Online](https://pt.wikipedia.org/wiki/Ragnar%C3%B6k_Online). O jogo foi desenvolvido originalmente pela empresa [Gravity Corporation](https://pt.wikipedia.org/wiki/Gravity_Corporation), ele é um mix de elementos que incluem referências à mitologia nórdica e visuais característicos do mundo oriental, tendo sido lançado oficialmente no brasil em 2005.

No jogo é possível realizar a comercialização de itens e equipamentos que são obtidos através da realização de missões, derrotando monstros e participando da guerra do império onde as guildas de jogadores competem pela posse dos castelos do jogo.

É possível verificar as ofertas de compra e venda de itens dentro do jogo no painel de controle da conta, que podem ser acessados através de um navegador de internet e da [API REST do jogo](https://gitlab.com/originsro/originsro/tree/master/doc/api). Essa API pode ser acessada através de um token de autenticação associado à conta dos jogadores.

Apesar de serem oferecidas várias interfaces para que os jogadores acessem o mercado e realizem a comercialização de itens do jogo, não existe uma funcionalidade que verifique a disposição de um item ou equipamento no mercado, sendo necessário acessar uma das interfaces fornecidas e verificar manualmente se existe algum jogador disponibilizando o item requerido para venda no mercado. Para automatizar esse processo estou criando o **OriginsRO Market Watcher**, cuja principal função é notificar o usuário sobre a oferta de um item desejado no mercado do jogo passando como parâmetro o preço máximo que se deseja pagar. Com esse dado o programa é capaz de executar uma rotina em segundo plano que verifica o mercado periodicamente, removendo, assim, a necessidade de acesso manual as interfaces padrões do jogo. 


## Arquitetura base da aplicação
![Arquitetura](https://github.com/joao-salomao/originsro-market-watcher/blob/main/.assets/app_architecture.png?raw=true)

## Principais tecnologias utilizadas:
- [Laravel](https://laravel.com)
- [Vue.js](https://vuejs.org)
- [SQLite](https://www.sqlite.org/index.html)

## Requisitos Gerais:

-   PHP ^7.2.5
-   Composer ^2
-   Node ^10

## Como executar a aplicação:

### Docker composer:
Execute a aplicação com o seguinte comando:
```
docker-compose up
```

### Manualmente:

[Front-end](https://github.com/joao-salomao/originsro-market-watcher/tree/main/front-end)

[API](https://github.com/joao-salomao/originsro-market-watcher/tree/main/api)


## Links relacionados:

[OriginsRo API](https://gitlab.com/originsro/originsro/tree/master/doc/api)

[Community Market Sale Tracker of Originsro](http://www.originsro-market.de)
