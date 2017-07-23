<?php

	require __DIR__ . '/vendor/autoload.php';

	use Serps\SearchEngine\Google\GoogleClient;
    use Serps\HttpClient\CurlClient;
    use Serps\Core\Browser\Browser;
    use Serps\SearchEngine\Google\GoogleUrl;
    use Serps\SearchEngine\Google\NaturalResultType;

    function isKeyword($term) {
        // $arr1 = array (1=>'littlenineheaven',2=>'Shih Shui Kung Fu Temple',3=>'405 Lake Cook Road',4=>'shih-shui-deerfield');
        // file_put_contents("keywords.json",json_encode($arr1));
         
        $keywords = json_decode(file_get_contents('keywords.json'), true); 
        foreach($keywords as $keyword){echo $keyword .'<br>';}
        return "korean";

    }

    $userAgent = 'Mozilla/5.0 (Windows NT 6.1) AppleWebKit/537.36 (KHTML, like Gecko) Chrome/41.0.2228.0 Safari/537.36';
    $language = 'en-US';
    $someProxy=null; 
    $someCookies=null;
    $browser = new Browser(new CurlClient(), $userAgent, $language, $someProxy, $someCookies);

    $googleUrl = new GoogleUrl();
    $searchTerm = 'SHIH SHUI KUNG FU';
    $googleUrl->setSearchTerm($searchTerm);

    $googleClient = new GoogleClient($browser);
    $response = $googleClient->query($googleUrl);

    $results = $response->getNaturalResults();
    

  ?>

<!DOCTYPE html>
<html lang="en-US">
<head>
	<meta charset="UTF-8">
    <meta http-equiv="Content-Type" content="text/html; charset=UTF-8" />
	<title>Testing curl with serps</title>
</head>
<body>

<h3>Google words searched: <?php echo $searchTerm; ?></h3>
<ol>

<?php 

    foreach($results as $result){
        if($result->is(NaturalResultType::CLASSICAL)){
            $title=$result->title;
            $url = $result->url;
            echo '<li>' .$title .'<br>';
            echo '<a href="'.$url .'" target="_BLANK">' .$url .'</a></li>';
        }
    }

    $temp = 'hotdog';
    try {if (isKeyword($temp)=='korean') {echo 'success!';};} 
    catch (Exception $e) {echo 'Caught exception: ',$e->getMessage(),"\n";}

?>
</ol>

<?php 
// echo phpinfo(); 
// echo phpversion();
 ?>
</body>
</html>