<?php



// Make sure that MIME type is set to XML. This will ensure that XML is rendered properly

header('Content-type: application/xml');



// const myUrl = "http://" + publicIp + ":" + port + "/gatherAction";

// If you are using NGROK - edit the path - see below NGROK section for details.

$myUrl = "https://60bc-27-7-127-107.ngrok.io/gatherAction";



function logToConsole($myReq, $url, $method) {

   define('STDOUT', fopen('php://stdout', 'w'));

   fwrite(STDOUT, print_r($method , true));

   fwrite(STDOUT, print_r($url , true));

   fwrite(STDOUT, print_r($myReq , true));

   

}

function initialEML($myUrl) {

   echo "<Response>";

   echo "<Gather input=\"dtmf\" timeout=\"5\" actionOnEmptyResult=\"true\" action=\"{$myUrl}\"> <Say> Welcome to Engage Digital Platform ! </Say> <Say> Please provide your input </Say> </Gather>";

   echo "</Response>";

}



if(preg_match('/gatherAction/', $_SERVER["REQUEST_URI"])) {

   //****************************************/

   // Gather action handler

   //****************************************/

   logToConsole($_REQUEST, $_SERVER["REQUEST_URI"], $_SERVER['REQUEST_METHOD']);

   echo "<Response><Say> Thank you I received input </Say></Response>";

}

else if(preg_match('/statuscallback/', $_SERVER["REQUEST_URI"])) {

   //****************************************/

   // CALL API StatusCallBack webhook handler

   //****************************************/

   logToConsole($_REQUEST, $_SERVER["REQUEST_URI"], $_SERVER['REQUEST_METHOD']);

   echo "";

}

else if(preg_match('/eml/', $_SERVER["REQUEST_URI"])) {

   //******************************************/

   // Initial EML Fetch Handler

   //******************************************/   

   logToConsole($_REQUEST, $_SERVER["REQUEST_URI"], $_SERVER['REQUEST_METHOD']);

   initialEML($myUrl);

}

else {

   //******************************************/

   // Default Handler

   //******************************************/

   logToConsole($_REQUEST, $_SERVER["REQUEST_URI"], $_SERVER['REQUEST_METHOD']);

   initialEML($myUrl);

}

?>