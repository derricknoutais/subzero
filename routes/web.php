<?php
use GuzzleHttp\Client;
use App\Produit;
use App\Sub;

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

Route::get('/api/produits', function () {

    $client = new Client();
    $headers = [
        "Authorization" => "Bearer CjOC4V9CKof2GyEEdPE0Y_E4t742kylC76bxK7oX",
        'Accept'        => 'application/json',
    ];

    // $response = $client->request('GET', 'https://stapog.vendhq.com/api/products?page_size=200' , ['headers' => $headers]);
    // $data = (string)$response->getBody();
    // $products = json_decode($data, true);
    // return $products['pagination']['pages'];

    $toDB = array();

    for ($j=13; $j <= 16 ; $j++) { 
        
        $response = $client->request('GET', 'https://stapog.vendhq.com/api/products?page_size=200&page=' . $j , ['headers' => $headers]);
        $data = json_decode( (string)$response->getBody(), true );
        $products = $data['products'];
        
        foreach($products as $product){
            if( ! Produit::where('product_id', $product['id'])->first() ){
                Produit::create([
                    'product_id' => $product['id'],
                    'handle' => $product['handle'],
                    'name' => $product['name'],
                    'sku' => $product['sku'],
                    'price' => $product['price'],
                    'supply_price' => $product['supply_price']
                ]);
            }
        }
        
        
        
    }
    
    // return $totalProducts;
});

Route::get('/api/produits/handle/{handle}', function($handle){

    $client = new Client();
    $headers = [
        "Authorization" => "Bearer CjOC4V9CKof2GyEEdPE0Y_E4t742kylC76bxK7oX",
        'Accept'        => 'application/json',
    ];

    $response = $client->request('GET', 'https://stapog.vendhq.com/api/products?handle=' . $handle , ['headers' => $headers]);
    return $data = (string)$response->getBody();
    $products = json_decode($data, true);
    return $products;
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

Route::get('/produits', function(){
    return Produit::all();
});

Route::get('/reporting', function(){
    $subs =  Sub::with('produit')->get();

    // $subs = Sub::all()->groupBy('product_id');
    $total = 0;
    foreach($subs as $sub){
        if( isset( $sub->produit )){
            $total += $sub->produit->price;
        }
        
    }

   return view('reporting.index', compact('subs', 'total'));
});

Route::get('/tagla', function(){
    $subs =  Sub::with('produit')->get();
    return view('tagla.index', compact('subs'));
});