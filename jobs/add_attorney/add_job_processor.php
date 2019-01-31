<?php
	include("../pwlfile/plist.plf");
	$mainpath = "../jobdb1/";
	$index_filename = "job_index.txtphp";
	$f_extension = ".jpb";
	$cr = "\n";
	$password_var = "";
	foreach ($_POST as $field => $value)
	{
		if($field == "position")
		{
			$position_var = $value;
		}
		if($field == "pay")
		{
			$pay_var = $value;
		}
		if($field == "desc")
		{
			$desc_var = $value;
		}
		if($field == "exp")
		{
			$exp_var = $value;
		}
		if($field == "month")
		{
			$month_var = $value;
		}
		if($field == "day")
		{
			$day_var = $value;
		}
		if($field == "year")
		{
			$year_var = $value;
		}
		if($field == "pword")
		{
			$password_var = $value;
		}
	}
if($password_var == $stored_password)
{
if(($position_var))
{
$months[1]="January";
$months[2]="February";
$months[3]="March";
$months[4]="April";
$months[5]="May";
$months[6]="June";
$months[7]="July";
$months[8]="August";
$months[9]="September";
$months[10]="October";
$months[11]="November";
$months[12]="December";

	if(((int)$month_var <=12) && ((int)$month_var >=1))
	{
		$month_var = $months[(int)$month_var];
	}
	else
	{
		$month_var = "MONTH FIELD ERROR!";
	}

	$date_var = $month_var." ".$day_var.", ".$year_var;

	$ind_file_path_name = $mainpath.$index_filename;
	$ind_file = file($ind_file_path_name);
	$ind_file[0] = (int)$ind_file[0]+1;
	$new_filename = $mainpath . $ind_file[0] . $f_extension;
	//echo "$new_filename";

	if(file_exists($new_filename))
	{
		echo "ERROR - New file exists with same name - something is really goofed up!";
		die;
	}
	else
	{
		if(!($filehandle = fopen($new_filename, "w")))
		{
			echo "Cannot open file for writing";
			echo "$mainpath$new_filename";
			die;
		}
	
		else
		{
			fwrite($filehandle, stripslashes("~!POSITION!~".$position_var."~!POSITION!~" . $cr));
			fwrite($filehandle, stripslashes("~!PAY!~" . $pay_var . "~!PAY!~" . $cr));
			fwrite($filehandle, stripslashes("~!DESCRIPTION!~" . $desc_var . "~!DESCRIPTION!~" . $cr));
			fwrite($filehandle, stripslashes("~!EXPERIENCE!~" . $exp_var . "~!EXPERIENCE!~" . $cr));
			fwrite($filehandle, stripslashes("~!DATE!~" . $date_var . "~!DATE!~"));
			fclose($filehandle);
		}

	}
	$filehandle = fopen($ind_file_path_name, "w");
	fwrite($filehandle, $ind_file[0]);
	fclose($filehandle);
}
else
{
	echo "<br>Warning - A position title was not entered.  This data is required.\n";
	die;
}
}
else
{
	echo "<br>Password not entered or password is incorrect.  Please try again.";
	die;
}
echo <<<TOTHEEND5
<html>

<head>
<meta http-equiv="Content-Language" content="en-us">
<meta http-equiv="Content-Type" content="text/html; charset=windows-1252">
<title>Job Successfully Entered</title>
</head>

<body>

<p><b><font face="Verdana" size="4">Job Successfully <u><font color="#00CC00">
Added</font></u></font></b></p>
<p><font face="Verdana">Job Number: $ind_file[0]</font></p>
<p>&nbsp;</p>
<p align="center"><font face="Verdana" size="2">You will be returned to the form 
to <b><font color="#00CC00">add</font></b> another job in a moment...<br>
If the page doesn't load, click
<a href="http://www.sonjacottonlaw.com/job_admin_a/add.html">here</a>.</font></p>
<meta HTTP-EQUIV="REFRESH" content="3; url=http://www.sonjacottonlaw.com/jobs/add_attorney/add.html">

</body>

</html>
TOTHEEND5;

?>