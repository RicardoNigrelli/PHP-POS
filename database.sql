CREATE TABLE PRODUCTO (
    codpro int not null AUTO_INCREMENT,
    nompro varchar(50) null,
    despro varchar(100) null,
    prepro numeric(6,2) null,
    estado int nulL,
    CONSTRAINT pk_producto
    PRIMARY KEY (codpro)
)

alter table PRODUCTO add rutimapro varchar(100) null;

INSERT INTO PRODUCTO (nompro, despro, prepro, estado, rutimapro );
VALUES ("Papel Crepé", "Ideal para decorar", "14.99", 1, "https://acdn.mitiendanube.com/stores/783/019/products/papel-crepe1-cdd03a8f3adaacd3a415967329415920-640-0.jpg"), ("Papel Bond A4", "Papel Ultra Blanco", "9.99", 1, "https://www.google.com/url?sa=i&url=https%3A%2F%2Fwww.ricoh.es%2Fproductos%2Fsuministros-papel%2Fpapel%2Fpro-office-paper%2F&psig=AOvVaw1NaDhxEHuq9gItMa73FOAf&ust=1723580205466000&source=images&cd=vfe&opi=89978449&ved=0CBEQjRxqFwoTCPjJ2uCi8IcDFQAAAAAdAAAAABAE")