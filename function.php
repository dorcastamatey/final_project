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
	function student ($name,$course,$email,$contact,$password){
		$insert="INSERT INTO  students set studentName='$name',email='$email',password='$password',contact='$contact',Course='$course'";
		if(!$this->query($insert)){
			echo "cannot insert";
			echo mysql_error();
			

		}
		return $this->query($insert);
	}
	function parents($name,$email,$password,$child){
		$insert="INSERT INTO parents_table set parentsName='$name',email='$email',password='$password',childsName='$child'";
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
	function questions($question,$questionType,$teacherId){
		$insert="INSERT INTO questions set question ='$question',teacherId='$teacherId',questionType='$questionType'";
		
		return $this->query($insert);
	}
	function answers($answer){
		$insert="INSERT INTO answer set possible_answers='$answer'";
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
	function selectStudents(){
		$select="SELECT studentName,email,contact FROM students ";
		if(!$this->query($select)){
			echo "cannot select";
			
			echo mysql_error();
		}
		return $this->query($select);
	}
	function selectTeacher(){
		$select="SELECT name,email, contact FROM teacher";
		if(!$this->query($select)){
			echo "cannot insert";
			echo mysql_error();
			

		}
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
   	   $select="SELECT subjectName, subjectId FROM subjects";
   	   if(!$this->query($select)){
   		echo "cannot select";
   		echo mysql_error();
   	}
   	return $this->query($select);
   }
   function selectQuestion(){
   	  $select="SELECT question FROM questons";
   	  if(!$this->query($select)){
   		echo "cannot select";
   		echo mysql_error();
   	}
   	  return $this->query($select);
   }
   function selectAnswers(){
   	  $select="SELECT answer1,answer2,answer3,answer4,answer5,answer6 FROM answer";
   	  if(!$this->query($select)){
   		echo "cannot insert";
   		echo mysql_error();
   	}
   	  return $this->query($select);
   }
   function selectChildren($email){
   	 $select="SELECT childsName FROM parents_table where email='$email'";
   	 if(!$this->query($select)){
   		echo "cannot select";
   		echo mysql_error();
   	}
   	 return $this->query($select);

   }
}

?>