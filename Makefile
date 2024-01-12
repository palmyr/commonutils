install:
	composer install

fix:
	vendor/bin/php-cs-fixer fix ./src/

clean:
	rm -rf ./vendor/
