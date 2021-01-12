<?php
use chetch\api\APIException as APIException;

class EngineRoomAPIHandleRequest extends chetch\api\APIHandleRequest{
	
	protected function filterInterval($allrows, $interval){
		if($interval > 0){
			$rows2return = array();
			$prevRow = null;
			foreach($allrows as $r){
				$add2data = false;
				if($prevRow == null){
					$add2data = true;
				} else {
					$pt = strtotime($prevRow['created']);
					$rt = strtotime($r['created']);
					$add2data = (abs($pt - $rt) > $interval);
				}
				if($add2data){
					array_push($rows2return, $r);
					$prevRow = $r;	
				}
			}
		} else {
			$rows2return = $allrows;
		}
		return $rows2return;

	}

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
				if(!isset($params['event_sources']))throw new Exception("No event sources passed in query");
				if(!isset($params['from']))throw new Exception("No from date passed in query");
				if(!isset($params['to']))throw new Exception("No to date passed in query");
				if(!isset($params['event_types']))throw new Exception("No event types passed in query");

				$params['event_sources'] = "'".implode("','", explode(',', $params['event_sources']))."'";
				if($params['event_types'] == '*' || strtoupper($params['event_types']) == 'ALL')$params['event_types'] = implode(',', EngineRoomEventType::getNames());
				$params['event_types'] = "'".implode("','", explode(',', $params['event_types']))."'";
				
				//ignore rows that occur less thatn 'interval' seconds between				
				$interval = empty($params['interval']) ? 0 : $params['interval'];

				$results = EngineRoomEvent::createCollection($params);
				$allrows = EngineRoomEvent::collection2rows($results);
				$data = $this->filterInterval($allrows, $interval);
				break;

			case 'states':
				if(!isset($params['state_source']))throw new Exception("No state source passed in query");
				if(!isset($params['state_name']))throw new Exception("No state name passed in query");
				if(!isset($params['from']))throw new Exception("No from date passed in query");
				if(!isset($params['to']))throw new Exception("No to date passed in query");
				
				//ignore rows that occur less thatn 'interval' seconds between
				$interval = empty($params['interval']) ? 0 : $params['interval'];
				
				$results = EngineRoomState::createCollection($params);
				$allrows= EngineRoomState::collection2rows($results);
				$data = $this->filterInterval($allrows, $interval);
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