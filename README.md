# Instalação

1. Inicializar docker
   - docker-compose up -d

2. Entrar no container
   - docker exec -it logcomex_server bash

3. Instalar Composer e demais dependências
   - composer install
   - chmod -R 777 storage bootstrap/cache
   - cp .env.example .env
   - php artisan key:generate
   - php artisan migrate
   - npm install
   - npm run dev

4. Rodar fila de job
   - php artisan queue:work 

5. Popular Pokemons
   -  php artisan app:sync-pokemon
