<?php

namespace App\Http\Controllers;

use App\Repositories\Interfaces\BookRepositoryInterface;
use Illuminate\Http\Request;

class BooksController extends Controller
{
    private $bookRepository;

    public function __construct(BookRepositoryInterface $bookRepository)
    {
        $this->bookRepository = $bookRepository;
    }

    /**
     * Display a listing of the resource.
     *
     * @param Request $request
     * @return \Illuminate\Http\JsonResponse
     */
    public function index(Request $request)
    {
        try {
            $params = [
                'title' => $request->title,
                'isbn' => $request->isbn,
                'genre' => $request->genre,
                'author' => $request->author,
                'published' => $request->published
            ];


            $books = $this->bookRepository->getAll($params);
            return response()->json([
                'status' => 'OK',
                'code' => 200,
                'data' => $books
            ], 200);
        }catch (\Exception $exception){
            return response()->json(['message' => $exception->getMessage()], 500);
        }
    }

    /**
     * Display a listing of the resource.
     *
     * @param Request $request
     * @return \Illuminate\Http\JsonResponse
     */
    public function listAll()
    {
        $books = $this->bookRepository->getAllDesc();
        return response()->json([
            'status' => 'OK',
            'code' => 200,
            'data' => $books
        ], 200);
    }


    /**
     * Store a newly created resource in storage.
     *
     * @param  \Illuminate\Http\Request  $request
     * @return \Illuminate\Http\JsonResponse
     */
    public function store(Request $request)
    {
        try {
            $request->validate([
                'title' => 'required',
                'author' => 'required',
                'isbn' => 'required',
                'genre' => 'required',
                'description' => 'required'
            ]);

            $book = $this->bookRepository->store($request->all());
            return response()->json([
                'status' => 'OK',
                'code' => 200,
                'data' => $book
            ], 200);
        }catch (\Exception $exception){
            return response()->json(['message' => $exception->getMessage()], 500);
        }
    }

    /**
     * Display the specified resource.
     *
     * @param  int  $id
     * @return \Illuminate\Http\JsonResponse
     */
    public function show($id)
    {
        try {
            $book = $this->bookRepository->getById($id);
            return response()->json([
                'status' => 'OK',
                'code' => 200,
                'data' => $book
            ], 200);
        }catch (\Exception $exception){
            return response()->json(['message' => $exception->getMessage()], 500);
        }

    }

    /**
     * Update the specified resource in storage.
     *
     * @param  \Illuminate\Http\Request  $request
     * @param  int  $id
     * @return \Illuminate\Http\JsonResponse
     */
    public function update(Request $request, $id)
    {
        try {
            $request->validate([
                'title' => 'required',
                'author' => 'required',
                'isbn' => 'required',
                'genre' => 'required',
                'description' => 'required'
            ]);

            $book = $this->bookRepository->update($request->all(), $id);
            return response()->json([
                'status' => 'OK',
                'code' => 200,
                'data' => $book
            ], 200);
        }catch (\Exception $exception){
            return response()->json(['message' => $exception->getMessage()], 500);
        }
    }

    /**
     * Remove the specified resource from storage.
     *
     * @param  int  $id
     * @return \Illuminate\Http\JsonResponse
     */
    public function destroy($id)
    {
        try {
            $this->bookRepository->delete($id);
            return response()->json([
                'status' => 'OK',
                'code' => 200
            ], 200);
        }catch (\Exception $exception){
            return response()->json(['message' => $exception->getMessage()], 500);
        }
    }
}
