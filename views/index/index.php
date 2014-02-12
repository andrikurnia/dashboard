<?php 

$hostname   = '{mop101.hostmop.com:993/imap/ssl/novalidate-cert}INBOX';
$username	= 'cs@edu4indo.com';
$password	= 'edu4indo.com';

/* try to connect */

$imap = imap_open($hostname,$username,$password) or die('Cannot connect to Mail: ' . imap_last_error());

// $folders = imap_list($imap, $hostname, "*");

// // echo '<ul class="navigation">';
// // foreach ($folders as $folder) {
// //     $folder = str_replace($hostname, "", imap_utf7_decode($folder));
// //     echo '<li><a href="'. $folder .'">' . $folder . '</a></li>';
// // }
// // echo "</ul>";


// echo "<br><br><hr>";

$numMessages = imap_num_msg($imap);
$count = 10;

if($numMessages <= $count) { $count = $numMessages; }

echo '<ul class="mail-list">';
for ($i = $numMessages; $i > ($numMessages - $count); $i--) {
    $header = imap_header($imap, $i);

    $fromInfo = $header->from[0];
    $replyInfo = $header->reply_to[0];
 
    $details = array(
        "fromAddr" => (isset($fromInfo->mailbox) && isset($fromInfo->host))
            ? $fromInfo->mailbox . "@" . $fromInfo->host : "",
        "fromName" => (isset($fromInfo->personal))
            ? $fromInfo->personal : "",
        "replyAddr" => (isset($replyInfo->mailbox) && isset($replyInfo->host))
            ? $replyInfo->mailbox . "@" . $replyInfo->host : "",
        "replyName" => (isset($replyTo->personal))
            ? $replyto->personal : "",
        "subject" => (isset($header->subject))
            ? $header->subject : "",
    );
 
    $uid = imap_uid($imap, $i);
    $class = ($header->Unseen == 'U') ? 'unread' : 'readed';
    echo '<li class="'. $class .'">';
        echo '<ul>';
        echo "<li>From : " . $details["fromName"];
        echo " (" . $details["fromAddr"] . ")</li>";
        echo "<li>Subject : " . $details["subject"] . "</li>";
        echo '<li><button class="btn btn-primary btn-xs" onclick="loadXML(\'mail-'.$uid.'\',\''.$uid.'\')">Read</button>';
        echo ' <button class="btn btn-warning btn-xs" onclick="closeMail(\'mail-'.$uid.'\')">Close</button>';
        echo ' <button class="btn btn-danger btn-xs">Delete</button></li>';
        echo '<div id="mail-'.$uid.'" class="mail"></div>';
        echo "</ul>";
    echo "</li>";
}    
echo "</ul>";
echo "<br><br><hr>";

$obj= new receiveMail('cs@edu4indo.com','edu4indo.com','cs@edu4indo.com','mop101.hostmop.com','imap','993',false);

//Connect to the Mail Box
$obj->connect();         //If connection fails give error message and exit

// Get Total Number of Unread Email in mail box
$tot=$obj->getTotalMails(); //Total Mails in Inbox Return integer value

echo "Total Mails:: $tot<br>";

for($i=$tot;$i>0;$i--)
{
    // $head=$obj->getHeaders($i);  // Get Header Info Return Array Of Headers **Array Keys are (subject,to,toOth,toNameOth,from,fromName)
    // echo "Subjects :: ".$head['subject']."<br>";
    // echo "TO :: ".$head['to']."<br>";
    // echo "To Other :: ".$head['toOth']."<br>";
    // echo "ToName Other :: ".$head['toNameOth']."<br>";
    // echo "From :: ".$head['from']."<br>";
    // echo "FromName :: ".$head['fromName']."<br>";
    // echo "<br><br>";
    // echo "<br>*******************************************************************************************<BR>";
    echo $obj->getBody($i);  // Get Body Of Mail number Return String Get Mail id in interger
    
    // $str=$obj->GetAttach($i,"./"); // Get attached File from Mail Return name of file in comma separated string  args. (mailid, Path to store file)
    // $ar=explode(",",$str);
    // foreach($ar as $key=>$value)
    //     echo ($value=="")?"":"Atteched File :: ".$value."<br>";
    echo "<br>------------------------------------------------------------------------------------------<BR>";
    
    //$obj->deleteMails($i); // Delete Mail from Mail box
}
$obj->close_mailbox();   //Close Mail Box