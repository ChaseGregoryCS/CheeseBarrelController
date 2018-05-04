#!/bin/bash
#$logFileName=/srv/http/scripts/;
$wd = $PWD
cd "/srv/http/pScripts"
pwd
echo "[${USER}]['date'] - \n\n\t\t Cheese Log \n\n" > CheeseLog.txt;
if [ "$1" != "" ]; then
    if ["$1" == "s"]; then
        python /srv/http/pScripts/monitor.py >> Logs/CheeseLog.txt; 
    else
        python /srv/http/pScripts/shutdown.py;
    fi
else
    echo "ERROR"
fi
cd $wd
pwd
