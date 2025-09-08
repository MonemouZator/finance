
function getUser(){
    $.ajax({
        type: "GET",
        url: "UserData.php",
        success: function (response){
            response = JSON.parse(response);
            var html = "";
            if(response.length){
                $.each(response, (key, value)=>{
                    html += `
                    <tr>
                    <td>${value.Id}</td>
                   
                    <td>${value.Nom}</td>
                    <td>${value.Prenom}</td>
                    <td>${value.Email}</td>
                    <td>${value.Username}</td>
                 <td>${value.Statut}</td>
                 <td>${value.datecompte}</td>
                 <td>
                  <button type="button" class="btn btn-success">Update</button>
                  <button type="button" class="btn btn-success">Edit</button>

                 <button type="button" class="btn btn-outline-danger">Supprimer</button>

                 
                </td>
                 <tr>
                 
                   
              

                 
                       
                        
                       
                    </tr>
                    `
                })
            }
            $('#liste').html(html)
        }
    })
   
     
}


function postUser(event){
    event.preventDefault()
    let UserData = {
        Username : $('#username').val(),
        
        email : $('#email').val()
    }
    console.log(UserData)
    let data = axios.post('UserData.php', UserData)
    .then((res)=>{
        console.log(res)
    })
    .catch(err => console.log(err))
}
$(document).ready(function(){
    getUser();
})
$('#form').submit(()=>{
    postUser(event)
})