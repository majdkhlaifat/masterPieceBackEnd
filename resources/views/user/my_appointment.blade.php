@include('user.navbar')

<div align="center" style="padding: 70px; margin-top: 70px;">
    @if(count($appoints) === 0)
        <p>No appointments available at the moment.</p>
    @else
        <table class="table">
            <tr>
                <th>Doctor Name</th>
                <th>Date</th>
                <th>Time</th>
                <th>Message</th>
                <th>Status</th>
                <th>Action</th>
            </tr>
            @foreach($appoints as $appoint)
                <tr>
                    <td>{{$appoint->doctor}}</td>
                    <td>{{$appoint->date}}</td>
                    <td>{{$appoint->time}}</td>
                    <td>{{$appoint->message}}</td>
                    <td>{{$appoint->status}}</td>
                    <td><a class="btn btn-danger" href="{{ route('cancel_appoint', ['id' => $appoint->id]) }}">Cancel</a></td>
                </tr>
            @endforeach
        </table>
    @endif
</div>
