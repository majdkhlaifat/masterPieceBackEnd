<!DOCTYPE html>
<html lang="en">
  <head>
    <!-- Required meta tags -->    

    @include('admin.css')
  </head>
  <body>
    <div class="container-scroller">
      
      <!-- partial:partials/_sidebar.html -->
      @include('admin.sidebar')

      <!-- partial -->
      @include('admin.navbar')

      <!-- partial -->

       <div class="container-fluid page-body-wrapper">
       <table class="table">
        <tr>
            <th>customer Name</th>
            <th>Email</th>
            <th>Phone</th>
            <th>Doctor Name</th>
            <th>Date</th>
            <th>Time</th>
            <th>Message</th>
            <th>Status</th>
            <th class="text-center">Action</th>
        </tr>
        @foreach($data as $appoint)
        <tr>
            <td>{{$appoint->name}}</td>
            <td>{{$appoint->email}}</td>
            <td>{{$appoint->phone}}</td>   
            <td>{{$appoint->doctor}}</td>
            <td>{{$appoint->date}}</td>
            <td>{{$appoint->time}}</td>
            <td>{{$appoint->message}}</td>
            <td>{{$appoint->status}}</td>
            <td>
                <a class="btn btn-danger" href="{{ route('canceled', ['id' => $appoint->id]) }}">Cancel</a>
                <a class="btn btn-success" href="{{ route('approved', ['id' => $appoint->id]) }}">Approved</a>
            </td>
        </tr>
        @endforeach
    </table>

        </div> 

    <!-- container-scroller -->
    <!-- plugins:js -->
    @include('admin.script')
    
    <!-- End custom js for this page -->
  </body>
</html>
