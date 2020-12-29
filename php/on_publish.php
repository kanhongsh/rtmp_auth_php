<?php

function abort_publish() {
    http_response_code(401);
    exit;
}

function auth_publish() {
    http_response_code(201);
}

$pass = isset($_POST['pass']) ? $_POST['pass'] : '';
$name = isset($_POST['name']) ? $_POST['name'] : '';

if (empty($name)) {
    $name = isset($_GET['name']) ? $_GET['name'] : '';
}
if (empty($pass)) {
    $pass = isset($_GET['pass']) ? $_GET['pass'] : '';
}

$savename= array("test"=>"123456", "test1"=>"123456", "publisher"=>"1234", "play"=>"1234", "test3"=>"123", "test4"=>"123");

echo "\nname " . $name;
echo "\npass " . $pass;

file_put_contents("c:/server/logs/PublishResult.txt", "name=" . $name . "\r\n", FILE_APPEND);
file_put_contents("c:/server/logs/PublishResult.txt", "pass=" . $pass . "\r\n", FILE_APPEND);


//如果都不是空值执行数据库查询
if(empty($name))
{
    echo "\nname is empty";
    file_put_contents("c:/server/logs/PublishResult.txt", "name is empty\r\n", FILE_APPEND);
    abort_publish();
}
else 
{
    $bfound = False;
    foreach ($savename as $key=>$value) {
        if (strcasecmp($name, $key) == 0) {
            echo "\nKey=" . $key . ", Value=" . $value;
            $bfound = True;
        }
    }
    if ($bfound)
    {
        echo "\nOK!";
        file_put_contents("c:/server/logs/PublishResult.txt", "name(" . $name .") verify succeed\r\n", FILE_APPEND);
        auth_publish();
    }
    else
    {
        echo "\npass verify failed";
        file_put_contents("c:/server/logs/PublishResult.txt", "pass verify failed\r\n", FILE_APPEND);
        abort_publish();
    }
}

?>