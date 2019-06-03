@extends('layouts.app')


@section('content')
    <sub-create :subs="{{ json_encode($subs) }}" inline-template>
        <div class='container'>
            <div class="row">
                <div class="col-9">
                    <input class="form-control" v-model="dummyInput">
                    <multiselect 
                        v-model="selected_sub" :options="this.prod" label="name"
                    >
                    </multiselect>
                </div>
                <div class="col-3">
                    <button type="button" class="btn btn-success mt-1" @click="addSub" v-if=" ! isCreating">Ajouter un Sub</button>
                </div>
            </div>
            <h1 class="text-left mt-5">Mes Subs</h1>
            <div class="row mt-5">
                <div class="col">
                    <sub-index :subs="this.mySubs"></sub-index>
                </div>
            </div>

        </div>
    </sub-create>
@endsection