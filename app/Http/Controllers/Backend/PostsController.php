<?php

namespace App\Http\Controllers\Backend;

use Illuminate\Http\Request;
use App\Http\Controllers\Controller;
use App\Post;
use App\Language;
use App\Localization;
use App;
use App\Categories;
use App\Events\CreatePost;
use DB;
use Illuminate\Support\Str;


class PostsController extends Controller
{
    public function __construct()
    {
        $this->middleware('auth');
    }
    
    public function index() {
        $locale = App::getLocale();
        // dd($locale);
        $language = Language::where('code_language', '=', $locale)->first();
        // var_dump($idLanguage->id);exit;
        $posts = Language::find($language->id)->posts()->paginate(3);
        $categories = $language->categories()->get();
        $convertCategories = [];
        // $data = [];
        foreach ($categories as $cat) {
            $convertCategories[$cat['id']] = $cat['pivot']['name'];
            // array_push($convertCategories, $data);
        };
        // dd($convertCategories);
        // var_dump($categories->toJson());exit;
        
        // $categories = $posts->categories()->get();
        // $xz = Post::all();
        // $posts = $xz->languages()->find($idLanguage->id);
        // $categoryArray = config('category.categoryArray');
        // dd($categoryArray);
        return view('backend.posts.index', compact('posts', 'categories', 'convertCategories'));
    }

    public function create() {
        $idLanguage = Language::where('code_language', '=', App::getLocale())->first();
        // printf($idLanguage);
        // echo $idLanguage;exit;
        $languages = Language::all();
        $categories = Language::find($idLanguage->id)->categories()->get();
        // $test = Language::find(1);
        // $categories = $test->categories()->get();
        // printf($categories);exit;
        // dd(count($languages));exit;
        return view('backend.posts.create', compact('languages', 'categories'));
    }

    public function store(Request $request, Post $post) {
        $request->validate([
            'title-vi' => 'required',
            'content-vi' => 'required',
            'title-en' => 'required',
            'content-en' => 'required',
            'thumbnail' => 'required|image|mimes:jpeg,png,jpg,gif,svg|max:2048',
            'category' => 'required'
        ],
        [
            'title-vi.required' => 'Tiêu đề không được để trống.',
            'content-vi.required' => 'Nội dung không được để trống',
            'title-en.required' => 'Title English is required.',
            'content-en.required' => 'Content English is required'
        ]);

        $imageName = time().'.'.request()->thumbnail->getClientOriginalExtension();
        request()->thumbnail->move(public_path('thumbnail'), $imageName);

        $post->thumbnail =  $imageName;
        $post->category_id = $request->input('category');
        $post->slug = $request->input('slug');
        if($request->input('slug') == '') {
            $post->slug = Str::slug($request->input('title-en'), '-');
        }
        // dd($post);

        // 'slug' => Str::slug($event->request->input('title-' . $locale), '-'),
        // dd($image);
        // $post = new Post;
        $post->save();

        // $languages = Language::all();
        // foreach ($languages as $lang) {
        //     $language = Language::find($lang->id);
        //     $data = [
        //         'title' => $request->input('title-' . $lang->code_language),
        //         'content' => $request->input('content-' . $lang->code_language),
        //     ];
        //     $post->languages()->attach($language, $data);
        // }

        event(new CreatePost($post, $request));

        return redirect()->route('backend.post.index')->with('success', 'Post has been saved!');

    }

    public function edit($id) {
        $post = Post::find($id);
        $languages = $post->languages()->get();
        // dd($post);
        // dd($post);
        
        // $languages = Language::all();
        return view('backend.posts.edit', compact('languages', 'post'));
    }

    public function update(Request $request, $id) {
        $method = $request->method();
        $request->validate([
            'title-vi' => 'required',
            'content-vi' => 'required',
            'title-en' => 'required',
            'content-en' => 'required',
            'thumbnail' => 'image|mimes:jpeg,png,jpg,gif,svg|max:2048',
        ],
        [
            'title-vi.required' => 'Tiêu đề không được để trống.',
            'content-vi.required' => 'Nội dung không được để trống',
            'title-en.required' => 'Title English is required.',
            'content-en.required' => 'Content English is required'
        ]);

        $post = Post::find($id);
        if($request->hasFile('thumbnail')) {
            $imageName = time().'.'.request()->thumbnail->getClientOriginalExtension();
            request()->thumbnail->move(public_path('thumbnail'), $imageName);
            $post->thumbnail = $imageName;
        }

        // dd($post->thumbnail);
        $post->save();
        // $languageVi = Language::find(Localization::$localeArray[Language::VI]);


        $languages = Language::all();
        foreach ($languages as $lang) {
            $language = Language::find($lang->id);
            $data = [
                'title' => $request->input('title-' . $lang->code_language),
                'content' => $request->input('content-' . $lang->code_language),
            ];
            $post->languages()->updateExistingPivot($language, $data);
        }
        return redirect()->route('backend.post.edit', $id)->with('success', 'Post has been updated!');
    }

    public function delete($id) {
        $post = Post::find($id);
        // dd($post);
        $post->languages()->detach();
        $post->delete();
        return redirect()->route('backend.post.index')->with('success', 'Post has been deleted!');
    }

    public function deleteCheckbox(Request $request) {
        // dd($request->input('checked',[]));
        $listIdPosts = $request->input('checked');
        // dd($listIdPosts);
        foreach($listIdPosts as $id) {
            $post = Post::find($id);
            $post->languages()->detach();
            $post->delete();
        }
        return redirect()->route('backend.post.index')->with('success', 'Post has been deleted!');
    }
}
