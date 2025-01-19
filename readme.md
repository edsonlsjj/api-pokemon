# Pokemon API

Esta é uma API desenvolvida para listar e obter detalhes sobre Pokémons, consumindo dados da API pública do Pokémon e armazenando-os localmente. A API foi criada utilizando Laravel e pode ser facilmente configurada com o Docker.

---

## Funcionalidades

### Endpoint Disponível

1. **Listagem de Pokémons**:
    - Endpoint: `GET /api/pokemon`
    - Descrição: Retorna uma lista paginada de Pokémons, com opção de filtro.
    - Filtros:
        - `nome`: Filtra os Pokémons pelo nome.
        - `tipo`: Filtra os Pokémons pelo tipo (considerando apenas o primeiro tipo do array retornado pela API original).
    - Paginação:
        - `page`: Especifica a página desejada para consulta.

   #### Exemplo de Requisição
   ```bash
   curl "http://localhost:8000/api/pokemon?nome=Pikachu&tipo=Electric&page=4"
   ```

   #### Exemplo de Resposta
   ```json
   {
     "total": 517,
     "per_page": 10,
     "current_page": 4,
     "last_page": 52,
     "data": [
       {
         "id": 33,
         "nome": "nidoqueen",
         "tipo": "poison",
         "peso_kg": 60,
         "altura_cm": 130
       },
       {
         "id": 34,
         "nome": "nidoran-m",
         "tipo": "poison",
         "peso_kg": 9,
         "altura_cm": 50
       },
       {
         "id": 35,
         "nome": "nidorino",
         "tipo": "poison",
         "peso_kg": 19.5,
         "altura_cm": 90
       },
       {
         "id": 36,
         "nome": "nidoking",
         "tipo": "poison",
         "peso_kg": 62,
         "altura_cm": 140
       },
       {
         "id": 37,
         "nome": "clefairy",
         "tipo": "fairy",
         "peso_kg": 7.5,
         "altura_cm": 60
       },
       {
         "id": 38,
         "nome": "clefable",
         "tipo": "fairy",
         "peso_kg": 40,
         "altura_cm": 130
       },
       {
         "id": 39,
         "nome": "vulpix",
         "tipo": "fire",
         "peso_kg": 9.9,
         "altura_cm": 60
       },
       {
         "id": 40,
         "nome": "ninetales",
         "tipo": "fire",
         "peso_kg": 19.9,
         "altura_cm": 110
       },
       {
         "id": 41,
         "nome": "jigglypuff",
         "tipo": "normal",
         "peso_kg": 5.5,
         "altura_cm": 50
       },
       {
         "id": 42,
         "nome": "wigglytuff",
         "tipo": "normal",
         "peso_kg": 12,
         "altura_cm": 100
       }
     ]
   }
   ```

---

## Configuração do Ambiente

A aplicação utiliza Docker para facilitar a configuração e execução do projeto.

### Requisitos
- Docker
- Docker Compose

### Subindo o Ambiente
1. Clone o repositório.
   ```bash
   git clone https://github.com/seu-repositorio/pokemon-api.git
   cd pokemon-api
   ```

2. Execute o comando para subir os contêineres.
   ```bash
   docker-compose up --build
   ```

3. Acesse o contêiner da aplicação:
   ```bash
   docker exec -it api_pokemon_laravel bash
   ```

4. Execute as migrações para criar as tabelas no banco de dados:
   ```bash
   php artisan migrate
   ```

5. Popule o banco com os dados dos Pokémons utilizando o seeder:
   ```bash
   php artisan db:seed
   ```

A API estará pronta para uso e o banco local conterá 517 Pokémons.

---

## Uso

### Listar Pokémons

```http
GET /api/pokemon
```

#### Parâmetros de Consulta
- `nome` (opcional): Filtra os Pokémons pelo nome (ex.: Pikachu).
- `tipo` (opcional): Filtra os Pokémons pelo tipo (ex.: Electric).
- `page` (opcional): Especifica a página da listagem (ex.: `?page=4`).

#### Exemplo de Requisição
```bash
curl "http://localhost:8000/api/pokemon?nome=Pikachu&tipo=Electric&page=4"
```

---

## Testes

A aplicação inclui testes automatizados que podem ser executados com o PHPUnit.

1. Certifique-se de estar dentro do contêiner da aplicação:
   ```bash
   docker exec -it api_pokemon_laravel bash
   ```

2. Execute os testes:
   ```bash
   php artisan test
   ```

---

## Tecnologias Utilizadas

- **Laravel**: Framework PHP utilizado para criar a API.
- **MySQL**: Banco de dados utilizado para armazenar as informações dos Pokémons.
- **Docker**: Facilita a configuração do ambiente de desenvolvimento.
- **PHPUnit**: Ferramenta para escrita e execução de testes automatizados.

---

## Docker Compose

O arquivo `docker-compose.yml` está configurado para iniciar:

1. **App**: A aplicação Laravel.
2. **MySQL**: Banco de dados para armazenar os Pokémons.
3. **phpMyAdmin**: Interface para gerenciar o banco de dados.


---

## Licença

Este projeto está licenciado sob a [Licença MIT](LICENSE).

