<?php
	$dir_name='../jobdb1';
	$search_string=$dir_name."/*.jpb";
	//echo "Attempting to scan: $dir_name\n";
	$file_list=glob($search_string);


echo <<<TOTHEEND1
	<html>
	<head>
	<meta http-equiv="Content-Language" content="en-us">
	<meta http-equiv="Content-Type" content="text/html; charset=windows-1252">
	<title>Remove Listings from the Database</title>
	</head>

	<body>

	<form method="POST" action="remove_listings.php">
	<table border="1" width="100%" id="table1">
TOTHEEND1;

$files_exist_flag=0;
foreach( $file_list as $filename)
{
	preg_match("/(\d*)(\.jpb)/",$filename,$matches);
	if($matches)
	{
		$files_exist_flag=1;
		//print("<br>Found file: $matches[1]");
		$fname1=$filename;
		//print("<br>Opening file: $fname1");
		$contents_list = file($fname1);
		$num_items=count($contents_list);
		//print("<br>Number of items in this array: $num_items\n");
	
		foreach($contents_list as $one_line)
		{
			preg_match("/(~!POSITION!~)(.*)(~!POSITION!~)/", $one_line, $lmatch1);
			if($lmatch1)
			{
			$pos_var=$lmatch1[2];
			}
			preg_match("/(~!PAY!~)(.*)(~!PAY!~)/", $one_line, $lmatch1);
			if($lmatch1)
			{
			$pay_var=$lmatch1[2];
			}
			preg_match("/(~!DESCRIPTION!~)(.*)(~!DESCRIPTION!~)/", $one_line, $lmatch1);
			if($lmatch1)
			{
			$desc_var = $lmatch1[2];
			}
			preg_match("/(~!EXPERIENCE!~)(.*)(~!EXPERIENCE!~)/", $one_line, $lmatch1);
			if($lmatch1)
			{
			$exp_var = $lmatch1[2];
			}
			preg_match("/(~!DATE!~)(.*)(~!DATE!~)/", $one_line, $lmatch1);
			if($lmatch1)
			{
			$date_var = $lmatch1[2];
			}
		}
		preg_match("/(.*)(\/)(.*)(\.)(.*)/",$filename,$fname_matches);
		$filename = $fname_matches[3];
		$check_name = "check_$filename";
		echo <<<TOTHEEND2
		<tr>
			<td width="22"><input type="checkbox" name="$check_name" value="ON"></td>
			<td>
			<b>Job ID: </b> $filename<br>
			<b>Position: </b> $pos_var<br>
			<b>Date:</b> $date_var<br>
			<b>Description:</b> $desc_var<br>
			<b>Experience:</b> $exp_var<br>
			<b>Pay:</b> $pay_var</td>
		</tr>
TOTHEEND2;
	}
}
echo "</table>";
if(!($files_exist_flag))
{
	print("<br>Sorry, there are no files in the database available to delete!</b>\n");
	print("</form></body></html>\n");
}
else
{
echo <<<TOTHEEND3
	<p>Enter Password: <input type="password" name="pword" size="20" tabindex="9"></p>
	<p>&nbsp;</p>
	<p><input type="submit" value="Submit" name="B1"><input type="reset" value="Reset" name="B2"></p>
</form>

</body>

</html>
TOTHEEND3;
}
?> 