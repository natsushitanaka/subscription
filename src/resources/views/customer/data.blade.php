@extends('layouts.app')

@section('content')

@include('share.nav')
@include('share.showError')

<div class="container data_form">
  <form action="/visitdata/{{$customer->id}}/add" class="form-fluid" method="post">
  @csrf
    <fieldset>
      <legend>データ追加</legend>

      <div class="form-group row">
        <label for="date" class="col-lg-2 control-label">来店日</label>
        <div class="col-lg-4">
          <input name="date" type="date" class="form-control" id="date" placeholder="date" value="{{ old('date') }}" required>
        </div>
      </div>

      <div class="form-group row">
        <label for="pay" class="col-lg-2 control-label">利用金額</label>
        <div class="col-lg-4">
          <input name="pay" type="number" class="form-control" id="pay" placeholder="pay" value="{{ old('pay') }}">
        </div>
      </div>

      <div class="form-group row">
        <label for="person" class="col-lg-2 control-label">来店人数</label>
        <div class="col-lg-4">
          <input name="person" type="number" class="form-control" id="person" placeholder="person" value="{{ old('person') }}">
        </div>
      </div>


      <div class="form-group row">
        <label for="comment" class="col-lg-2 control-label">コメント</label>
        <div class="col-lg-4">
          <input name="comment" type="text" class="form-control" id="comment" placeholder="Comment" value="{{ old('comment') }}">
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

<div class="container">
  <div class="row">
    <h2 class="col-6"><a href="/customer/{{$customer->id}}">{{ $customer->name }}</a>の来店データ</h2>
  </div>

  <table class="table data_table">

    <tr>
        <th>来店日</th>
        <th>利用金額</th>
        <th>人数</th>
        <th>コメント</th>
        <th>-</th>
        <th>-</th>
    </tr>

    @foreach($visit_datas as $visit_data)

    <tr>
        <td>{{ $visit_data->date ?: '-' }}</td>
        <td>{{ $visit_data->pay ?: '-' }}</td>
        <td>{{ $visit_data->person ?: '-' }}</td>
        <td>{{ $visit_data->commnet ?: '-' }}</td>
        <td><a href="/visitdata/{{$visit_data->id}}/edit">編集</a></td>
        <form action="/visitdata/{{$visit_data->id}}/delete" method="post">
        @csrf
        <td>
            <button type="submit" class="btn btn-primary btn-sm">×</button>
        </td>
        </form>
    </tr>

    @endforeach
  </table>
</div>

@endsection