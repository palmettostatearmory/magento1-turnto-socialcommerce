chsum1=""

while [[ true ]]
do
    chsum2=`find app/ -type f -exec md5 {} \;`
    if [[ $chsum1 != $chsum2 ]] ; then
        echo "Pushing files to server"
        chsum1=$chsum2
        ./pushCodeToTestServer.sh
        echo "Done pushing files to server"
        echo
    else
        echo "No changes detected"
    fi
    sleep 2
done