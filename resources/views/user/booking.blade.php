@include('user.navbar')

<head>
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <link rel="stylesheet" href="{{ asset('../assets/css/booking.css') }}">
    <link rel="stylesheet" href="https://cdn.jsdelivr.net/npm/bootstrap@5.2.3/dist/css/bootstrap.min.css" integrity="sha384-rbsA2VBKQhggwzxH7pPCaAqO46MgnOM80zW1RWuH61DGLwZJEdK2Kadq2F9CUG65" crossorigin="anonymous">
</head>

<div class="main">

    <div class="left">
        <h2>Book Your Appointment Now and Save Your Time</h2>
        <p>Choose your preferred date and time, and you will receive a confirmation message</p>
        <p>For Help Call: +189-123-453</p>
    </div>
    <div class="right">
        <div class="bookingform">
            <h1  style="margin-left: 120px;">Book Appointment</h1>

            @if(session()->has('message'))
                <div class="alert alert-success alert-dismissible fade show" role="alert">
                    {{ session()->get('message') }}
                    <button type="button" class="btn-close" data-bs-dismiss="alert" aria-label="Close"></button>
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

                <label class="bookingLabel1" for="department">Doctor:</label>
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

                <select id="time" name="time" required>
                    <option value="">-- Select Time --</option>
                    @foreach($availableTimeSlots as $timeSlot)
                        <option value="{{ $timeSlot }}">{{ $timeSlot }}</option>
                    @endforeach
                </select>

                <label class="bookingLabel3" for="message">Additional Message:</label><br>
                <textarea id="message" name="message" rows="4" cols="50" placeholder="Enter your message here">{{ old('message') }}</textarea>

                <input type="submit" value="Submit" id="submitButton">
            </form>
        </div>
    </div>
</div>
<script src="https://code.jquery.com/jquery-3.6.0.min.js"></script>
{{--<script src="https://cdn.jsdelivr.net/npm/bootstrap@5.2.3/dist/js/bootstrap.bundle.min.js" integrity="sha384-UYjXU0FFhAEqby0PXv22NEx+TkmMmA/Vw9RnMz3kFS85vC1NnDHM+22d5HFaVRVl" crossorigin="anonymous"></script>--}}

<script src="https://cdnjs.cloudflare.com/ajax/libs/bootstrap/4.6.0/js/bootstrap.min.js"></script>
<script>
    function updateDateTimeAvailability() {
        var dateInput = document.getElementById('date');
        var timeInput = document.getElementById('time');
        var doctorSelect = document.getElementById('department'); // Add the ID of the doctor select element

        var selectedDate = dateInput.value;
        var selectedDoctor = doctorSelect.value; // Get the selected doctor

        // Fetch booked times for the selected doctor and date using AJAX
        $.ajax({
            url: "{{ route('fetch.booked.times') }}", // Create a new route for fetching booked times
            method: "GET",
            data: {
                doctor: selectedDoctor,
                date: selectedDate
            },
            success: function(response) {
                var bookedTimes = response.bookedTimes;
                console.log('Booked times:', bookedTimes); // Check the logged booked times

                // Loop through available time options and disable booked times
                for (var i = 0; i < timeInput.options.length; i++) {
                    var timeOption = timeInput.options[i].value;
                    if (bookedTimes.includes(timeOption)) {
                        timeInput.options[i].disabled = true;
                    } else {
                        timeInput.options[i].disabled = false;
                    }
                }

                // Call the function to update the submit button status
                updateSubmitButtonStatus();
            },
            error: function() {
                console.error("Error fetching booked times.");
            }
        });
    }

</script>
