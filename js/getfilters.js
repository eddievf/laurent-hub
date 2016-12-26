$(document).ready(function(){

    $('#OrdersAll').click(function(){
        $('#selectchecks input[type="checkbox"]').prop('checked', this.checked)
    });
    
    $('#buttonOpen').on('click', function(e){
        //preventing href from being followed
        e.preventDefault();

        //load php file
        $('#showFilter').load('php/filterOpen.php')
        $('body').animate({ scrollTop: 0 }, 360);
    });

    $('#buttonStopped').on('click', function(e){
        e.preventDefault();
        $('#showFilter').load('php/filterStopped.php')
        $('body').animate({ scrollTop: 0 }, 360);
    });

    $('#buttonDone').on('click', function(e){
        e.preventDefault();
        $('#showFilter').load('php/filterDone.php')
        $('body').animate({ scrollTop: 0 }, 360);
    });

    $('#WorkOrderFilter').submit(function(e){
        e.preventDefault();
        $.ajax({
            url: 'php/filterWorkOrder.php',
            type: 'POST',
            dataType: 'HTML',
            data: $('#WorkOrderFilter').serialize(),

            success: function(response, textStatus, jqXHR){
                $('#showFilter').html(response);
            },
            error: function(jqXHR, textStatus, errorThrown){
                console.log('error(s):'+textStatus, errorThrown);
            }

        });
        $('#modalWork').modal('toggle');
        $('body').animate({ scrollTop: 0 }, 360);
    });

    $('#TemmieOrderFilter').submit(function(e){
        e.preventDefault();
        $.ajax({
            url: 'php/filterTemmieOrder.php',
            type: 'POST',
            dataType: 'HTML',
            data: $('#TemmieOrderFilter').serialize(),

            success: function(response, textStatus, jqXHR){
                $('#showFilter').html(response);
            },
            error: function(jqXHR, textStatus, errorThrown){
                console.log('error(s):'+textStatus, errorThrown);
            }

        });
        $('#modalMuns').modal('toggle');
        $('body').animate({ scrollTop: 0 }, 360);
    });

    $('#ClientFilter').submit(function(e){
        e.preventDefault();
        $.ajax({
            url: 'php/filterClientName.php',
            type: 'POST',
            dataType: 'HTML',
            data: $('#ClientFilter').serialize(),

            success: function(response, textStatus, jqXHR){
                $('#showFilter').html(response);
            },
            error: function(jqXHR, textStatus, errorThrown){
                console.log('error(s):'+textStatus, errorThrown);
            }

        });
        $('#modalClient').modal('toggle');
        $('body').animate({ scrollTop: 0 }, 360);
    });

    $('#filterBuild').submit(function(e){
        e.preventDefault();
        $.ajax({
            url: 'php/filtersend.php',
            type: 'POST',
            dataType: 'HTML',
            data: $('#filterBuild').serialize(),

            success: function(response, textStatus, jqXHR){
                $('#showFilter').html(response);
            },
            error: function(jqXHR, textStatus, errorThrown){
                console.log('error(s):'+textStatus, errorThrown);
            }

        });
        $('body').animate({ scrollTop: 0 }, 500);
    });


});