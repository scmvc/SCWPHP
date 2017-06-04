<?php
$DBCONF = "";

/**
* Db extension
*/
class DB
{

	private $COND 		= 	"";		//		条件

	private $SQL		=	"";		//		SQL语句

	private $TABLE_NAME	=	"";		//		表名称

	private $DBH		=	"";		//		数据库驱动

	private $S 			=	"";		//		字段筛选

	private $LIMIT		=	"";		//		数据条数筛选

	private $GROUP		=	"";		//		数据分组

	private $SORT		=	"";		//		数据排序
	
	/**
	 * DB Extension 构造方法
	 * @param string $M [数据表]
	 */
	function __construct($M="")
	{
		$this->TABLE_NAME = $M;
		$DBConf = require "Config/DBConfig.php";
		global $DBCONF;
		$DBCONF = $DBConf;
		$DBDriver = strtoupper($DBCONF["driver"])."Driver";
		require_once "Library/DataBaseExtension/{$DBDriver}.php";
		$Driver = new $DBDriver();
		$this->DBH = $Driver->DBInit();
	}

	/**
	 * 设置表名
	 * @param [String] $table 表名
	 */
	public function setTable($table){
		$this->TABLE_NAME=$table;
		return $this;
	}

	/**
	 * 数据查询
	 * @return [Array] [返回数据结果]
	 */
	public function get(){
		if($this->S==""){
			$this->S = " * ";
		}
		$this->SQL = "SELECT $this->S FROM $this->TABLE_NAME $this->COND $this->GROUP $this->SORT $this->LIMIT";
		$DB = $this->DBH;
		$DBI = $DB->prepare($this->SQL);
		$DBI->execute();
		return $DBI->fetchAll(PDO::FETCH_ASSOC);
	}

	/**
	 * 查询一条数据
	 * @return Sting 返回数据结果
	 */
	public function find(){
		if($this->S == "")
			$this->S = " * ";
		$this->SQL = "SELECT $this->S FROM $this->TABLE_NAME $this->COND $this->GROUP $this->SORT $this->LIMIT";
		$DB = $this->DBH;
		$DBI = $DB->prepare($this->SQL);
		$DBI->execute();
		return $DBI->fetch(PDO::FETCH_ASSOC);
	}

	/**
	 * 增加一条数据
	 * @param  array $A 需要添加的数据
	 * @return int    [返回受影响的行数]
	 */	
	public function insert($A=""){
		$A_value = "";
		if(is_array($A)){
			$this->S = "";
			foreach ($A as $K => $V) {
				if($this->S == ""){
					$this->S = $K;
					$A_value = "'{$V}'";
				}else{
					$this->S .= ",{$K}";
					$A_value .= ",'{$V}'";
				}
			}
		}else{
			echo "Wanning:: Data not is array";
		}
		$this->SQL = "INSERT INTO $this->TABLE_NAME ($this->S) VALUES($A_value)";
		$DB = $this->DBH;
		$DBI = $DB->prepare($this->SQL);
		$DBI->execute();
		return $DBI->rowCount();
	}

	/**
	 * 数据更新
	 * @param  array $A [需要修改的数据]
	 * @return [int]    [返回受影响的行数 ]
	 */	
	public function update($A=""){
		if($this->COND==""){
			echo "Wanning:: Condition is null";
		}
		$this->S = "";
		if(is_array($A)){
			foreach ($A as $K => $V) {
				if($this->S == "")
					$this->S = "$K = '$V'";
				else
					$this->S.=",$K = '$V'";
			}
		}
		$this->SQL = "UPDATE $this->TABLE_NAME SET $this->S $this->COND";
		$DB = $this->DBH;
		$DBI = $DB->prepare($this->SQL);
		$DBI->execute();
		return $DBI->rowCount();
	}

	/**
	 * 删除数据
	 * @return int 返回受影响的行数
	 */
	public function delete(){
		if($this->COND == "")
			echo "Wanning:: condtion is null";
		$this->SQL = "DELETE FROM $this->TABLE_NAME $this->COND";
		$DB = $this->DBH;
		$DBI = $DB->prepare($this->SQL);
		$DBI->execute();
		return $DBI->rowCount();
	}

	/**
	 * 获取数据条数
	 * @return int 返回数据条数
	 */
	public function count(){
		$this->SQL = "SELECT COUNT(*) FROM $this->TABLE_NAME $this->COND $this->GROUP $this->SORT";
		$DB = $this->DBH;
		$DBI = $DB->prepare($this->SQL);
		$DBI->execute();
		$res = $DBI->fetch();
		return $res[0];
	}

	/**
	 * 数据排序
	 * @param  string $A 字段
	 * @param  string $B 排序规则
	 */
	public function sort($A,$B){
		$this->SORT = "ORDER BY $A $B";
		return $this;
	}

	/**
	 * 条件生成
	 * @param  string $A 字段2
	 * @param  string $B 参数为2时为值 参数为3时为判断符
	 * @param  string $C 值
	 */
	public function where($A,$B,$C=""){
		$this->COND = "";
		if($C=="")
			$this->COND = "WHERE $A = '$B'";
		else
			$this->COND = "WHERE $A $B '$C'";
		return $this;
	}

	/**
	 * 条件生成
	 * @param array $ArrayData 条件  数组
	 */
	public function AW($ArrayData){
		foreach ($ArrayData as $K => $V) {
			if($this->COND == "")
				$this->COND = "WHERE $K = '$V'";
			else
				$this->COND.=" AND $k = '$V'";
		}
		return $this;
	}

	/**
	 * 条件生成
	 * @param  string $A 字段2
	 * @param  string $B 参数为2时为值 参数为3时为判断符
	 * @param  string $C 值
	 */
	public function SW($A,$B,$C=""){
		if($C==""){
			if($this->COND=="")
				$this->COND = "WHERE $A = '$B'";
			else
				$this->COND.=" AND $A = '$B'";
		}else{
			if($this->COND=="")
				$this->COND = "WHERE $A $B '$C'";
			else
				$this->COND.=" AND $A $B '$C'";
		}
		return $this;
	}

	/**
	 * 选择列
	 * @param  string $sel 字段名称   格式为   a,b,c
	 * @return [type]      [description]
	 */
	public function select($sel){
		$this->S = "";
		$this->S = " ".$sel." ";
		return $this;
	}

	/**
	 * 数据选择
	 * @param  int $A 开始
	 * @param  int $B 条数
	 */
	public function limit($A,$B){
		$this->LIMIT = "OFFSET $A limit $B";
		return $this;
	}

	/**
	 * 分组
	 * @param  string $A 字段
	 */
	public function group($A){
		$this->GROUP = "GROUP BY $A";
		return $this;
	}

	public function join($sql){
		$this->SQL = "{$sql}";
		$DB = $this->DBH;
		$DBI = $DB->prepare($this->SQL , array(PDO::ATTR_CURSOR=>PDO::CURSOR_FWDONLY));
		$DBI->execute();
		return $DBI->fetchAll(PDO::FETCH_ASSOC);
	}

	public function exec($sql){
		$this->SQL = "{$sql}";
		$DB = $this->DBH;
		return $DB->query($this->SQL);
	}
}