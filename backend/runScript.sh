#!/bin/bash

# Nome do container que você deseja acessar
CONTAINER_NAME="project-backend"

# Obtém o ID do container pelo nome
CONTAINER_ID=$(docker ps --filter "name=${CONTAINER_NAME}" --filter "status=running" --format "{{.ID}}")

# Verifica se o container está rodando
if [ -n "$CONTAINER_ID" ]; then
  echo "Container '${CONTAINER_NAME}' está rodando com o ID: $CONTAINER_ID"
  echo "Conectando ao shell do container '${CONTAINER_NAME}'..."

  # Tenta acessar o container com bash; fallback para sh, se necessário
  docker exec -it "$CONTAINER_ID" bash 2>/dev/null || docker exec -it "$CONTAINER_ID" sh
else
  echo "O container '${CONTAINER_NAME}' não está rodando. Certifique-se de que ele está ativo e tente novamente."
  exit 1
fi
