chsum1=""

# run once and call clean to get a fresh start. this is important when switching between versions
./pushCodeToTestServer.sh clean

while [[ true ]]
do
    chsum2=`find ../app/ -type f -exec md5 {} \;`
    if [[ $chsum1 != $chsum2 ]] ; then
        echo "Pushing files to server"
        chsum1=$chsum2
        ./pushCodeToTestServer.sh false
        echo "Done pushing files to server"
        echo
    else
        echo "No changes detected"
    fi
    sleep 2
done