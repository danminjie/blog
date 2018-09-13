      <div id="sidebar" class="clr"> 
       <div id="search-3" class="widget widget_search">
        <h3><span class="widget-title">站内搜索</span></h3>
        <form method="get" class="searchform themeform" action="{{url('serach')}}"> 
         <div> 
          <input type="text" class="search" name="serach" onblur="if(this.value=='')this.value='请输入文章标题..';" onfocus="if(this.value=='请输入文章标题..')this.value='';" placeholder="请输入文章标题" value="" maxlength="20" required="required" /> 
         </div> 
        </form>
       </div> 
       <div id="tinsubscribe-2" class="widget widget_tinsubscribe"> 
        <h3><span class="widget-title">邮件订阅</span></h3> 
        <span id="subscribe-span"> <input type="text" name="subscribe" id="subscribe" placeholder="yourname@domain.com" /><button id="subscribe" class="btn btn-success">订阅</button> <p id="subscribe-msg" style="display:none;margin-top:5px;margin-left:auto;margin-right:auto;font-size:12px;color:#f00;"></p> </span> 
       </div> 
       
       <div id="tintagcloud-2" class="widget widget_tintagcloud"> 
        <h3><span class="widget-title">标签云</span></h3> 
        <aside class="tags">
        @foreach($tags as $k=>$v)
         <a href="{{ url('/detail/'.$k) }}" class="tag-link-37" title="{{$v}}" style="font-size: 12px;">{{$v}}</a>
        @endforeach
        </aside> 
       </div> 
       <div id="tinbookmark-2" class="widget widget_tinbookmark"> 
        <h3><span class="widget-title">友情链接</span></h3> 
        <div class="tinbookmark">
         <ul>

          @foreach($links as $k=>$v)
            @if(fmod($k,2) == 0)
              <li class="tinbookmark-list list-left"><i class="fa fa-angle-right"></i><a href="{{$v->link_url}}" title="{{ $v->link_name }}" target="_blank">{{ $v->link_name }}</a></li>
            @else
              <li class="tinbookmark-list list-right"><i class="fa fa-angle-right"></i><a href="{{$v->link_url}}" title="{{ $v->link_name }}" target="_blank">{{ $v->link_name }}</a></li>
            @endif
          @endforeach
          
         </ul>
        </div> 
       </div>  
       <div id="tinsitestatistic-3" class="widget widget_tinsitestatistic"> 
        <ul> 
          @php
             use App\Model\Article; 
             use App\Model\Comment;
          @endphp
         <li>文章总数：<span>{{ Article::count() }}</span> 篇</li> 
         <li>评论总数：<span>{{ Comment::count() }}</span> 条</li> 
         <li>标签数量：<span>{{$tagtotal}}</span>个</li>  
         <li>建站日期：<span>2017-08-05</span></li> 
        </ul> 
        <div class="clear"></div> 
       </div> 
       <div class="floatwidget-container"> 
       </div> 
      </div> 
      <script type="text/javascript">
      	$('.site_loading').animate({'width':'78%'},50);  //第三个节点
      </script>
      <script type="text/javascript" src="{{ asset('home/js/jquery.min.js?ver=4.3.6') }}"></script> 
      <script type="text/javascript" src="{{ asset('home/js/layer.js') }}"></script> 
    <script>
      $('button#subscribe').click(function(){
        email = $('input#subscribe').val();
        if(email == ''){
          layer.msg('邮箱不能为空',{time:3000,icon:5});
          return false;
        }else if(email==''||(!email.match('^([a-zA-Z0-9_-])+((\.)?([a-zA-Z0-9_-])+)+@([a-zA-Z0-9_-])+(\.([a-zA-Z0-9_-])+)+$'))){
          layer.msg('请输入正确邮箱',{time:3000,icon:5});
          // setTimeout(function(){$('#subscribe-msg').slideToggle('slow');},3000);
        }else{
          $.get('/subscribe',{email:email}, function(data) {
            // console.log(data);
            if(data.status == 0){
              layer.msg(data.msg,{time:3000,icon:6});
            }else{
              layer.msg(data.msg,{time:3000,icon:5});
            }
            // $('#subscribe-span').html('你已成功订阅该栏目，同时你也会收到一封提醒邮件.');
          });
        }
      })
        
      // Unsubscribe
      $('button#unsubscribe').click(function(){
        email = $('input#unsubscribe').val();
        if(email==''||(!email.match('^([a-zA-Z0-9_-])+((\.)?([a-zA-Z0-9_-])+)+@([a-zA-Z0-9_-])+(\.([a-zA-Z0-9_-])+)+$'))){
          // $('#unsubscribe-msg').html('请输入正确邮箱').slideToggle('slow');
          // setTimeout(function(){$('#unsubscribe-msg').slideToggle('slow');},2000);
        }else{
          $.ajax({type: 'POST', dataType: 'json', url: tin.ajax_url, data: 'action=unsubscribe&email=' + email, cache: false, success:function(data){
            $('#unsubscribe-span').html(data.msg);
          }})
        }
      })
    </script>