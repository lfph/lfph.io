#!/bin/bash

TERMINUS_S=$1
echo 'export PERCY_TOKEN=${PERCY_TOKEN}' >> $BASH_ENV
source $BASH_ENV

if [[ (${CIRCLE_BRANCH} != "master") || (${CIRCLE_BRANCH} == "master" && -n ${CIRCLE_PULL_REQUEST+x}) ]];
then
    echo -e "CircleCI will only run tests on Pantheon if on the master branch.\n"
    exit 0;
fi

# Exit immediately on errors
set -ex

# Run the tests
npx percy exec -- node ./percy/percy.js
