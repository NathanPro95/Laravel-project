<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;
use App\models\ContructionItems;

class ContructionItemController extends Controller
{
    //
    function __construct(ContructionItems $constructioItem)
    {
    	$this->model = $constructioItem;
    }

    public function index()
    {
    	$constructionItems = $this->model->all();
    	return view('admin.contruction_items.list_item', compact('constructionItems'));
    }

    public function add(Request $request)
    {
    	$constructionItems = $this->model;
    	$constructionItems['name_item'] = $request->name;
    	if ($constructionItems->save()) {
    		return redirect('manageSchedule/construction_item');
    	}
    }

    public function getid($id)
    {
    	$constructionItem = $this->model->first($id);
    	return response()->json($constructionItem);
    }
}
