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

chdir(dirname(__DIR__));
require 'vendor/autoload.php';

use GuzzleHttp\Client as Client;

class FlipsideJSONClient extends FlipsideIO {

    //JSON Client Constructor
    public function __construct($fkAffiliateId, $fkAffiliateToken) {
        //              super($fkAffiliateId,$fkAffiliateToken);
        //Add the affiliateId and response_type to the base URL to complete it.
        //$this->apiRequestUrl.=$this->apiBaseUrl . '.' . $this->affiliateId . '.' . $this->responseType;
     
        $this->client = new Client();
        echo get_class($this->client);
        echo "JSON EXECTUED CONSTRUCTOR";
    }

    //Make Request to API
    function makeRequest() {
        $request = $this->client->createRequest('GET', $this->apiRequestUrl);
        $request->setHeader('Content-Type', 'application/json');
        $request->setHeader('Cache-Control: no-cache');
        $request->setHeader('Fk-Affiliate-Id', $this->fkAffiliateId);
        $request->setHeader('Fk-Affiliate-Token', $this->fkAffiliateToken);
        $response = $this->client->send($request);
        $responseCode = $response->getStatusCode();

        if (($responseCode == 410) || ($responseCode == 403) || ($responseCode == 401)) {
            returnApiError();
        }
        echo "Harrsha";
        echo $response->xml();
    }

}

//End Of Class
?>