<?php

namespace App\Http\Controllers;

use App\Presenters\BookPresenter;
use Illuminate\Http\JsonResponse;
use Illuminate\Http\Request;

use App\Http\Requests;
use Illuminate\Http\Response;
use Prettus\Validator\Contracts\ValidatorInterface;
use Prettus\Validator\Exceptions\ValidatorException;
use App\Http\Requests\BookCreateRequest;
use App\Http\Requests\BookUpdateRequest;
use App\Repositories\Interfaces\BookRepository;
use App\Validators\BookValidator;

/**
 * Class BooksController.
 *
 * @package namespace App\Http\Controllers;
 */
class BooksController extends Controller
{
    /**
     * @var BookRepository
     */
    protected $repository;

    /**
     * @var BookValidator
     */
    protected $validator;

    /**
     * BooksController constructor.
     *
     * @param BookRepository $repository
     * @param BookValidator $validator
     */
    public function __construct(BookRepository $repository, BookValidator $validator)
    {
        $this->repository = $repository;
        $this->validator  = $validator;
    }

    /**
     * Display a listing of the resource.
     *
     * @return JsonResponse|Response
     */
    public function index()
    {
        $books = $this->repository->setPresenter(BookPresenter::class)->all();

//        if (request()->wantsJson()) {
//
//            return response()->json([
//                'data' => $books,
//            ]);
//        }

        return response()->json($books['data']);
//        return view('books.index', compact('books'));
    }

    /**
     * Store a newly created resource in storage.
     *
     * @param  BookCreateRequest $request
     *
     * @return Response
     *
     * @throws ValidatorException
     */
    public function store(BookCreateRequest $request)
    {
        try {

            $this->validator->with($request->all())->passesOrFail(ValidatorInterface::RULE_CREATE);

            $book = $this->repository->create($request->all());

            $response = [
                'message' => 'Book created.',
                'data'    => $book->toArray(),
            ];

            if ($request->wantsJson()) {

                return response()->json($response);
            }

            return redirect()->back()->with('message', $response['message']);
        } catch (ValidatorException $e) {
            if ($request->wantsJson()) {
                return response()->json([
                    'error'   => true,
                    'message' => $e->getMessageBag()
                ]);
            }

            return redirect()->back()->withErrors($e->getMessageBag())->withInput();
        }
    }

    /**
     * Display the specified resource.
     *
     * @param  int $book_id
     *
     * @return Response
     */
    public function show($book_id)
    {
        $book = $this->repository->find($book_id);

        return response()->json([
            'data' => $book,
        ]);
    }

    /**
     * Show the form for editing the specified resource.
     *
     * @param  int $id
     *
     * @return Response
     */
    public function edit($id)
    {
        $book = $this->repository->find($id);

        return view('books.edit', compact('book'));
    }

    /**
     * Update the specified resource in storage.
     *
     * @param  BookUpdateRequest $request
     * @param  string            $id
     *
     * @return Response
     *
     * @throws ValidatorException
     */
    public function update(BookUpdateRequest $request, $id)
    {
        try {

            $this->validator->with($request->all())->passesOrFail(ValidatorInterface::RULE_UPDATE);

            $book = $this->repository->update($request->all(), $id);

            $response = [
                'message' => 'Book updated.',
                'data'    => $book->toArray(),
            ];

            if ($request->wantsJson()) {

                return response()->json($response);
            }

            return redirect()->back()->with('message', $response['message']);
        } catch (ValidatorException $e) {

            if ($request->wantsJson()) {

                return response()->json([
                    'error'   => true,
                    'message' => $e->getMessageBag()
                ]);
            }

            return redirect()->back()->withErrors($e->getMessageBag())->withInput();
        }
    }


    /**
     * Remove the specified resource from storage.
     *
     * @param  int $id
     *
     * @return Response
     */
    public function destroy($id)
    {
        $deleted = $this->repository->delete($id);

        if (request()->wantsJson()) {

            return response()->json([
                'message' => 'Book deleted.',
                'deleted' => $deleted,
            ]);
        }

        return redirect()->back()->with('message', 'Book deleted.');
    }
}
