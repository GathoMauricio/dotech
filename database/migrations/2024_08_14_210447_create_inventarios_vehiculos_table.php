<?php

use Illuminate\Database\Migrations\Migration;
use Illuminate\Database\Schema\Blueprint;
use Illuminate\Support\Facades\Schema;

class CreateInventariosVehiculosTable extends Migration
{
    /**
     * Run the migrations.
     *
     * @return void
     */
    public function up()
    {
        Schema::create('inventarios_vehiculos', function (Blueprint $table) {
            $table->id();
            $table->bigInteger('vehiculo_id');
            $table->bigInteger('autor_id');
            //Sección Llantas (10)
            $table->text('llantas_delanteras_derecha_marca');
            $table->text('llantas_delanteras_derecha_referencia');
            $table->text('llantas_delanteras_izquierda_marca');
            $table->text('llantas_delanteras_izquierda_referencia');
            $table->text('llantas_traseras_derecha_marca');
            $table->text('llantas_traseras_derecha_referencia');
            $table->text('llantas_traseras_izquierda_marca');
            $table->text('llantas_traseras_izquierda_referencia');
            $table->text('llantas_refaccion_marca');
            $table->text('llantas_refaccion_referencia');
            //Sección Mecánico (15)
            $table->string('mecanico_motor_cant', 10);
            $table->string('mecanico_motor_estado', 10);
            $table->string('mecanico_check_engine_cant', 10);
            $table->string('mecanico_check_engine_estado', 10);
            $table->string('mecanico_transmision_cant', 10);
            $table->string('mecanico_transmision_estado', 10);
            $table->string('mecanico_direccion_cant', 10);
            $table->string('mecanico_direccion_estado', 10);
            $table->string('mecanico_frenos_cant', 10);
            $table->string('mecanico_frenos_estado', 10);
            $table->string('mecanico_clutch_cant', 10);
            $table->string('mecanico_clutch_estado', 10);
            $table->string('mecanico_amortiguadores_cant', 10);
            $table->string('mecanico_amortiguadores_estado', 10);
            $table->string('mecanico_suspension_cant', 10);
            $table->string('mecanico_suspension_estado', 10);
            $table->string('mecanico_sistema_escape_cant', 10);
            $table->string('mecanico_sistema_escape_estado', 10);
            $table->string('mecanico_alineacion_cant', 10);
            $table->string('mecanico_alineacion_estado', 10);
            $table->string('mecanico_bateria_cant', 10);
            $table->string('mecanico_bateria_estado', 10);
            $table->string('mecanico_tapa_radiador_cant', 10);
            $table->string('mecanico_tapa_radiaador_estado', 10);
            $table->string('mecanico_tapa_aceite_cant', 10);
            $table->string('mecanico_tapa_aceite_estado', 10);
            $table->string('mecanico_varilla_medidora_aceite_cant', 10);
            $table->string('mecanico_varilla_medidora_aceite_estado', 10);
            $table->string('mecanico_bandas_cant', 10);
            $table->string('mecanico_bandas_estado', 10);
            //Seccion Eléctrico (17)
            $table->string('electrico_direccionales_cant', 10);
            $table->string('electrico_direccionales_estado', 10);
            $table->string('electrico_intermitentes_cant', 10);
            $table->string('electrico_intermitentes_estado', 10);
            $table->string('electrico_faros_niebla_cant', 10);
            $table->string('electrico_faros_niebla_estado', 10);
            $table->string('electrico_luces_bajas_cant', 10);
            $table->string('electrico_luces_bajas_estado', 10);
            $table->string('electrico_luces_altas_cant', 10);
            $table->string('electrico_luces_altas_estado', 10);
            $table->string('electrico_reversa_cant', 10);
            $table->string('electrico_reversa_estado', 10);
            $table->string('electrico_luces_stop_cant', 10);
            $table->string('electrico_luces_stop_estado', 10);
            $table->string('electrico_limpiadores_cant', 10);
            $table->string('electrico_limpiadores_estado', 10);
            $table->string('electrico_antena_cant', 10);
            $table->string('electrico_antena_estado', 10);
            $table->string('electrico_claxon_cant', 10);
            $table->string('electrico_claxon_estado', 10);
            $table->string('electrico_alarma_reversa_cant', 10);
            $table->string('electrico_alarma_reversa_estado', 10);
            $table->string('electrico_torreta_cant', 10);
            $table->string('electrico_torreta_estado', 10);
            $table->string('electrico_tablero_instrumentos_cant', 10);
            $table->string('electrico_tablero_instrumentos_estado', 10);
            $table->string('electrico_medidor_gasolina_cant', 10);
            $table->string('electrico_medidor_gasolina_estado', 10);
            $table->string('electrico_medidor_temperatura_cant', 10);
            $table->string('electrico_medidor_temperatura_estado', 10);
            $table->string('electrico_medidor_aceite_cant', 10);
            $table->string('electrico_medidor_aceite_estado', 10);
            $table->string('electrico_calefaccion_clima_cant', 10);
            $table->string('electrico_calefaccion_clima_estado', 10);
            //Sección Chasis / Cuerpo auto (16)
            $table->string('chasis_faros_cant', 10);
            $table->string('chasis_faros_estado', 10);
            $table->string('chasis_calaveras_cant', 10);
            $table->string('chasis_calaveras_estado', 10);
            $table->string('chasis_rines_cant', 10);
            $table->string('chasis_rines_estado', 10);
            $table->string('chasis_tapones_rines_cant', 10);
            $table->string('chasis_tapones_rines_estado', 10);
            $table->string('chasis_hojalateria_cant', 10);
            $table->string('chasis_hojalateria_estado', 10);
            $table->string('chasis_pintura_cant', 10);
            $table->string('chasis_pintura_estado', 10);
            $table->string('chasis_salpicaderas_cant', 10);
            $table->string('chasis_salpicaderas_estado', 10);
            $table->string('chasis_puertas_cant', 10);
            $table->string('chasis_puertas_estado', 10);
            $table->string('chasis_cofre_cant', 10);
            $table->string('chasis_cofre_estado', 10);
            $table->string('chasis_cajuela_cant', 10);
            $table->string('chasis_cajuela_estado', 10);
            $table->string('chasis_toldo_cant', 10);
            $table->string('chasis_toldo_estado', 10);
            $table->string('chasis_defensas_cant', 10);
            $table->string('chasis_defensas_estado', 10);
            $table->string('chasis_molduras_cant', 10);
            $table->string('chasis_molduras_estado', 10);
            $table->string('chasis_tumbaburros_cant', 10);
            $table->string('chasis_tumbaburros_estado', 10);
            $table->string('chasis_estribos_cant', 10);
            $table->string('chasis_estribos_estado', 10);
            $table->string('chasis_tapon_gasolina_cant', 10);
            $table->string('chasis_tapon_gasolina_estado', 10);
            //Sección Vidrios (5)
            $table->string('vidrios_medallon_cant', 10);
            $table->string('vidrios_medallon_estado', 10);
            $table->string('vidrios_cristales_cant', 10);
            $table->string('vidrios_cristales_estado', 10);
            $table->string('vidrios_parabrisas_cant', 10);
            $table->string('vidrios_parabrisas_estado', 10);
            $table->string('vidrios_espejo_retrovisor_cant', 10);
            $table->string('vidrios_espejo_retrovisor_estado', 10);
            $table->string('vidrios_espejos_laterales_cant', 10);
            $table->string('vidrios_espejos_laterales_estado', 10);
            //Sección Interiores (13)
            $table->string('interiores_vestidura_cant', 10);
            $table->string('interiores_vestidura_estado', 10);
            $table->string('interiores_tapoceria_cant', 10);
            $table->string('interiores_tapiceria_estado', 10);
            $table->string('interiores_asientos_cant', 10);
            $table->string('interiores_asientos_estado', 10);
            $table->string('interiores_apoya_cabezas_cant', 10);
            $table->string('interiores_apoya_cabezas_estado', 10);
            $table->string('interiores_coderas_laterales_cant', 10);
            $table->string('interiores_coderas_laterales_estado', 10);
            $table->string('interiores_viceras_cant', 10);
            $table->string('interiores_viceras_estado', 10);
            $table->string('interiores_guantera_cant', 10);
            $table->string('interiores_guantera_estado', 10);
            $table->string('interiores_radio_cant', 10);
            $table->string('interiores_radio_estado', 10);
            $table->string('interiores_reloj_cant', 10);
            $table->string('interiores_reloj_estado', 10);
            $table->string('interiores_encendedor_cant', 10);
            $table->string('interiores_encendedor_estado', 10);
            $table->string('interiores_cenicero_cant', 10);
            $table->string('interiores_cenicero_estado', 10);
            $table->string('interiores_tapetes_cant', 10);
            $table->string('interiores_tapetes_estado', 10);
            $table->string('interiores_luz_interior_cant', 10);
            $table->string('interiores_luz_interior_estado', 10);
            //Sección Seguridad (9)
            $table->string('seguridad_cinturon_seguridad_cant', 10);
            $table->string('seguridad_cinturon_seguridad_estado', 10);
            $table->string('seguridad_caja_herramienta_cant', 10);
            $table->string('seguridad_caja_herramienta_estado', 10);
            $table->string('seguridad_gato_cant', 10);
            $table->string('seguridad_gato_estado', 10);
            $table->string('seguridad_llave_cruz_cant', 10);
            $table->string('seguridad_llave_cruz_estado', 10);
            $table->string('seguridad_triangulo_seguridad_cant', 10);
            $table->string('seguridad_triangulo_seguridad_estado', 10);
            $table->string('seguridad_cable_pasacorriente_cant', 10);
            $table->string('seguridad_cable_pasacorriente_estado', 10);
            $table->string('seguridad_extinguidor_cant', 10);
            $table->string('seguridad_extinguidor_estado', 10);
            $table->string('seguridad_botiquin_cant', 10);
            $table->string('seguridad_botiquin_estado', 10);
            $table->string('seguridad_linterna_cant', 10);
            $table->string('seguridad_linterna_estado', 10);
            //Sección Documentación (4)
            $table->string('documentacion_tarjeta_circulacion_cant', 10);
            $table->string('documentacion_tarjeta_circulacion_estado', 10);
            $table->string('documentacion_poliza_seguro_cant', 10);
            $table->string('documentacion_poliza_Seguro_estado', 10);
            $table->string('documentacion_manual_cant', 10);
            $table->string('documentacion_manual_estado', 10);
            $table->string('documentacion_verificacion_cant', 10);
            $table->string('documentacion_verificacion_estado', 10);
            //Otros
            $table->text('observaciones')->nullable();
            $table->text('ruidos')->nullable();
            $table->text('fugas')->nullable();

            $table->timestamps();
        });
    }

    /**
     * Reverse the migrations.
     *
     * @return void
     */
    public function down()
    {
        Schema::dropIfExists('inventarios_vehiculos', 10);
    }
}
