const url = 'http://localhost/api'

async function login (correo, contrasena) {
  const response = await fetch(`${url}/usuario/login.php`, {
    method: 'POST',
    headers: { 'Content-Type': 'application/json' },
    body: JSON.stringify({ correo, contrasena })
  })
  const data = await response.json()

  if (data.exito === false) {
    console.log(JSON.stringify(correo, contrasena))
    return false
  } else {
    return true
  }
}

async function registro (foto, nombredeusuario, correo, contrasena) {
  const response = await fetch(`${url}/usuario/registro.php`, {
    method: 'POST',
    headers: { 'Content-Type': 'application/json' },
    body: JSON.stringify({ foto, nombredeusuario, correo, contrasena })
  })
  const data = await response.json()

  return data.id
}

async function editarUsuario (id, foto, nombredeusuario, correo, contrasena) {
  const response = await fetch(`${url}/usuario/editar.php`, {
    method: 'POST',
    headers: { 'Content-Type': 'application/json' },
    body: JSON.stringify({ id, foto, nombredeusuario, correo, contrasena })
  })
  const data = await response.json()

  return data.exito
}

async function crearOferta (titulo, subtitulo, contenido, descuento, idProducto) {
  const response = await fetch(`${url}/oferta/crear.php`, {
    method: 'POST',
    headers: { 'Content-Type': 'application/json' },
    body: JSON.stringify({ titulo, subtitulo, contenido, descuento, idProducto })
  })
  const data = await response.json()

  return data.exito
}

async function editarOferta (idOferta, titulo, subtitulo, contenido, descuento) {
  const response = await fetch(`${url}/oferta/editar.php`, {
    method: 'POST',
    headers: { 'Content-Type': 'application/json' },
    body: JSON.stringify({ idOferta, titulo, subtitulo, contenido, descuento })
  })
  const data = await response.json()

  return data.exito
}

async function eliminarOferta (idOferta) {
  const response = await fetch(`${url}/oferta/eliminar.php`, {
    method: 'POST',
    headers: { 'Content-Type': 'application/json' },
    body: JSON.stringify({ idOferta })
  })
  const data = await response.json()

  return data.exito
}

async function obtenerOfertas (x) {
  const response = await fetch(`${url}/oferta/obtener.php`, {
    method: 'POST',
    headers: { 'Content-Type': 'application/json' },
    body: JSON.stringify({ x })
  })
  const data = await response.json()

  return data.ofertas
}

async function crearNoticia (imagen1, imagen2, imagen3, titulo, subtitulo, contenido, seccion) {
  const response = await fetch(`${url}/noticia/crear.php`, {
    method: 'POST',
    headers: { 'Content-Type': 'application/json' },
    body: JSON.stringify({ imagen1, imagen2, imagen3, titulo, subtitulo, contenido, seccion })
  })
  const data = await response.json()

  return data.exito
}

async function editarNoticia (idNoticia, imagen1, imagen2, imagen3, titulo, subtitulo, contenido, seccion) {
  const response = await fetch(`${url}/noticia/editar.php`, {
    method: 'POST',
    headers: { 'Content-Type': 'application/json' },
    body: JSON.stringify({ idNoticia, imagen1, imagen2, imagen3, titulo, subtitulo, contenido, seccion })
  })
  const data = await response.json()

  return data.exito
}

async function eliminarNoticia (idNoticia) {
  const response = await fetch(`${url}/noticia/eliminar.php`, {
    method: 'POST',
    headers: { 'Content-Type': 'application/json' },
    body: JSON.stringify({ idNoticia })
  })
  const data = await response.json()

  return data.exito
}

async function obtenerNoticias (x) {
  const response = await fetch(`${url}/noticia/obtener.php`, {
    method: 'POST',
    headers: { 'Content-Type': 'application/json' },
    body: JSON.stringify({ x })
  })
  const data = await response.json()

  return data.noticias
}

async function crearProducto (nombre, precio, nombreCatalogo) {
  const response = await fetch(`${url}/producto/crear.php`, {
    method: 'POST',
    headers: { 'Content-Type': 'application/json' },
    body: JSON.stringify({ nombre, precio, nombreCatalogo })
  })
  const data = await response.json()

  return data.exito
}

async function editarProducto (id, nombre, precio, nombreCatalogo) {
  const response = await fetch(`${url}/producto/editar.php`, {
    method: 'POST',
    headers: { 'Content-Type': 'application/json' },
    body: JSON.stringify({ id, nombre, precio, nombreCatalogo })
  })
  const data = await response.json()

  return data.exito
}

async function eliminarProducto (id) {
  const response = await fetch(`${url}/producto/eliminar.php`, {
    method: 'POST',
    headers: { 'Content-Type': 'application/json' },
    body: JSON.stringify({ id })
  })
  const data = await response.json()

  return data.exito
}

async function obtenerProductos (x) {
  const response = await fetch(`${url}/producto/obtener.php`, {
    method: 'POST',
    headers: { 'Content-Type': 'application/json' },
    body: JSON.stringify({ x })
  })
  const data = await response.json()

  return data.productos
}

async function crearSucursal (nombre, direccion, telefono, codigopostal, horarioinicio, horariofin) {
  const response = await fetch(`${url}/sucursal/crear.php`, {
    method: 'POST',
    headers: { 'Content-Type': 'application/json' },
    body: JSON.stringify({ nombre, direccion, telefono, codigopostal, horarioinicio, horariofin })
  })
  const data = await response.json()

  return data.exito
}

async function editarSucursal (id, nombre, direccion, telefono, codigopostal, horarioinicio, horariofin) {
  const response = await fetch(`${url}/sucursal/editar.php`, {
    method: 'POST',
    headers: { 'Content-Type': 'application/json' },
    body: JSON.stringify({ id, nombre, direccion, telefono, codigopostal, horarioinicio, horariofin })
  })
  const data = await response.json()

  return data.exito
}

async function eliminarSucursal (id) {
  const response = await fetch(`${url}/sucursal/eliminar.php`, {
    method: 'POST',
    headers: { 'Content-Type': 'application/json' },
    body: JSON.stringify({ id })
  })
  const data = await response.json()

  return data.exito
}

async function obtenerSucursales () {
  const response = await fetch(`${url}/sucursal/obtener.php`, {
    method: 'GET'
  })
  const data = await response.json()

  return data.sucursales
}

async function crearCatalogo (nombre) {
  const response = await fetch(`${url}/catalogo/crear.php`, {
    method: 'POST',
    headers: { 'Content-Type': 'application/json' },
    body: JSON.stringify({ nombre })
  })
  const data = await response.json()

  return data.exito
}

async function editarCatalogo (id, nombre) {
  const response = await fetch(`${url}/catalogo/editar.php`, {
    method: 'POST',
    headers: { 'Content-Type': 'application/json' },
    body: JSON.stringify({ id, nombre })
  })
  const data = await response.json()

  return data.exito
}

async function eliminarCatalogo (id) {
  const response = await fetch(`${url}/catalogo/eliminar.php`, {
    method: 'POST',
    headers: { 'Content-Type': 'application/json' },
    body: JSON.stringify({ id })
  })
  const data = await response.json()

  return data.exito
}

async function obtenerCatalogos () {
  const response = await fetch(`${url}/catalogo/obtener.php`, {
    method: 'GET'
  })
  const data = await response.json()

  return data.catalogos
}

// Tests. Borrar si es necesario.
console.log(registro(null, 'Test', 'test@google.cl', '12345678'))
console.log(login('xe@ctm.cl', '12345678'))
console.log(editarUsuario(20, null, 'html', 'lordhtml@ctm.cl', '12345678'))
console.log(crearOferta('Oferta de ejemplo', 'Esto es una oferta de ejemplo', 'Este es el contenido de la oferta', 20.0, 1))
console.log(editarOferta(1, 'Oferta de ejemplo', 'Esto es una oferta de ejemplo', 'Este es el contenido de la oferta', 20.0))
console.log(eliminarOferta(1))
console.log(obtenerOfertas(5))
console.log(crearNoticia(null, null, null, 'Noticia de ejemplo', 'Esto es una noticia de ejemplo', 'Este es el contenido de la noticia', 'Deportes'))
console.log(editarNoticia(1, null, null, null, 'Noticia de ejemplo', 'Esto es una noticia de ejemplo', 'Este es el contenido de la noticia', 'Deportes'))
console.log(eliminarNoticia(1))
console.log(obtenerNoticias(5))
console.log(crearProducto('Producto de ejemplo', 10000, 'Catálogo de ejemplo'))
console.log(editarProducto(1, 'Producto de ejemplo', 10000, 'Catálogo de ejemplo'))
console.log(eliminarProducto(1))
console.log(obtenerProductos(5))
console.log(crearSucursal('Sucursal de ejemplo', 'Calle de ejemplo', '12345678', '12345678', '09:00', '18:00'))
console.log(editarSucursal(1, 'Sucursal de ejemplo', 'Calle de ejemplo', '12345678', '12345678', '09:00', '18:00'))
console.log(eliminarSucursal(1))
console.log(obtenerSucursales())
console.log(crearCatalogo('Catálogo de ejemplo'))
console.log(editarCatalogo(1, 'Catálogo de ejemplo'))
console.log(eliminarCatalogo(1))
console.log(obtenerCatalogos())
