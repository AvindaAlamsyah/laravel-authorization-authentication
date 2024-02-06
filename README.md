<h3 align="center">Laravel Authorization Authentication</h3>

---
<p align="center">
    A simple system that implements Laravel Breeze for authentication and Spatie's Laravel Permission for authorization.
</p>


## 📝 Table of Contents

-   [About](#about)
-   [Getting Started](#getting_started)
-   [Usage](#usage)
-   [Built Using](#built_using)
-   [Authors](#authors)


## 🧐 About <a name = "about"></a>
A simple system that implements Laravel Breeze for authentication and Spatie's Laravel Permission for authorization. There is a Public page and an Admin/Internal page. For the Login page by default it will be an External type user (can only be changed and validated by Admin).


## 🏁 Getting Started <a name = "getting_started"></a>
These instructions will get you a copy of the project up and running on your local machine for development and testing purposes.

### Prerequisites
To run this project, the following software is required :

- MySQL Community Server v5.7 and above
- PHP v8.1 and above
- Node.js v18 with npm v10
- Composer v2.4


### Installing
Clone this project first
```
git clone git@github.com:AvindaAlamsyah/laravel-authorization-authentication.git
```

Then go to the cloned repository folder. Then install the required package and build the assets. This project use Vite to build the assets.
```
cd laravel-authorization-authentication
composer install
npm install
npm run build
```

Copy the .env.example file with the name .env
```
cp .env.example .env
```

Create the database that will be used. Next generate the application key.
```
php artisan key:generate
```

Change the variables in the .env file such as :
- DB_DATABASE fill in the name of the database that was created.

Update project cache to read the latest ENV settings
```
php artisan optimize:clear
```

Run the available Migrations and Seeders
```
php artisan migrate:refresh --seed
```


## 🎈 Usage <a name="usage"></a>

This system has 2 types of access, namely Public and Admin / Internal. For public access, you can directly visit the system url that you have specified. As for admin access, add the route "internal" after the system url.



## ⛏️ Built Using <a name = "built_using"></a>

-   [MySQL](https://dev.mysql.com/downloads/mysql/) - Database
-   [Laravel 10](https://laravel.com/docs/10.x/releases) - Web Framework
-   [Laragon](https://laragon.org/index.html) - Server Environment
-   [VS Code](https://code.visualstudio.com/) - Code Editor

## ✍️ Authors <a name = "authors"></a>

-   [@AvindaAlamsyah](https://github.com/AvindaAlamsyah) - Idea & Initial work
