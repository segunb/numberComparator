This project contains code that implements a function (and UI) to compare three numbers, returning true or false (depending on whether the first two numbers add up to the third).

# Installation

+ Ensure you have docker installed locally
+ Clone repository (https://github.com/segunb/numberComparator)
+ Start the Docker container defined `docker-compose up -d --build`
(you may have to change volume mappings in docker-compose definition yml file)
+ Access the running Docker container's command line `docker exec -it <container> bash`
+ Install the following by running the commands below (from \var\www\html in container):

 1) Install dependencies defined in composer `php composer.phar install`

 2) UI should now be avaialble at *http://localhost:8888/* (if config in Dockerfile/docker-compose files haven't been changed)

 3) To run PHP unit tests: `./vendor/bin/phpunit tests`

 4) Install PHPUnit using:<br>
    `php composer.phar require --dev phpunit/phpunit`<br>
 	`php composer.phar dump-autoload`

 5) To check PHP unit version:
	`./vendor/bin/phpunit --version`

