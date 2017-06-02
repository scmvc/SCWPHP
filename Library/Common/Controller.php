<?php
/**
 *
 */
namespace BaseController;
class Controller {

	protected $logger = "";

	function __construct() {
		if (method_exists($this, 'init')) {
			$this->init();
		}
		global $logger;
		$this->logger = $logger;
	}

	protected function Upload($FILES, $A = "", $B = "") {
		$ReturnFILE = array();
		$FILES = array_keys($FILES);
		foreach ($FILES as $K => $V) {
			$FlodName = "Updata/" . date("Y-m-d");
			if (!is_dir($FlodName)) {
				mkdir($FlodName, 777, true);
			}
			if ($_FILES[$FILES[$K]]["error"] > 0) {
				return false;
			}
			$tempEXT = strstr($_FILES[$FILES[$K]]["name"], ".");
			$FileName = date("YmdHis") . UUID() . $tempEXT;
			move_uploaded_file($_FILES[$FILES[$K]]["tmp_name"], "{$FlodName}/" . $FileName);
			$http_type = ((isset($_SERVER['HTTPS']) && $_SERVER['HTTPS'] == 'on') || (isset($_SERVER['HTTP_X_FORWARDED_PROTO']) && $_SERVER['HTTP_X_FORWARDED_PROTO'] == 'https')) ? 'https://' : 'http://';
			$FileName = $FlodName . "/" . $FileName;
			$ReturnFILE[] = $FileName;
		}
		return $ReturnFILE;
	}

	protected function CURL($URI, $Data = "", $header = "") {
		if (is_array($Data)) {
			$Data = json_encode($Data);
		}
		$ch = curl_init();
		$res = curl_setopt($ch, CURLOPT_URL, $URI);
		curl_setopt($ch, CURLOPT_RETURNTRANSFER, 1);
		curl_setopt($ch, CURLOPT_SSL_VERIFYHOST, FALSE);
		curl_setopt($ch, CURLOPT_SSL_VERIFYPEER, FALSE);
		curl_setopt($ch, CURLOPT_HEADER, 0);
		curl_setopt($ch, CURLOPT_POST, 1);
		curl_setopt($ch, CURLOPT_POSTFIELDS, $Data);
		curl_setopt($ch, CURLOPT_HTTPHEADER, array($header, 'Content-Type: application/json'));
		$result = curl_exec($ch);
		curl_close($ch);
		if ($result == NULL) {
			return 0;
		}
		return $result;
	}
}
