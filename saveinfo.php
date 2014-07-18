<?php
  $useEcho  = 1;
  $mysqlerr = 0;
  
  $respText = '<br /><br /><br />User Info Save Failed  <br /><br /> <span style="font-size:81%"> (Auto Close in 1s) </span> <br /> <br /><br />';
  
  if((isset($_POST['name']) == true) && (isset($_POST['email']) == true) && (isset($_POST['uname']) == true) && (isset($_POST['ipaddr']) == true))
  {
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
        $Query  = 'INSERT INTO userinfo (uname, name, ipaddr, email) ';
        $Query .= 'VALUES (';
        $Query .= "'" . $_POST['uname']. "', ";
        $Query .= "'" . $_POST['name']. "', ";
        $Query .= "'" . $_POST['ipaddr']. "', ";
        $Query .= "'" . $_POST['email']. "'); ";

        $result = mysql_query($Query);

        if(mysql_errno() != 0)
        {
          if($useEcho == 1) echo "result for query = " . $result . '__error = ' . mysql_error() . '<br />';
          $mysqlerr = 3;
        }
        else
        {
			$respText = '<br /><br /><br /> User Info Saved Successfully <br /><br /> <span style="font-size:81%"> (Auto Close in 1s) </span> <br /> <br /><br />';
		}
	  }
	}
  }
  else
  {
	$mysqlerr = 4;
  }
  
  //if($useEcho == 1)  echo $mysqlerr; 
  
  echo $respText;
?>