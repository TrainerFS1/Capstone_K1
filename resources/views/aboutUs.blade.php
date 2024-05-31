@extends('layouts.app')

@section('title', 'About Us')

@section('main')

<head>

        <style>

.animasi:hover {
    transform: scale(1.05);
    transition: transform 0.3s ease;
    box-shadow: 0 10px 20px rgba(0, 0, 0, 0.2);
    transition: box-shadow 0.3s ease;
    transform: translateY(-10px);
    transition: transform 0.3s ease;
}
</style>

</head>
<body>


<div class="container">
    <div class="row justify-content-center">
        <div class="col-12">
            <div class="card mb-0 animasi">
                <div class="card-header text-center">
                    <h3>Tentang Kami</h3>
                </div>
                <div class="card-body text-center">
                    <p>Welcome to InpoLoker! We are dedicated to helping job seekers find their dream jobs and connecting them with reputable companies.</p>
                    <p>Our mission is to provide a platform where job seekers can explore various job opportunities and employers can find talented individuals to join their teams.</p>
                    <p>At InpoLoker, we strive to make the job search process as smooth and efficient as possible for both job seekers and employers. Whether you're looking for your first job or aiming to advance your career, we're here to support you every step of the way.</p>
                    <p>Thank you for choosing InpoLoker for your job search needs!</p>
                </div>
            </div>
        </div>
    </div>
</div>

<div class="container mt-5">
    <div class="row justify-content-center">
        <div class="col-12">
            <div class="card mb-0">
                <div class="card-header text-center">
                    <h3>Member Tim</h3>
                </div>
                <div class="card-body">
                    <div class="row justify-content-center">
                        <!-- Team Member 1 -->
                        <div class="col-sm-6 col-md-4 col-lg-2 mb-4">
                            <div class="card h-100 animasi">
                                <img src="images/foto-asmaranti.jpeg" alt="Team Member 1">
                                <div class="card-body text-center">
                                    <h5 class="card-title">Asmarani</h5>
                                    <p class="card-text">Ketua Kelompok</p>
                                </div>
                            </div>
                        </div>
                        <!-- Team Member 2 -->
                        <div class="col-sm-6 col-md-4 col-lg-2 mb-4">
                            <div class="card h-100 animasi">
                                <img src="images/foto-asmaranti.jpeg"  alt="Team Member 2">
                                <div class="card-body text-center">
                                    <h5 class="card-title">Zahruddin Fanani</h5>
                                    <p class="card-text">Anggota</p>
                                </div>
                            </div>
                        </div>
                        <!-- Team Member 3 -->
                        <div class="col-sm-6 col-md-4 col-lg-2 mb-4">
                            <div class="card h-100 animasi">
                                <img src="images/foto-asmaranti.jpeg"  alt="Team Member 3">
                                <div class="card-body text-center">
                                    <h5 class="card-title">Asmaranti</h5>
                                    <p class="card-text">Anggota</p>
                                </div>
                            </div>
                        </div>
                        <!-- Team Member 4 -->
                        <div class="col-sm-6 col-md-4 col-lg-2 mb-4">
                            <div class="card h-100 animasi">
                                <img src="images/foto-asmaranti.jpeg"  alt="Team Member 4">
                                <div class="card-body text-center">
                                    <h5 class="card-title">Angelo</h5>
                                    <p class="card-text">Anggota</p>
                                </div>
                            </div>
                        </div>
                        <!-- Team Member 5 -->
                        <div class="col-sm-6 col-md-4 col-lg-2 mb-4">
                            <div class="card h-100 animasi">
                                <img src="images/foto-asmaranti.jpeg"  alt="Team Member 5">
                                <div class="card-body text-center">
                                    <h5 class="card-title">Hisyam Ali</h5>
                                    <p class="card-text">Anggota</p>
                                </div>
                            </div>
                        </div>
                    </div>
                </div>
            </div>
        </div>
    </div>
</div>
</body>
@endsection
