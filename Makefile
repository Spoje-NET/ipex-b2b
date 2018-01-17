all: fresh build install

fresh:
	git pull
	composer update

install: build
	echo install
	
build:
	echo build

clean:
	rm -rf debian/php-ipex-b2b
	rm -rf debian/php-ipex-b2b-doc
	rm -rf debian/*.log
	rm -rf docs/*
	rm -rf vendor/*

doc:
	debian/apigendoc.sh

test:
	phpunit --bootstrap testing/bootstrap.php

deb:
	dch -b -i "`git log -n 1 | tail -n+5`"
	debuild -i -us -uc -b

.PHONY : install
	
