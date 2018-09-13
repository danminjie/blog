<!DOCTYPE html>
<html lang="zh-CN">
 <head> 
  <meta http-equiv="Content-Type" content="text/html; charset=utf-8" /> 
  <meta http-equiv="Cache-Control" content="no-transform" /> 
  <meta http-equiv="Cache-Control" content="no-siteapp" /> 
  <meta name="baidu-site-verification" content="fu3PTj4mmu" /> 
  <!-- 引入页面描述和关键字模板 --> 
  <title>{{$art->art_title}}</title> 
  <meta name="description" content="{{$art->art_description}}" /> 
  <meta name="keywords" content="{{$art->art_tag}}" /> 
  @include('home.public.style')
  <style>
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

 <body id="wrap" class="single single-post postid-5136 single-format-aside"> 
  <!-- Nav --> 
  <!-- Moblie nav--> 
  <div id="body-container"> 
   
   <!-- /.Moblie nav --> 
   <section id="content-container" style="background:#f1f4f9; "> 
    @include('home.public.header')
    <div class="breadcrumbs"> 
     <div class="container clr"> 
      <div class="header-search"> 
       <form method="get" id="searchform" class="searchform" action="http://www.iydu.net" role="search"> 
        <input type="search" class="field" name="s" value="" id="s" placeholder="Search" required="" /> 
        <button type="submit" class="submit" id="searchsubmit"><i class="fa fa-search"></i></button> 
       </form> 
      </div> 
      <div id="breadcrumbs">
       <h1> <i class="fa fa-pen"></i>{{$art->art_title}}</h1> 
       <div class="breadcrumbs-text">
        <a href="/" title="阅读使人自由">主页</a>&nbsp;&raquo;&nbsp;
        <a href="{{ url('list/'.$catename['cate_id']) }}" rel="category tag">{{$catename['cate_name']}}</a>&nbsp;&raquo;&nbsp;{{$art->art_description}}
       </div> 
      </div> 
     </div> 
    </div>
    <!-- Header Banner --> 
    <!-- /.Header Banner --> 
    <!-- Main Wrap --> 
    <div id="main-wrap"> 
     <div id="sitenews-wrap" class="container"></div> 
     <div id="single-blog-wrap" class="container two-col-container"> 
      <div id="main-wrap-left"> 
       <!-- Content --> 
       <div class="content"> 
        <!-- Post meta --> 
        <div id="single-meta"> 
         <span class="single-meta-author"><i class="fa fa-user">&nbsp;</i><a  title="{{$art->art_editor}}" rel="author">{{$art->art_editor}}</a></span> 
         <span class="single-meta-time"><i class="fa fa-calendar">&nbsp;</i>{{time_ago($art->art_time)}} ({{date('m-d',$art->art_time)}})</span> 
         <span class="single-meta-category"><i class="fa fa-folder-open">&nbsp;</i><a href="{{ url('list/'.$catename['cate_id']) }}" rel="category tag">{{$catename['cate_name']}}</a></span> 
         <span class="single-meta-comments">|&nbsp;&nbsp;<i class="fa fa-comments"></i>&nbsp;<a href="#" class="commentbtn">抢沙发</a></span> 
         <span class="single-meta-views"><i class="fa fa-fire"></i>&nbsp;{{$art->art_view}}&nbsp;</span> 
        </div> 
        <!-- /.Post meta --> 
        <!-- Rating plugin --> 
        <div class="rates" pid="{{$art->art_id}}"> 
         <span class="ratesdes">文章评分 <span class="ratingCount">0</span> 次，平均分 <span class="ratingValue">0.0</span> ： 
           <span id="starone" class="stars" title="1星" times="0" solid="n"><i class="fa fa-star-o"></i></span> 
           <span id="startwo" class="stars" title="2星" times="0" solid="n"><i class="fa fa-star-o"></i></span> 
           <span id="starthree" class="stars" title="3星" times="0" solid="n"><i class="fa fa-star-o"></i></span> 
           <span id="starfour" class="stars" title="4星" times="0" solid="n"><i class="fa fa-star-o"></i></span> 
           <span id="starfive" class="stars" title="5星" times="0" solid="n"><i class="fa fa-star-o"></i></span> 
        </span> 
        </div> 
        <!-- /.Rating plugin --> 
        <!-- Single article intro --> 
        <!-- /.Single article intro --> 
        <!-- Top ad --> 
        <!-- /.Top ad --> 
        <div class="single-thumb"> 
        </div> 
        <div class="single-text"> 
          {!! $art->art_content !!}
         <!-- Page links --> 
         <!-- /.Page links --> 
        </div> 
        <div class="single-tag">
         <i class="fa fa-tag"></i>&nbsp;&nbsp;
         <a rel="tag">{{$art->art_tag}}</a>
        </div> 
        <!-- Single Copyright --> 
        <div class="single-copyright"> 
         <i class="fa fa-bullhorn">&nbsp;</i> 
         <p>除注明来源的文章外，本站其他文章为<a href="{{ url('/') }}" title="云悦读" target="_blank">博主</a>原创，原创文章转载请注明出处来自<a href="http://blog.elvesgo.com" title="这么多大国，为什么治不了一个朝鲜？">http://blog.elvesgo.com</a></p> 
        </div> 
        <div class="single-activity"> 
         <div class="mark-like-btn tinlike clr"> 
          <a class="share-btn like-btn" pid="5136" href="javascript:;" title="点击喜欢"> <i class="fa fa-heart"></i> <span>{{$art->art_love}}</span>人喜欢 </a> 
          <a class="share-btn collect collect-no" style="cursor:default;" title="你必须注册并登录才能收藏"> <i class="fa fa-star"></i> <span>{{$art->art_collect}}人收藏 </span></a>
         </div> 
         <div id="bdshare" class="bdshare_t bds_tools get-codes-bdshare baidu-share"> 
          <a href="#" class="bds_tsina weibo-btn share-btn" data-cmd="tsina"> <i class="fa fa-weibo"></i>分享到微博 </a> 
          <a href="#" class="bds_weixin weixin-btn share-btn"> <i class="fa fa-weixin"></i>分享到朋友圈 
           <div id="weixin-qt" style="display: none; top: 80px; opacity: 1;"> 
            <img src="http://qr.liantu.com/api.php?text={{ url('detail/'.$art->art_id) }}" width="120" /> 
            <div id="weixin-qt-msg">
             打开微信，点击底部的“发现”，使用“扫一扫”即可将网页分享至朋友圈。
            </div> 
           </div> </a> 
          <a href="#" class="bds_more more-btn share-btn" data-cmd="more"><i class="fa fa-share-alt fa-flip-horizontal"></i><span class="pc-text">更多</span><span class="mobile-text">分享</span></a> 
         </div> 
        </div> 
        <!-- /.Single Activity --> 
        <div class="clear"></div> 
        <!-- /.Single Author Info --> 
        <!-- Related Articles --> 
        <div class="relatedposts"> 
         <h3 class="multi-border-hl"><span>相关文章</span></h3>
         <ul> 
          @foreach ($about as $k=>$v)
            <li> 
             <div class="relatedposts-inner"> 
                <div class="relatedposts-inner-pic"> 
                  <a href="{{ url('detail/'.$v['art_id']) }}" title="{{$v['art_title']}}" class=""> 
                    <div class="thumb-img"> 
                      <img src="{{$v['art_thumb']}}" /> 
                      <span><i class="fa fa-plus"></i></span> 
                    </div> 
                  </a> 
                </div> 
                <div class="relatedposts-inner-text"> 
                  <a href="{{ url('detail/'.$v['art_id']) }}" rel="bookmark" title="{{$v['art_title']}}">{{$v['art_title']}} </a> 
                </div> 
              </div> 
              <div class="clear"></div> 
            </li> 
          @endforeach
         </ul> 
        </div> 
        <!-- /.Related Articles --> 
        <!-- Prev or Next Article --> 
        <div class="navigation">
          <div class="navigation-left">
           @if(is_object($prev))
           <span>上一篇</span>
           <a href="{{ url('detail/'.$prev->art_id) }}" rel="prev">{{ $prev->art_title }}</a>
            <a>&nbsp;</a>
           @else
            <span>没有上一篇了</span>
           @endif
          </div>
          <div class="navigation-right">
           @if(is_object($next))
           <span>下一篇</span>
            <a>&nbsp;</a>
           <a href="{{ url('detail/'.$next->art_id) }}" rel="next">{{ $next->art_title }}</a>
            @else
            <span>没有下一篇了</span>
           @endif
          </div>
         </div>
        <!-- /.Prev or Next Article --> 
       </div> 
       <!-- /.Content --> 
       <!-- Comments --> 
       <div class="comments-main"> 
        <div id="respond_box"> 
         <div style="margin:8px 0 8px 0">
          <h3 class="multi-border-hl"><span>发表评论</span></h3>
         </div> 
         <div id="respond"> 
          <form action="/dodetmsg" method="post" id="commentform">
            {{csrf_field()}} 
           <div id="comment-author-info"> 
            <p class="comment-form-input-info" style="width:30%"> <label for="author">昵称 *</label> <input type="text" name="nickname" id="author" class="commenttext" value="" size="22" tabindex="1" required="" /> </p> 
            <input type="hidden" name="post_id" value="{{$art->art_id}}">
            <p class="comment-form-input-info" style="width:35%"></p> 
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
        <div class="commenttitle">
         <a href="#normal_comments"><span id="comments" class="active"><i class="fa fa-comments-o"></i>{{$total}} 评论</span></a>
         <a></a>
        </div> 
        <ol class="commentlist" id="normal_comments"> 
          @php
            use App\Model\Comment;
          @endphp
          @foreach ($msg as $k => $v)
            <li class="comment even thread-even depth-1" id="comment-22371"> 
              <div id="div-comment-22371" class="comment-body"> 
               <img src="/home/images/{{rand(1,14).'.jpg'}}" class="avatar" width="54" height="54" /> 
               <span class="floor"> #{{$k+1}} </span> 
               <div class="comment-main"> 
                <p><a style="font-weight: bold;color:red">{{$v->nickname}}</a></p> 
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
                     <form action="dotmsghuifu" method="post" id="commentform">
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
              @if (Comment::where(['parent_id'=>$v->id,'post_id'=>$art->art_id])->get())
                @foreach (Comment::orderBy('create_time','DESC')->where(['parent_id'=>$v->id,'post_id'=>$art->art_id])->get() as $m => $n)
                  <ul class="children"> 
                   <li class="comment byuser comment-author-tyuan629 bypostauthor odd alt depth-2" id="comment-22372">
                    <div id="div-comment-22372" class="comment-body"> 
                     <img src="/home/images/{{rand(1,14).'.jpg'}}" class="avatar" width="54" height="54" /> 
                     <span class="floor"> </span> 
                     <div class="comment-main"> 
                      <p><a style="color:red;">@</a><a class="at_parent_comment_author"> {{$v->nickname}}</a>:{{$n->content}}</p> 
                      <div class="comment-author"> 
                       <div class="comment-info"> 
                        <span class="comment_author_link">{{$n->nickname}}</span> 
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