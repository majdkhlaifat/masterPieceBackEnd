<!DOCTYPE html>
<html lang="en">
  <head>
      <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <style>
    .large-row {
        height: 100px;
    }
    label {
            display: inline-block;
            width: 200px;
        }
        .close {
            position: relative;
            float: right;
            font-size: 1.5rem;
            font-weight: bold;
            line-height: 1;
            color: #000;
            text-shadow: 0 1px 0 #fff;
            opacity: 0.5;
            background-color: transparent;
            border: 0;
            padding: 0;
        }
        .close:hover {
            color: #000;
            opacity: 0.8;
        }
        .close:focus {
            outline: none;
            box-shadow: none;
        }
        .custom-btn {
            background-color: green;
        }
</style>

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
       <!-- @if(session('success'))
            <div class="alert alert-success">
                {{ session('success') }}
                <span class="close" aria-label="Close" onclick="this.parentElement.style.display='none';">&times;</span>
            </div>
        @endif -->
       <table class="table">
        <tr>
            <th>Doctor Name</th>
            <th>Phone</th>
            <th>Speciality</th>
            <th>Room NO.</th>
            <th>Image</th>
            <th class="text-center">Action</th>
        </tr>
        @foreach($data as $doctor)
        <tr class="large-row">
            <td>{{$doctor->name}}</td>
            <td>{{$doctor->phone}}</td>
            <td>{{$doctor->speciality}}</td>
            <td>{{$doctor->room}}</td>
            <td><img src="doctorimage/{{$doctor->image}}" style="width: 100px; height: 100px;" class="large-image"></td>
            <td>
                <a onclick="return confirm('Are You Sure To Delete This')" class="btn btn-danger" href="{{ route('deleteDoctor', ['id' => $doctor->id]) }}">Delete</a>
                <a class="btn btn-primary" href="{{ route('updateDoctor', ['id' => $doctor->id]) }}">Update</a>
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
