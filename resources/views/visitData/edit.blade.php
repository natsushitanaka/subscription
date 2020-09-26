@extends('layouts.app')

@section('error')
    @include('share.showError')
@endsection

@section('content')

  <form action="/visitdata/{{$visitData->id}}/edit" class="form-fluid" method="post">
@csrf
  <fieldset>
    <legend>Edit Visit Data</legend>

    <div class="form-group">
      <label for="date" class="col-lg-2 control-label">Visit Date</label>
      <div class="col-lg-4">
        <input name="date" type="date" class="form-control" id="date" placeholder="date" value="{{ old('date', $visitData->date) }}">
      </div>
    </div>

    <div class="form-group">
      <label for="pay" class="col-lg-2 control-label">Payment</label>
      <div class="col-lg-4">
        <input name="pay" type="number" class="form-control" id="pay" placeholder="pay" value="{{ old('pay', $visitData->pay) }}">
      </div>
    </div>

    <div class="form-group">
      <label for="person" class="col-lg-2 control-label">Num of people</label>
      <div class="col-lg-4">
        <input name="person" type="number" class="form-control" id="person" placeholder="person" value="{{ old('person', $visitData->person) }}">
      </div>
    </div>


    <div class="form-group">
      <label for="comment" class="col-lg-2 control-label">Comment</label>
      <div class="col-lg-4">
        <input name="comment" type="text" class="form-control" id="comment" placeholder="Comment" value="{{ old('comment', $visitData->comment) }}">
      </div>
    </div>

    <div class="form-group">
      <div class="col-lg-4 col-lg-offset-2">
        <button type="submit" class="btn btn-primary">Submit</button>
      </div>
    </div>

  </fieldset>
</form>

@endsection