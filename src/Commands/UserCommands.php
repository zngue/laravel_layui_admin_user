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
        //$this->call("vendor:publish",['--provider'=>'Zngue\User\UserService']);
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

}
