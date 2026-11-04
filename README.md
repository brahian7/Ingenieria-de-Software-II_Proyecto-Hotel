# 🏨 Sistema de Gestión Hotelera - Proyecto de Software II

Sistema de información desarrollado para la gestión integral de reservas, habitaciones, usuarios y control operativo de un hotel.

---

## 👥 Integrantes y Roles

> **Nota:** Los roles orientan la responsabilidad principal de cada estudiante, pero **todos los integrantes conocen y responden por la totalidad del código** contenido en este repositorio.

| Integrante | Rol | Responsabilidad Principal |
| :--- | :--- | :--- |
| **Juan Manuel Orozco** | **Líder Técnico** | Coordina el alcance, la arquitectura general del software y la integración de los cambios en el repositorio. |
| **Jan Esteban Suarez** | **Responsable de Pruebas** | Diseña los casos de prueba (unitarios/integración) y coordina su automatización para verificar la estabilidad del sistema. |
| **Brayan Camilo Caceres** | **Responsable de Calidad y Documentación** | Revisa la calidad del código, registra defectos, propone acciones de mantenimiento y mantiene la documentación del `README.md`. |


---

## 📌 Requisitos del Sistema

### ⚙️ Requisitos Funcionales (RF)
* **RF01 - Gestión de Usuarios y Autenticación:** Inicio de sesión, cierre de sesión y control de accesos según roles (Administrador, Recepcionista, Cliente).
* **RF02 - Gestión de Habitaciones:** Permite registrar, editar, listar, desactivar y consultar el estado de las habitaciones (Disponible, Ocupada, Mantenimiento).
* **RF03 - Control de Clientes / Huéspedes:** Registro de datos personales de los huéspedes e historial de hospedajes.
* **RF04 - Módulo de Reservas:** Permite crear, modificar y cancelar reservas especificando fecha de entrada, fecha de salida y tipo de habitación.
* **RF05 - Procesamiento de Check-In / Check-Out:** Control de ingreso y salida del huésped con actualización automática del estado de la habitación.
* **RF06 - Reportes y Panel de Control:** Visualización básica del porcentaje de ocupación e historial de reservas del hotel.

### 🛡️ Requisitos No Funcionales (RNF)
* **RNF01 - Usabilidad:** Interfaz intuitiva y adaptable, fácil de operar por el personal administrativo con mínima capacitación.
* **RNF02 - Rendimiento:** Las consultas a la base de datos y respuesta de la interfaz no superan los 2 segundos bajo carga normal.
* **RNF03 - Seguridad:** Contraseñas encriptadas en la base de datos y validación de sesiones para prevenir acceso no autorizado a rutas protegidas.
* **RNF04 - Mantenerabilidad:** Estructura modular del código para facilitar la corrección de errores, refactorización y adición de nuevos módulos.
* **RNF05 - Disponibilidad:** Diseñado para funcionar de manera continua en entornos locales de servidor web (Apache / Nginx / PHP / Node.js).

---

## 🚀 Guía de Ejecución e Instalación

Sigue estos pasos para desplegar y probar el proyecto en tu entorno local:

### 1. Requisitos Previos
Asegúrate de contar con las siguientes herramientas instaladas:
* Servidor local (XAMPP, Laragon, WAMP o tu entorno preferido con PHP / Node.js / Python según aplique).
* Base de datos MySQL / MariaDB / PostgreSQL.
* Git.

https://trello.com/b/tb5hQgQ5/proyecto-final-ing-software