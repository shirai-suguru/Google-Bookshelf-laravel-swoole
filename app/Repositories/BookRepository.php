<?php

namespace App\Repositories;

use Illuminate\Database\Eloquent\Model;
use App\Models\Book;

class BookRepository
{
    public function listBooks($limit = 10, $cursor = null)
    {
        $rows = [];
        $new_cursor = null;
        $books = null;
        if ($cursor) {
            $books = Book::where('id', '>', $cursor)
                ->orderBy('id')
                ->limit($limit + 1)
                ->get();
        } else {
            $books = Book::orderBy('id')
                ->limit($limit + 1)
                ->get();
        }
    
        $last_row = null;
        foreach ($books as $row) {
            if (count($rows) == $limit) {
                $new_cursor = $last_row['id'];
                break;
            }
            array_push($rows, $row);
            $last_row = $row;
        }
        return [
            'books' => $rows,
            'cursor' => $new_cursor,
        ];
    }

    public function read($id)
    {
        return Book::find($id);
    }

    public function update($book)
    {
        unset($book['_token']);
        Book::where('id', $book['id'])
            ->update($book);

        return $book;
    }

    public function delete($id)
    {
        $ret = Book::where('id', $id)->delete();

        return $ret;
    }

}

