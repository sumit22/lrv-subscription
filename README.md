Project Setup

1. clone repository
2. navigate to project folder and run `composer install`
3. create a database on your local mysql server, preferable named `lrv_subscription`, also adjust database connection related variables
4. execute `php artisan migrate`
5. run seeders to prepopulate some websites, users and subscriptions by users
   ```

   php artisan db:seed --class=UserSeeder
   php artisan db:seed --class=WebsiteSeeder
   php artisan db:seed --class=WebsiteSubscriberSeeder

   ```

6. Setup Email testing, this can be done using any email interceptor, in this case i had tested this using mailtrap. update following .env variables if using mailtrap

```
    MAIL_MAILER=smtp
    MAIL_HOST=sandbox.smtp.mailtrap.io
    MAIL_PORT=2525
    MAIL_USERNAME=*******e8c86
    MAIL_PASSWORD=*********18b
```

7. RUN THE ENVIRONMENT, run following commands in separate terminal tabs/instances

```
    php artisan serve //start dev server

    php artisan queue:work //start queue worker
```
