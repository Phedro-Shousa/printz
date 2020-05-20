<?php
class APBDWMC_session {
	var $prefix="_dwbd";
	private static $elem=null;
	private function __construct() {
		$this->prefix="_".hash('crc32b',site_url());
		if(!session_id()){
			session_start ();
		}
		
	}
	private static function &getInstance(){
		if(!self::$elem){
			self::$elem=new self();
		}
		return self::$elem;
	}
	private function _SetSession($name, $obj) {
		if (isset ( $_SESSION [$this->prefix.$name] )) {
			unset ( $_SESSION [$this->prefix.$name] );
		}
		$_SESSION [$this->prefix.$name] = serialize ( $obj );
	
	}
	private function _GetSession($name, $isUnset = false,$default=null) {
		$rData = null;
		if (isset ( $_SESSION [$this->prefix.$name] )) {
			$rData = unserialize ( $_SESSION [$this->prefix.$name] );
			if ($isUnset) {
				unset ( $_SESSION [$this->prefix.$name] );
			}
			return $rData;
		} else {
			return $default;
		}
	}
	private function _IssetSession($sessionName){
		return isset ( $_SESSION [$this->prefix.$sessionName] );
	}
	private function _UnsetSession($name) {
		if (isset ( $_SESSION [$this->prefix.$name] )) {
			unset ( $_SESSION [$this->prefix.$name] );
		}
	}
	static function SetSession($name, $obj) {
		return self::getInstance()->_SetSession($name, $obj);
	}
	static function GetSession($name, $isUnset = false,$default=null) {
		return self::getInstance()->_GetSession($name, $isUnset,$default);
	}
	static function IssetSession($sessionName){
		return self::getInstance()->_IssetSession($sessionName);
	}
	static function UnsetSession($name) {
		return self::getInstance()->_UnsetSession($name);
	}
}
