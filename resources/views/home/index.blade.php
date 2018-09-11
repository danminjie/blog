<!DOCTYPE html>
<html lang="zh-CN">
 <head> 
  <meta http-equiv="Content-Type" content="text/html; charset=utf-8" /> 
  <!-- 引入页面描述和关键字模板 --> 
  <title>{{ config('webconfig.web_title') }}</title> 
  <meta name="description" content="{{ config('webconfig.description') }}" /> 
  <meta name="keywords" content="{{ config('webconfig.keywords') }}" /> 
  @include('home.public.style')
  {{-- js begin --}}
  @include('home.public.script')
  {{-- js end --}}
 </head> 
 <body id="wrap" class="home blog"> 
  <!-- Nav --> 
  <!-- Moblie nav--> 
  <div id="body-container"> 
    {{-- moblie nav begin --}}
   @include('home.public.navmenue')
   {{-- mobile nav end --}}
   <!-- /.Moblie nav --> 
   <section id="content-container" style="background:#f1f4f9; "> 
    {{-- header begin --}}
    @include('home.public.header')
    {{-- header end --}}
    <!-- Main Wrap --> 
    <div id="main-wrap"> 
     <div id="sitenews-wrap" class="container"></div> 
     <!-- Header Banner --> 
     <!-- /.Header Banner --> 
     <!-- CMS Layout --> 
     <div class="container two-col-container cms-with-sidebar"> 
      <div id="main-wrap-left"> 
       <!-- Stickys --> 
       <!-- /.Stickys --> 
      @foreach($cate_arts as $k => $v)
       <section class="catlist-154 catlist clr"> 
        <div class="catlist-container clr"> 
         <h2 class="home-heading clr"> <span class="heading-text"> {{$v['cate_name']}} </span> <a href="{{ url('/list/'.$v['cate_id']) }}">+ 更多</a> </h2> 
         <span class="col-left catlist-style2">
          @if(!empty($v['article']))
          @foreach($v['article'] as $m=>$n)
             @if($n['art_status'] == 1)           
            <article class="home-blog-entry clr"> 
             <a href="{{ url('/detail/'.$n['art_id']) }}" title="{{$n['art_title']}}" class="fancyimg home-blog-entry-thumb"> 
              <div class="thumb-img"> 
               <img src="{{ url($n['art_thumb']) }}" alt="{{$n['art_title']}}" /> 
               <span><i class="fa fa-pencil"></i></span> 
              </div> </a> 
             <h3><a href="{{ url('/detail/'.$n['art_id']) }}" title="{{$n['art_title']}}">{{$n['art_title']}}</a></h3> 
             <div class="postlist-meta"> 
              <span class="postlist-meta-time">{{date('Y-m-d',$n['art_time'])}}</span> 
              <span class="delim"></span> 
              <span class="postlist-meta-views">3&nbsp;℃</span> 
              <span class="delim"></span> 
              <span class="postlist-meta-comments"><i class="fa fa-comments"></i>&nbsp;<a href="http://www.iydu.net/5148.html#comments">0</a></span> 
              <div class="postlist-meta-like like-btn" style="float:right;" pid="5148" title="点击喜欢">
               <i class="fa fa-heart"></i>&nbsp;
               <span>{{$n['art_love']}}</span>&nbsp;
              </div>
              <div class="postlist-meta-collect collect collect-no" uid="1" artid="{{$n['art_id']}}" style="float:right;cursor:default;" title="必须登录才能收藏">
               <i class="fa fa-star"></i>&nbsp;
               <span>{{$n['art_collect']}}</span>&nbsp;
              </div> 
             </div> 
             <p>{{$n['art_description']}}<a rel="nofollow" class="more-link" style="text-decoration:none;" href="{{ url('/list/'.$v['cate_id']) }}"></a> </p> 
            </article>
            @endif
          @endforeach
        @endif          
        </span> 
         <span class="col-right catlist-style2">
          @if(!empty($v['article']))
            @foreach($v['article'] as $m=>$n)
            @if($n['art_status'] == 0 && $m<=5)
            <article class="clr col-small"> 
             <a href="{{ url('/detail/'.$n['art_id']) }}" title="{{$n['art_title']}}" class="fancyimg home-blog-entry-thumb"> 
              <div class="thumb-img"> 
               <img src="{{ url($n['art_thumb']) }}" /> 
               <span><i class="fa fa-pencil"></i></span> 
              </div> </a> 
             <h3><a href="{{ url('/detail/'.$n['art_id']) }}" title="{{$n['art_title']}}">{{$n['art_title']}}</a></h3> 
             <p>{{$n['art_description']}}<a rel="nofollow" class="more-link" style="text-decoration:none;" href="{{ url('/detail/'.$n['art_id']) }}"></a> </p> 
            </article> 
            @endif
            @endforeach
          @endif             
         </span> 
        </div> 
       </section> 
      @endforeach
       <!-- pagination --> 
       <div class="clear"> 
       </div> 
       <div class="pagination"> 
       </div> 
       <!-- /.pagination --> 
      </div> 
      <script type="text/javascript">
      	$('.site_loading').animate({'width':'55%'},50);  //第二个节点
      </script> 
      
      {{-- 右侧边栏beigin --}}
      @include('home.public.aside')
      {{-- 右侧边栏end --}}

     </div> 
     <div class="clear"> 
     </div> 
     <!-- Blocks Layout --> 
    </div> 
    <!--/.Main Wrap --> 

     {{-- 底部 begin--}}
     @include('home.public.footer')
     {{-- 底部 end --}}

   </section>
  </div>  
  {{-- 登录 beign --}}
  @include('home.public.singin')
  {{-- 登录 end --}}
  <!-- /.Footer Nav Wrap --> 
  {{-- 底部 jsbegin --}}
  @include('home.public.footjs')
  {{-- 底部 jsend --}}
 </body>
</html>