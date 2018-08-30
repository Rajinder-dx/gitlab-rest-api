<?php
/*
* This class is a Gateway for GItlab Sertver and all API request will be executed from here.
*/

namespace GitLab;
use GitLab\Config;

class Gateway extends Config{

    private $apiUrl = 'http://112.196.23.228/api/';
    private $apiVersion = 'v4';



    /*  Create User in GitLab server */
    public function createUser($email, $password, $username, $name){

        $data = array(
          'email' => $email,
          'password' => $password,
          'reset_password' => false,
          'username' => $username,
          'name' => $name,
          'website_url' => 'http://designersx.com',
          'organization' => 'Designersx',
          'projects_limit' => 10,
        );
        return $this->fireCurl('/users', $data);
    }



    /*  Create Project in GitLab server */
    public function createProject($name, $description){

        $data = array('name' => $name, 'description' => $description);
        return $this->fireCurl('/projects', $data);
    }


    /*  Create Branch in GitLab server */
    public function createBranch($projectId, $branchName, $ref = 'master'){

        $data = array('branch' => $branchName, 'ref' => $ref);
        return $this->fireCurl('/projects/'.$projectId.'/repository/branches', $data);
    }


    /*  Add member to project and group */
    public function addMember($projectId = null, $member = null, $access = null){

        $returns = null;

        if($projectId != null && $member != null && $access != null){            

            $data = array('user_id' => $member, 'access_level' => $access);   
            $returns = $this->fireCurl('/projects/'.$projectId.'/members', $data);
        }
        return $returns;
    }


    /* execute curl with POST data */
    private function fireCurl($url, $data = null){

    		$content = json_encode($data);
    		$curl = curl_init($this->apiUrl . $this->apiVersion . $url);
    		curl_setopt($curl, CURLOPT_HEADER, false);
    		curl_setopt($curl, CURLOPT_RETURNTRANSFER, true);
    		curl_setopt($curl, CURLOPT_HTTPHEADER, array("PRIVATE-TOKEN:". $this->token , "Content-type: application/json"));
    		curl_setopt($curl, CURLOPT_POST, true);
    		curl_setopt($curl, CURLOPT_POSTFIELDS, $content);
    		$json_response = curl_exec($curl);
    		$status = curl_getinfo($curl, CURLINFO_HTTP_CODE);
    		if ( $status != 200 && $status != 201 ) {

    			$Error = "Error: call to URL $url failed with status $status, response $json_response, curl_error " .curl_error($curl) . ", curl_errno " . curl_errno($curl);
    			return $Error;
    		}else{
    			return $json_response;
    		}
    		curl_close($curl);
  	}
}

?>
