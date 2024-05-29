#!/bin/bash

cd /usr/app

if [ ! -f ".env" ]; then
   cp .env.example .env
fi

yarn install

yarn run dev
