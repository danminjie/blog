<!DOCTYPE html>
<html lang="en">
<head>
	<meta charset="UTF-8">
	<title>Document</title>
</head>
<body>
	<form action="{{url('user/update')}}" method="post" >
		{{csrf_field()}}
		<table>
			<tr>
				<td>用户名</td>
				<td><input type="text" name="username" value="{{$user->username}}"></td>
				<input type="hidden" name="id" value="{{$user->id}}">
			</tr>
			<tr>
				<td><input type="submit" value="修改"></td>
			</tr>
		</table>
	</form>
</body>
</html>