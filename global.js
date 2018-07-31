$('input#next_button').on('click', function() {
    $id = document.getElementById('questionNum').value;
    $id++;
    $('#questionNum').val($id);
    
    // returns formated answer options for question ID in #questionID
    $.post({
        url: 'answers.php',
        type: 'POST',
        data: {questionNum:$id},
        success: function(data){
            if (!$.trim(data)){
                alert(1); // next is empty
            } 
            else {
                $('#options').empty();
                var Data = $.parseJSON(data);
                $('#options').append(Data.author);
                if (String(Data.isLast) === "true")
                {   
                    $('#next_button').val("Finišs");
                    document.getElementById("next_buttom").onclick = Data.redirect;
                    // un jāuzstāda arī redirect value
                }                
            }
        },
        error: function(request, statuss, error)
        {
            alert("error in global.js");
        }
      });
});
