<?php


namespace Zngue\User\Service;


use Illuminate\Database\Schema\Blueprint;
use Illuminate\Support\Facades\Schema;

class ModuleService
{

    public static function addFiled($table,$data){
        Schema::table($table,function (Blueprint $table) use($data) {
            if (Schema::hasColumn($table,$data['name'])){
                return false;
            }
            $type = $data['type'];
            $res =self::fielTypeArr($type);
            if ($res===false) return false;
            if ($res==1){
                $connet=$table->$type($data['name']);
            }elseif($res==3){
                $connet=$table->$type($data['name'],!empty($data['length'])?$data['length']:null);
            }elseif ($res==2){
                $connet=$table->$type($data['name'],$data['length'],!empty($data['places'])?$data['places']:0 );
            }else{
                return false;
            }
            if (!empty($data['index'])){
                $connet->index($data['name']);
            }
            if (!empty($data['default'])){
                $connet->default($data['default']);
            }
            if ($data['nullable']){
                $connet->nullable();
            }
            $comment =! empty($data['comment'])?$data['comment']:$data['name_alias'];
            $connet->comment($comment);
        });
    }


//    public static function int()


    public static function fielTypeArr($filedType){
        switch ($filedType){
            case 'bigInteger':
            case 'integer':
            case 'mediumInteger':
            case 'smallInteger':
            case 'time':
            case 'timeStamp':
            case 'dateTime':
            case 'date':
            case 'tinyInteger':
            case 'text':
            case 'mediumText':
            case 'longText':
                return 1;
                break;
            case 'decimal':
            case 'float':
            case 'double':
                return 2;
                break;
            case 'string':
                return 3;
                break;
            default:
                return false;
                break;
        }
    }
    public static function delFiled($table,$name){
        if (Schema::hasColumn($table,$name)){
            Schema::table($table,function (Blueprint $blueprint) use ($name) {
                $blueprint->dropColumn($name);
            });
        }
    }


    public static function  changeField($table,$id){


        Schema::table($table,function (Blueprint $blueprint) use ($id) {


        });


    }

    public static function editField(){




    }
}
