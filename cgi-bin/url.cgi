#!/bin/bash
echo "Content-type: text/html"
cururl=`echo "$QUERY_STRING" | sed -n 's/^.*cururl=\([^&]*\).*$/\1/p' | sed "s/%20/ /g"`
newurl=`echo "$QUERY_STRING" | sed -n 's/^.*newurl=\([^&]*\).*$/\1/p' | sed "s/%20/ /g"`
echo ""
echo "<html><body>"

echo "<pre> $(mv /disk/home/httpd/$cururl.html /disk/home/httpd/$newurl.html) </pre>"

echo "$cururl $newurl"

echo "</body></html>"