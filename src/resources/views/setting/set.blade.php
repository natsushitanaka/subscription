@extends('layouts.app')

@section('content')

@include('share.nav')
@include('share.showError')

<div class="container">
  <form action="{{ route('setting') }}" class="form-fluid" method="post">
  @csrf
    <fieldset>
      <legend>設定変更</legend>
      <div class="form-group row">
        <label for="expiring_date" class="col-lg-5 control-label">サブスクの有効期間は？</label>
        <div class="col-lg-1">
          <input name="expiring_date" type="number" class="form-control" id="expiring_date" value="{{ old('expiring_date', $user->expiring_date) }}" required>
        </div>
        <span>日間</span>
      </div>

      <div class="form-group row">
        <label for="{{ $user->what_time_mail_hour }}" class="col-lg-5 control-label">何時にメールを配信する？（例：23:59）</label>
        <div class="col-lg-1">
          <input name="what_time_mail_hour" type="number" class="form-control" id="what_time_mail_hour" value="{{ old('what_time_mail_hour', $user->what_time_mail_hour) }}" required>
        </div>
        <span>:</span>
        <div class="col-lg-1">
          <input name="what_time_mail_minute" type="number" class="form-control" id="what_time_mail_minute" value="{{ old('what_time_mail_minute', $user->what_time_mail_minute) }}" required>
        </div>
      </div>

      <div class="form-group row">
        <label for="how_days_mail" class="col-lg-5 control-label">何日前に失効メール通知を配信する？</label>
        <div class="col-lg-1">
          <input name="how_days_mail" type="number" class="form-control" id="how_days_mail" value="{{ old('how_days_mail', $user->how_days_mail) }}" required>
        </div>
        <span>日前</span>
      </div>

      <div class="form-group row">
        <div class="col-lg-4 col-lg-offset-2">
          <button type="submit" class="btn btn-primary">変更する</button>
        </div>
      </div>

    </fieldset>
  </form>
</div>
@endsection