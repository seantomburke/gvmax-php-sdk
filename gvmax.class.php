<?php

/**
 * GVMax API
 *
 * This is an API for 
 * 
 * @author Sean Thomas Burke <http://www.seantburke.com/>
 */

class GVMax
{
	private $api; 	//this is the api token from GVMax, set with constructor
	public $type;
	public $number;
	public $text;
	public $error;
	
	/**
	 * Constructor that takes in the api token as a parameter
	 *
	 * @author Sean Thomas Burke <http://www.seantburke.com>
	 * @param $api //Api from GVMax
	 * @return JSON
	 */
	function __construct($api)
	{
		$this->api = $api;
		if($_POST)
		{
			$this->type = $_POST['type'];		
			$this->number = $_POST['number'];
			$this->text = $_POST['text'];
				
			if($_POST['type'] == 'VM')
			{
				$this->link = $_POST['link'];
			}
		}
	}
	
	/**
	 * Send an SMS from 
	 *
	 * @author Sean Thomas Burke <http://www.seantburke.com>
	 * @param $api //Api from 
	 * @return JSON
	 */
	public function sms($text, $number)
	{
		//REST URL for sending sms
		$url = 'https://www.gvmax.com/api/send';
		
		//parameters for call
		$fields = array(
		            'pin'=>urlencode($this->api),
		            'number'=>urlencode($number),
		            'text'=>urlencode($text),
		        );
		        
		//url-ify the data for the POST
		foreach($fields as $key=>$value) 
		{
		 	$fields_string .= $key.'='.$value.'&'; 
		}
		rtrim($fields_string,'&');
		
		$ch = curl_init();
		
		//set the url, number of POST vars, POST data
		curl_setopt($ch,CURLOPT_URL,$url);
		curl_setopt($ch, CURLOPT_RETURNTRANSFER, 1);
		curl_setopt($ch,CURLOPT_POST,count($fields));
		curl_setopt($ch,CURLOPT_POSTFIELDS,$fields_string);
		$result = curl_exec($ch);
		curl_close($ch);
		
		//return the GVMax return {$number: ok}
		return $result;
	}
	
	
	/**
	 * function description
	 *
	 * @author Sean Thomas Burke <http://www.seantburke.com>
	 * @param $api //Api from 
	 * @return JSON
	 */
	public function groupSMS($array_numbers, $text)
	{
		foreach($array_numbers as $number)
		{
			$result .= $this->sms($number,$text);
		}
		return $result;
	}
	
	/**
	 * function description
	 *
	 * @author Sean Thomas Burke <http://www.seantburke.com>
	 * @param $api //Api from 
	 * @return JSON
	 */
	 
	 public function call($number)
	 {
	 //TODO Implement this method
	 }
	 
	 /**
	  * function description
	  *
	  * @author Sean Thomas Burke <http://www.seantburke.com>
	  * @param $api //Api from 
	  * @return JSON
	  */
	  
	  public function getNumber()
	  {
	  	return $this->number;
	  }
}

?>