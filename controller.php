 <?php
 session_start();
 $cmd=$_REQUEST['cmd'];
 switch ($cmd) {
 	case 1:
 	addusers();
 	break;
 	case 2;
 	addStudent();
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
 	case 9;
 	viewQnA();
    break;
 	case 10;
 	viewQuestions();
 	break;

 	case 11;
 	setQuiz();
 	break;

 	case 12;
 	setQuizDisplay();
 	break;

 	case 13;
 	insertRecord();
 	break;
 	case 14;
 	login();
 	break;
 	case 15;
 	recordsDisplay();
 	break;
 	case 16;
 	addParents();
 	break;
 	case 17;
 	viewChildren();
 	break;
 	case 18;
 	viewCoursesAndMates();
 	break;
 	case 19;
 	viewTeacher();
 	break;
 	case 20;
 	insertAttendance();
 	break; 
 	case 21;
 	recordsDisplay1();
 	break;
 	case 22;
 	selectAttendance();
 	break;
 	case 23;
 	selectStudents();
 	break;
 	case 24;
 	chat();
 	break;

 	default:
		# code...
 	break;
 }


 function addusers(){
 	include("function.php");
 	$add=new e_class();
 	$name=$_REQUEST['Name'];
	//$role=$_REQUEST['role'];
 	$contact=$_REQUEST['contact'];
 	$email=$_REQUEST['email'];
 	$password=$_REQUEST['password'];
 	$passkey=md5(rand(0,1000));

 	if(!$add->users($name,$role,$email,$password,$contact,$passkey)){

 		echo '{"result": 0, "message": "user was not added"}';
 		return;
 	}
 	echo '{"result": 1, "message": "user was added successfully"}';
 	return;

 }


 function addStudent(){
 	include("function.php");
 	$add=new e_class();
 	$name=$_REQUEST['Name'];
 	$course=$_REQUEST['course'];
 	$contact=$_REQUEST['contact'];
 	$email=$_REQUEST['email'];
 	$password=$_REQUEST['password'];
 	$role=$_REQUEST['role'];

 	if(!$add->student($name,$course,$email,$contact,$password,$role)){

 		echo '{"result": 0, "message": "student was not added"}';
 		return;
 	}
 	echo '{"result": 1, "message": "student was added successfully"}';
 	return;

 }

 function addParents(){
 	include("function.php");
 	$add=new e_class();
 	$fName=$_REQUEST['fName'];
 	$mName=$_REQUEST['mName'];
 	$email=$_REQUEST['email'];
 	$password=$_REQUEST['password'];
 	$child=$_REQUEST['childName'];
 	$childId=$_REQUEST['ID'];
 	$role=$_REQUEST['role'];
 	if(!$add->parents($fName,$mName,$email,$password,$child,$childId,$role)){
 		echo '{"result": 0, "message": "parent was not added"}';
 		return;

 	}

 	echo '{"result": 1, "message": "parent was successfully added"}';
 	return;
 }

 function addSubjects(){
 	include("function.php");
 	$add=new e_class();
 	$subjectName=$_REQUEST['subjectName'];
 	$subjectId=$_REQUEST['subjectId'];
 	if(!$add->subject($subjectName,$subjectId)){
 		echo '{"result": 0, "message": "subject was not added"}';
 		return;
 	}
 	echo '{"result": 1, "message": "subject was added successfully"}';
 	return;
 }
 function addClass(){
 	include("function.php");
 	$add=new e_class();
 	$class=$_REQUEST['classId'];
 	if(!$add->theClass($class)){
 		echo '{"result": 0, "message": "class was not added"}';
 		return;
 	}
 	echo '{"result": 1, "message": "class was added successfully"}';
 	return;

 }

 function login(){
 	include("function.php");
 	$add=new e_class();
 	$email=$_REQUEST['email'];
 	$password=$_REQUEST['password'];

 	$add->loginStudent($email,$password);
 	$row = $add->fetch();
 	if ($row) {
 		echo '{"result":1, "message":[';
 		while ($row)
 		{
 			$_SESSION['emailStudent']=$row['email'];
 			echo json_encode($row);

 			$row = $add->fetch(); 
 			if ($row){
 				echo ",";
 			}
 		}
 		echo "]}";
 		return;
 	}
 	$add->loginParent($email,$password);
 	$row2 = $add->fetch();
 	if ($row2) {
 		echo '{"result":1, "message":[';
 		while ($row2)
 		{
 			$_SESSION['emailParent']=$row2['email'];
 			@$_SESSION['studentId']=$row2['StudentId'];
 			echo json_encode($row2);

 			$row2 = $add->fetch (); 
 			if ($row2){
 				echo ",";
 			}
 		}
 		echo "]}";
 		return;
 	}

 	$add->loginUser($email,$password);
 	$row3 = $add->fetch();
 	if ($row3) {
 		
 		echo '{"result":1, "message":[';
 		while ($row3){
 			$_SESSION['emailUser']=$row3['email'];
 		
 			echo json_encode($row3);

 			$row3 = $add->fetch (); 
 			if ($row3){
 				echo ",";
 			}
 		}
 		echo "]}";
 		return;
 	}
 	echo '{"result": 0, "message": "invalid details"}';
 	return;
 }

function insertAttendance(){
	include("function.php");
 	$add=new e_class();
 	$email=$_SESSION['emailParent'];
 	$teacherName=$_REQUEST['attendance'];
 	$status=$_REQUEST['status'];
 	$date=date("y.m.d");
 	if(!$add->insertAttendance($teacherName,$status,$email,$date)){
 		echo '{"result": 0, "message": "attendance was not added"}';
 		echo mysql_error();
 		return;
 	}
 	echo '{"result": 1, "message": "attendance was added successfully"}';
 	return;


}
function selectAttendance(){
	include("function.php");
 		$obj=new e_class();

 		//$qno = $_REQUEST["ques"];

 		if ($row=$obj->selectAttendance())
 		{
 			echo '{"result":1, "message":[';
 			while ($row)
 			{
 				echo json_encode($row);

 				$row = $obj->fetch (); 
 				if ($row){
 					echo ",";
 				}
 			}
 			echo "]}";
 		}
 		else{
 			echo '{"result":0, "message":"not display"}';
 		}
 	}








 function addQuestions(){
 	include("function.php");
 	$add=new e_class();
 	$teacherId=$_REQUEST['teacherId'];
 	$question=$_REQUEST['question'];
 	$questionType=$_REQUEST['qType'];

 	$answer=$_REQUEST['answer'];
 	$class=$_REQUEST['class'];
 	$subject=$_REQUEST['subject'];
 	$quizType=$_REQUEST['quizType'];

 	if(!$add->questions($question,$answer,$questionType,$teacherId,$class,$subject,$quizType)){

 			echo '{"result": 0, "message": "Question was not added"}';
 			return;
 		}
 		echo '{"result": 1, "message": "Question was added successfully"}';
 		return;

	//echo "hello";
}
 	


 	function addAnswers(){
 		include("function.php");
 		$add=new e_class();
 		$ans=$_REQUEST['QnA'];
	//echo $array[0];
 		$answer=explode(",", $ans);
    // echo sizeof($answer);

 		$questionId=$_REQUEST['questionId'];
 		for( $array=0;$array<=sizeof($answer)-1; $array++){
 			$thisAns=$add->answers($answer[$array],$questionId);

 		}

 		if(!$thisAns){
 			echo '{"result": 0, "message": "answer was not added"}';
 			return;

 		}
 		echo '{"result": 1, "message": "answer was added successfully"}';


 		return;

 	}
 	


 	function viewQnA(){

 		include("function.php");
 		$obj=new e_class();

 		$qno = $_REQUEST["ques"];

 		if ($row=$obj->selectAnswers($qno))
 		{
 			echo '{"result":1, "message":[';
 			while ($row)
 			{
 				echo json_encode($row);

 				$row = $obj->fetch (); 
 				if ($row){
 					echo ",";
 				}
 			}
 			echo "]}";
 		}
 		else{
 			echo '{"result":0, "message":"not display"}';
 		}
 	}

 	function viewTeacher(){

 		include("function.php");
 		$obj=new e_class();

 		//$qno = $_REQUEST["ques"];

 		if ($row=$obj->selectTeacher())
 		{
 			echo '{"result":1, "message":[';
 			while ($row)
 			{
 				echo json_encode($row);

 				$row = $obj->fetch (); 
 				if ($row){
 					echo ",";
 				}
 			}
 			echo "]}";
 		}
 		else{
 			echo '{"result":0, "message":"not display"}';
 		}
 	}

 	function viewQuestions(){

 		include("function.php");
 		$obj=new e_class();

		  //$qno = $_REQUEST["ques"];

 		if ($row=$obj->selectQuestion())
 		{
 			echo '{"result":1, "message":[';
 			while ($row)
 			{
 				echo json_encode($row);

 				$row = $obj->fetch (); 
 				if ($row){
 					echo ",";
 				}
 			}
 			echo "]}";
 			return;
 		}
 		else{
 			echo '{"result":0, "message":"not display"}';
 			return;
 		}
 	}

 	function viewChildren(){

 		include("function.php");
 		$obj=new e_class();

		 $email=$_SESSION['emailParent'];

 		if ($row=$obj->selectChildren($email))
 		{
 			echo '{"result":1, "message":[';
 			while ($row)
 			{
 				echo json_encode($row);

 				$row = $obj->fetch (); 
 				if ($row){
 					echo ",";
 				}
 			}
 			echo "]}";
 		}
 		else{
 			echo '{"result":0, "message":"not display"}';
 		}
 	}

 	function setQuiz(){
 		include("function.php");
 		$obj=new e_class();

 		$quizType=$_REQUEST['quizType'];
 		$quizTime=$_REQUEST['quizTime'];
 		$subject=$_REQUEST['subject'];
 		$class=$_REQUEST['sClass'];
 		$dueDate=$_REQUEST['dueDate'];
 		$tName=$_REQUEST['tName'];
 		$comment=$_REQUEST['comment'];

 		if(!$obj->setQuiz($quizType,$quizTime,$subject,$class,$dueDate,$tName,$comment)){

 			echo '{"result": 0, "message": "answer was not added"}';
 			return;

 		}
 		echo '{"result": 1, "message": "answer was added successfully"}';

 		return;
 	}

 	function setQuizDisplay(){

 		include("function.php");
 		$obj=new e_class();

				  //$qno = $_REQUEST["ques"];

 		if ($row=$obj->displaySetQuiz())
 		{
 			echo '{"result":1, "message":[';
 			while ($row)
 			{
 				echo json_encode($row);

 				$row = $obj->fetch (); 
 				if ($row){
 					echo ",";
 				}
 			}
 			echo "]}";
 		}
 		else{
 			echo '{"result":0, "message":"not display"}';
 		}
 	}
 	function insertRecord(){
 		include("function.php");
 		$obj=new e_class();
 		$subject=$_REQUEST['subjects'];
 		$class=$_REQUEST['theclass'];
 		$score=$_REQUEST['score'];
 		$outOf=$_REQUEST['outOf'];
 		$quizType=$_REQUEST['quizType'];
 		$teacherName=$_REQUEST['teacherName'];

 		if(!$obj->record($subject,$class,$score,$outOf,$quizType,$teacherName)){
 			echo mysql_error();

 			echo '{"result": 0, "message": "record was not added"}';
 			return;

 		}
 		echo '{"result": 1, "message": "record was added successfully"}';

 		return;
 	}




 	function recordsDisplay(){

 		include("function.php");
 		$obj=new e_class();

			  //$qno = $_REQUEST["ques"];
 		$id=@$_SESSION['studentId'];

 		if ($row=$obj->selectRecord($id))
 		{
 			echo '{"result":1, "message":[';
 			while ($row)
 			{
 				echo json_encode($row);

 				$row = $obj->fetch (); 
 				if ($row){
 					echo ",";
 				}
 			}
 			echo "]}";
 			return;
 		}
 		else{
 			echo '{"result":0, "message":"not display"}';
 			return;
 		}
 	}

 	function recordsDisplay1(){

 		include("function.php");
 		$obj=new e_class();

			  $id = $_REQUEST["id"];
 		//$id=@$_SESSION['studentId'];

 		if ($row=$obj->selectRecord($id))
 		{
 			echo '{"result":1, "message":[';
 			while ($row)
 			{
 				echo json_encode($row);

 				$row = $obj->fetch (); 
 				if ($row){
 					echo ",";
 				}
 			}
 			echo "]}";
 			return;
 		}
 		else{
 			echo '{"result":0, "message":"not display"}';
 			return;
 		}
 	}

 	function viewCoursesAndMates(){

 		include("function.php");
 		$obj=new e_class();

		  //$qno = $_REQUEST["ques"];

 		if ($row=$obj->studentCourses())
 		{
 			echo '{"result":1, "message":[';
 			while ($row)
 			{
 				echo json_encode($row);

 				$row = $obj->fetch (); 
 				if ($row){
 					echo ",";
 				}
 			}
 			echo "]}";
 			echo mysql_error();
 			return;
 		}
 		else{
 			echo '{"result":0, "message":"not display"}';
 			return;
 		}
 	}

 	function selectStudents(){

 		include("function.php");
 		$obj=new e_class();

		 $email=$_SESSION['emailUser'];

 		if ($row=$obj->selectStudents($email))
 		{
 			echo '{"result":1, "message":[';
 			while ($row)
 			{
 				echo json_encode($row);

 				$row = $obj->fetch (); 
 				if ($row){
 					echo ",";
 				}
 			}
 			echo "]}";
 		}
 		else{
 			echo '{"result":0, "message":"not display"}';
 		}


 	}
    function chat(){

 		include("function.php");
 		$obj=new e_class();

		 //$email=$_SESSION['emailUser'];

 		if ($row=$obj->chat())
 		{
 			echo '{"result":1, "message":[';
 			while ($row)
 			{
 				echo json_encode($row);

 				$row = $obj->fetch (); 
 				if ($row){
 					echo ",";
 				}
 			}
 			echo "]}";
 		}
 		else{
 			echo '{"result":0, "message":"not display"}';
 		}


 	}




 	
 


 ?>