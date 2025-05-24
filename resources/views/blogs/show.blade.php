@extends('layouts.frontend')

@section('content')
    <section class="feature">
        <img src="{{ Storage::url($blog->image) }}" alt="" class="feature__bg" />
        <div class="feature__container container">
            <div class="feature__data">
                <h2 class="feature__subtitle">{{ $blog->title }}</h2>
                </div>
        </div>
    </section>

    <section class="gallery-blog section">
        <div class="container">
            @if ($blog->blogImages->isNotEmpty())
                <h2 class="section__title" style="text-align: center; margin-bottom: 2rem;">Galeri Foto</h2>
                <div class="swiper gallerySwiper">
                    <div class="swiper-wrapper">
                        @foreach ($blog->blogImages as $blogImage)
                            <div class="swiper-slide">
                                <img src="{{ Storage::url($blogImage->image_path) }}" alt="Gambar Galeri Blog" class="img-fluid">
                            </div>
                        @endforeach
                    </div>
                    @if ($blog->blogImages->count() > 1)
                        <div class="swiper-button-next"></div>
                        <div class="swiper-button-prev"></div>
                        <div class="swiper-pagination"></div>
                    @endif
                </div>
            @endif
        </div>
    </section>

    <section class="blog section" id="blog">
        <div class="blog__container container">
            <div class="content__container">
                <div class="blog__detail">
                    {!! \Illuminate\Support\Str::of($blog->description)->replaceMatches('/<oembed url="(.*?)"><\/oembed>/', function ($matches) {
                        return '<iframe width="100%" height="400" src="' . str_replace('watch?v=', 'embed/', $matches[1]) . '" frameborder="0" allowfullscreen></iframe>';
                    }) !!}
                    <div class="blog__footer" style="margin-top: 2rem;">
                        <div class="blog__reaction">{{ date('d M Y', strtotime($blog->created_at)) }}</div>
                        <div class="blog__reaction">
                            <i class="bx bx-show"></i>
                            <span>{{ $blog->reads }}</span>
                        </div>
                    </div>
                </div>
                <div class="package-travel">
                    <h3>Category</h3>
                    <ul>
                        <li>
                            <a href="{{ route('blog.category', $blog->category->slug) }}">
                                {{ $blog->category->name }}
                            </a>
                        </li>
                    </ul>
                    <h3 style="margin-bottom: 1rem">Popular Trip</h3>
                    @foreach($travel_packages as $travel_package)
                        <article class="popular__card" style="margin-bottom: 1rem">
                            <a href="{{ route('travel_package.show', $travel_package->slug) }}">
                                <img
                                    src="{{ Storage::url($travel_package->galleries->first()->images) }}"
                                    alt=""
                                    class="popular__img"
                                />
                                <div class="popular__data">
                                    <h2 class="popular__price">Rp {{ number_format($travel_package->price, 0, ',', '.') }}</h2>
                                    <h3 class="popular__title">{{ preg_replace('/-\d+$/', '', $travel_package->type) }}</h3>
                                    <p class="popular__description">{{ $travel_package->location }}</p>
                                </div>
                            </a>
                        </article>
                    @endforeach
                </div>
            </div>
        </div>
    </section>

    <section class="blog" id="blog">
        <div class="blog__container container">
            <span class="section__subtitle" style="text-align: center"
                >Related Blog</span
            >
            <h2 class="section__title" style="text-align: center">
                Find The Best Places
            </h2>

            <div class="blog__content grid">
                @foreach($relatedBlogs as $relatedBlog)
                <article class="blog__card">
                    <div class="blog__image">
                        <a href="{{ route('blog.show', $relatedBlog->slug) }}">
                            <img src="{{ Storage::url($relatedBlog->image) }}" alt="" class="blog__img" />
                        </a>
                        <a href="{{ route('blog.show', $relatedBlog->slug) }}" class="blog__button">
                            <i class="bx bx-right-arrow-alt"></i>
                        </a>
                    </div>

                    <div class="blog__data">
                        <h2 class="blog__title">{{ $relatedBlog->title }}</h2>
                        <p class="blog__description">
                            {{ $relatedBlog->excerpt }}
                        </p>

                        <div class="blog__footer">
                            <div class="blog__reaction">{{ date('d M Y', strtotime($relatedBlog->created_at)) }}</div>
                            <div class="blog__reaction">
                                <i class="bx bx-show"></i>
                                <span>{{ $relatedBlog->reads }}</span>
                            </div>
                        </div>
                    </div>
                </article>
                @endforeach
            </div>
        </div>
    </section>
@endsection

@push('style-alt')
    <style>
        blockquote {
            border-left: 8px solid #b4b4b4;
            padding-left: 1rem;
        }
        .blog__detail ul li {
            list-style: initial;
        }

        /* Styles for Swiper gallery */
        .gallery-blog {
            padding-bottom: 3rem;
        }

        .gallerySwiper {
            width: 100%;
            height: auto;
        }

        .gallerySwiper .swiper-slide {
            text-align: center;
            background: #fff;

            /* Center slide text vertically */
            display: -webkit-box;
            display: -ms-flexbox;
            display: -webkit-flex;
            display: flex;
            -webkit-box-pack: center;
            -ms-flex-pack: center;
            -webkit-justify-content: center;
            justify-content: center;
            -webkit-box-align: center;
            -ms-flex-align: center;
            -webkit-align-items: center;
            align-items: center;
        }

        .gallerySwiper .swiper-slide img {
            display: block;
            width: 100%;
            height: auto;
            object-fit: cover; /* To maintain aspect ratio */
        }

        .gallerySwiper .swiper-button-next,
        .gallerySwiper .swiper-button-prev {
            color: var(--first-color);
        }

        .gallerySwiper .swiper-pagination-bullet-active {
            background: var(--first-color);
        }
    </style>
@endpush

@push('script-alt')
    <script>
        const gallerySwiper = new Swiper(".gallerySwiper", {
            spaceBetween: 30,
            loop: true,
            pagination: {
                el: ".swiper-pagination",
                clickable: true,
            },
            navigation: {
                nextEl: ".swiper-button-next",
                prevEl: ".swiper-button-prev",
            },
        });
    </script>
@endpush