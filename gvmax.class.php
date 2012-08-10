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
	public $result;
	
	/**
	 * Constructor that takes in the api token as a parameter
	 * Forward your gvmax HTTP request to a page with this object
	 *
	 * @author Sean Thomas Burke <http://www.seantburke.com>
	 * @param $api //Api from GVMax
	 * @return JSON
	 */
	function __construct($api)
	{
		$this->api = $api;
		
		// stores variables from gvmax HTTP POST
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
	 * Send an SMS
	 *
	 * @author Sean Thomas Burke <http://www.seantburke.com>
	 * @param $number, $text //Api from 
	 * @return JSON
	 */
	public function sms($number, $text)
	{
		//TODO validate number
		
		//if the $number is an array, then send it to the group
		if(is_array($number))
		{
			return $this->groupSMS($number, $text);
		}
		
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
		
		$this->result = json_decode($result, true);
		
		//return the GVMax return {$number: ok}
		return $this->result;
	}
	
	
	/**
	 * will send an SMS to a group
	 *
	 * @author Sean Thomas Burke <http://www.seantburke.com>
	 * @param $array_numbers, $text //Api from 
	 * @return JSON
	 */
	private function groupSMS($array_numbers, $text)
	{
		foreach($array_numbers as $number)
		{
			$result[$i++] = $this->sms($number,$text);
		}
		$this->result = $result;
		return $this->result;
	}
	
	/**
	 * call method will place a call to a phone
	 *
	 * @author Sean Thomas Burke <http://www.seantburke.com>
	 * @param $number //
	 * @return JSON
	 */
	 
	 public function call($number)
	 {
	 //TODO Implement this method
	 }
}

?>