@extends('layouts.app')


@section('content')
    <sub-index :subs="{{ json_encode($subs) }}">

    </sub-index>
@endsection