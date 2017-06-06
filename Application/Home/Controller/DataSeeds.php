<?php
/**
 *------Create thems Controller------
 *------SCWPHP  Version 1.0.0------
 *------Dev Model Jions------
 *------Create Time 2017-06-05 07:07:55------
 */
namespace App\Home\Controller;
use BaseController\Controller;

class DataSeeds extends Controller {

	function __construct() {

	}

	Public function Index() {
		$data = \App\Home\Model\User::get()->toArray();
		$data = _array_map($data, function ($item, $key, $d) {
			$item['account_identity'] = UUID();
			return $item;
		});
		$this->account($data);
		echo "<p><p>";
		$this->account_detailed($data);
		echo "<p><p>";
		$this->account_password($data);
		echo "<p><p>";
		$this->pay_password($data);
		echo "<p><p>";

		// $this->agent($data);
		// echo "<p><p>";

		//uuid表示生成UUID
	}
	function account($data) {
		$cols = array(
			'account' => 'user_login',
			'identity' => 'account_identity',
			'status' => 'user_status',
		);
		$tdata = $this->toChange($data, $cols);
		toSql($tdata, 'account');
		//print_r($tdata);
		// \App\Home\Model\Account::insert($tdata);
	}
	public function account_password($data) {
		$data = _array_map($data, function ($item, $key, $d) {
			$item['user_pass'] = str_replace('###', '', str_replace('***', '', $item['user_pass']));
			$item['identity'] = UUID();
			$item['m_salt'] = empty($item['m_salt']) ? 'abdec' : $item['m_salt'];
			return $item;
		});
		$cols = array(
			'account_password' => 'user_pass',
			'encryption' => 'm_salt',
			'identity' => 'identity',
			'status' => 1,
			'account_identity' => 'account_identity',
		);
		$tdata = $this->toChange($data, $cols);
		toSql($tdata, 'account_password');
		// \App\Home\Model\Account_password::insert($tdata);
		// print_r($tdata);
	}

	public function pay_password($data) {
		$data = _array_map($data, function ($item, $key, $d) {
			$item['pay_pass'] = str_replace('###', '', str_replace('***', '', $item['pay_pass']));
			$item['p_salt'] = empty($item['p_salt']) ? 'abdec' : $item['p_salt'];
			$item['identity'] = UUID();
			if (empty($item['pay_pass'])) {

			} else {
				return $item;
			}

		});
		$cols = array(
			'pay_password' => 'pay_pass',
			'encryption' => 'p_salt',
			'identity' => 'identity',
			'status' => 1,
			'account_identity' => 'account_identity',
		);
		$tdata = $this->toChange($data, $cols);
		//print_r($tdata);
		toSql($tdata, 'pay_password');
		// \App\Home\Model\Pay_password::insert($tdata);
	}

	public function account_detailed($data) {
		$data = _array_map($data, function ($item, $key, $d) {
			$item['create_time'] = date('Y-m-d H:i:s', $item['create_time']);
			$item['last_login_time'] = date('Y-m-d H:i:s', $item['last_login_time']);
			$item['identity'] = UUID();
			$item['re_ip'] = empty($item['re_ip']) ? '127.0.0.1' : $item['re_ip'];
			$item['last_login_ip'] = empty($item['last_login_ip']) ? '127.0.0.1' : $item['last_login_ip'];
			return $item;
		});
		$cols = array(
			'identity' => 'identity',
			'account_identity' => 'account_identity',
			'register_time' => 'create_time',
			'register_ip' => 're_ip', //360cd.cn
			'last_time' => 'last_login_time', //360cd.cn
			'last_ip' => 'last_login_ip', //360cd.cn
			'grade' => 'user_rank',
			'email' => 'user_email', //360cd.cn
			'phone' => 'mobile', //360cd.cn
			'invitation' => 'invite_code', //360cd.cn
			'available_cash' => 'm_money', //360cd.cn
			'cash' => 'm_money',
			'frozen_cash' => 0.00,
			'open_invitation' => 'invite_code', //360cd.cn
			'img_url' => 'avatar',
		);
		$tdata = $this->toChange($data, $cols);
		toSql($tdata, 'account_detailed');
		//print_r($tdata);
		// \App\Home\Model\Account_detailed::insert($tdata);
	}

	public function agent($data) {
		$cols = array(
			'account_identity' => 'account_identity',
			'parent_userid' => 'parent_id',
		);
		$tdata = $this->toChange($data, $cols);
		//print_r($tdata);
		// DB::table('agent')->insert($tdata);
	}

	function toChange($data, $cols = array()) {
		$tdata = array();
		if (is_array($data) && count($data) > 0) {

			foreach ($data as $k => $v) {
				$row = array();
				foreach ($cols as $key => $value) {
					if (!empty($v[$value])) {
						$row[$key] = $v[$value];
					}
				}
				if (count($row) > 0) {
					$tdata[] = $row;
				}

			}
		}
		return $tdata;
	}

}

function _array_map($data = null, $iterator = null) {
	$newdata = array();
	if (is_array($data) && count($data) > 0) {
		foreach ($data as $k => $v) {
			if (is_callable($iterator)) {
				$newdata[] = call_user_func($iterator, $v, $k, $data);
			}
		}
	}
	return $newdata;
}

function toSql($data, $tbname) {
	$str = '';
	foreach ($data as $key => $value) {
		$fields = array();
		$values = array();
		foreach ($value as $k => $v) {
			$fields[] = $k;
			$values[] = $v;
		}
		$fields = "" . implode(",", $fields) . "";
		$values = "'" . implode("','", $values) . "'";
		$str .= "insert into $tbname ($fields) values($values);";
	}
	file_put_contents(ROOT_PATH . "/" . $tbname . ".sql", $str);

}