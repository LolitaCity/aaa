//layer弹窗
//layui.use('layer', function(){
//	var layer = layui.layer;
//});         
var dialog = {
	error: function(msg, $time)
	{
		$time = $time || 1600;
		layer.msg(msg, {anim: 6, icon: 5, time: $time});
		return false;
	},
	
	loadMsg: function(msg, $time)
	{
		$time = $time || 0
		layer.msg(msg, {icon: 16, time: $time, shade: 0.3});
	},
	
	success: function(msg, time)
	{
		time = time || 1600;
		layer.msg(msg, {icon: 1, time: time});
	},
	
	confirm: function($msg, fun1, $btn1, $btn2, fun2)
	{
		$btn1 = $btn1 || '确认';		$btn2 = $btn2 || '取消';
		layer.confirm($msg, {
			btn: [$btn1, $btn2], title: false
		}, fun1, fun2);
	},
	
	full: function($url)
	{
		layer.close(layer.index);
		index = layer.open({
			type: 2,
			content: $url,
			area: ['320px', '195px'],
			maxmin: true
		});
		layer.full(index);
	},
	
	iframe: function($url, $width, $height, $title)
	{
		$width = $width || '770';	$height = $height || '550';    $title = $title || '操作窗口';
		layer.open({
			type: 2,
			title: $title,
			shadeClose: true,
			shade: 0.8,
			area: [$width + 'px', $height + 'px'],
			content: $url,
		}); 
	},
	
	iframe_close: function($time)
	{
		$time = $time || 800;
		var index = parent.layer.getFrameIndex(window.name); //先得到当前iframe层的索引
		setTimeout(function(){
			parent.layer.close(index);
		}, $time);
	},
	
	simpLog: function($content, $width)
	{
		var $width = $width || 300;
		layer.open({
			type: 1,
			shade: false,
			area: $width + 'px',
			title: false,
			content: '<div style="padding: 5%">' + $content + '</div>',
		});
	},
	
	showImg: function($src, $title)
	{
		var json = {
		  'title': "相片查看",
		  'id': 123, //相册id
		  'start': 0,
		  'data': [
		    {
		      'alt': $title || '图片',
		      'pid': 1,
		      'src': $src,
		    },
		  ]
		};
	  layer.photos({
	    photos: json,
	  });
	},
	
	tip: function($content, $obj, $time)
	{
		layer.tips($content, $obj, {
		  tips: [1, '#3595CC'],
		  time: $time || 2500
		})
	}
	
};

load = '';
//公用的一些方法
var public = {
	ajaxError: function()
	{
		return function(jqXHR, textStatus, errorThrown)
		{
			layer.close(load);
			if (textStatus == 'timeout')
			{
				dialog.error('网络超时，请检查网络是否良好');
			}
			else
			{
				dialog.error('请求异常，请检查网络是否畅通');
			}
		}
	},
	
	/*
	 * ajax提交
	 * @common  是否使用默认的回调函数,默认为true
	 */
	ajax: function(url, data, success, common, type, timeout,  error, dataType)
	{
		dialog.loadMsg('正在提交...');
		error = error || '';  dataType = dataType || 'JSON';  type = type || 'post';  timeout = timeout || 0;  common = common || true;
		$.ajax({
			type: type,
			dataType: dataType,
			url: url,
			data: data,
			traditional:true,
			timeout: timeout,
			success: common ? function(datas){
				public.ajaxSuccess(datas, success);
			} : success,
			error: error ? error : public.ajaxError(),
		});
	},
	
	ajaxSuccess: function(datas, callback)
	{
		if(datas.status)
		{
			dialog.success(datas.message);
			callback(datas);
		}
		else
		{
			dialog.error(datas.message);
		}
	},
	//携带post数据跳转页面
	standardPost: function(url,args) 
    {
        var form = $("<form method='post'></form>");  //在内存中创建form表单
		$(document.body).append(form);  //将创建的form表单添加到body中，否则该函数不工作
        form.attr("action", url);
        for (arg in args)
        {
            var input = $("<input type='hidden'>");
            input.attr("name", arg);
            input.val(args[arg]);
            form.append(input);
        }
        form.submit();
    },
    
    ajaxSubmit: function($form_id, success, $url)
    {
    	$form = $('form#' + $form_id);
    	$url = $url || $form.attr('action');
    	$form.ajaxSubmit({
    		url: $url,
    		beforeSubmit: function(){
    			dialog.loadMsg('正在提交数据...');
    		},
    		success: function(datas){
    			success(datas);
    		},
    		timeout: 0, 
    		dataType: 'JSON',
		});
    },
    
    /*
     * layui分页
     */
    paging: function($current, $count, $size, $href)
    {
    	var $size = $size || 30,
    		$href = $href || location.href;
    	layui.use('laypage', function(){
    		var page = layui.laypage;
    		page.render({
    			elem: 'page',
    			count: $count,
    			limit: $size,
    			curr: $current + 1,
    			layout: ['count', 'prev', 'page', 'next', 'skip'],
    			jump: function(obj, first){
    				if(!first)
    				{
    					layer.load();
    					location.href = public.changeURLArg($href, obj.curr);
    				}
    			}
    		});
    	});
    },
    
    /*
     * 修改URL参数
     */
    changeURLArg: function($url, $arg_val, $arg)
    {
       var $arg = $arg || 'page',
       	   pattern = $arg + '=([^&]*)',
           replaceText = $arg + '=' + $arg_val;
       if($url.match(pattern))  //有对应的参数
       {
           var tmp = '/(' + $arg + '=)([^&]*)/gi'; 
           tmp = $url.replace(eval(tmp), replaceText); 
           return tmp; 
       }
       else  //无对应的参数
       {
       		return $url.match('[\?]') ? $url + '&' + replaceText : $url + '?' + replaceText; 
       } 
    }
}
