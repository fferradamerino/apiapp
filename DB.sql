CREATE TABLE Imagenes (
    Id INT PRIMARY KEY,
    IdSetImagenes INT
);

CREATE TABLE Catalogo (
    Id INT PRIMARY KEY,
    Nombre VARCHAR(20)
);

CREATE TABLE Productos (
    Id INT PRIMARY KEY,
    Precio INT,
    IdSetImagenes INT,
    IdCatalogo INT,
    FOREIGN KEY (IdCatalogo) REFERENCES Catalogo(Id)
);

CREATE TABLE Usuarios (
    Id INT PRIMARY KEY,
    IdFotoPerfil INT,
    NombreUsuario VARCHAR(20),
    Correo VARCHAR(20),
    Contrasena VARCHAR(20),
    FOREIGN KEY (IdFotoPerfil) REFERENCES Imagenes(Id)
);

CREATE TABLE Ofertas (
    Id INT PRIMARY KEY,
    Titulo VARCHAR(50),
    Subtitulo VARCHAR(100),
    Contenido VARCHAR(100),
    Descuento FLOAT,
    IdProducto INT,
    FOREIGN KEY (IdProducto) REFERENCES Productos(Id)
);

CREATE TABLE Sucursales (
    Id INT PRIMARY KEY,
    IdSetImagenes INT,
    NombreSucursal VARCHAR(30),
    DireccionSucursal VARCHAR(50),
    Telefono VARCHAR(12),
    CodigoPostal VARCHAR(10),
    InicioHorario TIME,
    FinHorario TIME
);

CREATE TABLE Noticias (
    Id INT PRIMARY KEY,
    IdSetImagenes INT,
    Titulo VARCHAR(20),
    Subtitulo VARCHAR(20),
    Contenido VARCHAR(50),
    Seccion VARCHAR(100)
);