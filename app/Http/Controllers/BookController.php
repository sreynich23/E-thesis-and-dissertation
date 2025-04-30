<?php

namespace App\Http\Controllers;

use App\Models\Book;
use App\Models\Cover;
use App\Models\Generation;
use App\Models\Major;
use App\Models\Student;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Log;
use Illuminate\Support\Facades\Storage;
use setasign\Fpdi\Tcpdf\Fpdi;

class BookController extends Controller
{
    public function index()
    {
        $generations = Book::all()->groupBy('generation');
        $years = Book::all()->groupBy('year');
        $books = Book::all();
        $majors = Major::all();
        $groupedMajors = Major::all()->groupBy('degree_level');
        $groupedBooks = Book::all()->groupBy('id_majors');
        $students = Student::all();
        $covers = Cover::all();
        $bookCount = $books->count();
        return view('book.home', compact('books', 'groupedMajors', 'students', 'majors', 'groupedBooks', 'generations', 'years', 'covers','bookCount'));
    }
    public function show($id)
    {
        $generations = Book::all()->groupBy('generation');
        $years = Book::all()->groupBy('year');
        $books = Book::all();
        $majors = Major::all();
        $groupedMajors = Major::all()->groupBy('degree_level');
        $groupedBooks = Book::all()->join('id_majors');
        $book = Book::findOrFail($id);
        return view('book.show', compact('book', 'groupedMajors', 'majors', 'groupedBooks', 'generations', 'years'));
    }
    public function showMajor($id)
    {
        $major = Major::findOrFail($id);
        $books = Book::where('id_majors', $id)->get();
        return view('book.showAllMajor', compact('major', 'books'));
    }
    public function indexAdmin()
    {
        $generations = Book::all()->groupBy('generation');
        $years = Book::all()->groupBy('year');
        $books = Book::all();
        $majors = Major::all();
        $groupedMajors = Major::all()->groupBy('degree_level');
        $groupedBooks = Book::all()->groupBy('id_majors');
        $students = Student::all();
        $covers = Cover::all();
        return view('admin.dashboard', compact('books', 'groupedMajors', 'students', 'majors', 'groupedBooks', 'generations', 'years', 'covers'));
    }
    public function showAdmin($id)
    {
        $book = Book::findOrFail($id);
        return view('admin.dashboard', compact('book'));
    }

    public function book_Create(Request $request)
    {
        $request->validate([
            'title' => 'required|string|max:255',
            'id_majors' => 'required|integer',
            'generations' => 'nullable|string',
            'year' => 'required|integer',
            'path_file' => 'nullable|file|mimes:pdf|max:102400',
        ]);

        $existingBook = Book::where('title', $request->title)->first();

        if ($existingBook) {
            return redirect()->back()->withErrors(['title' => 'A book with this title already exists.'])->withInput();
        }

        $book = Book::create([
            'title' => $request->title,
            'id_majors' => $request->id_majors,
            'generation' => $request->generations,
            'year' => $request->year,
            'path_file' => $request->hasFile('path_file') ? $request->file('path_file')->store('pdf_books', 'public') : null,
        ]);

        return redirect()->back()->with('success', 'Book uploaded successfully!');
    }
    public function create_major(Request $request)
    {
        $major = Major::create([
            'title' => $request->title,
        ]);
        $major->save();

        return redirect()->back()->with('success', 'Major uploaded successfully!');
    }
    public function searchBooks(Request $request)
    {
        $query = Book::query()->with('major');

        if ($request->major_id) {
            $query->where('id_majors', $request->major_id);
        }

        if ($request->generation) {
            $query->where('generation', $request->generation);
        }

        if ($request->year) {
            $query->where('year', $request->year);
        }

        if ($request->title) {
            $query->where('title', 'like', '%' . $request->title . '%');
        }

        $books = $query->get();
        $majors = Major::all();
        $generations = Book::all()->groupBy('generation');
        $years = Book::all()->groupBy('year');

        return view('book.home', compact('books', 'majors', 'generations', 'years'));
    }

    public function download($id)
    {
        $book = Book::findOrFail($id);

        if (!$book->path_file) {
            return redirect()->back()->with('error', 'File not found.');
        }

        $filePath = public_path('storage/' . $book->path_file);

        if (!file_exists($filePath)) {
            return redirect()->back()->with('error', 'File not found.');
        }

        return response()->download($filePath, $book->title . '.pdf');
    }

    public function updateBook($id, Request $request)
    {
        $request->validate([
            'title' => 'required|string|max:255',
            'id_majors' => 'required|integer',
            'generations' => 'nullable|string',
            'year' => 'required|integer',
            'path_file' => 'nullable|file|mimes:pdf|max:102400',
        ]);

        $book = Book::findOrFail($id);

        if ($request->hasFile('path_file')) {
            // Delete the old file if it exists
            if ($book->path_file) {
                Storage::disk('public')->delete($book->path_file);
            }

            // Store the new file
            $book->path_file = $request->file('path_file')->store('pdf_books', 'public');
        }

        $book->title = $request->title;
        $book->id_majors = $request->id_majors;
        $book->generation = $request->generations;
        $book->year = $request->year;
        $book->save();

        return redirect()->back()->with('success', 'Book updated successfully!');
    }

    public function updateMajor($id, Request $request)
    {
        $request->validate([
            'major_name' => 'required|string|max:255',
            'khmer_name' => 'required|string|max:255',
            'degree_level' => 'required|string|max:255',
        ]);

        $major = Major::findOrFail($id);
        $major->major_name = $request->major_name;
        $major->khmer_name = $request->khmer_name;
        $major->degree_level = $request->degree_level;
        $major->save();

        return redirect()->back()->with('success', 'Major updated successfully!');
    }
}
