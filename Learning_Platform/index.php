<!DOCTYPE html>

<html class="light" lang="en"><head>
<meta charset="utf-8"/>
<meta content="width=device-width, initial-scale=1.0" name="viewport"/>
<title>EduConnect NG - Free Tutoring for JAMB, WAEC, &amp; NECO</title>
<script src="https://cdn.tailwindcss.com?plugins=forms,container-queries"></script>
<link href="https://fonts.googleapis.com" rel="preconnect"/>
<link crossorigin="" href="https://fonts.gstatic.com" rel="preconnect"/>
<link href="https://fonts.googleapis.com/css2?family=Lexend:wght@400;500;700;900&amp;display=swap" rel="stylesheet"/>
<link href="https://fonts.googleapis.com/css2?family=Material+Symbols+Outlined:wght@400&amp;display=swap" rel="stylesheet"/>
<script id="tailwind-config">
      tailwind.config = {
        darkMode: "class",
        theme: {
          extend: {
            colors: {
              "primary": "#0057B7",
              "secondary": "#008751",
              "background-light": "#F5F5F5",
              "background-dark": "#101922",
              "text-light": "#333333",
              "text-dark": "#E0E0E0",
              "card-light": "#FFFFFF",
              "card-dark": "#1A242D",
              "border-light": "#E0E0E0",
              "border-dark": "#333F4A",
            },
            fontFamily: {
              "display": ["Lexend", "sans-serif"]
            },
            borderRadius: {"DEFAULT": "0.5rem", "lg": "0.75rem", "xl": "1rem", "full": "9999px"},
          },
        },
      }
    </script>
<style>
        .material-symbols-outlined {
            font-variation-settings: 'FILL' 0, 'wght' 400, 'GRAD' 0, 'opsz' 24;
            font-size: 24px;
        }
    </style>
<style>
    body {
      min-height: max(884px, 100dvh);
    }
  </style>
  </head>
<body class="bg-background-light dark:bg-background-dark font-display text-text-light dark:text-text-dark">
<div class="relative flex h-auto w-full flex-col group/design-root overflow-x-hidden">
<!-- Header -->
<header class="sticky top-0 z-50 bg-card-light/80 dark:bg-card-dark/80 backdrop-blur-sm shadow-sm">
<div class="container mx-auto px-4 py-3">
<nav class="flex items-center justify-between">
<a class="text-xl font-bold text-primary" href="#">EduConnect</a>
<div class="flex items-center gap-2">
<a class="hidden sm:inline px-3 py-2 text-sm font-medium hover:text-primary transition-colors" href="#">For Students</a>
<a class="hidden sm:inline px-3 py-2 text-sm font-medium hover:text-primary transition-colors" href="#">For Tutors</a>
<button class="flex min-w-[84px] cursor-pointer items-center justify-center overflow-hidden rounded-full h-9 px-4 bg-primary text-white text-sm font-bold leading-normal tracking-wide hover:bg-opacity-90">
<span class="truncate"><a href="pages/signup.php">Sign Up</a></span>
</button>
</div>
</nav>
</div>
</header>
<!-- Main Content -->
<main>
<!-- HeroSection -->
<section class="bg-card-light dark:bg-card-dark">
<div class="container mx-auto @container">
<div class="flex flex-col gap-8 px-4 py-12 md:py-20 @[864px]:flex-row-reverse">
<div class="w-full bg-center bg-no-repeat aspect-square bg-cover rounded-lg @[480px]:aspect-video @[864px]:w-full" data-alt="An optimistic illustration of a diverse group of students and tutors collaborating happily." style='background-image: url("https://lh3.googleusercontent.com/aida-public/AB6AXuDBTH_k4mR8LGtoS3TecCNl0mOKGsYJLSsD3Gx58nRDW5K1OQ0vh8tPBthvnYAWg4VuHlo67QWwAmAritY4euVvyH1spJKjNYcH_bUKonIv9CJneblfsVl5li1mHInZJ1Po0A5dlrrUbM63qwns1PikodTlHRSR8ey13zef9X3T2R6H03-qVNvoqr-totb0qVM1PDZzgykNywWiOecOp8vDiETXVPn0bAaWujCuEtIuXoWLEfswu9H9MTDnUA1eeThAggQSYys-ABRE");'></div>
<div class="flex flex-col gap-6 @[480px]:gap-8 @[864px]:justify-center">
<div class="flex flex-col gap-3 text-left">
<h1 class="text-text-light dark:text-text-dark text-4xl font-black leading-tight tracking-tighter @[480px]:text-5xl">
                                    Ace Your Exams. Unlock Your Future.
                                </h1>
<p class="text-text-light dark:text-text-dark text-base font-normal leading-relaxed @[480px]:text-lg">
                                    Connecting Nigerian students with volunteer tutors for free JAMB, WAEC, and NECO preparation.
                                </p>
</div>
<div class="flex flex-col sm:flex-row flex-wrap gap-3">
<button class="flex min-w-[84px] max-w-[480px] cursor-pointer items-center justify-center overflow-hidden rounded-lg h-12 px-5 bg-primary text-white text-base font-bold leading-normal tracking-wide hover:bg-opacity-90">
<span class="truncate">Find a Tutor</span>
</button>
<button class="flex min-w-[84px] max-w-[480px] cursor-pointer items-center justify-center overflow-hidden rounded-lg h-12 px-5 bg-secondary text-white text-base font-bold leading-normal tracking-wide hover:bg-opacity-90">
<span class="truncate">Become a Tutor</span>
</button>
</div>
</div>
</div>
</div>
</section>
<!-- "How It Works" FeatureSection -->
<section class="bg-background-light dark:bg-background-dark">
<div class="container mx-auto flex flex-col gap-8 px-4 py-12 md:py-20 @container">
<div class="flex flex-col gap-2 text-center">
<h2 class="text-text-light dark:text-text-dark text-3xl font-bold leading-tight tracking-tight @[480px]:text-4xl">
                            How It Works
                        </h2>
<p class="text-text-light dark:text-text-dark text-base font-normal leading-relaxed max-w-2xl mx-auto">A simple, step-by-step guide for getting started as a student or a tutor.</p>
</div>
<div class="grid grid-cols-[repeat(auto-fit,minmax(240px,1fr))] gap-4 p-0">
<div class="flex flex-1 gap-4 rounded-lg border border-border-light dark:border-border-dark bg-card-light dark:bg-card-dark p-6 flex-col text-center items-center">
<div class="text-primary bg-primary/20 rounded-full p-3 flex items-center justify-center">
<span class="material-symbols-outlined">person_add</span>
</div>
<div class="flex flex-col gap-1">
<h3 class="text-text-light dark:text-text-dark text-lg font-bold leading-tight">1. Sign Up</h3>
<p class="text-text-light/80 dark:text-text-dark/80 text-sm font-normal leading-normal">Create your account as a student or a tutor in just a few minutes.</p>
</div>
</div>
<div class="flex flex-1 gap-4 rounded-lg border border-border-light dark:border-border-dark bg-card-light dark:bg-card-dark p-6 flex-col text-center items-center">
<div class="text-primary bg-primary/20 rounded-full p-3 flex items-center justify-center">
<span class="material-symbols-outlined">groups</span>
</div>
<div class="flex flex-col gap-1">
<h3 class="text-text-light dark:text-text-dark text-lg font-bold leading-tight">2. Get Matched</h3>
<p class="text-text-light/80 dark:text-text-dark/80 text-sm font-normal leading-normal">Our platform connects you with the perfect match based on subjects and needs.</p>
</div>
</div>
<div class="flex flex-1 gap-4 rounded-lg border border-border-light dark:border-border-dark bg-card-light dark:bg-card-dark p-6 flex-col text-center items-center">
<div class="text-primary bg-primary/20 rounded-full p-3 flex items-center justify-center">
<span class="material-symbols-outlined">school</span>
</div>
<div class="flex flex-col gap-1">
<h3 class="text-text-light dark:text-text-dark text-lg font-bold leading-tight">3. Start Learning</h3>
<p class="text-text-light/80 dark:text-text-dark/80 text-sm font-normal leading-normal">Begin your personalized tutoring sessions and conquer your exams.</p>
</div>
</div>
</div>
</div>
</section>
<!-- Benefits FeatureSection -->
<section class="bg-card-light dark:bg-card-dark">
<div class="container mx-auto flex flex-col gap-8 px-4 py-12 md:py-20 @container">
<div class="flex flex-col gap-2 text-center">
<h2 class="text-text-light dark:text-text-dark text-3xl font-bold leading-tight tracking-tight @[480px]:text-4xl">
                            Unlock Your Potential
                        </h2>
<p class="text-text-light dark:text-text-dark text-base font-normal leading-relaxed max-w-2xl mx-auto">
                            Gain access to free, high-quality tutoring, reduce costs, and join a supportive learning community.
                        </p>
</div>
<div class="grid grid-cols-[repeat(auto-fit,minmax(240px,1fr))] gap-6">
<div class="flex flex-col gap-3 pb-3">
<div class="w-full bg-center bg-no-repeat aspect-video bg-cover rounded-lg" data-alt="A student smiling while studying on a laptop, representing free tutoring." style='background-image: url("https://lh3.googleusercontent.com/aida-public/AB6AXuAUMxYpccwr4BeCBTV1cq0VI7l2MMMoHE6WFoS5w2N5HYUNEXHi1xWi33HZrWyZBz0NrEhOe35bXLZaIInA6YlvDdWE2b797j4mAE4BLiy0Q7rUPGo_uYTzW4WDA1b9bOqOtvcyV4GH8oCoflZY5-2sq89O0hDoE70awz5f1wShT22IBsfq_F7hvF1-pG7WOGLs1m-4p69Zt6f7rd7Usz-UtyOINP0_tiUhBp8qpS6fIlzApuKFVO6UoiJolbA4sInhpUvvWS-1o3yQ");'></div>
<div>
<h3 class="text-text-light dark:text-text-dark text-lg font-medium leading-normal">Free Tutoring</h3>
<p class="text-text-light/80 dark:text-text-dark/80 text-sm font-normal leading-normal">Access quality education at no cost, removing financial barriers to success.</p>
</div>
</div>
<div class="flex flex-col gap-3 pb-3">
<div class="w-full bg-center bg-no-repeat aspect-video bg-cover rounded-lg" data-alt="A friendly volunteer tutor helping another person, symbolizing expert volunteers." style='background-image: url("https://lh3.googleusercontent.com/aida-public/AB6AXuAW7SL4uwUdpQwlHUlv_pkN0xp15qcw4LKa6q38wWJeuK0rPsjwAWsx6Opp6JmXizuXjt4t0JmQRuipNn1Efz6oEP_7cpNtb9rkuU8Bfmq_PJpqMxjCk5sGq1zGV7TwLJtodlmtWS5YWAB20X2eYZmUS1WbhM3FDmB4XKNw_152q33G-BtoN8g27mgqPKdLqq2M-nWlP5AckK9izhqGh6V5SCHbl9eAh_oqFVLE6ntg4CChFlCTCF5nvOm9W1vRWYWnsp1Rk6ItC_o_");'></div>
<div>
<h3 class="text-text-light dark:text-text-dark text-lg font-medium leading-normal">Expert Volunteers</h3>
<p class="text-text-light/80 dark:text-text-dark/80 text-sm font-normal leading-normal">Learn from dedicated tutors passionate about helping you succeed.</p>
</div>
</div>
<div class="flex flex-col gap-3 pb-3">
<div class="w-full bg-center bg-no-repeat aspect-video bg-cover rounded-lg" data-alt="A desk with exam papers and stationery, representing focus on exams." style='background-image: url("https://lh3.googleusercontent.com/aida-public/AB6AXuD-BbFV9RnRqzBzgMpkTbXt1ZIMNjao99Kjq4Kho3IfAxo9CknLLtVHlJ7ZSw80QLudp-8bC6l03AHvLK95O36chwPIYW1OCQQ3y_aIL3UDQfTenZRPPUbYDu--lTs1XpfWm31U2u29tpx6yYbwWy6escEqdbEg-DwbdlMWv8aGrP3cqwsFzMmDwB5wK1wGBpqc5QaM4ZyEDnZF0hC3zT9bgusVQk2GhhrK1W0nICAjgJNeZcuDmTRBiBTW-2U-e5ScTDGkfMNq2RXi");'></div>
<div>
<h3 class="text-text-light dark:text-text-dark text-lg font-medium leading-normal">Exam Focused</h3>
<p class="text-text-light/80 dark:text-text-dark/80 text-sm font-normal leading-normal">Get specialized help for JAMB, WAEC, and NECO exams.</p>
</div>
</div>
</div>
</div>
</section>
<!-- Social Proof Carousel -->
<section class="bg-background-light dark:bg-background-dark py-12 md:py-20">
<div class="container mx-auto flex flex-col gap-8 px-4">
<div class="flex flex-col gap-2 text-center">
<h2 class="text-text-light dark:text-text-dark text-3xl font-bold leading-tight tracking-tight @[480px]:text-4xl">
                            Success Stories
                        </h2>
<p class="text-text-light dark:text-text-dark text-base font-normal leading-relaxed max-w-2xl mx-auto">
                           Hear from students and tutors who have joined our community.
                        </p>
</div>
</div>
<div class="flex overflow-x-auto [-ms-scrollbar-style:none] [scrollbar-width:none] [&amp;::-webkit-scrollbar]:hidden py-4">
<div class="flex items-stretch px-4 gap-4">
<div class="flex w-72 flex-shrink-0 flex-col gap-4 rounded-lg bg-card-light dark:bg-card-dark shadow-md p-4">
<div class="flex items-center gap-4">
<img class="w-12 h-12 rounded-full object-cover" data-alt="Profile picture of David Okon" src="https://lh3.googleusercontent.com/aida-public/AB6AXuBtthICWAv_uBlbTBSzucxX6l9XQwg-5_ZR_orIvxpD57BwPEPYiD1ZVB1nClIjWmU5x6Sg_mnImUm6X8azoORznuF4x9dUxISDjYk5TO6EQ33a3qMZzHNTJQDssYt_HZmDqWull7RXOcCDwvZoZYf3oe_YcMD7iWw6jb4jPpwi8B133HQkqSQrXmUZdJpi7zyA3YPUWVm6z2XgWpqrevO3eNhLkMDVEyryKC4dt0RO-TbKmxZylNpMzpXaBXZSarALkiVA9GP7wP_i"/>
<div>
<p class="text-text-light dark:text-text-dark text-base font-bold leading-normal">David Okon</p>
<p class="text-text-light/80 dark:text-text-dark/80 text-sm font-normal leading-normal">Volunteer Tutor</p>
</div>
</div>
<p class="text-text-light/90 dark:text-text-dark/90 text-sm font-normal leading-relaxed">"Volunteering as a tutor has been incredibly rewarding. It's great to give back to the community and see students gain confidence."</p>
</div>
<div class="flex w-72 flex-shrink-0 flex-col gap-4 rounded-lg bg-card-light dark:bg-card-dark shadow-md p-4">
<div class="flex items-center gap-4">
<img class="w-12 h-12 rounded-full object-cover" data-alt="Profile picture of Aisha Bello" src="https://lh3.googleusercontent.com/aida-public/AB6AXuDFvuYSrrHmRPUOQI7_aqNnzlmCSfvh3Enb5dVyFDn0iNB26Ry4IEZnUCx03TIZM2EDLfb4R4EeIpRXpcYWMnu8Wllr-j6y3I0CQnNaARPyqPRhtiw6d571Im9ouO96GhPKqg6Qr_C3k5cvq1B5ScIFCqDoaIC6cXx6kiWCNH7atp8ZcELHGBDLcMtJVc15FdbFUclpZ3PNG90LFFmWqAvL4Ms5unXXdV6sKrDzRfltLOieqaYDKacMJW_K208XgQk0VaYXGD4xjkI4"/>
<div>
<p class="text-text-light dark:text-text-dark text-base font-bold leading-normal">Aisha Bello</p>
<p class="text-text-light/80 dark:text-text-dark/80 text-sm font-normal leading-normal">Student, WAEC</p>
</div>
</div>
<p class="text-text-light/90 dark:text-text-dark/90 text-sm font-normal leading-relaxed">"This platform was a lifesaver for my WAEC prep. My tutor was patient, knowledgeable, and helped me understand difficult topics."</p>
</div>
<div class="flex w-72 flex-shrink-0 flex-col gap-4 rounded-lg bg-card-light dark:bg-card-dark shadow-md p-4">
<div class="flex items-center gap-4">
<img class="w-12 h-12 rounded-full object-cover" data-alt="Profile picture of Chidi Nwosu" src="https://lh3.googleusercontent.com/aida-public/AB6AXuCJY0dr3ESNE088BdYLmqqAov-bJZ_WJAkbi5V-oWvjgcnIPKmjyG5ixv-fSzjL8WUDOlFCI9Qz849khbYFseI2zctqwJ73JY33w-3y1mMp0emSILnbYTcTgcf9zM8EfLVzmpDyPM9sNMezHSiBRLUmoXzKpfAyZ9udbqNiLcJ2napZv21MyRqtQgHTyZ3lLrtShwCqPgW_rX8S7mzwtuUujmeeo-_myah0aTb63vYzmNbMksy0izjs_aSgFJ0NwXsWLvdl6lsTQmGy"/>
<div>
<p class="text-text-light dark:text-text-dark text-base font-bold leading-normal">Chidi Nwosu</p>
<p class="text-text-light/80 dark:text-text-dark/80 text-sm font-normal leading-normal">Student, JAMB</p>
</div>
</div>
<p class="text-text-light/90 dark:text-text-dark/90 text-sm font-normal leading-relaxed">"I never thought I could get such quality help for free. My scores improved so much after just a few weeks. Highly recommended!"</p>
</div>
</div>
</div>
</section>
<!-- CTASection -->
<section class="bg-card-light dark:bg-card-dark">
<div class="container mx-auto @container">
<div class="flex flex-col justify-end gap-6 px-4 py-12 text-center md:py-20 @[480px]:gap-8">
<div class="flex flex-col gap-2">
<h2 class="text-text-light dark:text-text-dark text-3xl font-bold leading-tight tracking-tight @[480px]:text-4xl">
                                Join Our Community Today
                            </h2>
<p class="text-text-light dark:text-text-dark text-base font-normal leading-relaxed max-w-xl mx-auto">Whether you're looking to learn or eager to teach, your journey starts here.</p>
</div>
<div class="flex justify-center">
<div class="flex flex-col sm:flex-row flex-wrap gap-3 w-full max-w-md">
<button class="flex min-w-[84px] cursor-pointer items-center justify-center overflow-hidden rounded-lg h-12 px-5 bg-primary text-white text-base font-bold leading-normal tracking-wide hover:bg-opacity-90 flex-1">
<span class="truncate">Find a Tutor</span>
</button>
<button class="flex min-w-[84px] cursor-pointer items-center justify-center overflow-hidden rounded-lg h-12 px-5 bg-secondary text-white text-base font-bold leading-normal tracking-wide hover:bg-opacity-90 flex-1">
<span class="truncate">Become a Tutor</span>
</button>
</div>
</div>
</div>
</div>
</section>
</main>
<!-- Footer -->
<footer class="bg-background-light dark:bg-background-dark">
<div class="container mx-auto px-4 py-8">
<div class="flex flex-col items-center gap-6">
<div class="flex items-center gap-6 text-sm">
<a class="text-text-light/80 dark:text-text-dark/80 hover:text-primary" href="#">About Us</a>
<a class="text-text-light/80 dark:text-text-dark/80 hover:text-primary" href="#">FAQ</a>
<a class="text-text-light/80 dark:text-text-dark/80 hover:text-primary" href="#">Contact</a>
</div>
<p class="text-xs text-text-light/60 dark:text-text-dark/60">© 2024 EduConnect. All Rights Reserved.</p>
</div>
</div>
</footer>
</div>
</body></html>