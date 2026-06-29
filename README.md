# Portafolio Profesional 3D

Este es un portafolio web interactivo desarrollado con el framework Laravel, que combina un diseno moderno y minimalista con interactividad en tres dimensiones.

## Caracteristicas Actuales

### Interfaz del Portafolio
- Fondo interactivo tridimensional con un sistema de particulas y un nucleo holografico central desarrollado con Three.js que reacciona al movimiento del puntero y al desplazamiento vertical de la pagina.
- Seccion de inicio personalizada con titulos y subtitulos administrables.
- Seccion Sobre mi con biografia dinamica, listado de habilidades y tarjeta de detalles rapidos de contacto.
- Cuadricula de proyectos destacados extraidos desde la base de datos, con etiquetas de tecnologias y enlaces directos a sus respectivos repositorios o demostraciones en vivo.
- Modal interactivo compacto con efecto de desenfoque de fondo para visualizar de forma completa los detalles, imagenes y descripcion extendida de cada proyecto sin saturar la vista principal.
- Seccion de contacto con botones directos hacia correo electronico, redes profesionales (LinkedIn y GitHub) y un boton de enlace personalizado para enviar un mensaje predefinido directamente a WhatsApp.

### Panel de Administacion (Dashboard)
- Sistema de autenticacion seguro para el administrador del portafolio.
- Modulo de perfil y configuracion general para modificar en tiempo real la informacion del portafolio (textos del banner, biografia, telefono, correo y enlaces de redes sociales).
- Modulo CRUD completo para la gestion de proyectos (crear, editar, ver y eliminar) que incluye la carga y almacenamiento de imagenes de vista previa de los trabajos.

## Tecnologias Utilizadas
- Laravel como framework backend.
- Tailwind CSS para el diseno de los estilos visuales.
- Three.js para la programacion de los elementos y animaciones 3D.
- MySQL como sistema de gestion de bases de datos.
- Javascript nativo para el control del modal, la interactividad de la interfaz y el manejo de los estados de visualizacion.

## Funcionalidades Pendientes / Faltantes

- Formulario de contacto funcional en el sitio publico que permita el envio de mensajes directos por correo electronico mediante SMTP o servicios de mensajeria externos.
- Modulo de mensajes en el Dashboard de administracion para almacenar, visualizar, marcar como leidos o responder los correos recibidos a traves del portafolio.
- Filtro dinamico de proyectos en la vista publica para permitir a los visitantes clasificar los trabajos segun tecnologias utilizadas o categorias especificas sin necesidad de recargar la pagina.
- Optimizacion automatica de imagenes cargadas en el servidor, convirtiendolas a formatos modernos como WebP y ajustando su resolucion para garantizar tiempos de carga optimos.
- Soporte multilenguaje para permitir a los visitantes alternar la visualizacion completa del portafolio entre espanol e ingles.
- Sistema de estadisticas de visitas simple visible desde el panel de administracion para registrar la cantidad de accesos al portafolio y los proyectos mas consultados.
