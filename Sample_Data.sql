# Group 1B
# Plant Repair Sample Data
# Sales Associate and Quote Database
#
# Written by Ben Ford

insert into Associate (Name, Password, Accu_Com, Address, Admin)
  values ('Admin', 'Test123', 1000.20, '1425 W. Lincoln Hwy. DeKalb, IL 60115-2828', 1);
insert into Associate (Name, Password, Accu_Com, Address, Admin)
  values ('Normal', 'Test321', 50.00, '4321 N. Normal Rd Dekalb, IL 60115', 0);

insert into Quote (Cust_Mail, SNote)
  values ('420swagmaster@hotmail.co.uk', "This person's email got me a free water bottle");
insert into Quote (Cust_Mail, SNote)
  values ('customerEmail@email.com', "Ryan's secret notes for his first quote");
insert into Quote (Cust_Mail, SNote)
  values ('mcdonalds@email.com', "McDonalds is aiiight");
insert into Quote (Cust_Mail, SNote)
  values ('burgerKing@email.com', "Burger king has decent burgers");
insert into Quote (Cust_Mail, SNote)
  values ('wendys@email.com', "I hardly go to wendys. Not sure why");
insert into Quote (Cust_Mail, SNote)
  values ('buffaloWildWings@email.com', "Mmmm smoky adobo");

insert into Quote_Descript (Quote_Id, Price, Descript)
  values (1, 0.00, "The bottle was free");
insert into Quote_Descript (Quote_Id, Price, Descript)
  values (1, 4.20, "It keeps my water ICE cold");
insert into Quote_Descript (Quote_Id, Price, Descript)
  values (1, 0.69, "Feel bad if someone in the UK got spammed with emails because of this though");

insert into Quote_Descript (Quote_Id, Price, Descript)
  values (2, 100.00, "The first should be standard");
insert into Quote_Descript (Quote_Id, Price, Descript)
  values (2, .10, "Nothing too complicated");
insert into Quote_Descript (Quote_Id, Price, Descript)
  values (2, 1000100100100.00, "Just something to test the limits");

insert into Quote_Descript (Quote_Id, Price, Descript)
  values (3, 8.49, "I go to McDonalds far too often");
insert into Quote_Descript (Quote_Id, Price, Descript)
  values (3, 1.08, "Probably should take a break");

insert into Quote_Descript (Quote_Id, Price, Descript)
  values (4, 5.71, "I can't remember the last time I've been to burger king");

insert into Quote_Descript (Quote_Id, Price, Descript)
  values (5, 6.36, "Wendy's is so good but I also haven't been in a long time");
insert into Quote_Descript (Quote_Id, Price, Descript)
  values (5, 2.99, "It's an enigma");

insert into Quote_Descript (Quote_Id, Price, Descript)
  values (6, 11.59, "Bdubs is so good after working out");
insert into Quote_Descript (Quote_Id, Price, Descript)
  values (6, 8.59, "It's a little expensive though");

