Create Database Cafe;

Use Cafe;

Create table Member
(MemberID nvarchar(50) Primary Key,
[Name] nvarchar(50) Not Null,
Role nvarchar(50) Not Null,
Gender nvarchar(50) Not Null,
Phone int Not Null Unique);

Insert into Member values
('M01', 'Naruto', 'Student', 'Male', '0127083837'),
('M02','Susuke', 'Student', 'Male', '0129231111'),
('M03','Sakura', 'Student', 'Female', '0112223442'),
('M04','Kakashi', 'Teacher', 'Male', '0129012233'),
('M05','Jiraya', 'Teacher', 'Male', '0112293842');

Create table CafeStaff
(StaffID nvarchar(50) Primary Key,
[Name] nvarchar(50) Not Null,
Gender nvarchar(50) Not Null,
Staff_Role nvarchar(50) Not Null);

Insert into CafeStaff values
('S01', 'Rayner', 'Male', 'Manager'),
('S02', 'Goku', 'Male', 'Chef'),
('S03', 'Vegeta', 'Male', 'Chef'),
('S04', 'Gohan', 'Male', 'Chef'),
('S05', 'Sonic', 'Male', 'Dispatch_Worker'),
('S06', 'Minato', 'Male', 'Dispatch_Worker'),
('S07', 'Boruto', 'Male', 'Dispatch_Worker');

Create table [Order]
(OrderID nvarchar(50) Primary Key,
MemberID nvarchar(50) Foreign Key references Member(MemberID) Not Null,
ChefID nvarchar(50) Foreign Key references CafeStaff(StaffID) Not Null,
ManagerID nvarchar(50) Foreign Key references CafeStaff(StaffID) Not Null,
DispatchWorkerID nvarchar(50) Foreign Key references CafeStaff(StaffID) Not Null,
Delivery_Status nvarchar(50) Not Null,
Address nvarchar(50) Not Null,
Date Date Not Null,
Comment nvarchar(50));

Insert into [Order] values
('O01', 'M01', 'S03', 'S01', 'S05', 'Delivery', '102 Room', '5/12/2024', 'Need_Tomato'),
('O02', 'M01', 'S04', 'S01', 'S06', 'Cancel', '102 Room', '5/12/2024', 'Extra_Orange'),
('O03', 'M03', 'S03', 'S01', 'S06', 'Transporting', '100 Room', '7/11/2024', 'Extra_Egg'),
('O04', 'M02', 'S05', 'S01', 'S06', 'Delivery', '996 Room', '9/11/2024', 'Need_Chili'),
('O05', 'M05', 'S03', 'S01', 'S07', 'Cancel', 'E-09-02', '9/12/2024', 'Extra_Water');

Create table Payment
(PaymentID nvarchar(50)  Primary Key,
OrderID nvarchar(50) Foreign Key references [Order](OrderID) Not Null Unique,
Payment_Date Date Not Null,
Payment_Amount decimal(10,2) Not Null);

Insert into Payment values
('P01', 'O01', '5/12/2014', '7.90'),
('P02', 'O02', '6/11/2024', '14.90'),
('P03', 'O03', '7/11/2024', '6.90'),
('P04', 'O04', '9/11/2024', '5.25'),
('P05', 'O05', '9/12/2024', '5.25');

Create table Feedback
(FeedbackID nvarchar(50) Primary Key,
MemberID nvarchar(50) Foreign Key references Member(MemberID) Not Null,
Rating int Not Null);

Insert into Feedback values
('FE01', 'M01', '5'),
('FE02', 'M01', '4'),
('FE03', 'M02', '3'),
('FE04', 'M03', '2'),
('FE05', 'M05', '4');

Create table Menu
(MenuID nvarchar(50) Primary Key,
[Name] nvarchar(50) Not Null,
Details nvarchar(250),
Price decimal(10,2) Not Null,
FeedbackID nvarchar(50) Foreign Key references Feedback(FeedbackID));

Insert into Menu values
('F01', 'Mushroom_Soup', Null, '7.90', 'FE01'),
('F02', 'BBQ_Pork_Chop', Null, '14.90', 'FE04'),
('F03', 'French_Fries', Null, '6.90', 'FE03'),
('F04', 'Orange_Juice', Null, '5.25', 'FE02'),
('F05', 'Apple_Juice', Null, '5.25', 'FE05'),
('F06', 'SetA', 'Mushroom_Soup + BBQ_Pork_Chop + French_Fries + Orange_Juice', '26', null),
('F07', 'SetB', 'Mushroom_Soup + Apple_Juice', '13', null),
('F08', 'SetC', 'Orange_Juice + ‘Apple_Juice', '10', null);

Create table Order_Item
(Order_ItemID nvarchar(50) Primary Key,
OrderID nvarchar(50) Foreign Key references [Order](OrderID) Not Null,
MenuID nvarchar(50) Foreign Key references Menu(MenuID) Not Null,
Quantity int Not Null,
Price decimal(10,2) Not Null);

Insert into Order_Item values
('OI01', 'O01', 'F01', '1', '7.90'),
('OI02', 'O01', 'F04', '1', '5.25'),
('OI03', 'O02', 'F03', '1', '6.90'),
('OI04', 'O03', 'F02', '1', '14.90'),
('OI05', 'O04', 'F05', '1', '5.25');

Create table Cart
(CartID nvarchar(50) Primary Key,
MemberID nvarchar(50) Foreign Key references Member(MemberID),
MenuID nvarchar(50) Foreign Key references Menu(MenuID));

Insert into Cart values
('C01', 'M01', 'F01'),
('C02', 'M01', 'F04'),
('C03', 'M03', 'F03'),
('C04', 'M02', 'F02'),
('C05', 'M05', 'F05');

--SQL-Data Manipulation Language (DML)

--Q2
--i. List the food(s) which have the highest rating. Show food id, food name, and the rating.
Select Menu.MenuID, Menu.[Name], Feedback.Rating
From Menu
Inner Join Feedback On Menu.FeedbackID = Feedback.FeedbackID
Where Feedback.Rating = (Select Max(Rating) From Feedback);

--ii. Find the total number of feedback per member. Show member id, member name, and the total number of feedback per member.
Select Member.MemberID, Member.[Name], Count(Feedback.FeedbackID) As 'TotalFeedback'
From Member
Left Join Feedback On Member.MemberID = Feedback.MemberID
Group By Member.MemberID, Member.[Name];

--iii. Find the total number of food (meal) ordered by the manager from each chef.
Select CafeStaff.StaffID, CafeStaff.[Name], Count([Order].OrderID) As TotalOrders
From CafeStaff
Right Join [Order] On CafeStaff.StaffID = [Order].ManagerID
Where CafeStaff.StaffID = 'S01'
Group By CafeStaff.StaffID, CafeStaff.[Name];

--iv. Find the total number of food (meal) cooked by each chef. Show chef id, chef name, and the number of meals cooked.
Select CafeStaff.StaffID, CafeStaff.[Name], Count([Order].OrderID) As TotalMealsCooked
From CafeStaff
Inner Join [Order] On CafeStaff.StaffID = [Order].ChefID
Group By CafeStaff.StaffID, CafeStaff.[Name];

--v. List all the foods where their average rating is higher than the average rating of all food.
Select Menu.*, Avg(Feedback.Rating) As AvgRating
From Menu
Inner Join Feedback On Menu.FeedbackID = Feedback.FeedbackID
Group By Menu.MenuID, Menu.[Name]
Having Avg(Feedback.Rating) > (Select Avg(Rating) From Feedback);

--vi. Find the top 3 bestselling foods. The list should include id, name, price, and quantity sold.
Select top 3
Menu.MenuID, Menu.[Name], Menu.Price, Sum(Order_Item.Quantity) As QuantitySold
From Menu
Join Order_Item On Menu.MenuID = Order_Item.MenuID
Group By Menu.MenuID, Menu.[Name], Menu.Price
Order By QuantitySold Desc;

--vii. Show the top 3 members who spent the most on ordering food. The list should include id, name, and whether they are students or staff.
Select top 3
Member.MemberID, Member.[Name], Member.Role, Sum(Payment.Payment_Amount) As TotalSpent
From Member
Join [Order] On Member.MemberID = [Order].MemberID
Join Payment On [Order].OrderID = Payment.OrderID
Group By Member.MemberID, Member.[Name], Member.Role
Order By TotalSpent Desc;

--viii. Show the total members based on gender who are registered as members. The list should include id, name, role (student/staff), and gender.
Select MemberID, [Name], Role, Gender, Count(*) AS TotalMembers
From Member
Group By MemberID, [Name], Role, Gender;

--ix. Show a list of ordered food that has not been delivered to members. The list should show member id, role (student/staff), contact number, food id, food name, quantity, date, and the status of delivery.
Select Member.MemberID, Member.Role, Member.Phone, Order_Item.MenuID, Menu.[Name], Order_Item.Quantity, [Order].Date, [Order].Delivery_Status
From Member
Join [Order] On Member.MemberID = [Order].MemberID
Join Order_Item On [Order].OrderID = Order_Item.OrderID
Join Menu On Order_Item.MenuID = Menu.MenuID
Where [Order].Delivery_Status = 'Cancel' Or [Order].Delivery_Status = 'Transporting';

--x. Show a list of members who made more than 2 orders. The list should show their member id, name, role (student/staff), and total orders.
Select Member.MemberID, Member.[Name], Member.Role, Count([Order].OrderID) As TotalOrder
From Member
Join [Order] On Member.MemberID = [Order].MemberID
Group By Member.MemberID, Member.[Name], Member.Role
Having Count([Order].OrderID) >= 2;
