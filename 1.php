<style>
    li {
        position: relative;
    }
    .submenu {
        display: none !important;
        position: absolute;
        top: 100%;
        left: 0;
        background-color: #0158a9;
        padding: 0;
        list-style: none;
        border: 1px solid #0870d0;
        z-index: 1000;
    }
    .submenu li {
        width: 200px;
    }
    .submenu a {
        display: block;
        padding: 10px;
        text-decoration: none;
        color: #fff;
    }
    .submenu a:hover {
        background-color: #0158a9;
    }
    li:hover .submenu {
        display: unset !important;
    }
    .header-three .nav-main ul li:hover a.nav-link {
        color: #fff;
    }
    .header-three .main-header-three.main-header .nav-main ul li a::after {
        background: none !important;
    }
</style>
<link rel="stylesheet" href="https://cdnjs.cloudflare.com/ajax/libs/font-awesome/5.15.4/css/all.min.css">

<header class="header-three header--sticky header-three-blue py-2">
    <div class="container">
        <div class="row main-header main-header-three" >
            <div class="col-lg-4 col-12 text-center py-lg-0 py-3">
                <a href="index.php" class="thumbnail-logo">
                    <!--<h6 style="color: #0158A9; margin-bottom: 0px;" class="sticky-logo">Legal Touch Attorney-Assisted<br/>Borrower Defense</h6>-->
                    <!--<h6 style="color: white; margin-bottom: 0px;" class="plan-logo">Legal Touch Attorney-Assisted<br/>Borrower Defense</h6>-->
                    <img src="assets/images/logo/borrowerdefence30.png" style="text-align: -webkit-center;" class="sticky-logo" alt="Legal Touch Attorney-Assisted Borrower Defense">
                    <img src="assets/images/logo/borrowerdefence30White.png" style="text-align: -webkit-center;" class="plan-logo" alt="Legal Touch Attorney-Assisted Borrower Defense">
                </a>
            </div>
            <div class="col-lg-5 d-none d-lg-block">
                <div class="text-center d-flex justify-content-center">
                    <nav class="nav-main mainmenu-nav d-none d-md-block">
                        <ul class="mainmenu">
                            <li class="#">
                                <a href="#banner" style="display:none;">Home</a>
                            </li>
                            <li class="#">
                                <a href="#services" style="display:none;">Services</a>
                            </li>
                            <li class="#">
                                <a href="#faqs" style="display:none;">FAQ's</a>
                            </li>
                            <li>
                                <a href="/#contact" class="add_color_blue" style="margin-right: 15px;">Contact</a>
                            </li>
                            <li>
                                <a href="/about-us.php" class="add_color_blue" style="margin-right: 15px;">About</a>
                            </li>
                            <li>
                                <a href="/check-eligibility/" class="add_color_blue">Check Eligibility</a>
                            </li>
                            <li>
                                <a href="/disclaimer.php" class="add_color_blue">Disclaimer</a>
                            </li>

                            <!-- <li><a href="/complete_guide.php" class="add_color_blue">Complete Guide</a></li> -->

                            <li>
                                <a class="nav-link add_color_blue" href="#">Blog <i class="fas fa-chevron-down"></i></a>
                                <ul class="submenu">
                                    <li><a class="add_color_white" href="/complete_guide.php">Complete Guide</a></li>
                                    <li><a class="add_color_white" href="/landmark-case-for-borrower-defense.php">A Landmark Case for Borrower Defense</a></li>
                                    <li><a class="add_color_white" href="/school-misconduct-discharge-for-private-loans.php">School Misconduct Discharge for Private Loans</a></li>
                                </ul>
                            </li>



                            <li>
                                <a href="/pricing.php" class="add_color_blue">Pricing</a>
                            </li>
                        </ul>
                    </nav>
                </div>
            </div>
            <div class="col-lg-3 d-none d-lg-block">
                <div class="right justify-content-end">
                    <a href="tel:800-261-2946">
                        <!-- Call Now 800-261-2946 -->
                        <img src="assets/images/logo/call3.png" alt="Call Now 800-261-2946"  style="width: 280px;">
                    </a>
                </div>
            </div>
        </div>
    </div>
</header>
