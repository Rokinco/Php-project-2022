CREATE DATABASE IF NOT EXISTS Agora_Schema;
USE Agora_Schema;

SHOW TABLES;


/* Business table */
DROP TABLE IF EXISTS Business;
CREATE TABLE IF NOT EXISTS Business (
	BusinessID VARCHAR(7) PRIMARY KEY,
    BusinessName VARCHAR(30) NOT NULL,
    BusinessDescription VARCHAR(255) NOT NULL,
    CompanyLogo VARCHAR(100) NULL
);

/* RolePermission Table */
DROP TABLE IF EXISTS RolePermission;
CREATE TABLE IF NOT EXISTS RolePermission (
	RoleID VARCHAR(10) PRIMARY KEY,
    RoleName VARCHAR(30) NOT NULL,
    CanView INT NOT NULL,
    CanUpdate INT NOT NULL,
    CanDelete INT NOT NULL,
    BusinessID VARCHAR(7),
    FOREIGN KEY(BusinessID) REFERENCES Business(BusinessID)
);

/* UserAccount */
DROP TABLE IF EXISTS UserAccount;
CREATE TABLE IF NOT EXISTS UserAccount (
	UserID VARCHAR(8) PRIMARY KEY,
    UserName VARCHAR(30) NOT NULL,
    FirstName VARCHAR(30) NOT NULL,
    FamilyName VARCHAR(30) NOT NULL,
    Email VARCHAR(30) NOT NULL,
		Password_Hash CHAR(60),
    BusinessID VARCHAR(7),
    FOREIGN KEY (BusinessID) REFERENCES Business(BusinessID)
);

/* UserPermission Table */
DROP TABLE IF EXISTS UserPermission;
CREATE TABLE IF NOT EXISTS UserPermission (
	UserPermID VARCHAR(10),
    RoleID VARCHAR(10),
    UserID VARCHAR(8),
    FOREIGN KEY (RoleID) REFERENCES RolePermission(RoleID),
    FOREIGN KEY (UserID) REFERENCES UserAccount(UserID)
);

/* SubscriberInfo Table */
DROP TABLE IF EXISTS SubscriberInfo;
CREATE TABLE IF NOT EXISTS SubscriberInfo (
	TransID INT AUTO_INCREMENT PRIMARY KEY,
    UserName VARCHAR(30) NOT NULL,
    PaidAmount FLOAT NOT NULL,
    SubscriberStartDate DATE NOT NULL,
    SubScriberEndDate DATE NOT NULL,
    UserID VARCHAR(8),
    FOREIGN KEY (UserID) REFERENCES UserAccount(UserID)
);

/* Post Table */
DROP TABLE IF EXISTS Post;
CREATE TABLE IF NOT EXISTS Post (
	PostID VARCHAR(10) PRIMARY KEY,
    UserName VARCHAR(30) NOT NULL,
    PostTitle VARCHAR(50) NOT NULL,
    _Description VARCHAR(250) NOT NULL,
    UserID VARCHAR(8),
    FOREIGN KEY (UserID) REFERENCES UserAccount(UserID)
);

/* SellingInformation Table */
DROP TABLE IF EXISTS SellingInformation;
CREATE TABLE IF NOT EXISTS SellingInformation (
	ProductID INT AUTO_INCREMENT PRIMARY KEY,
    ProductDescription VARCHAR(255) NOT NULL,
    Pricing FLOAT NOT NULL,
    PostID VARCHAR(30),
    FOREIGN KEY (PostID) REFERENCES Post(PostID)
);

/* Image */
DROP TABLE IF EXISTS Image;
CREATE TABLE IF NOT EXISTS Image (
	ImageID INT AUTO_INCREMENT PRIMARY KEY,
    ImagePath VARCHAR(100) NOT NULL,
    ImageDescription VARCHAR(255) NULL,
    PostID VARCHAR(10),
    FOREIGN KEY (PostID) REFERENCES Post(PostID)
);

/* HashtagControl Table */
DROP TABLE IF EXISTS HashtagControl;
CREATE TABLE IF NOT EXISTS HashtagControl (
	HashtagID VARCHAR(30) PRIMARY KEY,
    HashtagName VARCHAR(30) NOT NULL,
    HashDescription VARCHAR(255) NULL,
    PostID VARCHAR(10),
    FOREIGN KEY (PostID) REFERENCES Post(PostID)
);
