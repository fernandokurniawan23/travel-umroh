@extends('layouts.frontend')

@section('content')
<!--==================== HOME ====================-->
<section>
    <div class="swiper-container">
        <div>
            <!--========== feature 1 ==========-->
            <section class="feature">
                <img
                    src="{{ asset('frontend/assets/img/home.jpg') }}"
                    alt=""
                    class="feature__bg" />
                <div class="bg__overlay">
                    <div class="feature__container container">
                        <div
                            class="feature__data"
                            style="z-index: 99; position: relative">
                            <h2 class="feature__subtitle">
                                Explore
                            </h2>
                            <h1 class="feature__title">
                                Perjalanan Suci Menuju Baitullah
                            </h1>
                            <h2 class="feature__licencse">
                                Izin Umroh U.14/2022
                            </h2>
                            <p class="feature__description">
                                Jalani ibadah dengan nyaman dan penuh ketenangan, <br />
                                kami siap menemani langkah Anda.
                                <br /><strong style="color: gold;">Kesempatan emas! Booking perjalanan suci Anda dengan DP terjangkau, hanya 1 juta.</strong>
                            </p>
                        </div>
                    </div>
                </div>
            </section>
        </div>
    </div>
</section>

<!--==================== POPULAR ====================-->
<section class="section" id="popular">
    <div class="container">
        <span class="section__subtitle" style="text-align: center">Best Choice</span>
        <h2 class="section__title" style="text-align: center">
            Popular Package
        </h2>

        <div class="popular__container swiper swiper-container">
            <div class="swiper-wrapper">
                @foreach($travel_packages as $travel_package)
                <article class="popular__card swiper-slide">
                    <a href="{{ route('travel_package.show', $travel_package->slug) }}">
                        <img
                            src="{{ Storage::url($travel_package->galleries->first()->images) }}"
                            alt=""
                            class="popular__img" />
                        <div class="popular__data">
                            <h2
                                class="popular__price">Rp {{ number_format($travel_package->price, 0, ',', '.') }}
                            </h2>
                            <h3 class="popular__title">{{ preg_replace('/-\d+$/', '', $travel_package->type) }}</h3>
                            <p class="popular__description">{{ $travel_package->location }}</p>
                        </div>
                    </a>
                </article>
                @endforeach
            </div>

            <div class="swiper-button-next">
                <i class="bx bx-chevron-right"></i>
            </div>
            <div class="swiper-button-prev">
                <i class="bx bx-chevron-left"></i>
            </div>
        </div>
    </div>
</section>


<div class="custom-shape-divider-top-1747485904" style="background-color: #A8D5E3;">
    <svg data-name="Layer 1" xmlns="http://www.w3.org/2000/svg" viewBox="0 0 1200 120" preserveAspectRatio="none">
        <path d="M321.39,56.44c58-10.79,114.16-30.13,172-41.86,82.39-16.72,168.19-17.73,250.45-.39C823.78,31,906.67,72,985.66,92.83c70.05,18.48,146.53,26.09,214.34,3V0H0V27.35A600.21,600.21,0,0,0,321.39,56.44Z" class="shape-fill" fill="#E0F3F9"></path>
    </svg>
</div>
<!--==================== VALUE ====================-->
<section class="value section" id="value">
    <div class="value__container container grid">
        <div class="value__images">
            <div class="value__orbe"></div>

            <div class="value__img">
                <img src="{{ asset('frontend/assets/img/team.jpg') }}" alt="" />
            </div>
        </div>

        <div class="value__content">
            <div class="value__data">
                <span class="section__subtitle">Why Choose Us</span>
                <h2 class="section__title">
                    Perjalanan Umroh yang Nyaman & Penuh Berkah
                </h2>
                <p class="value__description">
                    Dengan Izin Umroh U.14/2022 PT. Rihlah Assofa Amanah, Haromain Travel siap melayani Anda dengan pengalaman terbaik dalam perjalanan ibadah umroh.
                    <strong style="color: navy;">Jangan tunda! Wujudkan impian umroh Anda, cukup dengan DP 1 Juta.</strong>
                </p>
            </div>

            <div class="value__accordion">
                <div class="value__accordion-item">
                    <header class="value__accordion-header">
                        <i
                            class="bx bxs-shield-x value-accordion-icon"></i>
                        <h3 class="value__accordion-title">
                            Destinasi Terbaik & Penuh Berkah
                        </h3>
                        <div class="value__accordion-arrow">
                            <i class="bx bxs-down-arrow"></i>
                        </div>
                    </header>

                    <div class="value__accordion-content">
                        <p class="value__accordion-description">
                            Nikmati perjalanan spiritual ke Tanah Suci dengan
                            fasilitas terbaik dan pendamping ibadah berpengalaman.
                        </p>
                    </div>
                </div>
                <div class="value__accordion-item">
                    <header class="value__accordion-header">
                        <i
                            class="bx bxs-x-square value-accordion-icon"></i>
                        <h3 class="value__accordion-title">
                            Harga Terjangkau & Transparan
                        </h3>
                        <div class="value__accordion-arrow">
                            <i class="bx bxs-down-arrow"></i>
                        </div>
                    </header>

                    <div class="value__accordion-content">
                        <p class="value__accordion-description">
                            Kami menawarkan harga yang kompetitif
                            tanpa biaya tersembunyi, memberikan kepastian bagi jamaah.
                        </p>
                    </div>
                </div>
                <div class="value__accordion-item">
                    <header class="value__accordion-header">
                        <i
                            class="bx bxs-bar-chart-square value-accordion-icon"></i>
                        <h3 class="value__accordion-title">
                            Rencana Perjalanan yang Tepat Waktu
                        </h3>
                        <div class="value__accordion-arrow">
                            <i class="bx bxs-down-arrow"></i>
                        </div>
                    </header>

                    <div class="value__accordion-content">
                        <p class="value__accordion-description">
                            Jadwal perjalanan yang tersusun rapi agar ibadah berjalan lancar dan khusyuk.
                        </p>
                    </div>
                </div>
                <div class="value__accordion-item">
                    <header class="value__accordion-header">
                        <i
                            class="bx bxs-check-square value-accordion-icon"></i>
                        <h3 class="value__accordion-title">
                            Jaminan Keamanan & Kenyamanan
                        </h3>
                        <div class="value__accordion-arrow">
                            <i class="bx bxs-down-arrow"></i>
                        </div>
                    </header>

                    <div class="value__accordion-content">
                        <p class="value__accordion-description">
                            Layanan profesional, hotel dekat Masjidil Haram & Masjid Nabawi,
                            serta fasilitas terbaik untuk kenyamanan jamaah.
                        </p>
                    </div>
                </div>
            </div>
        </div>
    </div>
</section>

<div class="custom-shape-divider-top-1747487905" style="background-color:rgb(255, 255, 255);">
    <svg data-name="Layer 1" xmlns="http://www.w3.org/2000/svg" viewBox="0 0 1200 120" preserveAspectRatio="none">
        <path d="M0,0V46.29c47.79,22.2,103.59,32.17,158,28,70.36-5.37,136.33-33.31,206.8-37.5C438.64,32.43,512.34,53.67,583,72.05c69.27,18,138.3,24.88,209.4,13.08,36.15-6,69.85-17.84,104.45-29.34C989.49,25,1113-14.29,1200,52.47V0Z" opacity=".25" class="shape-fill"></path>
        <path d="M0,0V15.81C13,36.92,27.64,56.86,47.69,72.05,99.41,111.27,165,111,224.58,91.58c31.15-10.15,60.09-26.07,89.67-39.8,40.92-19,84.73-46,130.83-49.67,36.26-2.85,70.9,9.42,98.6,31.56,31.77,25.39,62.32,62,103.63,73,40.44,10.79,81.35-6.69,119.13-24.28s75.16-39,116.92-43.05c59.73-5.85,113.28,22.88,168.9,38.84,30.2,8.66,59,6.17,87.09-7.5,22.43-10.89,48-26.93,60.65-49.24V0Z" opacity=".5" class="shape-fill"></path>
        <path d="M0,0V5.63C149.93,59,314.09,71.32,475.83,42.57c43-7.64,84.23-20.12,127.61-26.46,59-8.63,112.48,12.24,165.56,35.4C827.93,77.22,886,95.24,951.2,90c86.53-7,172.46-45.71,248.8-84.81V0Z" class="shape-fill"></path>
    </svg>
</div>

<!-- blog -->
<section class="blog section" id="blog">
    <div class="blog__container container">
        <span class="section__subtitle" style="text-align: center">Our Blog</span>
        <h2 class="section__title" style="text-align: center">
            The Best Trip For You
        </h2>

        <div class="blog__content grid">
            @foreach($blogs as $blog)
            <article class="blog__card">
                <div class="blog__image">
                    <a href="{{ route('blog.show', $blog->slug) }}">
                        <img src="{{ Storage::url($blog->image) }}" alt="" class="blog__img" />
                    </a>
                    <a href="{{ route('blog.show', $blog->slug) }}" class="blog__button">
                        <i class="bx bx-right-arrow-alt"></i>
                    </a>
                </div>

                <div class="blog__data">
                    <h2 class="blog__title">
                        {{ $blog->title }}
                    </h2>
                    <p class="blog__description">
                        {{ $blog->excerpt }}
                    </p>

                    <div class="blog__footer">
                        <div class="blog__reaction">
                            {{ date('d M Y', strtotime($blog->created_at)) }}
                        </div>
                        <div class="blog__reaction">
                            <i class="bx bx-show"></i>
                            <span>{{ $blog->reads }}</span>
                        </div>
                    </div>
                </div>
            </article>
            @endforeach
        </div>
    </div>
</section>
@endsection