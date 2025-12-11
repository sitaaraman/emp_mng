
# Employee Management System (PHP + MySQL + Bootstrap 5)

A lightweight Employee Management System built using pure PHP, MySQL, and Bootstrap 5.  
Includes full CRUD for Country, State, and Employees with backend-only Country → State dependent dropdowns (no JavaScript or AJAX).

## Features
- Manage Countries (Add, Edit, Delete)
- Manage States with Country relation
- Manage Employees with State & Country selection
- Address preview using `<abbr>`
- Uses only `$conn->query()` (no mysqli_query, no JS)

## Technologies Used
- PHP  
- MySQL  
- Bootstrap 5  

## How to Run
1. Download or clone the project into `htdocs`
2. Create database `emp_mng`
3. Import the SQL tables for country, state, employee
4. Start Apache & MySQL in XAMPP
5. Open in browser:


## Notes
This project uses **no JavaScript, no AJAX, no frameworks** — completely PHP backend-driven.

