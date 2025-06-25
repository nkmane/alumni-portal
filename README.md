# 🎓 Alumni Connect Portal

A PHP-based mini project that connects students and alumni for messaging, chatting, and networking. Built using HTML, CSS, JavaScript, PHP, and MySQL.

## 🔧 Features
- User Registration & Login (Student & Alumni)
- Role-based Dashboard
- Send & Receive Messages
- Inbox with Replies
- Chat System with Notification
- Profile Picture Upload
- Admin Panel


## 🚀 Technologies Used

| Stack            | Tools                            |
|------------------|----------------------------------|
| **Frontend**     | HTML, CSS, JavaScript            |
| **Backend**      | PHP (Core PHP, no frameworks)    |
| **Database**     | MySQL                            |
| **Server**       | XAMPP / Apache                   |


## 📁 Folder Structure

alumni-portal/
├── index.php
├── login.php
├── register.php
├── dashboard.php
├── inbox.php
├── send_message.php
├── alumni.php
├── profile_edit.php
├── assets/
│ ├── css/
│ └── js/
├── uploads/ ← profile photos
├── includes/
│ ├── header.php
│ └── footer.php
├── db_sample.php ← (sample DB config)
├── database/
│ └── portal.sql ← (import this in phpMyAdmin)


## ⚙️ Setup Instructions

1. **Clone or Download** this repository.
2. Move the folder to `C:/xampp/htdocs/`
3. Import the SQL file:
   - Open [http://localhost/phpmyadmin](http://localhost/phpmyadmin)
   - Create a new database (e.g. `alumni_portal`)
   - Import `database/portal.sql`
4. Create your own `db.php`:
   - Use `db_sample.php` as reference
   - Update with your DB name, username, and password
5. Start XAMPP, and visit:
http://localhost/alumni-portal/


## 🧪 Sample Users for Testing

| Role     | Email                 | Password  |
|----------|------------------------|-----------|
| Admin    | admin@example.com      | admin123  |
| Alumni   | nitin@gmail.com        | 12345     |
| Student  | neha@gmail.com         | 123456    |



## 📁 Note
This repository contains code only (no sensitive files or database dump). You can create your own DB using the structure.

## 👩‍💻 Developed By
Nikita Dhondiram Mane – MCA Student  

## 📄 License

This project is licensed for academic and learning purposes.

