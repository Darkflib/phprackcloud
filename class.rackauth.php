<?php
/**
 * RackSpace Cloud Authentication Manager
 * 
 * @author : Mike Preston (www.sysdom.com) based on original code from Leevo. 
 * @copyright : New BSD License
 * @since : Aug 03, 2012
 * @version : 2.0
 */

//Todo: Add password auth to allow subusers to be used.

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
            $this->TenantID = $data['access']['token']['tenant']['id'];
            return true;
        }
	return false;
    }

    public function getToken()
    {
        return $this->Token;
    }


    public function setToken($Token)
    {
        $this->Token = $Token;
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

    public function getEndpoint($region='ORD', $type='compute', $version=2){
      $catalog=$this->getServiceCatalog();
      foreach ($catalog as $service) {
        if ($service['type']!=$type) continue; // filter out by type
        foreach ($service['endpoints'] as $endpoint) {
          if (isset($endpoint['versionId']) && ($endpoint['versionId']!=$version)) continue;
          else if (isset($endpoint['region']) && ($endpoint['region']!=$region)) continue;
          else if ($type='compute' and $version=1.0) return $endpoint;
          else return $endpoint;
        }
      }
      return false;
    }

}

?>
