var keditor_options = {
	allowFileManager: true, //  true时显示浏览远程服务器按钮。
	filePostName: 'file', //    指定上传文件form名称。
	pasteType: 1, // 设置粘贴类型，0:禁止粘贴, 1:纯文本粘贴, 2:HTML粘贴
	//filterMode: false,
	minWidth: 670,
	width: 670,
	/*items: [  //配置编辑器的工具栏，其中”/”表示换行，”|”表示分隔符。
		'source', '|', 'undo', 'redo', '|', 'plainpaste', 'addhtml', 'template', 'baidumap', '|', 'image', 'multiimage', 'insertfile', 'table', 'hr', 'link', 'unlink', 'clearhtml', '|', 'fullscreen', '/',
		'formatblock', 'fontname', 'fontsize', '|', 'forecolor', 'hilitecolor', 'bold', 'italic', 'underline', 'strikethrough', 'lineheight', '|', 'justifyleft', 'justifycenter', 'justifyright', 'justifyfull', 'insertorderedlist', 'insertunorderedlist', 'subscript', 'superscript', 'removeformat'
	],*/ 
	afterBlur: function () { //编辑器失去焦点(blur)时执行的回调函数。
		this.sync(); // 将编辑器的HTML数据同步到textarea
	},
    uploadJson: "/Admin/Upload/upload.html",
    fileManagerJson: "/Admin/Upload/manager.html"
};






require(['jquery'],function(){

    $(function(){

        bindkeydown();  //绑定回车提交事件
        selectAll();
        selectednav();
        /*侧边菜单点击切换 */
        $('.leftnav dt').on('click',function(){
            
            var obj = $(this).next();
            var obj1 = $(this).find('i').eq(1);

            if(obj1.hasClass('icon-angle-down'))
            {
                $('.leftnav dt .icon-angle-up').addClass('icon-angle-down').removeClass('icon-angle-up');
                $('.leftnav dd').hide();
                obj.show();
                obj1.removeClass('icon-angle-down').addClass('icon-angle-up');
            }else{
                $('.leftnav dt .icon-angle-up').addClass('icon-angle-down').removeClass('icon-angle-up');
                $('.leftnav dd').hide();
                obj.hide();
                obj1.removeClass('icon-angle-up').addClass('icon-angle-down');
            }
            
        });


        /*删除单条数据 */ 
        $('.mydel').on('click',function(){

            var id = $(this).data('id');
            //询问框
            layer.confirm('您确定要删除这条信息吗？', {
                btn: ['确定','取消'] //按钮
            }, function(){
                AjaxData(self_url+'/ajax_del.html',{id:id});
            });

            

        });


        /*批量删除 */ 
        $('.mydelall').on('click',function(){

            var list = [];
            $('input[name="id"]:checked').each(function(){
                list.push($(this).val());
            });

            

            if(list.length>0){
                var ids = JSON.stringify(list);
                //询问框
                layer.confirm('您确定要删除这些信息吗？', {
                    btn: ['确定','取消'] //按钮
                }, function(){
                    AjaxData(self_url+'/ajax_del.html',{id:ids});
                });

            }else{
                layer.alert("请选择您要删除的数据", {
                    skin: 'layui-layer-molv' //样式类名
                    ,closeBtn: 1,
                });
            }

            

        });


        /*初始化所有在线编辑器 */ 
        if ($('.kindeditor').length) {
            
            require(['kindeditor'], function () {
                var keditor = KindEditor.create('.kindeditor', keditor_options);
            });
        }


        $('.setajax').on('click',function(){
            
            var obj = $(this);
            var method = obj.data('method');
            var id = obj.data('id');
            var value = obj.data('value');
            
            if(method != ''  && id != ''){
                
                var data = {method:method,value:value,id:id};
                AjaxData(self_url+'/ajax_set.html',data);
            }
        })


        /* 绑定上传按钮事件 */
        if ($('.k_btn').length) {
            require(['kindeditor'], function () {
                
                var kbtn = KindEditor.editor(keditor_options);
                $('.k_btn').each(function () {
                    var $btn = $(this);
                    var mode = $btn.data('mode');
                    $btn.click(function () {
                        if (mode == 'image') {
                            
                            kbtn.loadPlugin('image', function () {
                                kbtn.plugin.imageDialog({
                                    imageUrl: $btn.prev('input[type="text"]').val(),
                                    clickFn: function (url, title, width, height, border, align) {
                                        $btn.prev('input[type="text"]').val(url);
                                        kbtn.hideDialog();
                                    }
                                });
                            });
                        } else if (mode == 'file') {
                            kbtn.loadPlugin('insertfile', function () {
                                kbtn.plugin.fileDialog({
                                    fileUrl: $btn.prev('input[type="text"]').val(),
                                    clickFn: function (url, title) {
                                        $btn.prev('input[type="text"]').val(url);
                                        kbtn.hideDialog();
                                    }
                                });
                            });
                        }
                    });
                });
            });
        }

    });

});


/*选中全部多选框*/
function selectAll(){
   
        $('th input[type="checkbox"]').on('click',function(){
            var obj = $(this);
            if(obj.is(':checked'))
                obj.parents('table').find('input[type="checkbox"]').prop('checked',true);
            else
                obj.parents('table').find('input[type="checkbox"]').prop('checked',false);
        })

    
}

function selectednav(){

    $(".leftnav dl dd ul li a").each(function(){
		if($(this).attr("href") == window.location.pathname){
            var obj = $(this);
			obj.addClass("this").siblings().removeClass("this");
            obj.parent().parent().parent().show();
		}
	});	

    //window.location.search
    
}

