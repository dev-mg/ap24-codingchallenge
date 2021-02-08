<?php

use DavidePastore\Slim\Validation\Validation;
use Psr\Http\Message\ResponseInterface as Response;
use Psr\Http\Message\ServerRequestInterface as Request;
use Respect\Validation\Exceptions\NestedValidationException;
use Respect\Validation\Validator as v;
use Slim\Factory\AppFactory;

require __DIR__ . '/../vendor/autoload.php';

$app = AppFactory::create();
$app->addBodyParsingMiddleware();
$app->addRoutingMiddleware();
$app->addErrorMiddleware(true, true, true);

$idRules = v::alnum()->noWhitespace()->length(3, 10);
$mileageRules = v::number()->positive();
$preownersRules = v::number()->between(1, 3);

$carValidator = v::attribute('id', $idRules)
    ->attribute('mileage', $mileageRules)
    ->attribute('preowners', $preownersRules);

$app->get('/', function (Request $request, Response $response) {
    $response->getBody()->write("Hello AP24!");
    return $response;
});

$app->post('/test/{id}', function (Request $request, Response $response, array $args) use ($carValidator) {
    $input = $request->getParsedBody();

    $car = new stdClass();
    $car->id = $args['id'];
    $car->mileage = $input['mileage'];
    $car->preowners = $input['preowners'];

    try {
        $carValidator->assert($car);
    } catch (NestedValidationException $exception) {
        $data = array(
            'errors' => $exception->getMessages()
        );
        return $response->withJson($data, 422);
    }

    $data = array(
        'id' => $car->id,
        'mileage' => $car->mileage
    );

    return $response->withJson($data, 200);
});

$app->run();