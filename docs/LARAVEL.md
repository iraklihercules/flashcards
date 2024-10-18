
# Laravel


## 1. Create project

```bash
composer create-project laravel/laravel .

# Configure the database in ".env" file
DB_CONNECTION=mysql
DB_HOST=mysql
DB_PORT=3306
DB_DATABASE=database_name
DB_USERNAME=username
DB_PASSWORD=password

# Migrations
php artisan migrate  # Run pending migrations
php artisan migrate:fresh  # Reset and run all

# If we want to delete the base tables,
# we have to keep the session table, so we do:
php artisan session:table
php artisan migrate
```


## 2. Cheatsheets

```bash
# Migrations
php artisan migrate
php artisan migrate:fresh
php artisan migrate:rollback
php artisan make:migration add_thumbnail_to_products_table --table=products

# Create controllers
php artisan make:controller CategoryController  # With all methods
php artisan make:controller CategoryController --api  # Without form methods ("create" and "edit")

# Create models
php artisan make:model Category --controller --migration --resource --requests
php artisan make:model Category -cmrR

# Create & run commands
php artisan make:command PopulateDatabase
php artisan app:populate-database
```

```bash
# Adding routes to the routes/web.php
# First option adds "create" and "edit" methods as well.
# For the REST API better add routes separately.
Route::get('/api/products', [ProductController::class, 'index']);

Route::prefix('api')->group(function () {
    Route::get('/token', TokenController::class .'@index')->name('api.token');
    Route::get('/categories', CategoryController::class .'@index')->name('categories.index');
    Route::post('/categories', CategoryController::class .'@store')->name('categories.store');
    Route::get('/categories/{category}', CategoryController::class .'@show')->name('categories.show');
    Route::put('/categories/{category}', CategoryController::class .'@update')->name('categories.update');
    Route::delete('/categories/{category}', CategoryController::class .'@destroy')->name('categories.destroy');
});

# CSRF: For the rest api we need the CSRF token
# routes/web.php
Route::get('/api/token', function () {
  return response()->json(['_token' => csrf_token()]);
});

# Then we add "_token" parameter to the post body:
{"_token": "token_here"}
```

```bash
# Migrations
$table->foreignIdFor(Category::class);
$table->foreignIdFor(Category::class, 'category_id');
$table->foreignId('category_id')->references('id')->on('categories');
```

## 3. Swagger

```bash
composer require "darkaonline/l5-swagger"
php artisan vendor:publish --provider="L5Swagger\L5SwaggerServiceProvider"

# Add to the main controller
/**
 * @OA\Info(
 *     title="Flashcards API",
 *     version="1.0.0",
 * )
 */

# Add to controllers methods
/**
 * @OA\Get(
 *     path="/api/token",
 *     description="Get token",
 *     @OA\Response(response=200, description="Get token"),
 * )
 */

php artisan l5-swagger:generate
```

```bash
# Configure config/l5-swagger.php file

# Enable/disable automatic updates.
'generate_always' => env('L5_SWAGGER_GENERATE_ALWAYS', true),

# Set swagger URL
'api' => 'api/docs',

# Avoid CSRF errors in swagger adding "web" to middlewares
'middleware' => [
    'api' => ['web'],
],
```

## 4. Linux permissions

Sometimes, the "storage" directory may cause permission problems between `www-data` and `developer` users:

```bash
# 1. Create a new group
sudo groupadd my_group

# 2. Add users
sudo usermod -aG my_group user_1
sudo usermod -aG my_group user_2

# 3. Change directory properties
sudo chown :my_group /path/to/my/directory
sudo chmod 775 /path/to/my/directory
sudo chmod g+s /path/to/my/directory

# Some handy commands
cat /etc/passwd  # See users
cat /etc/group  # See groups
usermod -aG {group} {user}  # Add user to group
groups {user}  # See the user's groups
```

```bash
# In this case the problem is solved in the Dockerfile,
# so, there is no need to do anything.
ARG NON_PRIVILEGED_USER="developer"
RUN groupadd --gid 1000 ${NON_PRIVILEGED_USER} \
    && useradd ${NON_PRIVILEGED_USER} --create-home --uid 1000 --gid 1000 --shell /bin/bash \
    && usermod --append --groups www-data ${NON_PRIVILEGED_USER} \
    && usermod --append --groups ${NON_PRIVILEGED_USER} www-data \
    && echo 'alias ll="ls -al"' >> /root/.bashrc \
    && echo 'alias ll="ls -al"' >> /home/${NON_PRIVILEGED_USER}/.bashrc
```