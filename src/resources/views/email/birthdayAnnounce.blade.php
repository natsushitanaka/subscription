<h2>通知メール</h2>

<p>今月、誕生日のお客様</p>

@foreach($customer as $each)
<p>
    <a href="/customer/{{$each->id}}">{{ $each->name }}</a>
</p>
@endforeach
