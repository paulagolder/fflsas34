#!/bin/bash

FILE="$(date '+%Y-%m-%d')ckeditupload.tar"

 

tar cf "$FILE" "app/AppKernel_ckeditor.php"
tar --append --file="$FILE"  "composer.json"
tar --append --file="$FILE"  "composer.lock"
tar --append --file="$FILE"  "vendor/autoload.php"
tar --append --file="$FILE"  "vendor/composer/autoload_psr4.php"
tar --append --file="$FILE"  "vendor/composer/autoload_real.php"
tar --append --file="$FILE"  "vendor/composer/autoload_static.php"
tar --append --file="$FILE"  "vendor/composer/installed.json"
tar --append --file="$FILE"  "web/bundles/fosckeditor"
tar --append --file="$FILE"  "vendor/friendsofsymfony"



gzip "$FILE"  
