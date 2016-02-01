<?php

/**
 * PHP Client for Flipkart Affilate API-[FLIPSIDE.IO]
 * GitHub: https://github.com/sriharrsha/flipside.io
 * License: MIT License  
 * 
 * @author Sri Harrsha <harrshasri@gmail.com>
 * @version 0.1
 */

namespace developerowl;

chdir(dirname(__DIR__)); //GO TO CURRENT WORKING DIR
require 'vendor/autoload.php';
include("flipsidejsonclient.php");
include("flipsidexmlclient.php");

class FlipsideIO {
    protected $fkAffiliateId;
    protected $fkAffiliateToken;
    protected $responseType;
    protected $apiBaseUrl = 'https://affiliate-api.flipkart.net/affiliate/api/';
    protected $apiRequestUrl;
    protected $verifySsl = false;
    protected $responseCode;
    protected $io;
    protected $client;

    public function __construct($fkAffiliateId, $fkAffiliateToken, $responseType = 'json') {
        $this->fkAffiliateId = $fkAffiliateId;
        $this->fkAffiliateToken = $fkAffiliateToken;
        $this->responseType = $responseType;
        
        //Add the affiliateId and response_type to the base URL to complete it.
        $this->apiRequestUrl.=$this->apiBaseUrl.$this->fkAffiliateId.'.'.$this->responseType;
        
        if ($responseType == 'xml') {
            echo "XML Clients Created";
            $this->io = new FlipsideXMLClient($fkAffiliateId, $fkAffiliateToken);
        } else if ($responseType == 'json') {
            echo "JSON Clients Created";
            $this->io = new FlipsideJSONClient($fkAffiliateId, $fkAffiliateToken);
        } else {
            echo "No Clients Available";
            return null;
        }
    }

    function makeRequest1() {

//        $objName= "Flipside".$this->responseType."Client"; 
//        echo $objName;
        echo get_class($this->io);
        $this->io->makeRequest();
    }

    function returnApiError() {
        switch ($responseCode) {
            case 410: echo 'URL expired';
                break;

            case 401: echo 'API Token or Affiliate Tracking ID invalid';
                break;

            case 403: echo 'Tampered URLThe URL contents are modified from the originally returned value';
                break;
        }
    }

}

//End Of Class


$flip = new FlipsideIO('nathgopin', '0bbdf4bcaafd4ab6879f46c181caade5', 'json');
$flip->makeRequest1();
?>        