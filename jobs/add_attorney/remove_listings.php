<?php
include("../pwlfile/plist.plf");
$authenticated=0;
$mainpath="../jobdb1/";
$err_flag=0;

foreach($_POST as $fieldname => $value)
{
	if($fieldname=="pword")
	{
		if($stored_password == $value)
		{
			$authenticated=1;
		}
	}
}
if($authenticated)
{
echo <<<TOTHEEND7
<html>

<head>
<meta http-equiv="Content-Language" content="en-us">
<meta http-equiv="Content-Type" content="text/html; charset=windows-1252">
<title>Job Successfully Removed</title>
</head>

<body>

<p><b><font face="Verdana" size="4">Job(s) Successfully <u><font color="#FF0000">
Removed</font></u></font></b></p>
<p><font face="Verdana">
TOTHEEND7;
	foreach($_POST as $fieldname => $value)
	{
		if($value)
		{
			preg_match("/(check_)(.*)/",$fieldname,$checkmatch);
			if($checkmatch)
			{
				//print("<br>You selected $mainpath$checkmatch[2].jpb for deletion\n");
				$delete_this_file=$mainpath . $checkmatch[2] . ".jpb";
				if(!(file_exists($delete_this_file)))
				{
					$err_flag=1;
					print("<br>Error deleting file $delete_this_file.  The file does not appear to exist.\n");
				}
				elseif( unlink($delete_this_file))
				{
					echo "Job Number: $checkmatch[2]<br>\n";
				}
				else
				{
					$err_flag=1;
					print("<br>Error deleting file $delete_this_file.\n");
				}
			}
		}
	}
}
else
{
	echo "Password not entered or password incorrect.  Please try again.\n";
	die;
}
echo <<<TOTHEEND6
</font></p>
<p>&nbsp;</p>
<p align="center"><font face="Verdana" size="2">You will be returned to the job
<b><font color="#FF0000">removal</font></b> form in a moment...<br>
If the page doesn't load, click
<a href="http://www.sonjacottonlaw.com/jobs/add_attorney/remove.php">here</a>.</font></p>
TOTHEEND6;
if($err_flag)
{
	echo "<br><br>ERROR - Please examine the information above for details - this page will NOT reload automatically.\n";
}
else
{
	echo "<meta HTTP-EQUIV=\"REFRESH\" content=\"7; url=http://www.sonjacottonlaw.com/jobs/add_attorney/remove.php\">\n";
}
echo "</body>\n</html>\n";

?>