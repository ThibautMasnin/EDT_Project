EDT_Project: MVC+OOP



put view/page/app.php and view/page/header.php on top of every view (header contains middleware/routes to validate url 
and inject data queried from model into view)
put middleware/auth.php after routes if the view is only allowed for authorized users
put view/page/footer.php at the end of every view


Model: operations on db
Controller: apply business logic to inject data into view, each time controller gets the data from model
View:display content

each form post request should includes 2 embedded hidden inputs with name="controller" and name="action"
routes in the header will point to responding controller and action(method)

edt.db- Table users
Manually insert a record for admin (username:admin, password:123456)
hashage: bcrypt
level: 0 for admin, 1 for professor, 2 for student
promotion: [0-4] for L1-M2


TO CODE:

focus on 3 folders: controller, model and view

each time, create a table matched with a model and controller, and a subfolder with model name 
for all the views responding to that model
model name+Controller = Controller name

In the controller, call returnView("page name") if you need to redirect page
