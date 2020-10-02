@extends('layouts.app')

@section('content')

@include('share.nav')
@include('share.showError')

<div class="container">
  <form action="/customer/{{$customer->id}}/edit" class="form" method="post">
  @csrf
    <fieldset>
      
      <legend>顧客情報の編集</legend>

      <div class="form-group row">
        <label for="name" class="col-lg-2 control-label">氏名</label>
        <div class="col-lg-4">
          <input name="name" type="text" class="form-control" id="name" placeholder="Name" value="{{ old('name', $customer->name) }}" required>
        </div>
      </div>

      <div class="form-group row">
        <label for="email" class="col-lg-2 control-label">メールアドレス</label>
        <div class="col-lg-4">
          <input name="email" type="email" class="form-control" id="email" placeholder="Email" value="{{ old('email', $customer->email) }}" required>
        </div>
      </div>

      <div class="form-group row">
        <label for="tel" class="col-lg-2 control-label">電話番号</label>
        <div class="col-lg-4">
          <input name="tel" type="tel" class="form-control" id="tel" placeholder="Tel" value="{{ old('tel', $customer->tel) }}">
        </div>
      </div>

      <div class="form-group row">
        <label for="birth" class="col-lg-2 control-label">誕生日</label>
        <div class="col-lg-4">
          <input name="birth" type="date" class="form-control" id="birth" placeholder="Birthday" value="{{ old('birth', $customer->birth) }}">
        </div>
      </div>

      <div class="form-group row">
        <label for="plan" class="col-lg-2 control-label">プランを利用する</label>
        <div class="col-lg-4">
          <input name="plan" type="checkbox" id="plan" value="1" {{ $customer->plan == '1'  ? 'checked' : '' }}>
          ＊プランの取り消しはできません。
        </div>
      </div>

      <div class="form-group row">
        <label for="comment" class="col-lg-2 control-label">コメント</label>
        <div class="col-lg-4">
          <input name="comment" type="text" class="form-control" id="comment" placeholder="Comment" value="{{ old('comment', $customer->comment) }}">
        </div>
      </div>

      <div class="form-group row">
        <div class="col-lg-4 col-lg-offset-2">
          <button type="submit" class="btn btn-primary">登録</button>
        </div>
      </div>

    </fieldset>
  </form>

</div>
@endsection