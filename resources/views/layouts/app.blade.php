@extends('adminlte::page')

@section('title', '管理画面 | ' . config('app.name'))

@section('content_header')
    <h1>管理画面</h1>
@stop

@section('content')

    @foreach(['danger', 'info', 'warning', 'success'] as $type)
        @if (Session::has("system.message.${type}"))
            <div class="alert alert-{{ $type }} alert-dismissible">
                <button type="button" class="close" data-dismiss="alert" aria-hidden="true">×</button>
                {{ Session::get("system.message.${type}") }}
            </div>
        @endif
    @endforeach

    @if($errors->any())
        <div class="alert alert-danger alert-dismissible">
            <button type="button" class="close" data-dismiss="alert" aria-hidden="true">×</button>
            {!! implode('', $errors->all('<div>:message</div>')) !!}
        </div>
    @endif

    <div id="app">
        @yield('page_content')
    </div>

@stop

@section('footer')
    <p class="l-footer__copyright">Copyright&copy; Hidanotabi. All rights reserved.</p>
@stop

@section('css')
    <link rel="stylesheet" href="{{ asset('css/app.css') }}?v=<?=filemtime('css/app.css')?>"/>
    @yield('custom_styles')
@stop

@section('js')
    <script src="{{ asset('js/app.js') }}?v=<?=filemtime('js/app.js')?>" defer></script>
    @yield('custom_scripts')
@stop
