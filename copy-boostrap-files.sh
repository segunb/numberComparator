#!/bin/bash

if [ -d "css" ]; then rm -Rf css; fi
if [ -d "js" ]; then rm -Rf js; fi

if [ -d "vendor/twbs/bootstrap/dist/css" ]; then cp -Rf vendor/twbs/bootstrap/dist/css css; fi
if [ -d "vendor/twbs/bootstrap/dist/js" ]; then cp -Rf vendor/twbs/bootstrap/dist/js js; fi

exit 0