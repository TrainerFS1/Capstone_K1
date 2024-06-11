<!doctype html>
<!--
* Tabler - Premium and Open Source dashboard template with responsive and high quality UI.
* @version 1.0.0-beta20
* @link https://tabler.io
* Copyright 2018-2023 The Tabler Authors
* Copyright 2018-2023 codecalm.net Paweł Kuna
* Licensed under MIT (https://github.com/tabler/tabler/blob/master/LICENSE)
-->
<html lang="en">
  <head>
    <meta charset="utf-8"/>
    <meta name="viewport" content="width=device-width, initial-scale=1, viewport-fit=cover"/>
    <meta http-equiv="X-UA-Compatible" content="ie=edge"/>
    <title>InpoLoker</title>
    <link rel="icon" href="images/Logo-Brand-2.png" type="image/x-icon">
    <link rel="shortcut icon" href="favicon.ico" type="image/x-icon">
    <!-- CSS files -->
    <link href="{{ asset('dist/css/tabler.min.css') }}" rel="stylesheet"/>
    <link href="{{ asset('dist/css/tabler-flags.min.css') }}" rel="stylesheet"/>
    <link href="{{ asset('dist/css/tabler-payments.min.css') }}" rel="stylesheet"/>
    <link href="{{ asset('dist/css/tabler-vendors.min.css') }}" rel="stylesheet"/>
    <link href="{{ asset('dist/css/demo.min.css') }}" rel="stylesheet"/>
   
    <link rel="stylesheet" href="https://cdnjs.cloudflare.com/ajax/libs/font-awesome/5.15.4/css/all.min.css">
     <!-- Tambahkan Animate.css CDN di sini -->
    <link rel="stylesheet" href="https://cdnjs.cloudflare.com/ajax/libs/animate.css/4.1.1/animate.min.css"/>
    <style>
      @import url('https://rsms.me/inter/inter.css');
      :root {
      	--tblr-font-sans-serif: 'Inter Var', -apple-system, BlinkMacSystemFont, San Francisco, Segoe UI, Roboto, Helvetica Neue, sans-serif;
      }
      body {
      	font-feature-settings: "cv03", "cv04", "cv11";
      }
      footer {
        background-color: #041533;
        color: #ffffff;
        padding-top: 2rem;
        padding-bottom: 2rem;
    }
    footer h5 {
        margin-bottom: 20px;
    }
    footer ul {
        padding-left: 0;
    }
    footer ul li {
        list-style: none;
        margin-bottom: 10px;
        display: flex;
        align-items: center;
    }
    footer ul li a {
        color: #ffffff;
        text-decoration: none;
    }
    footer ul li a:hover {
        text-decoration: underline;
    }
    .me-2 {
        margin-right: 0.5rem;
    }
    
    /*thumbnail */
    .news-v1 {
      padding: 60px 0;
      background-color: #f9f9f9;
    }
    .news-v1 .heading {
      text-align: center;
      margin-bottom: 40px;
    }
    .news-v1 .heading h2 {
      font-size: 36px;
      margin-bottom: 10px;
    }
    .news-v1 .heading p {
      font-size: 16px;
      color: #777;
    }
    .news-v1 .news-carousel .item {
      padding: 15px;
      background: #fff;
      box-shadow: 0 2px 10px rgba(0, 0, 0, 0.1);
      transition: all 0.3s ease;
    }
    .news-v1 .news-carousel .item:hover {
      box-shadow: 0 4px 20px rgba(0, 0, 0, 0.2);
    }
    .news-v1 .news-carousel .thumb {
      position: relative;
      padding-top: 56.25%;
      overflow: hidden;
      margin-bottom: 15px;
    }
    .news-v1 .news-carousel .photo {
      position: absolute;
      top: 0;
      left: 0;
      width: 100%;
      height: 100%;
      background-size: cover;
      background-position: center;
    }
    .news-v1 .news-carousel .text h3 {
      font-size: 18px;
      margin-bottom: 10px;
    }
    .news-v1 .news-carousel .text h3 a {
      color: #333;
      text-decoration: none;
      transition: color 0.3s ease;
    }
    .news-v1 .news-carousel .text h3 a:hover {
      color: #007bff;
    }
    .news-v1 .news-carousel .text p {
      font-size: 14px;
      color: #777;
    }
    @media (max-width: 767px) {
      .navbar-nav {
        text-align: center;
      }
      .navbar-nav .nav-item {
        display: inline-block;
        margin: 0 10px; /* Sesuaikan margin sesuai kebutuhan */
      }
    }


    


    
 
    </style>
  </head>
  <body >
    <script src="{{ asset('dist/js/demo-theme.min.js') }}"></script>
    <div class="page">
      <!-- Navbar -->
      <header class="navbar navbar-expand-md d-print-none">
        <div class="container-xl">
          <button class="navbar-toggler" type="button" data-bs-toggle="collapse" data-bs-target="#navbar-menu" aria-controls="navbar-menu" aria-expanded="false" aria-label="Toggle navigation">
            <span class="navbar-toggler-icon"></span>
          </button>
          <h1 class="navbar-brand navbar-brand-autodark d-none-navbar-horizontal pe-0 pe-md-3">
          <a href="{{ route('front') }}">
          <img src="{{ asset('images/Logo-Brand-2.png') }}" alt="Logo Brand 2" class="navbar-brand-image">
</a>

          </h1>

          <div class="collapse navbar-collapse" id="navbar-menu">
    <div>
      <div class="container-xl d-flex justify-content-between">
        <ul class="navbar-nav">
          <li class="nav-item">
            <a class="nav-link" href="{{ route('front') }}" >
              <span class="nav-link-icon d-md-none d-lg-inline-block">
                <svg xmlns="http://www.w3.org/2000/svg" class="icon" width="24" height="24" viewBox="0 0 24 24" stroke-width="2" stroke="currentColor" fill="none" stroke-linecap="round" stroke-linejoin="round"><path stroke="none" d="M0 0h24v24H0z" fill="none"/><path d="M5 12l-2 0l9 -9l9 9l-2 0" /><path d="M5 12v7a2 2 0 0 0 2 2h10a2 2 0 0 0 2 -2v-7" /><path d="M9 21v-6a2 2 0 0 1 2 -2h2a2 2 0 0 1 2 2v6" /></svg>
              </span>
              <span class="nav-link-title">
                Home
              </span>
            </a>
          </li>
        </ul>
        <ul class="navbar-nav">
  <li class="nav-item">
    <a class="nav-link" href="{{ route('jobs') }}">
      <span class="nav-link-icon d-md-none d-lg-inline-block">
        <svg xmlns="http://www.w3.org/2000/svg" class="icon icon-tabler icon-tabler-briefcase" width="24" height="24" viewBox="0 0 24 24" stroke-width="2" stroke="currentColor" fill="none" stroke-linecap="round" stroke-linejoin="round">
          <path stroke="none" d="M0 0h24v24H0z" fill="none"/>
          <rect x="4" y="4" width="16" height="16" rx="2" />
          <path d="M12 8v4m-4 -2h8" />
        </svg>
      </span>
      <span class="nav-link-title">
        Find Jobs
      </span>
    </a>
  </li>
</ul>



<ul class="navbar-nav" style="margin-right: auto;">
    <li class="nav-item">
        <a class="nav-link" href="{{ route('aboutUs') }}">
            <span class="nav-link-icon d-md-none d-lg-inline-block">
                <!-- Download SVG icon from http://tabler-icons.io/i/lifebuoy -->
                <svg xmlns="http://www.w3.org/2000/svg" class="icon" width="24" height="24" viewBox="0 0 24 24" stroke-width="2" stroke="currentColor" fill="none" stroke-linecap="round" stroke-linejoin="round">
                    <path stroke="none" d="M0 0h24v24H0z" fill="none"/>
                    <path d="M12 12m-4 0a4 4 0 1 0 8 0a4 4 0 1 0 -8 0"/>
                    <path d="M12 12m-9 0a9 9 0 1 0 18 0a9 9 0 1 0 -18 0"/>
                    <path d="M15 15l3.35 3.35"/>
                    <path d="M9 15l-3.35 3.35"/>
                    <path d="M5.65 5.65l3.35 3.35"/>
                    <path d="M18.35 5.65l-3.35 3.35"/>
                </svg>
            </span>
            <span class="nav-link-title">
                About Us
            </span>
        </a>
    </li>
</ul>
<ul class="navbar-nav" style="margin-right: auto;">
<li class="nav-item">
                <a class="nav-link" href="{{ route('guest.companies.search') }}">
                    <span class="nav-link-icon d-md-none d-lg-inline-block">
                        <!-- SVG icon for company search, you can choose any icon you prefer -->
                        <svg xmlns="http://www.w3.org/2000/svg" class="icon" width="24" height="24" viewBox="0 0 24 24" stroke-width="2" stroke="currentColor" fill="none" stroke-linecap="round" stroke-linejoin="round">
                            <path stroke="none" d="M0 0h24v24H0z" fill="none"/>
                            <path d="M3 21v-13a2 2 0 0 1 2 -2h6l3 3h6a2 2 0 0 1 2 2v10a2 2 0 0 1 -2 2h-16a2 2 0 0 1 -2 -2z"/>
                            <path d="M8 21v-4a2 2 0 0 1 2 -2h4a2 2 0 0 1 2 2v4"/>
                        </svg>
                    </span>
                    <span class="nav-link-title">
                        Company Profile
                    </span>
                </a>
            </li>
              </ul>

              
            </div>
          </div>
        </div>

          <div class="navbar-nav flex-row order-md-last">
            @if (!Auth::check())
            <div class="nav-item d-none d-md-flex me-3">
              <div class="btn-list">
                <a href="{{ route('loginCompany') }}" class="btn" rel="noreferrer">
                  <!-- Download SVG icon from http://tabler-icons.io/i/heart -->
                  <svg  xmlns="http://www.w3.org/2000/svg"  width="24"  height="24"  viewBox="0 0 24 24"  fill="red"  stroke="currentColor"  stroke-width="2"  stroke-linecap="round"  stroke-linejoin="round"  class="icon icon-tabler icons-tabler-outline icon-tabler-building-factory-2"><path stroke="none" d="M0 0h24v24H0z" fill="none"/><path d="M3 21h18" /><path d="M5 21v-12l5 4v-4l5 4h4" /><path d="M19 21v-8l-1.436 -9.574a.5 .5 0 0 0 -.495 -.426h-1.145a.5 .5 0 0 0 -.494 .418l-1.43 8.582" /><path d="M9 17h1" /><path d="M14 17h1" /></svg>
                  Untuk Perusahaan
                </a>
              </div>
            </div>
            @endif




            <div class="d-none d-md-flex">
              <a href="?theme=dark" class="nav-link px-0 hide-theme-dark" title="Enable dark mode" data-bs-toggle="tooltip"
		              data-bs-placement="bottom">
                <!-- Download SVG icon from http://tabler-icons.io/i/moon -->
                <svg xmlns="http://www.w3.org/2000/svg" class="icon" width="24" height="24" viewBox="0 0 24 24" stroke-width="2" stroke="currentColor" fill="none" stroke-linecap="round" stroke-linejoin="round"><path stroke="none" d="M0 0h24v24H0z" fill="none"/><path d="M12 3c.132 0 .263 0 .393 0a7.5 7.5 0 0 0 7.92 12.446a9 9 0 1 1 -8.313 -12.454z" /></svg>
              </a>
              <a href="?theme=light" class="nav-link px-0 hide-theme-light" title="Enable light mode" data-bs-toggle="tooltip"
		               data-bs-placement="bottom">
                <!-- Download SVG icon from http://tabler-icons.io/i/sun -->
                <svg xmlns="http://www.w3.org/2000/svg" class="icon" width="24" height="24" viewBox="0 0 24 24" stroke-width="2" stroke="currentColor" fill="none" stroke-linecap="round" stroke-linejoin="round"><path stroke="none" d="M0 0h24v24H0z" fill="none"/><path d="M12 12m-4 0a4 4 0 1 0 8 0a4 4 0 1 0 -8 0" /><path d="M3 12h1m8 -9v1m8 8h1m-9 8v1m-6.4 -15.4l.7 .7m12.1 -.7l-.7 .7m0 11.4l.7 .7m-12.1 -.7l-.7 .7" /></svg>
              </a>
              <div class="nav-item dropdown d-none d-md-flex me-3">
                {{-- <a href="#" class="nav-link px-0" data-bs-toggle="dropdown" tabindex="-1" aria-label="Show notifications">
                  <!-- Download SVG icon from http://tabler-icons.io/i/bell -->
                  <svg xmlns="http://www.w3.org/2000/svg" class="icon" width="24" height="24" viewBox="0 0 24 24" stroke-width="2" stroke="currentColor" fill="none" stroke-linecap="round" stroke-linejoin="round"><path stroke="none" d="M0 0h24v24H0z" fill="none"/><path d="M10 5a2 2 0 1 1 4 0a7 7 0 0 1 4 6v3a4 4 0 0 0 2 3h-16a4 4 0 0 0 2 -3v-3a7 7 0 0 1 4 -6" /><path d="M9 17v1a3 3 0 0 0 6 0v-1" /></svg>
                  <span class="badge bg-red"></span>
                </a>
                <div class="dropdown-menu dropdown-menu-arrow dropdown-menu-end dropdown-menu-card">
                  <div class="card">
                    <div class="card-header">
                      <h3 class="card-title">Last updates</h3>
                    </div>
                    <div class="list-group list-group-flush list-group-hoverable">
                      <div class="list-group-item">
                        <div class="row align-items-center">
                          <div class="col-auto"><span class="status-dot status-dot-animated bg-red d-block"></span></div>
                          <div class="col text-truncate">
                            <a href="#" class="text-body d-block">Example 1</a>
                            <div class="d-block text-secondary text-truncate mt-n1">
                              Change deprecated html tags to text decoration classes (#29604)
                            </div>
                          </div>
                          <div class="col-auto">
                            <a href="#" class="list-group-item-actions">
                              <!-- Download SVG icon from http://tabler-icons.io/i/star -->
                              <svg xmlns="http://www.w3.org/2000/svg" class="icon text-muted" width="24" height="24" viewBox="0 0 24 24" stroke-width="2" stroke="currentColor" fill="none" stroke-linecap="round" stroke-linejoin="round"><path stroke="none" d="M0 0h24v24H0z" fill="none"/><path d="M12 17.75l-6.172 3.245l1.179 -6.873l-5 -4.867l6.9 -1l3.086 -6.253l3.086 6.253l6.9 1l-5 4.867l1.179 6.873z" /></svg>
                            </a>
                          </div>
                        </div>
                      </div>
                      <div class="list-group-item">
                        <div class="row align-items-center">
                          <div class="col-auto"><span class="status-dot d-block"></span></div>
                          <div class="col text-truncate">
                            <a href="#" class="text-body d-block">Example 2</a>
                            <div class="d-block text-secondary text-truncate mt-n1">
                              justify-content:between ⇒ justify-content:space-between (#29734)
                            </div>
                          </div>
                          <div class="col-auto">
                            <a href="#" class="list-group-item-actions show">
                              <!-- Download SVG icon from http://tabler-icons.io/i/star -->
                              <svg xmlns="http://www.w3.org/2000/svg" class="icon text-yellow" width="24" height="24" viewBox="0 0 24 24" stroke-width="2" stroke="currentColor" fill="none" stroke-linecap="round" stroke-linejoin="round"><path stroke="none" d="M0 0h24v24H0z" fill="none"/><path d="M12 17.75l-6.172 3.245l1.179 -6.873l-5 -4.867l6.9 -1l3.086 -6.253l3.086 6.253l6.9 1l-5 4.867l1.179 6.873z" /></svg>
                            </a>
                          </div>
                        </div>
                      </div>
                      <div class="list-group-item">
                        <div class="row align-items-center">
                          <div class="col-auto"><span class="status-dot d-block"></span></div>
                          <div class="col text-truncate">
                            <a href="#" class="text-body d-block">Example 3</a>
                            <div class="d-block text-secondary text-truncate mt-n1">
                              Update change-version.js (#29736)
                            </div>
                          </div>
                          <div class="col-auto">
                            <a href="#" class="list-group-item-actions">
                              <!-- Download SVG icon from http://tabler-icons.io/i/star -->
                              <svg xmlns="http://www.w3.org/2000/svg" class="icon text-muted" width="24" height="24" viewBox="0 0 24 24" stroke-width="2" stroke="currentColor" fill="none" stroke-linecap="round" stroke-linejoin="round"><path stroke="none" d="M0 0h24v24H0z" fill="none"/><path d="M12 17.75l-6.172 3.245l1.179 -6.873l-5 -4.867l6.9 -1l3.086 -6.253l3.086 6.253l6.9 1l-5 4.867l1.179 6.873z" /></svg>
                            </a>
                          </div>
                        </div>
                      </div>
                      <div class="list-group-item">
                        <div class="row align-items-center">
                          <div class="col-auto"><span class="status-dot status-dot-animated bg-green d-block"></span></div>
                          <div class="col text-truncate">
                            <a href="#" class="text-body d-block">Example 4</a>
                            <div class="d-block text-secondary text-truncate mt-n1">
                              Regenerate package-lock.json (#29730)
                            </div>
                          </div>
                          <div class="col-auto">
                            <a href="#" class="list-group-item-actions">
                              <!-- Download SVG icon from http://tabler-icons.io/i/star -->
                              <svg xmlns="http://www.w3.org/2000/svg" class="icon text-muted" width="24" height="24" viewBox="0 0 24 24" stroke-width="2" stroke="currentColor" fill="none" stroke-linecap="round" stroke-linejoin="round"><path stroke="none" d="M0 0h24v24H0z" fill="none"/><path d="M12 17.75l-6.172 3.245l1.179 -6.873l-5 -4.867l6.9 -1l3.086 -6.253l3.086 6.253l6.9 1l-5 4.867l1.179 6.873z" /></svg>
                            </a>
                          </div>
                        </div>
                      </div>
                    </div>
                  </div>
                </div> --}}
              </div>
            </div>
            {{-- job seeker tombol --}}
            <div class="nav-item dropdown">
            <a href="{{ route('loginJobSeeker') }}" class="nav-link d-flex lh-1 text-reset p-0" data-bs-toggle="dropdown" aria-label="Open user menu">
              <span class="avatar avatar-sm">
                @if (Auth::check() && $jobSeeker->profile_picture)
                <img class="avatar avatar-sm" src="{{ $jobSeeker->profile_picture ? asset('storage/profile_pictures/'.$jobSeeker->profile_picture) : '' }}" >
                @else
                  <svg xmlns="http://www.w3.org/2000/svg" width="24" height="24" viewBox="0 0 24 24" fill="none" stroke="currentColor" stroke-width="2" stroke-linecap="round" stroke-linejoin="round" class="icon icon-tabler icons-tabler-outline icon-tabler-user">
                    <path stroke="none" d="M0 0h24v24H0z" fill="none" />
                    <path d="M8 7a4 4 0 1 0 8 0a4 4 0 0 0 -8 0" />
                    <path d="M6 21v-2a4 4 0 0 1 4 -4h4a4 4 0 0 1 4 4v2" />
                  </svg>
                @endif
              </span>
              <div class="d-none d-xl-block ps-2">
                <div>{{ $jobSeeker->job_seeker_name ?? 'Login' }}</div>
                <div class="mt-1 small text-secondary">Job Seeker</div>
              </div>
            </a>
              <div class="dropdown-menu dropdown-menu-end dropdown-menu-arrow">
                @if (Auth::check())
                  <a href="{{ route('jobseeker.profile') }}" class="dropdown-item">Profile</a>
                  <a href="{{ route('password.change') }}" class="dropdown-item">Settings</a>
                  <a href="{{ route('savedJobs') }}" class="dropdown-item">Saved Jobs</a>
                  <a href="{{ route('jobseeker.history') }}" class="dropdown-item">History Apply Job</a>
                  <a href="{{ route('logout') }}" class="dropdown-item">Logout</a>
                @else
                  <a href="{{ route('loginJobSeeker') }}" class="dropdown-item">Login</a>
                  <a href="{{ route('jobseeker.register') }}" class="dropdown-item">Register</a>

                @endif
              </div>
            </div>
          </div>
        </div>
      </header>

      @yield('main')
   

<footer class="pt-5 pb-5">
    <div class="container">
        <div class="row">
            <div class="col-md-3 animate__animated animate__fadeInLeft">
                <h5>Contact Us</h5>
                <ul class="list-unstyled">
                    <li><i class="fas fa-envelope me-2"></i>Email: inpoloker@gmail.com</li>
                    <li><i class="fas fa-phone me-2"></i>Phone: 0895 6366 92246</li>
                    <li><i class="fas fa-map-marker-alt me-2"></i>Address: Gamelab, Indonesia</li>
                </ul>
            </div>
            <div class="col-md-3 animate__animated animate__fadeInLeft">
                <h5>About Us</h5>
                <p>Platform peyedia lowongan kerja resmi yang menyediakan lebih dari 1000 Pekerjaan.</p>
            </div>
            <div class="col-md-3 animate__animated animate__fadeInRight">
                <h5>For Jobseekers</h5>
                <ul class="list-unstyled">
                    <li><a href="#" class="text-white"><i class="fas fa-search me-2"></i>Search Jobs</a></li>
                    <li><a href="#" class="text-white"><i class="fas fa-file-alt me-2"></i>Submit Resume</a></li>
                    <li><a href="#" class="text-white"><i class="fas fa-bell me-2"></i>Job Alerts</a></li>
                </ul>
            </div>
            <div class="col-md-3 animate__animated animate__fadeInRight">
                <h5>For Employers</h5>
                <ul class="list-unstyled">
                    <li><a href="#" class="text-white"><i class="fas fa-briefcase me-2"></i>Post a Job</a></li>
                    <li><a href="#" class="text-white"><i class="fas fa-search me-2"></i>Search Resumes</a></li>
                    <li><a href="#" class="text-white"><i class="fas fa-tachometer-alt me-2"></i>Employer Dashboard</a></li>
                </ul>
            </div>
        </div>
    </div>
</footer>



<footer class="footer footer-transparent d-print-none">
  <div class="container-xl">
    <div class="row text-center align-items-center flex-row-reverse">
      <div class="col-lg-auto ms-lg-auto">
        <ul class="list-inline list-inline-dots mb-0">
        </ul>
      </div>
      <div class="col-12 col-lg-auto mt-3 mt-lg-0">
        <ul class="list-inline list-inline-dots mb-0">
          <li class="list-inline-item">
            Copyright &copy; 2024
            <a href="." class="link-secondary">Kelompok 1 kelas FS</a>.
            All rights reserved.
          </li>
          <li class="list-inline-item">
            <a href="./changelog.html" class="link-secondary" rel="noopener">
              v1.0.0
            </a>
          </li>
        </ul>
      </div>
    </div>
  </div>
</footer>

</div>
<!-- Libs JS -->
<!-- Tabler Core -->
<script src="{{ asset('dist/js/tabler.min.js') }}" defer></script>
<script src="{{ asset('dist/js/demo.min.js') }}" defer></script>

<script>
    document.addEventListener('DOMContentLoaded', function () {
        const footer = document.querySelector('footer');
        
        // Mendeteksi saat kursor masuk ke area footer
        footer.addEventListener('mouseenter', function () {
            footer.classList.add('animate__fadeInLeft');
            footer.classList.add('animate__fadeInRight');
        });

        // Mendeteksi saat kursor meninggalkan area footer
        footer.addEventListener('mouseleave', function () {
            footer.classList.remove('animate__fadeInLeft');
            footer.classList.remove('animate__fadeInRight');
        });
    });
</script>



@yield('customjs')
@stack('scripts')

</body>
</html>

