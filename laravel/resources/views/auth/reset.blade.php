@include('partials.header')
    @include('partials.info')
    <div class="content content-medium">
        <div class="breadcrumb">
            <h4 class="text-center">Redefinir Senha</h4>
        </div>
        <form method="POST" action="{{ url('/password/reset') }}" class="form-horizontal">
            {!! csrf_field() !!}
            <input type="hidden" name="token" value="{{ $token }}">
            @include('errors.list')
            <div class="form-group">
                <label for="" class="col-md-4 control-label">Email</label>
                <div class="col-md-6">
                    <input type="email" name="email" value="{{ old('email') }}" class="form-control">
                </div>
            </div>
            <div class="form-group">
                <label for="" class="col-md-4 control-label">Password</label>
                <div class="col-md-6">
                    <input type="password" name="password" class="form-control">
                </div>
            </div>
            <div class="form-group">
                <label for="" class="col-md-4 control-label">Confirm Password</label>
                <div class="col-md-6">
                    <input type="password" name="password_confirmation" class="form-control">
                </div>
            </div>
            <div class="button-group">
                <button type="submit" class="btn mrc-btn-light">
                    Reset Password
                </button>
            </div>
        </form>
    </div>
@include('partials.footer')