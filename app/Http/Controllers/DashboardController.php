<?php

namespace App\Http\Controllers;

use App\Models\Author;
use App\Models\Book;
use App\Models\BorrowTransaction;
use App\Models\Student;
use Carbon\Carbon;
use Illuminate\View\View;

class DashboardController extends Controller
{
    public function index(): View
    {
        $totalBooks = Book::count();
        $totalStudents = Student::count();
        $totalAuthors = Author::count();

        $activeBorrows = BorrowTransaction::query()
            ->whereIn('status', ['active', 'partially_returned'])
            ->count();

        $overdueTransactions = BorrowTransaction::query()
            ->where('due_date', '<', Carbon::today())
            ->whereIn('status', ['active', 'partially_returned'])
            ->count();

        $availableBooks = Book::query()
            ->where('available_copies', '>', 0)
            ->count();

        $recentTransactions = BorrowTransaction::query()
            ->with('student')
            ->latest()
            ->limit(5)
            ->get();

        return view('dashboard', [
            'totalBooks' => $totalBooks,
            'totalStudents' => $totalStudents,
            'totalAuthors' => $totalAuthors,
            'activeBorrows' => $activeBorrows,
            'overdueTransactions' => $overdueTransactions,
            'availableBooks' => $availableBooks,
            'recentTransactions' => $recentTransactions,
        ]);
    }
}
