@include('user.navbar')

<head>
    <link rel="stylesheet" href="{{ asset('../assets/css/booking.css') }}">
    <script src="https://cdnjs.cloudflare.com/ajax/libs/moment.js/2.29.1/moment.min.js"></script>
    <script src="https://cdnjs.cloudflare.com/ajax/libs/bootstrap/4.6.0/js/bootstrap.min.js"></script>
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
<script>
    var bookedDates = @json($bookedDates ?? []);
    var bookedTimes = @json($bookedTimes ?? []);
    var workingHoursStart = moment('09:00', 'HH:mm');
    var workingHoursEnd = moment('18:00', 'HH:mm');

    function isTimeWithinWorkingHours(time) {
        return moment(time, 'HH:mm').isBetween(workingHoursStart, workingHoursEnd, null, '[]');
    }

    function isDateAvailable(date) {
        return !bookedDates.includes(date);
    }

    function isTimeAvailable(time) {
        return !bookedTimes.includes(time);
    }

    // Function to check if both date and time are available
    function isDateTimeAvailable(date, time) {
        return isDateAvailable(date) && isTimeAvailable(time) && isTimeWithinWorkingHours(time);
    }

    function updateDateTimeAvailability() {
        var dateInput = document.getElementById('date');
        var timeInput = document.getElementById('time');

        for (var i = 0; i < bookedDates.length; i++) {
            var bookedDate = bookedDates[i];
            dateInput.querySelector(`[value="${bookedDate}"]`).disabled = true;
        }

        for (var i = 0; i < bookedTimes.length; i++) {
            var bookedTime = bookedTimes[i];
            timeInput.querySelector(`[value="${bookedTime}"]`).disabled = true;
        }
    }

    function updateSubmitButtonStatus() {
        var selectedDate = dateInput.value;
        var selectedTime = timeInput.value;
        var submitButton = document.getElementById('submitButton');

        var isDateUnavailable = !isDateAvailable(selectedDate) || !isTimeWithinWorkingHours(selectedTime);
        var isTimeUnavailable = !isTimeAvailable(selectedTime) || !isTimeWithinWorkingHours(selectedTime);

        if (isDateTimeAvailable(selectedDate, selectedTime)) {
            submitButton.disabled = false;
        } else {
            submitButton.disabled = true;
        }
    }

    // Get the date and time input elements
    var dateInput = document.getElementById('date');
    var timeInput = document.getElementById('time');

    // Disable booked dates and times on page load
    updateDateTimeAvailability();

    // Add event listeners to inputs
    dateInput.addEventListener('input', function() {
        updateDateTimeAvailability();
        updateSubmitButtonStatus();
    });

    timeInput.addEventListener('input', function() {
        updateDateTimeAvailability();
        updateSubmitButtonStatus();
    });

    // Call this on page load to disable any pre-filled values
    updateSubmitButtonStatus();
</script>
