document.addEventListener("DOMContentLoaded",function()
{
    function loadUserView()
    {
        $.ajax(
        {
            type: 'GET',
            url: '../../router.php/package/',
                    contentType: 'application/json',
                    dataType: 'json',
                    success: function (response) 
                    {
                        addContentUser(response);                     
                    },
                    error: function (xhr, status, error) 
                    {
                        alert("Wystąpił błąd");
                    }
        })
    }
    loadUserView();
    
    function addContentUser(responseFromAjax)
    {
        $.each(responseFromAjax, function(key, oUser)
        {
           tr = document.createElement("tr");
           tdId = document.createElement("td");
           tdUserId = document.createElement("td");
           tdSize = document.createElement("td");
        
           tdId.className="id";
           tdUserId.className="user_id";
           tdSize.className="size";
           
           tr.append(tdId);
           tr.append(tdUserId);
           tr.append(tdSize);
           
           tdId.innerHTML = oUser.id;
           tdUserId.innerHTML = oUser.user_Id;
           tdSize.innerHTML = oUser.size;
           
           tr = $('table').append(tr);
        });
    }
});