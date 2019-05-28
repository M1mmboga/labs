    $(document).ready(function() {
        $('#api-key-btn').click(function(event){
              //user confirm they want the api key
    var confirm_key = confirm("Do you want to generate the api key?");
    if (!confirm_key)
    {
        return;   
    }
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
    });
  

});

// $(document).ready(() => {
//     $('#api-key-btn').click((() => {
//         const confirmation = confirm('Confirm that you are about to generate a new APi key')
//         if (!confirmation) return

//         fetch('private_page.php', {method: 'POST'})
//             .then(r => r.json())
//             .then(d => {
//                 if (d['success'] === 1) {
//                     $('#api-key').val(d['message'])
//                 } else {
//                     alert('Something went wrong, please try again')
//                 }
//             })
//             .catch(err => {
//                 console.error(err)
//                 alert('Something went wrong, please try again')
//             })
//     }))
// })