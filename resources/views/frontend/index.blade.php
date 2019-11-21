@extends('frontend.layouts.default')
@section('content')
<div class="container">
    <h2 class="text-center pt-5 pb-5 page-title">Tin tức nổi bật</h2>
    <div class="content">
        <div class="row">
            @foreach ($posts as $post)
            <div class="col-lg-4 col-12 mb-4 wow fadeInUp" data-wow-delay="1s"
                style="visibility: visible; animation-delay: 1s; animation-name: fadeInUp;">
                <a
                    href="{{ route('home.show', $post->id)}}">
                    <div class="new-item">
                        <div class="new-image">
                            <img class="w-100"
                                src="{{ asset("thumbnail/$post->thumbnail") }}"
                                alt="">
                        </div>
                        <div class="new-content">
                            <div class="new-title mb-5">
                            <h3>{{$post->pivot->title}}</h3>
                            </div>
                            <div class="new-description mb-4">
                                <p>
                                    {{ substr($post->pivot->content,0,200)}}
                                </p>
                            </div>
                            <hr>
                            <div class="new-date">
                                <p><img src="http://bizman.tesosoft.com/img/clock.png" alt="" width="10"><span>
                                       {{$post->created_at}}</span></p>
                            </div>
                        </div>
                    </div>
                </a>
            </div>
            @endforeach
        </div>
    </div>
</div>
@endsection
