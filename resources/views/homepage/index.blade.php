@extends('layouts.template')
@section('content')
<div style="margin-left: 65px; margin-right: 65px; margin-top: 30px;">
  <!-- carousel -->
  <div id="carouselExampleControls" class="carousel slide" data-bs-ride="carousel">
    <div class="carousel-inner">
      @foreach($itemslide as $index => $slide )
          @if($index == 0)
          <div class="carousel-item active">
              <img src="{{ \Storage::url($slide->foto) }}" class="d-block w-100" alt="{{ $slide->caption_title }}">
              <div class="carousel-caption d-none d-md-block">
                <h5 class="invisible">{{ $slide->caption_title }}</h5>
                <p class="invisible">{{ $slide->caption_content }}</p>
              </div>
          </div>
          @else
          <div class="carousel-item">
              <img src="{{ \Storage::url($slide->foto) }}" class="d-block w-100" alt="{{ $slide->caption_title }}">
              <div class="carousel-caption d-none d-md-block">
                <h5 class="invisible">{{ $slide->caption_title }}</h5>
                <p class="invisible">{{ $slide->caption_content }}</p>
              </div>
          </div>
          @endif
          @endforeach    
    </div>
    <button class="carousel-control-prev" type="button" data-bs-target="#carouselExampleControls" data-bs-slide="prev">
      <span class="carousel-control-prev-icon" aria-hidden="true"></span>
      <span class="visually-hidden">Previous</span>
    </button>
    <button class="carousel-control-next" type="button" data-bs-target="#carouselExampleControls" data-bs-slide="next">
      <span class="carousel-control-next-icon" aria-hidden="true"></span>
      <span class="visually-hidden">Next</span>
    </button>
  </div>
  <!-- end carousel -->
</div>
<!-- kategori produk -->
<div class="bg-transparent" style="margin-left: 50px; margin-right: 50px; margin-top: 30px;">
  <h4 style="margin-left: 15px;" class="fw-bolder">Categories</h4>
  <div class="btn-group d-flex flex-wrap shadow-none mt-1 mt-lg-1 mt-md-1 mt-xl-1 ms-2 ms-lg-2 ms-md-2 ms-xl-2">
    @foreach($itemkategori as $kategori)
    <a style="width: 150px; font-size: 13px;" href="category/{{ $kategori->slug_kategori }}" class="btn btn-outline-secondary rounded-3 align-self-center mt-1 mt-lg-1 mt-md-1 mt-xl-1 mx-2 mx-lg-2 mx-md-2 mx-xl-2 rounded">
      <i class="fa-solid fa-person" style="margin-right: 10px;"></i>
      {{ $kategori->nama_kategori }}</span>
    </a>
    @endforeach
  </div>
</div>
<!-- end kategori produk -->
  <!-- produk Promo-->
  <div style="margin-left: 50px; margin-right: 50px; margin-top: 30px;">
    <h4 style="margin-left: 15px;" class="fw-bolder">Promo</h4>
    <div class="row row-cols-1 row-cols-lg-5 g-2 g-lg-3 ms-2 ms-lg-2 ms-md-2 ms-xl-2">
      @foreach($itempromo as $promo)
      <div class="col">
        <div class="card" style="height: 415px;">
          <div style="height: 190px; max-width: 270px; display: flex; align-items: center; margin-left: auto; margin-right: auto;">
            <img src="{{ Storage::url($promo->produk->foto) }}" class="card-img-top" style="max-height: 190px; width: 100%;" alt="...">
          </div>
          <div class="card-body">
            <div>
              <p class="card-text">{{ $promo->produk->nama_produk }}</p>
            </div>
            <div>
              <p class="card-text fw-bold">Harga Diskon</p>
            </div>
            <div>
              <button type="button" class="btn btn-danger"
                style="--bs-btn-padding-y: .25rem; --bs-btn-padding-x: .5rem; --bs-btn-font-size: .75rem;" disabled>
              </button>
              <span class="text-muted text-decoration-line-through">Rp. {{ number_format($promo->harga_awal, 2) }}</span>
            </div>
            <div>
              <span>Rp. {{ number_format($promo->harga_akhir, 2) }}</span>
            </div>
            <div>
              <i class="fa-solid fa-star text-warning"></i>
              <span>5.0</span>
            </div>
          </div>
          <form action="{{ route('cartdetail.store') }}" method="POST" class="mx-3" style="display: inline-block;">
              @csrf
              <input type="hidden" name="produk_id" value={{$promo->produk->id}}>
              <button  class="btn btn btn-outline-dark btn-sm mb-2" type="submit" style=" width:100%;">
              Add To Cart
              </button>
          </form>
          <a href="{{ URL::to('produk/'.$promo->produk->slug_produk ) }}" type="button" class="btn btn-dark btn-sm mb-2 mx-3">Details</a>
        </div>
      </div>
      @endforeach
    </div>
  </div>
  <!-- end produk promo -->
  <!-- produk Terbaru-->
  <div style="margin-left: 50px; margin-right: 50px; margin-top: 30px;">
    <h4 style="margin-left: 15px;" class="fw-bolder">Terbaru</h4>
    <div class="row row-cols-1 row-cols-lg-5 g-2 g-lg-3 ms-2 ms-lg-2 ms-md-2 ms-xl-2">
      @foreach($itemproduk as $produk)
      <div class="col">
        <div class="card" style="height: 415px;">
          <div style="height: 190px; max-width: 270px; display: flex; align-items: center; margin-left: auto; margin-right: auto;">
            <img src="{{ Storage::url($produk->foto) }}" class="card-img-top" style="max-height: 190px; width: 100%;" alt="...">
          </div>
          <div class="card-body">
            <div>
              <p class="card-text">{{ $produk->nama_produk }}</p>
            </div>
            @if($produk->id == $promo->produk_id)
              <div>
                <p class="card-text fw-bold">Harga Diskon</p>
              </div>
              <div>
                <button type="button" class="btn btn-danger"
                  style="--bs-btn-padding-y: .25rem; --bs-btn-padding-x: .5rem; --bs-btn-font-size: .75rem;" disabled>
                </button>
                <span class="text-muted text-decoration-line-through">Rp. {{ number_format($promo->harga_awal, 2) }}</span>
              </div>
              <div>
                <span>Rp. {{ number_format($promo->harga_akhir, 2) }}</span>
              </div>
          @else
              <div>
                <p class="card-text fw-bold">Harga</p>
              </div>
              <div>
                <span>Rp. {{ number_format($produk->harga, 2) }}</span>
              </div>
          @endif
            <div>
              <i class="fa-solid fa-star text-warning"></i>
              <span>5.0</span>
            </div>
          </div>
          <form action="{{ route('cartdetail.store') }}" method="POST" class="mx-3" style="display: inline-block;">
              @csrf
              <input type="hidden" name="produk_id" value={{$produk->id}}>
              <button  class="btn btn btn-outline-dark btn-sm mb-2" type="submit" style=" width:100%;">
              Add To Cart
              </button>
          </form>
          <a href="{{ URL::to('produk/'.$produk->slug_produk ) }}" type="button" class="btn btn-dark btn-sm mb-2 mx-3">Details</a>
        </div>
      </div>
      @endforeach
    </div>
  </div>
  <!-- end produk terbaru -->
  <!-- tentang toko -->
  <hr>
  <div class="mt-4 px-5">
    <h5 class="text-center">GoodFance</h5>
    <p>
      GoodFance adalah e-commerce baru dari Indonesia yang menjual produk produk tentang fashion. Website made in china
    </p>
    <p>
      Toko adalah demo membangun toko online menggunakan laravel framework. Di dalam demo ini terdapat user bisa menginput data kategori, produk dan transaksi.
      Lorem, ipsum dolor sit amet consectetur adipisicing elit. Hic laborum aliquam dolorum sequi nulla maiores quos incidunt veritatis numquam suscipit. Cumque dolore rem obcaecati. Eos quod ad non veritatis assumenda.
    </p>
    <p class="text-center">
      <a href="" class="btn btn-outline-secondary">
        Baca Selengkapnya
      </a>      
    </p>
  </div>
  <!-- end tentang toko -->
  @endsection