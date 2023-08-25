<!DOCTYPE html>
<html lang="en">
  <head>
      <meta name="viewport" content="width=device-width, initial-scale=1.0">
      <style>
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
        input.form-control,
        select.form-control {
            background-color: white;
            color: black;
            width: 90%;
        }
        input.form-control:focus,
        input.form-control:not(:placeholder-shown) {
            background-color: white;
            color: black;
        }
        select.form-control:focus {
            background-color: white;
            color: black;
            width: 50%;
        }
        .custom-file-input {
            width: 100%;
        }
        .custom-file-input:focus {
            outline: none;
            box-shadow: 0 0 0 0.2rem green !important;
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
        <div class="container" style="padding-top: 100px;">

          @if(session()->has('message'))
          <div class="alert alert-success alert-dismissible fade show" style="width: 50%;" role="alert">
            {{session()->get('message')}}
            <button type="button" class="close" data-dismiss="alert" aria-label="Close">
              <span aria-hidden="true">&times;</span>
            </button>
          </div>
          @endif

          <form action="{{url('upload_doctor')}}" method="POST" enctype="multipart/form-data">
            @csrf
              <!-- First row -->
              <div class="row">
                  <div class="col-md-6">
                      <div class="form-group">
                          <label for="name">Doctor Name:</label>
                          <input type="text" class="form-control" id="name" name="name" placeholder="Write Doctor Name" value="{{ old('name') }}">
                          @error('name')
                          <span class="text-danger">{{ $message }}</span>
                          @enderror
                      </div>
                  </div>
                  <div class="col-md-6">
                      <div class="form-group">
                          <label for="email">Email:</label>
                          <input type="email" class="form-control" id="email" name="email" placeholder="Write Doctor Email" value="{{ old('email') }}">
                          @error('email')
                          <span class="text-danger">{{ $message }}</span>
                          @enderror
                      </div>
                  </div>
              </div>
              <!-- End of first row -->

              <div class="row">
                  <div class="col-md-6">
                      <div class="form-group">
                          <label for="password">Password:</label>
                          <input type="password" class="form-control" id="password" name="password" placeholder="Enter Password">
                          @error('password')
                          <span class="text-danger">{{ $message }}</span>
                          @enderror
                      </div>
                  </div>
                  <div class="col-md-6">
                      <div class="form-group">
                          <label for="phone">Phone Number:</label>
                          <input type="text" class="form-control" id="phone" name="phone" placeholder="Write Doctor Number" value="{{ old('phone') }}">
                          @error('phone')
                          <span class="text-danger">{{ $message }}</span>
                          @enderror
                      </div>
                  </div>
              </div>
              <!-- End of second row -->

              <!-- Third row -->
              <div class="row">
                  <div class="col-md-6">
                      <div class="form-group">
                          <label for="speciality">Speciality:</label>
                          <select class="form-control" id="speciality" name="speciality">
                              <option value="" disabled selected>--Select--</option>
                              <option value="skin" {{ old('speciality') == 'skin' ? 'selected' : '' }}>Skin</option>
                              <option value="heart" {{ old('speciality') == 'heart' ? 'selected' : '' }}>Heart</option>
                              <option value="eye" {{ old('speciality') == 'eye' ? 'selected' : '' }}>Eye</option>
                              <option value="dentist" {{ old('speciality') == 'dentist' ? 'selected' : '' }}>Dentist</option>
                          </select>
                          @error('speciality')
                          <span class="text-danger">{{ $message }}</span>
                          @enderror
                      </div>
                  </div>
                  <div class="col-md-6">
                      <div class="form-group">
                          <label for="room">Room No:</label>
                          <input type="number" class="form-control" id="room" name="room" placeholder="Write Doctor Room" value="{{ old('room') }}">
                          @error('room')
                          <span class="text-danger">{{ $message }}</span>
                          @enderror
                      </div>
                  </div>
              </div>
              <!-- End of third row -->

              <div class="row">
                  <div class="col-md-6">
                      <div class="form-group">
                          <label for="file">Doctor Image:</label>
                          <input type="file" class="custom-file-input" id="file" name="file">
                          <span class="text-danger">{{ $errors->first('file') }}</span>
                      </div>
                  </div>
              </div>
              <!-- End of fourth row -->

            <div class="form-group">
              <button type="submit" class="btn btn-success custom-btn">Submit</button>
            </div>
          </form>
        </div>
      </div>
    </div>
    <!-- container-scroller -->
    <!-- plugins:js -->
    @include('admin.script')
  </body>
</html>
