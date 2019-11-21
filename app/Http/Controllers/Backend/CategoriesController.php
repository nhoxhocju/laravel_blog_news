<?php

namespace App\Http\Controllers\Backend;

use Illuminate\Http\Request;
use App\Http\Controllers\Controller;
use App;
use App\Language;
use App\Categories;

class CategoriesController extends Controller
{
    public function index() {

        $locale = App::getLocale();
        $language = Language::where('code_language', '=', $locale)->first();
        $categories = $language->categories()->paginate(3);
        // dd($categories);
        // var_dump($categories);exit;
        return view('backend.categories.index', compact('categories'));
    }

    public function create() {
        $languages = Language::all();
        return view('backend.categories.create', compact('languages'));
    }

    public function store(Request $request) {

        $request->validate([
            'category-vi' => 'required',
            'category-en' => 'required',
        ]);

        $category = new Categories;
        $category->save();

        $languages = Language::all();

        foreach($languages as $lang) {
            $data = [
                'name' => $request->input("category-" . $lang->code_language),
            ];

            $category->languages()->attach($lang, $data);
        }

        return redirect()->route('backend.category.index')->with('success', 'Category has been saved!');

    }

    public function edit($id) {
        $category = Categories::find($id);
        $languages = $category->languages()->get();
        // dd($post);
        // dd($post);
        
        // $languages = Language::all();
        return view('backend.categories.edit', compact('languages', 'category'));
    }

    public function update($id, Request $request) {
        $category = Categories::find($id);
        $languages = Language::all();

        foreach ($languages as $lang) {
            $language = Language::find($lang->id);
            $data = [
            'name' => $request->input('category-' . $lang->code_language),
        ];
            $category->languages()->updateExistingPivot($language, $data);
        }
        return redirect()->route('backend.category.edit', $id)->with('success', 'Category has been updated!');
    }

    public function delete($id) {
        $category = Categories::find($id);
        $posts = $category->posts->all();
        foreach($posts as $post) {
            $post->languages()->detach();
            $post->delete();
        }
        // dd($posts);
        // dd($post);
        $category->languages()->detach();
        // $category->posts()->delete();
        $category->delete();
        return redirect()->route('backend.category.index')->with('success', 'Category has been deleted!');
    }

    public function deleteCheckbox(Request $request) {
        $listIdCategories = $request->input('checked');
        if($listIdCategories == '') {
            return redirect()->route('backend.category.index');
        }
        // dd($listIdCategories);
        foreach($listIdCategories as $id) {
            $category = Categories::find($id);
            $posts = $category->posts->all();
            foreach($posts as $post) {
                $post->languages()->detach();
                $post->delete();
            }
            $category->languages()->detach();
            $category->delete();
        }
        return redirect()->route('backend.category.index')->with('success', 'Category has been deleted!');
    }
}
