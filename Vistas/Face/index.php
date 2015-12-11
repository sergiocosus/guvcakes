<!DOCTYPE html>
<!--
To change this license header, choose License Headers in Project Properties.
To change this template file, choose Tools | Templates
and open the template in the editor.
-->
<html>
    <head>
        <meta charset="UTF-8">
        <title></title>
    </head>
    <body>
        
        
<p><a href="#" onClick="logInWithFacebook()">
        Iniciar Sesión en facebook y publicar aleatoriamente una fotografía
    </a></p>

<script>
    logInWithFacebook = function() {
        FB.login(function(response) {
            if (response.authResponse) {
                window.location.reload();
            } else {
                alert('Ha fallado el inicio de sesión');
            }
        }, {
            scope: 'manage_pages', 
            return_scopes: true
        });
        return false;
    };
    window.fbAsyncInit = function() {
        FB.init({
            appId: '151504458379563',
            cookie: true, // This is important, it's not enabled by default
            version: 'v2.0'
        });
    };

    (function(d, s, id){
        var js, fjs = d.getElementsByTagName(s)[0];
        if (d.getElementById(id)) {return;}
        js = d.createElement(s); js.id = id;
        js.src = "//connect.facebook.net/en_US/sdk.js";
        fjs.parentNode.insertBefore(js, fjs);
    }(document, 'script', 'facebook-jssdk'));
</script>
        <?php
        
        
    session_start();

function generarLink($catId){
    global $categorias,$cantCat;
    for($i=0;$i<$cantCat;$i++){
        if($categorias[$i]->id===$catId){
            return generarLink($categorias[$i]->catId).'/'.$categorias[$i]->link;
        }
    }
    return "";
}
global $categorias,$cantCat;


$fb = new Facebook\Facebook([
    'app_id' => '151504458379563',
    'app_secret' => '9d1068561b449d2a59303562d40f2532',
    'default_graph_version' => 'v2.0',
]);

$helper = $fb->getJavaScriptHelper();

try {
    $accessToken = $helper->getAccessToken();
} catch(Facebook\Exceptions\FacebookResponseException $e) {
    // When Graph returns an error
    echo 'Graph returned an error: ' . $e->getMessage();
    exit;
} catch(Facebook\Exceptions\FacebookSDKException $e) {
    // When validation fails or other local issues
    echo 'Facebook SDK returned an error: ' . $e->getMessage();
    exit;
}

if (! isset($accessToken)) {
    echo 'No cookie set or no OAuth data could be obtained from cookie.';
    exit;
}

echo "Cuenta con sesión iniciada";
// Logged in
//echo '<h3>Access Token</h3>';
//var_dump($accessToken->getValue());

$_SESSION['fb_access_token'] = (string) $accessToken;
        


$categorias=Categoria::obtenerTodos(' where visible=1');
$elementos=Foto::obtenerTodos(' where visible=1 ORDER BY rand() limit 1');





$linkData = [
  'link' => 'http://calvillo.com.mx/Foto/Ver'.generarLink($elementos[$i]->catId).'/'.$elementos[0]->link,
  'message' => $elementos[$i]->descripcion,
  ];

try {
    // Returns a `Facebook\FacebookResponse` object
    $response = $fb->post('/264673240304837/feed', $linkData, $accessToken);
} catch(Facebook\Exceptions\FacebookResponseException $e) {
    echo 'Graph returned an error: ' . $e->getMessage();
    exit;
} catch(Facebook\Exceptions\FacebookSDKException $e) {
    echo 'Facebook SDK returned an error: ' . $e->getMessage();
    exit;
}

$graphNode = $response->getGraphNode();

?>
<a href="https://www.facebook.com/calvillo.com.mx/posts/ <?php echo explode('_', $graphNode)[1]; ?>" >Haga clic aquí para ver el post en facebook!</a>
    </body>
</html>
