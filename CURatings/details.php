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
<script type="text/javascript" src="js/jquery-1.9.1.min.js"></script>
<!--[if lt IE 9]><script src="http://html5shiv.googlecode.com/svn/trunk/html5.js"></script><![endif]-->
<script type="text/javascript" src="js/prettify.js"></script>                                   <!-- PRETTIFY -->
<script type="text/javascript" src="js/kickstart.js"></script>                                  <!-- KICKSTART -->
<link rel="stylesheet" type="text/css" href="css/kickstart.css" media="all" />                  <!-- KICKSTART -->
<link rel="stylesheet" type="text/css" href="style.css" media="all" />                          <!-- CUSTOM STYLES -->

</head><body>
<div class="grid">

<div class="center" >
	<?php
	$query = $_GET['query']; 	//query is the search value
	$min_length = 3;
	$query = htmlspecialchars($query); //change html characters to string
	$query = mysql_real_escape_string($query); //prevent SQL injection
	$raw_results = mysql_query("SELECT * FROM `fcq_total` WHERE `Instructor` LIKE '%".$query."%'") or die(mysql_error());
	$raw_results2 = mysql_query("SELECT * FROM `instructor_challenge` WHERE `Instructor` LIKE '%".$query."%'") or die(mysql_error());
		?>
		
<!--
<h4 class="inst"> <?php echo $results['Instructor']; ?> </h4>
<div> Courses taught: </div>
<div><?php echo number_format($results['Professor_avg'],2); ?></div>
<li>Availability: <?php echo number_format($results['availability_avg'],2); ?></li>
<li>Amount Learned: <?php echo number_format($results['howmuchlearned_avg'],2); ?></li>
<li>Respectfulness: <?php echo number_format($results['instrrespect_avg'],2); ?></li>
<li>Effectiveness: <?php echo number_format($results['instreffective_avg'],2); ?></li>
-->

<table>
<tbody>
<?php	
			if(mysql_num_rows($raw_results) > 0) 
				{
				while($results = mysql_fetch_array($raw_results)) 
					{
					$profAvg = number_format($results['Professor_avg'],2);
					$profAvail = number_format($results['availability_avg'],2);
					$profHml = number_format($results['howmuchlearned_avg'],2);
					$profResp = number_format($results['instrrespect_avg'],2);
					$proEff = number_format($results['instreffective_avg'],2);
					
					echo '<tr class="header">';
						echo '<td class="insTit" colspan="2">'.$results['Instructor'].'</td>';
					echo '</tr>';
					echo '<tr class="child">';
						echo '<td class="forms" colspan="2">based on '.$results['formsReturned'].' reviews</td>';
					echo '</tr>' ;
					
					echo '<tr class="num">';
						echo '<td class="ind"><strong>Overall:</strong></td>';
						echo '<td><div id="profAvg" class="lgrade"><div class="grade"></div></div> ['.$profAvg.']</td>';
					echo '</tr>' ;

					echo '<tr class="num">';
						echo '<td class="ind">Availability:</td>';
						echo '<td><div id="profAvail" class="lgrade"><div class="grade"></div></div> ['.$profAvail.']</td>';
					echo '</tr>';
					
					echo '<tr class="num">';
						echo '<td class="ind">Amount Learned:</td>';
						echo '<td><div id="profHml" class="lgrade"><div class="grade"></div></div> ['.$profHml.']</td>';
					echo '</tr>' ;
					
					echo '<tr class="num">';
						echo '<td class="ind">Respectfulness:</td>';
						echo '<td><div id="profResp" class="lgrade"><div class="grade"></div></div> ['.$profResp.']</td>';
					echo '</tr>';
					
					echo '<tr class="num">';
						echo '<td class="ind">Effectiveness:</td>';
						echo '<td><div id="proEff" class="lgrade"><div class="grade"></div></div> ['.$proEff.']</td>';
					echo '</tr>' ;
					}
				}
?>
<?php 
			if(mysql_num_rows($raw_results2) > 0) 
				{
				while($results = mysql_fetch_array($raw_results2)) 
					{
					$proDiff = number_format($results['difficult'],2);
				echo '<tr class="num">';
						echo '<td class="ind">Intellectual Challenge:</td>';
						echo '<td><div id="proDiff" class="lgrade"><div class="grade"></div></div> ['.$proDiff.']</td>';
					echo '</tr>' ;
					}
				}
?>
</tbody>
</table>
</div>

	</div>
	
		
<script type="text/javascript">                                         
$(document).ready(function() {
	getGrade(<?php echo $profAvg?>, '#profAvg');
	getGrade(<?php echo $profResp?>, '#profResp');
	getGrade(<?php echo $proEff?>, '#proEff');
	getGrade(<?php echo $profAvail?>, '#profAvail');
	getGrade(<?php echo $profHml?>, '#profHml');
	getGrade(<?php echo $proDiff?>, '#proDiff');
});
function getGrade(g,el){
    var d = g % 1;
    if (g<6.00){$(el).append('F').show();}
    else if (g>=6.00&&g<7.00){$(el).append('D').show();}
    else if (g>=7.00&&g<8.00){$(el).append('C').show();}
    else if (g>=8.00&&g<9.00){$(el).append('B').show();}
    else if (g>=9.00){$(el).append('A').show();}
    else return;
    if(d>=0&&d<0.29){
    	if(g==10.00){
	    	$(el).append('+');
    	}
    	 else {$(el).append('-');}}
    else if(d>=0.29&&d<0.59){$(el).append(' ');}
    else if(d>=0.59&&d<1){$(el).append('+');}
    else return;
};
</script>

</div>
</body></html>