<?php 

// these can be anywhere in your application make sure to to include before calling class
define("USPS_USER_ID" , ""); // include your USPS USERNAME HERE 
define("DEVLOPENT_USPS" , 1); // SET TO 0 FOR Live Production, 1 FOR Development
define("USPS_LIVE_API_URL" , "https://secure.shippingapis.com/ShippingAPI.dll"); 
define("USPS_TEST_API_URL" , "http://production.shippingapis.com/ShippingAPI.dll"); 

class USPSShippingVerifyAddress
{

//public $user_id;
public $suite;
public $address_street;
public $state;    
public $zipcode;
public $XML;    
public $address_verify;
public $address_verify_responce_message;    
    
public function VerfyAddress(
    $suite, 
    $address_street,
    $state,
    $zipcode
    )
    
{
$this->userId = USPS_USER_ID;
$this->suite = $suite;
$this->address_street = $address_street; 
$this->state = $state;
$this->zipcode = $zipcode;    

$document = <<<EOT
<?xml version="1.0"?>
<AddressValidateRequest USERID="{$this->userId}">
<Revision>1</Revision>
  <Address ID="0">
    <Address1>{$this->suite}</Address1>
    <Address2>$this->address_street</Address2>
    <City/>
    <State>{$this->state}</State>
    <Zip5>{$this->zipcode}</Zip5>
    <Zip4/>
  </Address>
</AddressValidateRequest>
EOT;    

$document = preg_replace( '/[\t\n]/','',$document); 
$document = urlencode ( $document );

if(DEVLOPENT_USPS === 1){

    $url = USPS_TEST_API_URL.'?API=Verify&XML='.$document;	
	
}else{

    $url = USPS_LIVE_API_URL.'?API=Verify&XML='.$document;	
	
}   
    
$responce = file_get_contents($url);
$XML = simplexml_load_string($responce);    
$this->XML = $XML;
    
if(isset($XML->Address->Error->Number)){
    
$this->address_verify = 0;    
$this->address_verify_responce_message = 'unable to verfy';    
    
}else{
    
$this->address_verify = 1;    
$this->address_verify_responce_message = 'verfied';    
    
}    
    
    
    
}    
    
    
} 
