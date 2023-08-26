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
            <h1 style="margin-left: 120px;">Book Appointment</h1>

            @if($errors->any())
                <div class="alert alert-danger">
                    <ul>
                        @foreach ($errors->all() as $error)
                            <li>{{ $error }}</li>
                        @endforeach
                    </ul>
                </div>
            @endif
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
                <input type="date" id="date" name="date" value="{{ old('date') }}" >
                @error('date')
                <span class="error">{{ $message }}</span>
                @enderror

                <select id="time" name="time" >
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
