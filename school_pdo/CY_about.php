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
              <input type="submit" value="" alt="Search" id="searchbutton" title="Search" class="sub_btn"  />
            </form>
        </div>
    </div><!-- END of templatemo_header -->
    <div id="templatemo_menu" class="ddsmoothmenu">
       <?php include_once "./include/menu.php" ?>

        <br style="clear: left" />
    </div> <!-- end of templatemo_menu -->

   
    <div id="templatemo_main">  

    <?php 
            require_once 'admin/include.php'; 
            $id = htmlspecialchars(trim($_GET["id"]));
            $pdo  = new PdoMySQL();
            $sql = "SELECT * FROM  `CY_about` WHERE  id = 1";
            $row = $pdo->getRow($sql);
            $times = $row['times'];
            $content = $row['content'];
    ?>

            <p>你现在的位置是:<a href="index.php">首页</a> > <a href="CY_about.php">创业工厂简介</a></p>
            <hr style="border : 1px dashed #036"/>
            <br/>
            <h3 align="center">创业工厂简介</h3>
            <hr/>
            <br/>
            <span><?php echo $content ;?></span>

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