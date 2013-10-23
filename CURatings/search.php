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
	$query = $_POST['query']; 	//query is the search value
	$min_length = 3;

	if (strlen($query) >= $min_length) {
		
		$query = str_replace(' ', ', ', $query); //if there's a space, replace it with "comma space"
		$query = htmlspecialchars($query); //change html characters to string
		$query = mysql_real_escape_string($query); //prevent SQL injection
		$raw_results = mysql_query("SELECT * FROM `fcq_total` WHERE `Instructor` LIKE '%".$query."%'") or die(mysql_error());
	}
	else { echo "Minimum search length is ".$min_length; } 

		?>
		<ul class="search-list">
			<?php
				if(mysql_num_rows($raw_results) > 0) 
				{
				while($results = mysql_fetch_array($raw_results)) 
					{
						$teach = $results['Instructor'];
					echo '<li class="teacher">';
						echo "<a href=\"details.php?query=".$teach."\">";
							echo '<h4>'.$results['Instructor'].'</h4>';
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

<script type="text/javascript">
 
  var _gaq = _gaq || [];
  _gaq.push(['_setAccount', 'UA-45093432-1']);
  _gaq.push(['_setDomainName', 'curatings.info']);
  _gaq.push(['_setAllowLinker', true]);
  _gaq.push(['_trackPageview']);
 
  (function() {
    var ga = document.createElement('script'); ga.type = 'text/javascript'; ga.async = true;
    ga.src = ('https:' == document.location.protocol ? 'https://ssl' : 'http://www') + '.google-analytics.com/ga.js';
    var s = document.getElementsByTagName('script')[0]; s.parentNode.insertBefore(ga, s);
  })();
 
</script>

</body></html>