<?php
	require __DIR__ . '/vendor/autoload.php';
	use Serps\SearchEngine\Google\GoogleClient;
    use Serps\HttpClient\CurlClient;
    use Serps\Core\Browser\Browser;
    use Serps\SearchEngine\Google\GoogleUrl;
    use Serps\SearchEngine\Google\NaturalResultType;

    // create array of search words to perform individual searches on each set of words
    // $arr1 = array (
    //     1=>'shih shui kung fu',
    //     2=>'shih shui kung fu temple',
    //     3=>'shih shui deerfield',
    //     4=>''
    //     );
    // file_put_contents("searchWords.json",json_encode($arr1));
    // $arr1 = array (
    //     1=>'craigslist androgel',
    //     2=>'craigslist testosterone',
    //     3=>'craigslist testosterone cypionate',
    //     4=>'backpages androgel',
    //     5=>'backpages testerone',
    //     6=>'craigslist andro gel',
    //     7=>'backpages andro gel',
    //     8=>'craigslist wisconsin test'
    //     );
    // file_put_contents("searchWords.json",json_encode($arr1));

    function isKeyword($term) {
        // $arr1 = array (1=>'littlenineheaven',2=>'Shih Shui Kung Fu Temple',3=>'405 Lake Cook Road',4=>'shih-shui-deerfield');
        // file_put_contents("keywords.json",json_encode($arr1));
         
        $keywords = json_decode(file_get_contents('keywords.json'), true); 
        foreach($keywords as $keyword){echo $keyword .'<br>';}
        return "korean";

    }

    // $searchTerm = 'SHIH SHUI KUNG FU'; 
    // $searchTerm = 'craigslist androgel';

    function searchGoogle($searchTerm) {
            $userAgent = 'Mozilla/5.0 (Windows NT 6.1) AppleWebKit/537.36 (KHTML, like Gecko) Chrome/41.0.2228.0 Safari/537.36';
            $language = 'en-US';
            $someProxy=null; 
            $someCookies=null;
            $browser = new Browser(new CurlClient(), $userAgent, $language, $someProxy, $someCookies);
            $googleClient = new GoogleClient($browser);

            $googleUrl = new GoogleUrl();
            $googleUrl->setSearchTerm($searchTerm);
            $response = $googleClient->query($googleUrl);
            $results = $response->getNaturalResults();
            return $results;
    }
    
  ?>

<!DOCTYPE html>
<html lang="en-US">
<head>
<meta charset="utf-8">
<meta http-equiv="X-UA-Compatible" content="IE=edge">
<meta name="viewport" content="width=device-width, initial-scale=1">
<title>AMPT DESIGN SEO</title>
<link href="https://fonts.googleapis.com/css?family=Open+Sans" rel="stylesheet">
<!-- <link rel="stylesheet" href="css/sanitize.css"> -->
<link href="css/bootstrap.min.css" rel="stylesheet">
<!-- <link href="css/style.css" rel="stylesheet"> -->
<!-- HTML5 shim and Respond.js for IE8 support of HTML5 elements and media queries -->
<!-- WARNING: Respond.js doesn't work if you view the page via file:// -->
<!--[if lt IE 9]>
  <script src="https://oss.maxcdn.com/html5shiv/3.7.3/html5shiv.min.js"></script>
  <script src="https://oss.maxcdn.com/respond/1.4.2/respond.min.js"></script>
<![endif]-->
</head>
<body>

<?php 

$searchWords = json_decode(file_get_contents('searchWords.json'), true); 
foreach($searchWords as $searchWord){
    // echo $searchWord .'<br>';
    $searchTerm = $searchWord;
 ?>

<h3>Google words searched: <?php echo $searchTerm; ?></h3>
<ol>

<?php 
    $searchResults = searchGoogle($searchTerm);
    foreach($searchResults as $result){
        if($result->is(NaturalResultType::CLASSICAL)){
            $title=$result->title;
            $url = $result->url;
            echo '<li>' .$title .'<br>';
            echo '<a href="'.$url .'" target="_BLANK">' .$url .'</a></li>';
        }
    }

    // $temp = 'hotdog';
    // try {if (isKeyword($temp)=='korean') {echo 'success!';};} 
    // catch (Exception $e) {echo 'Caught exception: ',$e->getMessage(),"\n";}

?>
</ol>

<?php 
}
// echo phpinfo(); 
// echo phpversion();
 ?>

    <script src="https://ajax.googleapis.com/ajax/libs/jquery/1.12.4/jquery.min.js"></script>
    <script src="js/bootstrap.min.js"></script>
</body>
</html>