<?php
include('adb.php');
class e_class extends adb{
	function school($name,$contact,$email,$address,$password,$passkey){
		$insert="INSERT INTO users set Name='$name',Email='$email',contact='$contact'
		,address='$address',password='$password',passkey='$passkey'";
		if(!$this->query($insert)){
			echo "cannot insert";
		}
		return $this->query($insert);
	}
	function users($name,$role,$email,$password,$contact,$passkey){
		$insert="INSERT INTO  users set Name='$name',role='$role',email='$email',password='$password',contact='$contact',passkey='$passkey'";
		if(!$this->query($insert)){
			echo "cannot insert";
			echo mysql_error();
		}
		return $this->query($insert);
	}
	function student ($name,$course,$email,$contact,$password,$role){
		$insert="INSERT INTO  students set studentName='$name',email='$email',password='$password',contact='$contact',Course='$course',role='$role'";
		if(!$this->query($insert)){
			echo "cannot insert";
			echo mysql_error();
			

		}
		return $this->query($insert);
	}
	function parents($mothersName,$fathersName,$email,$password,$child,$childId,$role){
		$insert="INSERT INTO parents set father'sName='$fathersName',mother'sName='$mothersName'email='$email'
		,password='$password',child'sName='$child' child'sId='$childId,role='$role'";
		if(!$this->query($insert)){
			echo "cannot insert";
			echo mysql_error();
		}
		return $this->query($insert);
	}
	function theClass($name){
		$insert="INSERT INTO class set classId='$name'";
		if(!$this->query($insert)){
			echo "cannot insert";
			echo mysql_error();
		}
		return $this->query($insert);
	}
	function subject($name,$id){
		$insert="INSERT INTO subjects set subjectName='$name',subjectId='$id'";
		if(!$this->query($insert)){
			echo "cannot insert";
			echo mysql_error();
		}
		return $this->query($insert);
	}

	function questions($question,$answer,$questionType,$teacherId,$class,$subject,$quizType){
		$insert="INSERT INTO questions set question ='$question',answer='$answer',teacherId=
		'$teacherId',questionType='$questionType',subject='$subject',class='$class',quizType='$quizType'";
    }
	
	function answers($answer,$questionId){
		$insert="INSERT INTO answer set answer='$answer',questionId='$questionId'";
		if(!$this->query($insert)){
			echo "cannot insert";
			echo mysql_error();	
		}
		return $this->query($insert);

	}
	function selectSchool(){
		$select="SELECT schoolName, Email,contact,address FROM school";
		if(!$this->query($select)){
			echo "cannot select";
			echo mysql_error();
		}
		return $this->query();
	}
	function selectStudents($email){
		$select="SELECT studentName,email,contact,StudentId FROM students where teacherEmail='$email'";
		if(!$this->query($select)){
			echo "cannot select";
			
			echo mysql_error();
		}
		return $this->query($select);
	}
	function selectTeacher(){
		$select="SELECT teacherName,email, contact,level FROM teacher";
		if(!$this->query($select)){
			echo "cannot insert";
			echo mysql_error();
			

		}
		return $this->query($select);
	}
	function insertAttendance($teacherName,$status,$email,$date){

		$insert="INSERT INTO attendance set teacherName='$teacherName',AttendanceStatus='$status', email='$email',attendanceDate='$date'";
		return $this->query($insert);
	}
	function selectAttendance(){
		$select="SELECT * FROM attendance";
		return $this->query($select);
	}

   function selectClass(){
   	   $select="SELECT classId From class";
   	   if(!$this->query($select)){
   		echo "cannot select";
   		echo mysql_error();
   	}
   	   return $this->query($select);
   }
   function selectSubject(){
   	   $select="SELECT subjectName,subjectId FROM subjects";
   	   if(!$this->query($select)){
   		echo "cannot select";
   		echo mysql_error();
   	}
   	return $this->query($select);
   }

   function selectStudentSubject($email){
   	   $select="SELECT Course,grade FROM students WHERE email='$email'";
   	   if(!$this->query($select)){
   		echo "cannot select";
   		echo mysql_error();
   	}
   	return $this->query($select);
   }
   function selectQuestion(){
   	  $select="SELECT question,answer FROM questions";
   	  if(!$this->query($select)){
   		echo "cannot select";
   		echo mysql_error();
   	}
   	  return $this->fetch();
   }
   function selectAnswers($id){
   	$select ="SELECT answer From answer WHERE questionId='$id'";
   	  if(!$this->query($select)){
   		echo "cannot insert";
   		echo mysql_error();
   	}
   	  return $this->fetch();
   }
   function selectChildren($email){
   	 $select="SELECT childsName, childsId FROM parents where email='$email'";
   	 if(!$this->query($select)){
   		echo "cannot select";
   		echo mysql_error();
   	}
   	 return $this->fetch();

   }

   function setQuiz($quizType,$quizTime,$subject,$class,$dueDate,$teacherName,$comment){
     $insert="INSERT INTO quizTable SET subject='$subject',quizType='$quizType',quizTime='$quizTime',dueDate=
     '$dueDate',teacherName='$teacherName',comment='$comment',theclass='$class' ";
     
		return $this->query($insert);

   }
   function displaySetQuiz(){
      $select="SELECT DISTINCT  quizTable.quizType,quizTable.subject,quizTable.teacherName,
      quizTable.theclass,quizTable.quizTime FROM questions,quizTable WHERE questions.quizNum=quizTable.quizNum";
   	 if(!$this->query($select)){
   		echo "cannot select";
   		echo mysql_error();
   	}
   	return $this->query($select);

   }
  function record($subject,$class,$score,$outOf,$quizType,$teacherName){
  	$insert="INSERT INTO submission SET subject='$subject',studentClass='$class', score='$score',
  	outOf='$outOf',quizType='$quizType',teacherName='$teacherName'";
  	return $this->query($insert);
  }
  function selectRecord($id){

  	$select="SELECT * FROM submission Where studentId='$id' ";
  	return $this->query($select);
  	

  }

  
  function loginStudent($email,$password){
  	$login=" SELECT * FROM students  WHERE email='$email' AND password='$password'";
return $this->query($login);
  }

  function loginParent($email,$password){
  	$login=" SELECT * FROM parents WHERE email='$email' AND password='$password'";
return $this->query($login);
  }
  function loginUser($email,$password){
  	$login=" SELECT * FROM users WHERE email='$email' AND password='$password'";
return $this->query($login);
  }
  function chat($message,$sender,$recepient){
  	     $insert="INSERT INTO chat set message='$message',sender='$sender',recepient='$recepient'";
  	     return $this->query($insert);
  }
  function fetchChat(){
  	$select="SELECT * FROM chat";
  	return $this->query($select);
  }
  function quiz($subject,$class){
  	$select="SELECT * FROM quizTable WHERE subject='$subject' AND theclass='$class'";
  	return $this->query($select);
  }

  function selectQuestionsAndAnswers($teacherId,$subject,$quizNum){
  	$select="SELECT questions.question,questions.answer,questions.questionId,
  	 answer.answer FROM questions,answer WHERE questions.questionId=answer.questionId AND 
  	questions.quizNum='$quizNum' AND questions.teacherId='$teacherId' AND questions.subject='$subject'";
  	return $this->query($select);
  }
}

?>