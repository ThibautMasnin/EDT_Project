EDT_Project: MVC+OOP


Set your root url in config

put view/page/header.php on top of every view (header contains middleware/routes to validate url 
and inject data queried from model into view)
put middleware/auth.php after routes if the view is only allowed for authorized users
put view/page/footer.php at the end of every view


Model: operations on db
Controller: inject data into view, each time controller gets the data from model, store db response in session["db_res"].
View:display content, footer will unset session["db_res"] at the end of page.


edt.db- Table users
Manually insert a record for admin (username:admin, password:123456)
md5(123456)=e10adc3949ba59abbe56e057f20f883e
password is store as md5 value to mimic encrypt and decrypt
level: 0 for admin, 1 for professor, 2 for student
promotion: [0-4] for L1-M2