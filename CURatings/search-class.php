<?php
    mysql_connect("TADAH.db.10571676.hostedresource.com", "TADAH", "Passw0rd!") or die("Error connecting to database: ".mysql_error());
	mysql_select_db("TADAH") or die(mysql_error());
?>
<!DOCTYPE html>
<html><head>
<title>University of Colorado - FCQ Search</title>
<meta charset="UTF-8">
<meta name="viewport" content="width=device-width, initial-scale=1.0"/>
<meta name="description" content="" />
<script type="text/javascript" src="https://ajax.googleapis.com/ajax/libs/jquery/1.6.4/jquery.min.js"></script>
<!--[if lt IE 9]><script src="http://html5shiv.googlecode.com/svn/trunk/html5.js"></script><![endif]-->
<script type="text/javascript" src="js/prettify.js"></script>                                   <!-- PRETTIFY -->
<script type="text/javascript" src="js/kickstart.js"></script>                                  <!-- KICKSTART -->
<link rel="stylesheet" type="text/css" href="css/kickstart.css" media="all" />                  <!-- KICKSTART -->
<link rel="stylesheet" type="text/css" href="style.css" media="all" />                          <!-- CUSTOM STYLES -->
</head><body>
<div class="grid">

<div class="col_6" >

<?php
    $query=$_POST['query'];
    $query = mysql_real_escape_string($query); //prevent SQL injection
    $raw_results = mysql_query("SELECT * FROM `course_all` WHERE `subjects` LIKE '%".$query."%'") or die(mysql_error());
    ?>
    <ul class="search-list">
    <?php
        			if(mysql_num_rows($raw_results) > 0) 
				{
				while($results = mysql_fetch_array($raw_results)) 
					{
						$class = $results['Crse'];
                        $subject = $results['subjects'];
                        
					echo '<li class="subjects">';
						echo "<a href=\"details-class.php?query2=".$subject."&query=".$class."\">";
                        
                            echo '<h4>'.$results['subjects'].'</h4>';
                            echo '<h4>'.$results['Crse'].'</h4>';
						echo '</a>';
					echo '</li>';
					}
				}
				else{ echo "No results"; }  
			?>	
    </ul>

</table>
</div>

<!--echo "<a href=\"details.php?query=".$teach."\">".$teach."</a>";-->
    </div>
</div>

</body></html>