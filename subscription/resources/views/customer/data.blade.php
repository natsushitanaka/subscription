@extends('layouts.app')

@section('error')
    @include('share.showError')
@endsection

@section('content')

<form action="/visitdata/{{$customer->id}}/add" class="form-fluid" method="post">
@csrf
  <fieldset>
    <legend>Add Visit Data</legend>

    <div class="form-group">
      <label for="date" class="col-lg-2 control-label">Visit Date</label>
      <div class="col-lg-4">
        <input name="date" type="date" class="form-control" id="date" placeholder="date" value="{{ old('date') }}">
      </div>
    </div>

    <div class="form-group">
      <label for="pay" class="col-lg-2 control-label">Payment</label>
      <div class="col-lg-4">
        <input name="pay" type="number" class="form-control" id="pay" placeholder="pay" value="{{ old('pay') }}">
      </div>
    </div>

    <div class="form-group">
      <label for="person" class="col-lg-2 control-label">Num of people</label>
      <div class="col-lg-4">
        <input name="person" type="number" class="form-control" id="person" placeholder="person" value="{{ old('person') }}">
      </div>
    </div>


    <div class="form-group">
      <label for="comment" class="col-lg-2 control-label">Comment</label>
      <div class="col-lg-4">
        <input name="comment" type="text" class="form-control" id="comment" placeholder="Comment" value="{{ old('comment') }}">
      </div>
    </div>

    <div class="form-group">
      <div class="col-lg-4 col-lg-offset-2">
        <button type="submit" class="btn btn-primary">Submit</button>
      </div>
    </div>

  </fieldset>
</form>

@if(!is_null($visit_datas))

<h3>Visit Datas</h3>

<table class="table data_table">

    <tr>
        <th>Date</th>
        <th>Payment</th>
        <th>Num of people</th>
        <th>Comment</th>
        <th></th>
    </tr>

    @foreach($visit_datas as $visit_data)

    <tr>
        <td>{{ $visit_data->date }}</td>
        <td>{{ $visit_data->pay }}</td>
        <td>{{ $visit_data->person }}</td>
        <td>{{ $visit_data->commnet ?: '-' }}</td>
        <form action="/visitdata/{{$visit_data->id}}/delete" method="post">
        @csrf
        <td>
            <button type="submit" class="btn btn-primary btn-sm">×</button>
        </td>
        </form>
    </tr>

    @endforeach
</table>

@endif

@endsection