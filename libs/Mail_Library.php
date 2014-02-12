<?php 

/**
* MAIL
*/
class Mail_Library
{

	/**
	* IMAP
	* 
	*/

	public $imap = null;

	public function getMailConnection($host, $user, $pass) {
		$this->mail = imap_open('{'. $host .':993/imap/ssl/novalidate-cert}', $user, $pass);
		if(!$this->mail) {
			echo "fail";
			exit;
		}
	}

	public function getBody($uid) {

	    $body = $this->get_part($this->imap, $uid, "TEXT/HTML");
	    // if HTML body is empty, try getting text body
	    if ($body == "") {
	        $body = $this->get_part($this->imap, $uid, "TEXT/PLAIN");
	    }
	    return $body;

	}
	 
	private function get_part($uid, $mimetype, $structure = false, $partNumber = false) {
	    
	    if (!$structure) {
	           $structure = imap_fetchstructure($this->imap, $uid, FT_UID);
	    }
	    if ($structure) {
	        if ($mimetype == $this->get_mime_type($structure)) {
	            if (!$partNumber) {
	                $partNumber = 1;
	            }
	            $text = imap_fetchbody($this->imap, $uid, $partNumber, FT_UID);
	            switch ($structure->encoding) {
	                case 3: return imap_base64($text);
	                case 4: return imap_qprint($text);
	                default: return $text;
	           }
	       }
	 
	        // multipart 
	        if ($structure->type == 1) {
	            foreach ($structure->parts as $index => $subStruct) {
	                $prefix = "";
	                if ($partNumber) {
	                    $prefix = $partNumber . ".";
	                }
	                $data = get_part($this->imap, $uid, $mimetype, $subStruct, $prefix . ($index + 1));
	                if ($data) {
	                    return $data;
	                }
	            }
	        }
	    }
	    return false;

	}
	 
	private function get_mime_type($structure) {

	    $primaryMimetype = array("TEXT", "MULTIPART", "MESSAGE", "APPLICATION", "AUDIO", "IMAGE", "VIDEO", "OTHER");
	 
	    if ($structure->subtype) {
	       return $primaryMimetype[(int)$structure->type] . "/" . $structure->subtype;
	    }
	    return "TEXT/PLAIN";

	} 
}

?>