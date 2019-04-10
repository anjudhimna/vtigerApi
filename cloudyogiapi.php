<?php<?php
error_reporting(E_WARNING & ~E_NOTICE & ~E_DEPRECATED); // PRODUCTION
ini_set('display_errors','on'); error_reporting(E_ALL & ~E_NOTICE & ~E_DEPRECATED);   // DEBUGGING


//$c = md5('5ae9719c0d3cf'.'6fDi2P0V8d1gTILE');
//echo $c;


echo $a;

//$response = file_get_contents('https://demo.cycrm.net/webservice.php?operation=getchallenge&username=admin');
$jsonData = json_decode(file_get_contents('https://demo.cycrm.net/webservice.php?operation=getchallenge&username=admin'));

var_dump($jsonData);

die;

echo $jsonData->result->token."</br>";

if($jsonData->result->token){
	$crm_token = $jsonData->result->token;
	$crm_useraccesskey = '6fDi2P0V8d1gTILE';
	
	#######[2]############### login to crm ###################################
	$service_url = "https://demo.cycrm.net/webservice.php";
	$curl = curl_init();
	$curl_post_data = array(
	'operation' => 'login',
	'username' => 'admin',
	'accessKey' => md5($crm_token.$crm_useraccesskey),
	);
	//generate post string
	$post_array = array();
	if(is_array($curl_post_data))
	{		
		foreach($curl_post_data as $key=>$value)
		{
			$post_array[] = urlencode($key) . "=" . urlencode($value);
		}

		$post_string = implode("&",$post_array);

	}
	else 
	{
		$post_string = $curl_post_data;
	}
	echo $post_string."</br>";

	//url-ify the data for the POST
	foreach($curl_post_data as $key=>$value) { $fields_string .= $key.'='.$value.'&'; }
	rtrim($fields_string, '&');

	curl_setopt($curl,CURLOPT_URL, $service_url);
	// return into a variable rather than displaying it
	curl_setopt($curl, CURLOPT_RETURNTRANSFER,true);
	curl_setopt($curl, CURLOPT_POST, true);
	curl_setopt($curl, CURLOPT_POSTFIELDS, $post_string);
	$curl_response = curl_exec($curl);


	$result = curl_getinfo($curl);

	$error = curl_errno($curl);

	//echo "<pre>";print_R($curl);
	//echo "<pre>";print_R($error);


		if(curl_errno($curl))
		{
			
				echo "Error Occured in Curl\n";
				echo "Error number: " .curl_errno($curl) ."\n";
				echo "Error message: " .curl_error($curl)."\n";
			

			
		}
		else
		{
			echo "<pre>";print_r($result);


			#######[2]############### login to crm ###################################
			$service_url = "https://demo.cycrm.net/webservice.php";
			$curl = curl_init();
			$curl_post_data = array(
			'operation' => 'describe',
			'elementType' => 'Leads',
			'sessionName' => md5($crm_token.$crm_useraccesskey),
			);
			//generate post string
			$post_array = array();
			if(is_array($curl_post_data))
			{		
				foreach($curl_post_data as $key=>$value)
				{
					$post_array[] = urlencode($key) . "=" . urlencode($value);
				}

				$post_string = implode("&",$post_array);

			}
			else 
			{
				$post_string = $curl_post_data;
			}
			echo $post_string."</br>";

			//url-ify the data for the POST
			foreach($curl_post_data as $key=>$value) { $fields_string .= $key.'='.$value.'&'; }
			rtrim($fields_string, '&');

			curl_setopt($curl,CURLOPT_URL, $service_url);
			// return into a variable rather than displaying it
			curl_setopt($curl, CURLOPT_RETURNTRANSFER,true);
			curl_setopt($curl, CURLOPT_POST, true);
			curl_setopt($curl, CURLOPT_POSTFIELDS, $post_string);
			$curl_response = curl_exec($curl);


			$result = curl_getinfo($curl);

			$error = curl_errno($curl);

			echo "<pre>";print_R($curl);
			echo "<pre>";print_R($error);
			
		}

echo "<pre>";print_R($curl_response);
	//close connection
	curl_close($curl);
	//$login=  json_decode(file_get_contents('https://demo.cycrm.net/webservice.php?operation=login&username=admin&accessKey='.$acceskey));
	//echo "<pre>";print_R($login);
}




?>
