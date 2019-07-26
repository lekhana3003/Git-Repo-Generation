<?php
session_start();
function goToAuthUrl()
{
    $client_id = "a10b4ed2c2f76d58fddb";
    $redirect_url = "localhost/real/home.php";
    if ($_SERVER['REQUEST_METHOD'] == 'GET') {
        $url = 'https://github.com/login/oauth/authorize?client_id='. $client_id. "&redirect_url=".$redirect_url."&scope=repo%20user";
        header("location: $url");
    }
}
function goToAuthUrlUser()
{
    $client_id = "a10b4ed2c2f76d58fddb";
    $redirect_url = "localhost/real/home.php";
    if ($_SERVER['REQUEST_METHOD'] == 'GET') {
        $url = 'https://github.com/login/oauth/authorize?client_id='. $client_id. "&redirect_url=".$redirect_url."&scope=user";
        $_SESSION['login']=true;
        header("location: $url");
    }

}
function fetchData()
{
    $client_id = "a10b4ed2c2f76d58fddb";
    $redirect_url = "localhost/real/home.php";
    if ($_SERVER['REQUEST_METHOD'] == 'GET') {
        if (isset($_GET['code'])) {
            $code = $_GET['code'];
            $post = http_build_query(array(
                    'client_id' => $client_id,
                    'redirect_url' => $redirect_url,
                    'client_secret' => '8193d13c78861fbb74a17904084a41d160a1cdb4',
                    'code' => $code,

                ));
        }

        $access_data = file_get_contents("https://github.com/login/oauth/access_token?". $post);
       
        $exploded1 = explode('access_token=', $access_data);
        $exploded2 = explode('&scope=repo%20user', $exploded1[1]);

        $access_token = $exploded2[0];
        $a=explode('&',$access_token);
       $access_token=$a[0];
        

        $opts = [ 'http' => [
                        'method' => 'GET',
                        'header' => [ 'User-Agent: PHP']
                    ]
        ];

         //fetching user data
        $url = "https://api.github.com/user?access_token=$access_token";
        $context = stream_context_create($opts);
        $data = file_get_contents($url, false, $context);

    
        $user_data = json_decode($data, true);
        $username = $user_data['login'];
        $user_id=$user_data['id'];



        //$_SESSION['payload'] = $userPayload;
        $_SESSION['user'] = $username;
            $_SESSION['user_id']=$user_id;
        return $access_token;
    }
    else {
        die('error');
    }
}

function fetchDataUser()
{
    $client_id = "a10b4ed2c2f76d58fddb";
    $redirect_url = "localhost/real/home.php";
    if ($_SERVER['REQUEST_METHOD'] == 'GET') {
        if (isset($_GET['code'])) {
            $code = $_GET['code'];
            $post = http_build_query(array(
                    'client_id' => $client_id,
                    'redirect_url' => $redirect_url,
                    'client_secret' => '8193d13c78861fbb74a17904084a41d160a1cdb4',
                    'code' => $code,

                ));
        }

        $access_data = file_get_contents("https://github.com/login/oauth/access_token?". $post);
       
        $exploded1 = explode('access_token=', $access_data);
        $exploded2 = explode('&scope=user', $exploded1[1]);

        $access_token = $exploded2[0];
        

        $opts = [ 'http' => [
                        'method' => 'GET',
                        'header' => [ 'User-Agent: PHP']
                    ]
        ];

        //fetching user data
       $url = "https://api.github.com/user?access_token=$access_token";
        $context = stream_context_create($opts);
        $data = file_get_contents($url, false, $context);

    
        $user_data = json_decode($data, true);
        $username = $user_data['login'];


        //fetching email data

        //$_SESSION['payload'] = $userPayload;
        $_SESSION['user'] = $username;

        return $username;
    }
    else {
        die('error');
    }
}
?>
<!DOCTYPE html>
<html>
<head>
    <title></title>
</head>
<body>

</body>
</html>