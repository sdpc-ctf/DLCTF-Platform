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
<script>
  function randNum(minnum , maxnum){
    return Math.floor(minnum + Math.random() * (maxnum - minnum));
}
</script>
      <section id="main-content">
          <section class="wrapper">
          <h3><i class="fa fa-angle-right"></i> Notice</h3>
              <!-- page start-->
              <?php $num = 1;?>
              @foreach($data as $datadata)
                    <?php $num=($num <= 3)? $num:1;?>
                    @if($num == 1)
                    <div class="panel-body" id="noti-box">
                      <div class="alert alert-block alert-success">
                        <button data-dismiss="alert" class="close close-sm" type="button"><i class="fa fa-times"></i></button>
                          <strong>{{$datadata->addtime}}</br></strong> {{base64_decode($datadata->data)}}
                      </div>
                    </div>
                    @elseif($num == 2)
                    <div class="panel-body" id="noti-box">
                      <div class="alert alert-block alert-info">
                        <button data-dismiss="alert" class="close close-sm" type="button"><i class="fa fa-times"></i></button>
                          <strong>{{$datadata->addtime}}</br></strong> {{base64_decode($datadata->data)}}
                      </div>
                    </div>
                    @else($num == 3)
                    <div class="panel-body" id="noti-box">
                      <div class="alert alert-block alert-danger">
                        <button data-dismiss="alert" class="close close-sm" type="button"><i class="fa fa-times"></i></button>
                          <strong>{{$datadata->addtime}}</br></strong> {{base64_decode($datadata->data)}}
                      </div>
                    </div>
                    @endif
                    <?php $num++;?>
              @endforeach
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
