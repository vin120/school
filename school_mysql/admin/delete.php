<?php  
/*

	删除文件页面，接受页面传来的id和数据表名进行删除


*/
	require_once 'include.php';
	session_start();
	checkLogined();
	$id=htmlspecialchars(trim($_GET["id"]));
	$table = htmlspecialchars(trim($_GET["table"]));
?>


<?php
	//主页--创业团队
	if($table == 'index_CYTD')
	{
		//删除数据库内容
		
		$sql="delete from index_CYTD where id='$id' limit 1";
		$result=@mysql_query($sql);
	
?>

	<script type="text/javascript" language="javascript">
		window.location.href="index_CYTD.php";
	</script>
<?php 
	}
?>



<?php
	//主页---创业政策
	if($table == 'index_CYZC')
	{
		
		////改变文件操作权限并删除
		
		$sql  = "select path from index_CYZC where id = '$id'"; 
		$file = fetchOne($sql);
		
		if(file_exists($file['path']))
	    {
			chmod($file['path'],0777);
			unlink($file['path']);
		}

		//删除数据库内容 
		$sql="delete from index_CYZC where id='$id' limit 1";
		$result=@mysql_query($sql);
	
?>

	<script type="text/javascript" language="javascript">
		window.location.href="index_CYZC.php";
	</script>

<?php 
	}
?>



<?php
	//主页---通知公告
	if($table == 'index_TZGG')
	{
		//删除数据库内容
	
		$sql="delete from index_TZGG where id='$id' limit 1";
		$result=@mysql_query($sql);
	
?>

	<script type="text/javascript" language="javascript">
		window.location.href="index_TZGG.php";
	</script>

<?php 
	}
?>


<?php
	//主页---园区动态
	if($table == 'index_YQDT')
	{
		//删除数据库内容
		
		$sql="delete from index_YQDT where id='$id' limit 1";
		$result=@mysql_query($sql);
		
?>

	<script type="text/javascript" language="javascript">
		window.location.href="index_YQDT.php";
	</script>

<?php 
	}
?>



<?php
	//主页---资源下载

	if($table == 'index_ZYXZ')
	{
		////改变文件操作权限并删除
		
		$sql  = "select path from index_ZYXZ where id = '$id'"; 
		$file = fetchOne($sql);
		
		if(file_exists($file['path']))
	    {
			chmod($file['path'],0777);
			unlink($file['path']);
		}

		//删除数据库内容
		$sql="delete from index_ZYXZ where id='$id' limit 1";
		$result=@mysql_query($sql);
	
?>

	<script type="text/javascript" language="javascript">
		window.location.href="index_ZYXZ.php";
	</script>

<?php 
	}
?>



<?php
	//院士工作站---建设进展
	if($table == 'YS_build')
	{
		//删除数据库内容
		
		$sql="delete from YS_build where id='$id' limit 1";
		$result=@mysql_query($sql);
		
?>

	<script type="text/javascript" language="javascript">
		window.location.href="YS_build.php";
	</script>

<?php 
	}
?>



<?php
	//院士工作站---院士简介
	if($table == 'YS_about')
	{
		//删除数据库内容
		
		$sql="delete from YS_about where id='$id' limit 1";
		$result=@mysql_query($sql);
		
?>

	<script type="text/javascript" language="javascript">
		window.location.href="YS_about.php";
	</script>

<?php 
	}
?>




<?php
	//创业工厂---入驻通知
	if($table == 'CY_news')
	{
		////改变文件操作权限并删除
		
		$sql  = "select path from CY_news where id = '$id'"; 
		$file = fetchOne($sql);
		
		if(file_exists($file['path']))
	    {
			chmod($file['path'],0777);
			unlink($file['path']);
		}

		//删除数据库内容 
		$sql="delete from CY_news where id='$id' limit 1";
		$result=@mysql_query($sql);
	
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
		//删除数据库内容
		
		$sql="delete from CY_teamnews where id='$id' limit 1";
		$result=@mysql_query($sql);
		
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
		//删除数据库内容
		
		$sql="delete from CY_job where id='$id' limit 1";
		$result=@mysql_query($sql);
		
?>

	<script type="text/javascript" language="javascript">
		window.location.href="CY_job.php";
	</script>

<?php 
	}
?>

