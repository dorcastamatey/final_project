<?php
$cmd=$_REQUEST['cmd'];
switch ($cmd) {
	case 1:
		addusers();
		break;
    case 2;
	   addTeachers();
	   break;
	case 3;
	addSchool();
	  break;
	case 4;
	addParents();
	break;
	case 5;
	addSubjects();
	break;
	case 6;
	addClass();
	break;
	case 7;
	addQuestions();
	break;
	case 8;
	addAnswers();
	break;
	default:
		# code...
		break;
}
function addusers(){
	include("function.php");
	$add=new e_class();
	$name=$_REQUEST['Name'];
	$role=$_REQUEST['role'];
	$contact=$_REQUEST['contact'];
	$email=$_REQUEST['email'];
	$password=$_REQUEST['password'];
	$add->users($name,$role,$email,$password,$contact);

}
function addTeachers(){
	include("function.php");
	$add=new e_class();
	$name=$_REQUEST['teacherName'];
	$id=$_REQUEST['teacherId'];
	$contact=$_REQUEST['contact'];
	$email=$_REQUEST['email'];
	$password=$_REQUEST['password'];
	$add->teachers($name,$id,$email,$contact,$password);

}
function addSchool(){
	include("function.php");
	$add=new e_class();
	$name=$_REQUEST['schoolName'];
	$contact=$_REQUEST['contact'];
	$email=$_REQUEST['email'];
	$password=$_REQUEST['password'];
	$address=$_REQUEST['address'];
	$add->school($name,$email,$contact,$password,$address);

}
function addParents(){
	include("function.php");
	$add=new e_class();
	$name=$_REQUEST['parentName'];
	$email=$_REQUEST['email'];
	$password=$_REQUEST['password'];
	$child=$_REQUEST['child'];
	$add->parents($name,$email,$password,$child);

}
function addSubjects(){
	include("function.php");
	$add=new e_class();
	$subjectName=$_REQUEST['subjectName'];
	$subjectId=$_REQUEST['subjectId'];
	$add->subject($subjectName,$subjectId);
}
function addClass(){
	include("function.php");
	$add=new e_class();
	$class=$_REQUEST['classId'];
	$add->theClass($class);
}
function addQuestions(){
	include("function.php");
	$add=new e_class();
	$teacherId=$_REQUEST['teacherId'];
	$question=$_REQUEST['question'];
	$questionType=$_REQUEST['questionType'];
	$add->questions($teacherId,$questionType,$question);
}
function addAnswers(){
	include("function.php");
	$add=new e_class();
	$array=$_REQUEST['QnA'];
	echo $array[0];
	$ans=explode(" ", $array);
     //echo $ans[1];
	for( $answer=0;$answer<=sizeof($array); $answer++){
	$add->answers($ans[$answer]);
}
}


?>