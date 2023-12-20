<?php

namespace App\Http\Controllers;
use App\Http\Requests\UpdateBookCategoryRequest;
use App\Http\Requests\StoreBookCategoryRequest;
use App\Http\Resources\BookCategoryCollection;
use App\Http\Resources\BookCategoryResource;
use App\Models\BookCategory;
use Exception;
use Illuminate\Http\Request;
use Spatie\LaravelIgnition\Http\Requests\UpdateConfigRequest;

class BookCategoryController extends Controller
{
    /**
     * Display a listing of the resource.
     */
    public function index()
    {
        try {
            $queryData = BookCategory::all();
            $formattedDatas = new BookCategoryCollection($queryData);
            return response()->json([
                "message" => "success",
                "data" => $formattedDatas
            ], 200
        );
        }
        catch (Exception $e){
            return response() -> json($e->getMessage(), 400);
        }
    }

    /**
     * Store a newly created resource in storage.
     */
    public function store(StoreBookCategoryRequest $request)
    {
        $validatedRequest = $request->validated();
        try{
            $queryData = BookCategory::create($validatedRequest);
            $formattedDatas = new BookCategoryResource($queryData);
            return response()->json([
                "message" => "success",
                "data" => $formattedDatas
            ], 200);
        }
        catch (Exception $e){
            return response()->json($e->getMessage(), 400);
        }
    }

    /**
     * Display the specified resource.
     */
    public function show(string $id)
    {
        try{
            $queryData = BookCategory::findOrFail($id);
            $formattedDatas = new BookCategoryResource($queryData);
            return response()->json([
                "message" => "success",
                "data" => $formattedDatas
            ], 200);
        }

        catch (Exception $e){
            return response()->json($e->getMessage(), 400);
        }
    }

    /**
     * Update the specified resource in storage.
     */
    public function update(UpdateBookCategoryRequest $request, string $id)
    {
        $validatedRequest = $request->validated();
        try{
            $queryData = BookCategory::findOrFail($id);
            $queryData->update($validatedRequest);
            $queryData->save();
            $formattedDatas = new BookCategoryResource($queryData);
            return response()->json([
                "message" => "success",
                "data" => $formattedDatas
            ], 200);
        }
        catch (Exception $e){
            return response()->json($e->getMessage(), 400);
        }
    }

    /**
     * Remove the specified resource from storage.
     */
    public function destroy(string $id)
    {
        try{
            $queryData = BookCategory::findOrFail($id);
            $queryData->delete();
            $formattedDatas = new BookCategoryResource($queryData);
            return response()->json([
                "message" => "success",
                "data" => $formattedDatas
            ], 200);
        }
        catch (Exception $e){
            return response()->json($e->getMessage(), 400);
        }
    }
}
