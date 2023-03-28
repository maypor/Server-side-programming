<?php
 require_once('init.php');
 require_once('../classes/student.php');
 require_once('../classes/course.php');
 require_once('../classes/semester.php');


	if ($session->signed_in){
		$user_id=$session->user_id;
		$user=new users();
		$user->find_user_by_id($user_id);
	echo '<h1>Hello '.$user->name.' here is the result of the survey:</h1><br>';}
	else {header('Location: Login.php');}
	

	$p = new course(0, 0,0,0,0, 0,0,0, 0);
	$p1 = new semester(0,0,0,0, 0);
	$p2 = new student(0, 0,0,0,0,0);
		
$dataPoints1 = array(
	array("x"=> 10, "y"=> 41),
	array("x"=> 20, "y"=> 35, "indexLabel"=> "Lowest"),
	array("x"=> 30, "y"=> 50),
	array("x"=> 40, "y"=> 45),
	array("x"=> 50, "y"=> 52),
	array("x"=> 60, "y"=> 68),
	array("x"=> 70, "y"=> 38),
	array("x"=> 80, "y"=> 71, "indexLabel"=> "Highest"),
	array("x"=> 90, "y"=> 52),
	array("x"=> 100, "y"=> 60),
	array("x"=> 110, "y"=> 36),
	array("x"=> 120, "y"=> 49),
	array("x"=> 130, "y"=> 41)
);
  require_once('database.php');

 $database=new Database();
 
 $test=array();
 $count=0;
		$sql="SELECT AVG(final_course_grade) as avg_grade, assistance FROM course INNER JOIN semester ON course.user_id = semester.user_id GROUP BY assistance;";
		$result=$database->query($sql);
		if (isset($result)){
			while ($row=mysqli_fetch_array($result)){
				$test[$count]["label"]=$row["assistance"];
				$test[$count]["y"]=$row["avg_grade"];
				$count = $count+1;

			}
		}
	
	$dataPoints2 = array( 
	array("label"=>"Chrome", "y"=>64.02),
	array("label"=>"Firefox", "y"=>12.55),
	array("label"=>"IE", "y"=>8.47),
	array("label"=>"Safari", "y"=>6.08),
	array("label"=>"Edge", "y"=>4.29),
	array("label"=>"Others", "y"=>4.59)
);$test1=array();
 $count1=0;
		$sql="SELECT reason_for_hes,COUNT(reason_for_hes) as reason FROM `course`GROUP BY reason_for_hes ORDER by reason_for_hes;";
		$result=$database->query($sql);
		if (isset($result)){
			$test1[0]["label"]=["The study material is difficult"];
			$test1[1]["label"]=["I missed a lot of classes"];
			$test1[2]["label"]=[ "not relevant"];
			$test1[3]["label"]=['The lecturer is unclear'];

			while ($row=mysqli_fetch_array($result)){
				$test1[$count1]["y"]=$row["reason"];
				$count1 = $count1+1;

			}
		}
		
		
	$dataPoints3 = array( 
	array("label"=>"Chrome", "y"=>64.02),
	array("label"=>"Firefox", "y"=>12.55),
	array("label"=>"IE", "y"=>8.47),
	array("label"=>"Safari", "y"=>6.08),
	array("label"=>"Edge", "y"=>4.29),
	array("label"=>"Others", "y"=>4.59)
);
 $test2=array();
 $count2=0;
		$sql="SELECT type_help,COUNT(type_help) as reason FROM `semester`GROUP BY type_help ORDER BY type_help";
		$result=$database->query($sql);
		if (isset($result)){
			$test2[0]["label"]=["study center"];
			$test2[1]["label"]=["dont need assistance"];
			$test2[2]["label"]=["private lessons"];
			$test2[3]["label"]=["to a website"];

			while ($row=mysqli_fetch_array($result)){
				$test2[$count2]["y"]=$row["reason"];
				$count2 = $count2+1;

			}
		}
$test3=array();
$count3=0;
		$sql="SELECT AVG(final_course_grade) as avg_grade, name FROM course INNER JOIN lecture ON course.user_id = lecture.user_id GROUP BY name;";
		$result=$database->query($sql);
		if (isset($result)){
			while ($row=mysqli_fetch_array($result)){
				$test3[$count3]["label"]=$row["name"];
				$test3[$count3]["y"]=$row["avg_grade"];
				$count3 = $count3+1;

			}
		}
		$dataPoints4 = array(
	array("label"=> "2006", "y"=> 3289),
	array("label"=> "2007", "y"=> 5312),
	array("label"=> "2008", "y"=> 11020),
	array("label"=> "2009", "y"=> 16854),
	array("label"=> "2010", "y"=> 30505),
	array("label"=> "2011", "y"=> 52764),
	array("label"=> "2012", "y"=> 70513),
	array("label"=> "2013", "y"=> 81488),
	array("label"=> "2014", "y"=> 88636),
	array("label"=> "2015", "y"=> 95092),
	array("label"=> "2016", "y"=> 103000)
); 
$dataPoints5 = array(
	array("label"=> "2006", "y"=> 1827),
	array("label"=> "2007", "y"=> 2098),
	array("label"=> "2008", "y"=> 2628),
	array("label"=> "2009", "y"=> 3373),
	array("label"=> "2010", "y"=> 4951),
	array("label"=> "2011", "y"=> 7513),
	array("label"=> "2012", "y"=> 12159),
	array("label"=> "2013", "y"=> 21992),
	array("label"=> "2014", "y"=> 34991),
	array("label"=> "2015", "y"=> 50776),
	array("label"=> "2016", "y"=> 68000)
);
 
$test4=array();
$count4=0;
		$sql="SELECT year_in, AVG(avg_grade) from student WHERE gender='female' GROUP BY year_in";
		$result=$database->query($sql);
		if (isset($result)){
			while ($row=mysqli_fetch_array($result)){
				$test4[$count4]["label"]=$row["year_in"];
				$test4[$count4]["y"]=$row["AVG(avg_grade)"];
				$count4 = $count4+1;

			}
		}
$test5=array();
$count5=0;
		$sql="SELECT year_in, AVG(avg_grade) from student WHERE gender='male' GROUP BY year_in";
		$result=$database->query($sql);
		if (isset($result)){
			while ($row=mysqli_fetch_array($result)){
				$test5[$count5]["label"]=$row["year_in"];
				$test5[$count5]["y"]=$row["AVG(avg_grade)"];
				$count5 = $count5+1;

			}
		}
		?>
<!DOCTYPE HTML>
<html>
<head> 		
<link rel="stylesheet" href="../css/show_result.css">  
<script>
function chart1(){ 
 
var chart = new CanvasJS.Chart("chartContainer1", {
	animationEnabled: true,
	exportEnabled: true,
	theme: "light1", // "light1", "light2", "dark1", "dark2"
	title:{
		text: "Average grades of students who received/did not received an assistance"
	},
	axisY:{
		includeZero: true
	},
	data: [{
		type: "column", //change type to bar, line, area, pie, etc
		//indexLabel: "{y}", //Shows y value on all Data Points
		indexLabelFontColor: "#5A5757",
		indexLabelPlacement: "outside",   
		dataPoints: <?php echo json_encode($test, JSON_NUMERIC_CHECK); ?>
	}]
});
chart.render();
 
}
function chart2(){ 
 
 
var chart = new CanvasJS.Chart("chartContainer2", {
	animationEnabled: true,
	title: {
		text: "The reason for the help the students took"
	},
	subtitles: [{
		text: ""
	}],
	data: [{
		type: "pie",
		indexLabel: "{label} ({y})",
		dataPoints: <?php echo json_encode($test1, JSON_NUMERIC_CHECK); ?>
	}]
});
chart.render();
}
function chart3(){ 
 
var chart = new CanvasJS.Chart("chartContainer3", {
	animationEnabled: true,
	title: {
		text: "The kind of assistance the students received"
	},
	subtitles: [{
		text: ""
	}],
	data: [{
		type: "pie",
		indexLabel: "{label} ({y})",
		dataPoints: <?php echo json_encode($test2, JSON_NUMERIC_CHECK); ?>
	}]
});
chart.render();
}
function chart4(){ 
 
var chart = new CanvasJS.Chart("chartContainer4", {
	animationEnabled: true,
	exportEnabled: true,
	theme: "light1", // "light1", "light2", "dark1", "dark2"
	title:{
		text: "The average grades of the students according to the lecturer"
	},
	axisY:{
		includeZero: true
	},
	data: [{
		type: "column", //change type to bar, line, area, pie, etc
		//indexLabel: "{y}", //Shows y value on all Data Points
		indexLabelFontColor: "#5A5757",
		indexLabelPlacement: "outside",   
		dataPoints: <?php echo json_encode($test3, JSON_NUMERIC_CHECK); ?>
	}]
});chart.render();
 
}
function chart5(){
 
var chart = new CanvasJS.Chart("chartContainer5", {
	title: {
		text: "Annual average grade of students divided by gender"
	},
	theme: "light2",
	animationEnabled: true,
	toolTip:{
		shared: true,
		reversed: true
	},
	axisY: {
		title: "Cumulative Capacity",
		suffix: " "
	},
	legend: {
		cursor: "pointer",
		itemclick: toggleDataSeries
	},
	data: [
		{
			type: "stackedColumn",
			name: "female",
			showInLegend: true,
			yValueFormatString: "#,AVG:##0 ",
			dataPoints: <?php echo json_encode($test4, JSON_NUMERIC_CHECK); ?>
		},{
			type: "stackedColumn",
			name: "male",
			showInLegend: true,
			yValueFormatString: "#,AVG:##0 ",
			dataPoints: <?php echo json_encode($test5, JSON_NUMERIC_CHECK); ?>
		}
	]
});
 
chart.render();
 
function toggleDataSeries(e) {
	if (typeof (e.dataSeries.visible) === "undefined" || e.dataSeries.visible) {
		e.dataSeries.visible = false;
	} else {
		e.dataSeries.visible = true;
	}
	e.chart.render();
}
 
}

window.onload = function () {
  chart1();
  chart2();
  chart3();
  chart4();
  chart5();


};

</script>
</head>
<body>
<div id="title" style="height: 70px; width: 100%;"></div>
<div id="chartContainer1" style="height: 370px; width: 100%;"></div>
<?php	$p2->relation_to_others_graph1($user_id);?>

<div id="chartContainer2" style="height: 370px; width: 100%;"></div>
<?php	$p2->relation_to_others_graph2($user_id);?>

<div id="chartContainer3" style="height: 370px; width: 100%;"></div>
<?php	$p2->relation_to_others_graph3($user_id);?>

<div id="chartContainer4" style="height: 370px; width: 100%;"></div>
<?php	$p2->relation_to_others_graph4($user_id);?>

<div id="chartContainer5" style="height: 370px; width: 100%;"></div>
<?php	$p2->relation_to_others_graph5($user_id);?>
<h2 style="font-size: 30px; text-align: center; text-shadow: #2a8d7b -1px -1px; color: #FF4500;"> Here is the data you entered in the survey:</h2>';

<?php	$p->print_student_lucture($user_id);
	$p2->print_student($user_id);
	$p1->print_student_table_semester($user_id);
	$p->print_student_course($user_id);?>

<script src="https://canvasjs.com/assets/script/canvasjs.min.js"></script>

</body>
</html>