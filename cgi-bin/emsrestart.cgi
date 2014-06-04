#!/bin/bash
echo "Content-type: text/html"
echo ""
echo "<html><body>"

$(killall ems)

$(sleep 1)

echo "<meta http-equiv='refresh' content='0;URL=php/download.php'>"

echo "</body></html>"