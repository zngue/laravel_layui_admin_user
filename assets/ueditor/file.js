


/**
 * [uploadEditor description]
 * @type {[type]}
 */
	var uploadEditor = UE.getEditor("uploadEditor", {
        toolbars: [["insertimage", "attachment"]]
    });
	uploadEditor.ready(function () {
        uploadEditor.addListener("beforeInsertImage", _beforeInsertImage);
        uploadEditor.addListener("afterUpfile",_afterUpfile);
    });
	/**
	 * [uploadImg description]
	 * @return {[type]} [description]
	 */
	function  uploadImg(name,num){
		 var dialog = uploadEditor.getDialog("insertimage");
        dialog.title = '多图上传';
        dialog.render();
        dialog.open();
        img_upload = name;
        upload_num=num

	}
	/**
	 * [file description]
	 * @return {[type]} [description]
	 */
	function file(){
		 var dialog = uploadEditor.getDialog("attachment");
        dialog.title = '附件上传';
        dialog.render();
        dialog.open();
        file_upload = $('.'+name);
	}


	function imgSingle(result) {
        var str='';
        var img_arr=[];
        if (result.length>1){
            alert('请选择一张图片,您已选择'+result.length+"张")
            return false;
        }
        for (j in result){
            str+='<div style="display:inline-block;position: relative">' +
                '<span class="img_del_img" onclick="imgDel(\''+img_upload+'\')" >X</span>'+
                '<img style="width: 120px;height: 120px;object-fit: contain;padding: 5px" src="'+result[j].src+'" />' +
                '</div>'
            img_arr.push(result[j].src)
        }
        img_url=img_arr.join('|')
        var input =$('.'+img_upload+'_input');
        input.val(img_url)
        $('.'+img_upload).html(str)
        if (img_url){
            $('.'+img_upload+'_prevew').show();
        }else {
            $('.'+img_upload+'_prevew').hide();
        }
    }
    function imgArr(result) {

        var str='';
        var img_arr=[];
        for (j in result){
            str+='<div style="display:inline-block;position: relative">' +
                '<span class="img_del_img" onclick="imgDel(\''+img_upload+'\')" >X</span>'+
                '<img style="width: 120px;height: 120px;object-fit: contain;padding: 5px" src="'+result[j].src+'" />' +
                '</div>'
            img_arr.push(result[j].src)
        }
        // alert(str)
        img_url=img_arr.join('|')
        var input =$('.'+img_upload+'_input');
        inputValue = input.val()
        if (inputValue){
            img_url= img_url+'|'+inputValue
        }
        input.val(img_url)
        $('.'+img_upload).append(str)
        if (img_url){
            $('.'+img_upload+'_prevew').show();
        }else {
            $('.'+img_upload+'_prevew').hide();
        }


    }


    // 多图上传动作
	function _beforeInsertImage(t, result) {
	    if (upload_num==0){
            imgArr(result)
        }else {
	        imgSingle(result)
        }

    }
 
    // 附件上传
	function _afterUpfile(t, result) {
        console.log(result)
    }
    function previwImg(file,name) {
	    if (!file){
	        return  false;
        }
        result =file.split('|')
        var str='';
        for (j in result){
            if (result[j]){
                str+='<div style="display:inline-block;position: relative">' +
                    '<span class="img_del_img" onclick="imgDel(\''+name+'\')" >X</span>'+
                    '<img style="width: 120px;height: 120px;object-fit: contain;padding: 5px" src="'+result[j]+'" />' +
                    '</div>'
            }
            $('.'+name).html(str)
        }
        if (result.length>0){
            $('.'+name+'_prevew').show();
        }else {
            $('.'+name+'_prevew').hide();
        }

    }
    function imgDel(name) {
	    var img_arr=[];
        $(event.currentTarget).parent().remove();
        $('.'+name).find('img').each(function () {
	        img_arr.push($(this).attr('src'))
        })
        $('.'+name+'_input').val(img_arr.join('|'))

        input =$('.'+name+'_input').val()
        if (input){
            $('.'+name+'_prevew').show();
        }else {
            $('.'+name+'_prevew').hide();
        }


    }
