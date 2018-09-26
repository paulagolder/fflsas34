#!/bin/bash

FILE="$(date '+%Y-%m-%d')exportlist.tar"
FILE2="$(date '+%Y-%m-%d')exportlist.tar.gz"
DIR="src" 

tar cf "$FILE" src

tar --append --file="$FILE"  "translations"
tar --append --file="$FILE"  "web/css"
tar --append --file="$FILE"  "web/common"
tar --append --file="$FILE"  "web/js"
tar --append --file="$FILE"  "app/config"
tar --append --file="$FILE"  "app/Resources"

gzip "$FILE"  


