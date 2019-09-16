@extends('layouts.app')


@section('content')
<tagla :subs="{{ json_encode($subs) }}" inline-template>
    <div class='container'>
        <div class="row mt-3">
            <div class="col-6">
                <multiselect v-model="selected_tag" :options="this.prod" label="name" ref="select">
                </multiselect>
            </div>
            <div class="col-1">
                <div class="form-group">
                  <input type="text" class="form-control" ref="quantite" v-model.number="quantite" @keyup.enter="addTag">
                </div>
            </div>
            <div class="col-3">
                <button type="button" class="btn btn-success mt-1" @click="addTag" v-if=" ! isCreating">Ajouter un
                    Tag</button>
            </div>
        </div>

        <div class="row mt-3">
            <div class="col-md-6 border b-2 bg-white" v-for="(tag, index) in tags">
                <div class="card mt-3 no-border">
                    {{-- <div class="card-header text-right">
                        <i class="fa fa-times-circle text-right text-danger fa-2x p-2" aria-hidden="true" @click="removeTag(index)" ></i>
                    </div> --}}
                    
                    <img class="card-img-top col-md-10 offset-1" src="/images/logoonly.png" alt="">
                    <div class="card-body text-center">
                        <h1 class="h1 card-title text-center" v-if="! tag.editingName" @dblclick="enableEditNameMode(index)">@{{ tag.name }}</h1>
                        <div class="row" v-else>
                            <input type="text" class="form-control col-6 offset-2 br-0" v-model="nameEditField">
                            <button class="btn btn-success br-0 col-2" type="button" @click="editName(index)" >Modifier</button>
                        </div>
                        <p class="h2 card-text " @dblclick="enableEditMode(index)" v-if="! tag.editingDetails">@{{ tag.details }}</p>
                        <div class="row" v-else>
                            <input type="text" class="form-control col-6 offset-2 br-0" v-model="detailsEditField">
                            <button class="btn btn-success br-0 col-2" type="button" @click="editDetails(index)" >Modifier</button>
                        </div>
                        <h4 class="mt-3">Gardons les produits en ordre</h4>
                       
                        
                    </div>
                </div>
            </div>
        </div>
        {{-- <div class="row mt-5">
            <div class="col-12 text-center">
                <button name="" id="" class="btn btn-primary py-2 px-5 text-center"  role="button" @click="print">
                    <i class="fas fa-print fa-2x"></i>
                    <h4>Imprimer</h4>
                </button>
            </div>
            
        </div> --}}
    </div>
</tagla>
@endsection