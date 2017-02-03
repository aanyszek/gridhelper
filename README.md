# gridhelper

# instalation

## add to "\config\app.php":
    'providers' => [
        ...
        Bunta\GridHelper\GridHelperServiceProvider::class
        ...
    ],



## run comands
    composer du
    php artisan optimize 
    php artisan vendor:publish
    php artisan migrate
# Usage 
reate($request->all());