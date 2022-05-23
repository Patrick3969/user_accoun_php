create table user(
    userID int auto_increment primary key,
    login varchar(20),
    password varchar(20),
    lvl int
);

select user.lvl from user where userID =