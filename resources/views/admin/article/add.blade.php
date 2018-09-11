<!DOCTYPE html>
<html>
  
  <head>
    <meta charset="UTF-8">
    <title>欢迎页面-X-admin2.0</title>
    <meta name="renderer" content="webkit">
    <meta http-equiv="X-UA-Compatible" content="IE=edge,chrome=1">
    <meta name="csrf-token" content="{{ csrf_token() }}">
    <meta name="viewport" content="width=device-width,user-scalable=yes, minimum-scale=0.4, initial-scale=0.8,target-densitydpi=low-dpi" />
    <link rel="shortcut icon" href="/favicon.ico" type="image/x-icon" />
    <link rel="stylesheet" href="{{ asset('admin/css/font.css') }}">
    <link rel="stylesheet" href="{{ asset('admin/css/xadmin.css') }}">
    <script type="text/javascript" src="https://cdn.bootcss.com/jquery/3.2.1/jquery.min.js"></script>
    <script type="text/javascript" src="{{ asset('admin/lib/layui/layui.js') }}" charset="utf-8"></script>
    <script type="text/javascript" src="{{ asset('admin/js/xadmin.js') }}"></script>
    <!-- 让IE8/9支持媒体查询，从而兼容栅格 -->
    <!--[if lt IE 9]>
      <script src="https://cdn.staticfile.org/html5shiv/r29/html5.min.js"></script>
      <script src="https://cdn.staticfile.org/respond.js/1.4.2/respond.min.js"></script>
    <![endif]--></head>
  
  <body>
    <div class="x-body">
      <form class="layui-form" id="art_form" action="{{ url('admin/article') }}" method="post">{{-- {{ csrf_field() }}--}}
        <div class="layui-form-item">
          <label for="L_email" class="layui-form-label">
            <span class="x-red">*</span>分类</label>
          <div class="layui-input-inline">
            <select name="cate_id">{{--
              <option value="0">==顶级分类==</option>--}} @foreach($cates as $k=>$v)
              <option value="{{ $v->cate_id }}">{{ $v->cate_name }}</option>@endforeach</select></div>
          <div class="layui-form-mid layui-word-aux">
            <span class="x-red">*</span></div>
        </div>
        <div class="layui-form-item">
          <label for="L_art_title" class="layui-form-label">
            <span class="x-red">*</span>文章标题</label>
          <div class="layui-input-block">{{csrf_field()}}
            <input type="text" id="L_art_title" name="art_title" required=""  autocomplete="off" class="layui-input"></div></div>
        <div class="layui-form-item">
          <label for="L_art_editor" class="layui-form-label">
            <span class="x-red">*</span>编辑</label>
          <div class="layui-input-inline">
            <input type="text" id="L_art_editor" name="art_editor" required="" autocomplete="off" class="layui-input"></div>
        </div>
        <div class="layui-form-item layui-form-text">
          <label class="layui-form-label">缩略图</label>
          <div class="layui-input-block layui-upload">
            <input type="hidden" id="img1" class="hidden" name="art_thumb" value="">
            <button type="button" class="layui-btn" id="test1">
              <i class="layui-icon">&#xe67c;</i>上传图片</button>
            <input type="file" name="photo" id="photo_upload" style="display: none;" /></div>
        </div>
        <div class="layui-form-item layui-form-text">
          <label class="layui-form-label"></label>
          <div class="layui-input-block">
            <img src="" alt="" id="art_thumb_img" style="max-width: 350px; max-height:100px;"></div>
        </div>
        <div class="layui-form-item">
          <label for="L_art_tag" class="layui-form-label">
            <span class="x-red">*</span>关键词</label>
          <div class="layui-input-inline">
            <input type="text" id="L_art_tag" name="art_tag" required="" autocomplete="off" class="layui-input"></div>
        </div>
        <div class="layui-form-item">
          <label for="L_art_tag" class="layui-form-label">
            <span class="x-red">*</span>描述</label>
          <div class="layui-input-block">
            <textarea placeholder="请输入内容" class="layui-textarea" name="art_description"></textarea>
          </div>
        </div>
        <div class="layui-form-item">
          <label for="L_art_tag" class="layui-form-label">
            <span class="x-red">*</span>markdown编辑器
          </label>          
          <div class="layui-input-block">
            <div class="layui-tab">
              <ul class="layui-tab-title">
                <li class="layui-this">输入markdown语法内容</li>
                <li id="previewBtn">查看HTML内容，复制到下面内容框里</li></ul>
              <div class="layui-tab-content">
                <div class="layui-tab-item layui-show">
                  <textarea id="z-textarea"  placeholder="请输入内容" class="layui-textarea"></textarea>
                </div>
                <div class="layui-tab-item">
                  <textarea id="z-textarea-preview" placeholder="请输入内容" class="layui-textarea"></textarea>
                </div>
              </div>
            </div>
          </div>
          <div class="layui-form-item">
            <label for="L_art_tag" class="layui-form-label">
              <span class="x-red">*</span>内容</label>
            <div class="layui-input-block">{{-- 配置文件 --}}
              <script type="text/javascript" charset="utf-8" src="/ueditor/ueditor.config.js"></script>
              <script type="text/javascript" charset="utf-8" src="/ueditor/ueditor.all.min.js"></script>
              <script type="text/javascript" charset="utf-8" src="/ueditor/lang/zh-cn/zh-cn.js"></script>
              <script id="editor" type="text/plain" name="art_content" style="width:980px;height:300px;"></script>{{--
              <script id="art_name" type="text/plain" name="art_name" style="width:980px;height:300px;"></script>--}}
              <script type="text/javascript">//实例化编辑器
                //建议使用工厂方法getEditor创建和引用编辑器实例，如果在某个闭包下引用该编辑器，直接调用UE.getEditor('editor')就能拿到相关的实例
                var ue = UE.getEditor('editor');
                // var ue = UE.getEditor('art_name');
                </script>
            </div>
          </div>
        </div>
        <div class="layui-form-item">
          <label for="L_repass" class="layui-form-label"></label>
          <button class="layui-btn" lay-filter="add" lay-submit="">增加</button></div>
      </form>
    </div>
  </body>
  <script>
    $.ajaxSetup({
      headers: {
        'X-CSRF-TOKEN': '{{ csrf_token() }}'
      }
    });

    //Markdown AJAX
    $('#previewBtn').click(function() {
      $.ajax({
        url: "/admin/article/pre_mk",
        type: "post",
        data: {
          cont: $('#z-textarea').val()
        },
        success: function(res) {
          $('#z-textarea-preview').html(res);
        },
        error: function(err) {
          console.log(err.responseText);
        }
      });
    })
  </script>
  <script>
    layui.use(['form', 'layer', 'upload', 'element'],function() {
      $ = layui.jquery;
      var form = layui.form,
      layer = layui.layer;
      var upload = layui.upload;
      var element = layui.element;
      $('#test1').on('click', function() {
        //自动触发点击事件
        $('#photo_upload').trigger('click');
        $('#photo_upload').on('change', function() {
          var obj = this;
          var formData = new FormData($('#art_form')[0]);
          $.ajax({
            url: '/admin/article/upload',
            type: 'post',
            data: formData,
            // 因为data值是FormData对象，不需要对数据做处理
            processData: false,
            contentType: false,
            success: function(data) {
              if (data['ServerNo'] == '200') {
                //阿里OSS库
                // $('#art_thumb_img').attr('src', '{{ env('ALIOSS_DOMAIN')  }}'+data['ResultData']);

                // //千牛云库
                // $('#art_thumb_img').attr('src', '{{ env('QINIU_DOMAIN')  }}'+data['ResultData']);

                //默认服务器保存
                $('#art_thumb_img').attr('src', '/uploads/' + data['ResultData']);
                
                //将隐藏域的值改变，提交到数据库
                $('input[name=art_thumb]').val('/uploads/' + data['ResultData']);
                $(obj).off('change');
              } else {
                // 如果失败
                alert(data['ResultData']);
              }
            },
            error: function(XMLHttpRequest, textStatus, errorThrown) {
              var number = XMLHttpRequest.status;
              var info = "错误号" + number + "文件上传失败!";
              // 将菊花换成原图
              // $('#pic').attr('src', '/file.png');
              alert(info);
            },
            async: true
          });
        });
      });
      //监听提交
      form.on('submit(add)', function(data) {
        
      });

    });
  </script>
  </body>

</html>