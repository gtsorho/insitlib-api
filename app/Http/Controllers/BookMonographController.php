<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;
use Illuminate\Http\Response;
use Illuminate\Support\Facades\Auth;
use App\Models\book_monograph;

class BookMonographController extends Controller
{
    
   
    public function index(){
        $book_monograph =  book_monograph::all();
    }

    public function show($id){
        $book_monograph =  book_monograph::where('id', $id)->first();
    }

    public function destroy($id){
        $book_monograph =  book_monograph::where('id', $id)->delete();
    }

    public function search($input){
        $result = book_monograph::where('title','like','%'.$input.'%')
        ->orWhere('authors','like','%'.$input.'%')
        ->orWhere('subject_area','like','%'.$input.'%')
        ->orderBy('id')->get();

        return response()->json($result, 200);
    }

    public function create(request $request){
        $fields = $request->validate([
            'title'=>'required|string',
            'authors'=>'required|string',
            'yr_publication'=>'required|string',
            'identifier'=>'required|string',
            'class_no'=>'required|string',
            'accession_no'=>'required|string',
            'publisher'=>'required|string',
            'no_copies'=>'required|string',
            'subject_area'=>'required|string',
            'vol_issue_no'=>'required|string'
        ]);

        $book_monograph = book_monograph::create($fields);

        return response()->json($book_monograph, 200);
    }

    public function update(request $request, $id){
        $fields = $request->validate([
            'title'=>'required|string',
            'authors'=>'required|string',
            'yr_publication'=>'required|string',
            'identifier'=>'required|string',
            'class_no'=>'required|string',
            'accession_no'=>'required|string',
            'publisher'=>'required|string',
            'no_copies'=>'required|string',
            'subject_area'=>'required|string',
            'vol_issue_no'=>'required|string'
        ]);


        $book_monograph = book_monograph::where('id',$id)->update($fields);

        return response()->json($book_monograph, 200);
    }
}
