# 🏨 Sistema de Gestión Hotelera - Proyecto de Software II

Sistema de información desarrollado para la automatización, administración y control integral de reservas, habitaciones, usuarios y operaciones de un hotel.

---

## 👥 Integrantes y Roles

> **Nota:** Los roles orientan la responsabilidad principal de cada estudiante, pero **todos los integrantes conocen y responden por la totalidad del código** contenido en este repositorio.

| Integrante | Rol | Responsabilidad Principal |
| :--- | :--- | :--- |
| **Juan Manuel Orozco** | **Líder Técnico** | Coordina el alcance, la arquitectura general del software y la integración de los cambios en el repositorio. |
| **Brayan Camilo Caceres** | **Responsable de Pruebas** | Diseña los casos de prueba (unitarios/integración) y coordina su automatización para verificar la estabilidad del sistema. |
| **Jan Esteban Suarez Escobar** | **Responsable de Calidad y Documentación** | Revisa la calidad del código, registra defectos, propone acciones de mantenimiento y mantiene la documentación del `README.md`. |

---

## 📌 Requisitos del Sistema

### ⚙️ Requisitos Funcionales (RF)

#### Módulo de Usuarios y Autenticación
* **RF01 - Autenticación de Usuarios:** Permitir el inicio de sesión mediante credenciales (correo/usuario y contraseña) y cierre de sesión seguro.
* **RF02 - Control de Acceso por Roles:** Restringir vistas y funcionalidades según el rol asignado (Administrador, Recepcionista, Cliente).

#### Módulo de Gestión de Habitaciones
* **RF03 - Administración de Habitaciones:** Permitir registrar, editar, listar y cambiar el estado operacional de las habitaciones (Disponible, Ocupada, Limpieza, Mantenimiento).
* **RF04 - Categorización de Habitaciones:** Clasificar las habitaciones por tipo (Sencilla, Doble, Suite) asignando precios por noche y capacidad máxima.

#### Módulo de Huéspedes y Reservas
* **RF05 - Registro de Huéspedes:** Registrar y consultar datos personales e historial de hospedajes de los clientes.
* **RF06 - Gestión de Reservas:** Crear, consultar, modificar y cancelar reservas validando la disponibilidad de fechas y habitaciones.
* **RF07 - Control de Check-In y Check-Out:** Registrar el ingreso y salida del huésped actualizando automáticamente el estado de la habitación asignada.

#### Módulo de Base de Datos
* **RF08 - Persistencia de Datos:** Registrar y almacenar la información transaccional (usuarios, clientes, habitaciones, reservas) de forma permanente mediante un sistema gestor relacional.
* **RF09 - Integridad Referencial de Datos:** Garantizar que las relaciones de datos (ej. Reserva-Huésped, Reserva-Habitación) mantengan la coherencia lógica mediante claves primarias y foráneas (`FOREIGN KEYS`).
* **RF10 - Consultas e Historial:** Permitir consultar el historial completo de reservas y transacciones pasadas mediante consultas optimizadas a la base de datos.

---

### 🛡️ Requisitos No Funcionales (RNF)

#### Rendimiento y Disponibilidad
* **RNF01 - Tiempo de Respuesta:** Las peticiones del sistema y las consultas a la base de datos no deben superar los 2 segundos de respuesta bajo condiciones normales de carga.
* **RNF02 - Disponibilidad:** El sistema debe estar disponible para su ejecución continua en entornos de desarrollo o servidores web locales (Apache, Nginx, PHP Built-in server).

#### Seguridad
* **RNF03 - Encriptación de Contraseñas:** Las contraseñas de los usuarios deben almacenarse encriptadas en la base de datos utilizando algoritmos hash seguros (ej. `password_hash()` con bcrypt).
* **RNF04 - Protección contra Inyección SQL:** Todas las consultas a la base de datos deben implementarse mediante sentencias preparadas (`Prepared Statements` / PDO) para evitar ataques de inyección SQL.

#### Usabilidad y Mantenimiento
* **RNF05 - Usabilidad de la Interfaz:** Interfaz intuitiva y adaptable (responsive design) navegable fácilmente por el personal administrativo.
* **RNF06 - Arquitectura Modular y Legibilidad:** Estructura de código organizada por capas o patrón MVC para facilitar la mantenibilidad, refactorización y extensión de funciones.

---

## 🗄️ Estructura y Esquema de la Base de Datos

El sistema utiliza un modelo relacional SQL. A continuación se presenta el diseño general de entidades del archivo `database/schema.sql`:

```text
+-------------------+        +-------------------+        +-------------------+
|     USUARIOS      |        |     RESERVAS      |        |    HABITACIONES   |
+-------------------+        +-------------------+        +-------------------+
| PK id_usuario     |<------ | PK id_reserva     | ------>| PK id_habitacion  |
|    nombre         |        | FK id_cliente     |        |    numero         |
|    email          |        | FK id_habitacion  |        |    tipo           |
|    password       |        |    fecha_inicio   |        |    precio         |
|    rol            |        |    fecha_fin      |        |    estado         |
+-------------------+        |    estado_reserva |        +-------------------+
                             +-------------------+
                                       |
                                       v
                             +-------------------+
                             |     CLIENTES      |
                             +-------------------+
                             | PK id_cliente     |
                             |    documento      |
                             |    nombre         |
                             |    telefono       |
                             +-------------------+