@extends('layouts.app')

@section('content')

<p>Customers, birthday is this month</p>

<ul>
    @foreach($customers as $customer)
    <li><a href="/customer/{{$customer->id}}/data">{{ $customer->name }}</a>:{{ $customer->birth }}</li>
    @endforeach
</ul>

<!-- {!! QrCode::format('png')->size(100)->generate('https://kakurebakitchengao.business.site/') !!} -->

<!-- <div class="container">
    <div class="row justify-content-center">
        <div class="col-md-8">
            <div class="card">
                <div class="card-header">Dashboard</div>

                <div class="card-body">
                    @if (session('status'))
                        <div class="alert alert-success" role="alert">
                            {{ session('status') }}
                        </div>
                    @endif

                    You are logged in!
                </div>
            </div>
        </div>
    </div>
</div> -->
@endsection
