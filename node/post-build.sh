#!/bin/bash

cd /usr/app

if [ ! -f ".env" ]; then
   cp .env.example .env.local
fi

yarn install

yarn run dev --host 0.0.0.0 --port 5173
