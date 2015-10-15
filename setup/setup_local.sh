#!/bin/bash

# make sure db is created and accessible by user with rights to create and drop db, environmental/local/wp-config-local.php configured and 
# composer update already ran

# this script resets your dev environment based on the db dump

WEB_ROOT=$( cd "$( dirname "${BASH_SOURCE[0]}" )" && pwd )/../code
DB_USER=wordpressvanilla
DB_PASS=wordpressvanilla

cd $WEB_ROOT/wp
rm wp-config.php
ln -s ../../environmental/local/wp-config-local.php wp-config.php
cd ../../setup

d=`cat ../code/wp/wp-config.php | grep DB_NAME | awk '{print $3}'`
u=`cat ../code/wp/wp-config.php | grep DB_USER | awk '{print $3}'`
p=`cat ../code/wp/wp-config.php | grep DB_PASSWORD | awk '{print $3}'`

# update db
bash -c "mysql --user=$DB_USER --password=$DB_PASS -e \"drop database wordpressvanilla;create database wordpressvanilla character set utf8 collate utf8_general_ci;\""

bash -c "mysql --user=$DB_USER --password=$DB_PASS $d < ../db/wordpressvanilla.sql"

# optional - replace live and staging domain. This doesnt fix serialised strings. 
# To fix serialisation, a good option is to use a script like https://github.com/Blogestudio/Fix-Serialization

# bash -c "php mysql_replace.php -u $u -p $p -d $d -r wordpressvanilla.local -s wordpressvanilla.staging.yoursite.com"
# bash -c "php mysql_replace.php -u $u -p $p -d $d -r wordpressvanilla.local -s wordpressvanilla.live.yoursite.com"

