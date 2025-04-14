@extends('layouts.frontend')

@section('content')
<!--==================== HOME ====================-->
<section>
        <div class="swiper-container gallery-top">
          <div class="swiper-wrapper">
            <!--========== FEATURE 1 ==========-->
            <section class="feature swiper-slide">
              <img
                src="{{ asset('frontend/assets/img/contact-hero.jpg') }}"
                alt=""
                class="feature__bg"
              />
              <div class="bg__overlay">
                <div class="feature__container container">
                  <div class="feature__data">
                    <h2 class="feature__subtitle">Need Travel</h2>
                    <h1 class="feature__title">Contact Us</h1>
                  </div>
                </div>
              </div>
            </section>
          </div>
        </div>
      </section>
      <!--==================== CONTACT ====================-->
      <section class="contact section" id="contact">
        <div class="contact__container container grid">
          <div class="contact__images">
            <div class="contact__orbe"></div>

            <div class="contact__img">
              <img src="{{ asset('frontend/assets/img/contact.jpg') }}" alt="" />
            </div>
          </div>

          <div class="contact__content">
            <div class="contact__data">
              <span class="section__subtitle">Need Help</span>
              <h2 class="section__title">Jangan ragu untuk menghubungi kami</h2>
              <p class="contact__description">
                Apakah Anda membutuhkan bantuan dalam merencanakan perjalanan umrah berikutnya?
                Atau mungkin membutuhkan panduan untuk perjalanan pertama Anda? 
                Kami siap memberikan informasi dan konsultasi terkait perjalanan umrah Anda. Hubungi kami sekarang juga!
              </p>
            </div>

            <div class="contact__card">
              <div class="contact__card-box">
                <div class="contact__card-info">
                  <i class="bx bxs-phone-call"></i>
                  <div>
                    <h3 class="contact__card-title">Call</h3>
                    <p class="contact__card-description">+6281285708894</p>
                  </div>
                </div>

                <button class="button contact__card-button" onclick="window.location.href='tel:+6281285708894'">Call Now</button>
              </div>
              <div class="contact__card-box">
                <div class="contact__card-info">
                  <i class="bx bxs-message-rounded-dots"></i>
                  <div>
                    <h3 class="contact__card-title">Whatsapp</h3>
                    <p class="contact__card-description">+6281285708894</p>
                  </div>
                </div>

                <button class="button contact__card-button" onclick="window.open('https://api.whatsapp.com/send?phone=6281285708894&text=Halo%20saya%20ingin%20mendapatkan%20informasi%20tentang%20perjalanan%20umrah', '_blank')">Chat Now</button>
                <!-- <button class="button contact__card-button">Chat Now</button> -->
              </div>
              
              <div class="contact__card-box">
                <div class="contact__card-info">
                  <i class="bx bxs-phone-call"></i>
                  <div>
                    <h3 class="contact__card-title">Message</h3>
                    <p class="contact__card-description">+6281285708894</p>
                  </div>
                </div>

                <button class="button contact__card-button" onclick="window.location.href='sms:+6281285708894?body=Halo%20saya%20ingin%20bertanya%20tentang%20perjalanan%20umrah'">Message Now</button>
              </div>
              <div class="contact__card-box">
                <div class="contact__card-info">
                    <i class="bx bxs-envelope"></i> <!-- Ikon untuk email -->
                    <div>
                        <h3 class="contact__card-title">Email</h3>
                        <p class="contact__card-description">
                            <span style="font-size: 9px; white-space: nowrap;">haromaintravel@gmail.com</span>
                        </p>
                    </div>
                </div>

                <button class="button contact__card-button" onclick="window.location.href='mailto:haromaintravel.com?subject=Ingin%20Bertanya%20Tentang%20Perjalanan%20Umrah&body=Halo%2C%20Saya%20ingin%20menanyakan%20tentang%20perjalanan%20umrah'">Send Email Now</button>
            </div>
            </div>
          </div>
        </div>
      </section>
@endsection