<?php

require '../vendor/autoload.php';

$klein = new \Klein\Klein();

$klein->respond(function ($request, $response, $service, $app) use ($klein) {
  $config = new \Doctrine\DBAL\Configuration();
  $connectionParams = array(
    //'user'     => 'user',
    //'password' => 'secret',
    'path'     => '../database.sqlite',
    'driver'   => 'pdo_sqlite',
  );

  $app->register('db', function() use($connectionParams, $config) {
    return \Doctrine\DBAL\DriverManager::getConnection($connectionParams, $config);
  });

  $app->register('issues', function() use($app) {
    return new \BellcomDrift\Issues($app);
  });
});

$klein->respond('GET', '/', function ($request, $response, $service, $app) {
  $unresolved = $app->issues->getUnResolved();

  $limit = 5;
  $resolved   = $app->issues->getResolved( $limit );

  $service->render('../templates/index.tpl.php', array('unresolved_issues' => $unresolved, 'resolved_issues' => $resolved));
});

$klein->respond('GET', '/setup', function ($request, $response, $service, $app) {
  $sql = "CREATE TABLE `issues` (`id` INTEGER PRIMARY KEY NOT NULL UNIQUE, `date` INTEGER NOT NULL, `title` VARCHAR NOT NULL, `author` VARCHAR NOT NULL, `desc` VARCHAR NOT NULL, `resolved` BOOL NOT NULL DEFAULT 0)";
  $app->db->query($sql);

  $service->render('../templates/setup.tpl.php');
});

$klein->respond('GET', '/admin', function ($request, $response, $service, $app) {
  $unresolved = $app->issues->getUnResolved();

  $limit = 5;
  $resolved   = $app->issues->getResolved( $limit );

  $service->render('../templates/admin/index.tpl.php', array('unresolved_issues' => $unresolved, 'resolved_issues' => $resolved));
});

$klein->respond('POST', '/admin/create', function ($request, $response, $service, $app) {
  $params = $request->paramsPost()->all();

  $app->issues->create( $params );

  $response->redirect('/admin');
});


$klein->respond('POST', '/admin/update', function ($request, $response, $service, $app) {
  $params = $request->paramsPost()->all();

  if ( isset($params['delete']) )
  {
    $app->issues->delete( $params['issue-id']);
  }
  else
  {
    $params['resolved']   = (isset($params['resolved']) ? 1 : 0);

    $app->issues->update( $params['issue-id'], $params );
  }

  $response->redirect('/admin');
});
