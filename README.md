# LaravelPejer
Pejer API Wrapper For Laravel and Lumen

## Installation
You can install the package using composer
```sh
$ composer require arcphysx/laravel-pejer
```
Then add the service provider to `config/app.php`. In Laravel versions 5.5 and beyond, this step can be skipped if package auto-discovery is enabled.

```php
'providers' => [
    ...
    Arcphysx\LaravelPejer\Providers\LaravelPejerServiceProvider::class
    ...
];
```

Then add some required value on your .env file
```
PEJER_API_TOKEN="<your-pejer-api-token>"
PEJER_TEAM_ID="<your-pejer-team-id>"
```

You can publish the configuration file and assets by running:
 
```sh
$ php artisan vendor:publish --provider="Arcphysx\LaravelPejer\Providers\LaravelPejerServiceProvider"
```

After publishing a few new files to our application we need to reload them with the following command:

```sh
$ composer dump-autoload
```

## Basic Usage

### Send Whatsapp Message
```php
LaravelPejer::whatsapp()
            ->sendMessage('<your-phone-number>', '<your-mesage>')
            ->ok()
```

### Validate Whatsapp Number
```php
    LaravelPejer::whatsapp()
                ->validateAccountExist('<your-phone-number>')
                ->json()
```