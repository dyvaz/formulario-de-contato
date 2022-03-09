#!/bin/bash

set -ex

cd "$(dirname "$(dirname "$(realpath "$0")")")"

php -S 127.0.0.1:3000