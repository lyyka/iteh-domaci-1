use lr20190024;

set foreign_key_checks = 0;
truncate deals;
truncate contacts;
truncate products;
truncate sales_people;
set foreign_key_checks  = 1;

insert into contacts(first_name, last_name, email, phone)
    values ('Test', 'Testic', 'test@testi.com', '123 123 123');
insert into contacts(first_name, last_name, email, phone)
    values ('Pera', 'Peric', 'pera@peric.com', '456 456 456');
insert into contacts(first_name, last_name, email, phone)
    values ('Zika', 'Zikic', 'zika@zikic.com', '789 789 789');
insert into contacts(first_name, last_name, email, phone)
    values ('Mare', 'Maric', 'mare@maric.com', '101 101 101');

insert into products(product_name) values('Paket Usluga 1');
insert into products(product_name) values('Paket Usluga 2');
insert into products(product_name) values('Paket Usluga 3');

insert into sales_people(name, email) values ('Marko Markovic', 'marko@markovic.com');
insert into sales_people(name, email) values ('Luka Lukic', 'luka@lukic.com');

insert into deals(contact_id, product_id, sales_person_id, deal_value, deal_value_currency, notes)
    values(1, 1, 1, 150000, 'EUR', 'Test deal 1');
insert into deals(contact_id, product_id, sales_person_id, deal_value, deal_value_currency, notes)
    values(2, 2, 1, 70000, 'EUR', 'Test deal 2');
insert into deals(contact_id, product_id, sales_person_id, deal_value, deal_value_currency, notes)
    values(3, 3, 2, 120000, 'USD', 'Test deal 3');
insert into deals(contact_id, product_id, sales_person_id, deal_value, deal_value_currency, notes)
    values(3, 2, 2, 25000, 'EUR', 'Test deal 4');
