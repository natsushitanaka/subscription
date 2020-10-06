@extends('layouts.app')

@section('content')

@include('share.nav')
@include('share.showError')

<form action="/visitdata/{{$visitData->id}}/edit" class="form-fluid" method="post">
@csrf
  <fieldset>
    <legend>来店データの編集</legend>

    <div class="form-group">
      <label for="date" class="col-lg-2 control-label">来店日</label>
      <div class="col-lg-4">
        <input name="date" type="date" class="form-control" id="date" placeholder="visit date" value="{{ old('date', $visitData->date) }}">
      </div>
    </div>

    <div class="form-group">
      <label for="pay" class="col-lg-2 control-label">利用金額</label>
      <div class="col-lg-4">
        <input name="pay" type="number" class="form-control" id="pay" placeholder="payment" value="{{ old('pay', $visitData->pay) }}">
      </div>
    </div>

    <div class="form-group">
      <label for="person" class="col-lg-2 control-label">来店人数</label>
      <div class="col-lg-4">
        <input name="person" type="number" class="form-control" id="person" placeholder="Num of people" value="{{ old('person', $visitData->person) }}">
      </div>
    </div>


    <div class="form-group">
      <label for="comment" class="col-lg-2 control-label">コメント</label>
      <div class="col-lg-4">
        <input name="comment" type="text" class="form-control" id="comment" placeholder="Comment" value="{{ old('comment', $visitData->comment) }}">
      </div>
    </div>

    <div class="form-group">
      <div class="col-lg-4 col-lg-offset-2">
        <button type="submit" class="btn btn-primary">変更する</button>
      </div>
    </div>

  </fieldset>
</form>

@endsection