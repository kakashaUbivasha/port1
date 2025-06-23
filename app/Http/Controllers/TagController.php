<?php

namespace App\Http\Controllers;

use App\Http\Requests\Tag\TagRequest;
use App\Models\Tag;

class TagController extends Controller
{
        public function index()
        {
            $tags = Tag::all();
            return response()->json($tags);
        }
        public function store(TagRequest $request)
        {
            $data = $request->validated();
            Tag::create($data);
            return response()->json(['message'=>'Tag created'], 201);
        }
        public function  destroy($id)
        {
            $tag = Tag::findOrFail($id);
            $tag->delete();
            return response()->json(['message'=>'Tag deleted'], 200);
        }
}
