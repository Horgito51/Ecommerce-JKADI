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
    public function index()
    {
        $productos = Producto::getAllProductos();
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
            'id_producto' => 'required',
            'pro_descripcion' => 'required',
            'tipo_Producto' => 'required',
            'unidad_medida_venta' => 'required',
            'unidad_medida_compra' => 'required',
            'saldo_inicial' => 'required',
            'img'=> 'nullable|image|mimes:png,jpg,jpeg,webp|max:2048',
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
        //
    }

    /**
     * Update the specified resource in storage.
     */
    public function update(Request $request, string $id)
    {
        //
    }

    /**
     * Remove the specified resource from storage.
     */
    public function destroy(string $id)
    {
        //
    }
}
