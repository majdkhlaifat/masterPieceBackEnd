@include('user.navbar')

<div align="center" style="padding:70px; margin-top:70px;">
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
            <td><a class="btn btn-danger" href="{{url('cancel_appoint',$appoint->id)}}">Cancel</a></td>
        </tr>
        @endforeach
    </table>
</div>