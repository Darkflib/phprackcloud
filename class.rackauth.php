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
	//print_r($post);
	echo "\n\n";

        $Response = Request::post($this->AuthUrl.'/tokens',array('Content-Type' => 'application/json', 'Accept' => 'application/json'),$post,true);
        list($headers,$data) = explode("\r\n\r\n",$Response);
        //print_r($headers);
	//print_r($data);
	$data=json_decode($data,true);
        if($data['access'])
        {
            $this->Token = $data['access']['token'];
            $this->ServiceCatalog = $data['access']['serviceCatalog'];
            return true;
        }
	return false;
    }

    public function getToken()
    {
        return $this->Token;
    }

    public function getUsername()
    {
        return $this->Username;
    }
    
    public function setUsername($Username)
    {
        $this->Username=$Username;
    }

    public function getAPIKey()
    {
        return $this->APIKey;
    }
    
    public function setAPIKey($APIKey)
    {
        $this->APIKey=$APIKey;
    }

    public function getTenantID(){
        return $this->TenantID;
    }

    public function setTenantID($TenantID)
    {
        $this->TenantID=$TenantID;
    }

    public function getServiceCatalog(){
        return $this->ServiceCatalog;
    }


}

?>
