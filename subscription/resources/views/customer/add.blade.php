@extends('layouts.app')

@section('error')
    @include('share.showError')
@endsection

@section('content')

<h3>Register Customer</h3>

<div class="form">

  <form action="{{ route('customer.add') }}" method="post">

  @csrf

  <label for="name">*Name:</label>
  <input type="text" id="name" name="name" value="{{ old('name',) }}" required><br>

  <label for="email">*E-mail:</label>
  <input type="email" id="email" name="email" value="{{ old('email') }}" required><br>

  <label for="tel">Tel:</label>
  <input type="tel" id="tel" name="tel" value="{{ old('tel') }}"><br>

  <label for="birth">Birth:</label>
  <input type="date" id="birth" name="birth" value="{{ old('birth') }}"><br>

  <label for="plan">Plan:</label>
  <input type="checkbox" id="plan" name="plan" value="1"><br>

  <label for="comment">Comment:</label>
  <input type="text" id="comment" name="comment" value="{{ old('comment') }}"><br>

  <p>* are required</p>

  <input class="submit" type="submit" value="Add">

  </form>

</div>
@endsection