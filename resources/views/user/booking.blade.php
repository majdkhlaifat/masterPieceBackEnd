@include('user.navbar')

<head>
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
                    {{ session()->get('message') }}
                    <button type="button" class="close" data-dismiss="alert" aria-label="Close">
                        <span aria-hidden="true">&times;</span>
                    </button>
                </div>
            @endif

            <form action="{{ route('user.booking.submit') }}" method="POST" class="bookingForm">
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
                <select id="department" name="doctor">
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

                <input type="submit" value="Submit" id="submitButton">
            </form>
        </div>
    </div>
</div>
<script src="https://cdnjs.cloudflare.com/ajax/libs/bootstrap/4.6.0/js/bootstrap.min.js"></script>
<script>
    // Define unavailable dates and times
    var unavailableDates = ['2023-07-05', '2023-07-10'];
    var unavailableTimes = ['09:00', '12:30'];

    // Get date and time inputs
    var dateInput = document.getElementById('date');
    var timeInput = document.getElementById('time');
    var submitButton = document.getElementById('submitButton');

    // Disable unavailable dates
    dateInput.addEventListener('input', function() {
        var selectedDate = this.value;
        var isDateUnavailable = unavailableDates.includes(selectedDate);
        if (isDateUnavailable) {
            this.setCustomValidity('Please select an available date.');
            submitButton.disabled = true;
        } else {
            this.setCustomValidity('');
            submitButton.disabled = false;
        }
    });

    // Disable unavailable times
    timeInput.addEventListener('input', function() {
        var selectedTime = this.value;
        var isTimeUnavailable = unavailableTimes.includes(selectedTime);
        if (isTimeUnavailable) {
            this.setCustomValidity('Please select an available time.');
            submitButton.disabled = true;
        } else {
            this.setCustomValidity('');
            submitButton.disabled = false;
        }
    });
</script>
