#!/bin/bash

FILE="$(date '+%Y-%m-%d')serverupload.tar"

DIR="src" 

tar cf "$FILE" src

tar --append --file="$FILE"  "translations"
tar --append --file="$FILE"  "web/bundles"
tar --append --file="$FILE"  "web/css"
tar --append --file="$FILE"  "web/js"
tar --append --file="$FILE"  "app/config/config.yml"
tar --append --file="$FILE"  "app/config/parameters_server.yml"
tar --append --file="$FILE"  "app/config/routing.yml"
tar --append --file="$FILE"  "app/config/security.yml"
tar --append --file="$FILE"  "app/config/services.yml"
tar --append --file="$FILE"  "app/Resources"
tar --append --file="$FILE"  "app/AppKernel_server.php"



gzip "$FILE"  
