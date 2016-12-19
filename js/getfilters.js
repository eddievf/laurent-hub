$(document).ready(function(){
    
    $('#buttonOpen').on('click', function(e){
        //preventing href from being followed
        e.preventDefault();

        //load php file
        $('div.showFilter').load('php/filterOpen.php')
    });

    $('#buttonStopped').on('click', function(e){
        e.preventDefault();
        $('div.showFilter').load('php/filterStopped.php')
    });

    $('#buttonDone').on('click', function(e){
        e.preventDefault();
        $('div.showFilter').load('php/filterDone.php')
    });

});