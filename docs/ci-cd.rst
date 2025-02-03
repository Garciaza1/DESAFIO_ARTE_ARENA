==========================
CI/CD e Kubernetes
==========================

O projeto usa **GitHub Actions** para CI/CD e faz deploy no **Kubernetes**.

📌 **Pipeline de CI/CD**
Exemplo com GitHub Actions:

.. code-block:: yaml

    name: CI/CD Pipeline

    on:
      push:
        branches:
          - main

    jobs:
      build:
        runs-on: ubuntu-latest

        steps:
        - name: Checkout code
          uses: actions/checkout@v2

        - name: Set up Node.js
          uses: actions/setup-node@v2
          with:
            node-version: '16'

        - name: Install dependencies
          run: npm install

        - name: Build
          run: npm run build

        - name: Deploy to Kubernetes
          run: kubectl apply -f kubernetes/frontend-deployment.yaml

📌 **Deploy no Kubernetes**
Para aplicar os serviços:

.. code-block:: bash

    kubectl apply -f kubernetes/

Acesse a aplicação via `http://IP_DO_CLUSTER`.
