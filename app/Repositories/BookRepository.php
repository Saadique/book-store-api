<?php


namespace App\Repositories;


use App\Models\Book;
use App\Repositories\Interfaces\BookRepositoryInterface;

class BookRepository implements BookRepositoryInterface
{

    public function getAll(array $params = null)
    {
        $books = Book::orderBy('id', 'DESC');
        if (isset($params)){
            if (isset($params['title']) && !empty($params['title']) && $title=$params['title']){
                $books = $books->where('title', 'LIKE', "%$title%");
            }

            if (isset($params['isbn']) && !empty($params['isbn']) && $isbn=$params['isbn']){
                $books = $books->where('isbn', 'LIKE', "%$isbn%");
            }

            if (isset($params['genre']) && !empty($params['genre']) && $genre=$params['genre']){
                $books = $books->where('genre', $genre);
            }

            if (isset($params['author']) && !empty($params['author']) && $author=$params['author']){
                $books = $books->where('author', 'LIKE', "%$author%");
            }

            if (isset($params['published']) && !empty($params['published']) && $published=$params['published']){
                $books = $books->where('published', $published);
            }
        }

        return $books->paginate(12);
    }

    public function getById($id)
    {
        return Book::findOrFail($id);
    }

    public function store(array $data)
    {
        $book = new Book();
        $book->title = $data['title'];
        $book->author = $data['author'];
        $book->isbn = $data['isbn'];
        $book->genre = $data['genre'];
        $book->description = $data['description'] ?? '';
        $book->image = $data['image'] ?? '';
        $book->published = $data['published'] ?? '';
        $book->publisher = $data['publisher'] ?? '';

        $book->save();
        return $book;
    }

    public function update(array $data, $id)
    {
        $book = $this->getById($id);
        $book->title = $data['title'];
        $book->author = $data['author'];
        $book->isbn = $data['isbn'];
        $book->genre = $data['genre'];
        $book->description = $data['description'] ?? '';
        $book->image = $data['image'] ?? '';
        $book->published = $data['published'] ?? '';
        $book->publisher = $data['publisher'] ?? '';

        $book->save();
    }

    public function getAllDesc()
    {
        return Book::orderBy('id', 'DESC')->get();
    }

    public function delete($id)
    {
        $book = $this->getById($id);
        $book->delete();
    }
}
