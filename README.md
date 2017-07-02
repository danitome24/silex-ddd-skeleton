## Silex ddd skeleton

This is a simple project to improve my DDD skills and learn a little of Silex Php framework.

## Getting started
These instructions will get you a copy of the project up and running on your local machine for development and testing purposes.

### Prerequisites
You must have installed docker on your local machine to run it easily. 
To install [docker](https://docs.docker.com/engine/installation/) and [docker-compose](https://docs.docker.com/compose/install/)

### Installing
Open your command line interface and write:

```bash
docker-compose up -d
```

This will build the docker image and start needed container in background.

Download composer packages with the next command:

```bash
docker run --rm -v $(pwd):/app -u $(id -u):$(id -g) composer/composer install
```

## Running the tests

Use the following command:

```bash
vendor/phpunit/phpunit/phpunit
```

## Another useful Docker commands

```bash
# List containers
docker-compose ps

# View logs
docker-compose logs

# Restart containers
docker-compose restart

# Stop containers
docker-compose stop

# Stop and remove containers.
docker-compose down

# Start a terminal session for php-apache container
docker-compose exec silexdddskeleton_web_1 bash

# Execute command into mysql container
docker-compose exec silexdddskeleton_db_1 mysql -uroot -p -e 'COMMAND'
```

## Built with
* [Silex](http://silex.sensiolabs.org/) - Microframework for PHP
* [Composer](https://getcomposer.org/) - Dependencies management
* [Bootstrap 4](https://v4-alpha.getbootstrap.com/) - Front end framework

## Author
Me, Daniel Tomé Fernández <danieltomefer@gmail.com>
Javi Sabalete <sabaletej@gmail.com>

## License
This project is licensed under the MIT [License](LICENSE.md) - see the LICENSE.md file for details