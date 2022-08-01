<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;

class CalculadoraController extends Controller
{
    public function index()
    {
        return view('calculadora');
    }

    public function calculate(Request $request)
    {
        $rules = [
            'valor1' => 'required|numeric',
            'valor2' => 'required|numeric',
            'operador' => [
                'required',
                'max:255',
            ],
        ]; 
        $messages = [
            'valor1.required' => 'Valor 1 não pode estar vazio',
            'valor1.numeric' => 'Valor 1 precisa ser um núnero',
            'valor2.required' => 'Valor 2 não pode estar vazio',
            'valor2.numeric' => 'Valor 2 precisa ser um núnero',
            'operador.required' => 'Selecione uma operação'
        ];
        $this->validate($request, $rules, $messages);

        $valor1 = $request->input('valor1');
        $valor2 = $request->input('valor2');
        $operador = basename($request->input('operador'));

        switch($operador) {
            case 'soma':
                $valor = $this->soma($valor1, $valor2);

                $resultado = $valor['resultado'];
                $sinal = $valor['sinal'];
                break;
            case 'subtracao':
                $valor = $this->subtracao($valor1, $valor2);
                $resultado = $valor['resultado'];
                $sinal = $valor['sinal'];
                break;
            case 'multiplicacao':
                $valor = $this->multiplicacao($valor1, $valor2);
                $resultado = $valor['resultado'];
                $sinal = $valor['sinal'];
                break;
            case 'divisao':
                $valor = $this->divisao($valor1, $valor2);
                $resultado = $valor['resultado'];
                $sinal = $valor['sinal'];
                break;
            case 'radiciacao':
                $valor = $this->radiciacao($valor1, $valor2);
                $resultado = $valor['resultado'];
                $sinal = $valor['sinal'];
                break;
            case 'potenciacao':
                $valor = $this->potenciacao($valor1, $valor2);
                $resultado = $valor['resultado'];
                $sinal = $valor['sinal'];
                break;
            default:
                return redirect()->route('inicio')->with('error', 'Operação inválida');
        }
        
        return redirect()->route('inicio')->with( 
            [ 
                'valor1' => $valor1,
                'valor2' => $valor2,
                'resultado' => $resultado,                
                'sinal' => $sinal,
                'operador' => $operador
            ]
        );
    }

    public function soma($value1, $value2)
    {
        return ['resultado' => $value1 + $value2, 'sinal' => '+'];
    }
    public function subtracao($value1, $value2)
    {
        return ['resultado' => $value1 - $value2, 'sinal' => '-'];
    }
    public function divisao($value1, $value2)
    {
        return ['resultado' => $value1 / $value2, 'sinal' => '/'];
    }
    public function multiplicacao($value1, $value2)
    {
        return ['resultado' => $value1 * $value2, 'sinal' => '*'];
    }
    public function radiciacao($value1, $value2)
    {
        return ['resultado' => pow($value2,1/$value1), 'sinal' => '√'];
    }
    public function potenciacao($value1, $value2)
    {
        return ['resultado' => pow($value1,$value2), 'sinal' => '^'];
    }

}
