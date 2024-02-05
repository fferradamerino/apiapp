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

/*
    Endpoint: /usuario/editar.php
    - Método: POST
    - Descripción: edita la cuenta del usuario, retornando verdadero o falso si la operación fue exitosa
    - Parámetros:
        - id (int, obligatorio): ID del usuario a editar
        - foto (blob, opcional): foto de perfil del usuario.
        - nombredeusuario (string, obligatorio): nombre completo del usuario.
        - correo (string, obligatorio): correo electrónico del usuario.
        - contrasena (string, obligatorio): contraseña de la cuenta del usuario.
*/
async function editar (id, foto, nombredeusuario, correo, contrasena) {
  const response = await fetch(`${url}/usuario/editar.php`, {
    method: 'POST',
    headers: { 'Content-Type': 'application/json' },
    body: JSON.stringify({ id, foto, nombredeusuario, correo, contrasena })
  })
  const data = await response.json()

  return data.exito
}

console.log(login('xe@ctm.cl', '12345678'))
console.log(registro(null, 'html', 'lordhtml@ctm.cl', '12345678'))
console.log(editar(20, null, 'html', 'lordhtml@ctm.cl', '12345678'))
