<!DOCTYPE HTML>
<html lang="en">
   <head>
      <!--=============== basic  ===============-->
      <meta charset="UTF-8">
      <title>Rajesh Electricals | Tirunelveli</title>
      <meta name="description" content="Leading seller of branded electrical products in and around Tirunelveli since 1974">
      <meta name="viewport" content="width=device-width, initial-scale=1.0, minimum-scale=1.0, maximum-scale=1.0, user-scalable=no">
      <meta name="robots" content="index, follow"/>
      <meta name="google-site-verification" content="p0-YPnxKPYvHrLnb6-6Sir2SCO9xcVqFRkY6lutJI" />
      <meta name="keywords" content=""/>
      <meta name="description" content=""/>
      <!--=============== css  ===============-->
      <link href="https://fonts.googleapis.com/css?family=Nunito:400,600,700,800|Roboto:400,500,700" rel="stylesheet">
      <!-- Theme CSS -->
      <link type="text/css" href="//virtualcathay.net/uikit/assets/css/theme.css" rel="stylesheet">
      <link type="text/css" rel="stylesheet" href="{{ asset('townhub/css/reset.css') }}">
      <link type="text/css" rel="stylesheet" href="{{ asset('townhub/css/plugins.css') }}">
      <link type="text/css" rel="stylesheet" href="{{ asset('townhub/css/style.css') }}">
      <link type="text/css" rel="stylesheet" href="{{ asset('townhub/css/color.css') }}">
      <!--=============== favicons ===============-->
      <link rel="shortcut icon" href="https://cdn.discordapp.com/attachments/530789778912837640/701293402905509918/Rajesh_Electricals_LOGO.PNG">
      <script src="{{ asset('townhub/js/jquery.min.js') }}"></script>
      <script src="https://cdnjs.cloudflare.com/ajax/libs/slick-carousel/1.6.0/slick.js"></script>
      <style>
         body {
         font-family: 'Nunito', sans-serif;
         }
         .main-header{
         background: #2f455c;
         text-decoration: none;
         }
         .main-header:before{
         background: #2f455c;
         }
      </style>
      <script async src="https://www.googletamanager.com/gtag/js?id=UA-179302219-1"></script>
      <script>
        window.dataLayer = window.dataLayer || [];
        function gtag() {dataLayer.push(arguments);}
          gtag('js', new Date());

          gtag('config', 'UA-179302219-1');

             </script>
   </head>
   <body>
      <!--loader-->
      <div class="loader-wrap">
         <div class="loader-inner">
            <div class="loader-inner-cirle"></div>
         </div>
      </div>
      <!--loader end-->
      <!-- main start  -->
      <div id="main">
         <!-- header -->
         <header class="main-header">
            <!-- logo-->
            <a href="{{ url('/') }}" class="logo-holder">
            <img style="width: 35px; height: auto;" src="https://cdn.discordapp.com/attachments/530789778912837640/686668588500779122/PicsArt_03-10-01.45.43.png" alt="">
            </a>
            <!-- logo end-->
            <!-- header-search_btn-->
            <!-- <div class="header-search_btn show-search-button"><i class="fal fa-search"></i><span>Search</span></div> -->
            <!-- header-search_btn end-->
            <!-- header opt -->
            <a class="add-list color-bg btn-danger" href="https://wa.me/9787979792?text=Hello, I need an appointment."target="_blank" >Appointment <span><i class="fal fa-layer-plus"></i></span></a>
            <!-- <div class="cart-btn   show-header-modal" data-microtip-position="bottom" role="tooltip" aria-label="Your Wishlist"><i class="fal fa-heart"></i><span class="cart-counter green-bg"></span> </div> -->
            <div style="display: none;" class="show-reg-form modal-open avatar-img" data-srcav="{{ asset('townhub/images/avatar/3.png') }}"><i class="fal fa-user"></i>Sign In</div>
            <!-- header opt end-->
            <!-- lang-wrap-->
            <div style="display: none;" class="lang-wrap">
               <div class="show-lang"><span><i class="fal fa-globe-europe"></i><strong>En</strong></span><i class="fa fa-caret-down arrlan"></i></div>
               <ul class="lang-tooltip lang-action no-list-style">
                  <li><a href="#" class="current-lan" data-lantext="En">English</a></li>
                  <li><a href="#" data-lantext="Fr">Français</a></li>
                  <li><a href="#" data-lantext="Es">Español</a></li>
                  <li><a href="#" data-lantext="De">Deutsch</a></li>
               </ul>
            </div>
            <!-- lang-wrap end-->
            <!-- nav-button-wrap-->
            <div class="nav-button-wrap color-bg">
               <div class="nav-button">
                  <span></span><span></span><span></span>
               </div>
            </div>
            <!-- nav-button-wrap end-->
            <!--  navigation -->
            <div class="nav-holder main-menu">
               <nav>
                  <ul class="no-list-style">
                     <li>
                        <a href="{{ url('/about') }}">About</a>
                     </li>
                     <li>
                        <a href="{{ url('/brands') }}">Brands</a>
                     </li>
                     <li>
                         <a href="javascript::void(0);">Inventory <i class="fa fa-caret-down"></i></a>
                        <!--<a href="{{ url('inventory') }}">Inventory</a>-->
                        <!--second level -->
                        <ul>
                           <li><a href="{{ url('product/switches') }}">Switches</a></li>
                           <li><a href="{{ url('product/fans') }}">Fans</a></li>
                            <li><a href="{{ url('product/bulbs') }}">Bulbs</a></li>
                           <li><a href="{{ url('product/wires') }}">Wires</a></li>
                               <a href="#redirect" class="custom-scroll-link">Others<i class="fal fa-angle-double-down"></i></a>




                        </ul>
                        <!--second level end-->
                     </li>
                     <li>
                        <a href="{{ url('media') }}">Media</a>
                     </li>
                     <li>
                        <a href="{{ url('contact') }}">Contact Us</a>
                     </li>
                  </ul>
               </nav>
            </div>
            <!-- navigation  end -->
            <!-- header-search_container -->
            <div class="header-search_container header-search vis-search">
               <div class="container small-container">
                  <div class="header-search-input-wrap fl-wrap">
                     <!-- header-search-input -->
                     <div class="header-search-input">
                        <label><i class="fal fa-keyboard"></i></label>
                        <input type="text" placeholder="What are you looking for ?"   value=""/>
                     </div>
                     <!-- header-search-input end -->
                     <!-- header-search-input -->
                     <div class="header-search-input location autocomplete-container">
                        <label><i class="fal fa-map-marker"></i></label>
                        <input type="text" placeholder="Location..." class="autocomplete-input" id="autocompleteid2" value=""/>
                        <a href="#"><i class="fal fa-dot-circle"></i></a>
                     </div>
                     <!-- header-search-input end -->
                     <!-- header-search-input -->
                     <div class="header-search-input header-search_selectinpt ">
                        <select data-placeholder="Category" class="chosen-select no-radius" >
                           <option>All Categories</option>
                           <option>All Categories</option>
                           <option>Shops</option>
                           <option>Hotels</option>
                           <option>Restaurants</option>
                           <option>Fitness</option>
                           <option>Events</option>
                        </select>
                     </div>
                     <!-- header-search-input end -->
                     <button class="header-search-button green-bg" onclick="window.location.href='listing.html'"><i class="far fa-search"></i> Search </button>
                  </div>
                  <div class="header-search_close color-bg"><i class="fal fa-long-arrow-up"></i></div>
               </div>
            </div>
            <!-- header-search_container  end -->
            <!-- wishlist-wrap-->
            <div class="header-modal novis_wishlist">
               <!-- header-modal-container-->
               <div class="header-modal-container scrollbar-inner fl-wrap" data-simplebar>
                  <!--widget-posts-->
                  <div class="widget-posts  fl-wrap">
                     <ul class="no-list-style">
                        <li>
                           <div class="widget-posts-img"><a href="listing-single.html"><img src="{{ asset('townhub/images/gallery/thumbnail/1.png') }}" alt=""></a>
                           </div>
                           <div class="widget-posts-descr">
                              <h4><a href="listing-single.html">Iconic Cafe</a></h4>
                              <div class="geodir-category-location fl-wrap"><a href="#"><i class="fas fa-map-marker-alt"></i> 40 Journal Square Plaza, NJ, USA</a></div>
                              <div class="widget-posts-descr-link"><a href="listing.html" >Restaurants </a>   <a href="listing.html">Cafe</a></div>
                              <div class="widget-posts-descr-score">4.1</div>
                              <div class="clear-wishlist"><i class="fal fa-times-circle"></i></div>
                           </div>
                        </li>
                        <li>
                           <div class="widget-posts-img"><a href="listing-single.html"><img src="{{ asset('townhub/images/gallery/thumbnail/1.png') }}" alt=""></a>
                           </div>
                           <div class="widget-posts-descr">
                              <h4><a href="listing-single.html">MontePlaza Hotel</a></h4>
                              <div class="geodir-category-location fl-wrap"><a href="#"><i class="fas fa-map-marker-alt"></i> 70 Bright St New York, USA </a></div>
                              <div class="widget-posts-descr-link"><a href="listing.html" >Hotels </a>  </div>
                              <div class="widget-posts-descr-score">5.0</div>
                              <div class="clear-wishlist"><i class="fal fa-times-circle"></i></div>
                           </div>
                        </li>
                        <li>
                           <div class="widget-posts-img"><a href="listing-single.html"><img src="{{ asset('townhub/images/gallery/thumbnail/1.png') }}" alt=""></a>
                           </div>
                           <div class="widget-posts-descr">
                              <h4><a href="listing-single.html">Rocko Band in Marquee Club</a></h4>
                              <div class="geodir-category-location fl-wrap"><a href="#"><i class="fas fa-map-marker-alt"></i>75 Prince St, NY, USA</a></div>
                              <div class="widget-posts-descr-link"><a href="listing.html" >Events</a> </div>
                              <div class="widget-posts-descr-score">4.2</div>
                              <div class="clear-wishlist"><i class="fal fa-times-circle"></i></div>
                           </div>
                        </li>
                        <li>
                           <div class="widget-posts-img"><a href="listing-single.html"><img src="{{ asset('townhub/images/gallery/thumbnail/1.png') }}" alt=""></a>
                           </div>
                           <div class="widget-posts-descr">
                              <h4><a href="listing-single.html">Premium Fitness Gym</a></h4>
                              <div class="geodir-category-location fl-wrap"><a href="#"><i class="fas fa-map-marker-alt"></i> W 85th St, New York, USA</a></div>
                              <div class="widget-posts-descr-link"><a href="listing.html" >Fitness</a> <a href="listing.html" >Gym</a> </div>
                              <div class="widget-posts-descr-score">5.0</div>
                              <div class="clear-wishlist"><i class="fal fa-times-circle"></i></div>
                           </div>
                        </li>
                     </ul>
                  </div>
                  <!-- widget-posts end-->
               </div>
               <!-- header-modal-container end-->
               <div class="header-modal-top fl-wrap">
                  <h4>Your Wishlist : <span><strong></strong> Locations</span></h4>
                  <div class="close-header-modal"><i class="far fa-times"></i></div>
               </div>
            </div>
            <!--wishlist-wrap end -->
         </header>
         <!-- header end-->
         <!-- wrapper-->
         <div id="wrapper">
            <!-- content-->
            <div class="content">
               @yield('content')
            </div>
            <!--content end-->
         </div>
         <!-- wrapper end-->
         <!--footer -->
         <footer class="main-footer fl-wrap">
            <div class="footer-inner fl-wrap">
               <div class="container">
                  <div class="row">
                     <!-- footer-widget-->
                     <div class="col-md-4">
                        <div class="footer-widget fl-wrap">
                           <div class="footer-logo">
                              <a href="index.html">
                              <img style="width: 150px; height: auto;" src="https://cdn.discordapp.com/attachments/530789778912837640/686668588500779122/PicsArt_03-10-01.45.43.png" alt="">
                              </a>
                           </div>
                           <div class="footer-contacts-widget fl-wrap">
                              <p>
                              <div class="text-white text-left">
                                 {{ env('APP_NAME')}}, premier store for all major brands of electrical goods in Tirunelveli
                                 <br><br>
                                 <style>
                                    .blinking{
                                    animation:blinkingText 1.2s infinite;
                                    }
                                    @keyframes blinkingText{
                                    0%{     color: #fff;    }
                                    49%{    color: #fff; }
                                    60%{    color: transparent; }
                                    99%{    color:transparent;  }
                                    100%{   color: #fff;    }
                                    }
                                 </style>
                                 <h5> <span class="blinking">"We Do Not Have Any Branches"</span></h5>
                              </div>
                              </p>
                           </div>
                        </div>
                     </div>
                     <div class="col-md-4">
                        <div class="footer-widget fl-wrap">
                           <ul  class="footer-contacts fl-wrap no-list-style">
                              <li><span><i class="fal fa-envelope"></i> Mail :</span><a href="{{ url('contact') }}" target="_blank">enquiry@rajeshelectricalstvl.company</a></li>
                              <li> <span><i class="fal fa-map-marker"></i> Address :</span><a href="{{ url('about/locate-us')}}" target="_blank">#48, Raja Building, Tirunelveli Junction, Tirunelveli, Tamilnadu. PIN 627001</a></li>

                           </ul>
                           <!-- <div class="footer-social">
                              <span>Find  us on: </span>
                              <ul class="no-list-style">
                                  <li><a href="{{ url('socialmedia') }}" target="_blank"><i class="fab fa-facebook-f"></i></a></li>
                                  <li><a href="{{ url('socialmedia') }}" target="_blank"><i class="fab fa-twitter"></i></a></li>
                                  <li><a href="{{ url('socialmedia') }}" target="_blank"><i class="fab fa-instagram"></i></a></li>
                                  <li><a href="{{ url('socialmedia') }}" target="_blank"><i class="fab fa-whatsapp"></i></a></li>
                              </ul>
                              </div>-->
                        </div>
                     </div>
                     <div class="col-md-4">
                        <div class="footer-widget fl-wrap">
                           <ul  class="footer-contacts fl-wrap no-list-style">
                              <li><span><i class="fal fa-mobile"></i> Phone :</span><a href="tel:9787979792">(+091) 9787979792</a></li>
                              <li><span><i class="fal fa-mobile"></i> Alternate Number :</span><a href="tel:9787979792">(+091)  9894083602</a></li>
                              <li><span><i class="fal fa-phone-alt"></i> Phone :</span><a href="tel:0462 2334421"> 0462 2334421</a></li>
                              <li><span><i class="fab fa-whatsapp"></i> Whatsapp :</span><a href="https://wa.me/9787979792?text=Hello, I have an enquiry." target="_blank"> 9787979792</a></li>
                           </ul>
                           <!-- <div class="footer-social">
                              <span>Find  us on: </span>
                              <ul class="no-list-style">
                                  <li><a href="{{ url('socialmedia') }}" target="_blank"><i class="fab fa-facebook-f"></i></a></li>
                                  <li><a href="{{ url('socialmedia') }}" target="_blank"><i class="fab fa-twitter"></i></a></li>
                                  <li><a href="{{ url('socialmedia') }}" target="_blank"><i class="fab fa-instagram"></i></a></li>
                                  <li><a href="{{ url('socialmedia') }}" target="_blank"><i class="fab fa-whatsapp"></i></a></li>
                              </ul>
                              </div>-->
                        </div>
                     </div>
                     <!--<div class="col-md-4 ">
                        <h5 style="color: #fff">Customers are currently viewing this site from</h5>
                        <script type="text/javascript" src="//rf.revolvermaps.com/0/0/8.js?i=5stoukmmzfe&amp;m=0c&amp;c=ff0000&amp;cr1=ffffff&amp;f=arial&amp;l=33&amp;cw=2f455c&amp;cb=4364a0" async="async"></script>
                     </div>-->
                     <br>
                  </div>
               </div>
               <!-- footer bg-->
               <!--<div class="footer-bg" data-ran="4"></div>-->
               <div class="footer-wave">
                  <svg viewbox="0 0 100 25">
                     <path fill="#fff" d="M0 30 V12 Q30 17 55 12 T100 11 V30z" />
                  </svg>
               </div>
               <!-- footer bg  end-->
            </div>
            <!--footer-inner end -->
            <div class="sub-footer  fl-wrap">
               <div class="container">
                  <div class="copyright"> Rajesh Electricals  &copy; <?php echo date('Y'); ?> &bull; All rights reserved.</div>
                  <div class="lang-wrap">
                     <div class="show-lang"><span><i class="fal fa-globe-europe"></i>
                        <strong>En</strong></span><i class="fa fa-caret-down arrlan"></i>
                     </div>
                     <ul class="lang-tooltip lang-action no-list-style">
                        <li><a href="#" class="current-lan" data-lantext="En">English</a></li>
                     </ul>
                  </div>
                  <div class="subfooter-nav">
                     <ul class="no-list-style">
                        <li><a href="{{ url('/about') }}" target="_blank">About</a></li>
                        <li><a href="{{ url('/privacy') }}" target="_blank">Privacy Policy</a></li>
                        <li><a href="{{ url('/cookie') }}" target="_blank">Cookie</a></li>
                     </ul>
                  </div>
               </div>
            </div>
         </footer>
         <a class="to-top"><i class="fas fa-caret-up"></i></a>
      </div>
      <!-- Main end -->
      <!--=============== scripts  ===============-->
      <script src="{{ asset('townhub/js/plugins.js') }}"></script>
      <script src="{{ asset('townhub/js/scripts.js') }}"></script>
      <!--<script src="https://maps.googleapis.com/maps/api/js?key=YOUR_API_KEY_HERE&libraries=places&callback=initAutocomplete"></script>-->
      <script src="{{ asset('townhub/js/map-single.js') }}"></script>
      <!--<script src="//virtualcathay.net/uikit/assets/vendor/popper/popper.min.js"></script>-->
      <!--<script src="//virtualcathay.net/uikit/assets/js/bootstrap/bootstrap.min.js"></script>-->
      <!--<script src="//virtualcathay.net/uikit/assets/vendor/bootstrap-select/js/bootstrap-select.min.js"></script>-->
      <!--<script src="//virtualcathay.net/uikit/assets/vendor/bootstrap-tagsinput/bootstrap-tagsinput.min.js"></script>-->
      <!--<script src="//virtualcathay.net/uikit/assets/vendor/input-mask/input-mask.min.js"></script>-->
      <!--<script src="//virtualcathay.net/uikit/assets/vendor/nouislider/js/nouislider.min.js"></script>-->
      <!--<script src="//virtualcathay.net/uikit/assets/vendor/textarea-autosize/textarea-autosize.min.js"></script>-->
      <!--<script src="//virtualcathay.net/uikit/assets/js/theme.js"></script>-->
   </body>
</html>
