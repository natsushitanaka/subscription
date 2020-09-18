@extends('layouts.app')

@section('error')
    @include('share.showError')
@endsection

@section('content')

<h3>Register Customer</h3>
  
  <form action="/customer/{{$customer->id}}/edit" method="post">

    @csrf

    <label for="name">*Name:</label>
    <input type="text" id="name" name="name" value="{{ old('name', $customer->name) }}" required><br>

    <label for="email">*E-mail:</label>
    <input type="email" id="email" name="email" value="{{ old('email', $customer->email) }}" required><br>
    
    <label for="tel">Tel:</label>
    <input type="tel" id="tel" name="tel" value="{{ old('tel', $customer->tel) }}"><br>
    
    <label for="birth">Birth:</label>
    <input type="date" id="birth" name="birth" value="{{ old('birth', $customer->birth) }}"><br>

    <label for="plan">Plan:</label>
    <input type="checkbox" id="plan" name="plan" value="1">
    @if(!empty($error))
      <span>{{ $error }}</span>
    @endif
    <br>

    <label for="comment">Comment:</label>
    <input type="text" id="comment" name="comment" value="{{ old('comment', $customer->comment) }}"><br>

    <p>* are required</p>

    <input type="submit" value="Edit">
    
</form>

@endsection