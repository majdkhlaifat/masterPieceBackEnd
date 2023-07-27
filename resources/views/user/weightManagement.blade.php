<!DOCTYPE html>
<html>
<head>
  <title>BMI Calculator</title>
  <link rel="stylesheet" href="https://stackpath.bootstrapcdn.com/bootstrap/4.3.1/css/bootstrap.min.css">
  <style>
    body {
      font-family: Arial, sans-serif;
      background-image: url(https://www.pfanner.com/fileadmin/_processed_/2/d/csm_pfanner-getraenke-fruchtsaft-kalorien_a98efbe205.jpg);
      background-size: cover;
    }

    h1 {
      text-align: center;
    }

    .main {
      max-width: 500px;
      margin: 0 auto;
      background-color: #ffffff;
      padding: 20px;
      border-radius: 5px;
      box-shadow: 0 0 10px rgba(0, 0, 0, 0.1);
      margin-top: 120px;
    }

    label {
      display: block;
      margin-bottom: 5px;
    }

    input[type="number"] {
      width: 100%;
      padding: 5px;
      margin-bottom: 10px;
    }

    button {
      width: 100%;
      padding: 10px;
      background-color: #4CAF50;
      color: white;
      border: none;
      cursor: pointer;
    }

    #result {
      font-weight: bold;
      text-align: center;
      margin-top: 20px;
    }

    #recommendation {
      margin-top: 20px;
      font-weight: bold;
    }

    .category-underweight {
      color: blue;
    }

    .category-normal-weight {
      color: green;
    }

    .category-overweight {
      color: orange;
    }

    .category-obese {
      color: red;
    }
  </style>
</head>
<body>
<div class="absolute top-0 left-0 mt-4 ml-4">
        <a class="underline text-sm text-gray-600 hover:text-gray-900 rounded-md focus:outline-none focus:ring-2 focus:ring-offset-2 focus:ring-indigo-500" href="#" onclick="goBack(); return false;">
        {{ __('Return to Previous Page') }}
        </a>
  </div>
  <div class="main">
    <h1>BMI Calculator</h1>
    <label for="weight">Weight (kg):</label>
    <input type="number" id="weight" class="form-control" required>

    <label for="height">Height (cm):</label>
    <input type="number" id="height" class="form-control" required>

    <button onclick="calculateBMI()" class="btn btn-primary">Calculate</button>

    <div id="result"></div>

    <div id="recommendation"></div>
  </div>

  <script>
    function calculateBMI() {
      var weight = parseFloat(document.getElementById("weight").value);
      var height = parseFloat(document.getElementById("height").value);

      if (isNaN(weight) || isNaN(height)) {
        document.getElementById("result").innerHTML = "Please enter valid values for weight and height.";
        document.getElementById("recommendation").innerHTML = "";
        return;
      }

      var bmi = weight / ((height / 100) ** 2);
      var category = "";

      if (bmi < 18.5) {
        category = "Underweight";
      } else if (bmi >= 18.5 && bmi < 25) {
        category = "Normal-weight";
      } else if (bmi >= 25 && bmi < 30) {
        category = "Overweight";
      } else {
        category = "Obese";
      }

      var healthyWeightMin = 18.5 * ((height / 100) ** 2);
      var healthyWeightMax = 24.9 * ((height / 100) ** 2);

      var resultText = "BMI: " + bmi.toFixed(2) + "<br>";
      resultText += "Category: <span class='category-" + category.toLowerCase().replace(' ', '-') + "'>" + category + "</span><br>";
      resultText += "Healthy Weight Range: " + healthyWeightMin.toFixed(2) + " - " + healthyWeightMax.toFixed(2) + " kg";

      document.getElementById("result").innerHTML = resultText;

      var recommendationText = "";

      if (category === "Underweight") {
        recommendationText = "It appears that you are underweight. It's important to consult with a healthcare professional for a comprehensive evaluation and personalized advice.";
      } else if (category === "Normal-weight") {
        recommendationText = "Congratulations! Your weight falls within the normal range. Maintain a balanced diet and an active lifestyle to stay healthy.";
      } else if (category === "Overweight") {
        recommendationText = "You are overweight. Consider incorporating regular physical activity and a healthy eating plan into your lifestyle. It's recommended to consult with a healthcare professional or a registered dietitian for personalized guidance.";
      } else {
        recommendationText = "You are in the obese category. It's crucial to seek medical advice and develop a comprehensive weight management plan under the supervision of healthcare professionals.";
      }

      document.getElementById("recommendation").innerHTML = recommendationText;
    }
  </script>

  <script>
    function goBack() {
      window.history.back();
    }
  </script>
</body>
</html>
