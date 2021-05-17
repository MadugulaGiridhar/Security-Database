CREATE TABLE USER_ROLES(
 Role_Name  varchar(255),
 Description varchar(255) ,
 PRIMARY KEY(Role_Name)
);


CREATE TABLE USER_ACCOUNTS(
 User_IDNO int NOT NULL,
 Name varchar(255) ,
 Phone varchar(12),
 Role_Name  varchar(255),
 PRIMARY KEY(User_IDNO),
 FOREIGN KEY(Role_Name) REFERENCES USER_ROLES (Role_Name)
);

CREATE TABLE PRIVILEGE(
 Select_Privileges varchar(255) ,
 Update_Privileges varchar(255) ,
 Create_Privileges varchar(255) ,
 Delete_Privileges varchar(255) , 
 User_IDNO int NOT NULL,
 Role_Name  varchar(255),
 FOREIGN KEY(Role_Name) REFERENCES USER_ROLES (Role_Name), 
 FOREIGN KEY(User_IDNO) REFERENCES USER_ACCOUNTS (User_IDNO) 
 
);

CREATE TABLE TABLES(
 TableName varchar(255) ,
 User_IDNO int NOT NULL,
 Role_Name  varchar(255),
 PRIMARY KEY(TableName),
 FOREIGN KEY(User_IDNO) REFERENCES USER_ACCOUNTS (User_IDNO), 
 FOREIGN KEY(Role_Name) REFERENCES USER_ROLES (Role_Name)
);

