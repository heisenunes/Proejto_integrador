# Development Manual

## 1) Dependencies

- If you're using an Ubuntu distribution you can run

```shell
sudo apt-get install npm composer php8.1 php8.1-pgsql
```

```
sudo apt-get install -y nodejs
```

- For the database we used PostgreSQL and pgADMIN is recommended

https://www.postgresql.org/download/

https://www.pgadmin.org/download/

## 2) Installing

```shell
composer install;
npm install;
```

- Now you need to create a .env file or you can rename ours at /src/.env_example (remove '**_example**', change values of the .env and save)

```shell
APP_NAME=Laravel
APP_ENV=local
APP_KEY=base64:24/rgBoL1QdcGnQci7kg1fQzSDam54v2DZhew1XUnrg=
APP_DEBUG=true
APP_URL=http://localhost
```

## 3) Setup Database

Create a Database locally and change these values in your .env

```shell
DB_CONNECTION=pgsql
DB_HOST=127.0.0.1
DB_PORT=5432
DB_DATABASE=postgres
DB_USERNAME=postgres
DB_PASSWORD=01230123
```

- Once you have everything correctly set up we can migrate and seed the Database

```shell
 php artisan migrate:fresh; 
 php artisan db:seed;
```


## 4) Running Server in localhost

- Only thing missing is to run artisan serve and npm

```shell
php artisan serve
```

```shell
npm run watch
```

> WARNING: For steps 3 & 4 remember to change to the **/src** directory

## MVC - Model, View, Controller

- Routes are available at [/src/routes/web.php](https://git.fe.up.pt/alexandre.valle/dei-acolhimento/-/blob/main/src/routes/web.php)

```shell
#Run this when you make Route modifications
php artisan route:cache
```

- Models are available at [/src/app/Models](https://git.fe.up.pt/alexandre.valle/dei-acolhimento/-/tree/main/src/app/Models)

- Views are available at [/src/resources/views](https://git.fe.up.pt/alexandre.valle/dei-acolhimento/-/tree/main/src/resources/views)

- and Controllers at [/src/app/Http/Controllers](https://git.fe.up.pt/alexandre.valle/dei-acolhimento/-/tree/main/src/app/Http/Controllers)




## Notes

- Email

It is possible to setup the email in localhost, in order to do this you must change the values of your **/src/.env**

- RichText

We used tinymce as as Rich Text Editor for the Topics Posts. Documentation can be found at:

https://www.tiny.cloud/tinymce/
