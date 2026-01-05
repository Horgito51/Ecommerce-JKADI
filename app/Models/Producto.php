<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Model;
use Illuminate\Pagination\LengthAwarePaginator;
use Illuminate\Http\UploadedFile;
class Producto extends Model
{
    public $incrementing = false;
    protected $keyType = 'string';
    protected $table = 'productos';
    protected $primaryKey = 'id_producto';
    public $timestamps = false;
    protected $fillable = [
        'id_producto',
        'id_tipo',
        'pro_descripcion',
        'pro_um_venta',
        'pro_um_compra',
        'estado_prod',
        'img',
        'pro_saldo_inicial',
        'pro_valor_compra',
        'pro_precio_compra',
    ];

    //relaciones
    public function tipoProducto()
    {
        return $this->belongsTo(tiposProducto::class, 'id_tipo', 'id_tipo');
    }


    public function compras()
    {
        return $this->belongsToMany(
            Compra::class,
            'proxoc',
            'id_producto',
            'id_compra'
        )->withPivot([
            'pxo_cantidad',
            'pxo_valor',
            'pxo_subtotal',
            'estado_pxoc'
        ]);
    }

    public function facturas()
    {
        return $this->belongsToMany(
            Factura::class,
            'proxfac',
            'id_producto',
            'id_factura'
        )->withPivot([
            'pxf_cantidad',
            'pxf_precio',
            'pxf_subtotal',
            'pxf_estado'
        ])->withTimestamps();
    }


    //MD concepto

    public static function getAllProductos()
    {
        return self::select('id_producto','pro_descripcion','pro_um_compra','pro_um_venta','pro_saldo_final','pro_valor_compra','pro_precio_venta')->where('pro_saldo_final','>',0)->where('estado_prod',"=","ACT")->get();
    }


    public static function getProductos(){

        return self::where('estado_prod','=','ACT')->paginate(9);
    }

    public function scopeGetProductoBy($query,$search){
                if ($search) {
            $query->where(function ($q) use ($search) {
                $q->where('pro_descripcion', 'like', "%{$search}%")
                  ->orWhere('id_producto', 'like', "%{$search}%");
            });
        }
    }


    public static function createProducto(array $data, ?UploadedFile $imagen = null){
        $nombreImagen = null;

        if ($imagen && $imagen->isValid()) {
            $nombreImagen = $imagen->getClientOriginalName();
            $imagen->move(
                storage_path('app/public/products'),
                $nombreImagen
            );
        }

        return self::create([
            'id_producto'        => $data['id_producto'],
            'pro_descripcion'    => $data['pro_descripcion'],
            'id_tipo'            => $data['tipo_Producto'],
            'pro_um_compra'      => $data['unidad_medida_compra'],
            'pro_um_venta'       => $data['unidad_medida_venta'],
            'pro_saldo_inicial'  => $data['saldo_inicial'],
            'img'                => $nombreImagen,
            'estado_prod'        => 'ACT',
        ]);
    }


    public static function updateProducto(string $id, array $data){
        $producto = self::findOrFail($id);

        $producto->update([
            'pro_descripcion'   => $data['pro_descripcion'],
            'id_tipo'           => $data['tipo_Producto'],
            'pro_um_venta'      => $data['unidad_medida_venta'],
            'pro_um_compra'     => $data['unidad_medida_compra'],
            'pro_saldo_inicial' => $data['saldo_inicial'],
            'pro_valor_compra'=>$data['pro_valor_compra'],
            'pro_precio_venta'=>$data['pro_precio_venta'],
        ]);
    }



    public function destroyProducto(){
        $this->estado_prod = 'INA';
        $this->save();
    }





}
