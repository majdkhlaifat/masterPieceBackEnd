<!DOCTYPE html>
<html>
<head>
    <style>
        #donutchart,
        #appointment-status-chart {
            width: 50%;
            height: 400px;
            margin: 70px 0;
        }

        #charts-container {
            display: flex;
            justify-content: space-between;
            width: 100%;
            margin: 0;
            padding: 10px;
            height: 520px;
        }
        .card {
            border-radius: 8px;
            box-shadow: 0 2px 4px rgba(3, 107, 252);
            margin-bottom: 20px;
        }
        h1 {
            margin-top: 30px;
        }
        #search {
            background-color: #191C24;
            color: white;
            border-radius: 4px;
            border: none;
            padding: 10px;
            box-shadow: 0 2px 4px rgba(3, 107, 252);
            width: 100%;
        }
    </style>
</head>
<div>
<div class="container">
    <div class="row">
        <div class="col-md-12">
            <div id="charts-container">
                <div id="donutchart" ></div>
                <div id="appointment-status-chart"></div>
            </div>
        </div>
    </div>
    <div class="row">
        <div class="col-md-6 mb-4 search" style="padding: 0; margin-left: 15px">
            <input type="text" id="search" class="form-control" placeholder="Search by name or email">
        </div>
    </div>
    <div class="row">
        @foreach ($users as $user)
            <div class="col-md-3 mb-4" id="user-card" style="margin-right: 2%;">
                <div class="card">
                    <div class="card-body">
                        <h5 class="card-title">{{ $user->name }}</h5>
                        <h6 class="card-subtitle mb-2 text-muted">{{ $user->email }}</h6>
                        <h6 class="card-subtitle mb-2 text-muted">{{ $user->phone }}</h6>
                        <h6 class="card-subtitle mb-2 text-muted">{{ $user->address }}</h6>
                    </div>
                </div>
            </div>
        @endforeach
    </div>
    <div id="no-results-message" style="display: none;">
        No results found.
    </div>
</div>
</div>
<script type="text/javascript" src="https://www.gstatic.com/charts/loader.js"></script>
<script type="text/javascript">
    document.addEventListener('DOMContentLoaded', function () {
        google.charts.load("current", { packages: ["corechart"] });
        google.charts.setOnLoadCallback(drawCharts);

        function drawCharts() {
            // Fetch data for User Type Distribution chart
            fetch('/user-type-counts')
                .then(response => response.json())
                .then(data => {
                    var userTypeData = google.visualization.arrayToDataTable([
                        ['User Type', 'Count'],
                        ['Patients', data.patients],
                        ['Doctors', data.doctors],
                        ['Admins', data.admins],
                    ]);

                    var userTypeOptions = {
                        title: 'Users Type Distribution',
                        titleTextStyle: {
                            color: 'white',
                            fontSize: 25,
                        },
                        legend: {
                            textStyle: {
                                color: 'white',
                            },
                        },
                        pieHole: 0.4,
                        backgroundColor: '#191C24',
                    };

                    var userTypeChart = new google.visualization.PieChart(document.getElementById('donutchart'));
                    userTypeChart.draw(userTypeData, userTypeOptions);
                })
                .catch(error => console.error('Error fetching user type data:', error));

            // Fetch data for Appointment Status Distribution chart
            fetch('/appointment-status-counts')
                .then(response => response.json())
                .then(data => {
                    console.log('Data fetched for appointment status chart:', data);
                    var appointmentStatusData = google.visualization.arrayToDataTable([
                        ['Status', 'Count'],
                        ['In Progress', data.inProgressCount],
                        ['Approved', data.approvedCount],
                        ['Cancelled', data.cancelledCount],
                    ]);

                    var appointmentStatusOptions = {
                        title: 'Appointment Status Distribution',
                        titleTextStyle: {
                            color: 'white',
                            fontSize: 25,
                        },
                        legend: {
                            textStyle: {
                                color: 'white',
                            },
                        },
                        pieHole: 0.4,
                        backgroundColor: '#191C24',
                    };

                    var appointmentStatusChart = new google.visualization.PieChart(document.getElementById('appointment-status-chart'));
                    appointmentStatusChart.draw(appointmentStatusData, appointmentStatusOptions);
                })
                .catch(error => console.error('Error fetching appointment status data:', error));
        }
    });
</script>
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
            noResultsMessage.style.display = 'none';
        } else {
            noResultsMessage.style.display = 'block';
        }
    });
</script>
</body>
</html>
