
php_settings = -d error_reporting=E_ALL -d display_errors=On

dev: phpcheck src/eduroam/cat lib/github.com/Uninett/uninett-bs-theme node_modules
	php --server [::]:7593 -d arg_separator.input=';&' -d arg_separator.output=';' -t www/
.PHONY: dev

clean:
	rm -rf src/eduroam/cat
	git submodule deinit --force --all
.PHONY: clean

phpcheck:
	php $(php_settings) -r 'exit((int)(version_compare(PHP_VERSION, "7.0.0") < 0));'
	php $(php_settings) -r 'json_decode("{}");'
	php $(php_settings) -r 'curl_init();'
.PHONY: phpcheck

src/eduroam/cat: lib/git.sr.ht/eduroam/php-cat-client/src
	cp -a lib/git.sr.ht/eduroam/php-cat-client/src/eduroam/cat src/eduroam/

lib/git.sr.ht/eduroam/php-cat-client/src: submodule
lib/github.com/Uninett/uninett-bs-theme: submodule
	cd lib/github.com/Uninett/uninett-bs-theme; make

submodule:
	git submodule update --init
.PHONY: submodule

node_modules:
	npm install
