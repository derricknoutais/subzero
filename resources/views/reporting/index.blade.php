@extends('layouts.app')


@section('content')
    <reporting-index inline-template :total="{{ $total }}" :subs="{{ $subs }}">
        <div class="container">
            <div class="row">
                <div class="col">
                    <div class="card">
                        <div class="card-header">
                            <div class="row px-5">
                                <h4 class="card-title mr-3 mt-1" >Reporting Subs sur une période de</h4> 

                                <input type="date" class="form-control col-3 mr-3" v-model="dateDu">
                                <h4 class="mt-1">à</h4>
                                <input type="date" class="form-control col-3 ml-3" v-model="dateAu" >

                            </div>
                        </div>
                        <div class="card-body">
                            <p class="card-text display-6">Nombre de Subs: @{{  localSubs.length }}</p>
                            <p class="card-text display-6">Montant Total: @{{ montantTotal | currency }}</p>
                        </div>
                    </div>
                </div>
            </div>
            <div class="row">
                <div class="col">
                    <table class="table">
                        <thead>
                            <tr>
                                <th>Nom</th>
                                <th>Prix</th>
                            </tr>
                        </thead>
                        <tbody>
                            <tr v-for="sub in localSubs">
                                <td scope="row">@{{ sub.nom }}</td>
                                <td>@{{ sub.produit.price }}</td>
                            </tr>
                        </tbody>
                    </table>
                </div>
            </div>
        </div>
        
        <h1></h1>
    </reporting-index>
    
@endsection