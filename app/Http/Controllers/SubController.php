<?php

namespace App\Http\Controllers;

use App\Sub;
use GuzzleHttp\Client;
use Illuminate\Http\Request;

class SubController extends Controller
{
    /**
     * Display a listing of the resource.
     *
     * @return \Illuminate\Http\Response
     */
    public function index()
    {
        $subs = Sub::with('produit')->get();

        return $subs = Sub::with('produit')->get();
        return view('sub.index', compact('subs'));
    }
    public function apiIndex()
    {
        return $subs = Sub::all()->groupBy('product_id')->toArray();
    }

    public function apiShow($product, $apres = null, $avant = null)
    {
        if($apres && $avant){
            return $subs = Sub::where('product_id', $product)->whereDate('created_at', '>=', $apres)->whereDate('created_at', '<=', $avant)->sum('quantité');
        } else if(! $apres && $avant){
            return $subs = Sub::where('product_id', $product)->whereDate('created_at', '<=', $avant)->sum('quantité');
        } else if($apres && ! $avant){
            return $subs = Sub::where('product_id', $product)->whereDate('created_at', '>=', $apres)->sum('quantité');
        } else {
            return $subs = Sub::where('product_id', $product)->sum('quantité');
        }
    }

    /**
     * Show the form for creating a new resource.
     *
     * @return \Illuminate\Http\Response
     */
    public function create()
    {
        // $client = new Client();
        // $headers = [
        //     "Authorization" => "Bearer CjOC4V9CKof2GyEEdPE0Y_E4t742kylC76bxK7oX",
        //     'Accept'        => 'application/json',
        // ];

        // $response = $client->request('GET', 'https://stapog.vendhq.com/api/products?sku=HHC2000', ['headers' => $headers]);
        // $data = (string)$response->getBody();
        // $products = json_decode($data, true);
        $subs = Sub::all()->groupBy('product_id')->toArray();
        // $products = $products['data'];
        return view('sub.create', compact('subs'));
    }

    /**
     * Store a newly created resource in storage.
     *
     * @param  \Illuminate\Http\Request  $request
     * @return \Illuminate\Http\Response
     */
    public function store(Request $request)
    {
        // return $request->all();
        // foreach ($request->all() as $req) {
            Sub::create([
                'product_id' => $request->product_id,
                'quantité' => 1,
                'nom' => $request->name
            ]);
        // }

    }

    /**
     * Display the specified resource.
     *
     * @param  \App\Sub  $sub
     * @return \Illuminate\Http\Response
     */
    public function show(Sub $sub)
    {
        //
    }

    /**
     * Show the form for editing the specified resource.
     *
     * @param  \App\Sub  $sub
     * @return \Illuminate\Http\Response
     */
    public function edit(Sub $sub)
    {
        //
    }

    /**
     * Update the specified resource in storage.
     *
     * @param  \Illuminate\Http\Request  $request
     * @param  \App\Sub  $sub
     * @return \Illuminate\Http\Response
     */
    public function update(Request $request, Sub $sub)
    {
        //
    }

    /**
     * Remove the specified resource from storage.
     *
     * @param  \App\Sub  $sub
     * @return \Illuminate\Http\Response
     */
    public function destroy(Sub $sub)
    {
        //
    }
}
