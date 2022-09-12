
<!doctype html>
<html lang="en">

<head>
    <meta charset="utf-8">
    <meta name="viewport" content="width=device-width, initial-scale=1, shrink-to-fit=no">
    <title>Video Cloud | About Us</title>

    <link rel="shortcut icon" href="front/assets/images/fav.jpg">
    <link rel="stylesheet" href="front/assets/css/bootstrap.min.css">
    <link rel="stylesheet" href="front/assets/css/fontawsom-all.min.css">
    <link rel="stylesheet" href="front/assets/css/animate.css">
    <link rel="stylesheet" type="text/css" href="front/assets/css/style.css" />
</head>

<body>
  
    @include('front.layout.header');
       <!--  ************************* Page Title Starts Here ************************** -->
     <div class="page-nav no-margin row">
            <div class="container">
                <div class="row">
                    <h2>About Video Cloud</h2>
                    <ul>
                        <li> <a href="/"><i class="fas fa-home"></i> Home</a></li>
                        <li><i class="fas fa-angle-double-right"></i> About Us</li>
                    </ul>
                </div>
            </div>
        </div>


        <!--################### About Us Starts Here #######################--->

        <div id="about" class="about-company">
                <div class="container">
                    <div class="row">
                       <div class="col-md-6">

                         <div class="detail">
                            @foreach ($value as $item)
                                
                            @endforeach
                             <h3>{{$item->title}}</h3>
                             <p>{{$item->description}}</p>
                         </div>
                     </div>
                     <div class="col-md-6">
                         <div class="imag">
                             <img src="{{$item->image}}"  height="300px" width="300px" alt="" alt="">
                             {{-- <a href="/"><img src="{{$settings_details->logo}}" height="50px" width="300px" alt=""></a> --}}
                         </div>
                     </div> 
                    </div>
                </div>
                 
             </div>
      

  
  <!--####################### Latest Videos Starts Here ###################-->
      {{-- <div class="latest-video latest-video container-fluid">
          <div class="container">
              <div class="row no-margin video-title">
                  <h6><i class="fas fa-book"></i> Latest Video Videos</h6>
              </div>
              <div class="video-row row">
                    <div class="col-lg-3 col-md-4 col-sm-6 ">
                            <div class="video-card">
                                <img src="front/assets/images/video/b5.jpg" alt="">
                               
                                <div class="row details no-margin">
                                      <h6>Pictures, abstract symbols the ingredients with</h6>
                                    <div class="col-md-6 col-6 no-padding left">
                                        <i class="far fa-eye"></i> <span>3,241,234</span>    
                                    </div>
                                    <div class="col-md-6 col-6 no-padding right">
                                      
                                        <i class="far fa-comments"></i> <span>3,241,234</span>    
                                    </div>
                                </div>
                                
                            </div>
                        </div>
                        <div class="col-lg-3 col-md-4 col-sm-6">
                                <div class="video-card">
                                    <img src="front/assets/images/video/b6.jpg" alt="">
                                   
                                    <div class="row details no-margin">
                                          <h6>Pictures, abstract symbols the ingredients with</h6>
                                        <div class="col-md-6 col-6 no-padding left">
                                            <i class="far fa-eye"></i> <span>3,241,234</span>    
                                        </div>
                                        <div class="col-md-6 col-6 no-padding right">
                                          
                                            <i class="far fa-comments"></i> <span>3,241,234</span>    
                                        </div>
                                    </div>
                                    
                                </div>
                            </div>
                            <div class="col-lg-3 col-md-4 col-sm-6">
                                    <div class="video-card">
                                        <img src="front/assets/images/video/b5.jpg" alt="">
                                       
                                        <div class="row details no-margin">
                                              <h6>Pictures, abstract symbols the ingredients with</h6>
                                            <div class="col-md-6 col-6 no-padding left">
                                                <i class="far fa-eye"></i> <span>3,241,234</span>    
                                            </div>
                                            <div class="col-md-6 col-6 no-padding right">
                                              
                                                <i class="far fa-comments"></i> <span>3,241,234</span>    
                                            </div>
                                        </div>
                                        
                                    </div>
                                </div>
                                <div class="col-lg-3 col-md-4 col-sm-6">
                                        <div class="video-card">
                                            <img src="front/assets/images/video/b4.jpg" alt="">
                                           
                                            <div class="row details no-margin">
                                                  <h6>Pictures, abstract symbols the ingredients with</h6>
                                                <div class="col-md-6 col-6 no-padding left">
                                                    <i class="far fa-eye"></i> <span>3,241,234</span>    
                                                </div>
                                                <div class="col-md-6 col-6 no-padding right">
                                                  
                                                    <i class="far fa-comments"></i> <span>3,241,234</span>    
                                                </div>
                                            </div>
                                            
                                        </div>
                                    </div>
              </div>
          </div>
      </div>
  --}}
  <!--####################### Ads Starts Here ###################-->
      <div class="ads-cont container-fluid">
          
      </div>
  
   <!--####################### Footer Starts Here ###################-->
   @include('front.layout.footer');
   
</body>
<script src="front/assets/js/jquery-3.2.1.min.js"></script>
<script src="front/assets/js/popper.min.js"></script>
<script src="front/assets/js/bootstrap.min.js"></script>
<script src="front/assets/plugins/scroll-fixed/jquery-scrolltofixed-min.js"></script>
<script src="front/assets/js/script.js"></script>


</html>