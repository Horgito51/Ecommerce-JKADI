<?php

namespace App\Http\Controllers;

use App\Models\Producto;
use App\Models\unidadesMedidas;
use App\Models\tiposProducto;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Storage;
use function Symfony\Component\String\s;

class ProductoController extends Controller
{
    /**
     * Display a listing of the resource.
     */
    public function index(Request $request)
    {
        $productos = Producto::getProductoBy($request->search)
                        ->paginate(10);

        return view('productos.index', compact('productos'));
    }
    public function create()
    {
        $tiposProducto = tiposProducto::getAllTiposProducto();
        $unidadesMedidas = unidadesMedidas::getAllUnidades();
        return view('productos.create', compact('tiposProducto','unidadesMedidas'));
    }

    /**
     * Store a newly created resource in storage.
     */
    public function store(Request $request)
    {

        $this->validateProducto($request);

        Producto::createProducto(
        $request->all(),
        $request->file('img')
        );

        return redirect()->route('productos.index')->with('Exitoso','Producto creado correctamente');
    }


    /**
     * Display the specified resource.
     */
    public function show(string $id)
    {
        //
    }

    /**
     * Show the form for editing the specified resource.
     */
    public function edit(string $id)
    {
        $productos = Producto::findOrfail($id);
        $tiposProducto = tiposProducto::getAllTiposProducto();
        $unidadesMedidas = unidadesMedidas::getAllUnidades();
        return view('productos.edit', compact('tiposProducto','unidadesMedidas','productos'));
    }

    /**
     * Update the specified resource in storage.
     */
    public function update(Request $request, string $id)
    {
        $this->validateProducto($request, $id);

        Producto::updateProducto($id, $request->all());

        return redirect()->route('productos.index')->with('Exitoso','Producto actualizado correctamente');
    }

    /**
     * Remove the specified resource from storage.
     */
    public function destroy(string $id)
    {
        $productos = Producto::findOrFail($id);
        if($productos->pro_saldo_final > 0){
            return redirect()->route('productos.index')->with('error','No se puede eliminar un producto con saldo disponible');
        }


        $productos->destroyProducto();

        return redirect()->route('productos.index')->with('Exitoso','Producto eliminado correctamente');
    }



private function validateProducto(Request $request, $id = null)
{
    $rules = [
        'pro_descripcion' => 'required|unique:productos,pro_descripcion' . ($id ? ',' . $id . ',id_producto' : ''),
        'tipo_Producto' => 'required',
        'unidad_medida_venta' => 'required',
        'unidad_medida_compra' => 'required',
        'saldo_inicial' => 'required|numeric|min:0',
        'img' => 'nullable|image|mimes:png,jpg,jpeg,webp|max:2048',
    ];

    $messages = [
        'pro_descripcion.required' => 'La descripción del producto es obligatoria',
        'pro_descripcion.unique' => 'Esta descripción de producto ya está registrada',

        'tipo_Producto.required' => 'Debes seleccionar un tipo de producto',

        'saldo_inicial.required' => 'El saldo inicial es obligatorio',
        'saldo_inicial.numeric' => 'El saldo inicial debe ser un número',
        'saldo_inicial.min' => 'El saldo inicial no puede ser negativo',

        'img.image' => 'El archivo debe ser una imagen',
        'img.mimes' => 'La imagen debe ser PNG, JPG, JPEG o WEBP',
    ];

    return $request->validate($rules, $messages);
}


}
