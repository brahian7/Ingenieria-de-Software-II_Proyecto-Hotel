# Manual de Instalación

# Sistema de Gestión Hotelera - Hotel Central La Italia

---

# 1. Introducción

Este documento describe el procedimiento para instalar y ejecutar el Sistema de Gestión Hotelera desarrollado en Laravel 12.

El sistema permite la administración de habitaciones, huéspedes, reservas, usuarios y una API REST protegida mediante Laravel Sanctum.

---

# 2. Requisitos del sistema

Antes de instalar el proyecto, asegúrese de contar con los siguientes requisitos:

## Software

- PHP 8.5 o superior
- Composer
- Node.js
- NPM
- Docker Desktop
- Laravel Sail
- Git

## Base de datos

- MySQL (contenedor Docker mediante Laravel Sail)

---

# 3. Clonar el proyecto

Abrir una terminal y ejecutar:

```bash
git clone <https://github.com/brahian7/ProyectoHotel>
```

Ingresar al proyecto:

```bash
cd proyectohotel
```

---

# 4. Instalar dependencias de PHP

```bash
composer install
```

---

# 5. Instalar dependencias de JavaScript

```bash
npm install
```

---

# 6. Configurar el archivo de entorno

Copiar el archivo de ejemplo:

```bash
cp .env.example .env
```

Generar la clave de la aplicación:

```bash
php artisan key:generate
```

> Si utiliza Laravel Sail, ejecute:

```bash
./vendor/bin/sail artisan key:generate
```

---

# 7. Levantar los contenedores

Iniciar Docker Desktop.

Luego ejecutar:

```bash
./vendor/bin/sail up -d
```

Verificar que los contenedores se encuentren en ejecución:

```bash
docker ps
```

---

# 8. Ejecutar las migraciones

Crear todas las tablas de la base de datos:

```bash
./vendor/bin/sail artisan migrate
```

---

# 9. Ejecutar los seeders

Cargar la información inicial del sistema:

```bash
./vendor/bin/sail artisan db:seed
```

Este proceso crea los usuarios iniciales y demás datos necesarios para el funcionamiento del sistema.

---

# 10. Compilar los recursos

Para desarrollo:

```bash
npm run dev
```

Para producción:

```bash
npm run build
```

---

# 11. Acceder al sistema

Abrir el navegador e ingresar a:

```
http://localhost
```

---

# 12. Usuarios iniciales

## Administrador

Correo:

```
admin@hotel.com
```

Contraseña:

```
(123456)
```

---

## Recepcionista

Correo:

```
recepcion@hotel.com
```

Contraseña:

```
(123456)
```

> Si las contraseñas fueron modificadas posteriormente, utilizar las credenciales actualizadas.

---

# 13. Funcionalidades disponibles

Una vez instalado el sistema será posible:

- Iniciar sesión.
- Administrar habitaciones.
- Registrar huéspedes.
- Gestionar reservas.
- Consultar el dashboard.
- Consumir la API REST mediante Laravel Sanctum.

---

# 14. Solución de problemas

## Error de permisos

Ejecutar:

```bash
chmod -R 775 storage bootstrap/cache
```

---

## Limpiar caché

```bash
./vendor/bin/sail artisan optimize:clear
```

---

## Reiniciar contenedores

```bash
./vendor/bin/sail down
```

```bash
./vendor/bin/sail up -d
```

---

# 15. Tecnologías utilizadas

- Laravel 12
- PHP 8.5
- MySQL
- Laravel Sail
- Docker
- Bootstrap 5
- Laravel Sanctum
- Eloquent ORM

---

# Autor

**Brayan Caceres_Camilo Martinez**

Proyecto de Grado

2026