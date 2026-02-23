<?php

namespace App\Http\Controllers;

use App\Http\Requests\ReturnBooksRequest;
use App\Http\Requests\StoreBorrowRequest;
use App\Models\Book;
use App\Models\BorrowItem;
use App\Models\BorrowTransaction;
use App\Models\Student;
use Carbon\Carbon;
use Illuminate\Http\RedirectResponse;
use Illuminate\View\View;

class BorrowController extends Controller
{
    public function index(): View
    {
        $transactions = BorrowTransaction::query()
            ->with('student', 'borrowItems.book')
            ->paginate(10);

        return view('borrows.index', compact('transactions'));
    }

    public function create(): View
    {
        $students = Student::orderBy('name')->get();
        $books = Book::query()
            ->where('available_copies', '>', 0)
            ->orderBy('title')
            ->get();

        return view('borrows.create', compact('students', 'books'));
    }

    public function store(StoreBorrowRequest $request): RedirectResponse
    {
        $validated = $request->validated();
        $bookIds = $validated['books'];

        // Check availability
        foreach ($bookIds as $bookId) {
            $book = Book::find($bookId);
            if (! $book->isAvailable()) {
                return back()->withErrors(['book' => "The book \"{$book->title}\" is not available."]);
            }
        }

        $transaction = BorrowTransaction::create([
            'student_id' => $validated['student_id'],
            'borrow_date' => Carbon::today(),
            'due_date' => $validated['due_date'],
            'status' => 'active',
        ]);

        foreach ($bookIds as $bookId) {
            BorrowItem::create([
                'borrow_transaction_id' => $transaction->id,
                'book_id' => $bookId,
                'status' => 'borrowed',
                'fine' => 0,
            ]);

            Book::find($bookId)->decrement('available_copies');
        }

        return redirect()->route('borrows.show', $transaction)->with('success', 'Borrow transaction created successfully.');
    }

    public function show(BorrowTransaction $borrow): View
    {
        $borrow->load('student', 'borrowItems.book');

        $totalFine = 0;
        foreach ($borrow->borrowItems as $item) {
            $fine = $item->computeFine();
            $item->fine = $fine;
            $totalFine += $fine;
        }

        return view('borrows.show', compact('borrow', 'totalFine'));
    }

    public function returnBooks(ReturnBooksRequest $request, BorrowTransaction $borrow): RedirectResponse
    {
        $validated = $request->validated();
        $itemIds = $validated['items'];

        foreach ($itemIds as $itemId) {
            $item = BorrowItem::find($itemId);

            if ($item->borrow_transaction_id !== $borrow->id || $item->status !== 'borrowed') {
                continue;
            }

            $fine = $item->computeFine();
            $item->update([
                'fine' => $fine,
                'returned_date' => Carbon::today(),
                'status' => 'returned',
            ]);

            $item->book()->increment('available_copies');
        }

        $borrow->refresh();
        $activeItems = $borrow->activeItems();

        if (count($activeItems) === 0) {
            $borrow->update([
                'status' => 'completed',
                'returned_date' => Carbon::today(),
            ]);
        } else {
            $borrow->update([
                'status' => 'partially_returned',
            ]);
        }

        $borrow->update([
            'total_fine' => $borrow->computeTotalFine(),
        ]);

        return redirect()->route('borrows.show', $borrow)->with('success', 'Books returned successfully.');
    }

    public function overdue(): View
    {
        $transactions = BorrowTransaction::query()
            ->where('due_date', '<=', Carbon::today())
            ->whereIn('status', ['active', 'partially_returned'])
            ->with('student', 'borrowItems.book')
            ->latest()
            ->paginate(10);

        return view('borrows.overdue', compact('transactions'));
    }
}
