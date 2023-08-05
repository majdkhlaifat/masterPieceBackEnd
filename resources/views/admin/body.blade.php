<!DOCTYPE html>
<html>
<head>
    <script type="text/javascript" src="https://www.gstatic.com/charts/loader.js"></script>
    <script type="text/javascript">
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
                    var appointmentStatusData = google.visualization.arrayToDataTable([
                        ['Status', 'Percentage'],
                        ['In Progress', data.inProgressPercentage],
                        ['Canceled', data.canceledPercentage],
                        ['Approved', data.approvedPercentage],
                    ]);

                    var appointmentStatusOptions = {
                        title: 'Appointment Status Distribution',
                        chartArea: { width: '50%' },
                        hAxis: {
                            title: 'Percentage',
                            format: 'percent',
                            minValue: 0,
                            maxValue: 1,
                        },
                        vAxis: {
                            title: 'Status',
                        },
                        backgroundColor: '#191C24',
                        colors: ['#4CAF50', '#F44336', '#2196F3'], // Set custom colors for the bars
                    };

                    var appointmentStatusChart = new google.visualization.BarChart(document.getElementById('barchart'));
                    appointmentStatusChart.draw(appointmentStatusData, appointmentStatusOptions);
                })
                .catch(error => console.error('Error fetching appointment status data:', error));
        }
    </script>
    <style>
        /* Custom CSS for the chart containers (optional) */
        #donutchart {
            width: 500px;
            height: 400px;
            margin: 50px 0;
        }
        #barchart {
             /*width: 1000px;*/
             /*height: 1000px;*/
             margin: 1000 ;
         }
    </style>
</head>
<body>
<div id="barchart"></div> <!-- Add this div for the bar chart -->
{{--<div id="donutchart"></div>--}}
</body>
</html>
