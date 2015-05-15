#!/bin/bash

d=`cat ../code/wp/wp-config.php | grep DB_NAME | awk '{print $3}'`
u=`cat ../code/wp/wp-config.php | grep DB_USER | awk '{print $3}'`
p=`cat ../code/wp/wp-config.php | grep DB_PASSWORD | awk '{print $3}'`
# we can pull production db and install it, then mass replace it

bash -c "mysqldump --user=$u --password=$p wordpressvanilla > ../db/wordpressvanilla.sql"
