<?php

namespace App\Http\Controllers;

use Illuminate\Routing\Controller;
use Illuminate\Http\Response;
use Illuminate\Http\Request;
use App\Repositories\BookRepository;
use Illuminate\Database\Eloquent\Model;
use App\Models\Book;
use Illuminate\Http\UploadedFile;
use Illuminate\Support\Facades\DB;
use Illuminate\Support\Facades\Log;

class BookController extends Controller
{
    /**
     * BookRepository
     */
    protected $bookRepository;

    /**
     *
     * @param  BookRepository  $bookRepository
     * @return void
     */
    public function __construct(BookRepository $bookRepository)
    {
        $this->bookRepository = $bookRepository;
    }

    /**
     * @param Request $request
     */
    public function index(Request $request)
    {
        $token = null;
        $token = intval($request->query('page_token'));

        $bookList = $this->bookRepository->listBooks(10, $token);
        return view('list', [
            'books' => $bookList['books'],
            'next_page_token' => $bookList['cursor'],
        ]);
    }

    /**
     */
    public function add()
    {
        $action = "Add";
        $book = new Book();

        return view('form', [
            'action' => $action,
            'book' => $book,
        ]);
    }

    /**
     * @param Request $request
     */
    public function create(Request $request)
    {
        $id = "";
        $files = $request->file('image');
        $book = $request->all();
        if ($request->hasFile('image') && $files->isValid()) {
            $files->storeAs('public/images', urlencode($files->getClientOriginalName()));
            $book['image_url'] = '/images/' . $files->getClientOriginalName();
        }
        if (!empty($user = $request->session()->get('user'))) {
            $book['created_by'] = $user['name'];
            $book['created_by_id'] = $user['id'];
        }

        DB::beginTransaction();
        try {
            $books   = new Book();
            $books->title          = $book['title'];
            $books->author         = $book['author'];
            $books->published_date = $book['published_date'];
            $books->description    = $book['description'];
            $books->image_url      = $book['image_url'];
            if (!empty($user)) {
                $books->created_by = $book['created_by'];
                $books->created_by_id = $book['created_by_id'];
            }
            $books->save();
        } catch (\Throwable $e) {
            DB::rollBack();
        }
        DB::commit();
   
        return redirect('/books/' . $books->id);
    }

    /**
     * @param int    $id
     */
    public function view(int $id)
    {
        $book = $this->bookRepository->read($id);

        return view('view', ['book' => $book]);
    }

    /**
     * @param int    $id
     */
    public function edit(int $id)
    {
        $action = "Edit";
        $book = $this->bookRepository->read($id);

        return view('form', ['action' => $action, 'book' => $book]);
    }

    /**
     * @param Request $request
     * @param int    $id
     */
    public function update(int $id, Request $request)
    {
        $book = $request->all();
        $book['id'] = $id;

        $files = $request->file('image');
        if ($request->hasFile('image') && $files->isValid()) {
            $files->storeAs('public/images', urlencode($files->getClientOriginalName()));
            $book['image_url'] = '/images/' . $files->getClientOriginalName();
        }
        if (!empty($user = $request->session()->get('user'))) {
            $book['created_by'] = $user['name'];
            $book['created_by_id'] = $user['id'];
        }

        $this->bookRepository->update($book);

        return redirect('/books/' . $id);
    }

    /**
     * @param int    $id
     */
    public function delete(int $id)
    {
        $book = $this->bookRepository->read($id);
        if (!empty($book)) {
            $this->bookRepository->delete($id);
            unlink(config('filesystems.disks.public.root') . $book->image_url);
        }
        
        return redirect('/books/');
    }
}
