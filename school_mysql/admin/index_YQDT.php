<?php 
	error_reporting(E_ALL & ~E_NOTICE); 
	require_once 'include.php';	
	session_start();
	checkLogined();	
?>

<!DOCTYPE html PUBLIC "-//W3C//DTD XHTML 1.0 Transitional//EN" "http://www.w3.org/TR/xhtml1/DTD/xhtml1-transitional.dtd">
<html xmlns="http://www.w3.org/1999/xhtml">
<head>
	<meta http-equiv="Content-Type" content="text/html; charset=utf-8" />
	<title>科技园后台管理系统</title>
	<link rel="stylesheet" type="text/css" href="css/style.css" />
	<script type="text/javascript" src="js/jquery.min.js"></script>
	<script type="text/javascript" src="js/ddaccordion.js"></script>
	<script type="text/javascript">
	ddaccordion.init({
		headerclass: "submenuheader", //Shared CSS class name of headers group
		contentclass: "submenu", //Shared CSS class name of contents group
		revealtype: "click", //Reveal content when user clicks or onmouseover the header? Valid value: "click", "clickgo", or "mouseover"
		mouseoverdelay: 200, //if revealtype="mouseover", set delay in milliseconds before header expands onMouseover
		collapseprev: true, //Collapse previous content (so only one open at any time)? true/false 
		defaultexpanded: [], //index of content(s) open by default [index1, index2, etc] [] denotes no content
		onemustopen: false, //Specify whether at least one header should be open always (so never all headers closed)
		animatedefault: false, //Should contents open by default be animated into view?
		persiststate: true, //persist state of opened contents within browser session?
		toggleclass: ["", ""], //Two CSS classes to be applied to the header when it's collapsed and expanded, respectively ["class1", "class2"]
		togglehtml: ["suffix", "<img src='images/plus.gif' class='statusicon' />", "<img src='images/minus.gif' class='statusicon' />"], //Additional HTML added to the header when it's collapsed and expanded, respectively  ["position", "html1", "html2"] (see docs)
		animatespeed: "fast", //speed of animation: integer in milliseconds (ie: 200), or keywords "fast", "normal", or "slow"
		oninit:function(headers, expandedindices){ //custom code to run when headers have initalized
			//do nothing
		},
		onopenclose:function(header, index, state, isuseractivated){ //custom code to run whenever a header is opened or closed
			//do nothing
		}
	})
	</script>
	<script type="text/javascript" src="js/jquery-1.4.2.min.js"></script>
	<script src="js/jquery.jclock-1.2.0.js.txt" type="text/javascript"></script>
	<script type="text/javascript" src="js/jconfirmaction.jquery.js"></script>
	<script type="text/javascript">
		$(document).ready(function() {
			$('.ask').jConfirmAction();
		});
	</script>
	<script type="text/javascript">
	$(function($) {
	    $('.jclock').jclock();
	});
	</script>
	<script language="javascript" type="text/javascript" src="js/niceforms.js"></script>
	<link rel="stylesheet" type="text/css" media="all" href="css/niceforms-default.css" />


	<script charset="utf-8" src="./editor/kindeditor.js"></script>
	<script charset="utf-8" src="./editor/lang/zh_CN.js"></script>
	<script>
	        KindEditor.ready(function(K) {
	                window.editor = K.create('#editor_id');
	        });
	</script>


	
</head>
<body>

<div id="main_container">

	<div class="header">
	<div class="logo"><a href="#"><img src="images/logo_s.png" alt="" title="" border="0" /></a></div>
    <div class="right_header">欢迎您&nbsp;
	<?php 
		if(isset($_SESSION['adminName']))
		{
			echo $_SESSION['adminName'];
		}elseif(isset($_COOKIE['adminName']))
		{
			echo $_COOKIE['adminName'];
		}	
	?>,
	<a href="../index.php" target="_blank" >访问主页</a> | <a href="logout.php" class="logout">登出</a></div>
    <div class="jclock"></div>
    </div>
	
    <div class="main_content">
    
                    <div class="menu">
				        <ul>
							<?php require_once 'include/menu.php' ;?>            
			           </ul>
                    </div>      
		<div class="center_content">  
			
			<div class="left_content">	
		
				<div class="sidebarmenu">
					<a class="menuitem" href="index_SYTP.php">首页图片</a>
					<a class="menuitem" href="index_YQDT.php">园区动态</a>
					<a class="menuitem" href="index_CYZC.php">创业政策</a>	
					<a class="menuitem" href="index_CYTD.php">创业团队</a>
					<a class="menuitem" href="index_TZGG.php">通知公告</a>
					<a class="menuitem" href="index_ZYXZ.php">资源下载</a>
				</div>
				
				<div class="sidebar_box">
					<div class="sidebar_box_top"></div>
					<div class="sidebar_box_content">
					<h3>咨询</h3>
					<img src="images/info.png" alt="" title="" class="sidebar_icon_right" />
					<p>
						技术支持：<span>  21度传媒有限公司	</span>
					</p>                
					</div>
					<div class="sidebar_box_bottom"></div>
				</div>
				
			</div>
			<div  class="right_content">
				           
			<h2>园区动态</h2> 
			<hr/>					
			<br/>

			<?php 
				$ids = $_GET['id'];
                $table = $_GET['table'];

               	if($ids != NULL && $table != NULL)
               	{
               	
	                $sql = "SELECT * FROM "."$table"." WHERE id = ".$ids;
	                $res = fetchOne($sql);
            ?>
            	<form action="doAction.php?table=index_YQDT&act=mod&ids=<?php echo $ids ?>" method="POST" enctype="multipart/form-data">
                <p>标题：<input type="text" name="name" class="add_bar" value="<?php echo $res[title] ?>"></p>
                <p>作者：<input type="text" name="author" class="add_bar" value="<?php echo $res[author] ?>"></p>
                <p>内容：<br /><br />
                <textarea id="editor_id" name="content" class="add_textarea" style="width:500px;height:500px;" ><?php echo $res[content]?></textarea>
                </p>
                <p><input type="submit" name="submit" value="修改"></p>
            	</form>
            <?php 
               	}
               	else
               	{
			?>
				<form action="doAction.php?table=index_YQDT" method="POST" enctype="multipart/form-data">
                <p>标题：<input type="text" name="name" class="add_bar" ></p>
                <p>作者：<input type="text" name="author" class="add_bar"></p>
                <p>内容：<br /><br />
                 <textarea id="editor_id" name="content" class="add_textarea" style="width:500px;height:500px;"></textarea>
                </p>
                <p><input type="submit" name="submit" value="发布"></p>
            	</form>
            <?php 
            	}
            ?>

            <p>&nbsp;</p>
            <hr />
            <p>&nbsp;</p>

			<h2>内容查看</h2>
       
            <table width="100%" border="1" style="text-align:center">

                <tr>
                    <th>标题</th><th>作者</th><th>发布时间</th><th>修改</th><th>删除</th>
                </tr>
                <?php 
				
				$page = $_REQUEST['page']?(int)$_REQUEST['page']:1;
                $sql  = "SELECT * FROM `index_YQDT`";
                $result = fetchAll($sql);
                $totalRows = count($result);
                $pageSize=12;
                $totalPage=ceil($totalRows/$pageSize);
                if($page<1||$page==null||!is_numeric($page))$page=1;
                if($page>=$totalPage)$page=$totalPage;
                $offset=($page-1)*$pageSize;
                if($offset < 0 ) $offset = 0;
                $sql  = "SELECT * FROM `index_YQDT` ORDER BY  id DESC LIMIT {$offset},{$pageSize}";
                $rows = fetchAll($sql);

				foreach ($rows as $row)
				{
					$id = $row['id'];
					$title = $row['title'];				
					$times = $row['times'];
					$author = $row['author'];
                ?>
                    <tr>
                        <td><a href="../index_YQDT.php?id=<?php echo $id ;?>" target="_blank"><?php echo $title; ?></a></td>
                        <td><?php echo $author; ?></td>
                        <td><?php echo $times; ?></td>
                        <td><a href="#" onclick="mod(<?php echo $id; ?>,'index_YQDT')">修改</a></td>
                        <td><a href="#" onclick="del(<?php echo $id; ?>,'index_YQDT')">删除</a></td>
                    </tr>

                <?php
                }           
                ?>
            </table>
            <div align="center" style="font-size:15px"><?php echo showPage($page, $totalPage);?></div>

			</div>
		</div>   <!--end of center content -->               
                    
    
		<div class="clear"></div>
    </div> <!--end of main content-->
	
   <?php  require_once 'include/footer.php' ; ?> 
    
    <script type="text/javascript">
    function del(ids,table)
    {
        var i=confirm("您确实要删除该案例吗？");
        if(i)
        {
            window.location.href="delete.php?id="+ids+"&table="+table;
        }
    }

    function mod(ids,table)
    {
        window.location.href="index_YQDT.php?id="+ids+"&table="+table;
    }
    </script>

</div>		
</body>
</html>