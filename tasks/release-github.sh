#!/bin/bash

mkdir -p .github-releases/include-fussball-de-widgets
cp -r ./app/dist/* .github-releases/include-fussball-de-widgets
cd .github-releases
7z a -r include-fussball-de-widgets-v2.2.3-b5.zip include-fussball-de-widgets
rm -rf include-fussball-de-widgets
cd ..
