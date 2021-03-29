insert into Associate (Name, Password, Accu_Com, Address, Admin)
  values ('Admin', 'Test123', 1000.20, '1425 W. Lincoln Hwy. DeKalb, IL 60115-2828', 1);
insert into Associate (Name, Password, Accu_Com, Address, Admin)
  values ('Normal', 'Test321', 50.00, '4321 N. Normal Rd Dekalb, IL 60115', 0);
insert into Associate (Name, Password, Accu_Com, Address, Admin)
  values ('Jesus', 'BibleStudy', 72365.78, 'Heaven Dr, Green Bay, WI 54311', 1);
insert into Associate (Name, Password, Accu_Com, Address, Admin)
  values ('Normal', 'Alphabet', 192873.18, 'Northwestern University, 633 Clark St, Evanston, IL 60208', 0);
insert into Associate (Name, Password, Accu_Com, Address, Admin)
  values ('Rocks', 'Geologist', 93458.33, 'Stonehenge, Salisbury SP4 7DE, United Kingdom', 0);
insert into Associate (Name, Password, Accu_Com, Address, Admin)
  values ('Aliens', 'Pyramid', 283749.89, 'The Great Pyramid of Giza, Al Haram, Nazlet El-Semman, Al Giza Desert, Giza Governorate, Egypt', 0);
insert into Associate (Name, Password, Accu_Com, Address, Admin)
  values ('BassProShop', 'Illuminati', 128736182.12, 'Bass Pro Shops at the Pyramid, 1 Bass Pro Dr, Memphis, TN 38105', 1);
insert into Associate (Name, Password, Accu_Com, Address, Admin)
  values ('Deep', 'Sea', 1902.17, 'Mariana Trench', 0);
insert into Associate (Name, Password, Accu_Com, Address, Admin)
  values ('Godzilla', 'Mothra', 192323.62, 'Tokyo Tower, 4 Chome-2-8 Shibakoen, Minato City, Tokyo 105-0011, Japan', 0);
insert into Associate (Name, Password, Accu_Com, Address, Admin)
  values ('The Dead Sea', 'Salty', 0.00, 'Dead Sea', 0);

insert into Quote (User_Id, Cust_Mail, SNote, Status, Date)
  values (2, '420swagmaster@hotmail.co.uk', "This person's email got me a free water bottle", "Finalized", '20210216');
insert into Quote (User_Id, Cust_Mail, SNote, Status, Date)
  values (1, 'customerEmail@email.com', "Ryan's secret notes for his first quote", "Sanctioned", '20210304');
insert into Quote (User_Id, Cust_Mail, SNote, Status, Date)
  values (6, 'mcdonalds@email.com', "McDonalds is aiiight", "Ordered", '20210304');
insert into Quote (User_Id, Cust_Mail, SNote, Status, Date)
  values (5, 'burgerKing@email.com', "Burger king has decent burgers", "Finalized", '20210306');
insert into Quote (User_Id, Cust_Mail, SNote, Status, Date)
  values (4, 'wendys@email.com', "I hardly go to wendys. Not sure why", "Ordered", '20210224');
insert into Quote (User_Id, Cust_Mail, SNote, Status, Date)
  values (10, 'buffaloWildWings@email.com', "Mmmm smoky adobo", "Sanctioned", '20210305');
insert into Quote (User_Id, Cust_Mail, SNote)
  values (9, 'testUnfinalEmail@email.com', "Test for displaying unfinalized quotes");
insert into Quote (User_Id, Cust_Mail, SNote)
  values (3, 'epicGamer@email.com', "Ask this person to take a shower");
insert into Quote (User_Id, Cust_Mail, SNote)
  values (7, 'theAbsoluteBest@email.com', "Best person I've ever met");
insert into Quote (User_Id, Cust_Mail, SNote)
  values (8, 'rubberDuck@email.com', "Always seems to squash bugs in code");
insert into Quote (User_Id, Cust_Mail, SNote)
  values (3, 'chuckECheese@email.com', "His middle name is entertainment");
insert into Quote (User_Id, Cust_Mail, SNote)
  values (2, 'NoodlesandCo@email.com', "Wonderful pasta and decent prices");
insert into Quote (User_Id, Cust_Mail, SNote)
  values (5, 'pizzaHut@email.com', "Wants to know about the guy who tried to out pizza the hut");
insert into Quote (User_Id, Cust_Mail, SNote)
  values (7, 'dominoes@email.com', "Cheap and delicious, I eat this more than I should");
insert into Quote (User_Id, Cust_Mail, SNote)
  values (4, 'littleCaesars@email.com', "Can't beat the price");
insert into Quote (User_Id, Cust_Mail, SNote)
  values (1, 'jimmyJohns@email.com', "Taste the best after swimming");
insert into Quote (User_Id, Cust_Mail, SNote)
  values (10, 'jerseyMikes@email.com', "So expensive, but so worth it");
insert into Quote (User_Id, Cust_Mail, SNote)
  values (9, 'kettleChips@email.com', "So much better than regular potato chips");

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

insert into Quote_Descript (Quote_Id, Price, Descript)
  values (7, 12.59, "This is unfinished");

insert into Quote_Descript (Quote_Id, Price, Descript)
  values (8, 6.48, "Shampoo combo pack");
insert into Quote_Descript (Quote_Id, Price, Descript)
  values (8, 4.88, "Bulk body wash");
insert into Quote_Descript (Quote_Id, Price, Descript)
  values (8, 2.59, "Deodorant");

insert into Quote_Descript (Quote_Id, Price, Descript)
  values (9, 0.00, "Convinced me it was free");
insert into Quote_Descript (Quote_Id, Price, Descript)
  values (9, 0.00, "Anything he wanted");

insert into Quote_Descript (Quote_Id, Price, Descript)
  values (10, 21.00, "Priceless help on coding");
insert into Quote_Descript (Quote_Id, Price, Descript)
  values (10, 17.76, "A very good listener");

insert into Quote_Descript (Quote_Id, Price, Descript)
  values (11, 1977.99, "Awful Pizza");
insert into Quote_Descript (Quote_Id, Price, Descript)
  values (11, 2020.99, "Closing a lot of their stores");

insert into Quote_Descript (Quote_Id, Price, Descript)
  values (12, 17.99, "Delicious food");
insert into Quote_Descript (Quote_Id, Price, Descript)
  values (12, 12.59, "I usually get the Mac and Cheese");

insert into Quote_Descript (Quote_Id, Price, Descript)
  values (13, 19.99, "Don't like their pizza");
insert into Quote_Descript (Quote_Id, Price, Descript)
  values (13, 99000.00, "Willing to pay a lot for info on people out-pizzaing the hut");

insert into Quote_Descript (Quote_Id, Price, Descript)
  values (14, 14.59, "Like their pizza far too much");
insert into Quote_Descript (Quote_Id, Price, Descript)
  values (14, 0.00, "But I get free pizza sometimes because of it");

insert into Quote_Descript (Quote_Id, Price, Descript)
  values (15, 5.00, "It's hot and ready");

insert into Quote_Descript (Quote_Id, Price, Descript)
  values (16, 10.14, "Haven't had this in a long time");
insert into Quote_Descript (Quote_Id, Price, Descript)
  values (16, 1.56, "Usually get the BLT");
insert into Quote_Descript (Quote_Id, Price, Descript)
  values (16, 12.96, "Sometimes I just buy the bread");

insert into Quote_Descript (Quote_Id, Price, Descript)
  values (17, 13.76, "Only ever had this when someone else paid for it");
insert into Quote_Descript (Quote_Id, Price, Descript)
  values (17, 16.27, "Always amazing");

insert into Quote_Descript (Quote_Id, Price, Descript)
  values (18, 16.36, "I try not to buy these chips because I don't stop eating them");
insert into Quote_Descript (Quote_Id, Price, Descript)
  values (18, 1.99, "Taste really good on a sandwhich");
