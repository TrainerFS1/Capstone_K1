@extends('layouts.app')
@section('main')

<!-- Page body -->
<style>
  .carousel-caption.custom-caption {
      top: 45%;
      transform: translateY(-20%);
  }

  .huruf {
      font-size: 50px;
  }

  .icon-section .icon-box {
      transition: transform 0.3s ease, box-shadow 0.3s ease;
      padding: 20px;
  }

  .icon-section .icon-box:hover {
      transform: scale(1.1);
      box-shadow: 0 4px 15px rgba(0, 0, 0, 0.2);
  }

  .icon-section .icon-box i {
      color: #007bff; /* Adjust icon color as needed */
  }

  .thumbnails {
      display: flex;
      overflow: hidden;
      position: relative;
      width: 100%;
      margin: 40px 0;
  }

  .thumbnail-wrapper {
      display: flex;
      transition: transform 0.5s ease;
  }

  .thumbnail {
      flex: 0 0 200px;
      margin: 0 10px;
      text-align: center;
      border: 1px solid #ddd;
      padding: 10px;
      border-radius: 8px;
      background-color: #fff;
  }

  .thumbnail img {
      width: 100%;
      border-radius: 8px;
  }

  .news-carousel .item {
      padding: 10px;
      box-sizing: border-box;
    }
    .news-carousel .thumb {
      position: relative;
      overflow: hidden;
    }
    .news-carousel .photo {
      width: 100%;
      height: 200px;
      background-size: cover;
      background-position: center;
    }
    .news-carousel .text {
      padding: 10px;
      background: #fff;
    }
    .news-carousel .text h3 {
      margin: 0;
    }

</style>

<section>
    <div id="carouselExampleCaptions" class="carousel slide" data-bs-ride="carousel">
        <div class="carousel-indicators">
            <button type="button" data-bs-target="#carouselExampleCaptions" data-bs-slide-to="0" class="active" aria-current="true" aria-label="Slide 1"></button>
            <button type="button" data-bs-target="#carouselExampleCaptions" data-bs-slide-to="1" aria-label="Slide 2"></button>
        </div>
        <div class="carousel-inner">
            <div class="carousel-item active">
                <img src="{{ asset('images/bg.png') }}" class="d-block w-100" alt="...">
                <div class="carousel-caption d-none d-md-block text-start custom-caption">
                    <div class="container">
                        <div class="row">
                            <div class="col-12 col-xl-8 text-white">
                                <h1 class="huruf mb-4">Temukan Pekerjaan</h1>
                                <h1 class="huruf">Impian Anda</h1>
                                <p>Berbagai macam pekerjaan tersedia di sini.</p>
                                <div class="banner-btn mt-5">
                                    <a href="{{ route('jobs') }}" class="btn btn-yellow mb-4 mb-sm-0">Telusuri Sekarang</a>
                                </div>
                            </div>
                        </div>
                    </div>
                </div>
            </div>
            <div class="carousel-item">
                <img src="{{ asset('images/bg2.png') }}" class="d-block w-100" alt="...">
                <div class="carousel-caption d-none d-md-block text-start custom-caption">
                    <div class="container">
                        <div class="row">
                            <div class="col-12 col-xl-8 ml-1 text-white">
                                <h1 class="huruf mb-4 ">Ciptakan Lowongan</h1>
                                <h1 class="huruf">Di Sini</h1>
                                <p>Lebih dari 1000 karyawan mencari pekerjaan disini.</p>
                                <div class="banner-btn mt-5">
                                    <a href="{{ route('loginCompany') }}" class="btn btn-primary mb-4 mb-sm-0">Buat Sekarang</a>
                                </div>
                            </div>
                        </div>
                    </div>
                </div>
            </div>
        </div>
        <button class="carousel-control-prev" type="button" data-bs-target="#carouselExampleCaptions" data-bs-slide="prev">
            <span class="carousel-control-prev-icon" aria-hidden="true"></span>
            <span class="visually-hidden">Previous</span>
        </button>
        <button class="carousel-control-next" type="button" data-bs-target="#carouselExampleCaptions" data-bs-slide="next">
            <span class="carousel-control-next-icon" aria-hidden="true"></span>
            <span class="visually-hidden">Next</span>
        </button>
    </div>
</section>

<section>
    <div class="container icon-section mt-5">
        <div class="row text-center">
            <div class="col-md-4">
                <div class="icon-box">
                    <i class="fas fa-search fa-3x"></i>
                    <h3 class="mt-3">Cari Pekerjaan</h3>
                    <p>Temukan pekerjaan yang sesuai dengan keahlian Anda.</p>
                </div>
            </div>
            <div class="col-md-4">
                <div class="icon-box">
                    <i class="fas fa-briefcase fa-3x"></i>
                    <h3 class="mt-3">Lamar Pekerjaan</h3>
                    <p>Lamar pekerjaan dengan mudah dan cepat.</p>
                </div>
            </div>
            <div class="col-md-4">
                <div class="icon-box">
                    <i class="fas fa-user-tie fa-3x"></i>
                    <h3 class="mt-3">Pilih Karyawan</h3>
                    <p>Temukan dan pilih karyawan sesuai spesifikasi.</p>
                </div>
            </div>
        </div>
    </div>
</section>


@endsection
