
drop database loginapp;
create database loginapp;

use loginapp;

create table users (
	user_id int auto_increment,
	user_username varchar(255),
    user_password varchar(255),
    primary key (user_id)
);

insert into users (user_username, user_password) values ("misha", "123456");
insert into users (user_username, user_password) values ("tobi", "123");