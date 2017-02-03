# translations

# instalation

## add to "\config\app.php":
    'providers' => [
        ...
        Bunta\Translations\TranslationsServiceProvider::class
        ...
    ],


## add to "\app\SomeModel.php":
    ...
    use \Bunta\Translations\TranslationsTrait;
    ...
    public $translatedAttributes = ['nameVirtualAttributeToTranslate'];
    ...

## run comands
    composer du
    php artisan optimize 
    php artisan vendor:publish
    php artisan migrate
# Usage 

## Access to right translate 
    
    $model->nameVirtualAttributeToTranslate; 

## Access to all translates

    @foreach(Config::get('translations.locales') as $lang)
        {!! Form::text("nameVirtualAttributeToTranslate[$lang]",$model->translation('nameVirtualAttributeToTranslate',$lang)) !!}
    @endforeach 

## save translate

     Model::create($request->all());