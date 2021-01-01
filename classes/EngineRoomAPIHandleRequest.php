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
			

			case 'events':
				if(!isset($params['event_source']))throw new Exception("No event source passed in query");
				if(!isset($params['from']))throw new Exception("No from date passed in query");
				if(!isset($params['to']))throw new Exception("No to date passed in query");
				if(!isset($params['event_types']))throw new Exception("No event types passed in query");

				$params['event_types'] = "'".implode("','", explode(',', $params['event_types']))."'";
				$results = EngineRoomEvent::createCollection($params);
				$data = EngineRoomEvent::collection2rows($results);
				break;

			case 'states':
				if(!isset($params['state_source']))throw new Exception("No state source passed in query");
				if(!isset($params['state_name']))throw new Exception("No state name passed in query");
				if(!isset($params['from']))throw new Exception("No from date passed in query");
				if(!isset($params['to']))throw new Exception("No to date passed in query");
				
				$results = EngineRoomState::createCollection($params);
				$data = EngineRoomState::collection2rows($results);
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