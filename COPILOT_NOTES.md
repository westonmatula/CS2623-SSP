# COPILOT_NOTES.md — CS 2623 Week 1

## Accepted

- I accepted Copilot's suggestion to correct the stylesheet paths in `SSP02.php`. The main stylesheet is located in `SSP01/main.css`, and the table stylesheet is located in `SSP02/CSS/table.css`. Using `../SSP01/main.css` and `CSS/table.css` allows the browser to find the correct files based on the project structure.
- I accepted Copilot's suggestion to correct the malformed `<div>` tag. Proper HTML syntax is important because malformed tags can cause layout problems and make the page harder to maintain.

## Rejected

- I did not use a hardcoded heading such as `CS2623 SSP02: Weston Matula` in `include_header.php`. Instead, I kept the dynamic `$_SERVER["SERVER_NAME"]` approach required by the assignment. This allows the heading to display the server name automatically when the page runs on localhost or Apollo.

## Improved

- I improved the table styling by changing the even-row background color from `#E8E8E8` suggested by AI inline sugestion to the assignment's required `#E8EEF4`. I also limited the alternating-row selector to `#weekly-planner tbody tr:nth-child(even)` so the styling applies to the table body rather than the header.

