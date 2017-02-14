<?php
use \Psr\Http\Message\ServerRequestInterface as Request;
use \Psr\Http\Message\ResponseInterface as Response;
use \Respect\Validation\Validator as v;

require '../../vendor/autoload.php';
require 'common.php';
$app = new \Slim\App;


// Setup validation
$usernameValidator = v::alnum()->noWhitespace()->length(1,10);
$ageValidator = v::numeric()->positive()->between(1,20);
$validator = array(
    'username'  => $usernameValidator,
    'age'       => $ageValidator
);


// Get container
$container = $app->getContainer();

// Register component on container
$container['view'] = function ($container) {
    $view = new \Slim\Views\Twig('../templates', [
        'cache' => '../cache'
    ]);
    
    // Instantiate and add Slim specific extension
    $basePath = rtrim(str_ireplace('index.php', '', $container['request']->getUri()->getBasePath()), '/');
    $view->addExtension(new Slim\Views\TwigExtension($container['router'], $basePath));

    return $view;
};

// Old lab
// $app->get('/hello/{name}',function($request,$respond,$args){
//     return $this->view->render($respond,'profile.html',[
//         'name' => $args['name']
//     ]);
// });

// $app->get('/select/{userid}',function($request,$respond,$args)
// use($pdo){
//     $query = "SELECT * FROM user_info WHERE us_id=".$args['userid'];
//     $data = $pdo->query($query);
//     return $this->view->render($respond,'profile.html',[
//         'data'  => $data[0]
//     ]);
// });
$app->get('/edit/{userid}',function($request,$respond,$args)
use($pdo){
    $query = "SELECT * FROM user_info WHERE us_id = ?";
    $data = $pdo->query($query,array($args['userid']));
    return $this->view->render($respond,'edit.html',[
        'data'  => $data[0]
    ]);
});

$app->post('/edit/save',function($request,$respond,$args)
use($pdo){
    $data = json_decode($request->getBody()) ?: $request->getParams();
    $query = "UPDATE user_info SET firstname= ?, lastname= ? WHERE us_id= ?";
    $db = $pdo->query($query,array($data['firstname'],$data['lastname'],$data['id']));
    return $this->view->render($respond,'saveedit.html',[
        'firstname'  => $data['firstname'],
        'lastname'  => $data['lastname']
    ]);
});

$app->get('/list',function($request,$respond,$args)
use($pdo){
    $query = "SELECT * FROM user_info";
    $data = $pdo->query($query);
    return $this->view->render($respond,'list.html',[
        'data'  => $data
    ]);
});

$app->post('/create',function($request,$respond,$args)
use($pdo){
   
    $data = json_decode($request->getBody()) ?: $request->getParams();
    $firstname = $data['firstname'];
    $lastname = $data['lastname'];
    $query = "INSERT INTO user_info (firstname,lastname,created_by,updated_by)
                VALUES(?,?,'9999','0')";
    $db = $pdo->query($query,array($firstname, $lastname));


   return $this->view->render($respond,'save.html',[
        'firstname'  => $data['firstname'],
        'lastname'  => $data['lastname'],
        'data' => $data
        
    ]);
});


$app->get('/',function($request,$respond,$args)
use($pdo){
    $query = "SELECT * FROM user_info";
    $data = $pdo->query($query);
    return $this->view->render($respond,'list.html',[
        'data'  => $data
    ]);
});



$app->get('/register',function($request,$respond,$args){
    return $this->view->render($respond,'register.html',[
    ]);
});
$app->get('/form',function($request,$respond,$args){
    return $this->view->render($respond,'validate.html',[
    ]);
});


$app->post('/regis/per/route',function($request,$respond,$args){
    
    $data = json_decode($request->getBody()) ?: $request->getParams();

    if($request->getAttribute('has_errors')){
        $err_mes  = "";
        $error = $request->getAttribute('errors');
        foreach($error as $key => $list){
            foreach ($list as $value) {
                $err_mes .= $key." ".$value."<br>";
            }
        }
        $respond->getBody()->write("Error: ".$err_mes);
    }else{
        $respond->getBody()->write("Valid");
    }
})->add(new \DavidePastore\Slim\Validation\Validation($validator));

$app->run();

?>