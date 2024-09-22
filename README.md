Proyecto de Reserva de Vuelos
Descripción
Este proyecto es una aplicación web para la reserva de vuelos, desarrollada como parte de una práctica universitaria. Permite a los usuarios buscar vuelos, realizar reservas y gestionar sus reservas de manera sencilla y eficiente.

Funcionalidades
-Búsqueda de Vuelos
*Interfaz de Búsqueda: Los usuarios pueden ingresar su origen y destino para buscar vuelos disponibles.
*Resultados Dinámicos: La búsqueda devuelve una lista de vuelos que coinciden con los criterios especificados, mostrando detalles como origen, destino, fechas de ida y vuelta, y precios.
-Reservas de Vuelos
*Reserva de Vuelo: Los usuarios pueden reservar un vuelo directamente desde los resultados de búsqueda. Se verificará si el usuario ya tiene una reserva para ese vuelo.
*Cancelación de Reservas: Si un usuario decide no continuar con su reserva, puede cancelar la reserva existente de manera fácil y rápida.
-Gestión de Usuarios
*Inicio de Sesión: Los usuarios pueden iniciar sesión en su cuenta para acceder a sus reservas y gestionar su perfil.
*Registro: Los usuarios pueden crear su propio usuario para iniciar sesión.
*Perfil del Usuario: Al hacer clic en el nombre de usuario, se muestra un modal con información detallada sobre la cuenta del usuario, como el ID de usuario, nombre y correo electrónico.
-Base de Datos
*Integración con MySQL: El sistema utiliza una base de datos MySQL para almacenar información de vuelos, usuarios y reservas, asegurando la persistencia de los datos.
'Diseño Responsivo
*Interfaz Amigable: La aplicación está diseñada para ser responsiva, adaptándose a diferentes tamaños de pantalla, lo que mejora la experiencia del usuario en dispositivos móviles y de escritorio.
'Requisitos
*PHP 7.4 o superior
*MySQL
*Servidor web (Apache/Nginx)

Instalación
Clona este repositorio en tu máquina local:
git clone https://github.com/Langostin/airportt.git
Configura tu servidor web local (como XAMPP o WAMP) para apuntar al directorio del proyecto.

Importa la base de datos desde el archivo SQL proporcionado.

Asegúrate de tener PHP y MySQL instalados y configurados correctamente.
