#!/bin/bash

killall node
nohup node /home/ctf/web/main.js > /dev/null 2>&1 &
