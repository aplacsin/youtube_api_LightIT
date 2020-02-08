@extends('layouts.app')

@section('content')

<section class="like-video">
    <div class="container">
        <div class="row">
            <div class="col-12">
                @if(isset($myFavorites))
                <ul class="list-unstyled video-list-thumbs row">
                    @forelse($myFavorites as $myFavorite)
                    <li class="col-lg-3 col-sm-6 col-xs-6">
                        <div class="wrapper-video-list">
                            <div class="wrapper-image-video d-flex justify-content-center">
                                <img src="{{ $myFavorite->image }}" alt="{{ $myFavorite->title }}"
                                    class="img-responsive image-video" />
                                <a href="http://www.youtube.com/watch?v={{ $myFavorite->video_id }}"
                                    class="round-button popup-youtube"><i class="fa fa-play fa-2x"></i></a>
                            </div>
                            <div class="wrapper-title-video">
                                <div class="title-video">{{ $myFavorite->title }}</div>
                            </div>
                            <div class="published-video">Дата публикации:
                                {{ \Carbon\Carbon::parse($myFavorite->published)->format('d/m/Y') }}
                            </div>
                            <div class="panel-footer">
                                <favorite :post={{ json_encode($myFavorite->video_id) }}
                                    :favorited={{ $myFavorite->favorited() ? 'true' : 'false' }}>
                                </favorite>
                            </div>
                        </div>
                    </li>
                    @empty
                    <div class="wrapper-result">
                        <h2 class="result">Ничего не найдено.</h2>
                    </div>
                    @endforelse
                </ul>
                @endif
            </div>
        </div>
    </div>
</section>

@endsection
