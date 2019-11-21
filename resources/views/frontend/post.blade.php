@extends('frontend.layouts.default')
@section('content')
<div class="container-fluid" style="background-color: white">
    <div class="news-details-section pt-5 pb-100">
        <div class="container">
            <div class="row">
                <div class="news-details-section-header col-lg-8 col-12">
                    <h2>{{$post->pivot->title}}
                    </h2>
                </div>
                <div class="offset-lg-4 d-lg-block d-none"></div>
            </div>
            <div class="row">
                <div class="news-details-section-content col-lg-9 col-12">
                    <img src="{{ asset("thumbnail/$post->thumbnail") }}"
                        alt="" class="mb-5">
                   {!! $post->pivot->content !!}
                </div>
                <div class="sidebar col-lg-3 col-12">
                    <div class="sidebar-section-1">
                        <h2>Tin mới nhất</h2>
                        <div class="sidebar-section-1-content">
                            @foreach ($lasted as $item)
                            <a
                                href="{{ route('home.show', $item->pivot->post_id)}}">
                                <div class="sidebar-section-1-item">
                                    <div class="row">
                                        <img src="{{ asset("thumbnail/$item->thumbnail") }}"
                                            alt="" class="col-lg-6 col-12 w-100">
                                        <p class="font-weight-bold col-lg-6">{{$item->pivot->title}}</p>
                                    </div>
                                </div>
                            </a>
                            @endforeach
                        </div>
                    </div>
                    <div class="sidebar-section-2">
                        <div class="news-details-section-tags">
                            <p>Thẻ bài viết: </p>
                            <a href="http://bizman.tesosoft.com/tin-tuc/the/t%C6%B0%20v%E1%BA%A5n"><span class="">tư
                                    vấn</span></a>,&nbsp;
                            <a href="http://bizman.tesosoft.com/tin-tuc/the/c%C3%A2u%20h%E1%BB%8Fi"><span class="">câu
                                    hỏi</span></a>,&nbsp;
                            <a href="http://bizman.tesosoft.com/tin-tuc/the/gi%E1%BA%A3i%20ph%C3%A1p"><span
                                    class="">giải pháp</span></a>,&nbsp;
                            <a href="http://bizman.tesosoft.com/tin-tuc/the/bizman"><span
                                    class="">bizman</span></a>,&nbsp;
                        </div>
                    </div>
                </div>
            </div>
        </div>
    </div>
<div>
@endsection
