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
                    Dengan Izin Umroh U.14/2022 PT. Rihlah Assofa Amanah, Haromain Travel siap melayani Anda dengan pengalaman terbaik dalam perjalanan ibadah umroh. <strong style="color: #1e88e5;">Jangan tunda! Wujudkan impian umroh Anda, cukup dengan DP 1 Juta.</strong>
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