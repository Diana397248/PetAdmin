php artisan migrate:fresh --seed
php artisan db:seed --class=SpeciesSeeder
php artisan db:seed --class=BreedsSeeder
php artisan db:seed --class=UserSeeder
php artisan db:seed --class=ClientsSeeder
php artisan db:seed --class=PetsSeeder
php artisan db:seed --class=ItemsSeeder
php artisan db:seed --class=VetSeeder
npm run build
php artisan serve
