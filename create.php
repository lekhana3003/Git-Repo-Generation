<?php

function callAPI($method,$url, $data)
{
   $curl = curl_init($url);
   curl_setopt($curl, CURLOPT_CUSTOMREQUEST, $method);
   curl_setopt($curl, CURLOPT_POSTFIELDS, $data);
      curl_setopt($curl, CURLOPT_RETURNTRANSFER, TRUE);
    curl_setopt($curl, CURLOPT_HTTPHEADER, array(                   
    'Content-Type: application/json',                                                           
    'Content-Length: ' . strlen($data),
         'User-Agent: tryout')                                                               
);
    $result = curl_exec($curl);
   if(!$result){
    die("Connection Failure");
}
$result=json_decode($result,true);

return $result;
   curl_close($curl);
   

    }
function create_files($access_token,$user_name,$repo_name,$path_name,$email_id)
{
    
   
  $url = "https://api.github.com/repos/".$user_name."/".$repo_name."/contents/".$path_name."?access_token=".$access_token;
  echo $url."\n";
    $data_array =array(

                    'message' => "New Reposiory",
                    'committer' => array(
                        "name" =>$user_name,
                        "email"=>$email_id,
                    ),
                    "content" => '' );
       
$update_plan = callAPI("PUT", $url, json_encode($data_array));
//$response = json_decode($update_plan, true);

    }
function create_repo($access_token,$repo_name,$description,$private)
{
  
     $url = "https://api.github.com/user/repos?access_token=".$access_token;
       $data_array = array(                  
       "name"=> $repo_name,
       "description"=> $description,
       "private"=> $private);
$response = callAPI("POST", $url, json_encode($data_array));
//$response = json_decode($update_plan, false);
//echo $response;
$html_url = $response['html_url'];
return $html_url;
    }

if(isset($_GET['create']))
{
   create_files();
}

?>


