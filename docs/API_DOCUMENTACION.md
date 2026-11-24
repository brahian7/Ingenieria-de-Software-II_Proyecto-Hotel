# API REST - Sistema de Gestión Hotelera

## Hotel Central La Italia

---

# Descripción

La API REST del Sistema de Gestión Hotelera permite administrar la información del hotel mediante servicios web desarrollados en Laravel 12.

La autenticación se realiza mediante Laravel Sanctum utilizando Bearer Tokens.

La API permite gestionar:

- Usuarios
- Habitaciones
- Huéspedes
- Reservas

Todas las respuestas son entregadas en formato JSON.

---

# Tecnologías utilizadas

- Laravel 12
- Laravel Sanctum
- PHP 8.5
- MySQL
- Bootstrap 5
- Eloquent ORM

---

# URL Base

En ambiente local:

```text
http://localhost/api
```

---

# Autenticación

La API utiliza autenticación mediante Bearer Token.

Para acceder a los endpoints protegidos primero debe iniciarse sesión utilizando el endpoint Login.

El token obtenido deberá enviarse en todas las peticiones mediante el encabezado:

```http
Authorization: Bearer TU_TOKEN
```

---

# Flujo de autenticación

```text
Login
      │
      ▼
Obtención del Token

      │
      ▼
Consumir Endpoints

      │
      ▼
Logout
```

---

# Formato de respuestas

Todas las respuestas utilizan formato JSON.

Ejemplo:

```json
{
    "success": true,
    "message": "Operación realizada correctamente.",
    "data": {}
}
```

---

# Códigos HTTP utilizados

| Código | Descripción |
|---------|-------------|
|200|Solicitud procesada correctamente|
|201|Recurso creado correctamente|
|401|No autenticado|
|403|No autorizado|
|404|Recurso no encontrado|
|409|Conflicto de información|
|422|Error de validación|
|500|Error interno del servidor|

---

# Endpoints

# 1. Autenticación

---

## Login

### Endpoint

```http
POST /api/login
```

---

### Descripción

Permite autenticar un usuario en el sistema y obtener un Bearer Token para consumir los servicios protegidos.

---

### Headers

|Nombre|Valor|
|------|-----|
|Accept|application/json|
|Content-Type|application/json|

---

### Body

```json
{
    "email": "admin@hotel.com",
    "password": "123456"
}
```

---

### Respuesta Exitosa

```json
{
    "success": true,
    "message": "Inicio de sesión exitoso.",
    "token": "1|xxxxxxxxxxxxxxxxxxxxxxxxxxxxxxxx",
    "token_type": "Bearer",
    "user": {
        "id": 1,
        "nombre": "Administrador",
        "email": "admin@hotel.com",
        "rol": "Administrador"
    }
}
```

---

### Posibles respuestas

|Código|Descripción|
|------|-----------|
|200|Inicio de sesión exitoso|
|401|Credenciales incorrectas|
|422|Datos inválidos|

---

## Logout

### Endpoint

```http
POST /api/logout
```

---

### Descripción

Finaliza la sesión del usuario eliminando el token utilizado en la petición.

---

### Headers

|Nombre|Valor|
|------|-----|
|Accept|application/json|
|Authorization|Bearer TU_TOKEN|

---

### Body

No requiere.

---

### Respuesta Exitosa

```json
{
    "success": true,
    "message": "Sesión cerrada correctamente."
}
```

---

### Posibles respuestas

|Código|Descripción|
|------|-----------|
|200|Logout realizado correctamente|
|401|Usuario no autenticado|

---

> **Nota:** Después del Logout el token deja de ser válido. Para acceder nuevamente a la API deberá iniciar sesión otra vez.

---

# 2. Habitaciones

La API permite administrar completamente las habitaciones del hotel.

## Obtener todas las habitaciones

### Endpoint

```http
GET /api/habitaciones
```

### Headers

| Nombre | Valor |
|---------|-------|
| Authorization | Bearer TU_TOKEN |

### Respuesta Exitosa

```json
{
    "success": true,
    "message": "Listado de habitaciones obtenido correctamente.",
    "data": [
        {
            "id": 1,
            "numero": "101",
            "tipo": "Sencilla",
            "capacidad": 2,
            "precio_noche": "120000.00",
            "estado": "Disponible"
        }
    ]
}
```

---

## Obtener una habitación

### Endpoint

```http
GET /api/habitaciones/{id}
```

Ejemplo:

```http
GET /api/habitaciones/1
```

---

## Crear habitación

### Endpoint

```http
POST /api/habitaciones
```

### Body

```json
{
    "numero": "205",
    "tipo": "Suite",
    "capacidad": 4,
    "precio_noche": 250000,
    "estado": "Disponible",
    "descripcion": "Suite con balcón."
}
```

---

## Actualizar habitación

### Endpoint

```http
PUT /api/habitaciones/{id}
```

---

## Eliminar habitación

### Endpoint

```http
DELETE /api/habitaciones/{id}
```

---

# 3. Huéspedes

La API permite administrar los huéspedes registrados.

---

## Obtener todos los huéspedes

### Endpoint

```http
GET /api/huespedes
```

---

## Obtener un huésped

### Endpoint

```http
GET /api/huespedes/{id}
```

---

## Crear huésped

### Endpoint

```http
POST /api/huespedes
```

### Body

```json
{
    "tipo_documento": "CC",
    "numero_documento": "123456789",
    "nombres": "Carlos",
    "apellidos": "Ramírez",
    "telefono": "3001234567",
    "correo": "carlos@email.com",
    "direccion": "Calle 10 #15-20",
    "ciudad": "Cartago",
    "fecha_registro": "2026-07-17"
}
```

---

## Actualizar huésped

### Endpoint

```http
PUT /api/huespedes/{id}
```

---

## Eliminar huésped

### Endpoint

```http
DELETE /api/huespedes/{id}
```

---

# 4. Reservas

La API permite administrar las reservas del hotel.

---

## Obtener todas las reservas

### Endpoint

```http
GET /api/reservas
```

---

## Obtener una reserva

### Endpoint

```http
GET /api/reservas/{id}
```

---

## Crear reserva

### Endpoint

```http
POST /api/reservas
```

### Body

```json
{
    "huesped_id": 1,
    "habitacion_id": 2,
    "fecha_reserva": "2026-07-17",
    "fecha_ingreso": "2026-07-20",
    "fecha_salida": "2026-07-22",
    "cantidad_personas": 2,
    "estado": "Pendiente",
    "observaciones": "Reserva creada desde la API."
}
```

### Respuesta Exitosa

```json
{
    "success": true,
    "message": "Reserva registrada correctamente.",
    "data": {
        "codigo_reserva": "RES-000001"
    }
}
```

---

## Actualizar reserva

### Endpoint

```http
PUT /api/reservas/{id}
```

---

## Eliminar reserva

### Endpoint

```http
DELETE /api/reservas/{id}
```

---

# Ejemplo de uso con Postman

1. Iniciar sesión utilizando el endpoint **POST /api/login**.
2. Copiar el **Bearer Token** recibido.
3. En Postman abrir la pestaña **Authorization**.
4. Seleccionar el tipo **Bearer Token**.
5. Pegar el token obtenido.
6. Consumir cualquiera de los endpoints protegidos.

---

# Observaciones

- Todos los endpoints, excepto **Login**, requieren autenticación mediante Laravel Sanctum.
- Todas las respuestas son entregadas en formato JSON.
- La API valida automáticamente los datos enviados.
- Las reservas verifican la disponibilidad de la habitación antes de ser registradas.
- Al crear una reserva se calcula automáticamente el código de reserva, la cantidad de noches y el valor total.

---

# Autor

**Brayan Caceres_Camilo Martinez**

Proyecto de Grado

Tecnología en Gestion de Sistemas de Información

Cotecnova

2026