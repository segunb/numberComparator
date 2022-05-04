This project contains code that implements a function (and UI) to compare three numbers, returning true or false (depending on whether the first two numbers add up to the third).

# Installation

+ Ensure you have docker installed locally
+ Clone repository (https://github.com/segunb/numberComparator)
+ Start the Docker container defined `docker-compose up -d --build`
(you may have to change volume mappings in docker-compose definition yml file)
+ Access the running Docker container's command line `docker exec -it <container> bash`
+ Install the following by running the commands below (from \var\www\html in container):
 
 1) Install PHPUnit using:<br>
    `php composer.phar require --dev phpunit/phpunit`<br>
 	`php composer.phar dump-autoload`

 2) Check version:
	`./vendor/bin/phpunit --version`

 3) To run PHP unit tests: `./vendor/bin/phpunit tests`