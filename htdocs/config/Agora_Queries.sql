USE Agora_Schema;

/* Business table insertation */
INSERT INTO Business VALUES(1,"Hurg Burger","We're a business that sells burgers","C://Documents/Agora/Images/Companies/HurgBurger.png");
INSERT INTO Business VALUES(2,"Aecom","We're a business that sells software","C://Documents/Agora/Images/Companies/Aecom.png");
INSERT INTO Business VALUES(3,"McBells","We're a business that sells Iron","C://Documents/Agora/Images/Companies/McBells.png");

/* Role Permission Insertation */
INSERT INTO RolePermission VALUES ("ADMIN01","Admin",1,1,1,1);
INSERT INTO RolePermission VALUES ("ADMIN02","Admin",1,1,1,2);
INSERT INTO RolePermission VALUES ("SELL01","Seller",1,1,0,3);

/* UserAccount Insertation */
INSERT INTO UserAccount VALUES(1, "rawrs", "Rowlth", "Meowth", "Meoth@gmail.com","$2y$10$8i3.SGZg8I8LonqeGqb40O0XbzCF5xV1JbxEKBKxk..wfOqV/juni", 1);
INSERT INTO UserAccount VALUES(2, "rowtarly", "Tarly", "Rowland", "Rowtarly@gmail.com","$2y$10$8i3.SGZg8I8LonqeGqb40O0XbzCF5xV1JbxEKBKxk..wfOqV/juni", 2);
INSERT INTO UserAccount VALUES(3, "bobmnobs", "Jenkins", "Schmenkins", "Bobmnobs@gmail.com","$2y$10$8i3.SGZg8I8LonqeGqb40O0XbzCF5xV1JbxEKBKxk..wfOqV/juni", 3);

/* UserPermissions Insertation */
INSERT INTO UserPermission VALUES("HURGADMIN1","ADMIN01",1);
INSERT INTO UserPermission VALUES("AEADMIN2","ADMIN02",2);
INSERT INTO UserPermission VALUES("SELLER01","SELL01",3);

/* SubscriberInfo Insertation */
INSERT INTO SubscriberInfo VALUES (DEFAULT, "rawrs", 70.00, "2022-10-02","2022-12-02",1);
INSERT INTO SubscriberInfo VALUES (DEFAULT, "rowtarly", 35.00, "2022-11-25","2022-12-25",2);
INSERT INTO SubscriberInfo VALUES (DEFAULT, "bobmnobs", 35.00, "2022-08-16","2022-09-16",3);

/* Post Insertation */
INSERT INTO Post VALUES("BCGD243", "rawrs", "Selling some hamburgers!!","Selling some hamburgers, come get them while they are hot!", 1);
INSERT INTO Post VALUES("BCGD244", "rowtarly", "Selling some Software!!","Selling some software", 2);
INSERT INTO Post VALUES("BCGD246", "bobmnobs", "Selling some Iron!!","Selling some Iron", 3);

/* SellingInformation Insertation */
INSERT INTO SellingInformation VALUES (DEFAULT, "Selling some hamburgers!!", 30.00, "BCGD243");
INSERT INTO SellingInformation VALUES (DEFAULT, "Selling some software!!", 60.00, "BCGD244");
INSERT INTO SellingInformation VALUES (DEFAULT, "Selling some stuff!!", 43.00, "BCGD246");

/* Image Insertation */
INSERT INTO Image VALUES(DEFAULT, "C://Documents/Agora/Images/posts/HurgBurger.png", "burger", "BCGD243");
INSERT INTO Image VALUES(DEFAULT, "C://Documents/Agora/Images/posts/Aecom.png", NULL, "BCGD244");
INSERT INTO Image VALUES(DEFAULT, "C://Documents/Agora/Images/posts/McBells.png", "IRON", "BCGD246");

/* HashtagControl Insertation */
INSERT INTO HashtagControl VALUES("SOMECOOLHASHTAG", "#HURGBURGS", "This is a hashtag made for hugburer","BCGD243");
INSERT INTO HashtagControl VALUES("SOMERANDOM", "#SlAYY", "This is a hashtag made for REE","BCGD244");
INSERT INTO HashtagControl VALUES("DWDWAD", "#RAWRR", "This is a hashtag made for RWR","BCGD246");


/* Queries */

#update Query
UPDATE HashtagControl
SET HashDescription = "This is the new hashtag made for Hugburger"
WHERE HashtagID = "SOMECOOLHASHTAG";

#Simple Query
SELECT UserAccount.UserName, UserAccount.FirstName, UserAccount.FamilyName,
SubscriberInfo.PaidAmount, SubscriberInfo.SubscriberStartDate, SubscriberInfo.SubscriberEndDate
FROM UserAccount INNER JOIN SubscriberInfo ON UserAccount.UserID = SubscriberInfo.UserID
WHERE SubscriberInfo.SubscriberEndDate < NOW();



#Complex query - Find What Permissions a user has
SELECT UserAccount.UserName, Business.BusinessName,
IF(RolePermission.CanView, "Access", "Deny"),
IF(RolePermission.CanUpdate, "Access", "Deny"),
IF(RolePermission.CanDelete, "Access", "Deny") FROM Business
INNER JOIN UserAccount ON Business.BusinessID = UserAccount.BusinessID
INNER JOIN RolePermission ON Business.BusinessID = RolePermission.BusinessID
INNER JOIN UserPermission ON RolePermission.RoleID = UserPermission.RoleID
WHERE RolePermission.CanView = 1
AND RolePermission.CanUpdate = 1
AND RolePermission.CanDelete = 1
ORDER BY UserAccount.UserID;

#Search
#DROP PROCEDURE LatestPosts_SP;
DELIMITER $$
CREATE PROCEDURE LatestPosts_SP()
BEGIN
	SELECT Post.UserName, Post.PostTitle, Post._Description,
    CONCAT(SellingInformation.ProductDescription, ": $", SellingInformation.Pricing) AS Product,
    HashtagControl.HashtagName FROM Post
    INNER JOIN SellingInformation ON SellingInformation.PostID = Post.PostID
    INNER JOIN HashtagControl ON HashtagControl.PostID = Post.PostID
    GROUP BY Post.PostID
    ORDER BY Post.PostID DESC
    LIMIT 10;
END
$$

CALL LatestPosts_SP
