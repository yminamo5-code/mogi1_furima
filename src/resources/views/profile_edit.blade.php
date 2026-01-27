@extends('layout.app')

@section('css')
<link rel="stylesheet" href="{{ asset('css/profile_edit.css')}}">
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
<main>
    <h1>プロフィール設定</h1>

    <form action="{{ route('profile.update') }}" method="post" enctype="multipart/form-data">
        @csrf

        <div class="icon">
            <div class="icon-circle">
                <img id="preview" src="{{ $user->image ? asset('storage/images/' . $user->image) : '' }}" alt="">
            </div>

            <button type="button" id="select-image" class="select-button">
                画像を選択する
            </button>

            <input type="file" id="image-input" name="image" accept="image/*" hidden>
        </div>

        <div class="information">
            <div class=label>ユーザー名</div>
            <input type="text" name="name" value="{{ old('name', $user->name ?? '') }}">
            @error('name')
            <div class="error">{{ $message }}</div>
            @enderror
            <div class=label>郵便番号</div>
            <input type="text" name="postcode" value="{{ old('postcode', $user->postcode ?? '') }}">
            @error('postcode')
            <div class="error">{{ $message }}</div>
            @enderror
            <div class=label>住所</div>
            <input type="text" name="address" value="{{ old('address', $user->address ?? '') }}">
            @error('address')
            <div class="error">{{ $message }}</div>
            @enderror
            <div class=label>建物名</div>
            <input type="text" name="building" value="{{ old('building', $user->building ?? '') }}">
            @error('building')
            <div class="error">{{ $message }}</div>
            @enderror
        </div>
        <button class="button-admin" type="submit">更新する</button>
    </form>
</main>

<script>
    document.getElementById('select-image').addEventListener('click', function () {
        document.getElementById('image-input').click();
    });

    document.getElementById('image-input').addEventListener('change', function (e) {
        const file = e.target.files[0];
        if (!file) return;

        const preview = document.getElementById('preview');
        preview.src = URL.createObjectURL(file);
        preview.style.display = 'block';
    });
</script>
@endsection

