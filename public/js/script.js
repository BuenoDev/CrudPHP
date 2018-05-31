$(function(){
    $('.submit').click(function(event){
        //event.preventDefault();
        var name = $('.name').val();
        var email = $('.email').val();
        $.post('./../../app/Controller/indexController.php',{
            'name' : name,
            'email':email
        });
    });
});