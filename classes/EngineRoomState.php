<?php

class EngineRoomState extends \chetch\db\DBObject{
	
	public static function initialise(){
		$t = \chetch\Config::get('STATES_TABLE', 'state_log');
		self::setConfig('TABLE_NAME', $t);
		
		$sql = "SELECT * FROM $t";
		self::setConfig('SELECT_SQL', $sql);
		
		self::setConfig('SELECT_DEFAULT_FILTER', "state_source=':state_source' AND state_name=':state_name' AND created<=':to' AND created>=':from'");
		self::setConfig('SELECT_DEFAULT_SORT', "id DESC");
	}
	
	public function __construct($rowdata){
		parent::__construct($rowdata);
	}
}
?>