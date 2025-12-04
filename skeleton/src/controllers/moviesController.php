<?php

use Models\User;

$error = [];
$movie = new Models\Movie();
$movie->getAll();

if (!empty($_POST)) {
    $creerunfilm = new Models\Movie();

    try {
        $creerunfilm->setTitle(($_POST['titre']));
    } catch (\Exception $e) {
        $error['titre'] = $e->getMessage();
    }
    try {
        $creerunfilm->setType(($_POST['type']));
    } catch (\Exception $e) {
        $error['email'] = $e->getMessage();
    }
    try {
        $creerunfilm->setrating($_POST['rating']);
    } catch (\Exception $e) {
        $error['password'] = $e->getMessage();
    }

    if (empty($error)) {
        if ($creerunfilm->register()) {
            redirectTo('/movies');
        } else {
            $error['global'] = 'Echec de l\'enregistrement';
        }
    }
}
render('index', false, [
    'error' => $error,
]);
