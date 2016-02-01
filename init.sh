#!/bin/sh

PARENT_DIR=$(dirname $(cd "$(dirname "$0")"; pwd))

initialize_composer () {
  if [ ! -f "composer.phar" ]; then
    echo "Could not find composer.phar, downloading it now..."
    curl -s http://getcomposer.org/installer | php
  fi
  /usr/bin/env php composer.phar install
}

initialize_composer