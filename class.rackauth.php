<?php
/**
 * RackSpace Cloud Authentication Manager
 * 
 * @author : Leevio Team (www.leevio.com)
 * @copyright : New BSD License
 * @since : Oct 12, 2009
 * @version : 1.0
 */
class RackAuth
{

    private $Username="";
    private $APIKey="";
    private $XStorageUrl;
    private $XStorageToken;
    private $XAuthToken;
    private $XCDNManagementUrl;
    private $XServerManagementUrl;
    private $AuthURL;
    private $TenantID;

    public function __construct($Username, $APIKey, $TenantID=null)
    {
        $this->Username=$Username;
        $this->APIKey= $APIKey;
	if (!is_null($TenantID)) $this->TenantID=$TenantID;
        $this->AuthUrl= "https://identity.api.rackspacecloud.com/v2.0/tokens"; //set default to US
    }

    public function setAuthUrl($url) {
        $this->AuthUrl = $url;
    }

    public function auth()
    {

        if(!$this->Username || !$this->APIKey)
        throw new Exception('Username or Password cannot be empty');

/*
{
  "auth": {
    "passwordCredentials": {
      "username": "joeuser",
      "password": "mypass"
    },
    "tenantId": "1234"
  }
}
*/

	$post=array('auth' => array('RAX-KSKEY:apiKeyCredentials' => array('username' => $this->Username, 'apiKey' => $this->APIKey )));
	if (isset($this->TenantID)) $post['auth']['tenantID']=$this->TenantID;
	$post=(json_encode($post));
	print_r($post);

        $Response = Request::post($this->AuthUrl,array('Content-Type' => 'application/json', 'Accept' => 'application/json'),$post,true);
        list($Headers,$Data) = explode("\r\n\r\n",$Response);
        //print_r($Headers);
	print_r(json_decode($Data));
        /*if($Headers)
        {
            $this->XAuthToken = $Headers['X-Auth-Token'];
            $this->XStorageToken= $Headers['X-Storage-Token'];
            $this->XStorageUrl = $Headers["X-Storage-Url"];
            $this->XServerManagementUrl = $Headers['X-Server-Management-Url'];
            $this->XCDNManagementUrl = $Headers['X-CDN-Management-Url'];
            return true;
        }
	*/

    }

    function getXAuthToken()
    {
        return $this->XAuthToken;
    }

    function setXAuthToken($AuthToken)
    {
        $this->XAuthToken=$AuthToken;
    }

    function getXStorageUrl()
    {
        return $this->XStorageUrl;
    }
    function setXStorageUrl($Url)
    {
        $this->XStorageUrl = $Url;
    }

    function getXStorageToken()
    {
        return $this->XStorageToken;
    }

    function setXStorageToken($Url)
    {
        $this->XStorageToken=$Url;
    }

    function getXCDNManagementUrl()
    {
        return $this->XCDNManagementUrl;
    }
    
    function setXCDNManagementUrl($Url)
    {
        $this->XCDNManagementUrl=$Url;
    }

    function getXServerManagementUrl()
    {
        return $this->XServerManagementUrl;
    }
    
    function setXServerManagementUrl($Url)
    {
        $this->XServerManagementUrl=$Url;
    }

    function getUsername()
    {
        return $this->Username;
    }
    
    function setUsername($Username)
    {
        $this->Username=$Username;
    }

    function getAPIKey()
    {
        return $this->APIKey;
    }
    
    function setAPIKey($APIKey)
    {
        $this->APIKey=$APIKey;
    }
}

?>
