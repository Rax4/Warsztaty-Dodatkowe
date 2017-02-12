document.addEventListener("DOMContentLoaded",function()
{
    function loadUserView()
    {
        $.ajax(
        {
            type: 'GET',
            url: '../../router.php/address/',
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
           tdCity = document.createElement("td");
           tdCode = document.createElement("td");
           tdStreet = document.createElement("td");
           tdNumber = document.createElement("td");
        
           tdId.className="id";
           tdCity.className="city";
           tdCode.className="code";
           tdStreet.className="street";
           tdNumber.className="number";
           
           tr.append(tdId);
           tr.append(tdCity);
           tr.append(tdCode);
           tr.append(tdStreet);
           tr.append(tdNumber);
           
           tdId.innerHTML = oUser.id;
           tdCity.innerHTML = oUser.city;
           tdCode.innerHTML = oUser.code;
           tdStreet.innerHTML = oUser.street;
           tdNumber.innerHTML = oUser.number;
           
           tr = $('table').append(tr);
        });
    }
});