#!/bin/bash

FILE="$(date '+%Y-%m-%d')deploy_2.tar"



tar cf "$FILE" web/common


tar --append --file="$FILE"  "web/newimages"
tar --append --file="$FILE"  "web/kml"
tar --append --file="$FILE"  "web/openicons"

gzip "$FILE"  
