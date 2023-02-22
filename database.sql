

Table: webuser
Columns:
email varchar(255) PK 
usertype char(1) 
email_verification tinyint(1)

Table: tutor
Columns:
tutorid int AI PK 
tutoremail varchar(255) 
tutorname varchar(255) 
tutorpassword varchar(255) 
specialties int


Table: student
Columns:
sid int AI PK 
semail varchar(255) 
sname varchar(255) 
spassword varchar(255) 
pdob date 
stel varchar(15)

Table: specialties
Columns:
id int PK 
sname varchar(50)


Table: schedule
Columns:
scheduleid int AI PK 
tutorid varchar(255) 
title varchar(255) 
scheduledate date 
scheduletime time 
nop int 
AM_PM varchar(255)

Table: appointment
Columns:
appoid int AI PK 
sid int 
apponum int 
scheduleid int 
status int

Table: admin
Columns:
aemail varchar(255) PK 
apassword varchar(255) 
admin_name varchar(255)


