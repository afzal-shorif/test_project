<!DOCTYPE html>
<html>
<head><title></title></head>
<body>
    <h1 style="text-align: center;">Login In</h1>
    <div style="width: 300px; margin: 0 auto; border: 1px solid #ddd; border-radius: 5px; padding: 15px; display: block; overflow: hidden;">
            <div style="color: #ff0000;">
                @if(Session::get('error'))
                    {{Session::get('error')}}
                @endif
            </div>

            @if (count($errors) > 0)
                <div style="color: #ff0000">
                    <ul>
                        @foreach($errors->all() as $error)
                            <li>{{ $error }}</li>
                        @endforeach
                    </ul>
                </div>
            @endif
        <form method="post" action="{{url('check_login')}}">
            {{csrf_field()}}
            <div style="width: 100%; display: inline-block; margin-bottom: 15px;">
                <label for="email">Email:</label>
                <input type="email" name="email" placeholder="Email" style="float: right;"> <br>
            </div>
            <div style="width: 100%; display: inline-block;">
                <label for="password">Password:</label>
                <input type="password" name="password" placeholder="Password" style="float: right;"> <br>
            </div>
            <input type="submit" name="submit" value="Login" style="float: right; margin-top: 15px;">
        </form>
    </div>
</body>
</html>
