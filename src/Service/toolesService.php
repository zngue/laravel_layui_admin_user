<?php
/**
 * Created by PhpStorm.
 * User: Administrator
 * Date: 2018/10/13
 * Time: 10:25
 */
namespace Zngue\User\Service;
class toolesService{
    //数据库信息
    private $dbhost;
    private $dbuser;
    private $dbpw;
    private $dbport;
    private $dbname;
    private $dbcharset;
    private $link;
    private $tablepre;
    public function __construct($data)
    {
        $this->dbhost=isset($data['dbhost'])?$data['dbhost']:'';
        $this->dbuser=isset($data['dbuser'])?$data['dbuser']:'';
        $this->dbpw=isset($data['dbpw'])?$data['dbpw']:'';
        $this->dbport=isset($data['dbport'])?$data['dbport']:'3306';
        $this->dbname=isset($data['dbname'])?$data['dbname']:'';
        $this->dbcharset=isset($data['dbcharset'])?$data['dbcharset']:'utf8';
        $this->tablepre=isset($data['tablepre'])?$data['tablepre']:'';
        $link_info=$this->link_data();
        if(!$link_info['status']){
            return $link_info;
        }
    }

    //链接设置数据库
    protected function link_data(){
        $link=mysqli_connect($this->dbhost,$this->dbuser,$this->dbpw,null,$this->dbport);
        if(!$link)
            return array('status'=>false,'info'=>'数据库连接失败');
        else
            $this->link=$link;
        //mysql 版本
        //获得mysql版本
        $version = mysqli_get_server_info($this->link);
        //设置字符集
        if($version > '4.1' && $this->dbcharset) {
            mysqli_query($link, "SET NAMES {$this->dbcharset}");
        }
        //选择数据库
        mysqli_select_db($this->link,$this->dbname);
    }

    //导数据

    /**
     * @param $dbfile  要导入的sql数据文件
     * @param string $dbfile_table_pre  导入的sql文件的表前缀
     * @return array
     */
    public function import_data($dbfile,$dbfile_table_pre='zq_'){
        if(!file_exists($dbfile)){
            return array('status'=>false,'info'=>'数据库文件不存在');
        }
        $sql = file_get_contents($dbfile);
        $status=$this->_sql_execute($this->link, $sql,$dbfile_table_pre);
        if($status){
//            echo '导入数据库成功';
            return array('status'=>true,'info'=>'导入数据库成功');
        }else{
            return array('status'=>true,'info'=>'导入数据库失败');
//            echo '导入数据库失败';
        }

    }

    /**
     * @param $link  数据库链接
     * @param $sql   要导入的sql语句
     * @param $dbfile_table_pre 导入的sql文件的表前缀
     * @return bool
     */
    protected function _sql_execute($link,$sql,$dbfile_table_pre) {
        $sqls =$this-> _sql_split($link,$sql,$dbfile_table_pre);
        if(is_array($sqls))
        {
            foreach($sqls as $sql)
            {
                if(trim($sql) != '')
                {
                    mysqli_query($link,$sql);
                }
            }
        }
        else
        {
            mysqli_query($link,$sqls);
        }
        return true;
    }


    /**
     * @param $link  表链接对象
     * @param $sql   导入的sql
     * @param $dbfile_table_pre  sql文件中的sql表前缀
     * @return array
     */
    protected function _sql_split($link,$sql,$dbfile_table_pre) {
        if(mysqli_get_server_info($link) > '4.1' && $this->dbcharset)
        {
            $sql = preg_replace("/TYPE=(InnoDB|MyISAM|MEMORY)( DEFAULT CHARSET=[^; ]+)?/", "ENGINE=\\1 DEFAULT CHARSET=".$this->dbcharset,$sql);
        }
        //如果有表前缀就替换现有的前缀
        if($this->tablepre){
            $sql=str_replace($dbfile_table_pre, $this->tablepre, $sql);
        }
        $sql = str_replace("\r", "\n", $sql);
        $ret = array();
        $num = 0;
        $queriesarray = explode(";\n", trim($sql));
        unset($sql);
        foreach($queriesarray as $query)
        {
            $ret[$num] = '';
            $queries = explode("\n", trim($query));
            $queries = array_filter($queries);
            foreach($queries as $query)
            {
                $str1 = substr($query, 0, 1);
                if($str1 != '#' && $str1 != '-') $ret[$num] .= $query;
            }
            $num++;
        }
        return $ret;
    }

}
