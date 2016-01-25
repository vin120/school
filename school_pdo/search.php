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
    <p>你现在的位置是:<a href="index.php">首页</a> > 搜索结果</p>
    <hr style="border : 1px dashed #036"/>
    <br/>

    <?php 
        require_once 'admin/include.php'; 

         /* 关键字 */
    $keyword = trim($_REQUEST['keyword']);
    if(!empty($keyword))
    {
       

        $str = "";
        $count="";
        /* 搜索表名称 */
        $arr = array(
                "index_YQDT"    =>  '`title`,`content`',
                "index_CYZC"    =>  '`title`,`content`',
                "index_CYTD"    =>  '`title`,`content`',
                "index_TZGG"    =>  '`title`,`content`',
                "index_ZYXZ"    =>  '`title`',
                "YS_about"         =>  '`title`,`content`',
                "YS_build"          =>  '`title`,`content`',
                "CY_news"         =>  '`title`,`content`',
                "CY_teamnews" => '`title`,`content`',
                "CY_job"             =>  '`title`',
        );

        foreach($arr as $key => $value)
        {
            $row = explode(",",$value);
            $title = str_replace("`","",$row[0]);
            $content = str_replace("`","",$row[1]);
            $sql = "SELECT * FROM ".$key." ";

           for($i=0;$i<count($row);$i++)
           {
                $sql .= ( preg_match('/WHERE/i' , $sql ) ? ' or ': ' WHERE ' ).$row[$i]." like '%".$keyword."%' ";
           }

            $pdo = new PdoMySQL();
            $pdo -> query($sql);
            
            
            while($site = PdoMySQL::$PDOStatement->fetch(constant("PDO::FETCH_ASSOC")))
            {
                $title2 = str_ireplace($keyword, "<strong><font color='red'>".$keyword."</font></strong>",$site[$title]);
                $content2 = str_ireplace($keyword,"<font color='red'>".$keyword."</font>",cut_str_with_string(strip_tags($site[$content]),180));
                switch($key)
                {
                    case 'index_YQDT':
                    $href = "index_YQDT.php?id=".$site['id'];
                    break;
                    case 'index_CYZC':
                    $href = "index_CYZC.php?id=".$site['id'];
                    break;
                    case 'index_CYTD':
                    $href = "index_CYTD.php?id=".$site['id'];
                    break;
                    case 'index_TZGG':
                    $href = "index_TZGG.php?id=".$site['id'];
                    break;
                    case 'index_ZYXZ':
                    $href = "index_ZYXZ.php?id=".$site['id'];
                    break;
                    case 'YS_about':
                    $href = "YS_about.php?id=".$site['id'];
                    break;
                    case 'YS_build':
                    $href = "YS_build.php?id=".$site['id'];
                    break;
                    case 'CY_news':
                    $href = "CY_news.php?id=".$site['id'];
                    break;
                    case 'CY_teamnews':
                    $href = "CY_teamnews.php?id=".$site['id'];
                    break;
                    case 'CY_job':
                    $href = "CY_job.php?id=".$site['id'];
                    break;
                }
                $str .= '<h4><a href="'.$href.'" target="_blank">'.$title2.'</a></h4>'.$content2."<br/>"."<div style='border-bottom:#666 dashed 1px;height:1px;'></div>"."<br/>";
                $count .= "1";
            } 
        }

        //分页
        $array = explode("   ", $str);

        $page = $_REQUEST['page']?(int)$_REQUEST['page']:1;
        $totalRows = strlen($count);
        $pageSize=20;
        $totalPage=ceil($totalRows/$pageSize);
        if($page<1||$page==null||!is_numeric($page))$page=1;
        if($page>=$totalPage)$page=$totalPage;

        $start = ($page-1)*$pageSize;
        $end = $page*$pageSize;

        if(empty($str))
        {
            echo "<div style='margin:20px' >对不起！您搜索的内容不存在！</div>" ;
        }
        else
        {
            for($i=$start;$i<$end;$i++)
            {
                echo $array[$i];
            }
        }

    }
    else
    {
            echo "<div style='margin:20px' >对不起！您搜索的内容不存在！</div>" ; 
    }

    ?>


    <div align="center" style="font-size:15px"><?php echo showPage($page, $totalPage,"keyword=$keyword");?></div>
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