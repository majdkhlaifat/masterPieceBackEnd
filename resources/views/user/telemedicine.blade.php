@include('user.navbar')

<div class="page-section" style="margin-top: 120px;">
    <div class="container">
    <h1 class="text-center mb-5 wow fadeInUp" style="font-size: 2em;">Our Doctors</h1>

      <div class="row">
    @foreach($doctors as $doctor)
        <div class="col-md-4">
            <div class="card" style="width: 350px; margin: 10px; margin-bottom:30px;">
            <img src="{{ asset('doctorimage/' . $doctor->image) }}" class="card-img-top" alt="{{ $doctor->name }}picture" style="width: 100%; height: 250px;">
                <div class="card-body" >
                    <h5 class="card-title">Dr.{{ $doctor->name }},{{ $doctor->speciality }}</h5>
                    <a href="#" class="btn btn-primary">Contact</a>
                </div>
            </div>
        </div>
    @endforeach
</div>   
      </div>
    </div>
  </div>

@include('user.footer')

