==========================
Documentação do Laravel
==========================

O backend do **Desafio Arte Arena** foi desenvolvido usando **Laravel**. Ele expõe uma API REST para o frontend Next.js.

🚀 **Tecnologias Usadas**
- PHP 8.2
- Laravel 11
- MySQL
- Docker + Kubernetes

📌 **Instalação**
Para instalar o Laravel, execute:

.. code-block:: bash

    composer install
    cp .env.example .env
    php artisan key:generate

📌 **Rodando o Servidor**
Execute:

.. code-block:: bash

    php artisan serve --host=0.0.0.0 --port=8000

Acesse `http://localhost:8000`.

📌 **Estrutura da API**
- `GET /items`: Lista items.
- `POST /items`: Faz cadastro de items.
