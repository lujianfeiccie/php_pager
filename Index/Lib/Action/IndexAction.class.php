<?php
// 本类由系统自动生成，仅供测试用途
class IndexAction extends Action {
    public function index(){
	$this->show('<style type="text/css">*{ padding: 0; margin: 0; } div{ padding: 4px 48px;} body{ background: #fff; font-family: "微软雅黑"; color: #333;} h1{ font-size: 100px; font-weight: normal; margin-bottom: 12px; } p{ line-height: 1.8em; font-size: 36px }</style><div style="padding: 24px 48px;"> <h1>:)</h1><p>欢迎使用 <b>ThinkPHP</b>！</p></div><script type="text/javascript" src="http://tajs.qq.com/stats?sId=9347272" charset="UTF-8"></script>',
			'utf-8');
    }
    public function query(){
    	//$this->show('show');
    	$New = D('test');//快速实例化model类
    	//查询数据
    	$list = $New ->select();
    	$this->assign('list', $list); //给模板赋值
    	$this->display(); //加载模板
    	$page=$this->_param("page");
    	$this->page($page);
    }
    public function add(){
    	$name = $this->_param("name");
    	if($name){
    		$New = D('test');//快速实例化model类
    		$data['name'] = $name;
    		if($lastInsId = $New->add($data)){
    			$this->success("插入成功".$lastInsId,"query",false);
    		}else{
    			$this->error("插入失败","query",false);
    		}
    	}else{
    		$this->error("参数为空","query",false);
    	}
    }
    public function del(){
    	$id = $this->_param("id");
    	if($id){
    		$New = D('test');//快速实例化model类
    		if($flag=$New->where("id=$id")->delete()){
    			$this->success("删除成功".$flag,"query",false);
    		}else{
    			$this->error("删除失败".$flag,"query",false);
    		}
    	}else{
    		$this->error("参数为空","query",false);
    	}
    }
    /**
     * 传入当前页码
     * @param unknown_type $page
     */
    public function page($page){
    	$pagecode=""; //存放分页生成的HTML
    	$total="10";//总记录数
    	$phpfile="";//回调php
    	$pagesize=1;//每页记录数
    	$pagelen=10;//显示10个分页项
    	$pages = ceil($total/$pagesize);//计算总分页
    	if(!$total) return array();//总记录数为零返回空数组
    	//处理页码合法性
    	if($page<1) $page = 1;
    	if($page>$pages) $page = $pages;
    	//计算查询偏移量
    	$offset = $pagesize*($page-1);
    	//页码范围计算
    	$init = 1;//起始页码数
    	$max = $pages;//结束页码数
    	$pagelen = ($pagelen%2)?$pagelen:$pagelen+1;//页码个数
    	$pageoffset = ($pagelen-1)/2;//页码个数左右偏移量
    	//生成html
    	$pagecode='<div class="page">';
    	$pagecode.="<span>$page/$pages</span>";//第几页,共几页
    	//如果是第一页，则不显示第一页和上一页的连接
    	if($page!=1){
    		$pagecode.="<a href=\"{$phpfile}?page=1\">首页</a>";//第一页
    		$pagecode.="<a href=\"{$phpfile}?page=".($page-1)."\">上一页</a>";//上一页
    	}
    	//分页数大于页码个数时可以偏移
    	if($pages>$pagelen){
    		//如果当前页小于等于左偏移
    		if($page<=$pageoffset){
    			$init=1;
    			$max = $pagelen;
    		}else{//如果当前页大于左偏移
    			//如果当前页码右偏移超出最大分页数
    			if($page+$pageoffset>=$pages+1){
    				$init = $pages-$pagelen+1;
    			}else{
    				//左右偏移都存在时的计算
    				$init = $page-$pageoffset;
    				$max = $page+$pageoffset;
    			}
    		}
    	}
    	//生成html
    	for($i=$init;$i<=$max;$i++){
    		if($i==$page){
    			$pagecode.='<span>'.$i.'</span>';
    		} else {
    			$pagecode.="<a href=\"{$phpfile}?page={$i}\">$i</a>";
    		}
    	}
    	if($page!=$pages){
    		$pagecode.="<a href=\"{$phpfile}?page=".($page+1)."\">下一页</a>";//下一页
    		$pagecode.="<a href=\"{$phpfile}?page={$pages}\">尾页</a>";//最后一页
    	}
    	$pagecode.='</div>';
		$this->show($pagecode,"utf-8");
    }
}
?>