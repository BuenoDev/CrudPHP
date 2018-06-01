$(function(){
    $('.submit').click(function(event){
        event.preventDefault();
        var name = $('.name').val();
        var email = $('.email').val();
        $.post('./../../app/Controller/indexController.php',{
            'name' : name,
            'email':email
        });
    });

    $('tr').click(function(){
        //$(this).hide();
        var rowId = $(this).attr('class');
        var id = rowId.slice(-1);
        var tdId = 'td'+id;
        tdId = $('.'+tdId).html();
        
        console.log($('.'+tdId).html());
        
        
        var confirmString = "Tem certeza que deseja deletar? ID="+tdId;
        
        if(confirm(confirmString)){
            $(this).hide();
            $.get('/app/Controller/deleteController.php',{
                'id': tdId
            });
        }
    });
});