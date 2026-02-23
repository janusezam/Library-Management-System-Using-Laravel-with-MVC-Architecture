<?php

namespace Database\Seeders;

use App\Models\Author;
use App\Models\Book;
use App\Models\BorrowItem;
use App\Models\BorrowTransaction;
use App\Models\Student;
use App\Models\User;
use Carbon\Carbon;
use Illuminate\Database\Console\Seeds\WithoutModelEvents;
use Illuminate\Database\Seeder;

class DatabaseSeeder extends Seeder
{
    use WithoutModelEvents;

    /**
     * Seed the application's database.
     */
    public function run(): void
    {
        // 1. Create admin user
        User::firstOrCreate(
            ['email' => 'admin@library.com'],
            [
                'name' => 'Admin Librarian',
                'email_verified_at' => now(),
                'password' => bcrypt('password'),
                'remember_token' => null,
            ]
        );

        // 2. Create authors
        $rizal = Author::create([
            'name' => 'Jose Rizal',
            'email' => null,
            'bio' => 'National hero and novelist of the Philippines',
        ]);

        $fitzgerald = Author::create([
            'name' => 'F. Scott Fitzgerald',
            'email' => null,
            'bio' => 'American novelist known for The Great Gatsby',
        ]);

        $orwell = Author::create([
            'name' => 'George Orwell',
            'email' => null,
            'bio' => 'English novelist known for dystopian fiction',
        ]);

        $rowling = Author::create([
            'name' => 'J.K. Rowling',
            'email' => null,
            'bio' => 'British author of the Harry Potter series',
        ]);

        // 3. Create books and attach authors
        $noliMeTangere = Book::create([
            'isbn' => '978-971-001',
            'title' => 'Noli Me Tangere',
            'genre' => 'Historical Fiction',
            'published_year' => 1887,
            'total_copies' => 5,
            'available_copies' => 5,
        ]);
        $noliMeTangere->authors()->sync([$rizal->id]);

        $elFilibusterismo = Book::create([
            'isbn' => '978-971-002',
            'title' => 'El Filibusterismo',
            'genre' => 'Historical Fiction',
            'published_year' => 1891,
            'total_copies' => 4,
            'available_copies' => 4,
        ]);
        $elFilibusterismo->authors()->sync([$rizal->id]);

        $gatsby = Book::create([
            'isbn' => '978-001-003',
            'title' => 'The Great Gatsby',
            'genre' => 'Classic Fiction',
            'published_year' => 1925,
            'total_copies' => 3,
            'available_copies' => 3,
        ]);
        $gatsby->authors()->sync([$fitzgerald->id]);

        $nineteenEightyFour = Book::create([
            'isbn' => '978-001-004',
            'title' => '1984',
            'genre' => 'Dystopian Fiction',
            'published_year' => 1949,
            'total_copies' => 4,
            'available_copies' => 4,
        ]);
        $nineteenEightyFour->authors()->sync([$orwell->id]);

        $animalFarm = Book::create([
            'isbn' => '978-001-005',
            'title' => 'Animal Farm',
            'genre' => 'Political Satire',
            'published_year' => 1945,
            'total_copies' => 3,
            'available_copies' => 3,
        ]);
        $animalFarm->authors()->sync([$orwell->id]);

        $harryPotter = Book::create([
            'isbn' => '978-001-006',
            'title' => 'Harry Potter and the Sorcerer\'s Stone',
            'genre' => 'Fantasy',
            'published_year' => 1997,
            'total_copies' => 5,
            'available_copies' => 5,
        ]);
        $harryPotter->authors()->sync([$rowling->id]);

        // 4. Create students
        $maria = Student::create([
            'student_id' => '2021-00101',
            'name' => 'Maria Santos',
            'email' => 'maria@student.edu',
            'course' => 'BSIT',
            'year_level' => 3,
            'contact_number' => '09171234567',
        ]);

        $juan = Student::create([
            'student_id' => '2021-00102',
            'name' => 'Juan Dela Cruz',
            'email' => 'juan@student.edu',
            'course' => 'BSCS',
            'year_level' => 2,
            'contact_number' => '09181234567',
        ]);

        $ana = Student::create([
            'student_id' => '2022-00201',
            'name' => 'Ana Reyes',
            'email' => 'ana@student.edu',
            'course' => 'BSN',
            'year_level' => 1,
            'contact_number' => '09191234567',
        ]);

        $pedro = Student::create([
            'student_id' => '2022-00202',
            'name' => 'Pedro Lim',
            'email' => 'pedro@student.edu',
            'course' => 'BSIT',
            'year_level' => 4,
            'contact_number' => '09201234567',
        ]);

        $rosa = Student::create([
            'student_id' => '2023-00301',
            'name' => 'Rosa Garcia',
            'email' => 'rosa@student.edu',
            'course' => 'BSCS',
            'year_level' => 1,
            'contact_number' => '09211234567',
        ]);

        // 5. Create borrow transactions

        // Transaction 1 - Active (not overdue)
        $transaction1 = BorrowTransaction::create([
            'student_id' => $maria->id,
            'borrow_date' => Carbon::today(),
            'due_date' => Carbon::today()->addDays(7),
            'status' => 'active',
            'total_fine' => 0,
        ]);

        BorrowItem::create([
            'borrow_transaction_id' => $transaction1->id,
            'book_id' => $noliMeTangere->id,
            'status' => 'borrowed',
            'fine' => 0,
        ]);

        BorrowItem::create([
            'borrow_transaction_id' => $transaction1->id,
            'book_id' => $gatsby->id,
            'status' => 'borrowed',
            'fine' => 0,
        ]);

        $noliMeTangere->decrement('available_copies');
        $gatsby->decrement('available_copies');

        // Transaction 2 - Overdue (still active)
        $transaction2 = BorrowTransaction::create([
            'student_id' => $juan->id,
            'borrow_date' => Carbon::today()->subDays(10),
            'due_date' => Carbon::today()->subDays(3),
            'status' => 'active',
            'total_fine' => 0,
        ]);

        BorrowItem::create([
            'borrow_transaction_id' => $transaction2->id,
            'book_id' => $nineteenEightyFour->id,
            'status' => 'borrowed',
            'fine' => 0,
        ]);

        BorrowItem::create([
            'borrow_transaction_id' => $transaction2->id,
            'book_id' => $animalFarm->id,
            'status' => 'borrowed',
            'fine' => 0,
        ]);

        $nineteenEightyFour->decrement('available_copies');
        $animalFarm->decrement('available_copies');

        // Transaction 3 - Completed (all returned)
        $transaction3 = BorrowTransaction::create([
            'student_id' => $ana->id,
            'borrow_date' => Carbon::today()->subDays(14),
            'due_date' => Carbon::today()->subDays(7),
            'returned_date' => Carbon::today()->subDays(8),
            'status' => 'completed',
            'total_fine' => 0,
        ]);

        BorrowItem::create([
            'borrow_transaction_id' => $transaction3->id,
            'book_id' => $elFilibusterismo->id,
            'returned_date' => Carbon::today()->subDays(8),
            'status' => 'returned',
            'fine' => 0,
        ]);

        BorrowItem::create([
            'borrow_transaction_id' => $transaction3->id,
            'book_id' => $harryPotter->id,
            'returned_date' => Carbon::today()->subDays(8),
            'status' => 'returned',
            'fine' => 0,
        ]);
    }
}
