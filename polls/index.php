<!DOCTYPE html PUBLIC "-//W3C//DTD XHTML 1.0 Transitional//EN" "http://www.w3.org/TR/xhtml1/DTD/xhtml1-transitional.dtd">
<html xmlns="http://www.w3.org/1999/xhtml">
  <head>
    <!-- Tile of the page -->
    <title> Jasmin 15th Anniversary </title>
	
	<link rel="icon" type="image /ico" href="favicon.ico" />

	<link rel="stylesheet" type="text/css" href="../css/main.css" />
	<link rel="stylesheet" type="text/css" href="../css/salsa.css"  />
	<link rel="stylesheet" type="text/css" href="../css/offside.css" />
	<link rel="stylesheet" type="text/css" href="../css/handlee.css" />
	<link rel="stylesheet" type="text/css" href="../css/philosopher.css" />
	<link rel="stylesheet" type="text/css" href="../css/jquery.mCustomScrollbar.css" />
	
	<script type="text/javascript" src="../scripts/jquerymin.js"></script>
	<script type="text/javascript" src="../scripts/scripts.js"></script>
	<script type="text/javascript" src="../scripts/showImage.js"></script>
	
  </head>
   
  <?php 
 
	$useEcho  = 0;
	$mysqlerr = 0;
	$resultsView = 0;

	if(isset($_SERVER["REMOTE_ADDR"])) { 
	$ipAddress = $_SERVER["REMOTE_ADDR"];
	} else if(isset($_SERVER["HTTP_X_FORWARDED_FOR"])) { 
	$ipAddress = $_SERVER["HTTP_X_FORWARDED_FOR"];
	} else if(isset($_SERVER["HTTP_CLIENT_IP"])) { 
	$ipAddress = $_SERVER["HTTP_CLIENT_IP"]; 
	}
	
	$userIPs = explode(',', $ipAddress);
	
	$ipParsed = "127.0.0.1";

	if(preg_match('/^(?:25[0-5]|2[0-4]\d|1\d\d|[1-9]\d|\d)(?:[.](?:25[0-5]|2[0-4]\d|1\d\d|[1-9]\d|\d)){3}$/', $userIPs[0]))
	{
		$ipParsed = $userIPs[0];
	}
	
	if(($ipParsed == "127.0.0.1") || ($ipParsed == "172.16.6.60") || ($ipParsed == "172.16.6.87") || ($ipParsed == "172.16.6.115") || ($ipParsed == "172.16.6.69"))
	{
		$resultsView = 1;
	}
	
	$con = mysql_connect("localhost","guest","pass");
	
	if(mysql_errno() != 0)
	{
	  if($useEcho == 1) echo "No Connection con = " . $con . '__error = ' . mysql_error() . '<br />';
	  $mysqlerr = 1;
	}
	else
	{
	  mysql_select_db("jas15anniv", $con);

	  if(mysql_errno() != 0)
	  {
		if($useEcho == 1) echo "Could not select Table con = " . $con . '__error = ' . mysql_error() . '<br />';
		$mysqlerr = 2;
	  }
	}
	
	function countVotes($evtId, $authorName)
	{
		global $useEcho;
		$total = 0;
		
		$query = 'SELECT COUNT(*) as total FROM POLLSINFO WHERE EVTID=' . $evtId . ' AND AUTHNAME="' . $authorName . '";';

        $result = mysql_query($query);
		$data   = mysql_fetch_assoc($result);

        if(mysql_errno() != 0)
        {
          if($useEcho == 1) echo "result for query = " . $result . '__error = ' . mysql_error() . '<br />';
          $mysqlerr = 3;
        }
        else
        {
			$total = $data['total'];
		}
		
		return $total;
	}	
	
	function IsVotePresent($evtId)
	{
		global $ipParsed;
		global $useEcho;
		$present = false;
		
		$query = 'SELECT AUTHNAME FROM POLLSINFO WHERE EVTID=' . $evtId . ' AND IPADDR="' . $ipParsed . '";';

        $result = mysql_query($query);

        if(mysql_errno() != 0)
        {
          if($useEcho == 1) echo "result for query = " . $result . '__error = ' . mysql_error() . '<br />';
          $mysqlerr = 3;
        }
        else
        {
			if($row = mysql_fetch_array($result))
			{
				$present = true;
			}
		}
		
		return $present;
	}	
	
	function pollAddImage($evtId, $thumbPath, $path, $imgName, $authorName, $description)
	{
		echo '<div class="pollImgDiv">';
		  echo '<div class="pollInnerDiv">';
			if($authorName != "")
			{
				echo '<div class="pollImgName">' . $imgName . '<span class="pollResults"> (' . countVotes($evtId, $authorName) . ')</span></div><div class="lineSepSmall"></div>';
				echo '<div class="pollAuthName"> <span class="font-size:72%;">  - by  </span>' . $authorName . '</div><br />';
				echo '<div class="pollDesc"> ' . $description . '</div><br />';
				
				if(IsVotePresent($evtId) == false)
				{
					echo '<button class="poll'. $evtId .'Evt" type="submit" onclick="voteFor('. $evtId . ", '" . $imgName . "', '" . $authorName . "', " . "'voted" . $evtId . "Div', 'poll" . $evtId . "Evt'" . ')"> Vote for this entry </button>';
					echo '<div class="voted'. $evtId .'Div"> You have already voted for this event! Thanks for that..... </div>';
				}
				else
				{
					echo '<button style="display:none;" class="poll'. $evtId .'Evt" type="submit" onclick="voteFor('. $evtId . ", '" . $imgName . "', '" . $authorName . "', " . "'voted" . $evtId . "Div', 'poll" . $evtId . "Evt'" . ')"> Vote for this entry </button>';
					echo '<div style="display:block;" class="voted'. $evtId .'Div"> You have already voted for this event! Thanks for that..... </div>';
				}
			}
			echo '</div>';
			echo '<img src="' . $thumbPath .'" onclick="ShowImage(' . "'" . $path . "', '" . $imgName . ' by ' . $authorName . "'" . ')" class="pollImg" />';
		echo '</div>';
	}
?>
   
   <body onload="pollLoadEvents()" style="margin:3%;padding:1%;">
   
     <div class="stageBG"  Id="StageBG">   </div>
     <div class="stageImg" Id="StageImg" align="center">  </div>
	 
	 <div class="mainHeading"> JASMIN Infotech 15th Year Anniversary Celebrations </div><div class="lineSepLong"></div>
	 
	 
	 <!-- Polls start from here -->
	 
	 <!-- Poll for Event 1 - Big Shot -->
     <div class="pollDiv">
		<div class="pollName"> Big Shot <br /><br /><div class="lineSepLong"></div></div>
		<?php pollAddImage(0, "bigshot/thumbs/DSC00442.JPG", "bigshot/DSC00442.JPG", "The Big Bird", "RajKumar", "Picture of a big bird captured nicely"); ?>
		<?php pollAddImage(0, "bigshot/thumbs/DSC00025.JPG", "bigshot/DSC00025.JPG", "The Big Flower", "Vinay", "Good flower"); ?>
		<?php pollAddImage(0, "bigshot/thumbs/DSC00897.jpg", "bigshot/DSC00897.jpg", "Lake", "Arun", "Picture perfect lake"); ?>
		<?php pollAddImage(0, "../images/pbg.png", "../images/pbg.png", "", "", ""); ?>
	</div>
	
	<!-- Poll for Event 2 - Poster Drawing -->
	<div class="pollDiv">	
		<div class="pollName"> Poster Drawing <br /><br /><div class="lineSepLong"></div></div>
		<?php pollAddImage(1, "bigshot/thumbs/DSC00442.JPG", "bigshot/DSC00442.JPG", "Big poster", "painter", "big poster pained by me!"); ?>
		<?php pollAddImage(1, "../images/pbg.png", "../images/pbg.png", "", "", ""); ?>
	</div>		
   
   </body>
 </html>