<?php 
	require_once "include.php";
	session_start();
	checkLogined();

	header("Content-Type: text/html; charset=UTF-8");

	if(isset($_SESSION['adminName']))
	{
		$username =  $_SESSION['adminName'];
	}
	elseif(isset($_COOKIE['adminName']))
	{
		$username =  $_COOKIE['adminName'];
	}

	$table = htmlspecialchars(trim($_GET["table"]));
	$act =  htmlspecialchars(trim($_GET["act"]));
	$ids = htmlspecialchars(trim($_GET["ids"]));
?>





<?php 
	//首页--首页图片
	if($table == 'index_SYTP')
	{
		$ids = trim($_GET["ids"]);
	
		if($ids <6)
		{
			//文件保存目录路径	
			$file_path = '../images/slider';
		}else
		{
			//文件保存目录路径	
			$file_path = '../images/small_slider';
		}

		//文件保存目录URL		'/School/admin/uploads/file'
		$file_url = dirname($_SERVER['PHP_SELF']) . '/uploads/file';

	    //上传文件
	    if(!empty($_FILES))
	    {
	    	if($_FILES['file']['error'] == 0)
	    	{
	    		//得到文件拓展名
	    		$ext = strtolower(pathinfo($_FILES['file']['name'],PATHINFO_EXTENSION));
	    		//判断上传路径是否存在
	    		if(!file_exists($file_path))
	    		{
					mkdir($file_path,0777,true);
					chmod($file_path,0777);
				}
				//得到文件的唯一名字
				$uniName = md5(uniqid(microtime(true),true));
				//拼接文件路径
				$path=$file_path.'/'.$uniName.'.'.$ext;
				//移动文件到指定路径
				move_uploaded_file($_FILES['file']['tmp_name'],$path);

				$name =$uniName.'.'.$ext;
				

			
				//更新
				$sql="update index_SYTP set `id` = '$ids' ,`name`='$name' where id = '$ids' ";
				$result=@mysql_query($sql);
	    	}
	    } 
	    else
	    {
	    	$name = "";
	    }



?>
		<script type="text/javascript" language="javascript">
			window.location.href="index_SYTP.php";
		</script>
<?php 
	}
?>




<?php 
	//首页--资源下载
	if($table == 'index_ZYXZ')
	{
		$title=htmlspecialchars(trim($_POST["name"]));
	    $author = trim($_POST["author"]);
	    date_default_timezone_set('PRC');
	    $times=date("Y-m-d G:i:s");

		//文件保存目录路径		'/var/www/School/admin/uploads/file'
		$file_path = dirname(__FILE__) . '/uploads/file';

		//文件保存目录URL		'/School/admin/uploads/file'
		$file_url = dirname($_SERVER['PHP_SELF']) . '/uploads/file';

	    //上传文件
	    if(!empty($_FILES))
	    {
	    	if($_FILES['file']['error'] == 0)
	    	{
	    		//得到文件拓展名
	    		$ext = strtolower(pathinfo($_FILES['file']['name'],PATHINFO_EXTENSION));
	    		//判断上传路径是否存在
	    		if(!file_exists($file_path))
	    		{
					mkdir($file_path,0777,true);
					chmod($file_path,0777);
				}
				//得到文件的唯一名字
				$uniName = md5(uniqid(microtime(true),true));
				//拼接文件路径
				$path=$file_path.'/'.$uniName.'.'.$ext;
				//移动文件到指定路径
				move_uploaded_file($_FILES['file']['tmp_name'],$path);

				$url = $file_url.'/'.$uniName.'.'.$ext;

				$size = transByte($_FILES['file']['size']);
				
	    	}
	    } 
	    else
	    {
	    	$url = "";
	    }

	    if($act == '')
	    {
			
			$sql="insert into index_ZYXZ (`id`,`title`,`author`,`times`,`url`,`path`,`size`) values(NULL,'$title','$author','$times','$url','$path','$size')";
		    $result=@mysql_query($sql);
		}elseif($act == 'mod')
		{
			//更新
			$sql="update index_ZYXZ set `title` = '$title' ,`author`='$author' ,`times`='$times', `url`='$url',`path`='$path',`size`='$size' where id = '$ids' ";
			$result=@mysql_query($sql);
		}

?>
		<script type="text/javascript" language="javascript">
			window.location.href="index_ZYXZ.php";
		</script>
<?php 
	}
?>

<?php 

 //首页--园区动态
	if($table == 'index_YQDT')
	{
		$title=htmlspecialchars(trim($_POST["name"]));
	    $content=$_POST["content"];
	    $author = trim($_POST["author"]);
	    date_default_timezone_set('PRC');
	    $times=date("Y-m-d G:i:s");
	    if($act == '')
	    {
			
			$sql="insert into index_YQDT (`id`,`title`,`author`,`content`,`times`) values(NULL,'$title','$author','$content','$times')";
	    	$result=@mysql_query($sql);
		}elseif($act == 'mod')
		{
			
			$sql="update index_YQDT set `title` = '$title' ,`author`='$author' ,`content`='$content',`times`='$times' where id = '$ids' ";
	    	$result=@mysql_query($sql);
		}
?>
		<script type="text/javascript" language="javascript">
			window.location.href="index_YQDT.php";
		</script>
<?php 
	}
?>


<?php 
	//首页--通知公告
	if($table == 'index_TZGG')
	{
		$title=htmlspecialchars(trim($_POST["name"]));
	    $content=$_POST["content"];
	    $author = trim($_POST["author"]);
	    date_default_timezone_set('PRC');
	    $times=date("Y-m-d G:i:s");
	    if($act == '')
	    {
			
			$sql="insert into index_TZGG (`id`,`title`,`author`,`times`,`content`) values(NULL,'$title','$author','$times','$content')";
		    $result=@mysql_query($sql);
		}elseif($act == 'mod')
		{

			
			$sql="update index_TZGG set `title` = '$title' ,`author`='$author' ,`content`='$content',`times`='$times' where id = '$ids' ";
	    	$result=@mysql_query($sql);
		}

?>
		<script type="text/javascript" language="javascript">
			window.location.href="index_TZGG.php";
		</script>
<?php
	}
?>


<?php 
	//首页--创业政策
	if($table == 'index_CYZC')
	{

		$title=htmlspecialchars(trim($_POST["name"]));
	    $content=$_POST["content"];
	    $author = trim($_POST["author"]);
	    date_default_timezone_set('PRC');
	    $times=date("Y-m-d G:i:s");

		//文件保存目录路径		'/var/www/School/admin/uploads/file'
		$file_path = dirname(__FILE__) . '/uploads/file';

		//文件保存目录URL		'/School/admin/uploads/file'
		$file_url = dirname($_SERVER['PHP_SELF']) . '/uploads/file';

	    //上传文件
	    if(!empty($_FILES))
	    {
	    	if($_FILES['file']['error'] == 0)
	    	{
	    		//得到文件拓展名
	    		$ext = strtolower(pathinfo($_FILES['file']['name'],PATHINFO_EXTENSION));
	    		//判断上传路径是否存在
	    		if(!file_exists($file_path))
	    		{
					mkdir($file_path,0777,true);
					chmod($file_path,0777);
				}
				//得到文件的唯一名字
				$uniName = md5(uniqid(microtime(true),true));
				//拼接文件路径
				$path=$file_path.'/'.$uniName.'.'.$ext;
				//移动文件到指定路径
				move_uploaded_file($_FILES['file']['tmp_name'],$path);

				$url = $file_url.'/'.$uniName.'.'.$ext;

				$size = transByte($_FILES['file']['size']);
	    	}
	    }
	    else
	    {
	    	$url = "";
	    }

	    if($act == '')
	    {
			
			$sql="insert into index_CYZC (`id`,`title`,`author`,`times`,`url`,`path`,`size`,`content`) values(NULL,'$title','$author','$times','$url','$path','$size','$content')";
	    	$result=@mysql_query($sql);
		}elseif($act == 'mod')
		{

			//更新
			$sql="update index_CYZC set `title` = '$title' ,`author`='$author' ,`times`='$times', `url`='$url',`path`='$path',`size`='$size',`content`='$content' where id = '$ids' ";
			$result=@mysql_query($sql);
		}
?>
		<script type="text/javascript" language="javascript">
			window.location.href="index_CYZC.php";
		</script>
<?php 
	}
?>

<?php  
	//首页--创业团队
	if($table == 'index_CYTD')
	{
		$title=htmlspecialchars(trim($_POST["name"]));
	    $author = trim($_POST["author"]);
	    $content = $_POST['content'];
	    date_default_timezone_set('PRC');
	    $times=date("Y-m-d G:i:s");

	    if($act == '')
	    {
			
			$sql="INSERT INTO index_CYTD(`id`,`title`,`author`,`times`,`content`)VALUES(NULL,'$title','$author','$times','$content')";
		    $result=@mysql_query($sql);
		}elseif($act == 'mod')
		{
			
			$sql="update index_CYTD set `title` = '$title' ,`author`='$author' ,`content`='$content',`times`='$times' where id = '$ids' ";
			$result=@mysql_query($sql);
		}

?>
		<script type="text/javascript" language="javascript">
			window.location.href="index_CYTD.php";
		</script>
<?php
	}
?>




<?php  
	//园区概括----园区简介
	if($table == 'YQ_about')
	{
		$content = $_POST['content'];
		date_default_timezone_set('PRC');
	    $times=date("Y-m-d G:i:s");


		
 		$sql  = "SELECT * FROM `YQ_about`";
        $result = fetchOne($sql);

        if($result == 0 )
        {
        	$sql = "INSERT INTO YQ_about(`id`,`times`,`content`)VALUES(NULL,'$times','$content')";
        	$result=@mysql_query($sql);
        }else
        {
        	$sql = "UPDATE `YQ_about` SET `times` ='$times' ,`content`='$content' WHERE `id` = '1' ";
        	$result=@mysql_query($sql);
        }
?> 
		<script type="text/javascript" language="javascript">
			window.location.href="YQ_about.php";
		</script>
<?php 
	}
?>



<?php  
	//园区概括----机构设置
	if($table == 'YQ_set')
	{
		$content = $_POST['content'];
		date_default_timezone_set('PRC');
	    $times=date("Y-m-d G:i:s");


	
 		$sql  = "SELECT * FROM `YQ_set`";
        $result = fetchOne($sql);

        if($result == 0 )
        {
        	$sql = "INSERT INTO YQ_set(`id`,`times`,`content`)VALUES(NULL,'$times','$content')";
        	$result=@mysql_query($sql);
        }else
        {
        	$sql = "UPDATE `YQ_set` SET `times` ='$times' ,`content`='$content' WHERE `id` = '1' ";
        	$result=@mysql_query($sql);
        }
?> 
		<script type="text/javascript" language="javascript">
			window.location.href="YQ_set.php";
		</script>
<?php 
	}
?>




<?php 

 //院士工作站--院士简介
	if($table == 'YS_about')
	{
		$title=htmlspecialchars(trim($_POST["name"]));
	    $content=$_POST["content"];
	    $author = trim($_POST["author"]);
	    date_default_timezone_set('PRC');
	    $times=date("Y-m-d G:i:s");

		if($act == '')
	    {
		
			$sql="insert into YS_about (`id`,`title`,`author`,`content`,`times`) values(NULL,'$title','$author','$content','$times')";
		    $result=@mysql_query($sql);
			}elseif($act == 'mod')
			{
				
				$sql="update YS_about set `title` = '$title' ,`author`='$author' ,`content`='$content',`times`='$times' where id = '$ids' ";
		    	$result=@mysql_query($sql);
			}

?>
		<script type="text/javascript" language="javascript">
			window.location.href="YS_about.php";
		</script>
<?php 
	}
?>



<?php 

 //院士工作站--建设进展
	if($table == 'YS_build')
	{
		$title=htmlspecialchars(trim($_POST["name"]));
	    $content=$_POST["content"];
	    $author = trim($_POST["author"]);
	    date_default_timezone_set('PRC');
	    $times=date("Y-m-d G:i:s");

		if($act == '')
	    {
			
			$sql="insert into YS_build (`id`,`title`,`author`,`content`,`times`) values(NULL,'$title','$author','$content','$times')";
		    $result=@mysql_query($sql);
		}elseif($act == 'mod')
		{
			
			$sql="update YS_build set `title` = '$title' ,`author`='$author' ,`content`='$content',`times`='$times' where id = '$ids' ";
	    	$result=@mysql_query($sql);
		}


		
?>
		<script type="text/javascript" language="javascript">
			window.location.href="YS_build.php";
		</script>
<?php 
	}
?>



<?php  
	//园区概括----园区简介
	if($table == 'CY_about')
	{
		$content = $_POST['content'];
		date_default_timezone_set('PRC');
	    $times=date("Y-m-d G:i:s");


		
 		$sql  = "SELECT * FROM `CY_about`";
        $result = fetchOne($sql);

        if($result == 0 )
        {
        	$sql = "INSERT INTO CY_about(`id`,`times`,`content`)VALUES(NULL,'$times','$content')";
        	$result=@mysql_query($sql);
        }else
        {
        	$sql = "UPDATE `CY_about` SET `times` ='$times' ,`content`='$content' WHERE `id` = '1' ";
        	$result=@mysql_query($sql);
        }
?> 
		<script type="text/javascript" language="javascript">
			window.location.href="CY_about.php";
		</script>
<?php 
	}
?>




<?php 
	//创业工厂--入驻通知
	if($table == 'CY_news')
	{

		$title=htmlspecialchars(trim($_POST["name"]));
	    $content=$_POST["content"];
	    $author = trim($_POST["author"]);
	    date_default_timezone_set('PRC');
	    $times=date("Y-m-d G:i:s");

		//文件保存目录路径		'/var/www/School/admin/uploads/file'
		$file_path = dirname(__FILE__) . '/uploads/file';

		//文件保存目录URL		'/School/admin/uploads/file'
		$file_url = dirname($_SERVER['PHP_SELF']) . '/uploads/file';

	    //上传文件
	    if(!empty($_FILES))
	    {
	    	if($_FILES['file']['error'] == 0)
	    	{
	    		//得到文件拓展名
	    		$ext = strtolower(pathinfo($_FILES['file']['name'],PATHINFO_EXTENSION));
	    		//判断上传路径是否存在
	    		if(!file_exists($file_path))
	    		{
					mkdir($file_path,0777,true);
					chmod($file_path,0777);
				}
				//得到文件的唯一名字
				$uniName = md5(uniqid(microtime(true),true));
				//拼接文件路径
				$path=$file_path.'/'.$uniName.'.'.$ext;
				//移动文件到指定路径
				move_uploaded_file($_FILES['file']['tmp_name'],$path);

				$url = $file_url.'/'.$uniName.'.'.$ext;

				$size = transByte($_FILES['file']['size']);
	    	}
	    }
	    else
	    {
	    	$url = "";
	    }

	    if($act == '')
	    {
			
			$sql="insert into CY_news (`id`,`title`,`author`,`times`,`url`,`path`,`size`,`content`) values(NULL,'$title','$author','$times','$url','$path','$size','$content')";
		    $result=@mysql_query($sql);
		}elseif($act == 'mod')
		{
			
			
			//更新
			$sql="update CY_news set `title` = '$title' ,`author`='$author' ,`times`='$times', `url`='$url',`path`='$path',`size`='$size',`content`='$content' where id = '$ids' ";
			$result=@mysql_query($sql);
		}

?>
		<script type="text/javascript" language="javascript">
			window.location.href="CY_news.php";
		</script>
<?php 
	}
?>



<?php 

 //创业工厂---入驻团队经营情况
	if($table == 'CY_teamnews')
	{
		$title=htmlspecialchars(trim($_POST["name"]));
	    $content=$_POST["content"];
	    $author = trim($_POST["author"]);
	    date_default_timezone_set('PRC');
	    $times=date("Y-m-d G:i:s");

	    if($act == '')
	    {
			
			$sql="insert into CY_teamnews (`id`,`title`,`author`,`content`,`times`) values(NULL,'$title','$author','$content','$times')";
		    $result=@mysql_query($sql);
		}elseif($act == 'mod')
		{
			
			$sql="update CY_teamnews set `title` = '$title' ,`author`='$author' ,`content`='$content',`times`='$times' where id = '$ids' ";
			$result=@mysql_query($sql);
		}

?>
		<script type="text/javascript" language="javascript">
			window.location.href="CY_teamnews.php";
		</script>
<?php 
	}
?>


<?php 

 //创业工厂---入驻团队招聘
	if($table == 'CY_job')
	{
		$title=htmlspecialchars(trim($_POST["name"]));
	    $content=$_POST["content"];
	    $author = trim($_POST["author"]);
	    date_default_timezone_set('PRC');
	    $times=date("Y-m-d G:i:s");


 		if($act == '')
	    {
			
			$sql="insert into CY_job (`id`,`title`,`author`,`content`,`times`) values(NULL,'$title','$author','$content','$times')";
		    $result=@mysql_query($sql);
		}elseif($act == 'mod')
		{
			
			$sql="update CY_job set `title` = '$title' ,`author`='$author' ,`content`='$content',`times`='$times' where id = '$ids' ";
	    	$result=@mysql_query($sql);
		}

		
?>
		<script type="text/javascript" language="javascript">
			window.location.href="CY_job.php";
		</script>
<?php 
	}
?>




<?php  
	//联系我们
	if($table == 'contact')
	{
		$content = $_POST['content'];
		date_default_timezone_set('PRC');
	    $times=date("Y-m-d G:i:s");


		
 		$sql  = "SELECT * FROM `contact`";
        $result = fetchOne($sql);

        if($result == 0 )
        {
        	$sql = "INSERT INTO contact(`id`,`times`,`content`)VALUES(NULL,'$times','$content')";
        	$result=@mysql_query($sql);
        }else
        {
        	$sql = "UPDATE `contact` SET `times` ='$times' ,`content`='$content' WHERE `id` = '1' ";
        	$result=@mysql_query($sql);
        }
?> 
		<script type="text/javascript" language="javascript">
			window.location.href="contact.php";
		</script>
<?php 
	}
?>




<?php
	//用户管理
	if($table == 'admin')
	{
		$username = $_POST['username'];
		$password = md5($_POST['password1']);

		
		$sql = "UPDATE `admin` SET `username` ='$username' ,`password` = '$password'  WHERE `id` = 1 ";
		$result=@mysql_query($sql);
		echo "修改成功，3秒后跳转到登录页面！<meta http-equiv='refresh' content='3;url=login.php'/>";
		
	}
?>



