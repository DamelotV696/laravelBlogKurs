@extends('layouts.main')
@section('content')
    <main class="blog-post">
        <div class="container">
            <h1 class="edica-page-title" data-aos="fade-up">{{ $post->title }}</h1>
            <p class="edica-blog-post-meta" data-aos="fade-up" data-aos-delay="200">• {{ $date->translatedFormat('F') }}
                {{ $date->day }},
                {{ $date->year }} • {{ $date->format('H:i') }} • {{ $post->comments->count() }} Коментария
            </p>
            <section class="blog-post-featured-img" data-aos="fade-up" data-aos-delay="300">
                <img src="{{ url('storage/' . $post->preview_image)}}" alt="featured image" class="w-100">
            </section>
            <section class="post-content">
                <div class="row">
                    <div class="col-lg-9 mx-auto">
                        {!! $post->content !!}
                    </div>
                </div>
            </section>
            <section class="py-3 mb-5">
                <div class="row">
                    <div class="col-lg-9 mx-auto">
                        @auth

                            <form action="{{ route('post.like.store', $post->id) }}" method="post">
                                @csrf
                                <span>{{ $post->liked_users_count }}</span>

                                <button type="submit" class="border-0 bg-transparent">
                                    <i class="fa{{ auth()->user()->likedPosts->contains($post->id) ? 's' : 'r'}} fa-heart"></i>
                                    {{-- <i class="far fa-heart"></i> --}}
                                </button>
                            </form>
                        @endauth
                        @guest
                            <span>{{ $post->liked_users_count }}</span>
                            <i class="far fa-heart"></i>
                        @endguest
                    </div>
                </div>
            </section>
            <div class="row">
                <div class="col-lg-9 mx-auto">
                    @if ($relatedPosts->count() > 0)
                        <section class="related-posts">
                            <h2 class="section-title mb-4" data-aos="fade-up">Схожие посты</h2>
                            <div class="row">
                                @foreach ($relatedPosts as $relatedPost)
                                    <div class="col-md-4" data-aos="fade-right" data-aos-delay="100">
                                        <img src="{{ url('storage/' . $relatedPost->main_image)}}" alt="related post"
                                            class="post-thumbnail">
                                        <p class="post-category">{{ $relatedPost->category->title }}</p>
                                        <h5 class="post-title"><a
                                                href="{{ route('post.show', $relatedPost->id) }}">{{ $relatedPost->title }}</a>
                                        </h5>
                                    </div>
                                @endforeach
                            </div>
                        </section>
                    @endif

                    <section class="comment-lists mb-5">
                        <h2 class="section-title mb-5" data-aos="fade-up">Коментарии({{ $post->comments->count() }})</h2>
                        @foreach ($post->comments as $comment)
                            <div class="comment-text mb-3">
                                <span class="username">
                                    <div>
                                        {{ $comment->user->name }}
                                    </div>
                                    <span class="text-muted float-right">{{ $comment->dateAsCarbon->diffForHumans() }}</span>
                                </span><!-- /.username -->
                                {{ $comment->message }}
                            </div>
                        @endforeach
                    </section>
                    @auth
                        <section class="comment-section">
                            <h2 class="section-title mb-5" data-aos="fade-up">Отправить коментарий</h2>
                            <form action="{{ route('post.comment.store', $post->id) }}" method="post">
                                @csrf
                                <div class="row">
                                    <div class="form-group col-12" data-aos="fade-up">
                                        <label for="comment" class="sr-only">Comment</label>
                                        <textarea name="message" id="comment" class="form-control"
                                            placeholder="Напиши коментраий!!!" rows="10" rows="10">Comment</textarea>
                                    </div>
                                </div>
                                <input type="hidden" name="post_id" value="{{ $post->id }}">
                                <div class="row">
                                    <div class="col-12" data-aos="fade-up">
                                        <input type="submit" value="Добавить" class="btn btn-warning">
                                    </div>
                                </div>
                            </form>
                        </section>
                    @endauth

                </div>
            </div>
        </div>
    </main>
@endsection