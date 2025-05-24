# Invoice Management System
## Overview
This Laravel-based Invoice Management System is designed to streamline invoicing, customer tracking, and reporting within organizations. It offers a robust set of features for efficient billing operations, document management, and analytics — all within a secure, role-based access environment.
## Features
- **Scalable Architecture:** Built for performance and future expansion.
- **Authentication & RBAC:** Secure login with role-based access control using Laravel’s middleware.
- **Invoice CRUD Operations:** Create, view, update, and delete invoices easily.
- **Customer Management:** Track customers and associate them with invoices.
- **Attachment Handling:** Upload and manage invoice-related documents.
- **Status Tracking:** Update and monitor invoice payment status (e.g., Paid, Unpaid, Overdue).
- **Reporting & Analytics:** Visual reports with advanced filtering and real-time data insights.
- **Export & Print:** Generate PDFs and print invoices directly from the interface.
- **Notifications** Real-time system notifications to keep users updated.
## Technologies Used
- **Backend:** Laravel PHP Framework
- **Frontend:** HTML, CSS, JavaScript,Blade, Bootstrap
- **Database:** MySQL
## Installation
1. Clone the repository
```bash
git clone https://github.com/Abdelrahmans123/InvoiceManagementSystem.git
```
2. Navigate to the directory
```bash
cd InvoiceManagementSystem
```
3. Install dependencies
```bash
composer install
```
4. Set up your .env file. You can copy the .env.example to .env
```bash
copy .env.example .env
```
5. Set up your database connection in the .env file by updating the database settings
```bash
DB_CONNECTION=mysql
DB_HOST=127.0.0.1
DB_PORT=3306
DB_DATABASE=task_management_db
DB_USERNAME=root
DB_PASSWORD=
```
6. Generate the application key
```bash
php artisan key:generate
```
7. Run database migrations to create the necessary tables
```bash
php artisan migrate
```
8. Seed database
```bash
php artisan db:seed
```
9. Install React dependencies using npm:
```bash
npm install
```
10. Start the Laravel development server
```bash
php artisan serve
```
This will start the server at http://127.0.0.1:8000.
## Contributing
Contributions are welcome! Please fork the repository and submit a pull request with your changes.
## License
This project is licensed under the MIT License.
## Support
For support or inquiries, please contact [sabdelrahman110@gmail.com](mailto:sabdelrahman110@gmail.com).
