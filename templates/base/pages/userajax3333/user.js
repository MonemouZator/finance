
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
                    <td>${value.email}</td>
                        <td>${value.username}</td>
                        <td>${value.nom}</td>
                        <td>${value.prenom}</td>
                        <td>${value.statut}</td>                   
                        <td>
                        <a href="" class="btn btn-primary" type="submit">
                  <i class="fas fa-search icon"></i>
                </a>
                <a href="" class="btn btn-danger" type="submit">
                  <i class="fas fa-trash"></i>
                </a>
                
                <a href="" class="btn btn-info" type="submit">
                  <i class="fas fa-plus icon"></i>
                </a>
                
                      </td>                 
                        
                       
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