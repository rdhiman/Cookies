
<?php
    
class CookieManager {
    public function __construct(){
        $this->{'myCookieJar'} = tempnam('/playground', 'cookies');
    }

    public function getPageWithCookies($cookieString, $myUrl){
        $c = curl_init($myUrl);
        curl_setopt($c, CURLOPT_VERBOSE, 1);
        curl_setopt($c, CURLOPT_COOKIE, $cookieString);
        curl_setopt($c, CURLOPT_RETURNTRANSFER, 1);
        $this->{'page'} = curl_exec($c);
        curl_close($c);
    }

    private function setCookieJarOnPage($myUrl){
        $c = curl_init($myUrl);
        curl_setopt($c, CURLOPT_VERBOSE, 1);
        curl_setopt($c, CURLOPT_COOKIEJAR, $this->myCookieJar);
        curl_setopt($c, CURLOPT_RETURNTRANSFER, 1);
        $this->{'page'} = curl_exec($c);
        curl_close($c);
    }

    public function getPageWithCookieFile($myUrl){
        $this->setCookieJarOnPage($myUrl);
        $c = curl_init($myUrl);
        curl_setopt($c, CURLOPT_VERBOSE, 1);
        curl_setopt($c, CURLOPT_COOKIEFILE, $this->myCookieJar);
        curl_setopt($c, CURLOPT_COOKIEJAR, $this->myCookieJar);
        curl_setopt($c, CURLOPT_RETURNTRANSFER, 1);
        $this->{'page'} = curl_exec($c);
        curl_close($c);
    }

    public function printPage(){
        print($this->page);
    }

}


?>


<!--
<h2> getPageWithCookies results </h2>
<div style="border: 1px dotted; padding: 5px;">
    <?php
        $myCookieManager = new CookieManager();

        $myCookieManager->getPageWithCookies('chocolateChip=delicious;','http://www.target.com/');
        $myCookieManager->printPage();
    ?>
</div-->
<h2> getPageWithCookieFile results </h2>
<div style="border: 1px dotted; padding: 5px;">
    <?php
        $myCookieManager->getPageWithCookieFile('http://www.target.com/');
        $myCookieManager->printPage();
        var_dump($myCookieManager->myCookieJar);
    ?>
</div>