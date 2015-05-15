This is a wordpress skeleton vm for rapid development. It is structured so that wordpress and its plugins can be installed via composer. Ready for other wordpress projects to fork.

## PRE-REQUISITE

* Up to date LAMP stack.

* Install vagrant and virtualbox

* Database setup:

Create a db called yourprojectname (a project name that you like) with

```
username: yourprojectname
password: yourprojectname
```

## INSTALLATION

* Clone this repo as it is if you want to test this out. 

```
git clone git@github.com/bernardpeh/wordpressvanilla yourproject
cd yourproject
composer update
```

If you are working on your own project, quickest way is to fork this repo and clone it instead.

## Setting up Project

* Mass renaming files

```
cd yourproject
find . -type f ! -path './.git/*' | while read s; do sed -i 's/wordpressvanilla/yourprojectname/g' $s; done
git mv db/wordpressvanilla.sql db/yourprojectname.sql
```

* In line 11 of puphpet/config.yaml, update ip to something different so that it doesn't clash with your current vm. Update other config as necessary.

## Installation using Vagrant

```
vagrant up
```

This will configure your new vm. Will take some time...

Once done, configure wp-config.php

```
cd code/wp
ln -s ../../environment/wp-config-local.php wp-config.php
```

## Installation in existing VM

If you already have an existing vm, 

* Configure your own code/environment/wp-config-custom.php

* softlink code/wp/wp-config-custom.php to code/wp/wp-config.php

```
cd code/wp
ln -s ../../environment/wp-config-custom.php wp-config.php
```

* Import db from db/yourproject.sql

* Setup web server with document root as yourfolder/code

## Testing

* test by visiting yourproject.local

* login to wordpress admin http://yourprojectname.local/wp-admin with username: wvadmin, passwd: wvadmin
