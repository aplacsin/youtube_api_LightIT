@extends('layouts.app')

@section('content')

<section class="search-video">
    <div class="container">
        <div class="row">
            <div class="col-12">
                <div class="wrapper-search">
                    <div class="wrapper-search-video-text">
                        <div class="search-text d-flex justify-content-center">
                            <p>Поиск Видео</p>
                        </div>
                    </div>
                    <div class="wrapper-form-search">
                        <form action="{{ route('youtube.search') }}" class="d-flex justify-content-center">
                            <input type="text" name="query" class="form-search" required placeholder="Введите запрос"
                                value="{{ isset($query)?$query:'' }}" />
                            <input type="submit" class="btn-search" value="Поиск">
                        </form>
                    </div>
                </div>
            </div>
        </div>
    </div>
</section>

@endsection
