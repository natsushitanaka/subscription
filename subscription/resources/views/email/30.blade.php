<h3>Notification</h3>

<p>Thanks for making a contact to us</p>

<p>Your plan is valid for 30 days</p>

    <h3>Registration information</h3>

<table>

    <tr>
        <th>Name</th>
        <td>{{ $data->name }}</td>
    </tr>
    <tr>
        <th>Email</th>
        <td>{{ $data->email }}</td>
    </tr>
    <tr>
        <th>Tel</th>
        <td>{{ $data->tel }}</td>
    </tr>
    <tr>
        <th>Birth</th>
        <td>{{ $data->birth }}</td>
    </tr>
    <tr>
    <th>Plan started at</th>

    @if($data->plan === 1)

    <td>{{ $data->plan_started_at }}</td>

    @else

    <td>not planed</td>

    @endif
    </tr>
    <tr>
        <th>Due Date</th>
        <td>{{ date("Y/m/d", strtotime($data->created_at. "+ 31 day")) }}</td>
    </tr>

</table>

<P>
    This is 
    <a href="https://kakurebakitchengao.business.site/">HOMEPAGE</a>
    about us.
</P>
