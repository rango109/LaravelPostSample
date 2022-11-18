<?php

namespace App\Http\Controllers;

use App\Repositories\PostRepository;
use App\Http\Requests\Posts\StoreRequest;
use App\Http\Requests\Posts\UpdateRequest;
use App\Traits\UploadTrait;
use DB;

class PostController extends Controller
{
    use UploadTrait;

    /**
     * Post repository implementation.
     *
     * @var \App\Repositories\PostRepository
     */
    protected $posts;

    public function __construct(PostRepository $posts)
    {
        $this->posts = $posts;
    }

    public function index()
    {
        $posts = $this->posts->orderByDesc('updated_at')->paginate(5);

        return view('posts.index', compact('posts'));
    }

    public function create()
    {
        return view('posts.create');
    }

    public function store(StoreRequest $request)
    {
        try {
            DB::beginTransaction();
        
            $attributes = $request->validated();
            $attributes['picture'] = $this->uploadFile($request->file('picture'), 'post_picture');

            $post = $this->posts->create($attributes);

            DB::commit();
        } catch (\Exception $e) {
            DB::rollback();
            \Log::error($e->getMessage());

            return back()->withInput()->with(['system.message.danger' => __('message.posts.store.failed')]);
        }

        return redirect()->route('posts.index')->with(['system.message.success' => __('message.posts.store.success')]);
    }

    public function edit($id)
    {
        $post = $this->posts->find($id);

        return view('posts.edit', compact('post'));
    }

    public function update(UpdateRequest $request, $id)
    {
        try {
            DB::beginTransaction();

            $post = $this->posts->find($id);

            $attributes = $request->validated();
            if ($request->file('picture')) {
                $attributes['picture'] = $this->uploadFile($request->file('picture'), 'post_picture');
            }

            $post->update($attributes);

            DB::commit();
        } catch (\Exception $e) {
            DB::rollback();
            \Log::error($e->getMessage());

            return back()->withInput()->with(['system.message.danger' => __('message.posts.update.failed')]);
        }

        return redirect()->route('posts.index')->with(['system.message.success' => __('message.posts.update.success')]);
    }

    public function destroy($id)
    {
        try {
            DB::beginTransaction();

            $post = $this->posts->find($id);
            $post->delete();

            DB::commit();
        } catch (\Exception $e) {
            DB::rollback();
            \Log::error($e->getMessage());

            return back()->withInput()->with(['system.message.danger' => __('message.posts.destroy.failed')]);
        }

        return redirect()->route('posts.index')->with(['system.message.success' => __('message.posts.destroy.success')]);
    }
}
