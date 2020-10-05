@extends('layouts.app')

@section('content')

@include('share.nav')
@include('share.showError')

<div class="container">
  @if(isset($msg))
  <span class="err">{{ $msg }}</span>
  @endif

  <form action="{{ route('customer.add') }}" class="form-fluid" method="post">
  @csrf
    <fieldset>
      <legend>顧客登録</legend>

      <div class="form-group row">
        <label for="name" class="col-lg-2 control-label">氏名</label>
        <div class="col-lg-4">
          <input name="name" type="text" class="form-control" id="name" placeholder="Name" value="{{ old('name', 'Test Customer') }}" required>
        </div>
        <span style="color: red;">＊必須（今回はデフォルトでTest Custommerを入力しています）</span>
      </div>

      <div class="form-group row">
        <label for="email" class="col-lg-2 control-label">メールアドレス</label>
        <div class="col-lg-4">
          <input name="email" type="email" class="form-control" id="email" placeholder="Email" value="{{ old('email',) }}" required>
        </div>
        <span style="color: red;">＊必須（メールを受け取れるアドレスの入力をお願いします）</span>
      </div>

      <div class="form-group row">
        <label for="tel" class="col-lg-2 control-label">電話番号</label>
        <div class="col-lg-4">
          <input name="tel" type="tel" class="form-control" id="tel" placeholder="Tel" value="{{ old('tel',) }}">
        </div>
        <span style="color: red;">＊テストでは登録の必要はありません</span>
      </div>

      <div class="form-group row">
        <label for="birth" class="col-lg-2 control-label">誕生日</label>
        <div class="col-lg-4">
          <input name="birth" type="date" class="form-control" id="birth" placeholder="Birthday" value="{{ old('birth',) }}">
        </div>
        <span style="color: red;">＊誕生日を本日に設定すると誕生日メールが配信されます</span>
      </div>

      <div class="form-group row">
        <label for="plan" class="col-lg-2 control-label">プランを利用する</label>
        <div class="col-lg-4">
          <input name="plan" type="checkbox" id="plan" value="1" checked>
        </div>
        <span style="color: red;">＊メール機能の動作確認の為、チェックを入れたままにしてください</span>
      </div>

      <div class="form-group row">
        <label for="comment" class="col-lg-2 control-label">コメント</label>
        <div class="col-lg-4">
          <input name="comment" type="text" class="form-control" id="comment" placeholder="Comment" value="{{ old('comment',) }}">
        </div>
      </div>

      <div class="form-group row">
        <div class="col-lg-2 col-lg-offset-2">
          <button type="submit" class="btn btn-primary">登録</button>
        </div>
        <span style="color: red;">＊登録が完了すれば、顧客リストをご覧ください。</span>
      </div>

    </fieldset>
  </form>
</div>

  @endsection