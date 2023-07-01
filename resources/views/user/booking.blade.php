@include('user.navbar')

<head>
    <script src="https://cdnjs.cloudflare.com/ajax/libs/jquery/3.6.0/jquery.min.js"></script>
    <link rel="stylesheet" href="{{ asset('../assets/css/booking.css') }}">
</head>

<div class="main">

    <div class="left">
        <h2>Book Your Appointment Now and Save Your Time</h2>
        <p>Choose your preferred date and time, and you will receive a confirmation message</p>
        <p>For Help Call: +189-123-453</p>
    </div>
    <div class="right">
        <div class="bookingform">
            <h1>Book Appointment</h1>
            
            @if(session()->has('message'))
          <div class="alert alert-success alert-dismissible fade show" style="width: 50%;" role="alert">
            {{session()->get('message')}}
            <button type="button" class="close" data-dismiss="alert" aria-label="Close">
              <span aria-hidden="true">&times;</span>
            </button>
          </div>
          @endif

            <form action="{{url('appointment')}}" method="POST" class="bookingForm">
                @csrf

                <label class="bookingLabel1" for="name">Name:</label>
                <input type="text" id="name" name="name" placeholder="Your full name" value="{{ auth()->user()->name }}">
                @error('name')
                <span class="error">{{ $message }}</span>
                @enderror

                <label class="bookingLabel1" for="email">Email:</label>
                <input type="text" id="email" name="email" placeholder="example@email.com" value="{{ auth()->user()->email }}">
                @error('email')
                <span class="error">{{ $message }}</span>
                @enderror

                <label class="bookingLabel1" for="phone">Phone:</label>
                <input type="tel" id="phone" name="phone" placeholder="Your phone number" value="{{ auth()->user()->phone }}">
                @error('phone')
                <span class="error">{{ $message }}</span>
                @enderror

                <label class="bookingLabel2" for="department">Department:</label>
                <select id="department" name="doctor" required>
                    <option value="">--Select A Doctor--</option>
                    @foreach($doctors as $doctor)
                    <option value="{{$doctor->name}}">{{$doctor->name}}, speciality {{$doctor->speciality}}</option>
                    @endforeach
                </select>
                @error('department')
                <span class="error">{{ $message }}</span>
                @enderror

                <label class="bookingLabel2" for="date">Preferred Date:</label>
                <input type="date" id="date" name="date" value="{{ old('date') }}" required>
                @error('date')
                <span class="error">{{ $message }}</span>
                @enderror

                <label class="bookingLabel2" for="time">Preferred Time:</label>
                <input type="time" id="time" name="time" value="{{ old('time') }}" required>
                @error('time')
                <span class="error">{{ $message }}</span>
                @enderror

                <label class="bookingLabel3" for="message">Additional Message:</label><br>
                <textarea id="message" name="message" rows="4" cols="50" placeholder="Enter your message here">{{ old('message') }}</textarea>

                <input type="submit" value="Submit">
            </form>

        </div>
    </div>
</div>
<script src="https://cdnjs.cloudflare.com/ajax/libs/bootstrap/4.6.0/js/bootstrap.min.js"></script>
<script>
  // Get the chosen date and time values from the server-side or any other source
  var chosenDate = "2023-07-01";
  var chosenTime = "10:00";

  // Disable the chosen date and time options
  document.getElementById("date").value = chosenDate;
  document.getElementById("time").value = chosenTime;

  // Prevent selecting the chosen date and time from the calendar
  document.getElementById("date").setAttribute("min", chosenDate);
  document.getElementById("time").setAttribute("min", chosenTime);
</script>