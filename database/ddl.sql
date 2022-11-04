create database if not exists lr20190024;

use lr20190024; /* Switch to db context */

create table if not exists contacts
(
    id         bigint auto_increment
        primary key,
    first_name varchar(50)                         not null,
    last_name  varchar(50)                         not null,
    email      varchar(255)                        not null,
    phone      varchar(20)                         not null,
    created_at timestamp default CURRENT_TIMESTAMP not null,
    updated_at timestamp default CURRENT_TIMESTAMP not null,
    constraint contacts_email_uindex
        unique (email),
    constraint contacts_id_uindex
        unique (id)
);

create table if not exists products
(
    id           bigint auto_increment
        primary key,
    product_name varchar(255) not null,
    constraint products_id_uindex
        unique (id)
);

create table if not exists sales_people
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

create table if not exists deals
(
    id                  bigint auto_increment
        primary key,
    contact_id          bigint                              not null,
    product_id          bigint                              not null,
    sales_person_id     bigint                              not null,
    deal_value          double                              null,
    deal_value_currency varchar(4)                          null,
    notes               text                                null,
    created_at          timestamp default CURRENT_TIMESTAMP not null,
    updated_at          timestamp default CURRENT_TIMESTAMP not null,
    constraint deals_id_uindex
        unique (id),
    constraint deals_contact_id_fk
        foreign key (contact_id) references contacts (id)
            on delete cascade,
    constraint deals_product_id_fk
        foreign key (product_id) references products (id)
            on delete cascade,
    constraint deals_sales_person_id_fk
        foreign key (sales_person_id) references sales_people (id)
            on delete cascade
);
