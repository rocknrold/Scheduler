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
            chartHeaders(response[0].appointments,
                        response[2].finished,
                        response[1].ongoing,
                        response[3].client);
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
                },
                width:'100%',
                height:'200px',
                };

                var chart = new google.visualization.ColumnChart(
                document.getElementById('weeklyChart'));

                chart.draw(data, options);
            }
        },
        error:function(response){
            console.log(response);
        }
    })

    $('#appointSave').on('click',function(e){
        e.preventDefault();

        var name = $('#name').val();
        var age = $('#age').val();
        var address = $('#address').val();
        var date = $('#date').val();
        var time = $('#time').val();

        if(name != "" && age != "" && address != "" && date != "" && time != "") {
            $.ajax({
                type:'POST',
                url:'/appointments',
                data: $("#appointForm").serialize(),
                headers: {'X-CSRF-TOKEN': $('meta[name="csrf-token"]').attr('content')},
                success:function(response){
                    // console.log(response);
                    $('#statusAppForm').html("Appointment Added!");
                    $('#tableAppoint').prepend('<tr id="'+response[1].id+'"><td>'+name+'</td>'+
                                            '<td>'+date+'</td><td>'+time+'</td><td>ongoing</td><td>'+
                                            '<a data-toggle="modal" data-target="#modal-app-edit" data-id="'+ response[1].id +'">'+
                                            '<i class="fa fa-pen"></i></a>'+
                                            '<a class="deletebtn" data-id="'+ response[1].id +'">'+
                                            '<i class="fa fa-trash-o"></i></a>'+
                                            '</td></tr>');       
                    $('#name').val("");
                    $('#age').val("");
                    $('#address').val("");
                    $('#date').val("");
                    $('#time').val("");

                    chartHeaders(parseInt($('#todayAppoint').text()) + 1,
                                parseInt($('#finish').text()),
                                parseInt($('#ongoingLeft').text()) + 1,
                                );
                },
                error:function(response){
                    console.log(response);
                }
            })   
        } else {
            alert("All fields are required");
        }
    });

    $('#modal-app-edit').on('show.bs.modal', function (event) {
        var id = $(event.relatedTarget).data('id') 
        console.log(id);
        var modal = $(this);
        $.ajax({
            type: "GET",
            url: "/appointments/"+id+"/edit",
            dataType: 'json',
            headers: {'X-CSRF-TOKEN': $('meta[name="csrf-token"]').attr('content')},
            success: function (response) {
                // console.log(response);
                modal.find('#apppoint_id').val(response.id);
                modal.find('#statusE').val(response.status).attr('selected',true);
                modal.find('#dateE').val(response.date);
                modal.find('#timeE').val(response.time);
            },
            error: function(error) {
                console.log(error);
            }
        });
    })
    
    $('#modal-app-edit').on('hidden.bs.modal', function (e) {
        $(this).find('form').trigger("reset");
        $('#statusAppFormE').html("");
    });

    $('#appointUpdate').on('click',function(e){
        e.preventDefault();
        var id = $('input[id="apppoint_id"]').val();
        $.ajax({
            type:'PUT',
            url:'/appointments/'+id+'',
            data:$('#appointEditForm').serialize(),
            headers: {'X-CSRF-TOKEN': $('meta[name="csrf-token"]').attr('content')},
            success:function(response){
                // console.log(response);
                $('#statusAppFormE').html("Successfully Edited!");
                $('#app_'+id+'').html('<td>'+response.clients.name+'</td>'+
                '<td>'+response.date+'</td><td>'+response.time+'</td><td>'+response.status+'</td><td>'+
                '<a data-toggle="modal" data-target="#modal-app-edit" data-id="'+ response.id +'">'+
                '<i class="fa fa-pen"></i></a>'+
                '<a class="deletebtn" data-id="'+ response.id +'">'+
                '<i class="fa fa-trash-o"></i></a>'+
                '</td></tr></div>');  


                if(response.status === "finished"){
                    if( parseInt($('#ongoingLeft').text()) >= 1){
                        chartHeaders(parseInt($('#todayAppoint').text()),
                        parseInt($('#finish').text()) + 1,
                        parseInt($('#ongoingLeft').text()) - 1);
                    }
                } else if(response.status === "ongoing"){
                    if(parseInt($('#finish').text()) >= 1){
                        chartHeaders(parseInt($('#todayAppoint').text()),
                        parseInt($('#finish').text()) - 1,
                        parseInt($('#ongoingLeft').text()) + 1);
                    }
                }
            },
            error:function(response){
                console.log(response);
            },
        });
    });

// DELETE

    $("#tableAppoint").on('click',".deletebtn",function(e) {
        var id = $(this).data('id');
        console.log(id);
        e.preventDefault();
        bootbox.confirm({
            message: "Do you really want to delete this?",
            size:'small',
            buttons: {
                confirm: {
                    label: 'Yes',
                    className: 'btn-success'
                },
                cancel: {
                    label: 'No',
                    className: 'btn-danger'
                }
            },
            callback: function (result) {
                if(result){
                    $.ajax({
                        type: "DELETE",
                        url: "/appointments/"+ id,
                        headers: {'X-CSRF-TOKEN': $('meta[name="csrf-token"]').attr('content')},
                        success: function(response) {
                            $('#app_'+ id).remove();
                            $('#delToast').toast('show');
                            
                            if(response.status === "finished"){
                                chartHeaders(parseInt($('#todayAppoint').text()) - 1,
                                parseInt($('#finish').text()) - 1,
                                parseInt($('#ongoingLeft').text()));

                            } else if(response.status === "ongoing"){
                                chartHeaders(parseInt($('#todayAppoint').text()) - 1,
                                parseInt($('#finish').text()),
                                parseInt($('#ongoingLeft').text()) - 1);
                            }
                        },
                        error: function(error) {
                            console.log('error');
                        }
                    });
                }
            }
        });
    });

    function chartHeaders(appointments,finished,ongoing,client=parseInt($('#newClients').text())){
        $('#todayAppoint').html(appointments);
        
        var progress = finished/appointments * 100;
        var progress = isNaN(progress) ? 0 : progress;

        $('#ongoingLeft').html(ongoing);
        $('#ongoing').html(progress.toFixed(0) + "%");
        $('#ongoingProgress').css('width', progress.toFixed(0)+"%");

        $('#finish').html(finished);   
        $('#newClients').html(client);
    }
});