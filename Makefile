all: fresh build install

fresh:
	git pull
	composer update

install: build
	echo install
	
build: doc
	echo build

clean:
	rm -rf debian/php-ipex-b2b
	rm -rf debian/php-ipex-b2b-doc
	rm -rf debian/*.log
	rm -rf docs/*

doc:
	debian/apigendoc.sh

test:
	phpunit --bootstrap testing/bootstrap.php

deb:
	debuild -i -us -uc -b

.PHONY : install
	
