@include('partials.header')
    @include('partials.info')
    <div class="content content-medium">
        <form method="POST" action="signin" class="form-horizontal">
            {!! csrf_field() !!}
            <div class="breadcrumb">
                 <h4 class="text-center">Efetuar login</h4>
            </div>
            @include('errors.list')
            <div class="form-group">
                <label class="col-md-4 control-label">Email</label>
                <div class="col-md-6">
                    <input type="text" name="email" value="{{ old('email') }}" class="form-control">
                </div>
            </div>
            <div class="form-group">
                <label class="col-md-4 control-label">Password</label>
                <div class="col-md-6">
                    <input type="password" name="password" id="password" class="form-control">
                </div>
            </div>
            <div class="form-group">
                <div class="col-md-10 text-right">
                    <label class="control-label">
                        <input type="checkbox" name="remember" id="remember"> Remember Me
                    </label>
                </div>
            </div>
            <div class="button-group">
                <a href="{{ url('./password/email') }}" class="pull-left">Esqueci minha senha</a>
                <a href="{{ url('./') }}" class="btn btn-default">Voltar</a>
                <button type="submit" class="btn mrc-btn-light">Login</button>
            </div>
        </form>
    </div>
@include('partials.footer')