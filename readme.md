# INDIE PATTERN FINDER

A search engine for independent sewing patterns, which allows to search through thousands of patterns 
instead of forcing users to visit each web shop individually. There are, in January 2018, 500+ independent
sewing-pattern designers.

## Getting Started

These instructions will get you a copy of the project up and running on your local machine for development 
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

```
https://AdrienneBeaudry@bitbucket.org/AdrienneBeaudry/indiepatternfinder.git
```

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
6) Run commands successively:

```
php artisan get:named
php artisan get:grainline
php artisan get:pauline
```

Install IDE helper in project

```
composer require barryvdh/laravel-ide-helper
```
You should now be able to use the application on your local host by visiting the designated URL in your browser.
## Running the tests

Explain how to run the automated tests for this system

### Break down into end to end tests

Explain what these tests test and why

```
Give an example
```

### And coding style tests

Explain what these tests test and why

```
Give an example
```

## Built With

* [Dropwizard](http://www.dropwizard.io/1.0.2/docs/) - Laravel
* [Maven](https://maven.apache.org/) - QueryPath
* [ROME](https://rometools.github.io/rome/) - Used to generate RSS Feeds

## Contributing

Please read [CONTRIBUTING.md](https://gist.github.com/PurpleBooth/b24679402957c63ec426) for details on our code of conduct, and the process for submitting pull requests to us.

## Versioning

We use [SemVer](http://semver.org/) for versioning. For the versions available, see the [tags on this repository](https://github.com/your/project/tags). 

## Authors

* **Adrienne Beaudry** - *Initial work* - [GitHub](https://linkedin/in/AdrienneBeaudry)/[BitBucket](https://linkedin/in/AdrienneBeaudry)/[LinkedIn](https://linkedin/in/AdrienneBeaudry)

See also the list of [contributors](https://github.com/your/project/contributors) who participated in this project.

## License

This project is licensed under the MIT License - see the [LICENSE.md](LICENSE.md) file for details

## Acknowledgments

* Hat tip to anyone who's code was used
* Inspiration
* etc
