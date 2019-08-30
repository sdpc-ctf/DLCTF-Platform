<html>
 <head></head>
 <body>
  @extends('ctf.home')
  @section('content') 
            <aside>
                              <div id="sidebar"  class="nav-collapse ">
                                  <!-- sidebar menu start-->
                                  <ul class="sidebar-menu" id="nav-accordion">
                                  
                                        <p class="centered"><a href="profile.html"><img src="{{ asset('ctf/assets/img/ui-sam.jpg')}}" class="img-circle" width="60"></a></p>
                                        <h5 class="centered">VCTF</h5>
                                            
                                      <li class="mt">
                                          <a href="/home">
                                              <i class="fa fa-dashboard"></i>
                                              <span>Dashboard</span>
                                          </a>
                                      </li>
                    
                                      <li class="sub-menu">
                                          <a href="/challenges" >
                                              <i class="fa fa-flag"></i>
                                              <span>Challenges</span>
                                          </a>
                                          
                                      </li>

                                      <li class="sub-menu">
                                          <a class="active" href="/notice" >
                                              <i class="fa fa-gift"></i>
                                              <span>Notice</span>
                                          </a>

                                      </li>
                    
                                      <li class="sub-menu">
                                          <a href="/scoreboard" >
                                              <i class="fa fa-book"></i>
                                              <span>scoreboard</span>
                                          </a>
                                          
                                      </li>
                                     
                                      <li class="sub-menu">
                                          <a href="/about" >
                                              <i class=" fa fa-bar-chart-o"></i>
                                              <span>About</span>
                                          </a>

                                      </li>

                                  </ul>
                                  <!-- sidebar menu end-->
                              </div>
                          </aside>

      <section id="main-content">
          <section class="wrapper">
          <h3><i class="fa fa-angle-right"></i> Notice</h3>
              <!-- page start-->
              <div class="row">

                  <div class="col-lg-12">
                      <div class="card alert">
{{--                          <div class="card-header">--}}
{{--                              <div class="card-header-right-icon">--}}
{{--                                  <ul>--}}
{{--                                      <li class="card-close" data-dismiss="alert"><i class="ti-close"></i></li>--}}
{{--                                      <li class="card-option drop-menu"><i class="ti-settings" data-toggle="dropdown" aria-haspopup="true" aria-expanded="true" role="link"></i>--}}
{{--                                          <ul class="card-option-dropdown dropdown-menu">--}}
{{--                                              <li><a href="#"><i class="ti-loop"></i> Update data</a></li>--}}
{{--                                              <li><a href="#"><i class="ti-menu-alt"></i> Detail log</a></li>--}}
{{--                                              <li><a href="#"><i class="ti-pulse"></i> Statistics</a></li>--}}
{{--                                              <li><a href="#"><i class="ti-power-off"></i> Clear ist</a></li>--}}
{{--                                          </ul>--}}
{{--                                      </li>--}}
{{--                                      <li class="doc-link"><a href="#"><i class="ti-link"></i></a></li>--}}
{{--                                  </ul>--}}
{{--                              </div>--}}
{{--                          </div>--}}
                          <div class="card-body">
                              <table class="table table-responsive table-striped">
                                  <thead>
                                  <tr>
                                      <th>Notice</th>
                                      <th>Time</th>
                                  </tr>
                                  </thead>
                                  <tbody>
                                  @foreach($notice as $noticedata)
                                      <tr>
                                          <td width="250">{{base64_decode($noticedata->noticedata)}}</td>
                                          <td width="20">{{$noticedata->addtime}}</td>
                                      </tr>
                                  @endforeach
                                  </tbody>
                              </table>
                          </div>
                      </div>
                  </div><!-- /# column -->

              </div>
              <!-- page end-->
          </section>          
      </section><!-- /MAIN CONTENT -->

     
  </section>


      <!--main content end-->
      <!--footer start-->
     
      <!--footer end-->
  </section>
  <!-- js placed at the end of the document so the pages load faster --> 
  <script src="{{ asset('ctf/assets/js/jquery.js')}}"></script> 
  <script src="{{ asset('ctf/assets/js/bootstrap.min.js')}}"></script> 
  <script class="include" type="text/javascript" src="{{ asset('ctf/assets/js/jquery.dcjqaccordion.2.7.js')}}"></script> 
  <script src="{{ asset('ctf/assets/js/jquery.scrollTo.min.js')}}"></script> 
  <script src="{{ asset('ctf/assets/js/jquery.nicescroll.js')}}" type="text/javascript"></script> 
  <!--common script for all pages--> 
  <script src="{{ asset('ctf/assets/js/common-scripts.js')}}"></script> 

  @endsection