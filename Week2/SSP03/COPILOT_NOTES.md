I checked Week2/SSP03/PHP/functions_ssp03.php and there were a few real problems:

missing PHP opening tag: <?php
a malformed docblock comment starting with //** instead of /**
a missing closing brace after fn_dayDetails()


Why is my top nav not showing on the webpage

✅ Root cause
The top nav markup existed in Include_topNav.php, but it was never actually loaded by index.php.

The page only included the header:

include_header.php
and never added the nav include. On Linux/macOS, file names are case-sensitive, so the exact name matters too.