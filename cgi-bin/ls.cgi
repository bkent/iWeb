#!/bin/bash
echo "Content-type: text/html"
echo ""
echo "<html><body>"

echo "<strong>Welcome to the I-Net ACU Diagnostics page</strong><br /><br />"

echo "<pre> $(ps) </pre>"

echo "<br /><br /> In the list above you should see 2 lines that look similar to the one below (although the numbers will be different):<br /><pre>&nbsp;&nbsp;757&nbsp;root&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;1732 S&nbsp;&nbsp;&nbsp;/disk/bin/ems</pre>"

echo "If you cannot see these lines, go back to the settings page, do a download, and then check back here.<br />If they still do not appear, go back to the settings page and press the <b>Set</b> button to set the date without filling in any values.<br />This will reboot the I-Net ACU.<br />If problems persist, contact technical support."

echo "</body></html>"