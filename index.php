<?php

class imageSearch{


	public function googleImages($q,$start)
	{
	   
	   $json_img = file_get_contents("https://www.google.com/uds/GimageSearch?rsz=8&q=".$q."&v=1.0&start=".$start."&imgsz=small");

	   $data_img = json_decode($json_img,true);

	   return $data_img;
	}
	

}	

$objImgSearch = new imageSearch();

if(isset($_REQUEST['q']))
{
	$q = urlencode($_REQUEST['q']);

	$start = (isset($_REQUEST['p']))?urlencode($_REQUEST['p']):0;

	$googleImagesArr = $objImgSearch->googleImages($q,$start);
}

?>	


<!DOCTYPE html>
<html lang="en">
  <head>
    <meta charset="utf-8">
    <title>Google Image Search API With PHP</title>
    <meta name="viewport" content="width=device-width, initial-scale=1.0"/>
    <meta name="description" content="Google Image Search API With PHP Demo. Download Google Image Search API With PHP"/>
	<meta name="keywords" content="Google Image Search,image search,php image search,google image search php,google api php,php google image search api,google api images php"/>
    <meta name="author" content="Jenson M John">

    <link href="css/bootstrap.min.css" rel="stylesheet">
    <link href="css/bootstrap-responsive.min.css" rel="stylesheet">
    <link href="css/custom.css" rel="stylesheet">
    <!--[if lt IE 9]>
    <script src="//html5shim.googlecode.com/svn/trunk/html5.js"></script>
    <![endif]-->
</head>

  <body>
    
    
    <div class="container">
	
	
	<form class="form-horizontal" name="googleImageSearch" id="googleImageSearch" method="POST" action="index.php">
		<fieldset>

		<!-- Form Name -->
		<legend>Google Image Search API With PHP</legend>
       
	    <p align="justify">
This is the Live demo of Google Image Search API using PHP. Here you can provide any keyword to perform the Google Image Search. The PHP Source for this functionlity is really small & simple. In PHP code, I've used <code>file_get_contents()</code> function to read JSON response returned from the Image search API & <code>json_decode()</code> function (with second parameter set to true) converts the JSON string into array. You can process this final array according to your requirement. Enjoy Coding. Share this..Cheers..:)   
	</p>
	
	
	
		<!-- Text input-->
		<div class="control-group">
		  <label class="control-label" for="q">Search For</label>
		  <div class="controls">
			<input id="q" name="q" placeholder="Sachin Tendulkar" class="input-xlarge" required="" value="<?php if(isset($q)) echo urldecode($q); ?>">
			
		  </div>
		</div>

		<!-- Button -->
		<div class="control-group">
		  <label class="control-label" for="expand"></label>
		  <div class="controls">
			<button type="submit" id="expand" name="expand" class="btn btn-primary">Search Images</button>
		  </div>
		</div>

		</fieldset>
	</form>

   
   
    </div> <!-- /container -->
 
 <?php
   if(isset($googleImagesArr) && count($googleImagesArr)>0)
   {
	foreach($googleImagesArr['responseData']['results'] as $googleImagesArrImg)
		{
		?>
		<img src="<?php echo $googleImagesArrImg['unescapedUrl']; ?>" border="0" width="150"/>&nbsp;
		<?php
		}

		echo "<br/>";

		foreach($googleImagesArr['responseData']['cursor']['pages'] as $googleImagesPages)
		{?>

		<a href="index.php?p=<?php echo $googleImagesPages['start']; ?>&q=<?php echo $q; ?>"><?php echo $googleImagesPages['label']; ?></a>&nbsp;
		<?php
		}
	}	
 ?>		
	
  </body>
</html>