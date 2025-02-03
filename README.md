
# Arte arena - Backend / Root

API que Migre dados de uma outra API para um banco de dados MySQL.

### Funcionalidades:

1. Sincronize diariamente novos dados da API com o banco de dados.

2. Desenvolva um componente de interface para buscar e selecionar dados com Autocomplete.

3. Permita adicionar novas opções diretamente no banco de dados caso nenhuma corresponda à busca do usuário.

4. Sincronização Diária do banco de dados da api externa a cada 24 horas.

5. Usar Cache para armazenas dados durante 24 horas.

6. Manifestações Kubernetes que contemplam:
- Deployment do backend e do frontend.  
- Configuração de serviços (Services) e ingressos (Ingress) para expor os aplicativos. 
- Configuração de volumes persistentes.

5. Configuração de um pipeline de CI/CD que:
- Realize build e testes automatizados.
- Faça o deploy automático nos manifestos Kubernetes fornecidos.

#

## Stack Backend 

**PHP 8.2 - Laravel 11 - MySQL - Docker + Kubernetes**

#

## Documentação da API

#### Retorna todos os itens

```http
  GET /items
```

#### Posta um item

```http
  POST /items
```

| Parâmetro   | Tipo       | Descrição                                   |
| :---------- | :--------- | :------------------------------------------ |
| `title`      | `string` | **Obrigatório**.|
| `body`      | `string` | **Obrigatório**. |

#

## Variáveis de Ambiente

Para rodar esse projeto, você vai precisar adicionar as seguintes variáveis de ambiente no seu .env

`APP_NAME=Laravel`

`APP_ENV=local`

`APP_KEY=base64:5dFaaBu1ShhWnK1P+lrWjvjvsj8LF5+nkpsjVEydMOI=`

`APP_DEBUG=true`

`APP_TIMEZONE=UTC`

`APP_URL=http://0.0.0.0:8000`

`APP_LOCALE=en`

`APP_FALLBACK_LOCALE=en`

`APP_FAKER_LOCALE=en_US`

`APP_MAINTENANCE_DRIVER=file`

`APP_MAINTENANCE_STORE=database`

`PHP_CLI_SERVER_WORKERS=4`

`BCRYPT_ROUNDS=12`

`LOG_CHANNEL=stack`

`LOG_STACK=single`

`LOG_DEPRECATIONS_CHANNEL=null`

`LOG_LEVEL=debug`

`DB_CONNECTION=mysql`

`DB_HOST=host.docker.internal`

`DB_PORT=3306`

`DB_DATABASE=laravel`

`DB_USERNAME=root`

`DB_PASSWORD=root`

`SESSION_DRIVER=database`

`SESSION_LIFETIME=120`

`SESSION_ENCRYPT=false`

`SESSION_PATH=/`

`SESSION_DOMAIN=null`

`BROADCAST_CONNECTION=log`

`FILESYSTEM_DISK=local`

`QUEUE_CONNECTION=database`

`CACHE_STORE=database`

`CACHE_PREFIX=`

`MEMCACHED_HOST=127.0.0.1`

`MAIL_MAILER=log`

`MAIL_SCHEME=null`

`MAIL_HOST=127.0.0.1`

`MAIL_PORT=2525`

`MAIL_USERNAME=null`

`MAIL_PASSWORD=null`

`MAIL_FROM_ADDRESS="hello@example.com"`

`MAIL_FROM_NAME="${APP_NAME}"`

`AWS_ACCESS_KEY_ID=`

`AWS_SECRET_ACCESS_KEY=`

`AWS_DEFAULT_REGION=us-east-1`

`AWS_BUCKET=`

`AWS_USE_PATH_STYLE_ENDPOINT=false`

`VITE_APP_NAME="${APP_NAME}"`

`ANOTHER_API_KEY`

#

## Documentação

**Só funcionará caso vc rode o Sphinx Autobuild** 

[sphinx-autobuild](http://127.0.0.1:8000)

[CI-CD](http://127.0.0.1:8000/ci-cd.html#)

[Laravel](http://127.0.0.1:8000/laravel.html#)

#

## Screenshots

### Kubernetes Rodando no docker desktop
![Captura de Tela (30)](https://github.com/user-attachments/assets/d1aa33bd-c08b-4808-913f-dae959c150e1)

### Containeres kuberntes e locais rodando ao mesmo tempo
![Captura de Tela (29)](https://github.com/user-attachments/assets/89c8cc00-002a-4a75-9c45-c60b211edd0a)

### Frontend rodando em Kuberntes
![Captura de Tela (28)](https://github.com/user-attachments/assets/d67ee17c-9ffe-4df9-afa9-0c7e94b63069)

### Containeres docker rodando localmente front e backend
![Captura de Tela (27)](https://github.com/user-attachments/assets/6e9ea747-8053-4785-8ed3-5234e0e2973e)

### Testes Unitarios Laravel
![Captura de Tela (26)](https://github.com/user-attachments/assets/a2ccf7d6-5c15-44c2-abc4-73e0d75a8571)

### Testes Unitarios no Frontend
![Captura de Tela (24)](https://github.com/user-attachments/assets/17864567-f41b-4ecd-9a09-fcf2d13b4dca)

### Frontend Rodando
![Captura de Tela (23)](https://github.com/user-attachments/assets/a1f83dc0-930d-4265-ba41-13c1e57c6f37)

### Funionalidade de adição funcionando no frontend 
![Captura de Tela (22)](https://github.com/user-attachments/assets/457a948e-b9e6-4523-9ca2-158e8fe656e2)

### Retorno Da API Backend
![Captura de Tela (21)](https://github.com/user-attachments/assets/146e512a-0851-443d-8be8-5d2195a07d1b)

### Documentação Sphinx
![Captura de Tela (33)](https://github.com/user-attachments/assets/84b4ba6d-c287-425e-8b50-8fd650b9d14c)
