function handleFormSubmit(event, url) {
    event.preventDefault();
    var formElement = event.target;
    var formData = new FormData(formElement);

    var xhr = new XMLHttpRequest();
    xhr.open('POST', url, true);
    xhr.onload = function () {
        if (xhr.status === 200) {
            try {
                var response = JSON.parse(xhr.responseText);
                alert(response.message);
                if (response.success){
                    if (url != "auth.php") {
                        location.reload();
                    }
                    else 
                    {
                        window.location.href = 'inicio.php';
                    }
                }
            } catch (e) {
                alert('Se produjo un error en la solicitud.');
            }
        } else {
            alert('Se produjo un error en la solicitud.');
        }
    };
    xhr.send(formData);
}

// Asignar eventos de submit a cada formulario
document.getElementById('loginForm')?.addEventListener('submit', function (event) {
    handleFormSubmit(event, 'auth.php');
});


document.getElementById('registerForm')?.addEventListener('submit', function (event) {
    handleFormSubmit(event, 'register.php');
});

document.getElementById('reservationForm')?.addEventListener('submit', function (event) {
    handleFormSubmit(event, 'manage_reservations');
});

document.getElementById('reservForm')?.addEventListener('submit', function (event) {
    handleFormSubmit(event, 'reserve_flight');
});

// Mostrar/Ocultar Model
var modal = document.getElementById("userModal");

var userLink = document.getElementById("userLink");

var closeBtn = document.getElementsByClassName("close")[0];

userLink.onclick = function(event) {
    event.preventDefault();
    modal.style.display = "block";
}

closeBtn.onclick = function() {
    modal.style.display = "none";
}

window.onclick = function(event) {
    if (event.target == modal) {
        modal.style.display = "none";
    }
}


