#!/bin/bash

TERMINUS_S=$1
echo 'export PERCY_TOKEN=${PERCY_TOKEN}' >> $BASH_ENV
source $BASH_ENV

# Exit immediately on errors
set -ex

# Install Percy
npm install -D @percy/script

# Run the tests
npx percy exec -- node ./percy/percy.js https://$TERMINUS_ENV-$TERMINUS_S.pantheonsite.io/
