# Joel Ecommerce App pour les arts

1. `git clone https://github.com/ariel996/joel_ecommerce.git`
2. `composer install` && `npm install`, and `npm run dev`
3. `php artisan migrate` ou bien `php artisan migrate:fresh`
4. Pour créer un utilisateur en tant que admin, il faut démarrer cette commande: `php artisan make:filament-user` et répondre aux questions te seront posées et je te recommande de prendre une adresse se terminant par `@joel.com` parce que j'ai instruit que seule les personnes ayant une adresse électronique se terminant par @joel.com pourront accéder à ce panel.
5. Ensuite accède au panel administratif à cette adresse: `localhost:8000/admin/login`
