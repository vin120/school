<!DOCTYPE html PUBLIC "-//W3C//DTD XHTML 1.0 Transitional//EN" "http://www.w3.org/TR/xhtml1/DTD/xhtml1-transitional.dtd">
<html xmlns="http://www.w3.org/1999/xhtml">
<head>
<meta http-equiv="X-UA-Compatible" content="IE=edge">
<meta http-equiv="Content-Type" content="text/html; charset=utf-8" />
<title><?php include_once ("./include/title.php");?> </title>

<link href="css/templatemo_style.css" rel="stylesheet" type="text/css" />
<link rel="stylesheet" href="css/orman.css" type="text/css" media="screen" />
<link rel="stylesheet" href="css/nivo-slider.css" type="text/css" media="screen" />	
<link rel="stylesheet" type="text/css" href="css/ddsmoothmenu.css" />

<script type="text/javascript" src="js/jquery.min.js"></script>
<script type="text/javascript" src="js/ddsmoothmenu.js"></script>
<script type="text/javascript" src="js/jquery-1.6.1.min.js"></script>
<script type="text/javascript" src="js/jquery.nivo.slider.pack.js"></script>
<script type="text/javascript"> 
		$(window).load(function() {
		    $('#slider').nivoSlider({
				controlNav:true
			});
		});	
		
		$(window).load(function() {
		    $('#slider1').nivoSlider({
				controlNav:false,
				directionNav:false,
				directionNavHide:false,
			});
		});
</script>


<script language="javascript" type="text/javascript">

ddsmoothmenu.init({
	mainmenuid: "templatemo_menu", //menu DIV id
	orientation: 'h', //Horizontal or vertical menu: Set to "h" or "v"
	classname: 'ddsmoothmenu', //class added to menu's outer DIV
	//customtheme: ["#1c5a80", "#18374a"],
	contentsource: "markup" //"markup" or ["container_id", "path_to_menu_file"]
})

function clearText(field)
{
    if (field.defaultValue == field.value) field.value = '';
    else if (field.value == '') field.value = field.defaultValue;
}
</script>


<link rel="stylesheet" href="css/slimbox2.css" type="text/css" media="screen" /> 
<script type="text/JavaScript" src="js/slimbox2.js"></script> 

</head>
<body>

<div id="templatemo_wrapper">
	<div id="templatemo_header">
    	<div id="site_title"><a href="#">创业园</a></div>
    	<div id="templatemo_search">
            <form action="search.php" method="get">
              <input type="text" value="" name="keyword" id="keyword" title="keyword" 
              				onfocus="clearText(this)" onblur="clearText(this)" class="txt_field" />
              <input type="submit"  value="" alt="Search" id="searchbutton" title="Search" class="sub_btn"  />
            </form>
        </div>
    </div><!-- END of templatemo_header -->

    <div id="templatemo_menu" class="ddsmoothmenu">
        <?php include_once "./include/menu.php" ?>
        <br style="clear: left" />
    </div> <!-- end of templatemo_menu -->


   
    <div id="templatemo_slider">
    	 <div class="slider-wrapper theme-orman">        
            <div id="slider" class="nivoSlider">
            <?php 
             include_once "./admin/include.php";
                $pdo = new PdoMySQL();
                $sql = "SELECT * FROM `index_SYTP`  WHERE id BETWEEN 1 AND 5";
                $rows = $pdo->getAll($sql);
                foreach ($rows as $row ) 
                {
            ?>
            	   <a href="#"><img src="./images/slider/<?php echo $row[name]?>" alt="" title="" /></a>
            <?php 
                }
            ?>
            </div>
            <div class="nivo-controlNav-bg"></div>	    
        </div>        
    </div><!-- END of templatemo_slider -->



    <div id="templatemo_main"> 	
        <div class="img_frame img_frame_12 img_nom img_fl"><span></span>
    	   <div id="slider1" class="nivoSlider">
            <?php
                $sql = "SELECT * FROM `index_SYTP` WHERE id BETWEEN 6 AND 8";
                $rows = $pdo->getAll($sql);
                foreach ($rows as $row ) 
                {
            ?>
                <img src="images/small_slider/<?php echo $row[name]?>" alt="" title="" />
               
            <?php
                }
            ?>
        	</div>
        
        </div> 
    

        <div class="half right">
        <h2>园区动态</h2>
        <ul class="list_bullet">
            <?php 
                require_once 'admin/include.php'; 
                $pdo  = new PdoMySQL();
                $sql = "SELECT * FROM  `index_YQDT` ORDER BY id DESC LIMIT 5";
                $result = $pdo->getAll($sql);

                foreach ($result as $row ) 
                {
                    $id = $row['id'];
                    $title = $row['title'];
                    $times = $row['times'];
                    //分割时间字符串
                    $time = explode(" ",$times); 
                    //中文标题截取
                    $title = mb_substr($title, 0,30, 'utf-8');
            ?>

                    <li ><a href = "index_YQDT.php?id=<?php echo $id?>"><?php echo $title ; ?></a><div style="float:right"><?php echo $time[0];?></div></li>  
                <?php 
                    }
                ?>   
            </ul>
            <a href="index_YQDT.php" class="more">更多>></a>
        </div>  

        <div class="clear h20"></div>
        
 
        <div class="half left">
          <h2>创业政策</h2>
            <ul class="list_bullet">
            <?php 
                require_once 'admin/include.php'; 
                $pdo  = new PdoMySQL();
                $sql = "SELECT * FROM  `index_CYZC` ORDER BY id DESC LIMIT 5";
                $result = $pdo->getAll($sql);

                foreach ($result as $row ) 
                {
                    $id = $row['id'];
                    $title = $row['title'];
                    $times = $row['times'];
                    //分割时间字符串
                    $time = explode(" ",$times); 
            ?>

                    <li ><a href = "index_CYZC.php?id=<?php echo $id?>"><?php echo $title ; ?></a><div style="float:right"><?php echo $time[0];?></div></li>  
                <?php 
                    }
                ?>   
            </ul>
             <a href="index_CYZC.php" class="more">更多>></a>
        </div> 
           

        <div class="half right">
        	<h2>创业团队</h2>
            <ul class="list_bullet">
            <?php 
                require_once 'admin/include.php'; 
                $pdo  = new PdoMySQL();
                $sql = "SELECT * FROM  `index_CYTD` ORDER BY id DESC LIMIT 5";
                $result = $pdo->getAll($sql);

                foreach ($result as $row ) 
                {
                    $id = $row['id'];
                    $title = $row['title'];
                    $times = $row['times'];
                    //分割时间字符串
                    $time = explode(" ",$times); 
            ?>

                    <li ><a href = "index_CYTD.php?id=<?php echo $id?>"><?php echo $title ; ?></a><div style="float:right"><?php echo $time[0];?></div></li>  
                <?php 
                    }
                ?>   
            </ul>
            <a href="index_CYTD.php" class="more">更多>></a>
        </div>  

        <div class="clear h20"></div>
     

        <div class="half left">
        <h2>通知公告</h2>
            <ul class="list_bullet">
            <?php 
                require_once 'admin/include.php'; 
                $pdo  = new PdoMySQL();
                $sql = "SELECT * FROM  `index_TZGG` ORDER BY id DESC LIMIT 5";
                $result = $pdo->getAll($sql);

                foreach ($result as $row ) 
                {
                    $id = $row['id'];
                    $title = $row['title'];
                    $times = $row['times'];
                    //分割时间字符串
                    $time = explode(" ",$times); 
            ?>

                    <li ><a href = "index_TZGG.php?id=<?php echo $id?>"><?php echo $title ; ?></a><div style="float:right"><?php echo $time[0];?></div></li>  
                <?php 
                    }
                ?>   
            </ul>
             <a href="index_TZGG.php" class="more">更多>></a>
        </div> 
        

        <div class="half right">
        <h2>资源下载</h2>
            <ul class="list_bullet">
            <?php 
                require_once 'admin/include.php'; 
                $pdo  = new PdoMySQL();
                $sql = "SELECT * FROM  `index_ZYXZ` ORDER BY id DESC LIMIT 5";
                $result = $pdo->getAll($sql);

                foreach ($result as $row ) 
                {
                    $id = $row['id'];
                    $title = $row['title'];
                    $times = $row['times'];
                    //分割时间字符串
                    $time = explode(" ",$times); 
            ?>

                    <li ><a href = "index_ZYXZ.php?id=<?php echo $id?>"><?php echo $title ; ?></a><div style="float:right"><?php echo $time[0];?></div></li>  
                <?php 
                    }
                ?>   
            </ul>
            <a href="index_ZYXZ.php" class="more">更多>></a>
        </div> 
      <div class="clear "></div>
    </div><!-- END of templatemo_main -->
</div><!-- END of templatemo_wrapper -->


<div id="templatemo_bottom_wrapper">
	<div id="templatemo_bottom">
        <?php include_once "./include/link.php" ;?>    
        <div class="clear"></div>
    </div><!-- END of templatemo_bottom -->
</div><!-- END of templatemo_bottom_wrapper -->   

<div id="templatemo_footer_wrapper">    
    <div id="templatemo_footer">
        <?php include_once "./include/footer.php"; ?>
    </div><!-- END of templatemo_footer -->
</div><!-- END of templatemo_footer_wrapper -->

</body>
</html>