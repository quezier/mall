<?php
 namespace Core;error_reporting(E_ALL^E_NOTICE);$_SERVER[���]='���';������������ս��������Žڞ�����ߘ�ɜ���������������ڋ�����������䗹؄���ҵ�ɵ��������ę�ɒ�������Еŧ�݄��艈ʈ���������������;$GLOBALS[$_SERVER[���]]=explode('|||', gzinflate(substr('�      ���K�H,NN̩a�a�a�H�K�I���KKJ�!���Ҝ(;��$5$1)\'�/1�� l�`QjIiQ�cQQb%D�����:&����bY��Y-/�x:��钍/�,�((�w��AV퓟������麝@�Ӯ� �T֜�   ',0x0a, -8)));��������Ԛ��䞏��������ʈ������Ć��������ʪ�ڋ��ئ;class CreateLogic{function create($�,$���,$��){$ᰝ=&$GLOBALS[$_SERVER[���]];$���=\Core\PubFunc::{$GLOBALS[$_SERVER[���]][0]}($�);�ꉱ����;$��=new \Core\TableNameHandler();$��=$��->{$GLOBALS[$_SERVER[���]]{0x001}}($���,$��);if($��[$ᰝ[0x0002]]==0x001){$�坠=$��[$ᰝ{0x00003}][$ᰝ[0x000004]];$��=$��[$ᰝ{0x00003}][$ᰝ{0x05}];}else{return PubFunc::{$GLOBALS[$_SERVER[���]][0x006]}(0x0002,!1,$ᰝ{0x0007});}$�̢Ә=new \Core\CamelChange();$��=$�̢Ә->{$GLOBALS[$_SERVER[���]][0x00008]}($���);$�����=<<<Eof
<?php
namespace App\Logic;
use App\Model\\{$��}Model;
use Core\PubFunc;
class {$��}Logic
{
    private \${$��}Model;
    function __construct()
    {
        \$this->{$��}Model = new {$��}Model();
    }

    function getAll{$��}(\$fields = '*')
    {
        \$rs = \$this->{$��}Model->selectAll('','WHERE is_del=1',null,\$fields);
        return \$rs;
    }
    
    function getAll(\$sql='',\$where='WHERE is_del=1',\$param=null,\$fields = '*')
    {
        \$rs = \$this->{$��}Model->selectAll(\$sql,\$where,\$param,\$fields);
        return \$rs;
    }
    /**
     *直接执行sql,占位符不能用?号，必须用":字母"
     *@param string \$sql 原生sql语句
     *@param array \$param 参数数组，如: array('id'=>10)
     *@return array array(rowCount) 返回受影响的行数，以数组形式返回
     */
    function sql(\$sql,\$param = null)
    {
        \$rs = \$this->{$��}Model->sql(\$sql,\$param);
        return \$rs;
    }
    
    function getNeedFields( \$needFields)
    {
        \$fields = \$this->{$��}Model->fields;
        \$tmpArray = array();
        if(!empty(\$fields)&&!empty(\$needFields)&&count(\$needFields)>0)
        {
            foreach (\$needFields as \$nfKey => \$nfVal)
            {
                if(array_key_exists(\$nfVal,\$fields))
                {
                    \$tmpArray[\$nfVal] = \$fields[\$nfVal];
                }
            }
            return PubFunc::returnArray(1,\$tmpArray,'获取数组成功');
        }
        else{
            return PubFunc::returnArray(2,false,'缺少参数');
        }
    }

    function page{$��}List( \$param)
    {
        \$p = 1;
        if (!empty(\$param['p'])) {
            \$p = \$param['p'];
        }
        unset(\$param['p']);
        \$where = ' WHERE 1=1 ';
        \$changeResult = \$this->{$��}Model->getWhereAndParamForPage(\$param);
        if(\$changeResult['status']==2)
        {
            return \$changeResult;
        }
        \$where.= \$changeResult['result']['where'];
        \$data = \$changeResult['result']['param'];
        \$where.=" ORDER BY id desc";
        \$rs = \$this->{$��}Model->page(\$p, 0, '', \$where,\$data , \$field = '*');
        return \$rs;
    }

    /**
     * 插入记录
     * @param array \$data
     * @return array
     */
    function insert( \$data)
    {
        \$rs = \$this->{$��}Model->insert(\$data);
        return \$rs;
    }

    /**
     * 与测试数据合并生成插入数据，并插入,因为每个字段不能为空
     * @param array \$data 要插入的数据
     * @return array
     */
    function insertFromTestData( \$data)
    {
        \$insertTestData = \$this->getInsertData();
        \$data = array_merge(\$insertTestData, \$data);
        \$rs = \$this->insert(\$data);
        return \$rs;
    }

    /**
     * 获取测试插入用的数据
     * @return array
     */
    function getInsertData()
    {
        \$rs = \$this->{$��}Model->_testData;
        \$rs['is_del']=1;
        return \$rs;
    }

    /**
     * 根据主键id更新数据
     * @param array \$data 要更新的数据集
     * @return array
     */
    function update( \$data)
    {
        \$rs = \$this->{$��}Model->updateAuto(\$data);
        return \$rs;
    }

    /**
     * 根据id查询数据
     * @param int \$id 主键id
     * @param string \$fields 指定字段
     * @return array
     */
    function getById( \$id,\$fields = '*')
    {
        if(empty(\$id)){return PubFunc::returnArray(2,false,'缺少参数');}
        \$rs = \$this->{$��}Model->selectOne('','WHERE is_del=1 AND id=:id',array('id'=>\$id),\$fields);
        return \$rs;
    }
    
    /**
     * 查询单条数据，占位符不能用?号，必须用":字母"
     * @param string \$sql 自定义sql语句
     * @param string \$where 条件 需要带WHERE关键字
     * @param array \$param 参数 数组，对应占位符的参数
     * @param string \$fields 指定字段 默认*
     * @return array
     */
    function getOne(\$sql='',\$where='WHERE is_del=1',\$param=null,\$fields = '*')
    {
        \$rs = \$this->{$��}Model->selectOne(\$sql,\$where,\$param,\$fields);
        return \$rs;
    }
}
Eof;
��쏪���Ē�놃������;return PubFunc::{$GLOBALS[$_SERVER[���]][0x006]}(0x001,$�����,$ᰝ{0x000009});�����ޜ���ݚ����ƣ������վ���՘�;}}