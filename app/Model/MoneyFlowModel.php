<?php 
namespace App\Model;
use Core\BaseModel;
use Core\PdoHelper;
class MoneyFlowModel extends BaseModel{
	public $fields=array(
		'id'=>'主键',
		'admin_id'=>'被记录人',
		'role_id'=>'角色',
		'trade_no'=>'交易单号',
		'moneyflow_no'=>'资金流水号',
		'change_money'=>'变动金额',
		'trade_type'=>'交易类型',
		'trade_date'=>'交易时间',
		'pretrade_balance'=>'交易前余额',
		'aftertrade_balance'=>'交易后金额',
		'op_id'=>'操作人',
		'op_date'=>'操作时间',
		'is_del'=>'是否可用',
	);
	public $pk='id';
    function __construct($inputPdoHelper = NULL){
        parent::__construct($inputPdoHelper);
        $this->tableName = 'money_flow';
        $this->_validateRuleArray = array(
			'admin_id'=>array('rule'=>'/^-{0,0}[0-9]{1,11}$/','tip'=>'被记录人的值必须是整数且必须是正数,最大长度11'),
			'role_id'=>array('rule'=>'/^-{0,0}[0-9]{1,11}$/','tip'=>'角色的值必须是整数且必须是正数,最大长度11'),
			'trade_no'=>array('rule'=>'/^(.*){1,1}$/','tip'=>'交易单号的值必须是字符且,最大长度100'),
			'moneyflow_no'=>array('rule'=>'/^(.*){1,1}$/','tip'=>'资金流水号的值必须是字符且,最大长度100'),
			'change_money'=>array('rule'=>'/^-{0,1}[0-9]{1,9}\.{0,1}[0-9]{0,2}$/','tip'=>'变动金额的值必须是小数且,最大长度11'),
			'trade_type'=>array('rule'=>'/^-{0,1}[0-9]{1,2}$/','tip'=>'交易类型的值必须是整数且,最大长度2'),
			'trade_date'=>array('rule'=>'/^-{0,1}[0-9]{1,11}$/','tip'=>'交易时间的值必须是整数且,最大长度11'),
			'pretrade_balance'=>array('rule'=>'/^-{0,1}[0-9]{1,9}\.{0,1}[0-9]{0,2}$/','tip'=>'交易前余额的值必须是小数且,最大长度11'),
			'aftertrade_balance'=>array('rule'=>'/^-{0,1}[0-9]{1,9}\.{0,1}[0-9]{0,2}$/','tip'=>'交易后金额的值必须是小数且,最大长度11'),
			'op_id'=>array('rule'=>'/^-{0,0}[0-9]{1,11}$/','tip'=>'操作人的值必须是整数且必须是正数,最大长度11'),
			'op_date'=>array('rule'=>'/^-{0,0}[0-9]{1,11}$/','tip'=>'操作时间的值必须是整数且必须是正数,最大长度11'),
			'is_del'=>array('rule'=>'/^-{0,1}[0-9]{1,1}$/','tip'=>'是否可用的值必须是整数且,最大长度1')
		);

        $this->_testData = array(
			'admin_id'=>0,
			'role_id'=>0,
			'trade_no'=>'无',
			'moneyflow_no'=>'无',
			'change_money'=>0.0,
			'trade_type'=>0,
			'trade_date'=>0,
			'pretrade_balance'=>0.0,
			'aftertrade_balance'=>0.0,
			'op_id'=>0,
			'op_date'=>0,
			'is_del'=>1
		);

    }
	public function insertTest(){
		$sql = "INSERT INTO money_flow (id,admin_id,role_id,trade_no,moneyflow_no,change_money,trade_type,trade_date,pretrade_balance,aftertrade_balance,op_id,op_date,is_del) VALUES (NULL,:admin_id,:role_id,:trade_no,:moneyflow_no,:change_money,:trade_type,:trade_date,:pretrade_balance,:aftertrade_balance,:op_id,:op_date,:is_del)";
        //验证插入的数据是否符合数据库定义的字段规则
        $chkDataArray = $this->validateDbField($this->_testData,$this->_validateRuleArray);
        if($chkDataArray['status']==1)
        {
            $insertResultArray = $this->pdoHelper->setSql($sql)->setParam($chkDataArray['result'])->insert();
            return $insertResultArray;
        }
        return $chkDataArray;
	}
}