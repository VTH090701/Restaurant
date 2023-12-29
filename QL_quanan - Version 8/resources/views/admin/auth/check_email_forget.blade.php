<div style="width: 600px;margin: 0 auto;">
    <div style="text-align: center">
        <h2>Xin chào {{$admin->nv_ten}}</h2>
        <p>Email này để giúp bạn lấy lại mật khẩu tài khoản đã bị quên</p>
        <p>Vui lòng click vào link bên dưới đây để lấy lại mật khẩu</p>
        <p>Chú ý: mã xác nhận trong link chỉ có hiệu lực trong vòng 72 giờ</p>
        <p>
            <a href="{{route('auth.getpass',['auth' => $admin->nv_id,'token'=>$admin->nv_token ])}}" 
                style="display: inline-block;background: green;color: #fff;padding: 7px 25px;font-weight: bold">
                Đặt lại mật khẩu.
            </a>
        </p>
    </div>
    {{-- <h3>Người </h3> --}}
</div>