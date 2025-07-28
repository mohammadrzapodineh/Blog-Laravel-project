<?php

namespace App\Http\Controllers\Api;

use App\Http\Controllers\Controller;
use App\Http\Requests\Tag\TagRequest;
use App\Http\Resources\Tag\TagResource;
use App\Models\Tag;
use Illuminate\Contracts\Debug\ExceptionHandler;
use Illuminate\Http\Request;
use Throwable;

use function Pest\Laravel\call;

class TagControllerApi extends Controller
{
    /**
     * Display a listing of the resource.
     */
    public function index()
    {
        $query = Tag::paginate(20);
        return TagResource::collection($query);
    }

    /**
     * Store a newly created resource in storage.
     */
    public function store(TagRequest $request)
    {
        $validatedData = $request->validated();
        $tag = Tag::create($validatedData);
        return new TagResource($tag);
    }

    /**
     * Display the specified resource.
     */
    public function show(Tag $tag)
    {
        return new TagResource($tag);
    }

    /**
     * Update the specified resource in storage.
     */
    public function update(TagRequest $request, Tag $tag)
    {
        $validatedData = $request->validated();
        $tag->update($validatedData);
        return new TagResource($tag);
    }

    /**
     * Remove the specified resource from storage.
     */
    public function destroy(Tag $tag)
    {
        try
        {
            $tag->delete();
            return response()->json([
                "detail" => "Your Tag is Deleted SuccessFully "
            ]);
        }

        catch(Throwable $th)
        {
            app()[ExceptionHandler::class]->report($th);
            return response()->json(
                [
                    "errors" => "InternalServer Error",
                ], 500
            );
        }
    }
}
