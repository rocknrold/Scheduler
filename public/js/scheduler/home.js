$(function(){

    $.ajax({
        type:'GET',
        url:'/gender',
        dataType:'json',
        success:function(response){
            // console.log(data);
            // Load the Visualization API and the corechart package.
            google.charts.load('current', {'packages':['corechart']});

            // Set a callback to run when the Google Visualization API is loaded.
            google.charts.setOnLoadCallback(drawChart);
            
            // Callback that creates and populates a data table,
            // instantiates the pie chart, passes in the data and
            // draws it.
            function drawChart() {

                // Create the data table.
                var data = new google.visualization.DataTable();
                data.addColumn('string', 'Gender');
                data.addColumn('number', 'count');
                data.addRows([
                ['Female', response.female],
                ['Male', response.male],
                ]);

                // Set chart options
                var options = {'title':'Client Genders',
                'width':280, is3D: true,
                'height':300};

                // Instantiate and draw our chart, passing in some options.
                var chart = new google.visualization.PieChart(document.getElementById('gender_chart'));
                chart.draw(data, options);
            }

        },
        error:function(data){
            console.log(data);
        }
    });


// GET ALL HEADERS DATA FOR CHART POPULATE
    $.ajax({
        type:'GET',
        url:'/cheaders',
        dataType:'json',
        success:function(response){
            console.log(response);
            $('#todayAppoint').html(response[0].appointments);

            var progress = response[2].finished/response[0].appointments * 100;
            var progress = isNaN(progress) ? 0 : progress;
            console.log(progress);
            $('#ongoingLeft').html(response[1].ongoing + " LEFT");
            $('#ongoing').html(progress.toFixed(0) + "%");
            $('#ongoingProgress').css('width', progress.toFixed(0)+"%");

            $('#finish').html(response[2].finished);   
            $('#newClients').html(response[3].client);
        },
        error:function(response){
            console.log(response);
        }
    });


//  GET ALL WEEKLY APPOINTMENTS 
    $.ajax({
        type:'GET',
        url:'/weeks/appointment',
        dataType:'json',
        success:function(response){
            google.charts.load('current', {packages: ['corechart', 'bar']});
            google.charts.setOnLoadCallback(drawMultSeries);

            function drawMultSeries() {
                var data = new google.visualization.DataTable();
                data.addColumn('string', 'Date');
                data.addColumn('number', 'Clients');
                
                var rowdatas = [];
                $.each(response, function(key,value){
                    rowdatas.push([value.date,value.num]);
                })

                data.addRows(rowdatas);

                var options = {
                title: 'Weekly Client Report',
                hAxis: {
                title: 'Days in a Week',
                viewWindow: {
                min: [7, 30, 0],
                max: [17, 30, 0]
                }
                },
                vAxis: {
                title: 'Clients Appointment'
                }
                };

                var chart = new google.visualization.ColumnChart(
                document.getElementById('weeklyChart'));

                chart.draw(data, options);
            }
        },
        error:function(response){
            console.log(error);
        }
    })

});