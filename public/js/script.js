var controllerURL = '/app/Controller/indexController.php'

//Helpers
function addLine(rowId,user){
    line='<tr class =row'+rowId+'>'+
        '<td class=td'+rowId+'>'+user.id+'</td>'+
        '<td>'+user.name+'</td>'+
        '<td>'+user.email+'</td>'+
        '</tr>';
    return line;
}
function renderTable(array){

    var rowId = 0;
    var table = '<table><tr><th>Id</th><th>Nome</th><th>E-mail </th></tr>';
    
    array.forEach(user => {
        table += addLine(rowId,user);
        rowId++;
    });
    table += '</table>';
    $('.table').append(table);
}
function loadTable(){
    $.getJSON(controllerURL,{'call':'renderTable'},function(response){
        console.log(response);
        renderTable(response);
    });
}
function reloadTable(){
    $('.table').empty();
    loadTable();
}

$(document).ready(function(){
    

    loadTable();
    
    //save on submit
    $('.submit').click(function(event){
        event.preventDefault();
        var name = $('.name').val();
        var email = $('.email').val();
        if(name=='' && email == ''){
            alert("Preencha os campos");
        }else if(name!='' && email !=''){
            $.post(controllerURL,{
                'call': 'save',
                'name' : name,
                'email':email
            });
            name = '';
            email = '';
            reloadTable();
        }
    });

    //Delete on click
    //@Deprecated - delegate
    $(document).delegate('tr','click',function(){
        //$(this).hide();
        var rowId = $(this).attr('class'); 
        var tdId = 'td'+rowId.slice(-1);
        tdId = $('.'+tdId).html();
        var confirmString = "Tem certeza que deseja deletar? ID="+tdId;
        
        if(confirm(confirmString)){
            $(this).hide();
            $.get(controllerURL,{
                'call':'delete',
                'id': tdId
            });
            reloadTable();
        }
    });
});

