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
                var Data = $.parseJSON(data);
                $('#options').html(Data.author);
                $('#title').html(Data.title);
                $('#question').html(Data.text);
                if (String(Data.noMore) === "true")
                {   
                    if (String(Data.finish) === "true")
                    {
                        window.location = Data.redirect;
                    }
                    $('#next_button').val("Finišs");
                    // alert(Data.noMore);
                    // window.location = Data.redirect;
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
