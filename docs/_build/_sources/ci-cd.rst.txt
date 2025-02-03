==========================
CI/CD e Kubernetes
==========================

O projeto usa **GitHub Actions** para CI/CD e faz deploy no **Kubernetes**.

📌 **Pipeline de CI/CD Kubernetes**
Com GitHub Actions:

.. code-block:: yaml

    name: Deploy to Kubernetes

    on:
    push:
        branches:
        - main

    jobs:
    deploy:
        runs-on: ubuntu-latest

        steps:
        - name: 📥 Checkout do código
        uses: actions/checkout@v3

        - name: 🔐 Configurar acesso ao Kubernetes
        run: |
            echo "${{ secrets.KUBE_CONFIG }}" > kubeconfig.yaml
            export KUBECONFIG=kubeconfig.yaml

        - name: 🚀 Atualizar deploy no Kubernetes
        run: |
            kubectl apply -f kubernetes/backend-deployment.yaml
            kubectl apply -f kubernetes/frontend-deployment.yaml

📌 **Deploy no Kubernetes**
Para aplicar os serviços:

.. code-block:: bash

    kubectl apply -f kubernetes/

Acesse a aplicação via `http://IP_DO_CLUSTER`.

📌 **Pipeline de CI/CD Backend**
Com GitHub Actions:

.. code-block:: yaml

    name: Backend CI/CD

    on:
    push:
        branches:
        - main
    pull_request:
        branches:
        - main

    jobs:
    build-test:
        runs-on: ubuntu-latest

        steps:
        - name: 📥 Checkout do código
        uses: actions/checkout@v3

        - name: 🐘 Instalar PHP e dependências
        uses: shivammathur/setup-php@v2
        with:
            php-version: '8.2'
            extensions: mbstring, pdo, pdo_mysql, bcmath
            tools: composer:v2

        - name: 📦 Instalar dependências do Laravel
        run: |
            cd backend
            composer install --no-dev --optimize-autoloader
            cp .env.example .env
            php artisan key:generate

        - name: 🧪 Rodar Testes
        run: |
            cd backend
            php artisan test

        - name: 🐳 Build da imagem Docker
        run: |
            docker build -t ghcr.io/${{ github.repository }}/backend:latest backend

        - name: 🔐 Login no GitHub Container Registry
        run: echo "${{ secrets.GITHUB_TOKEN }}" | docker login ghcr.io -u $GITHUB_ACTOR --password-stdin

        - name: 📤 Push da imagem para o GHCR
        run: |
            docker push ghcr.io/${{ github.repository }}/backend:latest

📌 **Pipeline de CI/CD Frontend**
Com GitHub Actions:

.. code-block:: yaml

    name: Frontend CI/CD

    on:
    push:
        branches:
        - main
    pull_request:
        branches:
        - main

    jobs:
    build-test:
        runs-on: ubuntu-latest

        steps:
        - name: 📥 Checkout do código
        uses: actions/checkout@v3

        - name: 📦 Instalar Node.js e dependências
        uses: actions/setup-node@v3
        with:
            node-version: '18'

        - name: 📦 Instalar dependências do Next.js
        run: |
            cd frontend
            npm install

        - name: 🏗 Build do frontend
        run: |
            cd frontend
            npm run build

        - name: 🐳 Build da imagem Docker
        run: |
            docker build -t ghcr.io/${{ github.repository }}/frontend:latest frontend

        - name: 🔐 Login no GitHub Container Registry
        run: echo "${{ secrets.GITHUB_TOKEN }}" | docker login ghcr.io -u $GITHUB_ACTOR --password-stdin

        - name: 📤 Push da imagem para o GHCR
        run: |
            docker push ghcr.io/${{ github.repository }}/frontend:latest
.........