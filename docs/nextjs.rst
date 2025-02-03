==========================
Documentação do Next.js
==========================

O frontend foi desenvolvido com **Next.js** e se comunica com a API do Laravel.

🚀 **Tecnologias Usadas**
- Next.js 14
- JavaScript
- Tailwind CSS
- Docker + Kubernetes

📌 **Instalação**
Para instalar o frontend:

.. code-block:: bash

    npm install

📌 **Rodando o Servidor**
Execute:

.. code-block:: bash

    npm run dev

Acesse `http://localhost:3000`.

📌 **Configuração do `.env.local`**
Defina a API do backend:

.. code-block:: ini

    NEXT_PUBLIC_API_URL=http://localhost:8000/api
