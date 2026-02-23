<?php

namespace App\Http\Controllers;

use App\Http\Requests\StoreAuthorRequest;
use App\Http\Requests\UpdateAuthorRequest;
use App\Models\Author;
use Illuminate\Http\RedirectResponse;
use Illuminate\View\View;

class AuthorController extends Controller
{
    public function index(): View
    {
        $authors = Author::withCount('books')->paginate(10);

        return view('authors.index', compact('authors'));
    }

    public function create(): View
    {
        return view('authors.create');
    }

    public function store(StoreAuthorRequest $request): RedirectResponse
    {
        Author::create($request->validated());

        return redirect()->route('authors.index')->with('success', 'Author created successfully.');
    }

    public function show(Author $author): View
    {
        $author->load('books');

        return view('authors.show', compact('author'));
    }

    public function edit(Author $author): View
    {
        return view('authors.edit', compact('author'));
    }

    public function update(UpdateAuthorRequest $request, Author $author): RedirectResponse
    {
        $author->update($request->validated());

        return redirect()->route('authors.show', $author)->with('success', 'Author updated successfully.');
    }

    public function destroy(Author $author): RedirectResponse
    {
        $author->delete();

        return redirect()->route('authors.index')->with('success', 'Author deleted successfully.');
    }
}
