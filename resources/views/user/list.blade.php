<!DOCTYPE html>
<html lang="en">
<head>
	<meta charset="UTF-8">
	<title>Document</title>
	<script src="/js/layer/jQuery.js"></script>
	<script src="/js/layer/layer.js"></script>
</head>
<body>
	<table border="1" align="center">
		<caption>用户列表</caption>
		<tr>
			<th>ID</th>
			<th>用户名</th>
			<th>密码</th>
			<th>操作</th>
		</tr>
		@foreach($user as $v)
		<tr>
			<td>{{ $v->id }}</td>
			<td>{{ $v->username }}</td>
			<td>{{ $v->password }}</td>
			<td><a href="edit/{{$v->id}}">编辑</a> | <a href="javascript:;" onclick="del_member(this,{{$v->id}},'{{$v->username}}');">删除</a></td>
		</tr>
		@endforeach
	</table>
</body>
<script>
	function del_member(obj,id,username){
		layer.confirm('您确定要删除"'+username+'"', {
		  btn: ['确认','取消'] //按钮
		}, function(){
			$.get('/user/del/'+id, function(data) {
				if(data.status == 0){
					$(obj).parents('tr').remove();
					layer.msg(data.message, {icon: 6});
				}else{
					layer.msg(data.message, {icon: 5});
				}
			});		
		}, function(){
		  
		});
	}
</script>
</html>