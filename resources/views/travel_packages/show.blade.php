@extends('layouts.frontend')

@section('content')
 <!--==================== HOME ====================-->
 <section>
        <div class="swiper-container gallery-top">
          <div class="swiper-wrapper">
          @foreach($travel_package->galleries as $gallery)
            <section class="feature swiper-slide">
              <img src="{{ Storage::url($gallery->images) }}" alt="" class="feature__bg" />

              <div class="feature__container container">
                <div class="feature__data">
                  <h2 class="feature__subtitle">Explore</h2>
                  <h1 class="feature__title">{{ $gallery->name }}</h1>
                </div>
              </div>
            </section>
          @endforeach
          </div>
        </div>

        <!--========== CONTROLS ==========-->
        <!-- <div class="controls gallery-thumbs">
          <div class="controls__container swiper-wrapper">
           @foreach($travel_package->galleries as $gallery)
            <img
              src="{{ Storage::url($gallery->images) }}"
              alt=""
              class="controls__img swiper-slide"
            />
           @endforeach
          </div>
        </div> -->
      </section>

      <section class="blog section" id="blog">
        <div class="blog__container container">
          <div class="content__container">
            <div class="blog__detail">
            {!! $travel_package->description !!}
            </div>
            <div class="package-travel">
                <h3>Booking Now</h3>
                <div class="card">
                    <form action="{{ route('booking.store') }}" method="post" enctype="multipart/form-data">
                        @csrf 
                        <input type="hidden" name="travel_package_id" value="{{ $travel_package->id }}">
                        <input type="text" name="name" placeholder="Your Name" {{ Auth::check() ? '' : 'disabled' }} />
                        <input type="email" name="email" placeholder="Your Email" {{ Auth::check() ? '' : 'disabled' }} />
                        <input type="number" name="number_phone" placeholder="Your Number" {{ Auth::check() ? '' : 'disabled' }} />
                        <div class="ktp-file">
                            <label for="ktp" class="ktp-file-label">Your KTP</label>
                            <input type="file" class="ktp-file-input" id="ktp" name="ktp" accept="image/*" required {{ Auth::check() ? '' : 'disabled' }} />
                        </div>
                        <div class="paspor-file">
                            <label for="paspor" class="paspor-file-label">Your Passport (Opsional)</label>
                            <input type="file" class="paspor-file-input" id="paspor" name="paspor" accept="image/*" {{ Auth::check() ? '' : 'disabled' }} />
                        </div>
                        <button type="submit" class="button button-booking" {{ Auth::check() ? '' : 'disabled' }}>Send</button>
                        @if(!Auth::check())
                            <p class="text-danger" style="text-align:center; margin-top:10px;">Silakan <a href="{{ route('login') }}">login</a> terlebih dahulu untuk melakukan booking.</p>
                        @endif
                    </form>
                </div>
            </div>
          </div>
        </div>
      </section>

      <section class="section" id="popular">
        <div class="container">
          <span class="section__subtitle" style="text-align: center"
            >Package Travel</span
          >
          <h2 class="section__title" style="text-align: center">
            The Best Tour For You
          </h2>

          <div class="popular__all">
            @foreach($travel_packages as $travel_package)
            <article class="popular__card">
              <a href="{{ route('travel_package.show', $travel_package->slug) }}">
                <img
                  src="{{ Storage::url($travel_package->galleries->first()->images) }}"
                  alt=""
                  class="popular__img"
                />
                <div class="popular__data">
                  <h2 class="popular__price">Rp {{ number_format($travel_package->price, 0, ',', '.') }}</h2>
                  <h3 class="popular__title">{{ preg_replace('/-\d+$/', '', $travel_package->location) }}</h3>
                  <p class="popular__description">{{ $travel_package->type }}</p>
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
<style>
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

  blockquote {
    border-left: 8px solid #b4b4b4;
    padding-left: 1rem;
  }

  .blog__detail ul li {
    list-style: initial;
  }

  /* Wrapper swiper-slide agar gambar & konten tidak overlap */
  section.feature.swiper-slide {
    display: flex !important;
    flex-direction: column;
    justify-content: center;
    align-items: center;
    width: 100% !important;
    height: 500px; /* Batasi tinggi slide */
    position: relative;
    overflow: hidden;
    background-color: #f9f9f9;
  }

  /* Gambar tetap proporsional & tidak membesar */
  .feature__bg {
    max-height: 100%;
    max-width: 100%;
    object-fit: contain;
    margin: auto;
    display: block;
  }

  /* Data tulisan di atas gambar */
  .feature__data {
    position: absolute;
    bottom: 20px;
    left: 50%;
    transform: translateX(-50%);
    text-align: center;
    background: transparent;
    padding: 0;
  }

.feature__title {
  font-size: 1.5rem; /* Ukuran diperkecil */
  font-weight: 600;
  color: #000 !important;
  margin-top: 0.5rem;
  white-space: nowrap; /* Paksa satu baris */
  overflow: hidden;
  text-overflow: ellipsis;
}

.feature__subtitle {
  font-size: 1rem;
  font-weight: 500;
  color: #000 !important;
}

.blog__container {
  margin-top: 2rem;
  position: relative;
  z-index: 2;
}


</style>
@endpush

@push('script-alt')
<script>
      // let galleryThumbs = new Swiper('.gallery-thumbs', {
      //   spaceBetween: 0,
      //   slidesPerView: 0,
      // });

      let galleryTop = new Swiper('.gallery-top', {
        effect: 'fade',
        loop: true,

        thumbs: {
          swiper: galleryThumbs,
        },
      });

      const close = document.getElementById('close');
      const alert = document.getElementById('alert');
      if(close) {
        close.addEventListener('click', function() {
          alert.style.display = 'none';
        })
      }
    </script>
@endpush