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
        <label for="expiring_date" class="col-lg-5 control-label">サブスクの有効期間は？（⚪︎⚪︎日間）</label>
        <div class="col-lg-1">
          <input name="expiring_date" type="number" class="form-control" id="expiring_date" value="{{ old('expiring_date', $user->expiring_date) }}" required>
        </div>
      </div>

      <div class="form-group row">
        <label for="what_time_mail" class="col-lg-5 control-label">何時にメールを配信する？（⚪︎⚪︎時）</label>
        <div class="col-lg-1">
          <input name="what_time_mail" type="number" class="form-control" id="what_time_mail" value="{{ old('expiring_date', $user->what_time_mail) }}" required>
        </div>
      </div>

      <div class="form-group row">
        <label for="how_days_mail" class="col-lg-5 control-label">何日前に失効メール通知を配信する？（⚪︎⚪︎日前）</label>
        <div class="col-lg-1">
          <input name="how_days_mail" type="number" class="form-control" id="how_days_mail" value="{{ old('expiring_date', $user->how_days_mail) }}" required>
        </div>
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