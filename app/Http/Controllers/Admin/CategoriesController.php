<?php

namespace App\Http\Controllers\Admin;

use App\DataTables\CategoriesDataTable;
use App\Http\Controllers\Controller;
use App\Imports\CategoriesImport;
use App\Models\Category;
use Illuminate\Contracts\Foundation\Application;
use Illuminate\Contracts\View\Factory;
use Illuminate\Contracts\View\View;
use Illuminate\Http\RedirectResponse;
use Illuminate\Http\Request;
use Illuminate\Http\Response;
use Illuminate\Support\Facades\Validator;
use Maatwebsite\Excel\Facades\Excel;

class CategoriesController extends Controller
{
    /**
     * Display a listing of the resource.
     *
     * @param CategoriesDataTable $categoriesDataTable
     * @return Application|Factory|View
     */
    public function index(CategoriesDataTable $categoriesDataTable)
    {
        return $categoriesDataTable->render('admin.components.category.datatable');
    }

    /**
     * Show the form for creating a new resource.
     *
     * @return Application|Factory|View
     */
    public function create()
    {
        $category = new Category();
        return view('admin.components.category.create', compact('category'));
    }

    /**
     * Store a newly created resource in storage.
     *
     * @param  \Illuminate\Http\Request  $request
     * @return RedirectResponse
     */
    public function store(Request $request)
    {
        $input  = $request->all();
        $validator = Validator::make($input, Category::$cast);
        if ($validator->fails()) {
            return redirect()->route('categories.create')->withErrors($validator)->withInput();
        }
        $input['name'] = strtolower($input['name']);
        Category::create($input);
        return redirect()->route('categories.index')->with(['success' => 'Category ' . __("messages.add")]);
    }

    /**
     * Display the specified resource.
     *
     * @param  int  $id
     * @return Response
     */
    public function show($id)
    {
        //
    }

    /**
     * Show the form for editing the specified resource.
     *
     * @param  int  $id
     * @return Application|Factory|View
     */
    public function edit($id)
    {
        $category = Category::findorfail($id);

        return view('admin.components.category.edit',compact('category'));
    }

    /**
     * Update the specified resource in storage.
     *
     * @param  \Illuminate\Http\Request  $request
     * @param  int  $id
     * @return RedirectResponse
     */
    public function update(Request $request, $id)
    {
        $input = $request->all();
        $category = Category::find($id);
        $category->update($input);
        return redirect()->route('categories.index')->with(['success' => 'Category ' . __("messages.update")]);
    }

    /**
     * Remove the specified resource from storage.
     *
     * @param  int  $id
     * @return RedirectResponse
     */
    public function destroy($id): RedirectResponse
    {
        $category = Category::findOrFail($id);
        $category->delete();
        return redirect()->route('categories.index')->with(['success' => 'Category ' . __("messages.delete")]);
    }

    /**
     * @return RedirectResponse
     */
    public function import(): RedirectResponse
    {
        Excel::import(new CategoriesImport(),request()->file('file'));

        return back();
    }

    /**
     * @return Application|Factory|View
     */
    public function importExportView()
    {
        return view('admin.components.category.importExport');
    }

}
