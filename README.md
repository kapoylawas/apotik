<p align="center"><a href="https://laravel.com" target="_blank"><img src="https://raw.githubusercontent.com/laravel/art/master/logo-lockup/5%20SVG/2%20CMYK/1%20Full%20Color/laravel-logolockup-cmyk-red.svg" width="400"></a></p>

<p align="center">
<a href="https://travis-ci.org/laravel/framework"><img src="https://travis-ci.org/laravel/framework.svg" alt="Build Status"></a>
<a href="https://packagist.org/packages/laravel/framework"><img src="https://img.shields.io/packagist/dt/laravel/framework" alt="Total Downloads"></a>
<a href="https://packagist.org/packages/laravel/framework"><img src="https://img.shields.io/packagist/v/laravel/framework" alt="Latest Stable Version"></a>
<a href="https://packagist.org/packages/laravel/framework"><img src="https://img.shields.io/packagist/l/laravel/framework" alt="License"></a>
</p>

## About Laravel

Laravel is a web application framework with expressive, elegant syntax. We believe development must be an enjoyable and creative experience to be truly fulfilling. Laravel takes the pain out of development by easing common tasks used in many web projects, such as:

- [Simple, fast routing engine](https://laravel.com/docs/routing).
- [Powerful dependency injection container](https://laravel.com/docs/container).
- Multiple back-ends for [session](https://laravel.com/docs/session) and [cache](https://laravel.com/docs/cache) storage.
- Expressive, intuitive [database ORM](https://laravel.com/docs/eloquent).
- Database agnostic [schema migrations](https://laravel.com/docs/migrations).
- [Robust background job processing](https://laravel.com/docs/queues).
- [Real-time event broadcasting](https://laravel.com/docs/broadcasting).

Laravel is accessible, powerful, and provides tools required for large, robust applications.

The Laravel framework is open-sourced software licensed under the [MIT license](https://opensource.org/licenses/MIT).
# apotik
<b> install laravel breeze </b>
1. composer require laravel/breeze --dev
2. php artisan breeze:install
3. npm install
4. npm run dev
# https://laratrust.santigarcor.me/docs/6.x/usage/seeder.html#seeder-configuration-file
<b> install Laratrust (untuk mengatur role) </b>
1. composer require santigarcor/laratrust
2. php artisan vendor:publish --tag="laratrust"
3. php artisan laratrust:setup
4. composer dump-autoload
5. php artisan migrate
6. php artisan laratrust:seeder
7. php artisan vendor:publish --tag="laratrust-seeder" 
8. (bukak file di /config/latrust_seeder.php  untuk mengatur role tertentu)
9. buka di folder database database/seeds/DatabaseSeeder.php tambahkan file : $this->call(LaratrustSeeder::class);
10. composer dump-autoload
11. php artisan db:seed 
12. buka di controller/Auth/RegisteredUserController.php tambah file untuk regristasi sesuai role :  $user->attachRole('sesuairole'); 
13. tambah kan route untuk redirect lgoin awal = Route::get('/dashboard', [DashboardController::class, 'index'])->name('dashboard');
# untuk save ip adress
1. php artisan make:migration add_login_fields_to_users_table
2. menambai tabel  = $table->datetime('last_login_time')->nullable();
                     $table->string('last_login_ip')->nullable();
3. php artisan make:listener Loginlistener
4. buka LoginListener.php = $event->user->update([
                                'last_login_time' => now('Asia/Jakarta'),
                                'last_login_ip' => request()->getClientIp(),
                            ]);
5. app/Providers/EventServiceProvider.php tambai =  Login::class => [
                                                                        LoginListener::class,
                                                                    ],

