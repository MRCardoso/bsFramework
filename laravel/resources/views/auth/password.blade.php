@include('partials.header')
    @include('partials.info')
    <div class="content content-small">
        <div class="breadcrumb">
            <h4 class="text-center">Recuperar Senha</h4>
        </div>
        @include('errors.list')
        <form method="POST" action="{{ url('/password/email') }}" class="form-horizontal">
            {!! csrf_field() !!}
            <div class="form-group">
                <div class="col-md-12">
                    <label class="control-label">preencha seu E-mail cadastrado</label>
                    <input type="email" name="email" value="{{ old('email') }}" class="form-control">
                </div>
            </div>

            <div class="text-center">
                <button type="submit" class="btn mrc-btn-light">
                    Enviar token
                </button>
            </div>
        </form>
    </div>
@include('partials.footer')