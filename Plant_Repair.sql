# Group 1B
# Plant Repair Database
# Sales Associate and Quote Database
#
# Written by Ben Ford

drop table if exists Quote_Descript;
drop table if exists Quote;
drop table if exists Associate;

create table Associate(
    User_Id  INT             NOT NULL PRIMARY KEY AUTO_INCREMENT,
    Name     CHAR(50)        NOT NULL,
    Password VARCHAR(50)     NOT NULL,
    Accu_Com DECIMAL(15,2)   NOT NULL,
    Address  VARCHAR(100)    NOT NULL,
    Admin    BOOLEAN         NOT NULL
);

create table Quote(
    Quote_Id  INT            NOT NULL PRIMARY KEY AUTO_INCREMENT,
    User_Id   INT            NOT NULL,
    Cust_Id   INT            NOT NULL,
    SNote     VARCHAR(1000),
    Status    CHAR(11)       NOT NULL DEFAULT "Unfinalized",
    Date      DATETIME       NOT NULL DEFAULT CURRENT_TIMESTAMP,
    Discount  DECIMAL(15,2),
    Percent   BOOLEAN,

    foreign key(User_Id) references Associate(User_Id)
);

create table Quote_Descript(
    Descrip_Id INT           NOT NULL PRIMARY KEY AUTO_INCREMENT,
    Quote_Id   INT           NOT NULL,
    Price      DECIMAL(15,2) NOT NULL,
    Descript   VARCHAR(1000) NOT NULL,

    foreign key(Quote_Id) references Quote(Quote_Id)
);
