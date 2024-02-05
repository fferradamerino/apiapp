CREATE TABLE Imagenes (
    Id INT PRIMARY KEY AUTO_INCREMENT,
    Ubicacion VARCHAR(128)
);

CREATE TABLE Catalogo (
    Id INT PRIMARY KEY AUTO_INCREMENT,
    Nombre VARCHAR(20)
);

CREATE TABLE Productos (
    Id INT PRIMARY KEY AUTO_INCREMENT,
    Nombre VARCHAR(20),
    Precio INT,
    IdCatalogo INT,
    FOREIGN KEY (IdCatalogo) REFERENCES Catalogo(Id)
);

CREATE TABLE Usuarios (
    Id INT PRIMARY KEY AUTO_INCREMENT,
    IdFotoPerfil INT,
    NombreUsuario VARCHAR(20),
    Correo VARCHAR(20),
    Contrasena VARCHAR(20),
    FOREIGN KEY (IdFotoPerfil) REFERENCES Imagenes(Id)
);

CREATE TABLE Ofertas (
    Id INT PRIMARY KEY AUTO_INCREMENT,
    Titulo VARCHAR(50),
    Subtitulo VARCHAR(100),
    Contenido VARCHAR(100),
    Descuento FLOAT,
    IdProducto INT,
    FOREIGN KEY (IdProducto) REFERENCES Productos(Id)
);

CREATE TABLE Sucursales (
    Id INT PRIMARY KEY AUTO_INCREMENT,
    NombreSucursal VARCHAR(30),
    DireccionSucursal VARCHAR(50),
    Telefono VARCHAR(12),
    CodigoPostal VARCHAR(10),
    InicioHorario TIME,
    FinHorario TIME
);

CREATE TABLE Noticias (
    Id INT PRIMARY KEY AUTO_INCREMENT,
    Titulo VARCHAR(20),
    Subtitulo VARCHAR(20),
    Contenido VARCHAR(50),
    Seccion VARCHAR(100)
);