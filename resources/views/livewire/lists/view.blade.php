<?php

use Livewire\Volt\Component;
use App\Models\Artical; 
use Livewire\Attributes\On; 
use Illuminate\Database\Eloquent\Collection; 

new class extends Component {
    
    public Collection $articals; 

    public function mount(): void
    {
        $this->getArticals(); 
    } 

    #[On('artical-created')]
    public function getArticals(): void
    {
        $this->articals = Artical::with('user')
            ->latest()
            ->take(5)
            ->get();
    }

}; ?>
<!-- Testimonials Section -->
<section id="testimonials" class="testimonials section dark-background">

<img src="assets/img/testimonials-bg.jpg" class="testimonials-bg" alt="">

<div class="container" data-aos="fade-up" data-aos-delay="100">

  <div class="swiper init-swiper">
    <script type="application/json" class="swiper-config">
      {
        "loop": true,
        "speed": 600,
        "autoplay": {
          "delay": 5000
        },
        "slidesPerView": "auto",
        "pagination": {
          "el": ".swiper-pagination",
          "type": "bullets",
          "clickable": true
        }
      }
    </script>
    <div class="swiper-wrapper">

    @foreach ($articals as $artical)
      <div class="swiper-slide">
        <div class="testimonial-item">
          <img src="assets/img/testimonials/testimonials-1.png" class="testimonial-img" alt="">
          @auth
          <h1>{{ $artical->user->name }}</h1>
          @endauth
          <h4>{{ $artical->created_at }}</h4>
          <p>
            <i class="bi bi-quote quote-icon-left"></i>
            <span>{{ $artical->message }}</span>
            <i class="bi bi-quote quote-icon-right"></i>
          </p>
        </div>
      </div><!-- End testimonial item -->
    @endforeach 
    </div>
    <div class="swiper-pagination"></div>
  </div>

</div>

  </section><!-- /Testimonials Section -->