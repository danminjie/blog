<!DOCTYPE html>
<html lang="en">
<head>
	<meta charset="UTF-8">
	<title>Document</title>
</head>
<body>
	<form action="{{url('user/insert')}}" method="post" >
		{{csrf_field()}}
		<table>
			<tr>
				<td>用户名</td>
				<td><input type="text" name="username" id=""></td>
			</tr>
			<tr>
				<td>密码</td>
				<td><input type="password" name="password" id=""></td>
			</tr>
			<tr>
				<td><input type="submit" value="提交"></td>
			</tr>
		</table>
	</form>
</body>
</html>