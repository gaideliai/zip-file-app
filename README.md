<p align="center"><a href="https://laravel.com" target="_blank"><img src="https://raw.githubusercontent.com/laravel/art/master/logo-lockup/5%20SVG/2%20CMYK/1%20Full%20Color/laravel-logolockup-cmyk-red.svg" width="400"></a></p>

<p align="center">
<a href="https://travis-ci.org/laravel/framework"><img src="https://travis-ci.org/laravel/framework.svg" alt="Build Status"></a>
<a href="https://packagist.org/packages/laravel/framework"><img src="https://img.shields.io/packagist/dt/laravel/framework" alt="Total Downloads"></a>
<a href="https://packagist.org/packages/laravel/framework"><img src="https://img.shields.io/packagist/v/laravel/framework" alt="Latest Stable Version"></a>
<a href="https://packagist.org/packages/laravel/framework"><img src="https://img.shields.io/packagist/l/laravel/framework" alt="License"></a>
</p>

File size:
1. Validation on Laravel application level - set max size 
2. PHP settings in php.ini - increase values:
    - upload_max_filesize = 1024M 
    - post_max_size = {{size}}M \
      (post_max_size should be greater than upload_max_filesize)
3. Web server configurations - increase values:
    - Nginx: client_max_body_size {{size}}M 
    - Apache: LimitRequestBody {{size}} (bytes)

Alternatively use chunked upload using e.g., pion/laravel-chunk-upload package.

