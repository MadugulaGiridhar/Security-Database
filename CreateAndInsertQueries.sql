CREATE TABLE USER_ROLES(
 Role_Name  varchar(255),
 Description varchar(255) ,
 PRIMARY KEY(Role_Name)
);
	



Insert into USER_ROLES values 
('Student','Users of database'),
('Admin','Administrators of DB'),
('Support','Support team'),
('Professor','Professor of a course');

CREATE TABLE USER_ACCOUNTS(
 User_IDNO int NOT NULL,
 Name varchar(255) ,
 Phone varchar(12),
 Role_Name  varchar(255),
 PRIMARY KEY(User_IDNO),
 FOREIGN KEY(Role_Name) REFERENCES USER_ROLES (Role_Name)
);

Insert into USER_ACCOUNTS values 
('11','Name01','1234567890','Student'),
('12','Name02','1234567891','Student'),
('13','Name03','1234567892','Student'),
('14','Name04','1234567893','Admin'),
('15','Name05','1234567894','Admin'),
('16','Name06','1234567895','Admin'),
('17','Name07','1234567896','Professor'),
('18','Name08','1234567897','Professor'),
('19','Name09','1234567898','Support'),
('10','Name10','1234567899','Support');


CREATE TABLE PRIVILEGES(
 SELECT_PRIVILEGES boolean DEFAULT false,
 UPDATE_PRIVILEGES boolean DEFAULT false,
 CREATE_PRIVILEGES boolean DEFAULT false,
 DELETE_PRIVILEGES boolean DEFAULT false,
 User_IDNO int NOT NULL,
 Role_Name  varchar(255),
 FOREIGN KEY(Role_Name) REFERENCES USER_ROLES (Role_Name), 
 FOREIGN KEY(User_IDNO) REFERENCES USER_ACCOUNTS (User_IDNO) 
);

Insert into PRIVILEGES values 
(1,1,0,0,'11','Student'),
(1,1,0,0,'12','Student'),
(1,1,0,0,'13','Student'),
(1,1,1,1,'14','Admin'),
(1,1,1,1,'15','Admin'),
(1,1,1,1,'16','Admin'),
(1,1,1,1,'17','Professor'),
(1,1,1,1,'18','Professor'),
(1,1,1,0,'19','Support'),
(1,1,1,0,'10','Support');


CREATE TABLE TABLES(
 TableName varchar(255) ,
 User_IDNO int NOT NULL,
 Role_Name  varchar(255),
 PRIMARY KEY(TableName),
 FOREIGN KEY(User_IDNO) REFERENCES USER_ACCOUNTS (User_IDNO), 
 FOREIGN KEY(Role_Name) REFERENCES USER_ROLES (Role_Name)
);

Insert into TABLES values
('Table01','14','Admin'),
('Table02','14','Admin'),
('Table03','14','Admin'),
('Table04','15','Admin'),
('Table05','15','Admin'),
('Table06','15','Admin'),
('Table07','16','Admin'),
('Table08','16','Admin'),
('Table09','17','Professor'),
('Table10','18','Professor');