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
