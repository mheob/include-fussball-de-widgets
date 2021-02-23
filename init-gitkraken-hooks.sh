#!/bin/sh

DIR=$(dirname "$0")

cp -r ${DIR}/.husky/. ${DIR}/.git/hooks/
