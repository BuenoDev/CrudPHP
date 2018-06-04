var controllerURL = '/app/Controller/indexController.php'

//Helpers
function addLine(rowId,user){
    line='<tr class =row'+rowId+'>'+
        '<td class=td'+rowId+'>'+user.id+'</td>'+
        '<td class=tdName>'+user.name+'</td>'+
        '<td class=tdEmail>'+user.email+'</td>'+
        '<td><button class="btn btn-danger"><i class="far fa-trash-alt"></i></button></td>'+
        '<td><button class="btn btn-warning"><i class="fas fa-sync"></i></button></td>'+
        '</tr>';
    return line;
}
function renderTable(array){
    var rowId = 0;
    var table = '<thead><tr><th>Id</th><th>Nome</th><th>E-mail </th><th>Delete</th><th>Update</th></tr><thead><tbody>';
    
    array.forEach(user => {
        table += addLine(rowId,user);
        rowId++;
    });
    table += '</tbody>';
    $('table').append(table);
}
function loadTable(){
    $.getJSON(controllerURL,{'call':'renderTable'},function(response){
        console.log(response);
        renderTable(response);
    });
}
function reloadTable(){
    $('table').empty();
    loadTable();
}
function inputValidation(name,email){
    if( name.length<5
    || email.length<5
    ){
        alertify.alert("Preencha os campos corretamente, nenhum dos campos podem ter menos de 5 caracteres");
        return false;
    }
    else return true;
}

//Starting JQuery
$(document).ready(function(){
    // Carrega componentes ao iniciar a página
    loadTable();
    $('#updateForm').hide();

    //save on submit
    $('#btnSubmit').click(function(event){
        event.preventDefault();
        var name = $('#inputNome').val();
        var email = $('#inputEmail').val();
        console.log(name,email);
        
        if(inputValidation(name,email)){
            $.post(controllerURL,{
                'call': 'save',
                'name' : name,
                'email':email
            });
            $('#inputNome').val(null);
            $('#inputEmail').val(null);
            reloadTable();
        } 
    });

    //Delete on btn click
    $('table').on("click",'.btn-danger',function(){
        console.log('btn danger clicked');
        
        var rowId = $(this).closest('tr').attr('class');
        var tdId = 'td'+rowId.slice(-1);
        tdId = $('.'+tdId).html();
        var confirmString = "Tem certeza que deseja deletar? ID="+tdId;
        
        alertify.confirm(confirmString,function(){
            //$(this).hide();
            $.get(controllerURL,{
                'call':'delete',
                'id': tdId
            });
            reloadTable();
        });
    });

    //Update
    $('table').on("click",'.btn-warning',function(){
        console.log('btnWarning click');
        $('#updateForm').show();

        var rowId = $(this).closest('tr').attr('class');
        var tdId = 'td'+rowId.slice(-1);
        tdId = $('.'+tdId).html();

        
        $('#updateForm').on('click','#btnUpdate',function(event){
            event.preventDefault();
            var name = $('#updateNome').val();
            var email = $('#updateEmail').val();
            console.log(name,email,tdId);
            
            if(inputValidation(name,email)){
                $.post(controllerURL,{
                    'call':'update',
                    'id':tdId,
                    'name':name,
                    'email':email
                }).done(function(){
                    console.log("ok");
                    reloadTable();
                    $('#inputNome').val(null);
                    $('#inputEmail').val(null);
                    $('#updateForm').hide();
                }).fail(function(){
                    alertify.alert("Nao foi possivel atualizar!");
                });
            }else console.log("Validation error!");     
        });
    });
    
    //Cancela update
    $('#btnCancel').click(function(){
        $('#inputNome').val(null);
        $('#inputEmail').val(null);
        $('#updateForm').hide();
    });

    //Plugin bonitinho
    $('table').pointPoint();
});

