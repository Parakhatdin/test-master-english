<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;

use App\Http\Requests;
use Prettus\Validator\Contracts\ValidatorInterface;
use Prettus\Validator\Exceptions\ValidatorException;
use App\Http\Requests\PartCreateRequest;
use App\Http\Requests\PartUpdateRequest;
use App\Repositories\Interfaces\PartRepository;
use App\Validators\PartValidator;

/**
 * Class PartsController.
 *
 * @package namespace App\Http\Controllers;
 */
class PartsController extends Controller
{
    /**
     * @var PartRepository
     */
    protected $repository;

    /**
     * @var PartValidator
     */
    protected $validator;

    /**
     * PartsController constructor.
     *
     * @param PartRepository $repository
     * @param PartValidator $validator
     */
    public function __construct(PartRepository $repository, PartValidator $validator)
    {
        $this->repository = $repository;
        $this->validator  = $validator;
    }

    /**
     * Display a listing of the resource.
     *
     * @return \Illuminate\Http\Response
     */
    public function index($book_id)
    {
        $parts = $this->repository->findWhere(['book_id' => $book_id])->all();

        return response()->json([
            'data' => $parts,
        ]);
    }

    /**
     * Store a newly created resource in storage.
     *
     * @param  PartCreateRequest $request
     *
     * @return \Illuminate\Http\Response
     *
     * @throws \Prettus\Validator\Exceptions\ValidatorException
     */
    public function store(PartCreateRequest $request)
    {
        try {

            $this->validator->with($request->all())->passesOrFail(ValidatorInterface::RULE_CREATE);

            $part = $this->repository->create($request->all());

            $response = [
                'message' => 'Part created.',
                'data'    => $part->toArray(),
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
     * @param $part_id
     * @return \Illuminate\Http\Response
     */
    public function show($part_id)
    {
        $part = $this->repository->find($part_id);

        return response()->json([
            'data' => $part,
        ]);
    }

    /**
     * Show the form for editing the specified resource.
     *
     * @param  int $id
     *
     * @return \Illuminate\Http\Response
     */
    public function edit($id)
    {
        $part = $this->repository->find($id);

        return view('parts.edit', compact('part'));
    }

    /**
     * Update the specified resource in storage.
     *
     * @param  PartUpdateRequest $request
     * @param  string            $id
     *
     * @return Response
     *
     * @throws \Prettus\Validator\Exceptions\ValidatorException
     */
    public function update(PartUpdateRequest $request, $id)
    {
        try {

            $this->validator->with($request->all())->passesOrFail(ValidatorInterface::RULE_UPDATE);

            $part = $this->repository->update($request->all(), $id);

            $response = [
                'message' => 'Part updated.',
                'data'    => $part->toArray(),
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
     * @return \Illuminate\Http\Response
     */
    public function destroy($id)
    {
        $deleted = $this->repository->delete($id);

        if (request()->wantsJson()) {

            return response()->json([
                'message' => 'Part deleted.',
                'deleted' => $deleted,
            ]);
        }

        return redirect()->back()->with('message', 'Part deleted.');
    }
}
