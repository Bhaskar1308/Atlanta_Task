Project Setup Guide
Follow the steps below to set up and run the Laravel 10 Team Management CRUD application using DataTables, Bootstrap, and AJAX.

🛠️ Prerequisites
Ensure the following are installed on your system:

PHP 8.1 or higher

Composer

MySQL

Laravel 10


📂 Installation Steps
Clone the Repository

bash
Copy
Edit
git clone https://github.com/your-username/your-repo.git
cd your-repo
Install PHP Dependencies

bash
Copy
Edit
composer install
Environment Configuration

Copy the example .env file:

bash
Copy
Edit
cp .env.example .env
Generate the application key:

bash
Copy
Edit
php artisan key:generate
Configure the Database

Open .env and update the database credentials:

env
Copy
Edit
DB_DATABASE=your_database
DB_USERNAME=your_db_user
DB_PASSWORD=your_db_password
Run Migrations

bash
Copy
Edit
php artisan migrate
Serve the Application

bash
Copy
Edit
php artisan serve
Access the Application

Open your browser and visit:

bash
Copy
Edit
http://localhost:8000/
📸 Features Summary
Server-side DataTable with pagination, search, and sorting.

Bootstrap 5 styled modal popup for create/edit forms.

AJAX form submissions with validation.

Photo upload and real-time image rendering in the table.

Clean, responsive UI with no page reloads.
