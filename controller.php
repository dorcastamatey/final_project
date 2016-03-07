 <?php
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
	if(!$add->student($name,$course,$email,$contact,$password)){

	echo '{"result": 0, "message": "student was not added"}';
	return;
}
echo '{"result": 1, "message": "student was added successfully"}';
return;

}
function addSchool(){

	// include("function.php");
	// $add=new e_class();
	// $name=$_REQUEST['schoolName'];
	// $contact=$_REQUEST['contact'];
	// $email=$_REQUEST['email'];
	// $password=$_REQUEST['password'];
	// $address=$_REQUEST['address'];
	// $passkey=md5(rand(0,1000));
	// $add->school($name,$contact,$email,$address,$password,$passkey);
	

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
	$add->parents($fName,$mName,$email,$password,$child,$childId);

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

function addQuestions(){
	include("function.php");
	$add=new e_class();
	$teacherId=$_REQUEST['teacherId'];
	$question=$_REQUEST['question'];
	$questionType=$_REQUEST['qType'];
	$answer=$_REQUEST['answer'];
	$class=$_REQUEST['class'];
	$subject=$_REQUEST['subject'];

	if(!$add->questions($question,$answer,$questionType,$teacherId,$class,$subject)){
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
		}
		else{
		echo '{"result":0, "message":"not display"}';
		}
		}

	function viewChildren(){

		  include("function.php");
		  $obj=new e_class();

		  //$qno = $_REQUEST["ques"];
		
		if ($row=$obj->selectChildren())
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



?>