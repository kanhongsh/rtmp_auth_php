<?php

function abort_publish() {
    http_response_code(401);
    exit;
}

function auth_publish() {
    http_response_code(201);
}

//@$name=trim($_POST["name"]);
//@$pass=trim($_POST["pass"]);

//$name = isset($_GET['name']) ? $_GET['name'] : '';
//$pass = isset($_GET['pass']) ? $_GET['pass'] : '';

$name = isset($_POST['name']) ? $_POST['name'] : '';
$pass = isset($_POST['pass']) ? $_POST['pass'] : '';

$savename= "test";
$savepass = "123456";

$savename2= "test1";
$savepass2 = "1234";

echo "name ";
echo $name;
echo "pass ";
echo $pass;

file_put_contents("c:/server/logs/Result1.txt", "name=" . $name . "\r\n", FILE_APPEND);
file_put_contents("c:/server/logs/Result1.txt", "pass=" . $pass . "\r\n", FILE_APPEND);


//如果都不是空值执行数据库查询
if(empty($name) || empty($pass))
{
    echo "串码流不正确 1";
    file_put_contents("c:/server/logs/Result1.txt", "串码流不正确 1\r\n", FILE_APPEND);
    abort_publish();
}
else 
{
    if (strcmp($name, $savename) == 0 && strcmp($pass, $savepass) == 0)
    {
        echo "OK!";
        //header('HTTP/1.0 201 Created');
        file_put_contents("c:/server/logs/Result1.txt", "串码流正确 1\r\n", FILE_APPEND);
        auth_publish();
    }
    else if (strcmp($name, $savename2) == 0 && strcmp($pass, $savepass2) == 0)
    {
        echo "OK!";
        //header('HTTP/1.0 201 Created');
        file_put_contents("c:/server/logs/Result1.txt", "串码流正确 2\r\n", FILE_APPEND);
        auth_publish();
    }
    else
    {
        echo "串码流不正确 2";
        file_put_contents("c:/server/logs/Result1.txt", "串码流不正确 2\r\n", FILE_APPEND);
        abort_publish();
    }
}

?>