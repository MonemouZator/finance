function all()
{

  $.ajax({
      type: "GET",
    url: "userData.php",
     success: function (response){
         response = JSON.parse(response);
           let html = "";
            if(response.length){
               $.each(response, (key, value)=>{
                 html += `
                 <tr>
                        <td>${value.Id}</td>
                        <td>${value.Nom}</td>
                        <td>${value.statut}</td>
                       <td>${value.username}</td>
                        <td>${value.email}</td>
                     </tr>
                     `
                 })
             }
             $('#liste').html(html)
         }
    });
}
$(document).ready(function(){
  all();
})
