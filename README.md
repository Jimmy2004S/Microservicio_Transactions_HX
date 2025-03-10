📘 API de Transacciones Bancarias

Este proyecto implementa una API de transacciones bancarias con arquitectura Hexagonal, desacoplando las capas de aplicación e infraestructura en la carpeta src. A pesar de esto, seguimos utilizando componentes clave de Laravel, como validación de solicitudes y controladores.

🚀 Arquitectura

El proyect está estructurado de la siguiente manera:

📂 app
    📂 Providers ( contenedor ser servicios para inyecion de dependencias )
📂 database
    📂 Migrations ( migraciones y definicion de la estructura de la BD )
📂 routes
    📂 api ( rutas para desplegar la api )
📂 src
    📂 Application (Casos de uso y lógica de negocio)
    📂 Domain (Entidades y modelos de dominio)
    📂 Infrastructure (Servicios externos, persistencia, etc.)
    📂 Interfaces (Controladores y Middleware)


✨ Funcionalidades Actuales

✅ Transferencia de dinero entre cuentas bancarias.
✅ Creación y consulta de cuentas bancarias.
✅ Middleware de autenticación basado en un servicio externo.
✅ Notificación por correo electrónico en cada transacción.


📡 Endpoints y Consumo

### 🔹 1. Enviar dinero

Endpoint: /transactions/send
metodo POST
Middleware: AuthMiddleware
headers: Authorization token

📌 Body (JSON):

´´´json
{
  "amount": 100,
  "to_account_number": "40000000000001"
}
´´´

📌 Respuesta:

{
  "id": 1,
  "status": "success",
  "type": "outcome",
  "amount": 100,
  "date": "2024-03-07",
  "from_account_id": 2,
  "to_account_id": 5
}

### 🔹 2. Crear una cuenta bancaria

Endpoint: /accountMétodo: POST

📌 Body (JSON):

{
  "user_id": 10,
  "placeholder": "John Doe"
}

📌 Respuesta:

{
  "data": {
    "id": 5,
    "balance": 1000000, // default para pruebas
    "number": "40000000000001",
    "placeholder": "John Doe",
    "due_date": "2026-12-31",
    "user_id": 10
  }
}

🔹 3. Consultar una cuenta

Endpoint: /account/{id}
Método: GET

📌 Ejemplo de respuesta:

{
  "data": {
    "id": 5,
    "balance": 500,
    "number": "87654321",
    "placeholder": "John Doe",
    "due_date": "2026-12-31",
    "user_id": 10
  }
}

🔑 Middleware de Autenticación

El middleware AuthMiddleware valida el token del usuario antes de procesar ciertas solicitudes.

📌 Flujo de autenticación:

El middleware obtiene el token del encabezado Authorization.

Consulta el servicio externo ApiAuthService para verificar la validez del token.

Si el token es válido, añade el usuario al request y permite continuar.

Si el token es inválido, responde con error 401 Unauthorized.

📌 Ejemplo de respuesta en caso de error:

{
  "message": "Token not provided"
}

📩 Notificaciones por Correo

Cada transacción genera dos correos electrónicos:

Notificación al usuario que envió dinero.

Notificación al correo jimmy.jimenez@unicolombo.edu.co informando la recepción de fondos.

📌 Ejemplo de datos enviados a ApiEmailService::send():

ApiEmailService::send($user_email, 'transaction', [
  'amount' => $amount,
  'type' => 'outcome'
]);

🛠️ Instalación y Uso

1️⃣ Clonar el repositorio

git clone https://github.com/tu_usuario/tu_repositorio.git
cd tu_repositorio

2️⃣ Instalar dependencias

composer install

3️⃣ Configurar variables de entorno
Copiar .env.example a .env y configurar las credenciales.

4️⃣ Ejecutar migraciones

php artisan migrate

5️⃣ Iniciar el servidor

php artisan serve

📄 Licencia

Este proyecto está bajo la licencia MIT. ¡Siéntete libre de usarlo y contribuir! 🎉
