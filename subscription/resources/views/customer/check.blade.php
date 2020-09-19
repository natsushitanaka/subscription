<h3>Customer Datas</h3>

<table class="table">

    <tr>
        <th>Name</th>
        <td>{{ $customer->name }}</td>
    </tr>
    <tr>
        <th>Email</th>
        <td>{{ $customer->email }}</td>
    </tr>
    <tr>
        <th>Tel</th>
        <td>{{ $customer->tel }}</td>
    </tr>
    <tr>
        <th>Birth</th>
        <td>{{ $customer->birth }}</td>
    </tr>
    <tr>
    <th>Plan started at</th>

    @if($customer->plan === 1)

    <td>{{ $customer->plan_started_at }}</td>

    @else

    <td>not planed</td>

    @endif
    </tr>
    <tr>
        <th>Due Date</th>
        <td>{{ date("Y/m/d", strtotime($customer->created_at. "+ 31 day")) }}</td>
    </tr>

</table>
