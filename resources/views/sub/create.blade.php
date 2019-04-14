@extends('layouts.app')


@section('content')
    <sub-create :subs="{{ json_encode($subs) }}" inline-template>
        <div class='container'>
            <div class="row">
                <div class="col-9">
                    <input class="form-control">
                    <multiselect 
                        v-model="selected_sub" :options="this.prod" label="name" @search-change="query" :loading="isLoading" 
                        :multiple="true" :searchable="true"  :internal-search="false" :clear-on-select="false" :close-on-select="false" 
                        :options-limit="300" :limit="3" :limit-text="limitText" :max-height="600" :show-no-results="false" :hide-selected="true"
                        :block-keys="['Tab', 'Enter']"
                    >
                    </multiselect>
                </div>
                <div class="col-3">
                    <button type="button" class="btn btn-success mt-1" @click="addSub">Ajouter un Sub</button>
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