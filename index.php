<?php

	require __DIR__ . '/vendor/autoload.php';

	use Serps\SearchEngine\Google\GoogleClient;
    use Serps\HttpClient\CurlClient;
    use Serps\Core\Browser\Browser;
    use Serps\SearchEngine\Google\GoogleUrl;

    $userAgent = 'Mozilla/5.0 (Windows NT 10.0) AppleWebKit/537.36 (KHTML, like Gecko) Chrome/40.0.2214.93 Safari/537.36';
    $language = 'en-US,en;q=0.8';

    // $browser = new Browser(new CurlClient(), $userAgent, $language, $someProxy, $someCookies);
    $browser = new Browser(new CurlClient(), $userAgent, $language);


    $googleUrl = new GoogleUrl();
    $googleUrl->setSearchTerm('cats');

    $googleClient = new GoogleClient($browser);
    $response = $googleClient->query($googleUrl);

    // Alternatively you can pass browser at request time:
    // $googleClient = new GoogleClient();
    // $response = $googleClient->query($googleUrl, $browser);

    $results = $response->getNaturalResults();

    // foreach($results as $result){
    //     // Analyse the results
    // }

?>

<!DOCTYPE html>
<html lang="en-US">
<head>
	<meta charset="UTF-8">
	<title>Testing curl with serps</title>
</head>
<body>

<?php 
// echo phpinfo(); 
echo("hello");
?>

</body>
</html>