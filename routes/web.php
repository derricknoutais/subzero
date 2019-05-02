<?php
use GuzzleHttp\Client;
/*
|--------------------------------------------------------------------------
| Web Routes
|--------------------------------------------------------------------------
|
| Here is where you can register web routes for your application. These
| routes are loaded by the RouteServiceProvider within a group which
| contains the "web" middleware group. Now create something great!
|
*/

Route::get('/', 'SubController@create');

Auth::routes();

Route::get('/home', 'HomeController@index')->name('home');

Route::get('/sub', 'SubController@index');
Route::get('/api/sub', 'SubController@apiIndex');
Route::get('/sub/create', 'SubController@create');
Route::post('/sub/store', 'SubController@store');

Route::get('/products/create', function(){
    $client = new Client();
    $headers = [
        "Authorization" => "Bearer CjOC4V9CKof2GyEEdPE0Y_E4t742kylC76bxK7oX",
        'Accept'        => "application/json",
    ];
    $response = $client->request('GET', 'https://stapog.vendhq.com/api/products?sku=' . $sku, ['headers' => $headers]);
    $data = (string)$response->getBody();
    $products = json_decode($data, true);
    return $products['products'];
});

// Get All Products
Route::get('/api/produits/{sku}', function ($sku) {

    $client = new Client();
    $headers = [
        "Authorization" => "Bearer CjOC4V9CKof2GyEEdPE0Y_E4t742kylC76bxK7oX",
        'Accept'        => 'application/json',
    ];

    $response = $client->request('GET', 'https://stapog.vendhq.com/api/products?sku=' . $sku, ['headers' => $headers]);
    $data = (string)$response->getBody();
    $products = json_decode($data, true);
    return $products['products'];
});

Route::get( '/api/produits/{handle}', function ( $handle) {

    $client = new Client();
    $headers = [
        "Authorization" => "Bearer CjOC4V9CKof2GyEEdPE0Y_E4t742kylC76bxK7oX",
        'Accept'        => 'application/json',
    ];
    
    $response = $client->request('GET', 'https://stapog.vendhq.com/api/products?handle=' . $handle, ['headers' => $headers]);
    $data = (string)$response->getBody();
    $products = json_decode($data, true);
    return $products['products'];
});

Route::get('/store', function(){
    $client = new Client();
    $headers = [
        "Authorization" => "Bearer CjOC4V9CKof2GyEEdPE0Y_E4t742kylC76bxK7oX",
        'exceptions' => false
    ];
    $options = [
        'form-params' => [
            'handle' => 'collebostique',
            'name' => 'testbostique',
            'sku' => '12345',
            'retail_price' => 1230
        ]
    ];

    $response = $client->request('POST', 'https://stapog.vendhq.com/api/products',['headers' => $headers], $options);
    return $response;
    $products = json_decode($data, true);
    return $products['products'];
});