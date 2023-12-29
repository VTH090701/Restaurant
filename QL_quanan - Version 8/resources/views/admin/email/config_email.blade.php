@extends('layout')
@section('admin_content')
    <div class="card shadow mb-4">
        <div class="card-header py-3">
            <h6 class="m-0 font-weight-bold text-primary">Cấu hình email config</h6>
        </div>

        <div class="card-body">
            <div class="table-responsive">
                @foreach ($mails as $mail)
                    <form method="POST" action="{{ url('/save-config-email/' . $mail->mail_id) }}">
                        @csrf
                        <div class="form-group">
                            <label for="exampleInputEmail1">Mail Transport</label>
                            <input type="text" class="form-control" placeholder="Nhập Transport" name="mail_transport"
                                value="{{ $mail->mail_transport }}">
                        </div>
                        <div class="form-group">
                            <label for="exampleInputEmail1">Mail Host</label>
                            <input type="text" class="form-control" placeholder="Nhập Host" name="mail_host"
                                value="{{ $mail->mail_host }}">
                        </div>
                        <div class="form-group">
                            <label for="exampleInputEmail1">Mail Port</label>
                            <input type="text" class="form-control" placeholder="Nhập Port" name="mail_port"
                                value="{{ $mail->mail_port }}">
                        </div>
                        <div class="form-group">
                            <label for="exampleInputEmail1">Mail User</label>
                            <input type="text" class="form-control" placeholder="Nhập User" name="mail_user"
                                value="{{ $mail->mail_user }}">
                        </div>
                        <div class="form-group">
                            <label for="exampleInputEmail1">Mail Password</label>
                            <input type="text" class="form-control" placeholder="Nhập Password" name="mail_password"
                                value="{{ $mail->mail_password }}">
                        </div>
                        <div class="form-group">
                            <label for="exampleInputEmail1">Mail Encryption</label>
                            <input type="text" class="form-control" placeholder="Nhập Encryption" name="mail_encryption"
                                value="{{ $mail->mail_encryption }}">
                        </div>
                        <div class="form-group">
                            <label for="exampleInputEmail1">Mail From</label>
                            <input type="text" class="form-control" placeholder="Nhập Mail From" name="mail_from"
                                value="{{ $mail->mail_from }}">
                        </div>
                        <a href="{{ url('/dashboard') }}" class="btn btn-success">Trở lại</a>

                        <button type="submit" name="add_email" class="btn btn-primary">Cập nhật email</button>

                    </form>
                @endforeach

            </div>
        </div>
    </div>
@endsection
