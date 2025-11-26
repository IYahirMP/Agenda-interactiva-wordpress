# Agenda Programable Interactiva

Plugin de WordPress para la gestión de citas y agendas de manera interactiva, desarrollado específicamente para profesionales de la nutrición.

![WordPress](https://img.shields.io/badge/WordPress-Plugin-21759B?logo=wordpress)
![PHP](https://img.shields.io/badge/PHP-7.0+-777BB4?logo=php)
![License](https://img.shields.io/badge/License-GPL--2.0+-blue.svg)
![Version](https://img.shields.io/badge/Version-1.0.0-green.svg)
![Type](https://img.shields.io/badge/Type-Learning_Project-orange.svg)

## Descripción

Este plugin permite controlar una agenda de manera interactiva a través de un menú administrativo en WordPress. Facilita la gestión de citas, clientes, ubicaciones y horarios, proporcionando una interfaz visual tipo calendario para administradores.

**Contexto:** Este proyecto fue desarrollado como parte de mi proceso de aprendizaje en desarrollo de plugins WordPress. Implementa las funcionalidades core de un sistema de gestión de citas profesional y me ayudó a obtener mi primera posición como desarrollador. Representa un ejemplo funcional de mis habilidades en WordPress, PHP, y desarrollo full-stack.

## Características Implementadas

- 📅 **Calendario Interactivo**: Visualización de citas en formato calendario
- 👥 **Gestión de Clientes**: Registro y administración de información de clientes
- 📍 **Gestión de Ubicaciones**: Múltiples ubicaciones de consulta
- ⏰ **Gestión de Horarios**: Control de disponibilidad por ubicación
- 📝 **Gestión de Citas**: Creación, visualización y administración de citas
- 💰 **Registro de Pagos**: Sistema de seguimiento de pagos por cita
- 🎨 **Interfaz Bootstrap**: UI moderna y responsive

## Estructura de Base de Datos

El plugin crea automáticamente las siguientes tablas al activarse:

### `wp_nac_cliente`
- `id` - Identificador único
- `nombre` - Nombre del cliente
- `apellidoPaterno` - Apellido paterno
- `apellidoMaterno` - Apellido materno
- `telefono` - Teléfono de contacto
- `correo` - Correo electrónico

### `wp_nac_ubicacion`
- `id` - Identificador único
- `estado` - Estado
- `municipio` - Municipio
- `localidad` - Localidad
- `calle` - Calle
- `colonia` - Colonia
- `num_exterior` - Número exterior
- `num_interior` - Número interior
- `telefono_contacto` - Teléfono de la ubicación

### `wp_nac_horario`
- `id` - Identificador único
- `dia` - Fecha de la cita
- `horaInicio` - Hora de inicio
- `horaFin` - Hora de finalización
- `ubicacion` - Referencia a ubicación (FK)

### `wp_nac_cita`
- `id` - Identificador único
- `asunto` - Asunto de la cita
- `cliente` - Referencia a cliente (FK)
- `horario` - Referencia a horario (FK)

### `wp_nac_pago`
- `id` - Identificador único
- `cantidad` - Monto del pago
- `citaId` - Referencia a cita (FK)
- `fecha` - Timestamp del pago

## Instalación

1. Descarga o clona este repositorio
2. Copia la carpeta `agenda-interactiva` en el directorio `/wp-content/plugins/` de tu instalación de WordPress
3. Activa el plugin desde el menú 'Plugins' en WordPress
4. El plugin creará automáticamente las tablas necesarias en la base de datos

```bash
# Clonar el repositorio
git clone https://github.com/IYahirMP/Agenda-interactiva-wordpress.git

# Mover a la carpeta de plugins
mv Agenda-interactiva-wordpress /ruta/a/wordpress/wp-content/plugins/agenda-interactiva
```

## Uso

### Panel de Administración

Una vez activado, el plugin añade un nuevo menú en el panel de administración de WordPress:

1. **Agenda de citas** - Vista principal del calendario con todas las citas
2. **Ubicaciones** - Gestión de ubicaciones de consulta

### Funcionalidades del Calendario

- Visualización mensual de citas
- Click en eventos para ver detalles completos
- Información detallada de cliente, horario y ubicación
- Interfaz intuitiva con Bootstrap

### Gestión de Ubicaciones

- Crear nuevas ubicaciones
- Editar ubicaciones existentes
- Eliminar ubicaciones
- Formulario completo con todos los datos de dirección

## Tecnologías Utilizadas

- **PHP** - Lenguaje del lado del servidor
- **WordPress API** - Hooks, acciones y filtros de WordPress
- **MySQL** - Base de datos
- **JavaScript/jQuery** - Interactividad del frontend
- **Bootstrap 5.3** - Framework CSS
- **Calendar.js** - Librería de calendario

## Estructura del Proyecto

```
agenda-interactiva/
├── admin/                          # Funcionalidad del área administrativa
│   ├── css/                        # Estilos del admin
│   ├── js/                         # Scripts del admin
│   ├── partials/                   # Vistas parciales
│   └── class-nutriologa-agenda-interactiva-admin.php
├── includes/                       # Clases principales
│   ├── class-nutriologa-agenda-interactiva.php
│   ├── class-nutriologa-agenda-interactiva-activator.php
│   ├── class-nutriologa-agenda-interactiva-deactivator.php
│   ├── class-nutriologa-agenda-interactiva-i18n.php
│   └── class-nutriologa-agenda-interactiva-loader.php
├── languages/                      # Archivos de traducción
├── public/                         # Funcionalidad del área pública
│   ├── css/
│   ├── js/
│   └── partials/
├── LICENSE.txt                     # Licencia GPL-2.0+
├── README.md                       # Este archivo
├── README.txt                      # README para WordPress.org
├── nutriologa-agenda-interactiva.php  # Archivo principal del plugin
└── uninstall.php                   # Script de desinstalación
```

## API AJAX

El plugin expone varios endpoints AJAX para operaciones dinámicas:

- `actualizarDatosUbicacion` - Actualizar información de ubicación
- `crearUbicacion` - Crear nueva ubicación
- `eliminarUbicacion` - Eliminar ubicación existente
- `obtenerDatosCalendario` - Obtener eventos del calendario por mes
- `obtenerInformacionEvento` - Obtener detalles completos de una cita

## Alcance y Aprendizajes

**Tipo de Proyecto:** Demostración de habilidades / Proyecto de aprendizaje  
**Estado:** Funcionalidades core completadas  
**Propósito:** Desarrollo de un sistema funcional de gestión de citas para WordPress

Este proyecto representa un sistema completamente funcional de gestión de citas con las características principales implementadas. Fue desarrollado como parte de mi proceso de aprendizaje en WordPress y sirvió como proyecto que me ayudó a obtener mi primera posición profesional en desarrollo.

### ✅ Funcionalidades Core Implementadas

**Backend & Base de Datos:**
- ✅ Sistema completo de base de datos con 5 tablas relacionales
- ✅ Activador automático que crea tablas al instalar el plugin
- ✅ Arquitectura MVC siguiendo estándares de WordPress
- ✅ Sistema de hooks y filtros de WordPress
- ✅ Manejo de AJAX para operaciones asíncronas

**Panel Administrativo:**
- ✅ Calendario interactivo mensual con visualización de citas
- ✅ CRUD completo de ubicaciones (Crear, Leer, Actualizar, Eliminar)
- ✅ Visualización detallada de información de citas
- ✅ Interfaz responsive con Bootstrap 5.3
- ✅ Menú administrativo integrado en WordPress

**Gestión de Datos:**
- ✅ Gestión de clientes con información completa
- ✅ Gestión de ubicaciones con direcciones detalladas
- ✅ Sistema de horarios vinculado a ubicaciones
- ✅ Registro de citas con relaciones cliente-horario
- ✅ Sistema de pagos vinculado a citas

### Conocimientos Técnicos Demostrados

- **WordPress Development:** Creación de plugins desde cero siguiendo estándares
- **PHP Orientado a Objetos:** Arquitectura de clases y separación de responsabilidades
- **Base de Datos:** Diseño de esquemas relacionales con foreign keys
- **JavaScript/jQuery:** Interactividad del frontend y llamadas AJAX
- **Bootstrap:** Implementación de interfaces responsive modernas
- **WordPress API:** Uso de hooks, actions, filters y AJAX handlers
- **Seguridad:** Validación de permisos y sanitización de datos

### Posibles Extensiones Futuras

Si alguien quisiera continuar el desarrollo de este proyecto, algunas características que podrían agregarse incluyen:

- Formulario público para que usuarios agenden citas
- Sistema de notificaciones por correo electrónico
- Panel de reportes y estadísticas
- Gestión completa del módulo de pagos con historial
- Exportación de datos a CSV/PDF
- Integración con calendarios externos (Google Calendar, Outlook)
- Sistema de recordatorios automáticos
- Validación de disponibilidad en tiempo real

### Agradecimientos

Agradezco la oportunidad que me brindaron para trabajar en este proyecto real durante mi etapa de aprendizaje. Esta experiencia fue fundamental para mi crecimiento profesional y me permitió desarrollar habilidades prácticas que me ayudaron a conseguir mi primera posición como desarrollador.

## Autor

**Ivan Yahir Mojica Pineda**
- Website: [iyahir.live](https://iyahir.live)
- Email: ivanyahirmopi@gmail.com

## Licencia

Este proyecto está licenciado bajo GPL-2.0+ - ver el archivo [LICENSE.txt](LICENSE.txt) para más detalles.

## Contribuciones

Este es un proyecto de portafolio y demostración. Siéntete libre de hacer fork del proyecto para:
- Aprender sobre desarrollo de plugins WordPress
- Usar como base para tus propios proyectos
- Experimentar con las funcionalidades implementadas
- Extender con las características adicionales que desees

Si encuentras este proyecto útil para tu aprendizaje, me encantaría saberlo.

## Notas Adicionales

- El prefijo de las tablas es `nac_` (Nutriologa Agenda Citas)
- Requiere WordPress 3.0.1 o superior
- Compatible con PHP 7.0+
- Utiliza la API de WordPress para máxima compatibilidad
- Sigue las convenciones de codificación de WordPress

## Enlaces

- [Documentación de WordPress Plugin API](https://developer.wordpress.org/plugins/)
- [Bootstrap 5 Documentation](https://getbootstrap.com/docs/5.3/)