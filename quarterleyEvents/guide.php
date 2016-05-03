<?php
$get_var = $_GET['quarter'];
switch($get_var){
	case 'first':
	header("location: ../Q1/1stQtr2012_Conferences_Seminars_and_Training_Guide.pdf");exit;
	break;
	case 'second':
	header("location: ../Q2/2ndQtr2012_Conferences_seminars_and_training_guide.pdf");exit;
	break;
	case 'third':
	header("location: ../Q3/3rdQtr2012ConferencesAndTrainingGuide.pdf");exit;
	break;
	case 'fourth':
	header("location: ../Q4/4thQuarter2012TrainingGuide.pdf");exit;
	break;
}