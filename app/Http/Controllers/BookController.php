<?php

namespace App\Http\Controllers;

use App\Http\Requests\StoreBookRequest;
use App\Http\Requests\UpdateBookRequest;
use App\Models\Author;
use App\Models\Book;
use App\Models\BorrowItem;
use Illuminate\Http\RedirectResponse;
use Illuminate\View\View;

class BookController extends Controller
{
    public function index(): View
    {
        $books = Book::with('authors')->paginate(10);

        return view('books.index', compact('books'));
    }

    public function create(): View
    {
        $authors = Author::orderBy('name')->get();

        return view('books.create', compact('authors'));
    }

    public function store(StoreBookRequest $request): RedirectResponse
    {
        $data = $request->validated();
        $authorIds = $data['authors'];
        unset($data['authors']);

        $data['available_copies'] = $data['total_copies'];

        $book = Book::create($data);
        $book->authors()->attach($authorIds);

        return redirect()->route('books.index')->with('success', 'Book created successfully.');
    }

    public function show(Book $book): View
    {
        $book->load('authors', 'borrowItems');

        return view('books.show', compact('book'));
    }

    public function edit(Book $book): View
    {
        $authors = Author::orderBy('name')->get();
        $selectedAuthors = $book->authors()->pluck('authors.id')->toArray();

        return view('books.edit', compact('book', 'authors', 'selectedAuthors'));
    }

    public function update(UpdateBookRequest $request, Book $book): RedirectResponse
    {
        $data = $request->validated();
        $authorIds = $data['authors'];
        unset($data['authors']);

        $borrowedCopies = BorrowItem::query()
            ->where('book_id', $book->id)
            ->where('status', 'borrowed')
            ->count();

        $data['available_copies'] = $data['total_copies'] - $borrowedCopies;

        $book->update($data);
        $book->authors()->sync($authorIds);

        return redirect()->route('books.show', $book)->with('success', 'Book updated successfully.');
    }

    public function destroy(Book $book): RedirectResponse
    {
        $book->delete();

        return redirect()->route('books.index')->with('success', 'Book deleted successfully.');
    }
}
