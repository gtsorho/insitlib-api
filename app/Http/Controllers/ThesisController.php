<?php

namespace App\Http\Controllers;

use App\Models\thesis;
use Illuminate\Http\Request;
use Illuminate\Http\Response;
use Illuminate\Support\Facades\Auth;

class ThesisController extends Controller
{
    public function index(){
        $thesis =  thesis::all();
    }

    public function show($id){
        $thesis =  thesis::where('id', $id)->first();
    }

    public function destroy($id){
        $thesis =  thesis::where('id', $id)->delete();
    }

    public function search($input){
        $result = thesis::where('title','like','%'.$input.'%')
        ->orWhere('authors','like','%'.$input.'%')
        ->orWhere('affiliate_inst','like','%'.$input.'%')
        ->orderBy('id')->get();

        return response()->json($result, 200);
    }

    public function create(request $request){
        $fields = $request->validate([
            'title'=>'required|string',
            'authors'=>'required|string',
            'date'=>'required|date',
            'yr_publication'=>'required|string',
            'affiliate_inst'=>'required|string',
            'no_copies'=>'required|string',
            'accession_no'=>'required|string',
        ]);

        $thesis = thesis::create($fields);

        return response()->json($thesis, 200);
    }

    public function update(request $request, $id){
        $fields = $request->validate([
            'title'=>'required|string',
            'authors'=>'required|string',
            'date'=>'required|date',
            'yr_publication'=>'required|string',
            'affiliate_inst'=>'required|string',
            'no_copies'=>'required|string',
            'accession_no'=>'required|string',
        ]);

        $thesis = thesis::where('id',$id)->update($fields);

        return response()->json($thesis, 200);
    }

}
