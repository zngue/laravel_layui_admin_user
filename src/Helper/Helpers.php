<?php


namespace Zngue\User\Helper;


trait Helpers
{
    public  function mobileReg(){
        return '/^1[345789][0-9]{9}$/';
    }
    public  function listPageNum(){
        return config('zngue.common.page_num',15);
    }
    public function returnArray($result = [], $message = 'success', $code = 200)
    {
        $res = [
            'statusCode' => $code,
            'message' => $message,
            'data' =>$result
        ];
        return response()->json($res);
    }
    public function returnInfo($r,$data=[]){
        if (!empty($r)){
            return $this->returnArray($data,'操作成功',200);
        }else{
            return $this->returnArray($data,'操作失败',100);
        }
    }
    public function returnSuccess($message='操作成功',$code=200,$data=[]){
        return $this->returnArray($data,$message,$code);
    }
    public function returnError($message='操作失败',$code = 100,$data=[]){
        return $this->returnArray($data,$message,$code);
    }
    public function layTableJson($result=[],$count=0,$code=0,$message='请求成功'){

        $res = [
            'code' => $code,
            'count' => $count,
            'msg'=>$message,
            'data' =>$result
        ];
        return response()->json($res);

    }
    public function layuiReturnArray($result,$message,$code=200,$count=0){
        $res = [
            'code' => $code,
            'msg' => $message,
            'data' =>$result,
            'count'=>$count,
        ];
        return response()->json($res);
    }
    public function returnJson($data=[],$message = 'success', $code = 200 )
    {
        $res = [
            'statusCode' => $code,
            'message' => $message,
            'data'=>$data
        ];
        header('Content-type: text/json');
        return json_encode($res);
    }

    public  function zngView($name=null,$data=[],$merageData=[]){
        //return 'zng::'.$name;

        return view('zng::'.$name,$data,$merageData);
    }





}

