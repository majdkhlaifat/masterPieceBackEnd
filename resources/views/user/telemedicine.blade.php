@include('user.navbar')

<div class="page-section" style="margin-top: 120px;">
    <div class="row justify-content-center">
        <div class="col-md-6 mb-4">
            <input type="text" id="search" class="form-control" placeholder="Search by name or specility">
        </div>
    </div>
    <div class="container">
        <h1 class="text-center mb-5 wow fadeInUp" style="font-size: 2em;">Our Doctors</h1>

        <div class="row">
            @foreach($doctors as $doctor)
                <div class="col-md-4">
                    <div class="card" style="width: 350px; margin: 10px; margin-bottom:30px;">
                        <img src="{{ asset('doctorimage/' . $doctor->image) }}" class="card-img-top" alt="{{ $doctor->name }} picture" style="width: 100%; height: 250px;">
                        <div class="card-body text-center">
                            <h5 class="card-title">Dr.{{ $doctor->name }}, {{ $doctor->speciality }}</h5>
                            <a href="#" class="btn btn-primary" onclick="showContactModal('{{ $doctor->name }}', '{{ $doctor->email }}', '{{ $doctor->phone }}','{{ $doctor->speciality }}')">Doctor Information</a>
                            <a href="{{ route('user.livechat', ['doctor' => $doctor->user->id]) }}" class="btn btn-primary">Go Chat Now</a>
                        </div>
                    </div>
                </div>
            @endforeach
        </div>
    </div>
</div>

@include('user.footer')

<!-- Include necessary CSS and JavaScript files for Bootstrap modal -->
<link rel="stylesheet" href="https://maxcdn.bootstrapcdn.com/bootstrap/4.0.0/css/bootstrap.min.css">
<script src="https://code.jquery.com/jquery-3.2.1.slim.min.js"></script>
<script src="https://maxcdn.bootstrapcdn.com/bootstrap/4.0.0/js/bootstrap.min.js"></script>

<!-- Add a modal container -->
<div class="modal fade" id="contactModal" tabindex="-1" role="dialog" aria-labelledby="contactModalLabel" aria-hidden="true">
    <div class="modal-dialog" role="document">
        <div class="modal-content">
            <div class="modal-header">
                <h5 class="modal-title" id="contactModalLabel">Doctor Information</h5>
                <button type="button" class="close" data-dismiss="modal" aria-label="Close">
                    <span aria-hidden="true">&times;</span>
                </button>
            </div>
            <div class="modal-body">
                <!-- Add your contact information fields here -->
                <p>Name: <span id="doctorName"></span></p>
                <p>Email: <span id="doctorEmail"></span></p>
                <p>Phone: <span id="doctorPhone"></span></p>
                <p>Speciality: <span id="doctorSpeciality"></span></p>
                <!-- You can add more fields as needed -->
            </div>
            <div class="modal-footer">
                <button type="button" class="btn btn-secondary" data-dismiss="modal">Close</button>
            </div>
        </div>
    </div>
</div>

<!-- Add a JavaScript function to show the modal when the Contact button is clicked -->
<script>
    function showContactModal(name, email, phone, speciality) {
        $('#doctorName').text('Dr.' + name);
        $('#doctorEmail').text(email);
        $('#doctorPhone').text(phone);
        $('#doctorSpeciality').text(speciality);
        $('#contactModal').modal('show');
    }

    // Filter doctors based on search input
    $(document).ready(function () {
        $('#search').keyup(function () {
            var value = $(this).val().toLowerCase();
            $('.card-title').filter(function () {
                $(this).parents('.col-md-4').toggle($(this).text().toLowerCase().indexOf(value) > -1);
            });
        });
    });
</script>
