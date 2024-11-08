<!DOCTYPE html>
<html lang="{{ str_replace('_', '-', app()->getLocale()) }}">
    <head>
        <meta charset="utf-8">
        <meta name="viewport" content="width=device-width, initial-scale=1">
        <title>Presence</title>

        <link rel="icon" href="{{ asset('images/logo.png') }}" type="image/x-icon">

        @include('components.css')
    </head>
    <body>
        {{-- <div class="container landing">
            <div class="logo">
              <span> <img src="images/logo.png" alt="landing-logo" /> </span>
              <h3>Presence</h3>
            </div>
            <div class="landing-container">
              <div class="landing-content">
                <h2>
                  Keep track of <span class="gradient-text-orange">attendance</span>, <span class="gradient-text-blue">schedule meetings</span>, and <span class="gradient-text-green">manage tasks</span> efficiently in one place with <span>Presence</span>.
                </h2>
                @if (Route::has('login'))
                <nav class="landing-buttons-container">
                    @auth
                        @if (auth()->user()->usertype == 'admin')
                            <a class="btn" href="{{ route('admindashboard') }}">Admin Dashboard</a>
                        @elseif (auth()->user()->usertype == 'superadmin')
                            <a class="btn" href="{{ route('superadminadmindashboard') }}">Superadmin Dashboard</a>
                        @else
                            <a class="btn" href="{{ route('dashboard') }}">Dashboard</a>
                        @endif
                        @else
                            <a class="btn" href="{{ route('login') }}" > Log In </a>
                        @if (Route::has('register'))
                            <a class="btn" href="{{ route('register') }}" class="welcome-register" > Register </a>
                        @endif
                    @endauth
                </nav>
                @endif
              </div>
            </div>
        </div> --}}
        <div class="navbar">
            <div class="navbar-content">
                <div class="navbar-logo">
                    <span><img src="images/logo.png" alt="landing-logo" /></span>
                    <h3>Presence</h3>
                </div>
                <div class="navbar-container">
                    {{-- <a href="#hero" class="navbar-content">Introducement</a> --}}
                    <a href="#features" class="navbar-links">Features</a>
                    {{-- <a href="#benefits" class="navbar-content">Benefits</a> --}}
                    <a href="#how-it-works" class="navbar-links">How It Works</a>
                    <a href="#testimonials" class="navbar-links">Testimony</a>
                    <a href="#about-us" class="navbar-links">About Us</a>
                    <a href="#contact" class="navbar-links">Contact Us</a>
                </div>
                <div class="navbar-reglog">
                    <a href="{{ route('login') }}" class="btn-reglog gradient-h-green" >Log In</a>
                    <a href="{{ route('register') }}" class="btn-reglog gradient-h-orange" >Register</a>
                </div>
            </div>
        </div>

        <section class="hero">
            <div class="hero-container">
                <div class="hero-text">
                    <h2>
                        Keep track of <span class="gradient-text-orange">attendance</span>, <span class="gradient-text-blue">schedule meetings</span>, and <span class="gradient-text-green">manage tasks</span> efficiently in one place with
                    </h2>
                    <h1>Presence.</h1>
                    <p>Your all-in-one solution for employee attendance, school projects, and personal to-do lists. Boost productivity and stay on top of your responsibilities, all from a simple, secure, and user-friendly interface.</p>
                </div>
                <div class="hero-button">
                    @if (Route::has('login'))
                        <nav class="landing-buttons-container">
                            @auth
                                @if (auth()->user()->usertype == 'admin')
                                    <a class="btn gradient-h-blue" href="{{ route('admindashboard') }}">Admin Dashboard</a>
                                @elseif (auth()->user()->usertype == 'superadmin')
                                    <a class="btn gradient-h-blue" href="{{ route('superadminadmindashboard') }}">Superadmin Dashboard</a>
                                @else
                                    <a class="btn gradient-h-blue" href="{{ route('dashboard') }}">Dashboard</a>
                                @endif
                                {{-- @else
                                    <a class="btn gradient-h-blue" href="{{ route('login') }}" > Log In </a>
                                @if (Route::has('register'))
                                    <a class="btn gradient-h-blue" href="{{ route('register') }}" > Register </a>
                                @endif --}}
                                @else
                                    <a class="btn gradient-h-blue" href="{{ route('register') }}" > Get Started </a>
                            @endauth
                        </nav>
                    @endif
                </div>
            </div>
        </section>
        
        <section class="features" id="features">
            {{-- left-right --}}
            <div class="features-container">
                <h1>Our Features</h1>
                <div class="features-content">
                    <div class="features-text">
                        <h2>Employee Attendance</h2>
                        <h4>Quick check-in/check-out for employee time tracking.</h4>
                    </div>
                    <div class="features-image">
                        <img src="" alt="">
                    </div>
                </div>
                <div class="features-content">
                    <div class="features-text">
                        <h2>Schedule Calendar</h2>
                        <h4>An intuitive calendar system to organize employee schedules.</h4>
                    </div>
                    <div class="features-image">
                        <img src="" alt="">
                    </div>
                </div>
                <div class="features-content">
                    <div class="features-text">
                        <h2>To-Do Lists</h2>
                        <h4>A tool to help employees track tasks and priorities.</h4>
                    </div>
                    <div class="features-image">
                        <img src="" alt="">
                    </div>
                </div>
            </div>
        </section>

        {{-- https://cdn.dribbble.com/userupload/14987315/file/original-5aba6c58a9debf610e1d8e94e0a7cd94.png?resize=1024x768 --}}
        <section class="benefits" id="benefits">
            <div class="benefits-container">
                {{-- row --}}
                <div class="benefits-content">
                    <h3>Benefits</h3>
                    <div class="benefits-text">
                        <h4>All-in-One Productivity</h4>
                        <p>Manage tasks and schedules across professional, academic, or personal settings.</p>
                    </div>
                </div>
                <div class="benefits-content">
                    <div class="benefits-text">
                        <h4>Boost Organization</h4>
                        <p>Plan and track work, school projects, or daily tasks efficiently.</p>
                    </div>
                </div>
                <div class="benefits-content">
                    <div class="benefits-text">
                        <h4>Data Transparency and Structure</h4>
                        <p>Reliable tracking for attendance, deadlines, and progress.</p>
                    </div>
                </div>
            </div>
        </section>

        <section class="how-it-works" id="how-it-works">
            {{-- column & line --}}
            <div class="hiw-container">
                <h3>How Presence Works</h3>
                <div class="hiw-content">
                    <h4>Step 1</h4>
                    <p>Create an account and set up your workspace type (business, school, personal)</p>
                    <div class="hiw-image">
                        <img src="" alt="">
                    </div>
                </div>
                <div class="hiw-content">
                    <h4>Step 2</h4>
                    <p>Invite collaborators and customize your schedules, attendance options, and task lists</p>
                    <div class="hiw-image">
                        <img src="" alt="">
                    </div>
                </div>
                <div class="hiw-content">
                    <h4>Step 3</h4>
                    <p>Track progress in real-time on your dashboard</p>
                    <div class="hiw-image">
                        <img src="" alt="">
                    </div>
                </div>
            </div>
        </section>

        <section class="testimonials" id="testimonials">
            <div class="testimonials-container">
                <h1>They Say...</h1>
                <div class="testimonials-content">
                    <div class="testimonials-image">
                        <img src="" alt="">
                    </div>
                    <h4>Sarah L., HR Manager</h4>
                    <p>This platform has revolutionized the way we manage employee attendance and schedules. The real-time updates make it so easy to track everyone's work hours, and the calendar view helps me plan team tasks efficiently. Highly recommend it for any business!</p>
                </div>
                <div class="testimonials-content">
                    <div class="testimonials-image">
                        <img src="" alt="">
                    </div>
                    <h4>John R., High School Teacher</h4>
                    <p>As a teacher, I’ve been using this for managing class schedules, assignments, and attendance. It’s been incredibly helpful to keep everything organized, especially with the ability to track student progress and deadlines. A must-have tool for any educator!</p>
                </div>
                <div class="testimonials-content">
                    <div class="testimonials-image">
                        <img src="" alt="">
                    </div>
                    <h4>Emily T., Freelance Graphic Designer</h4>
                    <p>I’ve been using this for managing my freelance projects and personal tasks. The to-do list and calendar features are simple yet powerful, and I love how everything syncs seamlessly across devices. It keeps me on top of my work-life balance!</p>
                </div>
                <div class="testimonials-content">
                    <div class="testimonials-image">
                        <img src="" alt="">
                    </div>
                    <h4>David M., Entrepreneur</h4>
                    <p>I use this platform to track both my business tasks and personal to-dos. The flexibility is fantastic, and it helps me stay organized whether I’m managing my team or planning my own daily schedule. This tool is a game-changer!</p>
                </div>
                <div class="testimonials-content">
                    <div class="testimonials-image">
                        <img src="" alt="">
                    </div>
                    <h4>Anna P., University Student</h4>
                    <p>I was struggling to keep up with my assignments, lectures, and extracurriculars, but this tool has made managing my student life so much easier. The task manager and calendar are a lifesaver, and I feel much more in control of my schedule.</p>
                </div>
            </div>
        </section>

        <section class="about-us" id="about-us">
            <div class="about-us-container">
                <h1>Want to Know More About Presence?</h1>
                <div class="about-us-content">
                    <h4>Our Mission</h4>
                    <p>At [Your Platform Name], our mission is to simplify task management and scheduling for individuals, businesses, and educational institutions. We provide a powerful, user-friendly platform to help users organize their work, school tasks, and personal goals—all in one place.</p>    
                </div>
                <div class="about-us-content">
                    <h4>Why We Created This Platform</h4>
                    <p>We wanted to make it easier for people to manage their time and stay organized, whether for work, school, or personal life. Our platform is designed to help users track tasks, schedules, and attendance with ease, improving efficiency and reducing stress.</p>    
                </div>
                <div class="about-us-content">
                    <h4>Our Values</h4>
                    <p>Simplicity: We focus on delivering a clean, easy-to-use experience for all our users.</p>
                    <p>Flexibility: Our platform adapts to suit various needs, from corporate scheduling to personal productivity.</p>
                    <p>Innovation: We’re constantly evolving, listening to feedback, and introducing new features to improve your experience.</p>
                </div>
            </div>
        </section>

        {{-- https://cdn.dribbble.com/userupload/14987315/file/original-5aba6c58a9debf610e1d8e94e0a7cd94.png?resize=1024x768 (yg paling bawah)--}}
        <footer>
            <div class="footer-container">
                <div class="footer-links">
                    <a href=""><i class="fa-solid fa-at"></i></a>
                    <a href=""><i class="fa-solid fa-location-dot"></i></a>
                    <a href=""><i class="fa-solid fa-phone"></i></a>
                    <a href=""><i class="fa-brands fa-whatsapp"></i></a>
                    <a href=""><i class="fa-brands fa-instagram"></i></a>
                </div>
                <span><img src="images/logo.png" alt="landing-logo" /></span>
                <div class="footer-texts">
                    <p>Terms Of Service | Privacy Policy</p>
                </div>
            </div>
        </footer>
    </body>
</html>
