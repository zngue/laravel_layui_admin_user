<?php


namespace Zngue\User\Service;


class ConstService
{
    public static function pageNum($page=0){
        return !empty($page)?$page:env('',15);
    }
}
