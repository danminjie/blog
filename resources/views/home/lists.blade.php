<!DOCTYPE html>
<html lang="zh-CN">
 <head> 
  <meta http-equiv="Content-Type" content="text/html; charset=utf-8" /> 
  <!-- 引入页面描述和关键字模板 --> 
  <title>{{$catename->cate_name}}|但敏杰博客</title> 
  <meta name="description" content="杂谈，思想的闪光" /> 
  <meta name="keywords" content="" /> 
  @include('home.public.style')
  @include('home.public.script')
 </head> 
 <body id="wrap" class="archive category category-talk category-154"> 
  <!-- Nav --> 
  <!-- Moblie nav--> 
  <div id="body-container"> 
   @include('home.public.navmenue')
   <!-- /.Moblie nav --> 
   <section id="content-container" style="background:#f1f4f9; "> 
    @include('home.public.header')
    <div class="breadcrumbs"> 
     <div class="container clr"> 
      <div class="header-search"> 
       <form method="get" class="searchform" action="{{url('serach')}}" > 
        <input type="search" class="field" name="serach" value=""  placeholder="请输入文章标题" required="" /> 
        <button type="submit" class="submit" id="searchsubmit"><i class="fa fa-search"></i></button> 
       </form> 
      </div> 
      <div id="breadcrumbs">
       <h1><i class="fa fa-folder-open"></i> {{$catename->cate_name}}</h1> 
       <div class="breadcrumbs-text">
        <a href="http://www.iydu.net" title="阅读使人自由">主页</a>&nbsp;&raquo;&nbsp;{{$catename->cate_title}} 
       </div> 
      </div> 
     </div> 
    </div>
    <!-- Header Banner --> 
    <!-- /.Header Banner --> 
    <!-- Main Wrap --> 
    <div id="main-wrap"> 
     <div id="home-blog-wrap" class="container two-col-container"> 
      <div id="main-wrap-left"> 
       <div class="bloglist-container clr"> 
          @php
             use App\Model\Article; 
             use App\Model\Comment;
          @endphp        
        @foreach($lists as $k=>$v)
          <article class="home-blog-entry col span_1 clr"> 
           <a href="http://www.iydu.net/5148.html" title="{{$v->art_title}}" class="fancyimg home-blog-entry-thumb"> 
            <div class="thumb-img"> 
             <img src="{{$v->art_thumb}}" alt="{{$v->art_title}}" /> 
             <span><i class="fa fa-pencil"></i></span> 
            </div> </a> 
           <div class="home-blog-entry-text clr"> 
            <h3> <a href="{{ url('/detail/'.$v->art_id) }}" title="{{$v->art_title}}">{{$v->art_title}}</a> </h3> 
            <!-- Post meta -->           
            <div class="meta"> 
             <span class="postlist-meta-time"><i class="fa fa-calendar"></i>{{time_ago($v->art_time)}} ({{date('m-d',$v->art_time)}})</span> 
             <span class="postlist-meta-views"><i class="fa fa-fire"></i>浏览: {{$v->art_view}}</span> 
             <span class="postlist-meta-comments"><i class="fa fa-comments"></i><a href="{{ url('/detail/'.$v->art_id) }}"><span>评论: </span>{{Comment::where('post_id',$v->art_id)->count()}}</a></span> 
            </div>
            <!-- /.Post meta --> 
            <p> {{$v->art_description}}<a rel="nofollow" class="more-link" style="text-decoration:none;" href="http://www.iydu.net/5148.html"></a></p> 
           </div> 
           <div class="clear"></div> 
          </article> 
        @endforeach


       </div> 
       <!-- pagination --> 
       <div class="clear"> 
       </div> 
       <div class="page"> 
        {!! $lists->render() !!}
       </div> 
       <!-- /.pagination --> 
      </div> 
      <script type="text/javascript">
      	$('.site_loading').animate({'width':'55%'},50);  //第二个节点
      </script> 
      @include('home.public.aside')
     </div> 
    </div> 
    <!--/.Main Wrap --> 
    @include('home.public.footer') 
   </section>
  </div>  
  @include('home.public.singin')
  
  <!-- /.Footer Nav Wrap --> 
  @include('home.public.footjs')
 </body>
</html>