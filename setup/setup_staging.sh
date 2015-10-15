#!/bin/bash

# make sure composer update already ran

WEB_ROOT=$( cd "$( dirname "${BASH_SOURCE[0]}" )" && pwd )/../code

cd $WEB_ROOT/wp
rm wp-config.php
ln -s ../../environmental/staging/wp-config-staging.php wp-config.php
cd ../
rm .htaccess
ln -s ../environmental/staging/.htaccess.staging .htaccess
cd ..
