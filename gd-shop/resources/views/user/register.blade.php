<link href="//maxcdn.bootstrapcdn.com/bootstrap/4.1.1/css/bootstrap.min.css" rel="stylesheet" id="bootstrap-css">
<script src="//maxcdn.bootstrapcdn.com/bootstrap/4.1.1/js/bootstrap.min.js"></script>
<script src="//cdnjs.cloudflare.com/ajax/libs/jquery/3.2.1/jquery.min.js"></script>
<!------ Include the above in your HEAD tag ---------->
<style>
    .alert-danger{
        margin-top: 3px;
        padding: 3px 5px;
        background: none;
        color: red;
        border: none;
        font-weight: bold;
    }
</style>
<body>
<div id="login">
    <h3 class="text-center text-white pt-5">Đăng ký</h3>
    <div class="container">
        <div id="login-row" class="row justify-content-center align-items-center">
            <div id="login-column" class="col-md-6">
                <div id="login-box" class="col-md-12">
                    <form  action="{{route('user.store')}}" method="post" enctype="multipart/form-data">
                        @csrf
                        <h3 class="text-center text-info"></h3>
                        <div class="form-group">
                            <label for="name" class="cols-sm-2 control-label">Nhập Tên</label>
                            <div class="input-group">
                                <span class="input-group-addon"><i class="fa fa-user fa" aria-hidden="true"></i></span>
                                <input type="text"
                                       class="form-control @error('name') is-invalid @enderror"
                                       name="name"
                                       placeholder="Nhập tên của bạn"/>
                            </div>
                            @error('name')
                            <div class="alert alert-danger">{{ $message }}</div>
                            @enderror
                        </div>

                        <div class="form-group">
                            <label for="email" class="cols-sm-2 control-label">Nhập Email</label>
                            <div class="input-group">
                                <span class="input-group-addon"><i class="fa fa-envelope fa" aria-hidden="true"></i></span>
                                <input type="text"
                                       class="form-control @error('email') is-invalid @enderror"
                                       name="email"
                                       placeholder="Nhập Email"/>
                            </div>
                            @error('email')
                            <div class="alert alert-danger">{{ $message }}</div>
                            @enderror
                        </div>

                        <div class="form-group">
                            <label for="phone" class="cols-sm-2 control-label">Nhập số điện thoại</label>
                            <div class="input-group">
                                <span class="input-group-addon"><i class="fa fa-phone fa" aria-hidden="true"></i></span>
                                <input type="text"
                                       class="form-control @error('phone') is-invalid @enderror"
                                       name="phone"
                                       placeholder="Nhập số điện thoại"/>
                            </div>
                            @error('phone')
                            <div class="alert alert-danger">{{ $message }}</div>
                            @enderror
                        </div>

                        <div class="form-group">
                            <label for="address" class="cols-sm-2 control-label">Nhập địa chỉ</label>
                            <div class="input-group">
                                <span class="input-group-addon"><i class="fa fa-home fa" aria-hidden="true"></i></span>
                                <input type="text"
                                       class="form-control @error('address') is-invalid @enderror"
                                       name="address"
                                       placeholder="Nhập địa chỉ của bạn"/>
                            </div>
                            @error('address')
                            <div class="alert alert-danger">{{ $message }}</div>
                            @enderror
                        </div>

                        <div class="form-group">
                            <label for="password" class="cols-sm-2 control-label">Mật khẩu</label>
                            <div class="input-group">
                                <span class="input-group-addon"><i class="fa fa-lock fa-lg" aria-hidden="true"></i></span>
                                <input type="password"
                                       class="form-control @error('password') is-invalid @enderror"
                                       name="password"
                                       placeholder="Nhập mật khẩu"/>
                            </div>
                            @error('password')
                            <div class="alert alert-danger">{{ $message }}</div>
                            @enderror
                        </div>

                        <div class="form-group">
                            <label for="confirm" class="cols-sm-2 control-label">Xác nhận mật khẩu</label>
                            <div class="input-group">
                                <span class="input-group-addon"><i class="fa fa-lock fa-lg" aria-hidden="true"></i></span>
                                <input type="password"
                                       class="form-control @error('confirm') is-invalid @enderror"
                                       name="password_confirmation"
                                       placeholder="Nhập lại mật khẩu"/>
                            </div>
                            @error('confirm')
                            <div class="alert alert-danger">{{ $message }}</div>
                            @enderror
                        </div>


                        <div class="form-group ">

                            <button type="submit" class="btn btn-primary btn-lg btn-block login-button">Đăng ký</button>
                        </div>

                    </form>
                </div>
            </div>
        </div>
    </div>
</div>
</body>
<style>
    body {
        margin: 0;
        padding: 0;
        background-color: #17a2b8;
        height: 100vh;
    }
    #login .container #login-row #login-column #login-box {
        margin-top: 120px;
        max-width: 600px;
        height: 630px;
        border: 1px solid #9C9C9C;
        background-color: #EAEAEA;
    }
    #login .container #login-row #login-column #login-box #login-form {
        padding: 20px;
    }
    #login .container #login-row #login-column #login-box #login-form #register-link {
        margin-top: -85px;
    }
</style>
