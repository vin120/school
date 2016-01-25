<?php
	error_reporting(0);
	//检查是否已经登录
	function checkLogined()
	{
		if($_SESSION['adminId']=="" && $_COOKIE['adminId']=="")
		{
			alertMes("请先登录","login.php");
		}
	}

	
	//注销
	function logout()
	{
		$_SESSION = array();
		if(isset($_COOKIE[session_name()]))
		{
			setcookie(session_name(),"",time()-1);
		}
		if(isset($_COOKIE['adminId']))
		{
			setcookie("adminId","",time()-1);
		}
		if(isset($_COOKIE['adminName']))
		{
			setcookie("adminName","",time()-1);
		}
		session_destroy();
		header("location:login.php");
	}


	//  得到文件扩展名
	function getExt($filename)
	{
		return strtolower(pathinfo($filename,PATHINFO_EXTENSION));
	}


	//产生唯一字符串
	function getUniName()
	{
		return md5(uniqid(microtime(true),true));
	}

	//删除文件夹
	function delFolder($path)
	{
		$handle=opendir($path);
		while(($item=readdir($handle))!==false)
		{
			if($item!="."&&$item!=".."){
				if(is_file($path."/".$item))
				{
					unlink($path."/".$item);
				}
				if(is_dir($path."/".$item))
				{
					$func=__FUNCTION__;
					$func($path."/".$item);
				}
			}
		}
		closedir($handle);
		rmdir($path);
	}

	//删除文件
	function delFile($filename)
	{
		unlink($filename);
	}

	//打开指定目录
	function readDirectory($path) 
	{
		$handle = opendir ( $path );
		while ( ($item = readdir ( $handle )) !== false )
		{
			//.和..这2个特殊目录
			if ($item != "." && $item != "..") 
			{
				if (is_file ( $path . "/" . $item )) 
				{
					$arr ['file'] [] = $item;
				}
				if (is_dir ( $path . "/" . $item )) 
				{
					$arr ['dir'] [] = $item;
				}
			
			}
		}
		closedir ( $handle );
		return $arr;
	}

	//弹出消息
	function alertMes($mes,$url)
	{
		echo "<script>alert('{$mes}');</script>";
		echo "<script>window.location='{$url}';</script>";
	}

	//分页
	function showPage($page,$totalPage,$where=null,$sep="&nbsp;"){
	$where=($where==null)?null:"&".$where;
	$url = $_SERVER ['PHP_SELF'];
	$index = ($page == 1) ? "首页" : "<a href='{$url}?page=1{$where}'>首页</a>";
	$last = ($page == $totalPage) ? "尾页" : "<a href='{$url}?page={$totalPage}{$where}'>尾页</a>";
	$prevPage=($page>=1)?$page-1:1;
	$nextPage=($Page>=$totalPage)?$totalPage:$page+1;
	$prev = ($page == 1) ? "上一页" : "<a href='{$url}?page={$prevPage}{$where}'>上一页</a>";
	$next = ($page == $totalPage) ? "下一页" : "<a href='{$url}?page={$nextPage}{$where}'>下一页</a>";
	$str = "总共{$totalPage}页/当前是第{$page}页";
	for($i = 1; $i <= $totalPage; $i ++) {
		//当前页无连接
		if ($page == $i) {
			$p .= "[{$i}]";
		} else {
			$p .= "<a href='{$url}?page={$i}{$where}'>[{$i}]</a>";
		}
	}
 	$pageStr=$str.$sep . $index .$sep. $prev.$sep . $p.$sep . $next.$sep . $last;
 	return $pageStr;
	}


	//上传文件
	function uploadFile($fileInfo,$path='./uploads/file')
	{
	//判断错误号
	if($fileInfo['error']===UPLOAD_ERR_OK)
	{
		$ext=getExt($fileInfo['name']);
		//$path='./uploads/file';
		if(!file_exists($path)){
			mkdir($path,0777,true);
			chmod($path,0777);
		}
		$uniName=getUniName();
		$destination=$path.'/'.$uniName.'.'.$ext;
		if(!move_uploaded_file($fileInfo['tmp_name'],$destination)){
			$res['mes']=$fileInfo['name'].'文件移动失败';
		}
		$res['mes']=$fileInfo['name'].'上传成功';
		$res['dest']=$destination;
		return $res;
	}else{
		//匹配错误信息
		switch ($fileInfo ['error']) {
			case 1 :
				$res['mes'] = '上传文件超过了PHP配置文件中upload_max_filesize选项的值';
				break;
			case 2 :
				$res['mes'] = '超过了表单MAX_FILE_SIZE限制的大小';
				break;
			case 3 :
				$res['mes'] = '文件部分被上传';
				break;
			case 4 :
				$res['mes'] = '没有选择上传文件';
				break;
			case 6 :
				$res['mes'] = '没有找到临时目录';
				break;
			case 7 :
			case 8 :
				$res['mes'] = '系统错误';
				break;
		}
		return $res;
	}
}

	//转换文件大小
	function transByte($size) 
	{
		$arr = array ("B", "KB", "MB", "GB", "TB", "EB" );
		$i = 0;
		while ( $size >= 1024 ) {
			$size /= 1024;
			$i ++;
		}
		return round ( $size, 2 ) . $arr [$i];
	}

	//搜索查找并限制显示字数
	function cut_str($string, $length, $dot = ' ...') 
	{ 
	    global $charset; 
		if(strlen($string) <= $length) { 
		return $string; 
		} 
		$string = str_replace(array('&', '"', '<', '>'), array('&', '"', '<', '>'), $string); 
		$strcut = ''; 
		if(strtolower($charset) == 'utf-8') { 
		$n = $tn = $noc = 0; 
		while($n < strlen($string)) { 
		$t = ord($string[$n]); 
		if($t == 9 || $t == 10 || (32 <= $t && $t <= 126)) { 
		$tn = 1; $n++; $noc++; 
		} elseif(194 <= $t && $t <= 223) { 
		$tn = 2; $n += 2; $noc += 2; 
		} elseif(224 <= $t && $t <= 239) { 
		$tn = 3; $n += 3; $noc += 2; 
		} elseif(240 <= $t && $t <= 247) { 
		$tn = 4; $n += 4; $noc += 2; 
		} elseif(248 <= $t && $t <= 251) { 
		$tn = 5; $n += 5; $noc += 2; 
		} elseif($t == 252 || $t == 253) { 
		$tn = 6; $n += 6; $noc += 2; 
		} else { 
		$n++; 
		} 
		if($noc >= $length) { 
		break; 
		} 
		} 
		if($noc > $length) { 
		$n -= $tn; 
		} 
		$strcut = substr($string, 0, $n); 
		} else { 
		for($i = 0; $i < $length; $i++) { 
		$strcut .= ord($string[$i]) > 127 ? $string[$i].$string[++$i] : $string[$i]; 
		} 
		} 
		$strcut = str_replace(array('&', '"', '<', '>'), array('&', '"', '<', '>'), $strcut); 
		return $strcut.$dot; 
		} 

		//搜索查找并限制显示字数
		function cut_str_with_string($str, $length=180, $start=0, $special_length=0, $dot='...')
		{
		  $str = htmlspecialchars_decode($str);
		  $str = strip_tags($str);
		  $str = trim($str);
		  $str = preg_replace("/\s(?=\s)/","",$str);
		  $str = preg_replace("/[\n\r\t]/","",$str);
		  $str = preg_replace("/\s/","",$str);
		  $str = preg_replace("/ /","",$str);

		  $str = trim($str);

		  $strlen = mb_strlen($str);
		  $content = '';
		  $sing = 0;
		  $count = 0;

		  if($length > $strlen) {
		    return $str;
		  }
		  if($start >= $strlen) {
		    return '';
		  }

		  if($special_length){
		    if($length < $strlen && ($length > $special_length)){
		      while($special_length != ($count-$start)){
		        if(ord($str[$sing]) > 0xa0) {
		          if(!$start || $start <= $count) {
		            $content .= $str[$sing].$str[$sing+1].$str[$sing+2];
		          }
		          $sing += 3;
		          $count++;
		        }else{
		          if(!$start || $start <= $count) {
		            $content .= $str[$sing];
		          }
		          $sing++;
		          $count++;
		        }
		      }
		    }else{
		      return $str;
		    }
		  }else{
		    while($length != ($count-$start)){
		      if(ord($str[$sing]) > 0xa0) {
		        if(!$start || $start <= $count) {
		          $content .= $str[$sing].$str[$sing+1].$str[$sing+2];
		        }
		        $sing += 3;
		        $count++;
		      }else{
		        if(!$start || $start <= $count) {
		          $content .= $str[$sing];
		        }
		        $sing++;
		        $count++;
		      }
		    }
		  }
		  return $content.$dot;
		}

?>