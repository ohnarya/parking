<?php
namespace frontend\controllers;

use yii\web\Controller;
use frontend\models\search\SearchForm;

class SearchController extends Controller
{
    /**
     * Displays homepage.
     *
     * @return mixed
     */
    public function actionIndex()
    {
        $data  = []; // return 
        
        $model = new SearchForm();
        $model->load(\Yii::$app->request->post());
        
        if(!isset($model->query)){
            return $this->render('index',['model'=>$model,'data'=>$data]);
        }
        
        $query = $model->query;
    
        $url = $this->aws_query(array (
            "Operation"   => "ItemSearch",
            "SearchIndex" => "PCHardware",  // Electorics department only
            "Keywords"    => $query
        ));
    
    	try{
    		error_reporting(E_ERROR | E_PARSE);
    		$xml = simplexml_load_file($url);
            $data['result'] = 1;
    		if($xml->Items->TotalResults<1){
    		    $data['result']  = 0;
    		    $data['errors']  = "<strong>No Results for '".$query."' found from Amazon.com.</strong><br><br>";
    		}else{
    		    $data['result'] = true;
    		    $data['content'] = $this->renderPartial('search',['xml'=>$xml]);
    		}
    		
        }catch(Exception $e){
    		$data['result'] = 0;
    		$data['errors'] = "Unexpected Error Occured while communicating to Amazon.com.";
    	} 
    	
        return $this->render('index',['model'=>$model,'data'=>$data]);
    }

    function aws_query($extraparams) {
        $private_key = getenv('AWS_SECRET_KEY');

        $method = "GET";
        $host = "webservices.amazon.com";
        $uri = "/onca/xml";
        $params = array(
            "AssociateTag"     => "AssociateTag",
            "Service"          => "AWSECommerceService",
            "AWSAccessKeyId"   => getenv('AWS_KEY'),  
            "Timestamp"        => gmdate("Y-m-d\TH:i:s\Z"),
            "SignatureMethod"  => "HmacSHA256",
            "SignatureVersion" => "2",
            "Version"          => "2013-08-01"
        );

        foreach ($extraparams as $param => $value) {
            $params[$param] = $value;
        }
        
        ksort($params);
        // sort the parameters
        // create the canonicalized query
        $canonicalized_query = array();
        foreach ($params as $param => $value) {
            $param = str_replace("%7E", "~", rawurlencode($param));
            $value = str_replace("%7E", "~", rawurlencode($value));
            $canonicalized_query[] = $param . "=" . $value;
        }
        $canonicalized_query = implode("&", $canonicalized_query);
        // create the string to sign
        $string_to_sign =
            $method . "\n" .
            $host . "\n" .
            $uri . "\n" .
            $canonicalized_query;
        // calculate HMAC with SHA256 and base64-encoding
        $signature = base64_encode(
            hash_hmac("sha256", $string_to_sign, $private_key, True));
        // encode the signature for the equest
        $signature = str_replace("%7E", "~", rawurlencode($signature));
        // Put the signature into the parameters
        $params["Signature"] = $signature;
        uksort($params, "strnatcasecmp");

        $query = urldecode(http_build_query($params));
        $query = str_replace(' ', '%20', $query);
        $string_to_send = "https://" . $host . $uri . "?" . $query;
        return $string_to_send;
    }    
}
?>