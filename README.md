<p align="center"><img src="https://res.cloudinary.com/dtfbvvkyp/image/upload/v1566331377/laravel-logolockup-cmyk-red.svg" width="400"></p>

<p align="center">
<a href="https://travis-ci.org/laravel/framework"><img src="https://travis-ci.org/laravel/framework.svg" alt="Build Status"></a>
<a href="https://packagist.org/packages/laravel/framework"><img src="https://poser.pugx.org/laravel/framework/d/total.svg" alt="Total Downloads"></a>
<a href="https://packagist.org/packages/laravel/framework"><img src="https://poser.pugx.org/laravel/framework/v/stable.svg" alt="Latest Stable Version"></a>
<a href="https://packagist.org/packages/laravel/framework"><img src="https://poser.pugx.org/laravel/framework/license.svg" alt="License"></a>
</p>

## How to install 

download this git

run 
```
composer install
```

then create storage symlink
```
php artisan storage:link
```

in cpanel run
```
https://sustpressclub.org/symlink.php or https://sustpressclub.org/create-symlink
```


In shared hosting at Cron jobs paste it
```
/usr/local/bin/php /home/thirdeye/sustpressclub.org/artisan schedule:run >> /dev/null 2>&1
```
