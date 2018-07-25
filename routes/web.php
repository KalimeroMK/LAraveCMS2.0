<?php

Route::get('/', 'HomeController@index');
Route::get('/rss.xml', 'HomeController@rss');
Route::get('/sitemap.xml', 'HomeController@sitemap');
Route::get('/login', 'AuthController@getLogin');
Route::get('/forgot-password', 'AuthController@getForgotPassword');
Route::post('/forgot-password', 'AuthController@postForgotPassword');
Route::post('/login', 'AuthController@postLogin');
Route::get('/logout', 'AuthController@getLogout');
Route::post('/reset_password', 'AuthController@postReset');
Route::get('/reset_password/{email}/{reset_code}', 'AuthController@getReset');
Route::post('/forgot_password', 'AuthController@getForgotPassword');

//Error Handler
Route::get('/403', 'HomeController@show403');
Route::get('/getcwd', function(){
    return getcwd();
});
Route::get('/locatephp5', function(){
    return exec('locate php5');
});
Route::get('/locatephp', function(){
    return exec('locate php');
});
Route::get('/404', 'HomeController@show404');
Route::get('/500', 'HomeController@show500');
Route::get('/503', 'HomeController@show503');

//Site Routes
Route::get('/page/{page_slug}', 'HomeController@page');
Route::get('/author/{author_slug}', 'HomeController@byAuthor');
Route::get('/category/{category_slug}', 'HomeController@byCategory');
Route::get('/category/{category_slug}/{sub_category_slug}', 'HomeController@bySubCategory');
Route::get('/tag/{tag_slug}', 'HomeController@byTag');
Route::get('/search', 'HomeController@bySearch');
Route::get('/rss.xml', 'HomeController@rss');
Route::get('/rss', 'HomeController@rss');
Route::get('/rss/{category_slug}', 'HomeController@categoryRss');
Route::get('/rss/{category_slug}/{sub_category_slug}', 'HomeController@subCategoryRss');
Route::get('/sitemap.xml', 'HomeController@sitemap');

Route::post('/submit_rating', 'HomeController@submitRating');
Route::post('/submit_likes', 'HomeController@submitLike');

//Admin Routes

Route::group(array('namespace' => 'Admin', 'prefix' => 'admin', 'middleware' => 'auth'), function () {

    Route::get('/', 'DashboardController@index');

    Route::get('/update_application', 'DashboardController@updateApplication');

    Route::get('/gvva-access', 'DashboardController@giveMeWriteAccess');
    Route::get('/rmva-access', 'DashboardController@removeWriteAccess');

//    Route::group(array('prefix' => 'api'), function () {
//        get('/get_sub_categories_by_category/{id}', 'APIController@getSubCategories');
//        get('/get_tags', 'APIController@getTags');
//    });

    Route::group(array('prefix' => 'crons'), function () {

        Route::get('/', 'CronController@all');
        Route::get('/all', 'CronController@all');
        Route::get('/run', 'CronController@run');

        Route::get('/view/{id}', 'CronController@view')->where(array('id' => '[0-9]+'));
        Route::get('/delete/{id}', 'CronController@delete')->where(array('id' => '[0-9]+'));;

    });

    Route::group(array('prefix' => 'roles'), function () {

        Route::get('/', 'UserRolesController@all');
        Route::get('/all', 'UserRolesController@all');

        Route::get('/create', 'UserRolesController@create');
        Route::get('/edit/{id}', 'UserRolesController@edit')->where(array('id' => '[0-9]+'));
        Route::get('/delete/{id}', 'UserRolesController@delete')->where(array('id' => '[0-9]+'));;

        Route::post('/create', 'UserRolesController@store');
        Route::post('/update', 'UserRolesController@update');

    });


    Route::group(array('prefix' => 'users'), function () {

        Route::get('/', 'UsersController@all');
        Route::get('/all', 'UsersController@all');

        Route::get('/create', 'UsersController@create');
        Route::get('/edit/{id}', 'UsersController@edit')->where(array('id' => '[0-9]+'));
        Route::get('/delete/{id}', 'UsersController@delete')->where(array('id' => '[0-9]+'));;

        Route::post('/create', 'UsersController@store');
        Route::post('/update', 'UsersController@update');

    });

    Route::group(array('prefix' => 'categories'), function () {

        Route::get('/', 'CategoryController@all');
        Route::get('/all', 'CategoryController@all');

        Route::get('/create', 'CategoryController@create');
        Route::get('/edit/{id}', 'CategoryController@edit')->where(array('id' => '[0-9]+'));;
        Route::get('/delete/{id}', 'CategoryController@delete')->where(array('id' => '[0-9]+'));;

        Route::post('/create', 'CategoryController@store');
        Route::post('/update', 'CategoryController@update');

    });

    Route::group(array('prefix' => 'sub_categories'), function () {

        Route::get('/', 'SubCategoryController@all');
        Route::get('/all', 'SubCategoryController@all');

        Route::get('/create', 'SubCategoryController@create');
        Route::get('/edit/{id}', 'SubCategoryController@edit')->where(array('id' => '[0-9]+'));;
        Route::get('/delete/{id}', 'SubCategoryController@delete')->where(array('id' => '[0-9]+'));;

        Route::post('/create', 'SubCategoryController@store');
        Route::post('/update', 'SubCategoryController@update');

    });

    Route::group(array('prefix' => 'sources'), function () {

        Route::get('/', 'SourcesController@all');
        Route::get('/all', 'SourcesController@all');
        Route::get('/pull_feeds', 'SourcesController@pullFeeds');
        Route::get('/pull_page', 'SourcesController@pullPages');

        Route::get('/create', 'SourcesController@create');
        Route::get('/edit/{id}', 'SourcesController@edit')->where(array('id' => '[0-9]+'));;
        Route::get('/refresh/{id}', 'SourcesController@refresh')->where(array('id' => '[0-9]+'));;
        Route::get('/delete/{id}', 'SourcesController@delete')->where(array('id' => '[0-9]+'));;

        Route::post('/create', 'SourcesController@store');
        Route::post('/update', 'SourcesController@update');

    });

    Route::group(array('prefix' => 'posts'), function () {

        Route::get('/', 'PostsController@all');
        Route::get('/all', 'PostsController@all');

        Route::get('/create', 'PostsController@create');
        Route::get('/edit/{id}', 'PostsController@edit')->where(array('id' => '[0-9]+'));
        Route::get('/delete/{id}', 'PostsController@delete')->where(array('id' => '[0-9]+'));

        Route::post('/create', 'PostsController@store');
        Route::post('/update', 'PostsController@update');

    });

    Route::group(array('prefix' => 'ratings'), function () {
        Route::get('/', 'RatingsController@all');
        Route::get('/all', 'RatingsController@all');
        Route::get('/delete/{id}', 'RatingsController@delete')->where(array('id' => '[0-9]+'));
    });

    Route::group(array('prefix' => 'tags'), function () {
        Route::get('/', 'TagsController@all');
        Route::get('/all', 'TagsController@all');
        Route::get('/delete/{id}', 'TagsController@delete')->where(array('id' => '[0-9]+'));
    });

    Route::group(array('prefix' => 'pages'), function () {

        Route::get('/', 'PagesController@all');
        Route:: get('/all', 'PagesController@all');

        Route::get('/create', 'PagesController@create');
        Route::get('/edit/{id}', 'PagesController@edit')->where(array('id' => '[0-9]+'));
        Route::get('/delete/{id}', 'PagesController@delete')->where(array('id' => '[0-9]+'));

        Route::post('/create', 'PagesController@store');
        Route::post('/update', 'PagesController@update');

    });

    Route::group(array('prefix' => 'ads'), function () {

        Route::get('/', 'AdsController@all');
        Route::get('/all', 'AdsController@all');

        Route::get('/create', 'AdsController@create');
        Route::get('/edit/{id}', 'AdsController@edit')->where(array('id' => '[0-9]+'));;
        Route::get('/delete/{id}', 'AdsController@delete')->where(array('id' => '[0-9]+'));;

        Route::post('/create', 'AdsController@store');
        Route::post('/update', 'AdsController@update');

    });

    Route::group(array('prefix' => 'statistics'), function () {

        Route::get('/', 'StatisticsController@all');
        Route::get('/all', 'StatisticsController@all');


    });

    Route::group(array('prefix' => 'settings'), function () {

        Route::get('/', 'SettingsController@all');
        Route::get('/all', 'SettingsController@all');
        Route::get('delete_manually/{days}', 'SettingsController@deleteOldManually');

        Route::post('update_custom_css', 'SettingsController@updateCustomCSS');
        Route::post('update_custom_js', 'SettingsController@updateCustomJS');
        Route::post('update_social', 'SettingsController@updateSocial');
        Route::post('update_comments', 'SettingsController@updateComments');
        Route::post('update_seo', 'SettingsController@updateSEO');
        Route::post('update_general', 'SettingsController@updateGeneral');
        Route::post('delete_old_news', 'SettingsController@updateDeleteNews');

    });

    Route::get('/redactor/images.json', 'DashboardController@redactorImages');
    Route::post('redactor', 'DashboardController@handleRedactorUploads');


});


//should be last route
Route::get('/{article_slug}', 'HomeController@article');
