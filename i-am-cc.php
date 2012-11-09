<?php 
if($_GET==null){
	$json = file_get_contents('http://i-am-cc.org/api/instagram_photo/');
}else{
	if($_GET["offset"]!=null && $_GET["offset"]!=""){
		$page .= "offset=".htmlspecialchars($_GET["offset"]);
	}else{
		$page .= "offset=0";
	}
	if($_GET["filter"]!=null && $_GET["filter"]!=""){
		$param .= "&filter=".htmlspecialchars($_GET["filter"]);
	}
	if($_GET["license_info__license"]!=null && $_GET["license_info__license"]!=""){
		$param .= "&license_info__license=".htmlspecialchars($_GET["license_info__license"]);
	}
	if($_GET["limit"]!=null && $_GET["limit"]!=""){
		$param .= "&limit=".htmlspecialchars($_GET["limit"]);
	}


	$json = file_get_contents('http://i-am-cc.org/api/instagram_photo/?'.$page.$param);
	
}
$data = json_decode( $json, true );

//var_dump($data["meta"]);
if($data["meta"]["total_count"]==0){ $list = "photo not found"; }else{
	foreach($data["objects"] as $key => $obj){
		
		
		
		if($obj["license_info"]["license"] == "CC0"){
			$lic = "cc_zero";
			$lk = "http://creativecommons.org/publicdomain/zero/1.0/";
		}else if($obj["license_info"]["license"] == "CC-BY"){
			$lic = "cc_by";
			$lk = "http://creativecommons.org/licenses/by/3.0/";
		}else if($obj["license_info"]["license"] == "CC-BY-NC"){
			$lic = "cc_by_nc";
			$lk = "http://creativecommons.org/licenses/by-nc/3.0/";
		}else if($obj["license_info"]["license"] == "CC-BY-ND"){
			$lic = "cc_by_nd";
			$lk = "http://creativecommons.org/licenses/by-nd/3.0/";
		}else if($obj["license_info"]["license"] == "CC-BY-SA"){
			$lic = "cc_by_sa";
			$lk = "http://creativecommons.org/licenses/by-sa/3.0/";
		}else if($obj["license_info"]["license"] == "CC-BY-NC-ND"){
			$lic = "cc_by_nc_nd";
			$lk = "http://creativecommons.org/licenses/by-nc-nd/3.0/";
		}else if($obj["license_info"]["license"] == "CC-BY-NC-SA"){
			$lic = "cc_by_nc_sa";
			$lk = "http://creativecommons.org/licenses/by-nc-sa/3.0/";
		}
		
		
		$list .= 
                    '<li><a href="'.$obj["link"].'" target="_blank"><img src="'.$obj["image_thumbnail"].'" alt="Photo by '.$obj["license_info"]["full_name"].'" class="image" /></a><br />
					<a href="'.$lk.'" target="_blank" class="licence"><img src="iamccimg/'.$lic.'.png" /></a></li>';
	}
	if($data["meta"]["next"]!=null){
		$cnt = $data["meta"]["limit"]+$data["meta"]["offset"];
		$next ='<li><a href="i-am-cc.php?offset='.$cnt.$param.'">Next &gt;&gt;</a></li>';
	}else{
		$next ="";
	}
	if($data["meta"]["previous"]!=null){
		$cnt = $data["meta"]["offset"]-$data["meta"]["limit"];
		$prev ='<li><a href="i-am-cc.php?offset='.$cnt.$param.'">&lt;&lt; Previous</a></li>';
	}else{
		$prev ="";
	}
	
}




?>
<!DOCTYPE html PUBLIC "-//W3C//DTD XHTML 1.0 Transitional//EN" "http://www.w3.org/TR/xhtml1/DTD/xhtml1-transitional.dtd">
<html xmlns="http://www.w3.org/1999/xhtml" xml:lang="ja" lang="ja">
<head>
<meta http-equiv="Content-Type" content="text/html; charset=utf-8" />
<meta name="viewport" content="width=device-width, maximum-scale=1.0" />
<link rel="stylesheet" media="all" href="i-am-cc.css" type="text/css" />
<title>Find a Creative-Commons Photo from Instagram</title>
<script type="text/javascript">

  var _gaq = _gaq || [];
  _gaq.push(['_setAccount', 'UA-34390228-1']);
  _gaq.push(['_trackPageview']);

  (function() {
    var ga = document.createElement('script'); ga.type = 'text/javascript'; ga.async = true;
    ga.src = ('https:' == document.location.protocol ? 'https://ssl' : 'http://www') + '.google-analytics.com/ga.js';
    var s = document.getElementsByTagName('script')[0]; s.parentNode.insertBefore(ga, s);
  })();

</script>
</head>
<body>
    <div id="all_wrap" data-role="page">
    	<div id="header">
                
                <h1><a href="i-am-cc.php">Find a Creative-Commons Photo from Instagram</a></h1>

                <div id="filter">
                    <form method="get" action="i-am-cc.php">
                    <ul id="form">
                    <li><label for="filter">Filter:</label>
                    <select name="filter">
                        <option></option>
                        <option <?php if($_GET["filter"] == "Normal"){ echo "selected"; } ?>>Normal</option>
                        <option <?php if($_GET["filter"] == "Amaro"){ echo "selected"; } ?>>Amaro</option>
                        <option <?php if($_GET["filter"] == "Rise"){ echo "selected"; } ?>>Rise</option>
                        <option <?php if($_GET["filter"] == "Hudson"){ echo "selected"; } ?>>Hudson</option>
                        <!--<option <?php if($_GET["filter"] == "X-Pro II"){ echo "selected"; } ?>>X-Pro II</option>-->
                        <option <?php if($_GET["filter"] == "Sierra"){ echo "selected"; } ?>>Sierra</option>
                        <option <?php if($_GET["filter"] == "Lo-fi"){ echo "selected"; } ?>>Lo-fi</option>
                        <option <?php if($_GET["filter"] == "Earlybird"){ echo "selected"; } ?>>Earlybird</option>
                        <option <?php if($_GET["filter"] == "Sutro"){ echo "selected"; } ?>>Sutro</option>
                        <option <?php if($_GET["filter"] == "Toaster"){ echo "selected"; } ?>>Toaster</option>
                        <option <?php if($_GET["filter"] == "Brannan"){ echo "selected"; } ?>>Brannan</option>
                        <option <?php if($_GET["filter"] == "Inkwell"){ echo "selected"; } ?>>Inkwell</option>
                        <option <?php if($_GET["filter"] == "Walden"){ echo "selected"; } ?>>Walden</option>
                        <option <?php if($_GET["filter"] == "Hefe"){ echo "selected"; } ?>>Hefe</option>
                        <option <?php if($_GET["filter"] == "Valencia"){ echo "selected"; } ?>>Valencia</option>
                        <option <?php if($_GET["filter"] == "Nashville"){ echo "selected"; } ?>>Nashville</option>
                        <option <?php if($_GET["filter"] == "1977"){ echo "selected"; } ?>>1977</option>
                        <option <?php if($_GET["filter"] == "Kelvin"){ echo "selected"; } ?>>Kelvin</option>
                    </select></li><li><label for="license_info__license"> Licence:</label>
                    <select name="license_info__license">
                        <option></option>
                        <option <?php if($_GET["license_info__license"] == "CC0"){ echo "selected"; } ?>>CC0</option>
                        <option <?php if($_GET["license_info__license"] == "CC-BY"){ echo "selected"; } ?>>CC-BY</option>
                        <option <?php if($_GET["license_info__license"] == "CC-BY-NC"){ echo "selected"; } ?>>CC-BY-NC</option>
                        <option <?php if($_GET["license_info__license"] == "CC-BY-ND"){ echo "selected"; } ?>>CC-BY-ND</option>
                        <option <?php if($_GET["license_info__license"] == "CC-BY-SA"){ echo "selected"; } ?>>CC-BY-SA</option>
                        <option <?php if($_GET["license_info__license"] == "CC-BY-NC-ND"){ echo "selected"; } ?>>CC-BY-NC-ND</option>
                        <option <?php if($_GET["license_info__license"] == "CC-BY-NC-SA"){ echo "selected"; } ?>>CC-BY-NC-SA</option>
                    </select></li><li><label for="posts"> Photos par page:</label>
                    <select name="limit">
                        <option <?php if($_GET["limit"] == "10"){ echo "selected"; } ?>>10</option>
                        <option <?php if($_GET["limit"] == "20" || empty($_GET["limit"])){ echo "selected"; } ?>>20</option>
                        <option <?php if($_GET["limit"] == "30"){ echo "selected"; } ?>>30</option>
                    </select></li>
                    <li><input type="submit" value="Search" /></li>
                    </ul>
                    </form>
				</div>
<div id="exp"><a href="http://creativecommons.org/about" target="_blank">What is Creative Commons?</a><br />
<a href="http://creativecommons.jp/licenses/" target="_blank">クリエイティブ・コモンズとは？</a></div>
        </div>
        <!--#header-->
        <div id="container">
            <div id="project_list">

                        <ul data-role="listview" class="project_list_box" id="photo"> 
<?php echo $list; ?>
                        </ul>
            </div>
            <!--#project_list-->        
                    
                    
                    
                    
                <div id="page">
                    <ul class="clearfix" id="pager">
<?php echo $prev; ?>
<?php echo $next; ?>
                    </ul>
                </div>
                <!--#page-->
        </div>
        <!--#container-->

<!--フッターここから-->
        <div data-role="footer" id="foot">	
        engine by <a href="http://i-am-cc.org" target="_blank">i-am-cc.org</a> / this page is by <a href="https://twitter.com/sugawa" target="_blank">sugawa</a>.	
        </div>
        <!--#footer-->
    </div>
    <!--#all_wrap-->
    
</body>
</html>
