#!/bin/sh
echo 'Requires PHP 7 with json and curl extensions.'
php_settings="-d error_reporting=E_ALL -d display_errors=On"
php $php_settings -r 'exit((int)(version_compare(PHP_VERSION, "7.0.0") < 0));' || exit 1
php $php_settings -r 'json_encode("{foo: \"bar\"}") !== ["foo" => "bar"];' || exit 1
php $php_settings -r 'curl_init();' || exit 1
php --server [::]:7593 -d arg_separator.input=';&' -d arg_separator.output=';' -t "$(dirname "$0")/www/"
