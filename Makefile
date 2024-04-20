server:
	php -S localhost:8080 -t public

csfixer:
	vendor/bin/php-cs-fixer fix src

stan:
	vendor/bin/phpstan analyse src --level=9

psalm:
	vendor/bin/psalm