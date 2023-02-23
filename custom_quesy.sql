use tutor_online;
select * from webuser;
select * from schedule;


INSERT INTO schedule (tutorid,title,scheduledate,scheduletime) 
VALUES ('1', 'onik','123','$departmentId');


select * from tutor;
select * from specialties;


Select a.tutorname,b.scheduledate,b.scheduletime,c.sname,a.specialties,b.nop
from
tutor a,
schedule b,
specialties c
where 
a.tutorid= b.tutorid
and 
a.specialties = c.id
 