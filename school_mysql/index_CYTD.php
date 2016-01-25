<!DOCTYPE html PUBLIC "-//W3C//DTD XHTML 1.0 Transitional//EN" "http://www.w3.org/TR/xhtml1/DTD/xhtml1-transitional.dtd">
<html xmlns="http://www.w3.org/1999/xhtml">
<head>
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

   
    <div id="templatemo_main">  
    <p>你现在的位置是:<a href="index.php">首页</a> > <a href="index_CYTD.php">创业团队</a></p>
    <hr style="border : 1px dashed #036"/>
    <br/>
    <?php 

            require_once 'admin/include.php'; 
            $id = htmlspecialchars(trim($_GET["id"]));
        
            if(!empty($id))
            {
                $sql = "SELECT * FROM  `index_CYTD` WHERE  id = $id";
                $row = fetchOne($sql);
                $title = $row['title'];
                $author = $row['author'];
                $times = $row['times'];
                $content = $row['content'];
    ?>

         
            <h3 align="center"><?php echo $title;?></h3>
            <p  align="center" >发布时间：<?php echo $times ;?> &nbsp;&nbsp;&nbsp; 作者：<?php echo $author ;?></p>
            <hr/>
            <span><?php echo $content ;?></span>
    <?php
            }
            else
            {   
    
                $page = $_REQUEST['page']?(int)$_REQUEST['page']:1;
                $sql  = "SELECT * FROM `index_CYTD`";
                $result = fetchAll($sql);
                $totalRows = count($result);
                $pageSize=12;
                $totalPage=ceil($totalRows/$pageSize);
                if($page<1||$page==null||!is_numeric($page))$page=1;
                if($page>=$totalPage)$page=$totalPage;
                $offset=($page-1)*$pageSize;
                if($offset < 0 ) $offset = 0;
                $sql  = "SELECT * FROM `index_CYTD` ORDER BY  id DESC LIMIT {$offset},{$pageSize}";
                $rows = fetchAll($sql);

                foreach ($rows as $row ) 
                {
                    $id = $row['id'];
                    $title = $row['title'];
                    $times = $row['times'];
                    //分割时间字符串
                    $time = explode(" ",$times); 
            ?>
                <h4 align="left" ><a href = "index_CYTD.php?id=<?php echo $id?>"><?php echo $title ; ?></a><div style="float:right"><?php echo $time[0];?></div></h4>
                <hr style="height:1px;border:none;border-top:1px dashed #036;" />
            <?php 
                }  
            ?>
            <div class="clear h40"></div> 
            <div align="center" style="font-size:15px"><?php echo showPage($page, $totalPage);?></div>
                
        <?php  
            }
         ?>


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