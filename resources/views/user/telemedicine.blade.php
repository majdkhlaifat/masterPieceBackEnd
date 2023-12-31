@include('user.navbar')
<div class="page-section" style="margin-top: 120px;">
    <div class="row justify-content-center">
        <div class="col-md-6 mb-4">
            <input type="text" id="search" class="form-control" placeholder="Search by name or specialty">
        </div>
    </div>
    <div class="container">
        <h1 class="text-center mb-5">Our Doctors</h1>

        <div class="row">
            @foreach($doctors as $doctor)
                <div class="col-md-4">
                    <div class="card" style="width: 100%; margin: 10px; margin-bottom:30px;">
                        <img src="{{ asset('doctorimage/' . $doctor->image) }}" class="card-img-top" alt="{{ $doctor->name }} picture" style="height: 250px;">
                        <div class="card-body text-center">
                            <h5 class="card-title">Dr.{{ $doctor->name }}, {{ $doctor->speciality }}</h5>
                            <a href="#" class="btn btn-primary" onclick="showContactModal('{{ $doctor->name }}', '{{ $doctor->email }}', '{{ $doctor->phone }}','{{ $doctor->speciality }}')">Doctor Information</a>
                        </div>
                    </div>
                </div>
            @endforeach
        </div>
    </div>
</div>

<!-- Add a modal container -->
<div class="modal fade" id="contactModal" tabindex="-1" role="dialog" aria-labelledby="contactModalLabel" aria-hidden="true">
    <div class="modal-dialog" role="document">
        <div class="modal-content">
            <div class="modal-header">
                <h5 class="modal-title" id="contactModalLabel">Doctor Information</h5>
                <button type="button" class="btn-close" data-bs-dismiss="modal" aria-label="Close"></button>
            </div>
            <div class="modal-body">
                <p>Name: <span id="doctorName"></span></p>
                <p>Email: <span id="doctorEmail"></span></p>
                <p>Phone: <span id="doctorPhone"></span></p>
                <p>Specialty: <span id="doctorSpeciality"></span></p>
            </div>
            <div class="modal-footer">
                <button type="button" class="btn btn-secondary" data-bs-dismiss="modal">Close</button>
            </div>
        </div>
    </div>
</div>

<!-- Include necessary CSS and JavaScript files for Bootstrap modal -->
<link rel="stylesheet" href="https://cdn.jsdelivr.net/npm/bootstrap@5.0.2/dist/css/bootstrap.min.css">
<script src="https://cdn.jsdelivr.net/npm/jquery@3.6.0/dist/jquery.min.js"></script>
<script src="https://cdn.jsdelivr.net/npm/bootstrap@5.0.2/dist/js/bootstrap.bundle.min.js"></script><script>
    function showContactModal(name, email, phone, specialty) {
        $('#doctorName').text('Dr.' + name);
        $('#doctorEmail').text(email);
        $('#doctorPhone').text(phone);
        $('#doctorSpeciality').text(specialty);
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
