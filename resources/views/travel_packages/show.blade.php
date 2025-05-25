@extends('layouts.frontend')

@section('content')
<section>
    <div class="swiper-container gallery-top">
        <div class="swiper-wrapper">
            @foreach($travel_package->galleries as $gallery)
            <div class="swiper-slide feature">
                <img src="{{ Storage::url($gallery->images) }}" alt="{{ $gallery->name }}" class="feature__bg" />
                <div class="feature__container container"></div>
            </div>
            @endforeach
        </div>
        <div class="swiper-pagination"></div>
    </div>
</section>

<section class="blog section" id="blog">
    <div class="blog__container container">
        <div class="content__container">
            <div class="blog__detail">
                {!! $travel_package->description !!}
            </div>

            <div class="package-travel">
                <h3>Booking Now</h3>
                <p style="margin: 10px 0; color: #555; line-height: 1.6; text-align: left;">
                    Belum punya KTP/paspor atau ragu upload? Kolom bisa dikosongkan. Nantinya Admin akan hubungi Anda untuk lengkapi data.
                </p>
                <div class="card">
                    <form id="bookingForm" action="{{ route('booking.store') }}" method="post" enctype="multipart/form-data">
                        @csrf
                        <input type="hidden" name="travel_package_id" value="{{ $travel_package->id }}">
                        <input type="text" name="name" placeholder="Your Name" required />
                        @error('name')
                            <small class="text-danger d-block mt-1">{{ $message }}</small>
                        @enderror

                        <input type="email" name="email" placeholder="Your Email" required />
                        @error('email')
                            <small class="text-danger d-block mt-1">{{ $message }}</small>
                        @enderror

                        <input type="number" name="number_phone" placeholder="Your Number" required />
                        @error('number_phone')
                            <small class="text-danger d-block mt-1">{{ $message }}</small>
                        @enderror

                        <div class="ktp-file">
                            <label for="ktp" class="ktp-file-label">Your KTP (Opsional)</label>
                            <input type="file" class="ktp-file-input" id="ktp" name="ktp" accept="image/*" />
                        </div>

                        <div class="paspor-file">
                            <label for="paspor" class="paspor-file-label">Your Passport (Opsional)</label>
                            <input type="file" class="paspor-file-input" id="paspor" name="paspor" accept="image/*" />
                        </div>

                        {{-- reCAPTCHA --}}
                        <div class="form-group mt-3">
                            {!! NoCaptcha::display() !!}
                            @error('g-recaptcha-response')
                                <small class="text-danger d-block mt-1">{{ $message }}</small>
                            @enderror
                            <small id="recaptcha-error" class="text-danger d-block mt-1" style="display: none;"></small>
                        </div>

                        <button type="submit" class="button button-booking">Send</button>
                    </form>
                </div>
            </div>
        </div>
    </div>
</section>

<div class="custom-shape-divider-top-1747485905" style="background-color: #84b2c7;">
    <svg data-name="Layer 1" xmlns="http://www.w3.org/2000/svg" viewBox="0 0 1200 120" preserveAspectRatio="none">
        <path d="M321.39,56.44c58-10.79,114.16-30.13,172-41.86,82.39-16.72,168.19-17.73,250.45-.39C823.78,31,906.67,72,985.66,92.83c70.05,18.48,146.53,26.09,214.34,3V0H0V27.35A600.21,600.21,0,0,0,321.39,56.44Z" class="shape-fill" fill="#E0F3F9"></path>
    </svg>
</div>

<section class="section" id="popular">
    <div class="container">
        <span class="section__subtitle" style="text-align: center">Package Travel</span>
        <h2 class="section__title" style="text-align: center">The Best Tour For You</h2>

        <div class="popular__all">
            @foreach($travel_packages as $travel_package)
            <article class="popular__card">
                <a href="{{ route('travel_package.show', $travel_package->slug) }}">
                    <img src="{{ Storage::url($travel_package->galleries->first()->images) }}" alt="" class="popular__img" />
                    <div class="popular__data">
                        <h2 class="popular__price">Rp {{ number_format($travel_package->price, 0, ',', '.') }}</h2>
                        <h3 class="popular__description">{{ $travel_package->type }}</h3>
                        <p class="popular__title">{{ preg_replace('/-\d+$/', '', $travel_package->location) }}</p>
                    </div>
                </a>
            </article>
            @endforeach
        </div>
    </div>
</section>

@if(session()->has('message'))
<div id="alert" class="alert">
    {{ session()->get('message') }}
    <i class='bx bx-x alert-close' id="close"></i>
</div>
@endif
@endsection

@push('style-alt')
<link rel="stylesheet" href="https://unpkg.com/swiper/swiper-bundle.min.css" />
<style>
    .swiper-button-next, .swiper-button-prev {
        color: #000;
        top: 50%;
        transform: translateY(-50%);
        z-index: 11;
    }

    .swiper-container {
        position: relative;
    }

    .swiper-pagination {
        position: absolute;
        bottom: 15px;
        left: 0;
        width: 100%;
        text-align: center;
        z-index: 10;
    }

    .gallery-top {
        position: relative;
        height: 500px;
        margin-bottom: 2rem;
        overflow: hidden;
    }

    .feature {
        display: flex !important;
        justify-content: center;
        align-items: center;
        height: 500px;
        background-color: #f9f9f9;
    }

    .feature__bg {
        max-height: 100%;
        max-width: 100%;
        object-fit: contain;
        margin: auto;
    }

    .alert {
        position: absolute;
        top: 120px;
        left: 0;
        right: 0;
        background-color: var(--second-color);
        color: white;
        padding: 1rem;
        width: 70%;
        z-index: 99;
        margin: auto;
        border-radius: .25rem;
        text-align: center;
    }

    .alert-close {
        font-size: 1.5rem;
        color: #090909;
        position: absolute;
        top: .25rem;
        right: .5rem;
        cursor: pointer;
    }
</style>
@endpush

@push('script-alt')
<script src="https://unpkg.com/swiper/swiper-bundle.min.js"></script>
<script>
    const galleryTop = new Swiper('.gallery-top', {
        effect: 'slide',
        loop: true,
        slidesPerView: 1,
        spaceBetween: 10,
        pagination: {
            el: '.swiper-pagination',
            clickable: true,
        },
    });

    const close = document.getElementById('close');
    const alert = document.getElementById('alert');
    if (close) {
        close.addEventListener('click', function () {
            alert.style.display = 'none';
        });
    }
</script>

{!! NoCaptcha::renderJs() !!}
<script>
document.addEventListener('DOMContentLoaded', function() {
    const bookingForm = document.getElementById('bookingForm');

    bookingForm.addEventListener('submit', function(event) {
        if (!{{ Auth::check() ? 'true' : 'false' }}) {
            event.preventDefault();
            window.location.href = '{{ route('login') }}';
        } else {
            // Lanjutkan pengiriman form jika user sudah login
        }

        // Validasi reCAPTCHA
        const errorContainer = document.getElementById('recaptcha-error');
        if (typeof grecaptcha !== 'undefined') {
            var response = grecaptcha.getResponse();
            if (response.length === 0) {
                event.preventDefault();
                if (errorContainer) {
                    errorContainer.innerText = '⚠️ Captcha belum diisi.';
                    errorContainer.style.display = 'block';
                    errorContainer.style.color = 'red';
                    errorContainer.style.fontWeight = 'bold';
                }
            } else {
                if (errorContainer) {
                    errorContainer.innerText = '';
                    errorContainer.style.display = 'none';
                }
            }
        } else {
            event.preventDefault();
            if (errorContainer) {
                errorContainer.innerText = '⚠️ Captcha belum siap. Silakan coba lagi.';
                errorContainer.style.display = 'block';
                errorContainer.style.color = 'red';
                errorContainer.style.fontWeight = 'bold';
            }
        }
    });
});
</script>
@endpush