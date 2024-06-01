### Run Laravel

```sh 
cd C:\Users\Diana\Desktop\Diploma\aibolit 
C:
php artisan serve
```

### Run vue dev

```sh 
cd C:\Users\Diana\Desktop\Diploma\aibolit 
C:
npm run dev
```

#### Snippets:

```sh
php artisan make:model NameModel -mfs
php artisan make:controller NameController --resource
php artisan migrate
```

### Run seeders

```sh
php artisan migrate:fresh --seed
php artisan db:seed --class=SpeciesSeeder
php artisan db:seed --class=BreedsSeeder
php artisan db:seed --class=UserSeeder
php artisan db:seed --class=ClientsSeeder
php artisan db:seed --class=SpeciesSeeder
php artisan db:seed --class=BreedsSeeder
php artisan db:seed --class=PetsSeeder
php artisan db:seed --class=ItemsSeeder
php artisan db:seed --class=VetSeeder
```

### Run build vue (create static files) fol laravel
```sh
npm run build
```



Remove old sym link  and create new for upload files work
```sh
cd public
rmdir storage
cd ..
php artisan storage:link
```
