<aside id="navmenu-mobile"> 
    <div id="navmenu-mobile-wraper"> 
     <ul id="menu-mobile" class="menu-mobile">
      <li id="menu-item-4324" class="menu-item menu-item-type-custom menu-item-object-custom current-menu-item current_page_item menu-item-home menu-item-4324"><a href="/">首页</a></li> 
      @foreach($cateone as $k=>$v)
           <li class="menu-item menu-item-type-taxonomy menu-item-object-category @if(!empty($catetwo[$k])) menu-item-has-children @else @endif  menu-item-4316"><a href="{{ url('/list/'.$v->cate_id) }}">{{$v->cate_name}}</a> 
            @if(!empty($catetwo[$k]))
            <ul class="sub-menu"> 
              @foreach($catetwo[$k] as $m=>$n)
               <li class="menu-item menu-item-type-custom menu-item-object-custom menu-item-4421"><a target="_blank" href="{{ url('/list/'.$n->cate_id) }}">{{$n->cate_name}}</a>
               </li> 
              @endforeach
            </ul> 
            @endif
          </li> 
         @endforeach 
      <li id="menu-item-5018" class="menu-item menu-item-type-post_type menu-item-object-page menu-item-5018"><a href="http://www.iydu.net/liuyan">留言簿</a></li> 
     </ul>
    </div> 
   </aside> 
