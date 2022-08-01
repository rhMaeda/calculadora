<!doctype html>
<html lang="pt_BR">
    <head>
        <meta charset="utf-8">
        <meta name="viewport" content="width=device-width, initial-scale=1">
        <title>Calculadora</title>
        <link href="https://fonts.googleapis.com/css?family=Nunito:200,600" rel="stylesheet">
        <link rel="stylesheet" type="text/css" href="{{ URL::asset('css/main.css') }}  ">  
    </head>
    <body>
    <div id="main-wrapper">
        <h1>Calculadora</h1>
        @if ($errors->any())
            <div class="alert alert-danger">
                <ul>
                    @foreach ($errors->all() as $error)
                        <li>{{ $error }}</li>
                    @endforeach
                </ul>
            </div>
        @endif
        @if (strlen(session('resultado')) > 0)
            <div class="alert alert-success">
                {{ session('valor1') }}  {{ session('sinal') }}  {{ session('valor2') }} = {{ session('resultado') }}
            </div>
        @endif
        <form method="get" action="{{ route('calcular') }}">
            {!! csrf_field() !!}            
            <span>Valor 1:</span>
            <input type="text" name="valor1" size="10" value="{{ old('valor1', session('valor1')) }}" />
            <span>Operação:</span>
            <select name="operador">
                <option value="">Selecione</option>
                <option value="soma" {{ ( old('operador', session('operador')) == 'soma') ? 'selected' : '' }}>Soma</option>
                <option value="subtracao" {{ ( old('operador', session('operador')) == 'subtracao') ? 'selected' : '' }}>Subtracao</option>
                <option value="multiplicacao" {{ ( old('operador', session('operador')) == 'multiplicacao') ? 'selected' : '' }}>Multiplicacao</option>
                <option value="divisao" {{ ( old('operador', session('operador')) == 'divisao') ? 'selected' : '' }}>Divisao</option>
                <option value="potenciacao" {{ ( old('operador', session('operador')) == 'potenciacao') ? 'selected' : '' }}>Potenciacao</option>
                <option value="radiciacao" {{ ( old('operador', session('operador')) == 'radiciacao') ? 'selected' : '' }}>Radiciacao</option>
            </select>          
            <span>Valor 2:</span>
            <input type="text" name="valor2" size="10" value="{{ old('valor2', session('valor2')) }}" />       
            <input type="submit" value="Calcular" />  
        </form>
    </div>
    </body>
</html>
