@extends('layouts.app')
@section('title','Đăng nhập')

@section('content')

<div class="login-box">

    <div class="login-logo">
        <a href="javascript:;"><b>Inside Report</b> FOXPAY</a>
    </div>

    <div class="login-box-body">
        <p class="login-box-msg"><strong>Đăng nhập</strong></p>

        <p class="alert-danger hidden">Đăng nhập bằng tài khoản và mật khẩu email FPT ngoại trừ BGĐ</p>

        <form action="{{ route('login') }}" method="post">
            @csrf

            @if ($showLoginBox)
            <div class="form-group has-feedback {!! $errors->first('email', 'has-error') !!}">
                <input name="email" type="email" class="form-control" placeholder="Email" value="{{ old('email') }}" autofocus>
                <span class="glyphicon glyphicon-envelope form-control-feedback"></span>
                {!! $errors->first('email', '<span class="help-block">:message</span>') !!}
            </div>
            <div class="form-group has-feedback {!! $errors->first('password', 'has-error') !!}">
                <input name="password" type="password" class="form-control" placeholder="Password">
                <span class="glyphicon glyphicon-lock form-control-feedback"></span>
                {!! $errors->first('password', '<span class="help-block">:message</span>') !!}
            </div>
            <div class="row">
                <div class="col-xs-4">
                    <button type="submit" class="btn btn-primary btn-flat">Đăng nhập</button>
                </div>
            </div>
            <div class="row">
                <div class="form-group col-xs-12 mt-4">
                </div>
            </div>
            @endif

            @if (!App::environment('local'))

            <div class="text-center">
                {!! $errors->first('login_invalid', '<span class="help-block invalid-feedback">:message</span>') !!}
            </div>

            <div class="row">
                <div class="col-xs-12">
                    <div class="text-center">
                        <div>Đăng nhập bằng tài khoản</div>
                    </div>
                </div>
                <div class="row">
                    <div class="col-xs-12">&nbsp</div>
                </div>
                <div class="col-xs-12">
                    <div class="col-xs-6 text-center">
                        <a href="{{ url('/auth/signin') }}" title="FPT ADSF"><img src="{{ asset('/static/img/logo_fpt_122x83.png') }}" /></a>
                    </div>

                    <div class="col-xs-6 text-center">
                        <a href="{{ url('/sso/signin') }}" title="FOXPAY SSO"><img src="{{ asset('/static/img/icon-foxpay.png') }}" /></a>
                    </div>
                </div>
            </div>

            @endif
        </form>

    </div>

</div>

@stop

@section('script')

<script src="https://iid-dev.foxpay.vn/auth/js/keycloak.js" type="text/javascript"></script>
<script>
        function initKeycloak() {
            var keycloak = new Keycloak({
                    url: 'https://iid-dev.foxpay.vn/auth',
                    realm: 'inside',
                    clientId: 'inside-report-dev'}
            );

            keycloak.init({
                onLoad: 'check-sso',
                silentCheckSsoRedirectUri: window.location.origin + '/silent-check-sso.html'
            });


            keycloak.onAuthSuccess = function() {
                location.href = window.location.origin +
                        '/sso/check-sso?token=' + this.token +
                        '&refresh_token=' + this.refreshToken;
            };

            keycloak.onAuthError = function (errorData) {
                alert("Auth Error: " + JSON.stringify(errorData) );
            };

            keycloak.onAuthLogout = function () {
                alert('Auth Logout');
            };

        }

        $(document).ready(function() {
            initKeycloak();
        });
</script>

@stop

