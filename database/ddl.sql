create database if not exists lr20190024;

use lr20190024;

create table contacts
(
    id         bigint auto_increment
        primary key,
    first_name varchar(50)                         not null,
    last_name  varchar(50)                         not null,
    email      varchar(255)                        not null,
    phone      varchar(20)                         not null,
    created_at timestamp default CURRENT_TIMESTAMP null,
    constraint contacts_email_uindex
        unique (email),
    constraint contacts_id_uindex
        unique (id)
);

create table products
(
    id           bigint auto_increment
        primary key,
    product_name varchar(255) not null,
    constraint products_id_uindex
        unique (id)
);

create table sales_people
(
    id    bigint auto_increment
        primary key,
    name  varchar(255) not null,
    email varchar(255) not null,
    constraint sales_people_email_uindex
        unique (email),
    constraint sales_people_id_uindex
        unique (id)
);

insert into products(product_name) values('Paket Usluga 1');
insert into products(product_name) values('Paket Usluga 2');
insert into products(product_name) values('Paket Usluga 3');

insert into sales_people(name, email) values ('Marko Markovic', 'marko@markovic.com');
insert into sales_people(name, email) values ('Luka Lukic', 'luka@lukic.com');
