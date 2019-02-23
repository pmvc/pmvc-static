#!/bin/sh
echo "------ Sync with GIT. (All Changes will overwirte)";
sudo env PATH=$PATH git fetch origin
sudo env PATH=$PATH git reset --hard origin/master
echo "------ Start to install.";
composer install 
