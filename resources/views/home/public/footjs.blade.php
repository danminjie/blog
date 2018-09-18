<script type="text/javascript" src="{{ asset('home/js/zh-cn-tw.js') }}"></script> 
  <script type="text/javascript" src="{{ asset('home/js/comments-ajax.js') }}"></script> 
  {{-- <script type="text/javascript" src="{{ asset('home/js/ajax-sign-script.min.js') }}"></script>  --}}
  <script type="text/javascript" src="{{ asset('home/js/prettify.js') }}"></script> 
  {{-- <script type="text/javascript">
    /*天真网（tzw520.cn） 鼠标特效 */
    var a_idx = 0;
    jQuery(document).ready(function($) {
        $("body").click(function(e) {
            var a = new Array("闻鸡起舞","白手起家", "卷土从来", "晨钟暮鼓", "力争上游", "破釜成舟", "前车之鉴", "投笔从戎" ,"金石为开", "勤能补拙", "人定胜天", "有志竟成", "悬梁刺股", "奋发图强", "良药苦口", "精力求精", "卧薪尝胆", "愚公移山", "大器晚成", "磨杵成针", "发愤忘食", "持之以恒");
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
  </script> --}}
  <script type="text/javascript">
/* <![CDATA[ */
var ajax_sign_object = {"redirecturl":"http:\/\/www.iydu.net\/","ajaxurl":"http:\/\/www.iydu.net\/wp-admin\/admin-ajax.php","loadingmessage":"\u6b63\u5728\u8bf7\u6c42\u4e2d\uff0c\u8bf7\u7a0d\u7b49..."};
/* ]]> */
</script> 
  <script src="/home/js/jquery.prettyPhoto.js"></script> 
  <!-- 引入用户自定义代码 --> 
  <!-- 引入主题js --> 
  
  <script type="text/javascript" src="/home/js/theme.js?ver=4.3.6"></script> 
  <!-- /.Footer --> 
  <script type="text/javascript">
  	$('.site_loading').animate({'width':'100%'},50);  //第五个节点
  </script>  
