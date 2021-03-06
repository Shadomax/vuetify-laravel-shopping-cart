<?php

/*
|--------------------------------------------------------------------------
| Model Factories
|--------------------------------------------------------------------------
|
| Here you may define all of your model factories. Model factories give
| you a convenient way to create models for testing and seeding your
| database. Just tell the factory how a default model should look.
|
*/

/** @var \Illuminate\Database\Eloquent\Factory $factory */

$factory->define(
    App\Cart::class,
    function (Faker\Generator $faker)
    use ($factory)
{
    return [
        'user_id' => $factory->create(App\Profile::class)->id,
    ];
});


$factory->define(
    App\Product::class,
    function (Faker\Generator $faker)
{
    return [
        'title' => $faker->text(60),
        'description' => $faker->paragraph,
        'image' => config('settings.demo')
            ? $faker->imageUrl($width = 600, $height = 400)
            : '/images/dev/640x480.png',
        'price' => $faker->biasedNumberBetween(1, 200000, 'cos'),
        'inventory' => $faker->biasedNumberBetween(1, 100, 'cos'),
        'shipping' => $faker->biasedNumberBetween(100, 10000, 'cos')
    ];
});


$factory->define(
    App\Profile::class,
    function (Faker\Generator $faker)
{
    return [
        'first' => $faker->firstName,
        'last' => $faker->lastName,
        'limit' => $faker->numberBetween(200,1000000),
    ];
});


$factory->define(
    App\Promotion::class,
    function (Faker\Generator $faker)
{
    return [
        'title' => $faker->text,
    ];
});


$factory->define(
    App\User::class,
    function (Faker\Generator $faker)
{
    static $password;

    return [
        'name' => $faker->name,
        'email' => $faker->unique()->safeEmail,
        'password' => $password ?: $password = bcrypt('secret'),
        'remember_token' => str_random(10),
    ];
});
