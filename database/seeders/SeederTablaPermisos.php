<?php

namespace Database\Seeders;

use Illuminate\Database\Seeder;

//agregamos el modelo de permisos de spatie
use Spatie\Permission\Models\Permission;

class SeederTablaPermisos extends Seeder
{
    /**
     * Run the database seeds.
     *
     * @return void
     */
    public function run()
    {
        $permisos = [
            //Operaciones sobre tabla roles
            'ver-rol',
            'crear-rol',
            'editar-rol',
            'borrar-rol',

            //Operacions sobre tabla blogs
            'ver-usuario',
            'crear-usuario',
            'editar-usuario',
            'borrar-usuario',

             //Operacions sobre tabla blogs
             'ver-inventario',
             'crear-inventario',
             'editar-inventario',
             'borrar-inventario',

             'ver-clientes',
             'crear-clientes',
             'editar-clientes',
             'borrar-clientes',

             'ver-productos',
             'crear-productos',
             'editar-productos',
             'borrar-productos',

             'ver-pedidos',
             'crear-pedidos',
             'editar-pedidos',
             'borrar-pedidos',

             'ver-ordenes',
             'crear-ordenes',
             'editar-ordenes',
             'borrar-ordenes',

             'ver-facturacion',
             'crear-facturacion',
             'editar-facturacion',
             'borrar-facturacion',

             'ver-diseño',
             'ver-impresion',
             'ver-acabado',
             'ver-especial',


        ];

        foreach($permisos as $permiso) {
            Permission::create(['name'=>$permiso]);
        }
    }
}
