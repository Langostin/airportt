// Obtener el formulario y asignar el evento de búsqueda
document.getElementById('searchForm')?.addEventListener('submit', function (event) {
    event.preventDefault();

    var formData = new FormData(event.target);

    var xhr = new XMLHttpRequest();
    xhr.open('POST', 'search_flights.php', true);
    xhr.onload = function () {
        if (xhr.status === 200) {
            try {
                var response = JSON.parse(xhr.responseText);
                if (response.success) {
                    // Llenar el modal con los resultados de los vuelos
                    var flights = response.flights;
                    var modalContent = "<table><tr><th>ID</th><th>Origen</th><th>Destino</th><th>Precio</th><th>Fecha de ida</th><th>Fecha de vuelta</th><th>Acción</th></tr>";

                    flights.forEach(flight => {
                        var actionButton = flight.reserved
                            ? `<button class="btn-rsv" onclick="cancelFlight(${flight.flight_id})">Cancelar</button>`
                            : `<button class="btn-rsv" onclick="reserveFlight(${flight.flight_id})">Reservar</button>`;

                        modalContent += `<tr>
                    <td>${flight.flight_id}</td>
                    <td>${flight.origin}</td>
                    <td>${flight.destination}</td>
                    <td>${flight.departure_date}</td>
                    <td>${flight.return_date}</td>
                    <td>${flight.price}</td>
                    <td>${actionButton}</td>
                </tr>`;
                    });

                    modalContent += "</table>";
                    document.getElementById('modalContent').innerHTML = modalContent;
                    document.getElementById('flightModal').style.display = "block";
                } else {
                    alert(response.message);
                }
            } catch (e) {
                alert('Error al procesar los resultados.');
            }
        } else {
            alert('Error en la solicitud.');
        }
    };
    xhr.send(formData);
});

// Función para reservar el vuelo
function reserveFlight(flightId) {
    var formData = new FormData();
    formData.append('action', 'reserve_flight');
    formData.append('flight_id', flightId);

    var xhr = new XMLHttpRequest();
    xhr.open('POST', 'reserve_flight.php', true);
    xhr.onload = function () {
        if (xhr.status === 200) {
            try {
                var response = JSON.parse(xhr.responseText);
                alert(response.message);
                location.reload(); // Recargar la página para actualizar los botones
            } catch (e) {
                alert('Error al procesar la reserva.');
            }
        } else {
            alert('Error en la solicitud de reserva.');
        }
    };
    xhr.send(formData);
}

// Función para cancelar el vuelo
function cancelFlight(flightId) {
    var formData = new FormData();
    formData.append('action', 'cancel_flight');
    formData.append('flight_id', flightId);

    var xhr = new XMLHttpRequest();
    xhr.open('POST', 'cancel_flight.php', true);
    xhr.onload = function () {
        if (xhr.status === 200) {
            try {
                var response = JSON.parse(xhr.responseText);
                alert(response.message);
                location.reload(); // Recargar la página para actualizar los botones
            } catch (e) {
                alert('Error al procesar la cancelación.');
            }
        } else {
            alert('Error en la solicitud de cancelación.');
        }
    };
    xhr.send(formData);
}
document.getElementById('closeModal')?.addEventListener('click', function () {
    document.getElementById('flightModal').style.display = "none";
});