ER-SourceForge-Stats
====================

ER SourceForge Stats allows you to insert SourceForge download statistics into your page using a simple shortcode.

### Installation

Clone this script from github or copy the files manually to your prefered directory.

### ER SourceForge Stats short-code usage

You can use the short-code in a page, post or text widget.
You can use the short-code as many times as you want on the same page and check multiple files, folder and projects.
Short-code examples:

 - [sf project="projectname"]
 - [sf project="projectname" start_date="2012-11-23"]
 - [sf project="projectname" start_date="2012-11-23" end_date="2013-03-25"]
 - [sf project="projectname" start_date="2012-11-23" end_date="2013-03-25" file="file.tar.gz"]

Parameters List

 - project = Project Name.
 - start_date = Start date of statistics – YEAR-MONTH-DAY (1999-01-01 by default). You can use date(‘Y-m-d’) for current day.
 - end_date = End date of statistics – YEAR-MONTH-DAY (Current Day by default).
 - file = File to Monitor (Entire project by default).


by [RaveMaker][RaveMaker] & [ET][ET].
[RaveMaker]: http://ravemaker.net
[ET]: http://etcs.me
