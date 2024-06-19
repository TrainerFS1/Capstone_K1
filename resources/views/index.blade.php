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

  .icon-section {
      display: flex;
      justify-content: space-between;
      flex-wrap: wrap;
      gap: 20px;
      margin: 40px 0;
  }

  .icon-section .icon-box {
      transition: transform 0.3s ease, box-shadow 0.3s ease;
      padding: 20px;
      margin: 10px;
      border: 1px solid #ddd;
      border-radius: 8px;
      background-color: #fff;
      flex: 1;
      min-width: 200px;
  }

  .icon-section .icon-box:hover {
      transform: scale(1.1);
      box-shadow: 0 4px 15px rgba(0, 0, 0, 0.2);
  }

  .icon-section .icon-box i {
      color: #007bff;
  }

  .three-boxes-section {
      margin: 50px 0;
  }

  .three-boxes-section .box {
      border: 1px solid #ddd;
      border-radius: 8px;
      padding: 20px;
      text-align: center;
      background-color: #fff;
      margin: 10px;
      transition: box-shadow 0.3s ease;
  }

  .three-boxes-section .box:hover {
      box-shadow: 0 4px 15px rgba(0, 0, 0, 0.2);
  }

  .three-boxes-section .box img {
      max-width: 100%;
      height: auto;
      border-radius: 8px;
      margin-bottom: 20px;
  }

  .three-boxes-section .box h3 {
      margin-bottom: 15px;
  }

  .job-categories-section {
      text-align: center;
      margin: 50px 0;
  }

  .job-categories-section h2 {
      font-size: 2em;
      margin-bottom: 30px;
      text-align: center;
  }

  .job-category {
      border: 1px solid #ddd;
      border-radius: 8px;
      padding: 20px;
      text-align: center;
      background-color: #fff;
      width: 200px;
      transition: box-shadow 0.3s ease;
  }

  .job-category img {
      max-width: 100%;
      height: auto;
      border-radius: 8px;
      margin-bottom: 20px;
  }

  .job-category:hover {
      box-shadow: 0 4px 15px rgba(0, 0, 0, 0.2);
  }

  .job-category h3 {
      margin-bottom: 10px;
  }

  .job-category i {
      font-size: 2em;
      margin-bottom: 10px;
      display: block;
  }

</style>
<link rel="stylesheet" href="https://unpkg.com/aos@next/dist/aos.css" />
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

<section class="three-boxes-section">
    <div class="container-fluid">
        <div class="row">
            <div class="col-md-12 text-center">
                <h3 class="display-4" style="font-weight: 600; font-size: 50px;">Kenapa Harus Daftar Disini?</h3>
            </div>
        </div>
        <div class="container-fluid">
        <div class="row" style="padding-bottom: 30px;margin-top: 30px; padding-bottom: 35px;">
            <div class="col-md-4">
                <div class="box" data-aos="zoom-in" style="border: 4px solid gray; padding-bottom: 35px;">
                    <i class="fa-solid fa-clipboard-check fa-3x" style="color: #021679"></i>
                    <h3 style="color: black; font-size: 20px; font-weight: 700; margin-top: 20px;">Lowongan Pekerjaan Terbaik</h3>
                    <p style="color: black; margin-top: 10px;">Menawarkan Akses Lowongan pekerjaan Terbaik dari berbagai industri</p>
                </div>
            </div>
            <div class="col-md-4">
                <div class="box" data-aos="zoom-in" style="border: 4px solid gray; padding-bottom: 35px;">
                    <i class="fa-solid fa-person-running fa-3x" style="color: #021679"></i>
                    <h3 style="color: black; font-size: 20px; font-weight: 700; margin-top: 20px;">Fitur Lamaran Yang Cepat</h3>
                    <p style="color: black; margin-top: 20px;">Kirim lamaran anda hanya satu klik</p>
                </div>
            </div>
            <div class="col-md-4">
                <div class="box" data-aos="zoom-in" style="border: 4px solid gray; padding-bottom: 35px;">
                    <i class="fa-solid fa-newspaper fa-3x" style="color: #021679"></i>
                    <h3 style="color: black; font-size: 20px; font-weight: 700; margin-top: 20px;">Informasi Perusahaan </h3>
                    <p style="color: black; margin-top: 20px;"> Informasi perusahaan yang detail dan Jelas.</p>
                </div>
            </div>
        </div>
    </div>
</div>
</div>
    
</section>

<section class="three-boxes-section">
    <div class="container">
        <div class="row">
            <div class="col-md-12 text-center">
                <h2 class="display-4" style="font-weight: 600;">Pilihan Kategori</h2>
            </div>
        </div>
        <div class="container-fluid">
        <div class="row" style="padding-bottom: 50px;margin-top: 30px;">
            <div class="col-md-3">
                <div class="box" data-aos="zoom-out" data-aos-delay="150">
                    <img src="{{ asset('images/Sales.png') }}" class="card-img-top">
                    <i class="fa-solid fa-money-bill-trend-up fa-2x" style="color: #A67B5B;"></i>
                    <h3 style="color: black; font-size: 20px; font-weight: 700; margin-top: 20px;">Sales</h3>
                </div>
            </div>
            <div class="col-md-3">
                <div class="box" data-aos="zoom-out">
                    <img src="{{ asset('images/technology.png') }}" class="card-img-top">
                    <i class="fa-solid fa-desktop fa-2x" style="color: #A67B5B;"></i>
                    <h3 style="color: black; font-size: 20px; font-weight: 700; margin-top: 20px;">IT & Software</h3>
                </div>
            </div>
            <div class="col-md-3">
                <div class="box" data-aos="zoom-out" data-aos-delay="200">
                    <img src="{{ asset('images/enginering.png') }}" class="card-img-top">
                    <i class="fa-solid fa-gear fa-2x" style="color: #A67B5B"></i>
                    <h3 style="color: black; font-size: 20px; font-weight: 700; margin-top: 20px;">Engineering</h3>
                </div>
            </div>
            <div class="col-md-3">
                <div class="box" data-aos="zoom-out" data-aos-delay="300">
                    <img src="{{ asset('images/education.jpg') }}" class="card-img-top">
                    <i class="fa-solid fa-school fa-2x" style="color: #A67B5B;"></i>
                    <h3 style="color: black; font-size: 20px; font-weight: 700; margin-top: 20px;">Education</h3>
                </div>
            </div>
        </div>
    </div>
</div>
</section>
<script src="https://kit.fontawesome.com/85f7bb8c96.js" crossorigin="anonymous"></script>
<script src="https://unpkg.com/aos@next/dist/aos.js"></script>
<script>
  AOS.init();
</script>
@endsection
