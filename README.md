# Documentación del Proyecto

<p align="center"><a href="https://laravel.com" target="_blank"><img src="https://raw.githubusercontent.com/laravel/art/master/logo-lockup/5%20SVG/2%20CMYK/1%20Full%20Color/laravel-logolockup-cmyk-red.svg" width="400" alt="Laravel Logo"></a></p>

<p align="center">
<a href="https://github.com/laravel/framework/actions"><img src="https://github.com/laravel/framework/workflows/tests/badge.svg" alt="Build Status"></a>
<a href="https://packagist.org/packages/laravel/framework"><img src="https://img.shields.io/packagist/dt/laravel/framework" alt="Total Downloads"></a>
<a href="https://packagist.org/packages/laravel/framework"><img src="https://img.shields.io/packagist/v/laravel/framework" alt="Latest Stable Version"></a>
<a href="https://packagist.org/packages/laravel/framework"><img src="https://img.shields.io/packagist/l/laravel/framework" alt="License"></a>
</p>

---

## Descripción

Este proyecto es un backend desarrollado en Laravel que expone una API para la gestión de recursos relacionados con [descripción del dominio del proyecto, por ejemplo, hoteles, habitaciones, etc.]. Incluye endpoints para realizar operaciones CRUD.

Laravel es un framework de aplicaciones web con una sintaxis expresiva y elegante. Este proyecto aprovecha las características principales de Laravel, como el motor de enrutamiento rápido, el contenedor de inyección de dependencias, el ORM Eloquent y las migraciones de esquema agnósticas de base de datos.

Además, el proyecto utiliza **Laravel Sail**, un entorno de desarrollo ligero basado en **Docker**, que facilita la configuración y ejecución del proyecto en contenedores.

---

## Tecnologías Utilizadas

Este proyecto utiliza las siguientes tecnologías y lenguajes de programación:

- ![PHP](https://img.shields.io/badge/-PHP-333333?style=flat&logo=php) **PHP**: Lenguaje principal del backend.
- ![Laravel](https://img.shields.io/badge/-Laravel-FF2D20?style=flat&logo=laravel&logoColor=white) **Laravel**: Framework para el desarrollo del backend.
- ![PostgreSQL](https://img.shields.io/badge/-PostgreSQL-336791?style=flat&logo=postgresql&logoColor=white) **PostgreSQL**: Base de datos relacional utilizada.
- ![Docker](https://img.shields.io/badge/-Docker-2496ED?style=flat&logo=docker&logoColor=white) **Docker**: Plataforma para la ejecución de contenedores.
- ![Composer](https://img.shields.io/badge/-Composer-885630?style=flat&logo=composer&logoColor=white) **Composer**: Herramienta para la gestión de dependencias.
- ![Swagger](https://img.shields.io/badge/-Swagger-85EA2D?style=flat&logo=swagger&logoColor=black) **Swagger**: Herramienta para la documentación interactiva de la API.

---

## Requisitos Previos

- **Docker**: Instalado y configurado en tu sistema.
- **Docker Compose**: Para la gestión de contenedores.
- **PHP**: Versión 8.0 o superior (opcional si no usas Docker).
- **Composer**: Para la gestión de dependencias (opcional si no usas Docker).

---

## Instalación

1. Clona el repositorio:
   ```bash
   git clone <URL_DEL_REPOSITORIO>
   cd itbf-backend
   ```

2. Instala las dependencias utilizando Composer:
   ```bash
   composer install
   ```

3. Configura el archivo `.env`:
   - Copia el archivo de ejemplo:
     ```bash
     cp .env.example .env
     ```
   - Configura las variables de entorno, como la conexión a la base de datos PostgreSQL.

4. Inicia el entorno de desarrollo con Laravel Sail:
   ```bash
   ./vendor/bin/sail up -d
   ```

5. Genera la clave de la aplicación:
   ```bash
   ./vendor/bin/sail artisan key:generate
   ```

6. Ejecuta las migraciones y los seeders:
   ```bash
   ./vendor/bin/sail artisan migrate --seed
   ```

---

## Uso

1. Inicia el entorno de desarrollo (si no está corriendo):
   ```bash
   ./vendor/bin/sail up -d
   ```

2. Accede a la API en:
   ```
   http://localhost
   ```

3. Consulta los endpoints disponibles en la sección "Endpoints Principales".

---

## Documentación de la API con Swagger

El proyecto incluye una integración con **Swagger** para generar documentación interactiva de la API. Esto permite a los desarrolladores explorar y probar los endpoints directamente desde el navegador.

### Acceso a Swagger

1. Asegúrate de que el entorno de desarrollo esté corriendo:
   ```bash
   ./vendor/bin/sail up -d
   ```

2. Accede a la interfaz de Swagger en:
   ```
   http://localhost/api/v1/documentation
   ```

### Generación de la Documentación

Si realizas cambios en los endpoints o deseas actualizar la documentación, sigue estos pasos:

1. Instala las dependencias necesarias para Swagger (si no están instaladas):
   ```bash
   composer require "darkaonline/l5-swagger"
   ```

2. Genera la documentación actualizada:
   ```bash
   ./vendor/bin/sail artisan l5-swagger:generate
   ```

3. Verifica los cambios accediendo nuevamente a la interfaz de Swagger.

### Configuración de Swagger

El archivo de configuración de Swagger se encuentra en:
```
config/l5-swagger.php
```

Puedes personalizar aspectos como el título de la documentación, la versión de la API y los esquemas de seguridad.

---

## Endpoints Principales

### Gestión de Hoteles
- **GET** `/api/v1/hoteles`: Obtiene todos los hoteles.
- **POST** `/api/v1/hoteles`: Crea un nuevo hotel.
- **PUT** `/api/v1/hoteles/{id}`: Actualiza un hotel existente.
- **DELETE** `/api/v1/hoteles/{id}`: Elimina un hotel.

### Gestión de Habitaciones
- **GET** `/api/v1/habitaciones`: Obtiene todas las habitaciones.
- **POST** `/api/v1/habitaciones`: Crea una nueva habitación.
- **PUT** `/api/v1/habitaciones/{id}`: Actualiza una habitación existente.
- **DELETE** `/api/v1/habitaciones/{id}`: Elimina una habitación.

---

## Recursos de Aprendizaje

Laravel cuenta con una extensa y detallada [documentación](https://laravel.com/docs) y una biblioteca de tutoriales en video en [Laracasts](https://laracasts.com). También puedes explorar el [Laravel Bootcamp](https://bootcamp.laravel.com) para aprender a construir una aplicación moderna desde cero.

---

## Laravel Sponsors

Agradecemos a los siguientes patrocinadores por apoyar el desarrollo de Laravel. Si estás interesado en convertirte en patrocinador, visita el programa [Laravel Partners](https://partners.laravel.com).

### Socios Premium
- **[Vehikl](https://vehikl.com/)**
- **[Tighten Co.](https://tighten.co)**
- **[Kirschbaum Development Group](https://kirschbaumdevelopment.com)**
- **[64 Robots](https://64robots.com)**
- **[Curotec](https://www.curotec.com/services/technologies/laravel/)**
- **[DevSquad](https://devsquad.com/hire-laravel-developers)**
- **[Redberry](https://redberry.international/laravel-development/)**
- **[Active Logic](https://activelogic.com)**

---

## Contribución

1. Crea un fork del repositorio.
2. Crea una rama para tu funcionalidad:
   ```bash
   git checkout -b feature/nueva-funcionalidad
   ```
3. Realiza tus cambios y haz un commit:
   ```bash
   git commit -m "Agrega nueva funcionalidad"
   ```
4. Envía un pull request.

Para más detalles, consulta la [guía de contribución](https://laravel.com/docs/contributions).

---

## Seguridad

Si descubres una vulnerabilidad de seguridad en Laravel, envía un correo electrónico a Taylor Otwell a través de [taylor@laravel.com](mailto:taylor@laravel.com). Todas las vulnerabilidades serán atendidas de manera inmediata.

---

## Licencia

El framework Laravel es un software de código abierto licenciado bajo la [MIT License](https://opensource.org/licenses/MIT).
