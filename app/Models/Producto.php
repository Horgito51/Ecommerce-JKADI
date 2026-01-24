<?php

namespace App\Models;
use Illuminate\Database\Eloquent\Model;
use Illuminate\Pagination\LengthAwarePaginator;
use Illuminate\Http\UploadedFile;
use Illuminate\Support\Facades\Storage;
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
        'pro_precio_venta',
        'pro_precio_compra',
        'pro_saldo_final',
    ];

    //relaciones

    public function unidadMedidaVenta()
    {
        return $this->belongsTo(unidadesMedidas::class, 'pro_um_venta', 'id_unidad_medida');
    }

    public function unidadMedidaCompra()
    {
        return $this->belongsTo(unidadesMedidas::class, 'pro_um_compra', 'id_unidad_medida');
    }
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

        return self::where('estado_prod','=','ACT')->where('pro_saldo_final','>',0)->paginate(9);
    }


    public static function getProductoBy($search = '', $categoria = null)
    {
        return self::select(
                'id_producto',
                'id_tipo',
                'pro_descripcion',
                'pro_um_venta',
                'pro_um_compra',
                'estado_prod',
                'img',
                'pro_saldo_inicial',
                'pro_valor_compra',
                'pro_precio_venta',
                'pro_saldo_final',
            )
            ->where('estado_prod', '=', 'ACT')->where('pro_saldo_final','>',0)
            ->when($search !== '', function ($q) use ($search) {
                $q->where(function ($w) use ($search) {
                    $w->where('id_producto', 'ILIKE', "%{$search}%")
                    ->orWhere('pro_descripcion', 'ILIKE', "%{$search}%");
                });
            })
            ->when($categoria, function ($q) use ($categoria) {
                $q->where('id_tipo', $categoria);
            })
            ->orderBy('id_producto', 'desc')
            ->paginate(12);
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
            'id_producto'        => self::crearIdProducto(),
            'pro_descripcion'    => $data['pro_descripcion'],
            'id_tipo'            => $data['tipo_Producto'],
            'pro_um_compra'      => $data['unidad_medida_compra'],
            'pro_um_venta'       => $data['unidad_medida_venta'],
            'pro_saldo_inicial'  => $data['saldo_inicial'],
            'pro_valor_compra'   => $data['pro_valor_compra'],
            'pro_precio_venta'   => $data['pro_precio_venta'],
            'img'                => $nombreImagen,
            'estado_prod'        => 'ACT',
        ]);
    }


    public static function updateProducto(string $id, array $data, ?UploadedFile $imagen = null){
        $producto = self::findOrFail($id);

        $updateData = [
            'pro_descripcion'   => $data['pro_descripcion'],
            'id_tipo'           => $data['tipo_Producto'],
            'pro_um_venta'      => $data['unidad_medida_venta'],
            'pro_um_compra'     => $data['unidad_medida_compra'],
            'pro_saldo_inicial' => $data['saldo_inicial'],
            'pro_valor_compra'  => $data['pro_valor_compra'],
            'pro_precio_venta'  => $data['pro_precio_venta'],
        ];

        if ($imagen && $imagen->isValid()) {
            // Eliminar imagen anterior si existe
            if ($producto->img) {
                Storage::delete('public/products/' . $producto->img);
            }

            $nombreImagen = $imagen->getClientOriginalName();
            $imagen->move(
                storage_path('app/public/products'),
                $nombreImagen
            );
            $updateData['img'] = $nombreImagen;
        }

        $producto->update($updateData);
    }



    public function destroyProducto(){
        $this->estado_prod = 'INA';
        $this->save();
    }

    public static function crearIdProducto(){
        $ultimoProducto=self::orderBy('id_producto', 'desc')->first();

        if(!$ultimoProducto){
            return 'P001';

        }

        $numero = intval(substr($ultimoProducto->id_producto, 1));

        $nuevoNumero = $numero + 1;

        return 'P' . str_pad($nuevoNumero, 3, '0', STR_PAD_LEFT);
    }

    public static function getRelatedProducts($id_tipo, $id_producto, $limit = 10)
    {
        return self::where('id_tipo', $id_tipo)
            ->where('id_producto', '!=', $id_producto)
            ->where('estado_prod', 'ACT')
            ->limit($limit)
            ->get();
    }

    public static function getProductoById($id_producto)
    {
        return self::where('id_producto', $id_producto)
            ->where('estado_prod', 'ACT')
            ->first();
    }

}
