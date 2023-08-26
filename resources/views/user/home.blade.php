        @include('user.navbar')
        <!-- End Of Navbar -->

        @if(session('error'))
            <script>
                alert('{{ session('error') }}');
            </script>
            @endif
        <!-- background -->
        <div class="background"></div>
        <div class="main">

            <h1><div>We are providing best and affordable <span>health care</span></div></h1>
            <div class="links">
                <a href="{{ route('register') }}"><button type="button">Sign UP </button></a> or
                <a href="{{ route('login') }}"><button type="button">Login </button></a>
            </div>
        </div>

        <!-- introducing the website -->
        <div class="intro">
            <div class="image-overlay">
                <img src="https://www.northshore.org/globalassets/healthy-you/blog/2012-2014/pediatric-appointments.jpg" alt="doctor-image">
            </div>
            <div class="welcome">
                <h3>Welcome To Our Website: Your Trusted Source for Comprehensive Healthcare</h3>
                <p>At Health Hub website, we are committed to providing exceptional medical care and personalized attention to our patients. With a team of highly skilled doctors and a state-of-the-art facility, we strive to be your go-to destination for all your healthcare needs.</p>
            </div>
        </div>


    </div>
    <!-- services -->
    </div>
    <div class="Services">
        <h2>Our Services</h2>
        <div class="card-group">
        <div class="card">
    <a href="{{ route('user.booking.create') }}">
        <div class="content">
            <h3><i class="fa-regular fa-calendar-check fa-2xl" style="color: #537eea;"></i></h3>
            <h3>Online Booking</h3>
            <p>Need to make an appointment this week? Use HealthHub to find doctors near you who take your insurance. It’s simple, secure, and free.</p>
        </div>
    </a>
</div>

            <div class="card">
                <a href="{{ route('user.patientPortal') }}">
                    <div class="content">
                        <h3><i class="fa-solid fa-hospital-user fa-2xl" style="color: #537eea;"></i></h3>
                        <h3>Patient Portal</h3>
                        <p>With Patient Portal, you can connect with your doctor through a convenient and quick way.</p>
                    </div>
                </a>
            </div>
            <div class="card">
                <a href="{{ route('user.chatbot') }}">
                    <div class="content">
                        <h3><i class="fa-regular fa-comment fa-2xl" style="color: #537eea;"></i></h3>
                        <h3>Chatbot</h3>
                        <p>Chatbots work with patients in scheduling appointments, canceling appointments, and making sure patients come prepared.</p>
                    </div>
                </a>
            </div>
        </div>

            <div class="Services">
                <div class="card-group">
                    <div class="card">
                        <a href="{{ route('user.telemedicine') }}">
                            <div class="content">
                                <h3><i class="fa-solid fa-stethoscope fa-2xl" style="color: #537eea;"></i></h3>
                                <h3>Telemedicine Services</h3>
                                <p>Allows you to connect with our healthcare team...</p>
                            </div>
                        </a>
                    </div>
                    <div class="card">
                        <a href="{{ route('user.weightManagement') }}">
                            <div class="content">
                                <h3><i class="fa-brands fa-nutritionix fa-2xl" style="color: #537eea;"></i></h3>
                                <h3>BMI Calculator</h3>
                                <p>BMI is a gauge of your risk for diseases that can occur with more body fat.</p>
                            </div>
                        </a>
                    </div>
                    <div class="card">
                    <a href="{{ route('user.heart-age') }}">
                            <div class="content">
                                <h3><i class="fa-solid fa-heart-pulse fa-2xl" style="color: #537eea;"></i></h3>
                                <h3>Heart Age Test</h3>
                                <p>One way to understand your risk for a heart attack or stroke is to learn your “heart age.” </p>
                            </div>
                        </a>
                    </div>
                </div>

            </div>
        <!-- appointement -->
            <div class="appointement">
                <div class="fact">
                    <img src="https://media.istockphoto.com/id/540131720/photo/close-up-view-of-doctor%C3%A2s-working-table.jpg?s=612x612&w=0&k=20&c=3GALajQLYymLhFpYo3uNzSfMIoESdUNu6-dzLWvnne4=" >
                </div>
                <div class="enter">
                    <h3>Make an Appointment</h3>
                    <div><a href="signUp.html">Sign Up </a>
                        or <a href="login.html"> Log in </a> to make your appointment. </div>
                </div>
            </div>

    </div>

    @include('user.footer')
            <!-- Footer -->
        </div>
        <!-- End of .container -->

    <script src="https://cdn.jsdelivr.net/npm/bootstrap@5.0.2/dist/js/bootstrap.bundle.min.js" integrity="sha384-MrcW6ZMFYlzcLA8Nl+NtUVF0sA7MsXsP1UyJoMp4YLEuNSfAP+JcXn/tWtIaxVXM" crossorigin="anonymous"></script>
    <script type="text/javascript" src="{{ asset('assets/js/vanilla-tilt.js') }}"></script>

    <script>
        VanillaTilt.init(document.querySelectorAll(".card"), {
    max: 25,
    speed: 400,
    glare: true,
    "max-glare": 1,
    });
    </script>

</body>
</html>
