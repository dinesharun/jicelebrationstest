<?php
	$useEcho  = 1;
	$mysqlerr = 0;
	
	                     /* 0, 1, 2, 3, 4, 5, 6, 7, 8, 9, 0, 1, 2, 3, 4, 5, 6, 7, 8, 9, 0, 1, 2, 3, 4, 5, 6, 7, 8, 9, 0, 1, 2, 3, 4, 5) */  
	$evtMemberCount = array(1, 1, 2, 1, 1, 1, 2, 1, 1, 1, 1, 2, 1, 2 ,1, 1, 1, 1, 1, 1, 2, 1, 1, 2, 1, 1 ,1, 3, 1, 1, 1, 2, 1, 2, 1, 8);  
    $stopRegForEvt  = array(0, 0, 1, 0, 0, 1, 0, 0, 0, 0, 1, 1, 0, 0, 1, 0, 0, 1, 0, 0, 1, 1, 0, 0, 0, 0, 0, 0, 0, 0, 0, 0, 1, 0, 1, 1);    
    
					   /*      0              1            2             3             4     */
	$evtSchDates = array('31.07.2013', '29.07.2013', '26.07.2013', '30.07.2013', '31.07.2013', // 0
						 '23.07.2013', '01.08.2013', '07.08.2013', '31.07.2013', '13.08.2013', // 1 
						 '25.07.2013', '22.07.2013', '31.07.2013', '13.08.2013', '23.07.2013', // 2 
						 '05.08.2013', '06.08.2013', '22.07.2013', '12.08.2013', '01.08.2013', // 3
						 '19.07.2013', '25.07.2013', '08.08.2013', '02.08.2013', '29.07.2013', // 4
						 '07.08.2013', '08.08.2013', '06.08.2013', '06.08.2013', '09.08.2013', // 5
						 '31.07.2013', '09.08.2013', '19.07.2013', '29.07.2013', '25.07.2013', // 6
						 '29.07.2013',
						 
						 '01.08.2013', '30.07.2013', '29.07.2013', '31.07.2013', '01.08.2013', // 0
						 '24.07.2013', '02.08.2013', '08.08.2013', '01.08.2013', '14.08.2013', // 1 
						 '26.07.2013', '23.07.2013', '01.08.2013', '14.08.2013', '24.07.2013', // 2 
						 '06.08.2013', '07.08.2013', '23.07.2013', '13.08.2013', '02.08.2013', // 3
						 '22.07.2013', '26.07.2013', '09.08.2013', '05.08.2013', '30.07.2013', // 4
						 '08.08.2013', '09.08.2013', '07.08.2013', '07.08.2013', '12.08.2013', // 5
						 '03.08.2013', '12.08.2013', '22.07.2013', '31.07.2013', '29.07.2013', // 6
						 '30.07.2013');                                                        // 7
							
						/*	0          1          2           3         4          5          6          7          8         9       */ 
	$evtSchTimes = array('4:00 PM', '6:00 PM', '6:00 PM', '6:00 PM', '6:00 PM', '6:00 PM', '6:00 PM', '6:00 PM', '6:00 PM', '6:00 PM', // 0
						 '6:00 PM', '6:00 PM', '6:00 PM', '6:00 PM', '6:00 PM', '6:00 PM', '6:00 PM', '6:00 PM', '6:00 PM', '6:00 PM', // 1
						 '6:00 PM', '6:00 PM', '6:00 PM', '6:00 PM', '6:00 PM', '6:00 PM', '6:00 PM', '6:00 PM', '6:00 PM', '6:00 PM', // 2
						 '6:00 PM', '6:00 PM', '6:00 PM', '6:00 PM', '6:00 PM', '6:00 PM',                                             // 3
						 
						 '5:00 PM', '5:00 PM', '4:00 PM', '4:00 PM', '5:00 PM', '4:00 PM', '4:00 PM', '4:00 PM', '4:00 PM', '4:00 PM', // 0
						 '4:00 PM', '4:00 PM', '5:00 PM', '5:00 PM', '5:00 PM', '4:00 PM', '5:00 PM', '5:00 PM', '4:00 PM', '5:00 PM', // 1
						 '4:00 PM', '4:00 PM', '4:00 PM', '4:00 PM', '4:00 PM', '5:00 PM', '5:00 PM', '4:00 PM', '4:30 PM', '4:00 PM', // 2
						 '7:00 AM', '5:00 PM', '5:00 PM', '3:00 PM', '4:00 PM', '4:00 PM');		                                       // 3
						 
				   /*   0                         1                     2                           3                            4           */
	$events = array("Big Shot",             "Aim the Game",         "Collage",              "Soap Architect",           "Poster Desinging",     // 0
	                "Singing",              "Dumb Charades",        "Blind Game",           "Jasmin's Lucky Charm",     "Sense of Balance",     // 1
					"Maze'3'",              "Word Hint",            "Plate and Bangles",    "Detective",        		"Delayed Response",     // 2
					"Slow Rider",           "Debate",               "Air Warrior",          "Pocket the Ball",          "Ring to Bottle",       // 3
					"Nanban",               "Just A Minute",        "Top Manager",          "Find the Partner",         "Poster Drawing",       // 4
					"HaHa HuHu HaeHae",     "Assembler",            "Six Legged Race",      "Drink Enough",             "Picture Puzzle",       // 5
					"Cricket",              "Carom",                "Chess",                "Shuttle",                  "Jasmin Bailvan",       // 6
					"Throwball (Ladies)");  																									// 7						 
					
	$extraDates = array();
	
	$extraDates[30] = "03.08.2013, 10.08.2013";
	$extraDates[31] = "13.08.2013, 14.08.2013";
	$extraDates[32] = "23.07.2013, 24.07.2013, 25.07.2013, 26.07.2013";
	$extraDates[33] = "06.08.2013, 07.08.2013, 08.08.2013, 09.08.2013";
	$extraDates[34] = "";	
	$extraDates[35] = "";		
	
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
	  else
	  {

		$Query = 'SELECT NAME, EVTID, GROUPNAME from eventinfo WHERE IPADDR="' . $ipParsed . '" ORDER BY EVTID ASC;';

		$result = mysql_query($Query);

		if(mysql_errno() != 0)
		{
			if($useEcho == 1) echo "result for query = " . $result . '__error = ' . mysql_error() . '<br />';
			$mysqlerr = 3;
		}
		else
		{		
			$i = 1;
			
			while($row = mysql_fetch_array($result))
			{
				if($i == 1)
				{
					echo '<h2> User Info Panel  </h2>';
					echo '<h3 style="text-align:center;font-size:87%;">(Events registered for ' . $row['NAME'] . ')</h3>';
			
					echo '<table style="width:87%;margin:6%;margin-top:1%;margin-bottom:1%;border:1px solid black;">' . "\r\n";
					echo '<tr style="width:99%;background-color:#999999;border:1px solid black;">' . "\r\n";
					echo '<td style="border:1px solid black;"> Sl.No. </td> <td style="border:1px solid black;"> Event </td> <td style="border:1px solid black;"> GroupName </td> <td style="border:1px solid black;"> Registration/Submission Deadline </td> <td style="border:1px solid black;"> Event/Polling Time </td>' . "\r\n";
					echo '</tr>' . "\r\n";			
				}
				echo '<tr style="width:99%;">' . "\r\n";
				echo '<td style="border:1px solid black;"> ' . $i . ' </td>';
				echo '<td style="border:1px solid black;"> ' . $events[$row['EVTID']] . ' </td>';
				echo '<td style="border:1px solid black;"> ' . $row['GROUPNAME'] . ' </td>';
				echo '<td style="border:1px solid black;"> ' . $evtSchDates[$row['EVTID']] . ' @ ' . $evtSchTimes[$row['EVTID']] . ' </td>';
				echo '<td style="border:1px solid black;"> ' . $evtSchDates[$row['EVTID']+count($events)] . ' @ ' . $evtSchTimes[$row['EVTID']+count($events)] . ' </td>';
				echo '</tr>' . "\r\n";
				$i++;
			}
			
			if($i == 1)
			{
				echo '<h2> User Info Panel  </h2>';
				echo '<h3 style="text-align:center;font-size:87%;">(Events registered for ' . $row['NAME'] . ')</h3>';
		
				echo '<table style="width:87%;margin:6%;margin-top:1%;margin-bottom:1%;border:1px solid black;">' . "\r\n";
				echo '<tr style="width:99%;background-color:#999999;border:1px solid black;">' . "\r\n";
				echo '<td style="border:1px solid black;"> Sl.No. </td> <td style="border:1px solid black;"> Event </td> <td style="border:1px solid black;"> GroupName </td> <td style="border:1px solid black;"> Registration/Submission Deadline </td> <td style="border:1px solid black;"> Event/Polling Time </td>' . "\r\n";
				echo '</tr>' . "\r\n";	
				echo '<tr style="width:99%;border:1px solid black;">' . "\r\n";
				echo '<td style="border:1px solid black;text-align:center;" colspan="5"> No events yet :( </td>' . "\r\n";
				echo '</tr>' . "\r\n";	
			}
			
			echo '</table>';
		}
	  }
	}
	
?>