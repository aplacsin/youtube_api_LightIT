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
            <div class="col-12">
                @if(isset($videos))
                <ul class="list-unstyled video-list-thumbs row">
                    @foreach($bdsearch as $video)
                    <li class="col-lg-3 col-sm-6 col-xs-6">
                        <div class="wrapper-video-list">
                            <div class="wrapper-image-video d-flex justify-content-center">
                                <img src="{{ $video->image }}"
                                    alt="{{ $video->title }}" class="img-responsive image-video" />
                                <a href="http://www.youtube.com/watch?v={{ $video->video_id }}"
                                    class="round-button popup-youtube"><i class="fa fa-play fa-2x"></i></a>
                            </div>
                            <div class="wrapper-title-video">
                                <div class="title-video">{{ $video->title }}</div>
                            </div>
                            <div class="published-video">Дата публикации:
                                {{ \Carbon\Carbon::parse($video->published)->format('d/m/Y') }}
                            </div>
                            @if (Auth::check())
                            <div class="panel-footer">
                                <favorite :post={{ json_encode($video->video_id) }}
                                    :favorited={{ $video->favorited() ? 'true' : 'false' }}
                                >
                                </favorite>
                            </div> 
                            @endif                          
                        </div>
                    </li>					
                    @endforeach
                </ul>
				<nav class="text-center d-flex justify-content-center">
                    <ul class="pagination pagination-lg">
                        <li @if($videos->getPrevPageToken() == null) class="disabled" @endif>
                            <a href="/search?page={{$videos->getPrevPageToken()}}&query={{ $query }}"
                                aria-label="Previous" class="pagination-link prev" style="text-decoration: none;">
                                <span aria-hidden="true" class="pagination-button">Назад «</span>
                            </a>
                        </li>
                        <li @if($videos->getNextPageToken() == null) class="disabled" @endif>
                            <a href="/search?page={{$videos->getNextPageToken()}}&query={{ $query }}" aria-label="Next"  
                                style="text-decoration: none;" class="pagination-link next">
                                <span aria-hidden="true" class="pagination-button">Далее »</span>
                            </a>
                        </li>
                    </ul>
                </nav>                
                @else
                <div class="wrapper-result">
                    <h2 class="result">Ничего не найдено.</h2>
                </div>
                @endif
            </div>
        </div>
    </div>
</section>

@endsection
