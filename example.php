<?php
include_once("class.rackcloudmanager.php");
$Auth = new RackAuth("user","37837487348738478374873482044ea4"); //US
//$Auth = new RackAuth("user","93849324924444443942394293429342"); //UK
//$Auth->setAuthUrl('https://lon.identity.api.rackspacecloud.com/v2.0');

echo ($Auth->auth()?"Auth'd\n":"Auth Failure\n");

print_r($Auth->getToken());

//print_r($Auth->getServiceCatalog());

echo "ORD-compute-1\n";
print_r($Auth->getEndpoint('ORD','compute','1.0'));
echo "DFW-compute-2\n";
print_r($Auth->getEndpoint('DFW','compute','2'));
echo "ORD-compute-2\n";
print_r($Auth->getEndpoint('ORD','compute','2'));
echo "DFW-object-2\n";
print_r($Auth->getEndpoint('DFW','object-store','2'));
echo "DFW-mon-2\n";
print_r($Auth->getEndpoint('DFW','rax:monitor','2'));
echo "DFW-lb-2\n";
print_r($Auth->getEndpoint('DFW','rax:load-balancer','2'));

echo "ORD-object-2\n";
print_r($Auth->getEndpoint('ORD','object-store','2'));
echo "ORD-mon-2\n";
print_r($Auth->getEndpoint('ORD','rax:monitor','2'));
echo "ORD-lb-2\n";
print_r($Auth->getEndpoint('ORD','rax:load-balancer','2'));


/*
echo "<pre>";
$RCS = new RackCloudService($Auth);
$Limits = $RCS->getLimits();
print_r($Limits);
//$NewServer = $RCS->createServer("Gopsop2",2,1,array("My Server Name"=>"Gopssop 2"));


$Servers = $RCS->listServers();
echo Request::getLastError();
//$Server = $RCS->listServer(95872);
print_r($Servers);


//$ServerIps = $RCS->listServerIPs(95872);
//print_r($ServerIps);

//$ServerIps = $RCS->listServerPublicIPs(95872);
//print_r($ServerIps);

//$ServerIps = $RCS->listServerPrivateIPs(95872);
//print_r($ServerIps);
//$Result = $RCS->deleteServer(95872,true);

$RS = new RackCloudServer($Auth);
//$Result = $RS->rebootServer(95872);
//$Result = $RS->rebuildServer(95872,2);
//$Result = $RS->resizeServer(95872,FLAVOR_512);
//$Result = $RS->confirmResizeServer(95872);
//$Result = $RS->revertResizeServer(95872);

$RF = new RackCloudFlavor($Auth);
//$Result = $RF->listFlavors(true);
//$Result = $RF->getFlavorDetails(1);

$RI = new RackCloudImage($Auth);
//$Result = $RI->listImages(false);
//$Result = $RI->getImageDetails(3);
//print_r($Result);

$RB = new RackCloudBackup();
$RB->
*/
?>
