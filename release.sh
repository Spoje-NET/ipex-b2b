#!/bin/bash
docker build -t vitexus/ipexb2b .
docker push vitexus/ipexb2b
cd debian
./deb-package.sh
