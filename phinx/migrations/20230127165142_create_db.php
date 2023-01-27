<?php

use Phinx\Db\Adapter\MysqlAdapter;
use Phinx\Migration\AbstractMigration;


class CreateDb extends Phinx\Migration\AbstractMigration
{
    public function change()
    {
        $this->table('color', [
                'id' => false,
                'primary_key' => ['codColor'],
                'engine' => 'InnoDB',
                'encoding' => 'utf8mb4',
                'collation' => 'utf8mb4_general_ci',
                'comment' => '',
                'row_format' => 'DYNAMIC',
            ])
            ->addColumn('codColor', 'integer', [
                'null' => false,
                'limit' => MysqlAdapter::INT_REGULAR,
                'identity' => 'enable',
            ])
            ->addColumn('nombre', 'string', [
                'null' => false,
                'limit' => 100,
                'collation' => 'utf8mb4_general_ci',
                'encoding' => 'utf8mb4',
                'after' => 'codColor',
            ])
            ->addColumn('rgb', 'string', [
                'null' => false,
                'limit' => 40,
                'collation' => 'utf8mb4_general_ci',
                'encoding' => 'utf8mb4',
                'after' => 'nombre',
            ])
            ->create();
        $this->table('cuenta', [
                'id' => false,
                'primary_key' => ['codCuenta'],
                'engine' => 'InnoDB',
                'encoding' => 'utf8mb4',
                'collation' => 'utf8mb4_general_ci',
                'comment' => '',
                'row_format' => 'DYNAMIC',
            ])
            ->addColumn('codCuenta', 'integer', [
                'null' => false,
                'limit' => MysqlAdapter::INT_REGULAR,
                'identity' => 'enable',
            ])
            ->addColumn('usuario', 'string', [
                'null' => false,
                'limit' => 200,
                'collation' => 'utf8mb4_general_ci',
                'encoding' => 'utf8mb4',
                'after' => 'codCuenta',
            ])
            ->addColumn('password', 'string', [
                'null' => false,
                'limit' => 500,
                'collation' => 'utf8mb4_general_ci',
                'encoding' => 'utf8mb4',
                'after' => 'usuario',
            ])
            ->addColumn('fechaHoraCreacion', 'datetime', [
                'null' => false,
                'after' => 'password',
            ])
            ->addColumn('codTipoCuenta', 'integer', [
                'null' => false,
                'limit' => MysqlAdapter::INT_REGULAR,
                'after' => 'fechaHoraCreacion',
            ])
            ->create();
        $this->table('edicion', [
                'id' => false,
                'primary_key' => ['codEdicion'],
                'engine' => 'InnoDB',
                'encoding' => 'utf8mb4',
                'collation' => 'utf8mb4_general_ci',
                'comment' => '',
                'row_format' => 'DYNAMIC',
            ])
            ->addColumn('codEdicion', 'integer', [
                'null' => false,
                'limit' => MysqlAdapter::INT_REGULAR,
                'identity' => 'enable',
            ])
            ->addColumn('nombre', 'string', [
                'null' => false,
                'limit' => 200,
                'collation' => 'utf8mb4_general_ci',
                'encoding' => 'utf8mb4',
                'after' => 'codEdicion',
            ])
            ->addColumn('alquiler2trenes', 'integer', [
                'null' => false,
                'limit' => MysqlAdapter::INT_REGULAR,
                'after' => 'nombre',
            ])
            ->addColumn('alquiler3trenes', 'integer', [
                'null' => false,
                'limit' => MysqlAdapter::INT_REGULAR,
                'after' => 'alquiler2trenes',
            ])
            ->addColumn('alquiler4trenes', 'integer', [
                'null' => false,
                'limit' => MysqlAdapter::INT_REGULAR,
                'after' => 'alquiler3trenes',
            ])
            ->create();
        $this->table('estado_partida', [
                'id' => false,
                'primary_key' => ['codEstadoPartida'],
                'engine' => 'InnoDB',
                'encoding' => 'utf8mb4',
                'collation' => 'utf8mb4_general_ci',
                'comment' => '',
                'row_format' => 'DYNAMIC',
            ])
            ->addColumn('codEstadoPartida', 'integer', [
                'null' => false,
                'limit' => MysqlAdapter::INT_REGULAR,
                'identity' => 'enable',
            ])
            ->addColumn('nombre', 'string', [
                'null' => false,
                'limit' => 500,
                'collation' => 'utf8mb4_general_ci',
                'encoding' => 'utf8mb4',
                'after' => 'codEstadoPartida',
            ])
            ->create();
        $this->table('jugador', [
                'id' => false,
                'primary_key' => ['codJugador'],
                'engine' => 'InnoDB',
                'encoding' => 'utf8mb4',
                'collation' => 'utf8mb4_general_ci',
                'comment' => '',
                'row_format' => 'DYNAMIC',
            ])
            ->addColumn('codJugador', 'integer', [
                'null' => false,
                'limit' => MysqlAdapter::INT_REGULAR,
                'identity' => 'enable',
            ])
            ->addColumn('codPartida', 'integer', [
                'null' => false,
                'limit' => MysqlAdapter::INT_REGULAR,
                'after' => 'codJugador',
            ])
            ->addColumn('montoActual', 'integer', [
                'null' => false,
                'limit' => MysqlAdapter::INT_REGULAR,
                'after' => 'codPartida',
            ])
            ->addColumn('codCuenta', 'integer', [
                'null' => false,
                'limit' => MysqlAdapter::INT_REGULAR,
                'after' => 'montoActual',
            ])
            ->addColumn('esBanco', 'integer', [
                'null' => false,
                'limit' => MysqlAdapter::INT_TINY,
                'after' => 'codCuenta',
            ])
            ->addColumn('tiempoActualizacion', 'float', [
                'null' => false,
                'after' => 'esBanco',
            ])
            ->create();
        $this->table('lenguaje_amor', [
                'id' => false,
                'primary_key' => ['codLenguaje'],
                'engine' => 'InnoDB',
                'encoding' => 'utf8mb4',
                'collation' => 'utf8mb4_general_ci',
                'comment' => '',
                'row_format' => 'DYNAMIC',
            ])
            ->addColumn('codLenguaje', 'integer', [
                'null' => false,
                'limit' => MysqlAdapter::INT_REGULAR,
                'identity' => 'enable',
            ])
            ->addColumn('nombre', 'string', [
                'null' => false,
                'limit' => 100,
                'collation' => 'utf8mb4_general_ci',
                'encoding' => 'utf8mb4',
                'after' => 'codLenguaje',
            ])
            ->addColumn('descripcion', 'string', [
                'null' => false,
                'limit' => 1000,
                'collation' => 'utf8mb4_general_ci',
                'encoding' => 'utf8mb4',
                'after' => 'nombre',
            ])
            ->create();
        $this->table('link', [
                'id' => false,
                'primary_key' => ['codLink'],
                'engine' => 'InnoDB',
                'encoding' => 'utf8mb4',
                'collation' => 'utf8mb4_general_ci',
                'comment' => '',
                'row_format' => 'DYNAMIC',
            ])
            ->addColumn('codLink', 'integer', [
                'null' => false,
                'limit' => MysqlAdapter::INT_REGULAR,
                'identity' => 'enable',
            ])
            ->addColumn('stringCodigoQR', 'string', [
                'null' => false,
                'limit' => 500,
                'collation' => 'utf8mb4_general_ci',
                'encoding' => 'utf8mb4',
                'after' => 'codLink',
            ])
            ->addColumn('fechaDesbloqueo', 'date', [
                'null' => false,
                'after' => 'stringCodigoQR',
            ])
            ->addColumn('descripcion', 'string', [
                'null' => false,
                'limit' => 2000,
                'collation' => 'utf8mb4_general_ci',
                'encoding' => 'utf8mb4',
                'after' => 'fechaDesbloqueo',
            ])
            ->addColumn('nombreImagen', 'string', [
                'null' => false,
                'limit' => 500,
                'collation' => 'utf8mb4_general_ci',
                'encoding' => 'utf8mb4',
                'after' => 'descripcion',
            ])
            ->addColumn('tamañoImagen', 'integer', [
                'null' => false,
                'limit' => MysqlAdapter::INT_REGULAR,
                'after' => 'nombreImagen',
            ])
            ->addColumn('alineamiento', 'string', [
                'null' => false,
                'limit' => 20,
                'collation' => 'utf8mb4_general_ci',
                'encoding' => 'utf8mb4',
                'after' => 'tamañoImagen',
            ])
            ->create();
        $this->table('partida', [
                'id' => false,
                'primary_key' => ['codPartida'],
                'engine' => 'InnoDB',
                'encoding' => 'utf8mb4',
                'collation' => 'utf8mb4_general_ci',
                'comment' => '',
                'row_format' => 'DYNAMIC',
            ])
            ->addColumn('codPartida', 'integer', [
                'null' => false,
                'limit' => MysqlAdapter::INT_REGULAR,
                'identity' => 'enable',
            ])
            ->addColumn('fechaHoraInicio', 'datetime', [
                'null' => true,
                'after' => 'codPartida',
            ])
            ->addColumn('fechaHoraFinalizacion', 'datetime', [
                'null' => true,
                'after' => 'fechaHoraInicio',
            ])
            ->addColumn('codCuentaHost', 'integer', [
                'null' => false,
                'limit' => MysqlAdapter::INT_REGULAR,
                'after' => 'fechaHoraFinalizacion',
            ])
            ->addColumn('codJugadorBanco', 'integer', [
                'null' => true,
                'limit' => MysqlAdapter::INT_REGULAR,
                'after' => 'codCuentaHost',
            ])
            ->addColumn('codJugadorBancario', 'integer', [
                'null' => true,
                'limit' => MysqlAdapter::INT_REGULAR,
                'after' => 'codJugadorBanco',
            ])
            ->addColumn('codEstadoPartida', 'integer', [
                'null' => false,
                'limit' => MysqlAdapter::INT_REGULAR,
                'after' => 'codJugadorBancario',
            ])
            ->addColumn('codEdicion', 'integer', [
                'null' => false,
                'limit' => MysqlAdapter::INT_REGULAR,
                'after' => 'codEstadoPartida',
            ])
            ->addColumn('tokenSincronizacion', 'string', [
                'null' => false,
                'limit' => 12,
                'collation' => 'utf8mb4_general_ci',
                'encoding' => 'utf8mb4',
                'after' => 'codEdicion',
            ])
            ->addColumn('descripcion', 'string', [
                'null' => true,
                'limit' => 200,
                'collation' => 'utf8mb4_general_ci',
                'encoding' => 'utf8mb4',
                'after' => 'tokenSincronizacion',
            ])
            ->addColumn('dineroInicial', 'float', [
                'null' => true,
                'after' => 'descripcion',
            ])
            ->addColumn('sePuedenUnirDespues', 'integer', [
                'null' => false,
                'limit' => MysqlAdapter::INT_TINY,
                'after' => 'dineroInicial',
            ])
            ->addColumn('pozo', 'integer', [
                'null' => false,
                'default' => '0',
                'limit' => MysqlAdapter::INT_REGULAR,
                'after' => 'sePuedenUnirDespues',
            ])
            ->addColumn('pagoSalida', 'integer', [
                'null' => false,
                'limit' => MysqlAdapter::INT_REGULAR,
                'after' => 'pozo',
            ])
            ->create();
        $this->table('persona', [
                'id' => false,
                'primary_key' => ['codPersona'],
                'engine' => 'InnoDB',
                'encoding' => 'utf8mb4',
                'collation' => 'utf8mb4_general_ci',
                'comment' => '',
                'row_format' => 'DYNAMIC',
            ])
            ->addColumn('codPersona', 'integer', [
                'null' => false,
                'limit' => MysqlAdapter::INT_REGULAR,
                'identity' => 'enable',
            ])
            ->addColumn('codigo', 'string', [
                'null' => false,
                'limit' => 10,
                'collation' => 'utf8mb4_general_ci',
                'encoding' => 'utf8mb4',
                'after' => 'codPersona',
            ])
            ->addColumn('nickname', 'string', [
                'null' => false,
                'limit' => 100,
                'collation' => 'utf8mb4_general_ci',
                'encoding' => 'utf8mb4',
                'after' => 'codigo',
            ])
            ->addColumn('password', 'string', [
                'null' => false,
                'limit' => 300,
                'collation' => 'utf8mb4_general_ci',
                'encoding' => 'utf8mb4',
                'after' => 'nickname',
            ])
            ->create();
        $this->table('propiedad', [
                'id' => false,
                'primary_key' => ['codPropiedad'],
                'engine' => 'InnoDB',
                'encoding' => 'utf8mb4',
                'collation' => 'utf8mb4_general_ci',
                'comment' => '',
                'row_format' => 'DYNAMIC',
            ])
            ->addColumn('codPropiedad', 'integer', [
                'null' => false,
                'limit' => MysqlAdapter::INT_REGULAR,
                'identity' => 'enable',
            ])
            ->addColumn('nombre', 'string', [
                'null' => false,
                'limit' => 200,
                'collation' => 'utf8mb4_general_ci',
                'encoding' => 'utf8mb4',
                'after' => 'codPropiedad',
            ])
            ->addColumn('lado', 'integer', [
                'null' => false,
                'limit' => MysqlAdapter::INT_TINY,
                'after' => 'nombre',
            ])
            ->addColumn('precioCompra', 'integer', [
                'null' => false,
                'limit' => MysqlAdapter::INT_REGULAR,
                'after' => 'lado',
            ])
            ->addColumn('codEdicion', 'integer', [
                'null' => false,
                'limit' => MysqlAdapter::INT_REGULAR,
                'after' => 'precioCompra',
            ])
            ->addColumn('codColor', 'integer', [
                'null' => false,
                'limit' => MysqlAdapter::INT_REGULAR,
                'after' => 'codEdicion',
            ])
            ->addColumn('codTipoPropiedad', 'integer', [
                'null' => false,
                'limit' => MysqlAdapter::INT_REGULAR,
                'after' => 'codColor',
            ])
            ->addColumn('alquiler_normal', 'integer', [
                'null' => true,
                'limit' => MysqlAdapter::INT_REGULAR,
                'after' => 'codTipoPropiedad',
            ])
            ->addColumn('alquiler_1casas', 'integer', [
                'null' => true,
                'limit' => MysqlAdapter::INT_REGULAR,
                'after' => 'alquiler_normal',
            ])
            ->addColumn('alquiler_2casas', 'integer', [
                'null' => true,
                'limit' => MysqlAdapter::INT_REGULAR,
                'after' => 'alquiler_1casas',
            ])
            ->addColumn('alquiler_3casas', 'integer', [
                'null' => true,
                'limit' => MysqlAdapter::INT_REGULAR,
                'after' => 'alquiler_2casas',
            ])
            ->addColumn('alquiler_4casas', 'integer', [
                'null' => true,
                'limit' => MysqlAdapter::INT_REGULAR,
                'after' => 'alquiler_3casas',
            ])
            ->addColumn('alquiler_hotel', 'integer', [
                'null' => true,
                'limit' => MysqlAdapter::INT_REGULAR,
                'after' => 'alquiler_4casas',
            ])
            ->addColumn('valorHipotecable', 'integer', [
                'null' => true,
                'limit' => MysqlAdapter::INT_REGULAR,
                'after' => 'alquiler_hotel',
            ])
            ->addColumn('costo_casa', 'integer', [
                'null' => true,
                'limit' => MysqlAdapter::INT_REGULAR,
                'after' => 'valorHipotecable',
            ])
            ->addColumn('costo_hotel', 'integer', [
                'null' => true,
                'limit' => MysqlAdapter::INT_REGULAR,
                'after' => 'costo_casa',
            ])
            ->create();
        $this->table('propiedad_partida', [
                'id' => false,
                'primary_key' => ['codPropiedadPartida'],
                'engine' => 'InnoDB',
                'encoding' => 'utf8mb4',
                'collation' => 'utf8mb4_general_ci',
                'comment' => '',
                'row_format' => 'DYNAMIC',
            ])
            ->addColumn('codPropiedadPartida', 'integer', [
                'null' => false,
                'limit' => MysqlAdapter::INT_REGULAR,
                'identity' => 'enable',
            ])
            ->addColumn('codJugadorDueño', 'integer', [
                'null' => false,
                'limit' => MysqlAdapter::INT_REGULAR,
                'after' => 'codPropiedadPartida',
            ])
            ->addColumn('codPropiedad', 'integer', [
                'null' => false,
                'limit' => MysqlAdapter::INT_REGULAR,
                'after' => 'codJugadorDueño',
            ])
            ->addColumn('codPartida', 'integer', [
                'null' => false,
                'limit' => MysqlAdapter::INT_REGULAR,
                'after' => 'codPropiedad',
            ])
            ->create();
        $this->table('proy-orden', [
                'id' => false,
                'primary_key' => ['codOrden'],
                'engine' => 'InnoDB',
                'encoding' => 'utf8mb4',
                'collation' => 'utf8mb4_general_ci',
                'comment' => '',
                'row_format' => 'DYNAMIC',
            ])
            ->addColumn('codOrden', 'integer', [
                'null' => false,
                'limit' => MysqlAdapter::INT_REGULAR,
                'identity' => 'enable',
            ])
            ->addColumn('valores', 'string', [
                'null' => false,
                'limit' => 1000,
                'collation' => 'utf8mb4_general_ci',
                'encoding' => 'utf8mb4',
                'after' => 'codOrden',
            ])
            ->addColumn('fechaHoraCreacion', 'datetime', [
                'null' => false,
                'after' => 'valores',
            ])
            ->addColumn('codTipoOrden', 'integer', [
                'null' => false,
                'limit' => MysqlAdapter::INT_REGULAR,
                'after' => 'fechaHoraCreacion',
            ])
            ->addColumn('codProyeccion', 'integer', [
                'null' => false,
                'limit' => MysqlAdapter::INT_REGULAR,
                'after' => 'codTipoOrden',
            ])
            ->addColumn('pendiente', 'integer', [
                'null' => false,
                'limit' => MysqlAdapter::INT_TINY,
                'after' => 'codProyeccion',
            ])
            ->create();
        $this->table('proy-proyeccion', [
                'id' => false,
                'primary_key' => ['codProyeccion'],
                'engine' => 'InnoDB',
                'encoding' => 'utf8mb4',
                'collation' => 'utf8mb4_general_ci',
                'comment' => '',
                'row_format' => 'DYNAMIC',
            ])
            ->addColumn('codProyeccion', 'integer', [
                'null' => false,
                'limit' => MysqlAdapter::INT_REGULAR,
                'identity' => 'enable',
            ])
            ->addColumn('nombre', 'string', [
                'null' => false,
                'limit' => 100,
                'collation' => 'utf8mb4_general_ci',
                'encoding' => 'utf8mb4',
                'after' => 'codProyeccion',
            ])
            ->addColumn('fechaHoraCreacion', 'datetime', [
                'null' => false,
                'after' => 'nombre',
            ])
            ->addColumn('fechaHoraProyeccion', 'datetime', [
                'null' => false,
                'after' => 'fechaHoraCreacion',
            ])
            ->addColumn('codigo', 'string', [
                'null' => false,
                'limit' => 100,
                'collation' => 'utf8mb4_general_ci',
                'encoding' => 'utf8mb4',
                'after' => 'fechaHoraProyeccion',
            ])
            ->addColumn('tokenActualizacion', 'string', [
                'null' => false,
                'limit' => 100,
                'collation' => 'utf8mb4_general_ci',
                'encoding' => 'utf8mb4',
                'after' => 'codigo',
            ])
            ->addColumn('tiempoActualizacion', 'float', [
                'null' => false,
                'after' => 'tokenActualizacion',
            ])
            ->create();
        $this->table('proy-tipo_orden', [
                'id' => false,
                'primary_key' => ['codTipoOrden'],
                'engine' => 'InnoDB',
                'encoding' => 'utf8mb4',
                'collation' => 'utf8mb4_general_ci',
                'comment' => '',
                'row_format' => 'DYNAMIC',
            ])
            ->addColumn('codTipoOrden', 'integer', [
                'null' => false,
                'limit' => MysqlAdapter::INT_REGULAR,
                'identity' => 'enable',
            ])
            ->addColumn('nombre', 'string', [
                'null' => false,
                'limit' => 100,
                'collation' => 'utf8mb4_general_ci',
                'encoding' => 'utf8mb4',
                'after' => 'codTipoOrden',
            ])
            ->create();
        $this->table('puntuacion_lenguaje', [
                'id' => false,
                'primary_key' => ['codPuntuacionLenguaje'],
                'engine' => 'InnoDB',
                'encoding' => 'utf8mb4',
                'collation' => 'utf8mb4_general_ci',
                'comment' => '',
                'row_format' => 'DYNAMIC',
            ])
            ->addColumn('codPuntuacionLenguaje', 'integer', [
                'null' => false,
                'limit' => MysqlAdapter::INT_REGULAR,
                'identity' => 'enable',
            ])
            ->addColumn('codPersona', 'integer', [
                'null' => false,
                'limit' => MysqlAdapter::INT_REGULAR,
                'after' => 'codPuntuacionLenguaje',
            ])
            ->addColumn('codLenguaje', 'integer', [
                'null' => false,
                'limit' => MysqlAdapter::INT_REGULAR,
                'after' => 'codPersona',
            ])
            ->addColumn('puntajeDar', 'integer', [
                'null' => false,
                'limit' => MysqlAdapter::INT_REGULAR,
                'after' => 'codLenguaje',
            ])
            ->addColumn('puntajeRecibir', 'integer', [
                'null' => false,
                'limit' => MysqlAdapter::INT_REGULAR,
                'after' => 'puntajeDar',
            ])
            ->create();
        $this->table('tipo_cuenta', [
                'id' => false,
                'primary_key' => ['codTipoCuenta'],
                'engine' => 'InnoDB',
                'encoding' => 'utf8mb4',
                'collation' => 'utf8mb4_general_ci',
                'comment' => '',
                'row_format' => 'DYNAMIC',
            ])
            ->addColumn('codTipoCuenta', 'integer', [
                'null' => false,
                'limit' => MysqlAdapter::INT_REGULAR,
                'identity' => 'enable',
            ])
            ->addColumn('nombre', 'string', [
                'null' => false,
                'limit' => 300,
                'collation' => 'utf8mb4_general_ci',
                'encoding' => 'utf8mb4',
                'after' => 'codTipoCuenta',
            ])
            ->create();
        $this->table('tipo_propiedad', [
                'id' => false,
                'primary_key' => ['codTipoPropiedad'],
                'engine' => 'InnoDB',
                'encoding' => 'utf8mb4',
                'collation' => 'utf8mb4_general_ci',
                'comment' => '',
                'row_format' => 'DYNAMIC',
            ])
            ->addColumn('codTipoPropiedad', 'integer', [
                'null' => false,
                'limit' => MysqlAdapter::INT_REGULAR,
                'identity' => 'enable',
            ])
            ->addColumn('nombre', 'string', [
                'null' => false,
                'limit' => 100,
                'collation' => 'utf8mb4_general_ci',
                'encoding' => 'utf8mb4',
                'after' => 'codTipoPropiedad',
            ])
            ->addColumn('claseIcono', 'string', [
                'null' => false,
                'limit' => 100,
                'collation' => 'utf8mb4_general_ci',
                'encoding' => 'utf8mb4',
                'after' => 'nombre',
            ])
            ->create();
        $this->table('tipo_transaccion_monetaria', [
                'id' => false,
                'primary_key' => ['codTipoTransaccion'],
                'engine' => 'InnoDB',
                'encoding' => 'utf8mb4',
                'collation' => 'utf8mb4_general_ci',
                'comment' => '',
                'row_format' => 'DYNAMIC',
            ])
            ->addColumn('codTipoTransaccion', 'integer', [
                'null' => false,
                'limit' => MysqlAdapter::INT_REGULAR,
                'identity' => 'enable',
            ])
            ->addColumn('conceptoEmisor', 'string', [
                'null' => false,
                'limit' => 500,
                'collation' => 'utf8mb4_general_ci',
                'encoding' => 'utf8mb4',
                'after' => 'codTipoTransaccion',
            ])
            ->addColumn('conceptoReceptor', 'string', [
                'null' => false,
                'limit' => 500,
                'collation' => 'utf8mb4_general_ci',
                'encoding' => 'utf8mb4',
                'after' => 'conceptoEmisor',
            ])
            ->addColumn('soloPuedeEnviarElBanco', 'integer', [
                'null' => false,
                'limit' => MysqlAdapter::INT_TINY,
                'after' => 'conceptoReceptor',
            ])
            ->addColumn('soloPuedeRecibirElBanco', 'integer', [
                'null' => false,
                'limit' => MysqlAdapter::INT_TINY,
                'after' => 'soloPuedeEnviarElBanco',
            ])
            ->create();
        $this->table('transaccion_monetaria', [
                'id' => false,
                'primary_key' => ['codTransaccionMonetaria'],
                'engine' => 'InnoDB',
                'encoding' => 'utf8mb4',
                'collation' => 'utf8mb4_general_ci',
                'comment' => '',
                'row_format' => 'DYNAMIC',
            ])
            ->addColumn('codTransaccionMonetaria', 'integer', [
                'null' => false,
                'limit' => MysqlAdapter::INT_REGULAR,
                'identity' => 'enable',
            ])
            ->addColumn('codJugadorSaliente', 'integer', [
                'null' => false,
                'limit' => MysqlAdapter::INT_REGULAR,
                'after' => 'codTransaccionMonetaria',
            ])
            ->addColumn('codPartida', 'integer', [
                'null' => false,
                'limit' => MysqlAdapter::INT_REGULAR,
                'after' => 'codJugadorSaliente',
            ])
            ->addColumn('codJugadorEntrante', 'integer', [
                'null' => false,
                'limit' => MysqlAdapter::INT_REGULAR,
                'after' => 'codPartida',
            ])
            ->addColumn('codTipoTransaccion', 'integer', [
                'null' => false,
                'limit' => MysqlAdapter::INT_REGULAR,
                'after' => 'codJugadorEntrante',
            ])
            ->addColumn('fechaHora', 'datetime', [
                'null' => false,
                'after' => 'codTipoTransaccion',
            ])
            ->addColumn('monto', 'float', [
                'null' => false,
                'after' => 'fechaHora',
            ])
            ->create();
        $this->table('transaccion_propiedad', [
                'id' => false,
                'primary_key' => ['codTransaccionPropiedad'],
                'engine' => 'InnoDB',
                'encoding' => 'utf8mb4',
                'collation' => 'utf8mb4_general_ci',
                'comment' => '',
                'row_format' => 'DYNAMIC',
            ])
            ->addColumn('codTransaccionPropiedad', 'integer', [
                'null' => false,
                'limit' => MysqlAdapter::INT_REGULAR,
                'identity' => 'enable',
            ])
            ->addColumn('fechaHora', 'datetime', [
                'null' => false,
                'after' => 'codTransaccionPropiedad',
            ])
            ->addColumn('codPropiedadPartida', 'integer', [
                'null' => false,
                'limit' => MysqlAdapter::INT_REGULAR,
                'after' => 'fechaHora',
            ])
            ->addColumn('codJugadorEmisor', 'integer', [
                'null' => false,
                'limit' => MysqlAdapter::INT_REGULAR,
                'after' => 'codPropiedadPartida',
            ])
            ->addColumn('codJugadorReceptor', 'integer', [
                'null' => false,
                'limit' => MysqlAdapter::INT_REGULAR,
                'after' => 'codJugadorEmisor',
            ])
            ->create();
    }
}
