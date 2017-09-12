#!/bin/sh

echo "------";
echo "------ !! Important !! All changes will overwrite !!"
echo "------";

echo "------ Sync with GIT.";
sudo env PATH=$PATH git fetch origin
sudo env PATH=$PATH git reset --hard origin/master
echo "------ Start to install.";
composer install 
phpunit > /dev/null
rc=$?
if [[ $rc != 0 ]] ; then
    # A non-zero return code means an error occurred, so tell the user and exit
    echo "phpunit failed - restart deniend. Run tests locally and confirm they pass before pushing"
    exit $rc
fi

