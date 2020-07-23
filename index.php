<?php
	session_start();
	include("php/autoload.php");
	$content = isset($_GET["content"])?$_GET["content"]:"home";
?>
<!DOCTYPE html>
<html lang="en">
<?php include("master/head.php"); ?>
<body class="skin-blue">
	<div class="wrapper">
		<?php include("master/header.php");?>
		<aside class="main-sidebar">
			<section class="sidebar">
				<?php include("master/menu.php");?>
			</section>
		</aside>
		<div class="content-wrapper">
			<section class="content-header">
				<?php
					switch($content) {
						case "home"                  					: include("pages/home/view.php");                   			break;
						case "user-admin"           					: include("pages/user-admin/view.php");            				break;
						case "user-admin-add"       					: include("pages/user-admin-add/view.php");        				break;
						case "user-admin-edit"      					: include("pages/user-admin-edit/view.php");      				break;
						case "user-admin-del"       					: include("pages/user-admin-del/view.php");        				break;
						case "user-admin-show"      					: include("pages/user-admin-show/view.php");       				break;
						case "setting-prefix-admin"   					: include("pages/setting-prefix-admin/view.php");       		break;
						case "setting-position-admin" 					: include("pages/setting-position-admin/view.php");       		break;
						case "setting-status"		 					: include("pages/setting-status/view.php");       				break;
						case "user-member"           					: include("pages/user-member/view.php");            			break;
						case "user-member-add"       					: include("pages/user-member-add/view.php");        			break;
						case "user-member-edit"      					: include("pages/user-member-edit/view.php");      				break;
						case "user-member-del"       					: include("pages/user-member-del/view.php");        			break;
						case "user-member-show"      					: include("pages/user-member-show/view.php");       			break;						
						case "school"           						: include("pages/school/view.php");            					break;
						case "school-map"           					: include("pages/school-map/view.php");            				break;
						case "school-add"       						: include("pages/school-add/view.php");        					break;
						case "school-edit"      						: include("pages/school-edit/view.php");      					break;
						case "school-del"       						: include("pages/school-del/view.php");        					break;
						case "school-show"      						: include("pages/school-show/view.php");       					break;
						case "school-list"      						: include("pages/school-list/view.php");       					break;
						case "pagenotfound"	     						: include("pages/pagenotfound/view.php");       				break;
						default                       					: include("pages/home/view.php");                   			
					}
				?>
			</section>
		</div>
	</div>
	<?php include("master/footer.php"); ?>
</body>
</html>