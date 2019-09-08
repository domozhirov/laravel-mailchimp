## Installation
```
$ composer update && npm install
```

Open ```.env``` and enter necessary config for DB and Mailchimp api key.


```
$ php artisan migrate
$ php artisan db:seed
```

## Work Flow

**General Workflow**

```
$ php artisan serve
```

> Default Username/Password: admin@laravel.com / password

## Using

**Update user-list subscribe status**
```
$ php artisan user-list:subscribed {status}
```
> status - 0 or 1

**Send user data to Mailchimp**
```
$ php artisan mailchimp:send {listId?}
```
