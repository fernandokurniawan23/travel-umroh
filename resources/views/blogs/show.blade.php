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
                <div class="gallery-grid">
                    @foreach ($blog->blogImages as $blogImage)
                        <div class="gallery-item">
                            <img
                                src="{{ Storage::url($blogImage->image_path) }}"
                                alt="Gambar Galeri Blog"
                                class="img-fluid zoomable-img"
                                onclick="openModal('{{ Storage::url($blogImage->image_path) }}')"
                            >
                        </div>
                    @endforeach
                </div>
            @endif
        </div>
    </section>

    <div id="imageModal" class="modal" onclick="closeModal()">
        <span class="close">&times;</span>
        <img class="modal-content" id="modalImage">
        <div class="modal-navigation">
            <button id="prevBtn" onclick="prevImage(event)">&#10094;</button>
            <button id="nextBtn" onclick="nextImage(event)">&#10095;</button>
        </div>
    </div>

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
            <span class="section__subtitle" style="text-align: center">Related Blog</span>
            <h2 class="section__title" style="text-align: center">Find The Best Places</h2>

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

        .gallery-grid {
            display: grid;
            grid-template-columns: repeat(auto-fill, minmax(250px, 1fr));
            gap: 1rem;
        }

        .gallery-item img {
            width: 100%;
            height: 200px; /* atau 250px sesuai kebutuhan */
            object-fit: cover;
            border-radius: 8px;
            cursor: pointer;
            transition: 0.3s ease;
        }

        .gallery-item img:hover {
            opacity: 0.85;
        }

        .modal {
            display: none;
            position: fixed;
            z-index: 1000;
            padding-top: 50px;
            left: 0;
            top: 0;
            width: 100%;
            height: 100%;
            overflow: auto;
            background-color: rgba(0,0,0,0.8);
            text-align: center; /* Center the content */
        }

        .modal-content {
            display: block;
            margin: auto;
            max-width: 90%;
            max-height: 90%;
        }

        .close {
            position: absolute;
            top: 15px;
            right: 35px;
            color: #fff;
            font-size: 40px;
            font-weight: bold;
            cursor: pointer;
        }

        /* Style untuk tombol navigasi */
        .modal-navigation {
            position: absolute;
            top: 50%;
            left: 0;
            right: 0;
            display: flex;
            justify-content: space-between;
            padding: 0 20px;
            pointer-events: none; /* Agar tidak mengganggu klik pada modal background untuk menutup */
        }

        .modal-navigation button {
            background: none;
            border: none;
            color: #fff;
            font-size: 2rem;
            cursor: pointer;
            opacity: 0.7;
            transition: opacity 0.3s ease;
            pointer-events: auto; /* Enable pointer events for buttons */
        }

        .modal-navigation button:hover {
            opacity: 1;
        }
    </style>
@endpush

@push('script-alt')
    <script>
        let imageSources = [];
        let currentIndex = 0;
        const modal = document.getElementById("imageModal");
        const modalImg = document.getElementById("modalImage");

        function openModal(src) {
            imageSources = Array.from(document.querySelectorAll('.gallery-item img')).map(img => img.src);
            currentIndex = imageSources.indexOf(src);
            modalImg.src = src;
            modal.style.display = "block";
        }

        function closeModal() {
            modal.style.display = "none";
        }

        function nextImage(event) {
            event.stopPropagation(); // Mencegah penutupan modal
            currentIndex++;
            if (currentIndex >= imageSources.length) {
                currentIndex = 0;
            }
            modalImg.src = imageSources[currentIndex];
        }

        function prevImage(event) {
            event.stopPropagation(); // Mencegah penutupan modal
            currentIndex--;
            if (currentIndex < 0) {
                currentIndex = imageSources.length - 1;
            }
            modalImg.src = imageSources[currentIndex];
        }
    </script>
@endpush