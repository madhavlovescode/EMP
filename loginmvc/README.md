EMPLOYEE MANAGEMENT SYSTEM
Employees to manage tasks, profiles, and employee data efficiently.

-Features
Admin, Team Lead, and Employee login

Add, update, delete employee records

Assign tasks to employees

Update task status (Pending, In Progress, Complete)

View task and employee details

Upload and update profile images

Role-based dashboard and access control

- Tech Stack
Language: PHP

Database: MySQL

Architecture: MVC (Model-View-Controller)

Frontend: HTML, BOOTSTRAP  

Server: Apache (XAMPP or similar)

- Project Structure

/config         -> Database connection  
/controller     -> Business logic  
/model          -> Database queries  
/view           -> HTML + PHP UI files  
/image          -> Images  
index.php       -> Entry point\


- Setup Instructions
Clone this repository.

Create a database in MySQL (import the test.sql file if provided).

Update DB credentials in /config/db.php.

Run the project using a local server (e.g., XAMPP).

Access the project via http://localhost/your_project_folder/.

- Login Roles
Admin – Full access to manage users and tasks.

Team Lead – Can assign and review tasks.

Employee – Can view and update their tasks.

- Notes
Keep session management and authentication secure.

MVC helps in code reusability and cleaner separation of logic and views.

