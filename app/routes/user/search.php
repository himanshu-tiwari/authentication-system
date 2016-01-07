<?php 

$app->post('/user/search', function() use ($app) {
    $request = $app->request;
    $search = $request->post('user_search');
    $user = $app->user->searchQuery($search);
    if (!$user) {
         $app->notFound();
    }
    $app->render('user/search.php', [
         'users' => $user
    ]);
})->name('user.search.post');