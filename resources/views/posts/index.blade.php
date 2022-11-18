@extends('layouts.app')

@section('title', '日記一覧 | ' . config('app.name'))

@section('content_header')
    <h1>日記一覧</h1>
@stop

@section('page_content')
    <div class="card">
        <div class="card-header">
            <div class="card-title m-0"></div>
            <div class="card-tools">
                <a href="{{ route('posts.create') }}" class="btn btn-primary btn-sm">追加</a>
            </div>
        </div>
        <div class="card-body table-responsive p-0">
            <table class="table table-hover">
                <thead>
                    <tr>
                        <th class="text-center align-middle" style="width: 50px;">ID</th>
                        <th class="text-center align-middle" style="width: 200px;">画像</th>
                        <th class="align-middle">タイトル</th>
                        <th class="text-center align-middle" style="width: 200px;">ステータス</th>
                        <th class="text-center align-middle" style="width: 160px;">アクション</th>
                    </tr>
                </thead>
                <tbody class="sortable">
                    @forelse ($posts as $post)
                        <tr data-id="{{ $post->id }}">
                            <td class="text-center align-middle">{{ $post->id }}</td>
                            <td class="text-center align-middle">
                                @if ($post->picture)
                                    <img src="{{ asset($post->picture_url) }}" width="160" class="img-fluid img-thumbnail" />
                                @endif
                            </td>
                            <td class="align-middle">{{ $post->title }}</td>
                            <td class="text-center align-middle">
                                @if ($post->status == \App\Enums\PublicStatus::Public)
                                    <span class="badge badge-primary">{{ $post->status_label }}</span>
                                @else
                                    <span class="badge badge-secondary">{{ $post->status_label }}</span>
                                @endif
                            </td>
                            <td class="text-center align-middle">
                                <div class="btn-group btn-group-sm">
                                    <a href="{{ route('posts.edit', $post->id) }}" class="btn btn-info">
                                        <i class="fas fa-edit"></i>
                                    </a>
                                    <button type="button" class="btn btn-danger" data-toggle="modal" data-target="#destroy-modal-{{ $post->id }}">
                                        <i class="fas fa-trash"></i>
                                    </button>
                                </div>
                                <div class="modal fade" id="destroy-modal-{{ $post->id }}">
                                    <div class="modal-dialog">
                                        <div class="modal-content">
                                            <div class="modal-header">
                                                <h4 class="modal-title">ID: {{ $post->id }}</h4>
                                                <button type="button" class="close" data-dismiss="modal" aria-label="Close">
                                                    <span aria-hidden="true">&times;</span>
                                                </button>
                                            </div>
                                            {!! Form::open(['method' => 'DELETE', 'route' => ['posts.destroy', $post->id]]) !!}
                                                <div class="modal-body text-left">
                                                    <p>本当に削除しますか？</p>
                                                </div>
                                                <div class="modal-footer justify-content-between">
                                                    <button type="submit" class="btn btn-danger">削除する</button>
                                                    <button type="button" class="btn btn-default" data-dismiss="modal">キャンセル</button>
                                                </div>
                                            {!! Form::close() !!}
                                        </div>
                                    </div>
                                </div>
                            </td>
                        </tr>
                    @empty
                        <tr>
                            <td colspan="4" class="text-center">データがありません。</td>
                        </tr>
                    @endforelse
                </tbody>
            </table>
        </div>
        <div class="card-footer">
            {!! $posts->links() !!}
        </div>
    </div>
@endsection
