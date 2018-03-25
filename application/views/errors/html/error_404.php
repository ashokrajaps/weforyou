<?php  
 defined('BASEPATH') OR exit('No direct script access allowed');  
 $base_url = load_class('Config')->config['base_url'];
?>
<!DOCTYPE html>
<html lang="en">
   <head>
      <meta charset="utf-8">
      <title>404 Page Not Found</title>
      <link rel="icon" type="image/x-icon" href="<?php echo $base_url; ?>/images/favicon.png"/>
	 <link rel="stylesheet" href="<?php echo $base_url; ?>skin/frontend/css/error_style.css" type="text/css">
   </head>
<body style="background-image:url(<?php echo $base_url; ?>assets/images/animation-bg.jpg)">
    <div class="center-bodys">
        <img src="<?php echo $base_url; ?>assets//images/thumbs-up.png" alt="College Logo">
		<h1><span>404</span> Page Not Found</h1>
			<div class="err-msg">
				<?php echo $message; ?>
				<div class="err-btn-blk">
					<a onclick="goBack()" class="er-bk-btn">Go back</a>
					<a href="<?php echo $base_url;?>" class="er-bk-btn">Go Home</a>
				</div>
			</div>
        </div>
</body>
<script>
function goBack() {
    window.history.back();
}
</script>
</html>
