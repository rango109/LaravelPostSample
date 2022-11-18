@extends('layouts.app')

@section('title', '日記編集 | ' . config('app.name'))

@section('content_header')
    <h1>日記編集</h1>
@stop

@section('page_content')

    {!! Form::open(['method' => 'PUT', 'route' => ['posts.update', $post->id], 'files' => true]) !!}
        <div class="row">
            <div class="col-sm-9">
                <div class="card">
                    <div class="card-header" data-card-widget="collapse" data-toggle="tooltip" title="Collapse">
                        <div class="card-title m-0">基本情報</div>
                        <div class="card-tools">
                            <button type="button" class="btn btn-tool" data-card-widget="collapse" data-toggle="tooltip" title="Collapse">
                                <i class="fas fa-minus"></i>
                            </button>
                        </div>
                    </div>
                    <div class="card-body">
                        <div class="form-group">
                            <label for="title" class="col-form-label">タイトル<span class="text-danger">*</span></label>
                            <div class="">
                                {!! Form::text('title', old('title', $post->title), [
                                    'id' => 'title',
                                    'class' => 'form-control' . ($errors->has('title') ? ' is-invalid' : ''),
                                ]) !!}
                                @error('title')
                                    <div class="text-xs text-danger">{{ $message }}</div>
                                @enderror
                            </div>
                        </div>
                        <div class="form-group js-imagePicker">
                            <label for="picture" class="col-form-label">タイトル画像<span class="text-danger">*</span></label>
                            <div>
                                {!! Form::file('picture', ['class' => 'js-imagePicker--fileInput', 'accept' => 'image/*']) !!}
                            </div>
                            <div style="max-width: 480px; {{ $post->picture ? '' : 'display: none;' }}" class="js-imagePicker--previewWrapper">
                                <div style="max-width: 400px;" class="d-inline-block mt-2">
                                    <img src="{{ asset($post->picture_url) }}" alt="" class="js-imagePicker--preview img-fluid img-thumbnail" />
                                </div>
                            </div>
                            @error('picture')
                                <div class="text-xs text-danger">{{ $message }}</div>
                            @enderror
                        </div>
                        <div class="form-group">
                            <label for="content" class="col-form-label">コンテンツ<span class="text-danger">*</span></label>
                            <div class="">
                                {!! Form::textarea('content', old('content', $post->content), [
                                    'id' => 'content',
                                    'class' => 'form-control' . ($errors->has('content') ? ' is-invalid' : ''),
                                ]) !!}
                                @error('content')
                                    <div class="text-xs text-danger">{{ $message }}</div>
                                @enderror
                            </div>
                        </div>
                    </div>
                </div>
            </div>
            <div class="col-sm-3">
                <div class="card">
                    <div class="card-body">
                        <div class="form-group">
                            <label for="status" class="col-form-label">ステータス</label>
                            {!! Form::select('status', \App\Enums\PublicStatus::asSelectArray(), old('status', $post->status), ['class' => 'form-control']) !!}
                        </div>
                        <div class="text-center">
                            <button type="submit" class="btn btn-block btn-primary">変更</button>
                            <a href="{{ route('posts.index') }}" class="btn btn-block btn-secondary">戻る</a>
                        </div>
                    </div>
                </div>
            </div>
        </div>
    {!! Form::close() !!}
@endsection
