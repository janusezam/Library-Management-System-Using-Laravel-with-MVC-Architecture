# LMS EDU - Library Management System

A modern, full-featured Library Management System built with Laravel 12, designed for efficient tracking and management of books, students, authors, and borrow transactions.

## 📋 Overview

LMS EDU is a comprehensive library management platform that streamlines the process of managing library resources, student borrowing, and inventory tracking. Built with a focus on user experience and functionality, it provides administrators with powerful tools to manage their library operations.

## ✨ Features

### 📚 Core Functionality
- **Student Management** - Register and manage student profiles with borrowing history
- **Book Catalog** - Maintain a comprehensive inventory of books with detailed information
- **Author Management** - Organize and track author profiles and their published works
- **Borrow/Return System** - Track book lending and returns with automatic due date management
- **Overdue Tracking** - Monitor overdue books and calculate fines (₱10.00 per day per book)
- **Real-time Dashboard** - Get at-a-glance insights into system status and key metrics

### 🔐 Security & Access
- **Authentication** - Secure login system powered by Laravel Breeze
- **Role-based Access** - Dedicated librarian interface with proper authorization
- **CSRF Protection** - Built-in protection against cross-site request forgery

## 🛠️ Tech Stack

- **Backend Framework**: Laravel 12
- **PHP Version**: 8.2.12
- **Frontend Styling**: Tailwind CSS 4
- **Database**: MySQL/MariaDB
- **Authentication**: Laravel Breeze v2
- **Testing**: Pest v3 & PHPUnit v11
- **Code Formatting**: Laravel Pint v1
- **Build Tools**: Vite, Node Package Manager

### Additional Libraries
- Laravel Prompts v0
- Laravel Boost v2
- Laravel Pail v1
- Laravel Sail v1
- FakerPHP for data generation

## 📦 Installation

### Prerequisites
- PHP 8.2 or higher
- Composer
- Node.js & npm
- MySQL/MariaDB database
- XAMPP (as indicated by project location)

### Setup Steps

1. **Clone or Navigate to Project**
   ```bash
   cd c:\xampp\htdocs\IT1313_LMS_TAGUD_REY_CASTRO_SAGAYOC_FRANCISCO
   ```

2. **Install PHP Dependencies**
   ```bash
   composer install
   ```

3. **Install Frontend Dependencies**
   ```bash
   npm install
   ```

4. **Configure Environment**
   ```bash
   cp .env.example .env
   php artisan key:generate
   ```

5. **Setup Database**
   ```bash
   php artisan migrate
   php artisan db:seed
   ```

6. **Build Frontend Assets**
   ```bash
   npm run build
   # or for development with hot reload
   npm run dev
   ```

7. **Start Development Server**
   ```bash
   php artisan serve
   ```

   Access the application at `http://localhost:8000`

## 🚀 Usage

### Dashboard
- Navigate to `/dashboard` to view system overview
- See active transactions, student counts, and book statistics

### Student Management
- **View All**: `/students` - List all registered students
- **Create**: `/students/create` - Register a new student
- **Edit**: `/students/{id}/edit` - Update student information

### Book Management
- **View All**: `/books` - Browse complete book catalog
- **Create**: `/books/create` - Add new book to inventory
- **Edit**: `/books/{id}/edit` - Modify book details

### Author Management
- **View All**: `/authors` - List all authors
- **Create**: `/authors/create` - Register new author
- **View Profile**: `/authors/{id}` - See author details and published works

### Borrow System
- **New Transaction**: `/borrows/create` - Create book borrowing transaction
- **View All**: `/borrows` - List all active borrow transactions
- **Return Books**: `/borrows/{id}` - Process book return
- **Overdue Tracking**: `/borrows/overdue` - Monitor overdue items and fines

### Profile
- **Settings**: `/profile` - Update account information, change password, manage security settings

## 📁 Project Structure

```
app/
├── Console/Commands/          # Artisan commands
├── Http/
│   ├── Controllers/           # Application controllers
│   └── Requests/              # Form validation classes
├── Models/                    # Eloquent models
│   ├── Author.php
│   ├── Book.php
│   ├── BorrowTransaction.php
│   ├── BorrowItem.php
│   ├── Student.php
│   └── User.php
└── Providers/

resources/
├── css/app.css               # Application styles
├── js/app.js                 # Application scripts
└── views/                    # Blade templates
    ├── layouts/              # Layout components
    ├── dashboard.blade.php   # Dashboard view
    ├── students/             # Student pages
    ├── books/                # Book pages
    ├── authors/              # Author pages
    ├── borrows/              # Borrow pages
    ├── profile/              # Profile pages
    └── partials/             # Reusable components

database/
├── migrations/               # Database schema files
├── factories/                # Model factories for testing
└── seeders/                  # Database seeders

routes/
├── web.php                   # Web routes
├── auth.php                  # Authentication routes
└── console.php               # Console commands

tests/
├── Feature/                  # Feature tests
├── Unit/                     # Unit tests
└── Pest.php                  # Pest configuration

bootstrap/
├── app.php                   # Application configuration
└── providers.php             # Service providers
```

## 🗄️ Database Models

### Student
- ID, Name, Student ID, Email, Contact Information

### User (Librarian)
- ID, Name, Email, Password, Profile Settings

### Author
- ID, Name, Bio, Publication Records

### Book
- ID, Title, ISBN, Genre, Published Year, Total Copies, Available Copies
- Foreign Key: Author ID

### BorrowTransaction
- ID, Student ID, Borrow Date, Due Date, Return Date, Status
- Foreign Key: Student ID

### BorrowItem
- ID, Transaction ID, Book ID, Status (borrowed/returned)
- Foreign Key: Transaction ID, Book ID

## 🧪 Testing

Run tests using Pest:

```bash
# Run all tests
php artisan test

# Run with compact output
php artisan test --compact

# Run specific test
php artisan test --filter=testName
```

## 🎨 Styling & Development

### Tailwind CSS
The project uses Tailwind CSS v4 for styling. Customize styles in:
- `tailwind.config.js` - Tailwind configuration
- `resources/css/app.css` - Global styles
- Inline Tailwind classes in Blade templates

### Frontend Development
```bash
# Development mode with hot reload
npm run dev

# Production build
npm run build
```

## 📝 Code Quality

Keep code clean and consistent:

```bash
# Format code with Laravel Pint
vendor/bin/pint

# Format specific file
vendor/bin/pint path/to/file.php
```

## 👥 Contributors

**IT1313 Project Team:**
- TAGUD
- REY
- CASTRO
- SAGAYOC
- FRANCISCO

## 📄 License

This project is part of IT1313 coursework and is provided as-is for educational purposes.

## 🔧 Troubleshooting

### Vite Manifest Error
If you see "Unable to locate file in Vite manifest" error:
```bash
npm run build
# or
npm run dev
```

### Database Connection Issues
Ensure your `.env` file has correct database credentials:
```
DB_CONNECTION=mysql
DB_HOST=127.0.0.1
DB_PORT=3306
DB_DATABASE=your_database
DB_USERNAME=your_username
DB_PASSWORD=your_password
```

### Missing Dependencies
```bash
composer install
npm install
```

## 📞 Support

For issues or questions about the system, contact the development team or refer to the Laravel documentation at https://laravel.com

---

**Version**: 1.0.0  
**Last Updated**: February 2026  
**Status**: Active Development
