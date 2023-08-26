@include('user.navbar')

    <!DOCTYPE html>
<html lang="en">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>Medical History Form</title>
    <link href="https://cdn.jsdelivr.net/npm/bootstrap@5.0.2/dist/css/bootstrap.min.css" rel="stylesheet" integrity="sha384-EVSTQN3/azprG1Anm3QDgpJLIm9Nao0Yz1ztcQTwFspd3yD65VohhpuuCOmLASjC" crossorigin="anonymous">
    <link rel="stylesheet" href="{{asset('assets/css/history.css')}}">
</head>
<body>
<div class="container mt-5">
    <h1 class="mb-4">Patient Medical History</h1>
    @if ($user->medicalHistories()->where('medical_history_submitted', true)->exists())
        <div class="alert alert-warning">
            You have already submitted your medical history.
        </div>
    @else
    <form method="post" action="{{ route('store.medical-history')}}">
        @csrf
        @if(session('success'))
            <div class="alert alert-success custom-alert">
                {{ session('success') }}
                <button type="button" class="btn-close" data-bs-dismiss="alert" aria-label="Close"></button>
            </div>
        @endif
        <div class="mb-3">
            <label class="form-label">Date of Birth:</label>
            <input type="date" class="form-control" name="dob">
            @error('dob')
            <div class="alert alert-danger">{{ $message }}</div>
            @enderror
        </div>
        <div class="mb-3">
            <label class="form-label">Do you have a history of Diabetes Mellitus?</label>
            <div class="form-check">
                <input class="form-check-input" type="radio" name="diabetes" id="diabetesYes" value="yes">
                <label class="form-check-label" for="diabetesYes">Yes</label>
            </div>
            <div class="form-check">
                <input class="form-check-input" type="radio" name="diabetes" id="diabetesNo" value="no">
                <label class="form-check-label" for="diabetesNo">No</label>
            </div>
            @error('diabetes')
            <div class="alert alert-danger">{{ $message }}</div>
            @enderror
        </div>
        <div class="mb-3">
            <label class="form-label">Do you have a history of Hypertension?</label>
            <div class="form-check">
                <input class="form-check-input" type="radio" name="hypertension" id="hypertensionYes" value="yes">
                <label class="form-check-label" for="hypertensionYes">Yes</label>
            </div>
            <div class="form-check">
                <input class="form-check-input" type="radio" name="hypertension" id="hypertensionNo" value="no">
                <label class="form-check-label" for="hypertensionNo">No</label>
            </div>
            @error('hypertension')
            <div class="alert alert-danger">{{ $message }}</div>
            @enderror
        </div>
        <div class="mb-3">
            <label class="form-label">Do you have a history of Heart Disease?</label>
            <div class="form-check">
                <input class="form-check-input" type="radio" name="heart_disease" id="heartYes" value="yes">
                <label class="form-check-label" for="heart_diseaseYes">Yes</label>
            </div>
            <div class="form-check">
                <input class="form-check-input" type="radio" name="heart_disease" id="heartNo" value="no">
                <label class="form-check-label" for="heart_diseaseNo">No</label>
            </div>
            @error('heart_disease')
            <div class="alert alert-danger">{{ $message }}</div>
            @enderror
        </div>
        <div class="mb-3">
            <label class="form-label">Do you smoke?</label>
            <div class="form-check">
                <input class="form-check-input" type="radio" name="smoking" id="smokingYes" value="yes">
                <label class="form-check-label" for="smokingYes">Yes</label>
            </div>
            <div class="form-check">
                <input class="form-check-input" type="radio" name="smoking" id="smokingNo" value="no">
                <label class="form-check-label" for="smokingNo">No</label>
            </div>
            @error('smoking')
            <div class="alert alert-danger">{{ $message }}</div>
            @enderror
        </div>
        <div class="mb-3">
            <label class="form-label">Select your Blood Type:</label>
            <select class="form-select" name="blood_type">
                <option value="A">A</option>
                <option value="B">B</option>
                <option value="AB">AB</option>
                <option value="O">O</option>
            </select>
            @error('blood_type')
            <div class="alert alert-danger">{{ $message }}</div>
            @enderror
        </div>
        <div class="mb-3">
            <label class="form-label">Any history of Allergies?</label>
            <input type="text" class="form-control" name="allergies" placeholder="e.g. Pollen, Medications">
        </div>
        <div class="mb-3">
            <label class="form-label">Any other relevant medical history or comments?</label>
            <textarea class="form-control" name="comments" rows="3"></textarea>
        </div>
        <button type="submit" class="btn btn-primary">Submit</button>
    </form>
    @endif
    </div>
<script src="https://cdn.jsdelivr.net/npm/bootstrap@5.0.2/dist/js/bootstrap.bundle.min.js"></script>

</body>
</html>
