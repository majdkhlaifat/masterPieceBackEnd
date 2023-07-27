@include('user.navbar')
<!DOCTYPE html>
<html>
<head>
  <title>Heart Age Calculator</title>
  <link rel="stylesheet" href="https://stackpath.bootstrapcdn.com/bootstrap/4.3.1/css/bootstrap.min.css">
  <style>
    body {
      font-family: Arial, sans-serif;
      margin: 20px;
    }

    h1 {
      text-align: center;
      margin-top: 120px;
    }

    form {
      max-width: 400px;
      margin: 0 auto;
    }

    label {
      display: block;
      margin-top: 10px;
    }

    input,
    select {
      width: 100%;
      padding: 5px;
      margin-top: 5px;
    }

    button {
      display: block;
      width: 100%;
      padding: 10px;
      margin-top: 10px;
      background-color: #025AF6;
      color: white;
      border: none;
      cursor: pointer;
    }

    #result {
      text-align: center;
      margin-top: 20px;
    }

    #heartAgeResult {
      font-size: 24px;
      font-weight: bold;
    }

    #interpretation {
      margin-top: 10px;
    }
  </style>
</head>
<body>

  <div class="container">
    <h1>Heart Age Calculator</h1>
    <form id="heartAgeForm">
      <div class="form-group">
        <label for="age">Age:</label>
        <input type="number" class="form-control" id="age" required>
      </div>

      <div class="form-group">
        <label for="gender">Gender:</label>
        <select class="form-control" id="gender" required>
          <option value="male">Male</option>
          <option value="female">Female</option>
        </select>
      </div>

      <div class="form-group">
        <label for="bloodPressure">Systolic Blood Pressure (mmHg):</label>
        <input type="number" class="form-control" id="bloodPressure" required>
      </div>

      <div class="form-group">
        <label for="cholesterol">Total Cholesterol (mg/dL):</label>
        <input type="number" class="form-control" id="cholesterol" required>
      </div>

      <div class="form-group">
        <label for="smoker">Smoker:</label>
        <select class="form-control" id="smoker" required>
          <option value="yes">Yes</option>
          <option value="no">No</option>
        </select>
      </div>

      <button type="submit" class="btn btn-primary">Calculate Heart Age</button>
    </form>

    <div id="result" style="display: none;">
      <h2>Your Heart Age is:</h2>
      <p id="heartAgeResult"></p>
      <p id="interpretation"></p>
    </div>
  </div>

  <script src="https://stackpath.bootstrapcdn.com/bootstrap/4.3.1/js/bootstrap.min.js"></script>
  <script>
    // Heart age calculation function
    function calculateHeartAge(event) {
      event.preventDefault();

      const age = parseInt(document.getElementById('age').value);
      const gender = document.getElementById('gender').value;
      const bloodPressure = parseInt(document.getElementById('bloodPressure').value);
      const cholesterol = parseInt(document.getElementById('cholesterol').value);
      const smoker = document.getElementById('smoker').value;

      // Perform heart age calculation based on your chosen algorithm or formulas

      // For demonstration purposes, let's use a simple calculation
      let heartAge = age + 5;

      // Display the result
      document.getElementById('heartAgeResult').textContent = heartAge;

      // Provide an interpretation
      let interpretation = "";
      if (heartAge < age) {
        interpretation = "Your heart age is younger than your actual age. Keep up the good work!";
      } else if (heartAge === age) {
        interpretation = "Your heart age is the same as your actual age. Stay on track!";
      } else {
        interpretation = "Your heart age is older than your actual age. Consider adopting healthier habits.";
      }
      document.getElementById('interpretation').textContent = interpretation;

      // Show the result section
      document.getElementById('result').style.display = 'block';

      // Hide the result after 5 seconds (5000 milliseconds)
      setTimeout(function () {
        document.getElementById('result').style.display = 'none';
      }, 5000);
    }

    // Attach the form submission event listener
    document.getElementById('heartAgeForm').addEventListener('submit', calculateHeartAge);
  </script>
</body>
</html>
