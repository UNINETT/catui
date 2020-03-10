
php_settings = -d error_reporting=E_ALL -d display_errors=On

dev: phpver phpjson phpcurl src/eduroam
	php --server [::]:7593 -d arg_separator.input=';&' -d arg_separator.output=';' -t www/

clean:
	rm -rf src/eduroam
	git submodule deinit --force --all

phpver:
	php $(php_settings) -r 'exit((int)(version_compare(PHP_VERSION, "7.0.0") < 0));'

phpjson:
	php $(php_settings) -r 'json_decode("{}");'

phpcurl:
	php $(php_settings) -r 'curl_init();'

src/eduroam: lib/git.sr.ht/eduroam/php-cat-client/src
	cp -a lib/git.sr.ht/eduroam/php-cat-client/src/eduroam src/

lib/git.sr.ht/eduroam/php-cat-client/src:
	git submodule init
	git submodule update

.PHONY: dev clean phpver phpjson phpcurl

