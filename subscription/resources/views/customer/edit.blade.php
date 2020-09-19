@extends('layouts.app')

@section('error')
    @include('share.showError')
@endsection

@section('content')

<form action="{{ route('customer.add') }}" class="form-fluid" method="post">
@csrf
  <fieldset>
    <legend>Edit Customer</legend>

    <div class="form-group">
      <label for="name" class="col-lg-2 control-label">Name</label>
      <div class="col-lg-4">
        <input name="name" type="text" class="form-control" id="name" placeholder="Name" value="{{ old('name', $customer->name) }}" required>
      </div>
    </div>

    <div class="form-group">
      <label for="email" class="col-lg-2 control-label">Email</label>
      <div class="col-lg-4">
        <input name="email" type="email" class="form-control" id="email" placeholder="Email" value="{{ old('email', $customer->email) }}" required>
      </div>
    </div>

    <div class="form-group">
      <label for="tel" class="col-lg-2 control-label">Tel</label>
      <div class="col-lg-4">
        <input name="tel" type="tel" class="form-control" id="tel" placeholder="Tel" value="{{ old('tel', $customer->tel) }}">
      </div>
    </div>

    <div class="form-group">
      <label for="birth" class="col-lg-2 control-label">Birth</label>
      <div class="col-lg-4">
        <input name="birth" type="date" class="form-control" id="birth" placeholder="Birthday" value="{{ old('birth', $customer->birth) }}">
      </div>
    </div>

    <div class="form-group">
      <label for="plan" class="col-lg-2 control-label">Plan</label>
      <div class="col-lg-4">
        <input name="plan" type="checkbox" id="plan" value="1">
      </div>
    </div>

    <div class="form-group">
      <label for="comment" class="col-lg-2 control-label">Comment</label>
      <div class="col-lg-4">
        <input name="comment" type="text" class="form-control" id="comment" placeholder="Comment" value="{{ old('comment', $customer->comment) }}">
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