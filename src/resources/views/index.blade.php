@extends('layout/app')

@section('css')
<link rel="stylesheet" href="{{ asset('css/index.css')}}">
@endsection

@section('search')
<!-- 空だと表示されない -->
@endsection

@section('content')
    <div class="label">
        <a href="{{ url('/') }}" class="{{$tab === 'recommend' ? 'active-tab' : ''}}">おすすめ</a>
        <a href="{{ url('/?tab=mylist') }}" class="{{$tab === 'mylist' ? 'active-tab' : ''}}">マイリスト</a>
    </div>
@endsection