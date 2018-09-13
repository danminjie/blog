<!DOCTYPE html>
<html lang="zh-CN">
 <head> 
  <meta http-equiv="Content-Type" content="text/html; charset=utf-8" /> 
  <!-- 引入页面描述和关键字模板 --> 
  <title>留言簿</title> 
  <meta name="description" content="" /> 
  <meta name="keywords" content="" /> 
  <!-- 网站图标 --> 
  <link rel="shortcut icon" href="home/images/favicon.ico" /> 
  <!-- 禁止浏览器初始缩放 --> 
  <meta name="viewport" content="width=device-width, initial-scale=1, maximum-scale=1, user-scalable=0" /> 
  <!-- 引入主题样式表 --> 
  <link rel="stylesheet" type="text/css" href="home/css/style.css" /> 
  <!-- 引入主题响应式样式表--> 
  <link rel="stylesheet" type="text/css" href="home/css/responsive.css" /> 
  <!-- 引入自定义样式表 --> 
  <link rel="stylesheet" type="text/css" href="home/css/custom.css" />  
  <!-- 引入字体样式表--> 
  <link rel="stylesheet" type="text/css" href="home/css/font-awesome.css" media="all" /> 

  <style type="text/css">
    img.wp-smiley,
    img.emoji {
      display: inline !important;
      border: none !important;
      box-shadow: none !important;
      height: 1em !important;
      width: 1em !important;
      margin: 0 .07em !important;
      vertical-align: -0.1em !important;
      background: none !important;
      padding: 0 !important;
    }
    .fenyele{
      margin-top: 20px;
      text-align: center;

    }
    .fenyele a{
      display: inline-block;
      background: #fff url() 0 0 no-repeat;
      color: #888;
      padding: 10px;
      min-width: 15px;
      border: 1px solid #E2E2E2;

    }
    .fenyele span{
      display: inline-block;
      padding: 10px;
      min-width: 15px;
      border: 1px solid #E2E2E2;
    }
    .fenyele span.current{
      display: inline-block;
      background: #009688 url() 0 0 no-repeat;
      color: #fff;
      padding: 10px;
      min-width: 15px;
      border: 1px solid #009688;
    }
    .fenyele .pagination li{
      display: inline-block;
      margin-right: 5px;
      text-align: center;
    }
    .fenyele .pagination li.active span{
      background: #009688 url() 0 0 no-repeat;
      color: #fff;
      border: 1px solid #009688;

    }    
  </style> 
  @include('home.public.script')
 </head> 
 <body id="wrap" class="page page-id-25 page-template-default"> 
  <!-- Nav --> 
  <!-- Moblie nav--> 
  <div id="body-container"> 
   <!-- /.Moblie nav --> 
   <section id="content-container" style="background:#f1f4f9; "> 
    @include('home.public.header')
    <div class="breadcrumbs"> 
     <div class="container clr"> 
      <div class="header-search"> 
       <form method="get" id="searchform" class="searchform" action="serach" role="search"> 
        <input type="search" class="field" name="serach" value="" id="s" placeholder="Search" required="" /> 
        <button type="submit" class="submit" id="searchsubmit"><i class="fa fa-search"></i></button> 
       </form> 
      </div> 
      <div id="breadcrumbs">
       <h1><i class="fa fa-bookmark"></i>&nbsp;留言簿</h1> 
      </div> 
     </div> 
    </div>
    <!-- Header Banner --> 
    <!-- /.Header Banner --> 
    <!-- Main Wrap --> 
    <div id="main-wrap"> 
     <div id="single-blog-wrap" class="container two-col-container"> 
      <div id="main-wrap-left"> 
       <!-- Content --> 
       <!-- /.Content --> 
       <!-- Comments --> 
       <div class="comments-main"> 
         
        <div class="commenttitle">
         <a href="#normal_comments"><span id="comments" class="active"><i class="fa fa-comments-o"></i>{{$total}} 评论</span></a>
         <a></a>
        </div> 
        <ol class="commentlist" id="normal_comments"> 
          @php
            use App\Model\Message;
          @endphp
          @foreach ($msg as $k => $v)
            <li class="comment even thread-even depth-1" id="comment-22371"> 
              <div id="div-comment-22371" class="comment-body"> 
               <img src="/home/images/{{rand(1,19).'.jpg'}}" class="avatar" width="54" height="54" /> 
               <span class="floor"> #{{$k+1}} </span> 
               <div class="comment-main"> 
                <p><a style="font-weight: bold;color:red">{{$v->nickname}}</a> <a>({{ substr_cut($v->email) }})</a></p> 
                <div class="comment-author"> 
                 <div class="comment-info"> 
                  <span class="comment_author_link">{!! $v->content !!}</span> 
                  <span class="comment_author_vip tooltip-trigger" title="评论达人 LV.1"><span class="vip vip1">评论达人 LV.1</span></span> 
                  <span class="datetime"> {{time_ago($v->create_time)}} ({{date('m-d',$v->create_time)}}) </span>
                  @if (session('homeuser'))
                     
                      <a class="comment-reply-login user-login messagehuifu" href="javascript:">回复</a> 
                  @else
                      <a class="comment-reply-login user-login" href="login">登录以回复</a>
                  @endif 
                   <div class="comment-author" id="show" style="display: none;">
                     <form action="messagehuifu" method="post" id="commentform">
                       <div class="clear"></div> 
                       <div class="comt-box">
                         {{csrf_field()}}
                        <p class="comment-form-input-info" style="width:30%"> <label for="author">昵称 *</label> <input type="text" name="nickname" id="author" class="commenttext" value="" size="22" tabindex="1" required="" /> </p> 
                        <p class="comment-form-input-info" style="width:35%"> <label for="email">邮箱 *</label> <input type="email" name="email" id="email" class="commenttext" value="@if (session('homeuser'))
                          {{session()->get('homeuser')->email}}  @endif" size="22" tabindex="2" required="" /> </p>                        
                       <input type="hidden" name="parent_id" value="{{$v->id}}"> 
                        <textarea name="content" id="comment" tabindex="5" rows="5" placeholder="说点什么吧..." required=""></textarea>  
                       </div>
                        @if (session('homeuser'))
                          <input type="hidden" name="user_id" value="{{session()->get('homeuser')->user_id}}" />
                        @endif                       
                       <button class="submit btn btn-submit" type="submit" id="submit" tabindex="6"><i class="fa fa-check-square-o"></i> 提交回复</button> 
                      </form>
                   </div>
                  <!-- edit_comment_link(__('编辑','tinection'));--> 
                 </div> 
                </div> 
                <div class="clear"></div> 
               </div> 
              </div>
              @if (Message::where('parent_id',$v->id)->get())
                @foreach (Message::orderBy('create_time','DESC')->where('parent_id',$v->id)->get() as $m => $n)
                  <ul class="children"> 
                   <li class="comment byuser comment-author-tyuan629 bypostauthor odd alt depth-2" id="comment-22372">
                    <div id="div-comment-22372" class="comment-body"> 
                     <img src="/home/images/{{rand(1,19).'.jpg'}}" class="avatar" width="54" height="54" /> 
                     <span class="floor"> </span> 
                     <div class="comment-main"> 
                      <p><a style="color:red;">@</a><a class="at_parent_comment_author"> {{$v->nickname}}</a>:{{$n->content}}</p> 
                      <div class="comment-author"> 
                       <div class="comment-info"> 
                        <span class="comment_author_link">{{$n->nickname}}<a class="name">({{substr_cut($n->email)}})</a></span> 
                        <span class="comment_author_vip tooltip-trigger" title="作者"><span class="vip vip-author">作 者</span></span> 
                        <span class="datetime"> {{time_ago($n->create_time)}} ({{date('m-d',$n->create_time)}}) </span> 
                        <!-- edit_comment_link(__('编辑','tinection'));--> 
                       </div> 
                      </div> 
                      <div class="clear"></div> 
                     </div> 
                    </div> </li>
                  </ul>
                @endforeach
              @endif 
            </li>
          @endforeach
         <div class="fenyele">
          {!! $msg->render() !!}
         </div>
<div id="respond_box"> 
         <div style="margin:8px 0 8px 0">
          <h3 class="multi-border-hl"><span>发表评论</span></h3>
         </div> 
         <div id="respond"> 
          <form action="domessage" method="post" id="commentform">
            {{csrf_field()}} 
           <div id="comment-author-info"> 
            <p class="comment-form-input-info" style="width:30%"> <label for="author">昵称 *</label> <input type="text" name="nickname" id="author" class="commenttext" value="" size="22" tabindex="1" required="" /> </p> 
            <p class="comment-form-input-info" style="width:35%"> <label for="email">邮箱 *</label> <input type="email" name="email" id="email" class="commenttext" value="@if (session('homeuser'))
              {{session()->get('homeuser')->email}}  @endif" size="22" tabindex="2" required="" /> </p> 
           </div> 
           <div class="clear"></div> 
           <div class="comt-box"> 
            <textarea name="content" id="comment" tabindex="5" rows="5" placeholder="说点什么吧..." required=""></textarea> 
            <div class="comt-ctrl"> 
            @if (session('homeuser'))
              <button class="submit btn btn-submit" type="submit" id="submit" tabindex="6"><i class="fa fa-check-square-o"></i> 提交留言</button>
            @else
              <a class="submit btn btn-submit" style="float: right;" tabindex="6"><i class="fa-window-close"></i> 请先登录后留言</a>
            @endif              
             
            @if (session('homeuser'))
              <input type="hidden" name="user_id" value="{{session()->get('homeuser')->user_id}}" />
            @endif 
             <div class="clr"></div> 
            </div> 
            <script type="text/javascript" src="{{ asset('home/js/jquery.min.js?ver=4.3.6') }}"></script> 
            <script type="text/javascript" src="{{ asset('home/js/layer.js') }}"></script>                        
           </div> 
          </form> 
          <div class="clear"></div> 
         </div> 
        </div>          
        </ol> 
        <ol class="commentlist" id="quote_comments"> 
         <div class="go-trackback"> 
          <input type="text" class="trackback-url" value="http://www.iydu.net/liuyan/trackback" /> 
          <button type="submit" class="quick-copy-btn">复制引用</button> 
         </div> 
        </ol> 
       </div> 
       <!-- /.Comments --> 
      </div> 
      <!-- Sidebar --> 
      {{-- 处理留言回复 --}}
      <script>
        $(".messagehuifu").click(function(){
          if($(this).html() == '回复'){
            $(this).siblings('.comment-author').css('display','block');
            $(this).html('取消回复');            
          }else{
            $(this).siblings('.comment-author').css('display','none');
            $(this).html('回复');              
          }
          
        });
      </script>
      <script type="text/javascript">
        $('.site_loading').animate({'width':'55%'},50);  //第二个节点
      </script> 
      @include('home.public.aside') 
      <!-- /.Sidebar --> 
     </div> 
    </div> 
    @include('home.public.footer')
   </section>
  </div>  
  <!-- /.Footer Nav Wrap --> 
  <script type="text/javascript" src="{{ asset('home/js/zh-cn-tw.js') }}"></script> 
  <script type="text/javascript" src="{{ asset('home/js/comments-ajax.js') }}"></script> 
  {{-- <script type="text/javascript" src="{{ asset('home/js/ajax-sign-script.min.js') }}"></script>  --}}
  <script type="text/javascript" src="{{ asset('home/js/prettify.js') }}"></script> 
  <script type="text/javascript">
    /*天真网（tzw520.cn） 鼠标特效 */
    var a_idx = 0;
    jQuery(document).ready(function($) {
        $("body").click(function(e) {
            var a = new Array("读高中时","老师经常说", "高中紧", "到了大学", "就松了", "傻傻的我", "从没怀疑过", "这句话的真假。" ,"我努力读书", "今年上了大学", "现在我也松了", "你TM果然没骗我", "你居然点完了", "牛逼", "逗逼", "蠢货", "小伙子", "不错哟");
            var $i = $("<span/>").text(a[a_idx]);
            a_idx = (a_idx + 1) % a.length;
            var x = e.pageX,
            y = e.pageY;
            $i.css({
                "z-index": 99999999999999,
                "top": y - 20,
                "left": x,
                "position": "absolute",
                "font-weight": "bold",
                "color": "#ff6651"
            });
            $("body").append($i);
            $i.animate({
                "top": y - 180,
                "opacity": 0
            },
            2000,
            function() {
                $i.remove();
            });
        });
    });
  </script>
  <script src="/home/js/jquery.prettyPhoto.js"></script> 
  <script type="text/javascript" src="/home/js/themea.js?ver=4.3.6"></script> 
  <!-- 引入用户自定义代码 --> 
  <!-- 引入主题js --> 
  <!-- /.Footer --> 
  <script type="text/javascript">
    $('.site_loading').animate({'width':'100%'},50);  //第五个节点
  </script>  

 </body>
</html>