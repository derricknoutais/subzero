<?php
use GuzzleHttp\Client;
use App\Produit;
use App\Sub;
use Illuminate\Support\Facades\DB;

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
Route::get('/api/sub/{product}/{apres?}/{avant?}', 'SubController@apiShow');
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

    $pages = array();
    for ($j = 1; $j <= 1; $j++) {
        $response = $client->request('GET', 'https://stapog.vendhq.com/api/products?page_size=200&page=' . $j, ['headers' => $headers]);
        $data = json_decode((string) $response->getBody(), true);
        array_push($pages, $data['products']);
    }
    // return $products;
    foreach ($pages as $products) {
        foreach ($products as $product) {
            if (!Produit::where('product_id', $product['id'])->first()) {
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

Route::get('/api/sales', function () {

    $client = new Client();
    $headers = [
        "Authorization" => "Bearer CjOC4V9CKof2GyEEdPE0Y_E4t742kylC76bxK7oX",
        'Accept'        => 'application/json',
    ];

    $pages = array();
    for ($j = 1; $j <= 1; $j++) {
        $response = $client->request('GET', 'https://stapog.vendhq.com/api/products?page_size=200&', ['headers' => $headers]);
        $data = json_decode((string) $response->getBody(), true);
        return $data;
        array_push($pages, $data['products']);
    }
    // return $products;
    foreach ($pages as $products) {
        foreach ($products as $product) {
            if (!Produit::where('product_id', $product['id'])->first()) {
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


// Route::get('/api/produits', function () {

//     $client = new Client();
//     $headers = [
//         "Authorization" => "Bearer CjOC4V9CKof2GyEEdPE0Y_E4t742kylC76bxK7oX",
//         'Accept'        => 'application/json',
//     ];

//     // $response = $client->request('GET', 'https://stapog.vendhq.com/api/products?page_size=200' , ['headers' => $headers]);
//     // $data = (string)$response->getBody();
//     // $products = json_decode($data, true);
//     // return $products['pagination']['pages'];

//     $toDB = array();

//     for ($j=1; $j <= 16 ; $j++) {

//         $response = $client->request('GET', 'https://stapog.vendhq.com/api/products?page_size=200&page=' . $j , ['headers' => $headers]);
//         $data = json_decode( (string)$response->getBody(), true );
//         $products = $data['products'];

//         foreach($products as $product){
//             if( ! Produit::where('product_id', $product['id'])->first() ){
//                 Produit::create([
//                     'product_id' => $product['id'],
//                     'handle' => $product['handle'],
//                     'name' => $product['name'],
//                     'sku' => $product['sku'],
//                     'price' => $product['price'],
//                     'supply_price' => $product['supply_price']
//                 ]);
//             }
//         }

//     }

//     // return $totalProducts;
// });

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

function updateNumber($number){
    $new_phone = null;
    if((! is_null($number)) ){
        $number = trim($number);
        if(strlen($number) == 8  ){
            if($number{1} == 2 || $number{1} == 6 || $number{1} == 5) {
                $new_phone = substr_replace($number,'6','1', 0);
            } else if($number{1} == 4 || $number{1} == 7){
                $new_phone = substr_replace($number, '7', '1', 0);
            } else if($number{1} == 1 ){
                $new_phone = substr_replace($number, '1', '1', 0);
            }
            return $new_phone;
        }

    }

}
$clients = [];
Route::get('/api-clients', function () use ($clients) {

    $client = new Client();
    $headers = [
        "Authorization" => "Bearer CjOC4V9CKof2GyEEdPE0Y_E4t742kylC76bxK7oX",
        'Accept'        => 'application/json',
    ];

    $response = $client->request('GET', 'https://stapog.vendhq.com/api/2.0/customers?page_size=6000', ['headers' => $headers]);
    $data = (string) $response->getBody();
    $customers = json_decode($data, true)['data'];
    //  sizeof($customers);

    $arr = [];
    foreach ($customers as $customer ) {
        // $new_phone = updateNumber($customer['phone']);
        // $client->request('PUT', 'https://stapog.vendhq.com/api/2.0/customers/' . $customer['id'],
        // [
        //     'headers' => $headers,
        //     'form_params' => [
        //         'phone' => $new_phone
        //     ]
        // ]);
        // if( isset($customer['fax']) && strlen($customer['fax']) != 9 ){

            DB::table('clients')->insert([
                'id' => $customer['id'],
                'phone' => $customer['phone'],
                'mobile' => $customer['mobile'],
                'fax' => $customer['fax']
            ]);
        // }

        // if(strlen($customer['phone']) == 8){
        //     array_push($arr, $customer);
        // }
    }
    // return $arr;
});

Route::get('update-clients', function ()  {
    $client = new Client();
    $headers = [
        "Authorization" => "Bearer CjOC4V9CKof2GyEEdPE0Y_E4t742kylC76bxK7oX",
        'Accept'        => 'application/json',
    ];

    $clients = json_decode(DB::table('clients')->get(), true);
    foreach ($clients as $customer ) {
        if(isset($customer['phone'])){
            $new_phone = updateNumber($customer['phone']);
            if(isset($new_phone)){
                DB::table('clients')->where('id', $customer['id'])->update([
                    'phone' => $new_phone
                ]);
            }
        }
        if(isset($customer['mobile'])){
            $new_phone = updateNumber($customer['mobile']);
            if(isset($new_phone)){
                DB::table('clients')->where('id', $customer['id'])->update([
                    'mobile' => $new_phone
                ]);
            }
        }
        if(isset($customer['fax'])){
            $new_phone = updateNumber($customer['fax']);
            if(isset($new_phone)){
                DB::table('clients')->where('id', $customer['id'])->update([
                    'fax' => $new_phone
                ]);
            }
        }


        // $client->request('PUT', 'https://stapog.vendhq.com/api/2.0/customers/' . $customer['id'],
        // [
        //     'headers' => $headers,
        //     'form_params' => [
        //         'phone' => $new_phone
        //     ]
        // ]);
    }
});

Route::get('/upload-clients', function(){
    $client = new Client();
    $headers = [
        "Authorization" => "Bearer CjOC4V9CKof2GyEEdPE0Y_E4t742kylC76bxK7oX",
        'Accept'        => 'application/json',
    ];
    $clients = json_decode(DB::table('clients')->get(), true);
    // return $clients[2449];

        for ($i=0; $i<18 ; $i++) {
            $client->request('PUT', 'https://stapog.vendhq.com/api/2.0/customers/' . $clients[$i]['id'],
            [
                'headers' => $headers,
                'form_params' => [
                    'phone' =>  $clients[$i]['phone'],
                    'mobile' =>  $clients[$i]['mobile'],
                    'fax' =>  $clients[$i]['fax']
                ]
            ]);
        }


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

Route::get('/barcode', function(){
    $subs =  Sub::with('produit')->get();
    return view('tagla.barcode', compact('subs'));
});
