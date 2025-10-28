@extends('clientTemplate.app')

@section('content')
 <!-- ======= Hero Section ======= -->
 <section id="hero">
    <div id="heroCarousel" data-bs-interval="5000" class="carousel slide carousel-fade" data-bs-ride="carousel">

      <ol class="carousel-indicators" id="hero-carousel-indicators"></ol>

      <div class="carousel-inner" role="listbox">

        <!-- Slide 1 -->
        @foreach ($publications as $pub)
            
        
        <div class="carousel-item active" style="background-image: url({{Storage::url($pub->photo_pub) }})">
          <div class="container">
            <h2>{{$pub->titre_pub}}</h2>
            <p>{{$pub->description_pub}}</p>
            {{-- <a href="#about" class="btn-get-started scrollto">Read More</a> --}}
          </div>
        </div>
         @endforeach
        <!-- Slide 2 -->
        {{-- <div class="carousel-item" style="background-image: url(assets1/img/slide/slide-2.jpg)">
          <div class="container">
            <h2>Lorem Ipsum Dolor</h2>
            <p>Ut velit est quam dolor ad a aliquid qui aliquid. Sequi ea ut et est quaerat sequi nihil ut aliquam. Occaecati alias dolorem mollitia ut. Similique ea voluptatem. Esse doloremque accusamus repellendus deleniti vel.</p>
            <a href="#about" class="btn-get-started scrollto">Read More</a>
          </div>
        </div> --}}

        <!-- Slide 3 -->
        {{-- <div class="carousel-item" style="background-image: url(assets1/img/slide/slide-3.jpg)">
          <div class="container">
            <h2>Sequi ea ut et est quaerat</h2>
            <p>Ut velit est quam dolor ad a aliquid qui aliquid. Sequi ea ut et est quaerat sequi nihil ut aliquam. Occaecati alias dolorem mollitia ut. Similique ea voluptatem. Esse doloremque accusamus repellendus deleniti vel.</p>
            <a href="#about" class="btn-get-started scrollto">Read More</a>
          </div>
        </div> --}}

      </div>

      <a class="carousel-control-prev" href="#heroCarousel" role="button" data-bs-slide="prev">
        <span class="carousel-control-prev-icon bi bi-chevron-left" aria-hidden="true"></span>
      </a>

      <a class="carousel-control-next" href="#heroCarousel" role="button" data-bs-slide="next">
        <span class="carousel-control-next-icon bi bi-chevron-right" aria-hidden="true"></span>
      </a>

    </div>
  </section><!-- End Hero -->
    <div class="site-section">
        <div class="container">
            <div class="row">
                <div class="title-section text-center col-12">
                    <h2 class="text-uppercase">The Latest Products</h2>
                </div>
            </div>

            <div class="row">
                @forelse ($medicaments as $med)
                    <div class="col-sm-6 col-lg-4 text-center item mb-4">
                        @if ($med->quantite > 0)
                        <span class="tag bg-green" style="background-color: rgb(77, 218, 77)">En stock</span>
                    @else
                        <span class="tag bg-red" style="background-color:red">Hors stock</span>
                    @endif
                        <a href="{{ route('client.product', $med->code_barre) }}">
                            <img src="{{Storage::url($med->photo_med) }}" alt="Image" width="70%">
                        </a>
                        <h3 class="text-dark">
                            <a href="shop-single.html">{{ $med->nom_med }}</a>
                        </h3>
                        <p class="price"><del>{{ $med->prix_unit }} DH</del> &mdash; {{ $med->prix_unit*(1-$med->pourcentage/100) }} DH</p>
                    </div>
                @empty
                    <div class="col-sm-6 col-lg-4 text-center item mb-4">
                        <h2 colspan="3" align="center"> aucun médicament 🤷‍♂️</h2>
                    </div>
                @endforelse
            </div>

            <div class="row mt-5">
                <div class="col-12 text-center">
                    <a href="{{ route('client.products') }}" class="btn btn-primary px-4 py-3" style="background-color:#3fbbc0;border:none">View All Products</a>
                </div>
            </div>
        </div>
    </div>

    <div class="site-section bg-light">
        <div class="container">
            <div class="row">
                <div class="title-section text-center col-12">
                    <h2 class="text-uppercase">Products in stock</h2>
                </div>
            </div>
            <div class="row">
                <div class="col-md-12 block-3 products-wrap">
                    <div class="nonloop-block-3 owl-carousel">
                        @forelse ($fmedicaments as $fmed)
                            <div class="text-center item mb-4">
                                <a href="{{ route('client.product', $fmed->code_barre) }}">
                                    <img src="{{Storage::url($fmed->photo_med) }}" alt="Image" height="400px">
                                    <h3 class="text-dark">{{ $fmed->nom_med }}</h3>
                                </a>
                                <p class="price"><del>{{ $fmed->prix_unit }} DH</del> &mdash; {{ $fmed->prix_unit*(1-$fmed->pourcentage/100) }} DH</p>
                                {{-- <p class="price">{{ $fmed->prix_unit }} DH</p> --}}
                            </div>
                        @empty
                            {{-- Aucun médicament --}}
                        @endforelse
                    </div>
                </div>
            </div>
        </div>
    </div>
@endsection
