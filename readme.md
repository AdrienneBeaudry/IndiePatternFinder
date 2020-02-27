# INDIE PATTERN FINDER

A search engine for independent sewing patterns. As of January 2018, there are 500+ independent
sewing-pattern designers, but no single platform to search them all. I built scrapers that scanned the web and collected data, later rendered searchable on my platform. 

The scope for the project was to create a minimal viable product.

This project was developed as the final requirement for the completion of the
[Web Developer for e-Commerce](http://medieinstitutet.se/webbutvecklare-ehandel/) programme of study
at [Medieinstutet](http://medieinstitutet.se/) in Gothenburg.

## Getting Started

These instructions will get you the project up and running on your local machine for development 
and testing purposes.

### Prerequisites

Requires the following:

```
MAMP or XAMPP
PHP 5.3.2+
Google Chrome version 63.0.3239 - or comparable
Composer
Laravel 5.5

```

### Installing

How to set up an environment for development and testing:
1) Clone repository

2) Setup new laravel project via Composer

```
composer create-project laravel/laravel

```

3) Install following packages:

```
composer require querypath/querypath
composer require guzzlehttp/guzzle
composer require barryvdh/laravel-ide-helper
```

4) Connect project with database (see .env.example file)


5) Run migrations:

```
php artisan migrate
```
6) Run commands:

```
php artisan get:named
php artisan get:grainline
php artisan get:pauline
```
Application now ready to use.

## Built With

* [Laravel](https://laravel.com/) - Laravel
* [QueryPath](https://github.com/technosophos/querypath) - QueryPath

## Contributing

Contributions welcome! Suggestions and requests from non-coding contributors would be appreciated at this stage.

## Authors

* **Adrienne Beaudry** - *Initial work* - [GitHub](https://github.com/AdrienneBeaudry)/[BitBucket](https://bitbucket.org/AdrienneBeaudry/)/[LinkedIn](https://linkedin/in/AdrienneBeaudry)


## License

This project is licensed under the MIT License - see the [LICENSE.md](LICENSE.md) file for details

## Acknowledgments

* Thank you to Marcus Dalgren, advisor for this project, for his continuous guidance and feedback
* Thank you to all other developers at Raket Web Agency for ideas
