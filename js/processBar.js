$(document).ready(function(){
    
    $.ajax({
        url:"../php/read.php",
        type: "get",
        dataType: "json",
        success:function(data) {

            if (data[0] !== 0) {
                $('#truncate, #output').css('display', 'block');
            }
            if (data[0] == 0) {
                $('#truncate, #output').css('display', 'none');
            }
        }
    })
    
    
    var clear_timer
    
    $('#csv_form').on('submit', function(event){
        $('#message').html('')
        event.preventDefault()
        $.ajax({
            url: "../php/upload.php",
            type: "POST",
            data: new FormData(this),
            dataType:"json",
            contentType:false,
            cache:false,
            processData:false,
            beforeSend:function(){
                $('#import').attr('disabled','disabled');
                $('#import').val('Importing');
            },
            success:function(data) {
                if(data.success) {
                    $('#total_data').text(data.total_line);
                    start_import();
                    clear_timer = setInterval(get_import_data, 1000);
                    
                }
                if(data.error) {
                    $('#message').html('<div class="alert alert-danger">'+data.error+'</div>');
                    $('#import').attr('disabled',false);
                    $('#import').val('Import');
                }
            }
        })
    })

    $('#chart_output').on('submit', function(event){
        event.preventDefault()
        location.href = 'index.html'
    })
        
    $('#db_truncate').on('submit', function(event) {
        event.preventDefault()
        $.ajax({
            url: "../php/truncate.php",
            success:function() {
                $('#message').html('<div class="alert alert-success">Truncate Succes</div>')
                
                $('#truncate, #output').css('display', 'none');
                $('#message').html('')
            }
        })
    })

    function start_import() {
     $('#process').css('display', 'block');
     $.ajax({
      url:"../php/write.php",
      success:function(){
      }
     })
    }

    function get_import_data() {
     $.ajax({
      url:"../php/process.php",
      success:function(data) {

       var total_data = $('#total_data').text();
       var width = Math.round((data/total_data)*100);
       $('#process_data').text(data);
       $('.progress-bar').css('width', width + '%');

       if(width >= 100) {
        clearInterval(clear_timer);
        $('#process').css('display', 'none');
        $('#file').val('');
        $('#message').html('<div class="alert alert-success">Data Successfully Imported</div>');
        $('#import').attr('disabled',false);
        $('#import').val('Import');
        $('#truncate, #output').css('display', 'block');

       }
      }
     })
    }
  
})