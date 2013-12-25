<?php

/*
|--------------------------------------------------------------------------
| hsyngkby/gettext Routes
|--------------------------------------------------------------------------
*/

Route::get('set-locale/{locale}', function($locale) {
    // set locale
    gettext::setLocale($locale);

    // redirect to referrer or home
    if (Request::server('HTTP_REFERER'))
        return Redirect::to($_SERVER['HTTP_REFERER']);
    else
        return Redirect::to('/');
});

Route::get('set-encoding/{encoding}', function($encoding) {
    // set encoding
    gettext::setEncoding($encoding);

    // redirect to referrer or home
    if (Request::server('HTTP_REFERER'))
        return Redirect::to($_SERVER['HTTP_REFERER']);
    else
        return Redirect::to('/');
});
