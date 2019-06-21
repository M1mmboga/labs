    $(document).ready(function() {
        
        $('#api-key-btn').click((event) => {
              //user confirm they want the api key
    var confirm_key = confirm("Do you want to generate the api key?");
    if (confirm_key)
    {
        $.ajax({
            url:"apikey.php",
            type:"post",
            success: function (data) {

                if (data['success'] == 1) 
                {
                            //all was fine, set key in the text area

                    $('#api_key').val(data['message']);
                    
                }else
                {
                    alert("Something is wrong, try again.");
                }
            }
        });
    
    } else 
    {
        return false;
    }
       
    });
  

});
