<?php
require "vendor/autoload.php";
use PHPHtmlParser\Dom;
// We need to use sessions, so you should always start sessions using the below code.
session_start();
// If the user is not logged in redirect to the login page...

if (!isset($_SESSION['loggedin'])) {
	header('Location: index.html');
	exit;
}
if(isset($_POST["submit"])) {
	
	$url = 'http://192.168.1.55:1000';
	$data = array('user' => $_SESSION['name'], 'info' => $_POST['info']);
	// use key 'http' even if you send the request to https://...
	$options = array(
	    'http' => array(
	        'header'  => "Content-type: application/x-www-form-urlencoded\r\n",
	        'method'  => 'POST',
	        'content' => http_build_query($data)
	    )
	);
	$context  = stream_context_create($options);
	$result = file_get_contents($url, false, $context);
	if ($result === FALSE) { /* Handle error */ 
	var_dump($result);
	}
}
?>
<!DOCTYPE html>
<html>
	<head>
		<meta charset="utf-8">
		<title>Home Page</title>
		<?php
		if($_SESSION['darkmode'] === false)
		{
			echo '<link href="second.css" rel="stylesheet" type="text/css">';
		}else{
			echo '<link href="dark.css" rel="stylesheet" type="text/css">';
		}
		?>
		<link rel="stylesheet" href="https://cdnjs.cloudflare.com/ajax/libs/font-awesome/4.7.0/css/font-awesome.min.css">
	</head>
  <nav class="navtop">
		<div>
			<h1>Blumberg Economics </h1>
			<a href="home.php"><i class="fas fa-home-alt"></i>home</a>
			<a href="profile.php"><i class="fas fa-user-circle"></i>Profile</a>
			<a href="logout.php"><i class="fas fa-sign-out-alt"></i>Logout</a>
		</div>
	</nav>



<div class="row">
  <div class="leftcolumn">
    <?php

	$dom = new Dom;

	$dom->loadFromUrl('https://lenta.ru/rubrics/economics/markets/');
	$a = $dom->find('h3');
	foreach ($a as $a)
	{
		echo '<div class="card">';
		echo "<p>" . $a->text. "</p>";
		echo '</div> ';
	} 
	

		$json = file_get_contents("http://192.168.1.55:1000/posts");
		$obj = json_decode($json);
		
		foreach($obj as $post){
			echo '<div class="card"';
			echo " id = "."$post->post_id".">";
			echo "<h5>" ."This post was made by: "  ."$post->post_user". "</h5>" . "<p>". $post->post_info . "</p>";
			echo '</div> ';
		}
	?>
  </div>
  <div class="rightcolumn">
  <?php if($_SESSION['name'] == "admin"){
        echo '<div class="card">
      <form method = "post">
          <div class="form-input">
            <input type="info" name="info" placeholder="Type your post "/>
        </div>
        <div class="form-input">
            <input type="submit" value="Post" class="submit" name ="submit"/>
        </div>
      </form>
    </div>';
    }
    ?>
	<div class="card">
	<iframe style="width:100%;border:0;overflow:hidden;background-color:transparent;height:283px" scrolling="no" src="https://fortrader.org/informers/getInformer?st=8&cat=7&title=%D0%9A%D1%83%D1%80%D1%81%D1%8B%20%D0%B2%D0%B0%D0%BB%D1%8E%D1%82%20%D0%A6%D0%91%20%D0%A0%D0%A4&texts=%7B%22toolTitle%22%3A%22%D0%92%D0%B0%D0%BB%D1%8E%D1%82%D0%B0%22%2C%22todayCourse%22%3A%22RUB%22%7D&mult=1&showGetBtn=0&hideHeader=0&hideDate=0&w=0&codes=1&colors=false&items=2%2C21%2C30&columns=todayCourse&toCur=11111"></iframe> 
	
	<!-- <?php
		$file = simplexml_load_file("http://www.cbr.ru/scripts/XML_daily.asp?date_req=".date("d/m/Y"));
	
		$xml = $file->xpath("//Valute[@ID='R01235']");
		$valute_usd = strval($xml[0]->Value);
		echo $valute_usd; // курс доллар
	
		echo '<br>';
		$xml = $file->xpath("//Valute[@ID='R01239']");
		$valute_euro = strval($xml[0]->Value);
		echo $valute_euro; // курс евро
	?>  -->
  </div>
  <div class="card">
  	<iframe style="width:100%;border:0;overflow:hidden;background-color:transparent;height:481.141px" scrolling="no" src="https://fortrader.org/informers/getInformer?st=1&cat=15&title=%D0%9A%D1%80%D0%B8%D0%BF%D1%82%D0%BE%D0%B2%D0%B0%D0%BB%D1%8E%D1%82%D1%8B&texts=%7B%22toolTitle%22%3A%22%D0%9A%D1%80%D0%B8%D0%BF%D1%82%D0%BE%D0%B2%D0%B0%D0%BB%D1%8E%D1%82%D0%B0%22%2C%22bid%22%3A%22%D0%A6%D0%B5%D0%BD%D0%B0%22%7D&mult=1&showGetBtn=0&w=0&colors=false&items=133%2C25457%2C25470%2C25467%2C25469%2C25468%2C25499%2C25553&columns=bid"></iframe>
	</div>
  <div class="card">
 	 <iframe style="width:100%;border:0;overflow:hidden;background-color:transparent;height:317px" scrolling="no" src="https://fortrader.org/informers/getInformer?st=1&cat=10&title=%D0%9C%D0%B5%D1%82%D0%B0%D0%BB%D0%BB%D1%8B&texts=%7B%22toolTitle%22%3A%22%D0%9C%D0%B5%D1%82%D0%B0%D0%BB%D0%BB%22%2C%22bid%22%3A%22%D0%A6%D0%B5%D0%BD%D0%B0%22%7D&mult=1&showGetBtn=0&w=0&colors=false&items=48%2C25459%2C25458%2C25466&columns=bid"></iframe>
  </div>
  <div class="card">
 	 <iframe style="width:100%;border:0;overflow:hidden;background-color:transparent;height:656.844px" scrolling="no" src="https://fortrader.org/informers/getInformer?st=12&cat=12&title=%D0%A0%D0%BE%D1%81%D1%81%D0%B8%D0%B9%D1%81%D0%BA%D0%B8%D0%B5%20%D0%B0%D0%BA%D1%86%D0%B8%D0%B8&texts=%7B%22toolTitle%22%3A%22%D0%90%D0%BA%D1%86%D0%B8%D1%8F%22%2C%22bid%22%3A%22%D0%A6%D0%B5%D0%BD%D0%B0%22%7D&mult=1&showGetBtn=0&w=0&colors=false&items=3%2C10%2C6%2C8%2C125%2C821%2C25515%2C25537%2C25519%2C25538&columns=bid"></iframe>
  </div>
  <div class="card">
	  <iframe style="width:100%;border:0;overflow:hidden;background-color:transparent;height:328px" scrolling="no" src="https://fortrader.org/informers/getInformer?st=52&cat=23&texts=%7B%22toolTitle%22%3A%22%D0%91%D0%B8%D1%80%D0%B6%D0%B5%D0%B2%D1%8B%D0%B5%20%D0%BD%D0%BE%D0%B2%D0%BE%D1%81%D1%82%D0%B8%22%7D&mult=0.87&w=0&slts=1&colors=titleTextColor%3Dffffff%2CtitleBackgroundColor%3D2f3947%2CborderLeftColor%3D2f3947%2CnewsBackgroundColor%3Df1f1f1%2CnewsTextColor%3D555555%2CtimeTextColor%3D888888%2CnewsBorderColor%3Df1f1f1&items=5%2C641%2C4343%2C11752"></iframe>
	</div>
</div>
</body>
</html>