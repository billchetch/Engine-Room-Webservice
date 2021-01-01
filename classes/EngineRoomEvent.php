<?php

class EngineRoomEvent extends \chetch\db\DBObject{
	
	public static function initialise(){
		$t = \chetch\Config::get('EVENTS_TABLE', 'event_log');
		self::setConfig('TABLE_NAME', $t);
		
		$sql = "SELECT * FROM $t";
		self::setConfig('SELECT_SQL', $sql);
		
		self::setConfig('SELECT_DEFAULT_FILTER', "event_source=':event_source' AND created<=':to' AND created>=':from' AND event_type IN (:event_types)");
		self::setConfig('SELECT_DEFAULT_SORT', "id DESC");
	}
	
	public function __construct($rowdata){
		parent::__construct($rowdata);
	}
}
?>