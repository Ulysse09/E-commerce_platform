<?php

    global $con;
    
        $data=array(
            "sender"=>'+250784824525',
"recipients"=>"0784824525",//number of receiver
"message"=>"helloworld",//message to send to receiver
          );

$url="https://www.intouchsms.co.rw/api/sendsms/.json";
//intourch api
$data=http_build_query($data);
$username="Ulysse";//username of account
$password="NairobiFACE19"; //password of account
//initialize curl()
$ch=curl_init();
curl_setopt($ch,CURLOPT_URL,$url);
curl_setopt($ch,CURLOPT_USERPWD,$username.":".$password);
curl_setopt($ch,CURLOPT_POST,true);
curl_setopt($ch,CURLOPT_RETURNTRANSFER,1);
curl_setopt($ch,CURLOPT_SSL_VERIFYPEER,0);
curl_setopt($ch,CURLOPT_POSTFIELDS,$data);
$result=curl_exec($ch);
$httpcode=curl_getinfo($ch,CURLINFO_HTTP_CODE);
curl_close($ch);
//closing curl()

//echo $result;//print response to screen but not necessary

//echo $httpcode;//print code but not necessary

?>