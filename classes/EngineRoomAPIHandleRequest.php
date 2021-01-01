<?php
use chetch\api\APIException as APIException;

class EngineRoomAPIHandleRequest extends chetch\api\APIHandleRequest{
	
	protected function processGetRequest($request, $params){
		$data = array();
		$requestParts = explode('/', $request);
		switch($requestParts[0]){
			case 'test':
				$data = array('response'=>"Engine room test Yeah baby");
				break;

			case 'about':
				$data = static::about();
				break;
			
			default:
				throw new Exception("Unrecognised api request $request");
				break;
			
		}
		return $data;
	}

	protected function processPutRequest($request, $params, $payload){
		
		$data = array();
		$requestParts = explode('/', $request);
		
		switch($requestParts[0]){
			default:
				throw new Exception("Unrecognised api request $request");
		}

		return $data;
	}

	protected function processDeleteRequest($request, $params){
		
		$data = array();
		$requestParts = explode('/', $request);
		
		switch($requestParts[0]){
			default:
				throw new Exception("Unrecognised api request $request");
		}

		return $data;
	}
}
?>