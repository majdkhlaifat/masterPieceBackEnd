
<link rel="stylesheet" href="https://cdn.jsdelivr.net/npm/bootstrap@4.0.0/dist/css/bootstrap.min.css" integrity="sha384-Gn5384xqQ1aoWXA+058RXPxPg6fy4IWvTNh0E263XmFcJlSAwiGgFAW/dAiS6JXm" crossorigin="anonymous">
<style>
    /* Custom styles */
    body {
         background-image: repeating-radial-gradient(circle, #c6e0f5, #59b2f7);
    }
    .container {
        margin-top: 20px;
    }

    .card, .search {
        border-radius: 8px;
        box-shadow: 0 2px 4px rgba(3, 107, 252);
    }

    .card-link {
        color: #007bff;
    }
    h1{
        margin-top: 30px;
    }
</style>
<nav class="navbar navbar-expand-lg navbar-light bg-light">
    <div class="container">
        <!-- Website Logo -->
        <a class="navbar-brand" href="{{route('doctor.home')}}">
            <img src="{{ asset('assets/imgs/LogoMakr-0qlole.png') }}" alt="HealthHub Logo" width="70" height="70">
        </a>

        @if (Route::has('login'))
            @auth
                <x-app-layout>

                </x-app-layout>
            @endauth
        @endif
    </div>
</nav>
<link rel="stylesheet" href="https://cdn.jsdelivr.net/npm/bootstrap@4.0.0/dist/css/bootstrap.min.css" integrity="sha384-Gn5384xqQ1aoWXA+058RXPxPg6fy4IWvTNh0E263XmFcJlSAwiGgFAW/dAiS6JXm" crossorigin="anonymous">

<div class="container">
    <div class="row">
        <div class="col-md-6 mb-4 search" style="padding: 0; margin-left: 15px">
            <input type="text" id="search" class="form-control" placeholder="Search by name or email">
        </div>
    </div>
    <h1 style="margin-top: 30px">Patient Portals</h1>
    <div class="row">
        @foreach ($users as $user)
        <div class="col-md-4 mb-4" id="user-card">
            <div class="card">
                <div class="card-body">
                    <h5 class="card-title">{{ $user->name }}</h5>
                    <h6 class="card-subtitle mb-2 text-muted">{{ $user->email }}</h6>
                    <h6 class="card-subtitle mb-2 text-muted">{{ $user->phone }}</h6>
                    <h6 class="card-subtitle mb-2 text-muted">{{ $user->address }}</h6>
                    <a href="{{ route('doctor.patientPortal', ['patient_id' => $user->id]) }}" class="card-link">Patient Portal</a>
                </div>
            </div>
        </div>
        @endforeach
    </div>
    <div id="no-results-message" style="display: none;">
        No results found.
    </div>
</div>

<script>
    document.getElementById('search').addEventListener('input', function() {
        var searchValue = this.value.toLowerCase();
        var userCards = document.querySelectorAll('#user-card');
        var hasResults = false;
        for (var i = 0; i < userCards.length; i++) {
            var card = userCards[i];
            var name = card.querySelector('.card-title').innerText.toLowerCase();
            var email = card.querySelector('.card-subtitle').innerText.toLowerCase();
            if (name.includes(searchValue) || email.includes(searchValue)) {
                card.style.display = 'block';
                hasResults = true;
            } else {
                card.style.display = 'none';

            }
        }
        if (hasResults) {
            noResultsMessage.style.display = 'none'; // Hide the message
        } else {
            noResultsMessage.style.display = 'block'; // Show the message
        }
    });
</script>
