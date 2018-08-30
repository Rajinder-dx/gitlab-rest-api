<?php
require_once __DIR__ . '/vendor/autoload.php';
use GitLab\GitLab;

class GitServer{

	function setUser(){

		//To create User
		echo GitLab::init('User', array('email' => 'dxtesqwtone@gmail.com', 'password' => '132456789', 'firstName' => 'one2', 'lastName' => 'User2'));
	}

	


	//To Create Project
	echo GitLab::init('Project', array('name' => 'TMP-654674-FCM-TKN'));


	//To create Project's Branch
	echo GitLab::init('Branch', array('projectId' => 9, 'name' => 'testBranch3', 'cloneFrom' => 'master'));


	//To Assign Project's Member
	/*
	10 => Guest access
	20 => Reporter access
	30 => Developer access
	40 => Master access
	50 => Owner access # Only valid for groups
	*/  
	echo GitLab::init('Member', array('projectId' => 9, 'memberId' => 17, 'access' => 30));



}

?>
