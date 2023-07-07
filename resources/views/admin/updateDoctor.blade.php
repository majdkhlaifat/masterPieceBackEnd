<!DOCTYPE html>
<html lang="en">
  <head>
    <!-- Required meta tags -->
   
    <base href="/public">
    <style type="text/css">
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

  /* Updated CSS */
  input.form-control,
  select.form-control {
    background-color: white;
    color: black;
    width: 100%;
  }

  input.form-control:focus,
  input.form-control:not(:placeholder-shown) {
    background-color: white;
    color: black;
  }

  select.form-control:focus {
    background-color: white;
    color: black;
    width: 100%;
  }

  .custom-file-input {
    width: 100%;
  }

  .custom-file-input:focus {
    outline: none;
    box-shadow: 0 0 0 0.2rem green !important;
  }

  .main-container {
    margin-top: 150px;
  }

  .circular-image {
    border-radius: 50%;
    width: 300px;
    height: 300px;
    object-fit: cover;
  }
  .updateDoc{
    background-color: rgb(0,144,231);
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
 
      <div class="container main-container">
      <form action="{{ route('editDoctor', ['id' => $data->id]) }}" method="POST" enctype="multipart/form-data">
      @if(session()->has('message'))
          <div class="alert alert-success alert-dismissible fade show" style="width: 50%;" role="alert">
            {{session()->get('message')}}
            <button type="button" class="close" data-dismiss="alert" aria-label="Close">
              <span aria-hidden="true">&times;</span>
            </button>
          </div>
          @endif      <div class="row">
    <div class="col-md-7">
      <!-- Left Column -->
        @csrf
      <div class="form-group">
        <label for="name">Doctor Name:</label>
        <input type="text" class="form-control" id="name" name="name" value="{{ $data->name }}">
      </div>

      <div class="form-group">
        <label for="phone">Phone Number:</label>
        <input type="text" class="form-control" id="phone" name="phone" value="{{ $data->phone }}">
      </div>

      <div class="form-group">
        <label for="speciality">Speciality:</label>
        <input type="text" class="form-control" id="speciality" name="speciality" value="{{ $data->speciality }}">
      </div>

      <div class="form-group">
        <label for="room">Room No:</label>
        <input type="number" class="form-control" id="room" name="room" value="{{ $data->room }}">
      </div>
    </div>

    <div class="col-md-5">
      <!-- Right Column -->
      <div class="form-group">
        <label for="file">Doctor Image:</label>
        <img src="doctorimage/{{$data->image}}" class="circular-image">
      </div>
      <div>
        <label>Change Image</label>
        <input type="file" name="file">
      </div>
    </div>
  </div>
  <input type="submit" class="btn btn-primary" style="background-color: rgb(0,144,231); height:50px; width:100px;">
  </form>
</div>


    <!-- container-scroller -->
    <!-- plugins:js -->
    @include('admin.script')
    
    <!-- End custom js for this page -->
  </body>
</html>
