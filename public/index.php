<?php
use Psr\Http\Message\ResponseInterface as Response;
use Psr\Http\Message\ServerRequestInterface as Request;
use Slim\Factory\AppFactory;

require __DIR__ . '/../vendor/autoload.php';

$app = AppFactory::create();
$app->addBodyParsingMiddleware();
$app->addRoutingMiddleware();
$app->addErrorMiddleware(true, true, true);

$app->get('/', function (Request $request, Response $response, $args) {
    $response->getBody()->write("Hello AP24!");
    return $response;
});

$app->post('/test/{id}', function (Request $request, Response $response, array $args) {
	$id = $args['id'];
	
	$_input = $request->getParsedBody();
    $mileage = $_input['mileage'];
    $preowners = $_input['preowners'];
    
	$data = array(
		'id' => $id,
		'mileage' => $mileage
	);

    return $response->withJson($data, 200);
});

$app->run();