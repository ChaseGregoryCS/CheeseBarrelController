#!/bin/bash

if [ "$1" != "" ]; then
    if ["$1" == "s"]; then
        python monitor.py
    else
        python shutdown.py
    fi
else
    echo "ERROR"
fi
