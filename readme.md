 > Laravel REST API to manage devices and it corresponding Manufacturer

- Link to Hosted API on Heroku
![Heroku Api](https://stark-beyond-32222.herokuapp.com/api/smart-device/)

### Required Development Environment. 

Ensure your server/Machine meets the following requirements
- PHP >= 7.2.5
- BCMath PHP Extension
- Ctype PHP Extension
- Fileinfo PHP extension
- JSON PHP Extension
-  PHP Extension
- OpenSSL PHP Extension
- PDO PHP Extension
- Tokenizer PHP Extension
- XML PHP Extension

If on Windows best way to avoid indivual install is by installing [Xampp](https://www.apachefriends.org/download.html)

Have [Composer](https://www.apachefriends.org/download.html) Installed

For More info please visit [Official Laravel Documentation](https://laravel.com/docs/7.x/installation)

### Clone the App from github
```
https://github.com/ujingene/Device-Manufacturer-REST-API.git

```
### copy the project folder into htdocs folder

### cd into your Project

```bash
cd into your project
```

### Install Composer Dependencies

```bash
composer install
```

### Install NPM Dependencies (Optional)
I have created a simple view to display Api Name. If you want to see this then run 
```bash
npm install
```

###  Create a copy of your .env file

```bash
cp .env.example .env
```

### Generate an app encryption key

```bash
php artisan key:generate
```

###  Create an empty database 
Can use **SequelPRo** for Mac or **DBeaver Community** on windows

### In the .env file, add database information to allow Laravel to connect to the database

fill in the **DB_HOST, DB_PORT, DB_DATABASE, DB_USERNAME, and DB_PASSWORD** options to match the credentials of the database you just created

### Migrate the database
```bash
php artisan migrate
```

### Seed the database (Manufacturer Table)

## Application Info

### Author

[Eugene Wanjira](http://www.github.com/ujingene)

### Version

1.0.0

### License

This project is licensed under the MIT License