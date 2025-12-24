@extends('layout/app')

@section('css')
<link rel="stylesheet" href="{{ asset('css/index.css')}}">
@endsection

@section('search')
<!-- 空だと表示されないのでコメントを置いとく -->
@endsection
@section('in_out')
<!-- 空だと表示されないのでコメントを置いとく -->
@endsection
@section('mypage')
<!-- 空だと表示されないのでコメントを置いとく -->
@endsection
@section('sell')
<!-- 空だと表示されないのでコメントを置いとく -->
@endsection

@section('content')
    <div class="label">
        <a href="{{ url('/') }}" class="{{$tab === 'recommend' ? 'active-tab' : ''}}">おすすめ</a>
        <a href="{{ url('/?tab=mylist') }}" class="{{$tab === 'mylist' ? 'active-tab' : ''}}">マイリスト</a>
    </div>

    <!-- おすすめ -->
    @if($tab === 'recommend')
        <div class="items">
            @foreach($items as $item)
                <div class="item">
                    <a href="{{ route('item.show', $item->id) }}">
                        <img src="{{ asset('storage/images/' . $item->image) }}" alt="商品画像">
                        <p>{{ $item->itemname }}</p>
                    </a>
                </div>
            @endforeach
        </div>
    <!-- マイリスト -->
    @elseif($tab === 'mylist')
        <div class="items">
            @foreach($items as $item)
                <div class="item">
                    <a href="{{ route('item.show', $item->id) }}">
                        <img src="{{ asset('storage/images/' . $item->image) }}" alt="商品画像">
                        <p>{{ $item->itemname }}</p>
                    </a>
                </div>
        @endforeach
        </div>
    @endif
@endsection