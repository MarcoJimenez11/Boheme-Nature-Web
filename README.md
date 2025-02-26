# Marcodona web


## Índice

 1. Introducción
 2. Base de datos
    2.1. Users
    2.2. Sessions
    2.3. Categories
    2.4. Orders
    2.5. Products
    2.6. Order_lines
    2.7. Cache & Cache_locks
 3. Estructura del proyecto
 4. Funcionalidad
    4.1. Usuarios
    4.2. Categorías
    4.3. Productos
    4.4. Carrito
    4.5. Pedidos
    4.6. Línea de pedidos
    4.7. Otros
 5. Estilo
 6. Javascript
 7. Repositorio


## 1. Introducción

Marcodona es un proyecto de aplicación web creado desde cero con el
framework Laravel y el lenguaje PHP.

Esta aplicación web consiste en una tienda virtual que permite registrar usuarios
para, una vez identificado poder comprar los productos ofertados. Además, como
usuario administrador se permite gestionar distintos aspectos de la aplicación.

A continuación veremos en más detalle la funcionalidad de la aplicación.

## 2. Tecnologías y Recursos

Debajo se muestra una lista de tecnologías y recursos utilizados durante el
desarrollo de la aplicación web.

```
Entorno de desarrollo Visual Studio Code
Framework Laravel
Lenguajes PHP, Javascript, HTML (Blade)
Estilos SCSS
Repositorio Github
Base de datos MySQL
Gestor de BD phpMyAdmin
Servidor Local Apache (XAMPP)
Servicio de Email Mailtrap
Documento LibreOffice
```

## 2. Base de datos

```
Los datos de la aplicación web se almacenarán en una base de datos MySQL.
```
```
Gracias a Laravel, podemos especificar las tablas e incluso añadir registros de
prueba para crearlos posteriormente el cualquier base de datos indicada.
```
```
Para crear las tablas se han creado ficheros de migración en el directorio
database\migrations , y para insertar los datos de prueba se han creado los
ficheros Factory en el directorio database/factories, que determinan la estructura
de los datos, y los ficheros Seeder en database/seeders, que se encargan de
insertar la cantidad de datos indicada con la información establecida.
```
```
Las tablas de la aplicación son las siguientes:
```
3.1.Users

```
La tabla usuarios, pieza fundamental de la gran mayoría de páginas web, consta
de los siguientes campos:
```
- **id**
- **name**
- **email**
- **email_verified_at –** Este campo indica si el email se ha verificado con el
    email enviado por la aplicación. Indica la fecha de verificación.
- **password**
- **remember_token –** Token para recordar el inicio de sesión
- **is_admin –** Indica si el usuario tiene rol de administrador
- **created_at**
- **updated_at**


3.2.Sessions

Esta tabla almacena los datos de sesión de los usuarios, y es necesaria para
Laravel para interactuar con las sesiones. Consta de los siguientes campos:

- **id**
- **user_id**
- **ip_address –** Dirección IP del usuario que ha iniciado sesión
- **user_agent –** El navegador
- **payload**
- **last_activity**

3.3.Categories

Tabla para las categorías de los productos de la tienda online. Tiene los siguientes
campos:

- **id**
- **name**
- **created_at**
- **updated_at**

3.4.Orders

Tabla para los pedidos que realizarán los usuarios en la web. Consta de los
siguientes campos:

- **id**
- **user_id –** Id del usuario asociado al pedido
- **province –** Provincia del usuario al que irá dirigido el pedido
- **locality –** Localidad del usuario al que irá dirigido el pedido
- **direction –** Dirección del usuario al que irá dirigido el pedido
- **status –** Estado del pedido, según esté en curso, terminado, etc.
- **created_at**
- **updated_at**


3.5.Products

Tabla de los productos que venderá la tienda. Tiene los siguientes campos:

- **id**
- **category_id –** Id de la categoría a la que pertenece el producto
- **name**
- **description**
- **price –** Precio por unidad del producto
- **stock –** Cantidad disponible del producto en la tienda
- **image**
- **created_at**
- **updated_at**

3.6.Order_lines

Tabla para las líneas de cada pedido, que contendrán la información de los
productos solicitados por el usuario y su cantidad. Consta de los siguientes
campos:

- **id**
- **order_id –** Id del pedido al que pertenece esta línea
- **product_id –** Id del producto asociado a esta línea de pedido
- **amount –** Cantidad del producto que se solicita para el pedido
- **created_at**
- **updated_at**

3.7.Cache & Cache_locks

Tablas de caché necesarias para Laravel para trabajar con el caché del navegador
y agilizar algunos procesos que puedan ralentizar ciertas operaciones.


## 3. Estructura del proyecto

```
El proyecto está diseñando con Laravel, y por tanto sigue su estructura
predeterminada de Modelo Vista Controlador o MVC.
```
```
Los directorios o ficheros más relevantes son:
```
- **app –** Contiene los controladores y
    modelos del proyecto
- **config –** Contiene los ficheros de
    configuración
- **database** – Contiene los Factories,
    Migrations y Seeders del proyecto para
    gestionar la base de datos
- **public** – Contiene el index.php además de
    otros ficheros públicos
- **resources** – Contiene los recursos de la
    web, como los estilos, los ficheros
    Javascript o las vistas
- **routes** – Contiene el fichero web.php con
    las rutas que se establecerán para acceder a
    la funcionalidad de la web
- **tests** – Contiene las pruebas unitarias o
    tests de la aplicación
- **.env –** Fichero de entorno con las variables
    globales necesarias


## 4. Funcionalidad

5.1.Usuarios

```
5.1.1Registro
```
```
La aplicación permite registrar un nuevo usuario indicando sus datos
correctamente. Tras ello, se enviará un correo al email del usuario para confirmar
su registro. Hasta que no se confirme no se permite al usuario interactuar con
ciertas operaciones de la web, como realizar pedidos.
```
```
5.1.2Inicio de sesión
```
```
El inicio de sesión permite al usuario recordar su sesión de forma que no tenga
que volver a iniciarla en futuras visitas a la web.
```
```
5.1.3Editar usuario
```
```
El usuario podrá editar sus datos para cambiar su nombre, email o contraseña
según crea conveniente.
Adicionalmente, un administrador podrá editar otros usuarios además del suyo, y
modificar el rol de todos ellos.
```
```
5.1.4Eliminar usuario
```
```
Sólo un administrador podrá eliminar usuarios si lo cree conveniente, siempre y
cuando no tengan asociados datos como por ejemplo pedidos realizados.
```
5.2.Categorías

```
5.2.1CRUD categorías
```
```
Un administrador podrá crear, ver, editar o eliminar categorías según la
necesidad.
```
```
5.2.2Listado de categorías
```
```
En el menú se muestra un botón para ver las categorías, que mostrará las
existentes y permitirá hacer click en cualquiera de ella para ver los productos
asociados a esa categoría.
```

5.3.Productos

```
5.3.1CRUD productos
```
Un administrador podrá crear, ver, editar o eliminar productos según la
necesidad.

```
5.3.2Listado de productos por categoría
```
Los usuarios pueden ver listados de productos seleccionando las categorías del
menú, o todos los productos de la tienda desde la página inicial o haciendo click
en el logotipo de la web.

5.4. Carrito

La aplicación contiene cookies para registrar los productos que se desean añadir
al carrito. Una vez en el carrito, se pueden aumentar o disminuir los productos,
eliminarlos uno a uno o vaciar por completo el carrito.

5.5.Pedidos

```
5.5.1Realizar Pedido
```
Un usuario puede tras haber añadido productos al carrito, realizar un pedido con
dichos productos. Tras ello, se pedirán los datos de envío, y tras confirmar el
pedido se enviará un correo al email del usuario con la confirmación del pedido.

```
5.5.2Ver pedidos
```
Un usuario puede ver sus pedidos mediante el botón del menú ‘Mis Pedidos’.

5.6.Línea de pedidos

```
5.6.1Ver líneas de pedidos
```
En la lista de pedidos se puede pulsar el botón ‘Ver detalles’ para ver las líneas
asociadas a ese pedido.


5.7. Otros

```
5.7.1Paginación
```
Todas las listas de la aplicación contienen un sistema de paginación para ver los
elementos de forma ordenada y cómoda para el usuario.

```
5.7.2Envío de correos
```
Tal y como se ha comentado previamente, existe un sistema de envío automático
de correos para la verificación del usuario y la confirmación de un pedido
realizado.

```
5.7.3Sesiones y cookies
```
Para recordar el usuario se utiliza el sistema de recordatorio de Larav y además
se recurre a cookies de Laravel mediante el método cookie().

Para el sistema del carrito se recurre al método session() de Laravel.


## 5. Estilo

```
El estilo se ha realizado mediante SCSS, basándose en el diseño de comercios
digitales similares.
```
```
Los ficheros se encuentran en el directorio resources\scss.
```
## 6. Javascript

```
Se ha añadido un fichero con un simple código de Javascript para mostrar las
categorías y ocultarlas tras pulsar el botón de ‘Categorías’.
```
```
El fichero se llama ‘categoriesMenu.js’ y se ubica en el directorio resources\js.
```
## 7. Repositorio

```
Para trabajar en el desarrollo de la aplicación se ha recurrido a un repositorio de
Github.
```
```
La dirección del repositorio es:
https://github.com/MarcoJimenez11/Marcodona_Laravel
```

