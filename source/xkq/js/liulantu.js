/**
 * 浏览图
 * @method Browsediagram
 * @param intlet [流量入口] 1 -销量  2-  3-复购   4- 预定  5-预约
 * @param tasktype [任务分类]
 * @param id 被修改的id
 * @param ul 图片地址
 **/
function  Browsediagram(tasktype,intlet,id,$ul){
	var liulan = $(""+id+"");
	if(parseInt(tasktype) == 1 || parseInt(tasktype) == 3 ){
		switch (parseInt(intlet)){
			case 1:
			    liulan.attr({"src":$ul+"apptaobaoappziran.jpg"});
                liulan.attr({"onclick":'Kai(\''+$ul+'apptaobaoappziran.jpg\')'});
				break;
			case 2:
			    liulan.attr({"src":$ul+"pctaobaoziran.png"});
                liulan.attr({"onclick":'Kai(\''+$ul+'pctaobaoziran.png\')'});
				break;
			case 3:
			    liulan.attr({"src":$ul+"apptaokouling.png"});
                liulan.attr({"onclick":'Kai(\''+$ul+'apptaokouling.png\')'});
			    break;
			case 4:
			    liulan.attr({"src":$ul+"apptaobaozhitongche.png"});
                liulan.attr({"onclick":'Kai(\''+$ul+'apptaobaozhitongche.png\')'});
			    break;
			case 5:
			    liulan.attr({"src":$ul+"pctaobaozhitongche.jpg"});
                liulan.attr({"onclick":'Kai(\''+$ul+'pctaobaozhitongche.jpg\')'});
			    break;
			default:
				break;
		}
	}
	if(parseInt(tasktype) == 4 || parseInt(tasktype) == 5 ){
		switch (parseInt(intlet)){
			case 1:
			    liulan.attr({"src":$ul+"apptaobaoappziran.jpg"});
                liulan.attr({"onclick":'Kai(\''+$ul+'apptaobaoappziran.jpg\')'});
				break;
			case 2:
			    liulan.attr({"src":$ul+"pctaobaoziran.png"});
                liulan.attr({"onclick":'Kai(\''+$ul+'pctaobaoziran.png\')'});
				break;
			case 3:
			    liulan.attr({"src":$ul+"apptaokouling.png"});
                liulan.attr({"onclick":'Kai(\''+$ul+'apptaokouling.png\')'});
			    break;
			case 4:
			    liulan.attr({"src":$ul+"apptaobaozhitongche.png"});
                liulan.attr({"onclick":'Kai(\''+$ul+'apptaobaozhitongche.png\')'});
			    break;
			case 5:
			    liulan.attr({"src":$ul+"pctaobaozhitongche.jpg"});
                liulan.attr({"onclick":'Kai(\''+$ul+'pctaobaozhitongche.jpg\')'});
			    break;
			default:
				break;
		}
	}
}
/**
 * 浏览图(订单截图)
 * @method Browsediagram01
 * @param intlet [流量入口] 1 -销量  2-  3-复购   4- 预定  5-预约
 * @param tasktype [任务分类]
 * @param id 被修改的id
 * @param ul 图片地址
 **/
function  Browsediagram01(tasktype,intlet,id,$ul){
	var liulan01 = $(""+id+"");
	if(parseInt(tasktype) == 1 || parseInt(tasktype) == 3 || parseInt(tasktype) == 4  || parseInt(tasktype) == 5 ){
		   liulan01.attr({"src":$ul+"dingdan.png"});
           liulan01.attr({"onclick":'Kai(\''+$ul+'dingdan.png\')'});
	}
}
