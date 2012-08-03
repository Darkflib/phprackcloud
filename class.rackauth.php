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

    private $Token;
    private $ServiceCatalog;

    private $AuthURL;
    private $TenantID;

    public function __construct($Username, $APIKey, $TenantID=null)
    {
        $this->Username=$Username;
        $this->APIKey= $APIKey;
	if (!is_null($TenantID)) $this->TenantID=$TenantID;
        $this->AuthUrl= "https://identity.api.rackspacecloud.com/v2.0"; //set default to US
    }

    public function setAuthUrl($url) {
        $this->AuthUrl = $url;
    }

    public function auth()
    {

        if(!$this->Username || !$this->APIKey)
        throw new Exception('Username or Password cannot be empty');

	$post=array('auth' => array('RAX-KSKEY:apiKeyCredentials' => array('username' => $this->Username, 'apiKey' => $this->APIKey )));
	if (isset($this->TenantID)) $post['auth']['tenantID']=$this->TenantID;
	$post=(json_encode($post));
	print_r($post);
	echo "\n\n";

        $Response = Request::post($this->AuthUrl.'/tokens',array('Content-Type' => 'application/json', 'Accept' => 'application/json'),$post,true);
        list($headers,$data) = explode("\r\n\r\n",$Response);
        //print_r($Headers);
	$data=json_decode($data,true);
        if($data['access'])
        {
            $this->Token = $data['access']['token'];
            $this->ServiceCatalog = $data['access']['serviceCatalog'];
            return true;
        }
	return false;
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
