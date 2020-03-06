<?php 

include 'usps_verify_address.php';

$suite = ''; // address suite number, apparment ext.. 
$address_street = ''; // street address 
$state = ''; // add state as 2 letter code TX, TN, NY, CA
$zipcode = ''; // 5 digit zipcode

$VerifyAddress = new USPSShippingVerifyAddress();
$VerifyAddress->VerfyAddress($suite, $address_street, $state, $zipcode);
$VerifyAddress->address_verify; // 0 is unable to verify, 1 is able to verify address    
$VerifyAddress->address_verify_responce_message; // this is the message from the class
$VerifyAddress->XML; // this is the repsonce array here

var_dump($VerifyAddress->XML); usps responce

if($VerifyAddress->address_verify == 1){
    // address verified

}else{
    // unable to verify address

}
