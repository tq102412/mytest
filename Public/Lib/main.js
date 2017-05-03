var public = '/Public';
require.config({
    baseUrl: public+"/Lib",
    paths: {
        "kindeditor": "kindeditor/kindeditor",
        "jquery": "jquery",
        "layer": "layer/layer",
        "pintuer": "pintuer/pintuer",
        //'admin': public+"/Admin/js/admin",
        'respond': 'respond',
        'laydate': 'laydate/laydate',
    },
    shim: {
        "kindeditor":{deps: ['css!Kindeditor/themes/default/default.css']},
        "pintuer":{deps: ['jquery','respond']},
        'layer': {deps: ['css!Layer/skin/layer.css', 'jquery']},
       
        //'admin':{deps: ['css!'+public+'/Admin/css/admin.css','jquery']},
    }
});


function bindkeydown(){

    require(['jquery'],function(){
        $("form input").keydown(function(event){
            event=event || window.event || arguments.callee.caller.arguments[0];

            if((event.keyCode || event.which)==13){
                $('.key13').click();
            }

        });
    });

}



function AjaxForm(obj_str){
   
    var obj = $(obj_str);
    var url = obj.attr('action');
    var data = obj.serialize();
   
    AjaxData(url,data);

}

function set_url(url,time){
    time = time?time:0;
    if(url){
        if(url == 1)
            setTimeout(function(){  window.location.reload()},time);
        else if(url == -1)
            setTimeout(function(){ history.go(-1)},time);
        else
            setTimeout(function(){ window.location.href=url},time);
    }

}


function AjaxData(url,data){

    var index = layer.load(2, {
	  shade: [0.4,'#fff'] //0.1閫忔槑搴︾殑鐧借壊鑳屾櫙
	});

    $.post(url,data,function(data){
        layer.close(index);
        if(data.box == 0){

            layer.msg(data['msg']);
            set_url(data.url,2000);

        }else if(data.box == 1){
            layer.alert(data['msg'], {
                skin: 'layui-layer-molv' //样式类名
                ,closeBtn: 0,
            },function(index){
                layer.close(index);
                set_url(data.url);
            });
            
        }

    });

}

function verifySubmit(obj_str){
		
    $(obj_str).ajaxSubmit(function(){
        
        AjaxForm(obj_str);

    });
    
}