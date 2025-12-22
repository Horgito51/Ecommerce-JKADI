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
        $search = $request->get('search');
        
        $productos = Producto::when($search, function($query) use ($search) {
            return $query->where('pro_descripcion', 'like', "%{$search}%")
                        ->orWhere('id_producto', 'like', "%{$search}%");
        })->paginate(10);
        return view('productos.index', compact('productos'));
    }

    /**
     * Show the form for creating a new resource.
     */
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
        $request->validate([
            'id_producto' => 'required|unique:productos,id_producto',
            'pro_descripcion' => 'required|unique:productos,pro_descripcion',
            'tipo_Producto' => 'required',
            'unidad_medida_venta' => 'required',
            'unidad_medida_compra' => 'required',
            'saldo_inicial' => 'required|numeric|min:0',
            'img'=> 'nullable|image|mimes:png,jpg,jpeg,webp|max:2048',
        ],[
        'id_producto.required' => 'El código del producto es obligatorio',
        'id_producto.unique' => 'Este código de producto ya está registrado',

        'pro_descripcion.required' => 'La descripción del producto es obligatorio',
        'pro_descripcion.unique' => 'Esta descripción de producto ya está registrado', 
        
        'tipo_Producto.required' => 'Debes seleccionar un tipo de producto',
        
        'saldo_inicial.required' => 'El saldo inicial es obligatorio',
        'saldo_inicial.numeric' => 'El saldo inicial debe ser un número',
        'saldo_inicial.min' => 'El saldo inicial no puede ser negativo',

        ]);
        
        $nombreImagen = null;

        if ($request->hasFile('img') && $request->file('img')->isValid()) {
            $imagen = $request->file('img');

            $nombreImagen = $imagen->getClientOriginalName();

            $imagen->move(
                storage_path('app/public/products'),
                $nombreImagen
            );
        }
        
        Producto::create([
            'id_producto' => $request->id_producto,
            'pro_descripcion' => $request->pro_descripcion,
            'id_tipo' => $request->tipo_Producto,
            'pro_um_compra' => $request->unidad_medida_compra,
            'pro_um_venta' => $request->unidad_medida_venta,
            'pro_saldo_inicial' => $request->saldo_inicial,
            'img' => $nombreImagen,
            'estado_prod'=> 'ACT',
        ]);
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
        $request->validate([
            'pro_descripcion' => 'required|unique:productos,pro_descripcion,' . $id . ',id_producto',
            'tipo_Producto' => 'required',
            'unidad_medida_venta' => 'required',
            'unidad_medida_compra' => 'required',
            'saldo_inicial' => 'required|numeric|min:0',
        ],[
        'pro_descripcion.required' => 'La descripción del producto es obligatorio',
        'pro_descripcion.unique' => 'Esta descripción de producto ya está registrado', 
        
        'tipo_Producto.required' => 'Debes seleccionar un tipo de producto',

        'saldo_inicial.required' => 'El saldo inicial es obligatorio',
        'saldo_inicial.numeric' => 'El saldo inicial debe ser un número',
        'saldo_inicial.min' => 'El saldo inicial no puede ser negativo',

        ]);

        $productos = Producto::findOrFail($id);
        $productos->pro_descripcion = $request->pro_descripcion;
        $productos->id_tipo = $request->tipo_Producto;
        $productos->pro_um_venta = $request->unidad_medida_venta;
        $productos->pro_um_compra = $request->unidad_medida_compra;
        $productos->pro_saldo_inicial = $request->saldo_inicial;
        $productos->save();

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


        $productos->estado_prod = 'INA';
        $productos->save();
        return redirect()->route('productos.index')->with('Exitoso','Producto eliminado correctamente');
    }

}
