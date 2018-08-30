<?php
namespace GitLab;
use GitLab\Gateway;


class GitLab{


  public static function init($endPoint, $parms){


  		$gatway = new Gateway();

  		extract($parms);

  		if($endPoint == 'User'){

  			$responce = $gatway->createUser($email, $password, $userName, $name);

  		}else if($endPoint == 'Project'){

  			$responce = $gatway->createProject($name, $description);

  		}else if($endPoint == 'Branch'){

  			$responce = $gatway->createBranch($projectId, $name, $cloneFrom);
  			
  		}else if($endPoint == 'Member'){

  			$responce = $gatway->addMember($projectId, $memberId, $access);  			
  		}	

 		return $responce;
  }
}

