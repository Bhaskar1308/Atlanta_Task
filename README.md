# 👥 Laravel 10 - Team Management CRUD (AJAX + DataTables)

A full-stack Laravel 10 project to manage your team members using **AJAX**, **Yajra DataTables**, **Bootstrap 5 modals**, and **image uploads**. The UI is clean, modern, and responsive — with real-time updates and no page reloads.

---

## 🚀 Features

- ✅ Add / Edit / Delete team members in a modal
- ✅ Image upload with preview
- ✅ Server-side DataTables integration (Yajra)
- ✅ Form validation with error messages
- ✅ Professional Bootstrap 5 UI design
- ✅ All frontend assets via CDN (no Node.js required)

---

## 🛠️ Tech Stack

- **Laravel 10**
- **Yajra Laravel DataTables v10**
- **Bootstrap 5.3**
- **jQuery**
- **AJAX**
- **MySQL**


Installation Steps
✅ 1. Clone the Repository
bash
Copy
Edit
git clone https://github.com/your-username/your-repo.git
cd your-repo


✅ 2. Install PHP Dependencies
Make sure you have Composer installed.

bash
Copy
Edit


composer install
✅ 3. Setup Environment & App Key
bash
cp .env.example .env
php artisan key:generate
🔧 Update your .env file with your database credentials:

env
DB_DATABASE=your_database
DB_USERNAME=your_username
DB_PASSWORD=your_password


✅ 4. Run Migrations
bash
php artisan migrate
This will create the necessary tables in your database.

✅ 5. Start the Local Development Server
bash
php artisan serve
Visit the application at: http://localhost:8000/


