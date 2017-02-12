document.addEventListener("DOMContentLoaded",function()
{
    function loadUserView()
    {
        $.ajax(
        {
            type: 'GET',
            url: '../../router.php/user/',
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
           tdName = document.createElement("td");
           tdSurname = document.createElement("td");
           tdCredits = document.createElement("td");
           tdAddress = document.createElement("td");
        
           tdId.className="id";
           tdName.className="name";
           tdSurname.className="surname";
           tdCredits.className="credits";
           tdAddress.className="address";
           
           tr.append(tdId);
           tr.append(tdName);
           tr.append(tdSurname);
           tr.append(tdCredits);
           tr.append(tdAddress);
           
           tdId.innerHTML = oUser.id;
           tdName.innerHTML = oUser.name;
           tdSurname.innerHTML = oUser.surname;
           tdCredits.innerHTML = oUser.credits;
           tdAddress.innerHTML = oUser.address_id;
           
           tr = $('table').append(tr);
        });
    }
});