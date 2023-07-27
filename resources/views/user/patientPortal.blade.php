@include('user.navbar')
<link href="https://cdn.jsdelivr.net/npm/bootstrap@5.0.2/dist/css/bootstrap.min.css" rel="stylesheet" integrity="sha384-EVSTQN3/azprG1Anm3QDgpJLIm9Nao0Yz1ztcQTwFspd3yD65VohhpuuCOmLASjC" crossorigin="anonymous">
<div class="container" style="margin-top: 120px;">
    <h1>Your Notices</h1>

    @if ($notices->isEmpty())
        <p>No notices found.</p>
    @else
        <div class="card-columns">
            @foreach ($notices as $notice)
                <div class="card mt-4">
                    <div class="card-body">
                        @if ($notice->doctor) 
                            <h6 class="card-subtitle mb-2 text-muted">Doctor: {{ $notice->doctor->name }}</h6>
                            <h6 class="card-subtitle mb-2 text-muted">Specialist: {{ $notice->doctor->speciality }}</h6>
                        @else
                            <h6 class="card-subtitle mb-2 text-muted">Doctor: Not available</h6>
                        @endif
                        <h6 class="card-subtitle mb-2 text-muted">Date and Time: {{ $notice->created_at }}</h6>
                        <h5 class="card-title">{{ $notice->notice }}</h5>
                    </div>
                </div>
            @endforeach
        </div>
    @endif
</div>
