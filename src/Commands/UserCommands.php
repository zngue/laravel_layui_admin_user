<?php


namespace Zngue\User\Commands;


use Illuminate\Console\Command;
use Illuminate\Support\Facades\DB;
use Zngue\User\Service\toolesService;

class UserCommands extends Command
{

    protected $signature="zng:user";
    protected $description="发布用户数据以及配置文件";

    public function handle(){
        $this->call('vendor:publish', [ '--provider' => 'Spatie\Permission\PermissionServiceProvider'] );
        $this->call("vendor:publish",['--provider'=>'Zngue\User\UserService']);
        $file = __DIR__.'/../../sql/users.sql';
        $data=array(
            'dbhost'=>config('database.connections.mysql.host'),
            'dbuser'=> config('database.connections.mysql.username'),
            'dbpw'=>config('database.connections.mysql.password'),
            'dbname'=>config('database.connections.mysql.database')
        );
        $tool=new toolesService($data);
        $data =$tool->import_data($file,config('database.connections.mysql.prefix'));
        echo $data['info'];
    }

    public function put_in(Request $request){
      /*  $sql_name = $_FILES['file']['name'];
        $path = public_path();

        $file_name = $path.'\\'.$sql_name;  //要导入的SQL文件名
        $file_name = str_replace('\\','/',$file_name);
        //print_r($file_name);

        $DB_HOST = getenv('DB_HOST');
        $DB_DATABASE = getenv('DB_DATABASE'); //从配置文件中获取数据库信息
        $DB_USERNAME = getenv('DB_USERNAME');
        $DB_PASSWORD = getenv('DB_PASSWORD');

        set_time_limit(0); //设置超时时间为0，表示一直执行。当php在safe mode模式下无效，此时可能会导致导入超时，此时需要分段导入
        $fp = @fopen($file_name, "r") or die("不能打开SQL文件 $file_name");//打开文件
        //print_r($fp);exit;
        @$conf = mysqli_connect($DB_HOST, $DB_USERNAME, $DB_PASSWORD,$DB_DATABASE) or die("不能连接数据库 $DB_HOST");//连接数据库
        echo "<p>正在清空数据库,请稍等....<br>";
        $result = mysqli_query($conf,"SHOW tables");


        echo "<br>恭喜你清理MYSQL成功<br>";

        echo "正在执行导入数据库操作<br>";

        $_sql = file_get_contents($file_name);
        $_arr = explode(';', $_sql);
        //dd($_arr);
        foreach ($_arr as $_value) {
            mysqli_query($conf,"SET NAMES 'utf8'");
            mysqli_query($conf,$_value.';');
        }
        echo "<br>导入完成！";*/
    }
}
