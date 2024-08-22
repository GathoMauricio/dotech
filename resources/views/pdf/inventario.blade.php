<html>

<head>
    <style>
        @page {
            margin: 0cm 0cm;
            font-family: Arial;
        }

        body {
            margin: 0.5cm 0.5cm 0.5cm;
        }

        header {
            position: fixed;
            top: 0.5cm;
            left: 0.5cm;
            right: 0.5cm;
            height: 0.5cm;
            padding: -80px;
        }

        footer {
            position: fixed;
            bottom: 0cm;
            left: 0cm;
            right: 0cm;
            height: 2cm;
            background-color: #d30035;
            color: white;
            text-align: left;
            line-height: 15px;
            padding: 5px;
        }
    </style>
</head>

<body>
    <main>
        {{ formatDate($inventario->created_at) }}
        <center>
            <img src="{{ $logo }}" width="80" height="60">

            <h1 style="color:#d30035;font-weight:bold;text-align:center;padding:10px;">
                Inventario Vehículo
            </h1>
        </center>
        <p style="page-break-after: never;">

        <table width="100%" border="1">
            <tr>
                <td colspan="6">
                    <strong>DESCRIPCIÓN DEL VEHICULO</strong>
                </td>
            </tr>
            <tr>
                <td><strong>TIPO</strong></td>
                <td><strong>MARCA</strong></td>
                <td><strong>MODELO</strong></td>
                <td><strong>PLACAS</strong></td>
                <td><strong>COLOR</strong></td>
                <td><strong>KILOMETRAJE</strong></td>
            </tr>
            <tr>
                <td>{{ $inventario->vehiculo->type->type }}</td>
                <td>{{ $inventario->vehiculo->brand }}</td>
                <td>{{ $inventario->vehiculo->model }}</td>
                <td>{{ $inventario->vehiculo->enrollment }}</td>
                <td>{{ $inventario->vehiculo->color }}</td>
                <td>{{ $inventario->vehiculo->kilometers }}</td>
            </tr>
        </table>
        <br>
        <table width="100%" border="1">
            <tr>
                <td><strong>LLANTAS</strong></td>
                <td colspan="2"><strong>DELANTERAS</strong></td>
                <td colspan="2"><strong>TRASERAS</strong></td>
                <td><strong>REFACCIÓN</strong></td>
            </tr>
            <tr>
                <td></td>
                <td>DERECHA</td>
                <td>IZQUIERDA</td>
                <td>DERECHA</td>
                <td>IZQUIERDA</td>
                <td></td>
            </tr>
            <tr>
                <td><strong>MARCA</strong></td>
                <td>{{ $inventario->llantas_delanteras_derecha_marca }}</td>
                <td>{{ $inventario->llantas_delanteras_izquierda_marca }}</td>
                <td>{{ $inventario->llantas_traseras_derecha_marca }}</td>
                <td>{{ $inventario->llantas_traseras_izquierda_marca }}</td>
                <td>{{ $inventario->llantas_refaccion_marca }}</td>
            </tr>
            <tr>
                <td><strong>REFERENCIA</strong></td>
                <td>{{ $inventario->llantas_delanteras_derecha_referencia }}</td>
                <td>{{ $inventario->llantas_delanteras_izquierda_referencia }}</td>
                <td>{{ $inventario->llantas_traseras_derecha_referencia }}</td>
                <td>{{ $inventario->llantas_traseras_izquierda_referencia }}</td>
                <td>{{ $inventario->llantas_refaccion_referencia }}</td>
            </tr>
        </table>
        <br>
        <table widt="100%">
            <tr>
                <td>
                    <table width="100%" border="1">
                        <tr>
                            <td colspan="3"><strong>Mecánico</strong></td>
                        </tr>
                        <tr>
                            <td></td>
                            <td><strong>Cantidad</strong></td>
                            <td><strong>Estado</strong></td>
                        </tr>
                        <tr>
                            <td><strong>Motor</strong></td>
                            <td>{{ $inventario->mecanico_motor_cant }}</td>
                            <td>{{ $inventario->mecanico_motor_estado }}</td>
                        </tr>
                        <tr>
                            <td><strong>Check engine</strong></td>
                            <td>{{ $inventario->mecanico_check_engine_cant }}</td>
                            <td>{{ $inventario->mecanico_check_engine_estado }}</td>
                        </tr>
                        <tr>
                            <td><strong>Transmisón</strong></td>
                            <td>{{ $inventario->mecanico_transmision_cant }}</td>
                            <td>{{ $inventario->mecanico_transmision_estado }}</td>
                        </tr>
                        <tr>
                            <td><strong>Dirección</strong></td>
                            <td>{{ $inventario->mecanico_direccion_cant }}</td>
                            <td>{{ $inventario->mecanico_direccion_estado }}</td>
                        </tr>
                        <tr>
                            <td><strong>Frenos</strong></td>
                            <td>{{ $inventario->mecanico_frenos_cant }}</td>
                            <td>{{ $inventario->mecanico_frenos_estado }}</td>
                        </tr>
                        <tr>
                            <td><strong>Clutch</strong></td>
                            <td>{{ $inventario->mecanico_clutch_cant }}</td>
                            <td>{{ $inventario->mecanico_clutch_estado }}</td>
                        </tr>
                        <tr>
                            <td><strong>Amortiguadores</strong></td>
                            <td>{{ $inventario->mecanico_amortiguadores_cant }}</td>
                            <td>{{ $inventario->mecanico_amortiguadores_estado }}</td>
                        </tr>
                        <tr>
                            <td><strong>Suspensión</strong></td>
                            <td>{{ $inventario->mecanico_suspension_cant }}</td>
                            <td>{{ $inventario->mecanico_suspension_estado }}</td>
                        </tr>
                        <tr>
                            <td><strong>Sistema de escape</strong></td>
                            <td>{{ $inventario->mecanico_sistema_escape_cant }}</td>
                            <td>{{ $inventario->mecanico_sistema_escape_estado }}</td>
                        </tr>
                        <tr>
                            <td><strong>Alineación</strong></td>
                            <td>{{ $inventario->mecanico_alineacion_cant }}</td>
                            <td>{{ $inventario->mecanico_alineacion_estado }}</td>
                        </tr>
                        <tr>
                            <td><strong>Bateria</strong></td>
                            <td>{{ $inventario->mecanico_bateria_cant }}</td>
                            <td>{{ $inventario->mecanico_bateria_estado }}</td>
                        </tr>
                        <tr>
                            <td><strong>Tapa radiador</strong></td>
                            <td>{{ $inventario->mecanico_tapa_radiador_cant }}</td>
                            <td>{{ $inventario->mecanico_tapa_radiaador_estado }}</td>
                        </tr>
                        <tr>
                            <td><strong>Tapa aceite</strong></td>
                            <td>{{ $inventario->mecanico_tapa_aceite_cant }}</td>
                            <td>{{ $inventario->mecanico_tapa_aceite_estado }}</td>
                        </tr>
                        <tr>
                            <td><strong>Varilla medidora de aceite</strong></td>
                            <td>{{ $inventario->mecanico_varilla_medidora_aceite_cant }}</td>
                            <td>{{ $inventario->mecanico_varilla_medidora_aceite_estado }}</td>
                        </tr>
                        <tr>
                            <td><strong>Bandas</strong></td>
                            <td>{{ $inventario->mecanico_bandas_cant }}</td>
                            <td>{{ $inventario->mecanico_bandas_estado }}</td>
                        </tr>
                    </table>
                    <br><br><br>
                </td>
                <td>
                    <table width="100%" border="1">
                        <tr>
                            <td colspan="3"><strong>Eléctrico</strong></td>
                        </tr>
                        <tr>
                            <td></td>
                            <td><strong>Cantidad</strong></td>
                            <td><strong>Estado</strong></td>
                        </tr>
                        <tr>
                            <td><strong>Direccionales</strong></td>
                            <td>{{ $inventario->electrico_direccionales_cant }}</td>
                            <td>{{ $inventario->electrico_direccionales_estado }}</td>
                        </tr>
                        <tr>
                            <td><strong>Intermitentes</strong></td>
                            <td>{{ $inventario->electrico_intermitentes_cant }}</td>
                            <td>{{ $inventario->electrico_intermitentes_estado }}</td>
                        </tr>
                        <tr>
                            <td><strong>Faros de niebla</strong></td>
                            <td>{{ $inventario->electrico_faros_niebla_cant }}</td>
                            <td>{{ $inventario->electrico_faros_niebla_estado }}</td>
                        </tr>
                        <tr>
                            <td><strong>Luces bajas</strong></td>
                            <td>{{ $inventario->electrico_luces_bajas_cant }}</td>
                            <td>{{ $inventario->electrico_luces_bajas_estado }}</td>
                        </tr>
                        <tr>
                            <td><strong>Luces altas</strong></td>
                            <td>{{ $inventario->electrico_luces_altas_cant }}</td>
                            <td>{{ $inventario->electrico_luces_altas_estado }}</td>
                        </tr>
                        <tr>
                            <td><strong>Reversa</strong></td>
                            <td>{{ $inventario->electrico_reversa_cant }}</td>
                            <td>{{ $inventario->electrico_reversa_estado }}</td>
                        </tr>
                        <tr>
                            <td><strong>Luces stop</strong></td>
                            <td>{{ $inventario->electrico_luces_stop_cant }}</td>
                            <td>{{ $inventario->electrico_luces_stop_estado }}</td>
                        </tr>
                        <tr>
                            <td><strong>Limpiadores</strong></td>
                            <td>{{ $inventario->electrico_limpiadores_cant }}</td>
                            <td>{{ $inventario->electrico_limpiadores_estado }}</td>
                        </tr>
                        <tr>
                            <td><strong>Antena</strong></td>
                            <td>{{ $inventario->electrico_antena_cant }}</td>
                            <td>{{ $inventario->electrico_antena_estado }}</td>
                        </tr>
                        <tr>
                            <td><strong>Claxon</strong></td>
                            <td>{{ $inventario->electrico_claxon_cant }}</td>
                            <td>{{ $inventario->electrico_claxon_estado }}</td>
                        </tr>
                        <tr>
                            <td><strong>Alarma de reversa</strong></td>
                            <td>{{ $inventario->electrico_alarma_reversa_cant }}</td>
                            <td>{{ $inventario->electrico_alarma_reversa_estado }}</td>
                        </tr>
                        <tr>
                            <td><strong>Torreta</strong></td>
                            <td>{{ $inventario->electrico_torreta_cant }}</td>
                            <td>{{ $inventario->electrico_torreta_estado }}</td>
                        </tr>
                        <tr>
                            <td><strong>Tablero de instrumentos</strong></td>
                            <td>{{ $inventario->electrico_tablero_instrumentos_cant }}</td>
                            <td>{{ $inventario->electrico_tablero_instrumentos_estado }}</td>
                        </tr>
                        <tr>
                            <td><strong>Medidor de gasolina</strong></td>
                            <td>{{ $inventario->electrico_medidor_gasolina_cant }}</td>
                            <td>{{ $inventario->electrico_medidor_gasolina_estado }}</td>
                        </tr>
                        <tr>
                            <td><strong>Medidor de temperatura</strong></td>
                            <td>{{ $inventario->electrico_medidor_temperatura_cant }}</td>
                            <td>{{ $inventario->electrico_medidor_temperatura_estado }}</td>
                        </tr>
                        <tr>
                            <td><strong>Medidor de aceite</strong></td>
                            <td>{{ $inventario->electrico_medidor_aceite_cant }}</td>
                            <td>{{ $inventario->electrico_medidor_aceite_estado }}</td>
                        </tr>
                        <tr>
                            <td><strong>Calefacción | Clima</strong></td>
                            <td>{{ $inventario->electrico_calefaccion_clima_cant }}</td>
                            <td>{{ $inventario->electrico_calefaccion_clima_estado }}</td>
                        </tr>
                    </table>
                </td>
            </tr>
            <tr>
                <td>
                    <table width="100%" border="1">
                        <tr>
                            <td colspan="3"><strong>Chasis | Cuerpo Auto</strong></td>
                        </tr>
                        <tr>
                            <td></td>
                            <td><strong>Cantidad</strong></td>
                            <td><strong>Estado</strong></td>
                        </tr>
                        <tr>
                            <td><strong>Faros</strong></td>
                            <td>{{ $inventario->chasis_faros_cant }}</td>
                            <td>{{ $inventario->chasis_faros_estado }}</td>
                        </tr>
                        <tr>
                            <td><strong>Calaveras</strong></td>
                            <td>{{ $inventario->chasis_calaveras_cant }}</td>
                            <td>{{ $inventario->chasis_calaveras_estado }}</td>
                        </tr>
                        <tr>
                            <td><strong>Rines</strong></td>
                            <td>{{ $inventario->chasis_rines_cant }}</td>
                            <td>{{ $inventario->chasis_rines_estado }}</td>
                        </tr>
                        <tr>
                            <td><strong>Tapones rines</strong></td>
                            <td>{{ $inventario->chasis_tapones_rines_cant }}</td>
                            <td>{{ $inventario->chasis_tapones_rines_estado }}</td>
                        </tr>
                        <tr>
                            <td><strong>Hojalatería</strong></td>
                            <td>{{ $inventario->chasis_hojalateria_cant }}</td>
                            <td>{{ $inventario->chasis_hojalateria_estado }}</td>
                        </tr>
                        <tr>
                            <td><strong>Pintura</strong></td>
                            <td>{{ $inventario->chasis_pintura_cant }}</td>
                            <td>{{ $inventario->chasis_pintura_estado }}</td>
                        </tr>
                        <tr>
                            <td><strong>Salpicaduras</strong></td>
                            <td>{{ $inventario->chasis_salpicaderas_cant }}</td>
                            <td>{{ $inventario->chasis_salpicaderas_estado }}</td>
                        </tr>
                        <tr>
                            <td><strong>Puertas</strong></td>
                            <td>{{ $inventario->chasis_puertas_cant }}</td>
                            <td>{{ $inventario->chasis_puertas_estado }}</td>
                        </tr>
                        <tr>
                            <td><strong>Cofre</strong></td>
                            <td>{{ $inventario->chasis_cofre_cant }}</td>
                            <td>{{ $inventario->chasis_cofre_estado }}</td>
                        </tr>
                        <tr>
                            <td><strong>Cajuela</strong></td>
                            <td>{{ $inventario->chasis_cajuela_cant }}</td>
                            <td>{{ $inventario->chasis_cajuela_estado }}</td>
                        </tr>
                        <tr>
                            <td><strong>Toldo</strong></td>
                            <td>{{ $inventario->chasis_toldo_cant }}</td>
                            <td>{{ $inventario->chasis_toldo_estado }}</td>
                        </tr>
                        <tr>
                            <td><strong>Defensas</strong></td>
                            <td>{{ $inventario->chasis_defensas_cant }}</td>
                            <td>{{ $inventario->chasis_defensas_estado }}</td>
                        </tr>
                        <tr>
                            <td><strong>Molduras</strong></td>
                            <td>{{ $inventario->chasis_molduras_cant }}</td>
                            <td>{{ $inventario->chasis_molduras_estado }}</td>
                        </tr>
                        <tr>
                            <td><strong>Tumbaburros</strong></td>
                            <td>{{ $inventario->chasis_tumbaburros_cant }}</td>
                            <td>{{ $inventario->chasis_tumbaburros_estado }}</td>
                        </tr>
                        <tr>
                            <td><strong>Estribos</strong></td>
                            <td>{{ $inventario->chasis_estribos_cant }}</td>
                            <td>{{ $inventario->chasis_estribos_estado }}</td>
                        </tr>
                        <tr>
                            <td><strong>Tapón de gasolina</strong></td>
                            <td>{{ $inventario->chasis_tapon_gasolina_cant }}</td>
                            <td>{{ $inventario->chasis_tapon_gasolina_estado }}</td>
                        </tr>
                    </table>

                </td>
                <td>
                    <table width="100%" border="1">
                        <tr>
                            <td colspan="3"><strong>Vidrios</strong></td>
                        </tr>
                        <tr>
                            <td></td>
                            <td><strong>Cantidad</strong></td>
                            <td><strong>Estado</strong></td>
                        </tr>
                        <tr>
                            <td><strong>Medallón</strong></td>
                            <td>{{ $inventario->vidrios_medallon_cant }}</td>
                            <td>{{ $inventario->vidrios_medallon_estado }}</td>
                        </tr>
                        <tr>
                            <td><strong>Cristales</strong></td>
                            <td>{{ $inventario->vidrios_cristales_cant }}</td>
                            <td>{{ $inventario->vidrios_cristales_estado }}</td>
                        </tr>
                        <tr>
                            <td><strong>Parabrisas</strong></td>
                            <td>{{ $inventario->vidrios_parabrisas_cant }}</td>
                            <td>{{ $inventario->vidrios_parabrisas_estado }}</td>
                        </tr>
                        <tr>
                            <td><strong>Espejo retrovisor</strong></td>
                            <td>{{ $inventario->vidrios_espejo_retrovisor_cant }}</td>
                            <td>{{ $inventario->vidrios_espejo_retrovisor_estado }}</td>
                        </tr>
                        <tr>
                            <td><strong>Espejos laterales</strong></td>
                            <td>{{ $inventario->vidrios_espejos_laterales_cant }}</td>
                            <td>{{ $inventario->vidrios_espejos_laterales_estado }}</td>
                        </tr>
                    </table>
                    <table width="100%" border="1">
                        <tr>
                            <td colspan="3"><strong>Seguridad</strong></td>
                        </tr>
                        <tr>
                            <td></td>
                            <td><strong>Cantidad</strong></td>
                            <td><strong>Estado</strong></td>
                        </tr>
                        <tr>
                            <td><strong>Cinturón de seguridad</strong></td>
                            <td>{{ $inventario->seguridad_cinturon_seguridad_cant }}</td>
                            <td>{{ $inventario->seguridad_cinturon_seguridad_estado }}</td>
                        </tr>
                        <tr>
                            <td><strong>Caja de herramientas</strong></td>
                            <td>{{ $inventario->seguridad_caja_herramienta_cant }}</td>
                            <td>{{ $inventario->seguridad_caja_herramienta_estado }}</td>
                        </tr>
                        <tr>
                            <td><strong>Gato</strong></td>
                            <td>{{ $inventario->seguridad_gato_cant }}</td>
                            <td>{{ $inventario->seguridad_gato_estado }}</td>
                        </tr>
                        <tr>
                            <td><strong>Llave de cruz</strong></td>
                            <td>{{ $inventario->seguridad_llave_cruz_cant }}</td>
                            <td>{{ $inventario->seguridad_llave_cruz_estado }}</td>
                        </tr>
                        <tr>
                            <td><strong>Triangulo de seguridad</strong></td>
                            <td>{{ $inventario->seguridad_triangulo_seguridad_cant }}</td>
                            <td>{{ $inventario->seguridad_triangulo_seguridad_estado }}</td>
                        </tr>
                        <tr>
                            <td><strong>Cables pasa corriente</strong></td>
                            <td>{{ $inventario->seguridad_cable_pasacorriente_cant }}</td>
                            <td>{{ $inventario->seguridad_cable_pasacorriente_estado }}</td>
                        </tr>
                        <tr>
                            <td><strong>Extinguidor</strong></td>
                            <td>{{ $inventario->seguridad_extinguidor_cant }}</td>
                            <td>{{ $inventario->seguridad_extinguidor_estado }}</td>
                        </tr>
                        <tr>
                            <td><strong>Botiquín</strong></td>
                            <td>{{ $inventario->seguridad_botiquin_cant }}</td>
                            <td>{{ $inventario->seguridad_botiquin_estado }}</td>
                        </tr>
                        <tr>
                            <td><strong>Linterna</strong></td>
                            <td>{{ $inventario->seguridad_linterna_cant }}</td>
                            <td>{{ $inventario->seguridad_linterna_estado }}</td>
                        </tr>
                    </table>
                </td>
            </tr>
            <tr>
                <td>
                    <table width="100%" border="1">
                        <tr>
                            <td colspan="3"><strong>Interiores</strong></td>
                        </tr>
                        <tr>
                            <td></td>
                            <td><strong>Cantidad</strong></td>
                            <td><strong>Estado</strong></td>
                        </tr>
                        <tr>
                            <td><strong>Vestidura</strong></td>
                            <td>{{ $inventario->interiores_vestidura_cant }}</td>
                            <td>{{ $inventario->interiores_vestidura_estado }}</td>
                        </tr>
                        <tr>
                            <td><strong>Tapicería</strong></td>
                            <td>{{ $inventario->interiores_tapoceria_cant }}</td>
                            <td>{{ $inventario->interiores_tapiceria_estado }}</td>
                        </tr>
                        <tr>
                            <td><strong>Asientos</strong></td>
                            <td>{{ $inventario->interiores_asientos_cant }}</td>
                            <td>{{ $inventario->interiores_asientos_estado }}</td>
                        </tr>
                        <tr>
                            <td><strong>Apoya cabezas</strong></td>
                            <td>{{ $inventario->interiores_apoya_cabezas_cant }}</td>
                            <td>{{ $inventario->interiores_apoya_cabezas_estado }}</td>
                        </tr>
                        <tr>
                            <td><strong>Coderas laterales</strong></td>
                            <td>{{ $inventario->interiores_coderas_laterales_cant }}</td>
                            <td>{{ $inventario->interiores_coderas_laterales_estado }}</td>
                        </tr>
                        <tr>
                            <td><strong>Viceras</strong></td>
                            <td>{{ $inventario->interiores_viceras_cant }}</td>
                            <td>{{ $inventario->interiores_viceras_estado }}</td>
                        </tr>
                        <tr>
                            <td><strong>Guantera</strong></td>
                            <td>{{ $inventario->interiores_guantera_cant }}</td>
                            <td>{{ $inventario->interiores_guantera_estado }}</td>
                        </tr>
                        <tr>
                            <td><strong>Radio</strong></td>
                            <td>{{ $inventario->interiores_radio_cant }}</td>
                            <td>{{ $inventario->interiores_radio_estado }}</td>
                        </tr>
                        <tr>
                            <td><strong>Reloj</strong></td>
                            <td>{{ $inventario->interiores_reloj_cant }}</td>
                            <td>{{ $inventario->interiores_reloj_estado }}</td>
                        </tr>
                        <tr>
                            <td><strong>Encendedor</strong></td>
                            <td>{{ $inventario->interiores_encendedor_cant }}</td>
                            <td>{{ $inventario->interiores_encendedor_estado }}</td>
                        </tr>
                        <tr>
                            <td><strong>Cenicero</strong></td>
                            <td>{{ $inventario->interiores_cenicero_cant }}</td>
                            <td>{{ $inventario->interiores_cenicero_estado }}</td>
                        </tr>
                        <tr>
                            <td><strong>Tapetes</strong></td>
                            <td>{{ $inventario->interiores_tapetes_cant }}</td>
                            <td>{{ $inventario->interiores_tapetes_estado }}</td>
                        </tr>
                        <tr>
                            <td><strong>Luz interior</strong></td>
                            <td>{{ $inventario->interiores_luz_interior_cant }}</td>
                            <td>{{ $inventario->interiores_luz_interior_estado }}</td>
                        </tr>
                    </table>
                </td>
                <td>
                    <table width="100%" border="1">
                        <tr>
                            <td colspan="3"><strong>Documentación</strong></td>
                        </tr>
                        <tr>
                            <td></td>
                            <td><strong>Cantidad</strong></td>
                            <td><strong>Estado</strong></td>
                        </tr>
                        <tr>
                            <td><strong>Tarjeta de circulación</strong></td>
                            <td>{{ $inventario->documentacion_tarjeta_circulacion_cant }}</td>
                            <td>{{ $inventario->documentacion_tarjeta_circulacion_estado }}</td>
                        </tr>
                        <tr>
                            <td><strong>Póliza de seguro</strong></td>
                            <td>{{ $inventario->documentacion_poliza_seguro_cant }}</td>
                            <td>{{ $inventario->documentacion_poliza_Seguro_estado }}</td>
                        </tr>
                        <tr>
                            <td><strong>Manual</strong></td>
                            <td>{{ $inventario->documentacion_manual_cant }}</td>
                            <td>{{ $inventario->documentacion_manual_estado }}</td>
                        </tr>
                        <tr>
                            <td><strong>Verificación</strong></td>
                            <td>{{ $inventario->documentacion_verificacion_cant }}</td>
                            <td>{{ $inventario->documentacion_verificacion_estado }}</td>
                        </tr>
                    </table>
                    <br><br><br><br><br><br><br><br><br><br><br><br>
                </td>
            </tr>
        </table>
        <br>
        <table width="100%" border="1">
            <tr>
                <td colspan="2"><strong>Otros</strong></td>
            </tr>
            <tr>
                <td><strong>Observaciones</strong></td>
                <td>{{ $inventario->observaciones }}</td>
            </tr>
            <tr>
                <td><strong>Ruidos</strong></td>
                <td>{{ $inventario->ruidos }}</td>
            </tr>
            <tr>
                <td><strong>Fugas</strong></td>
                <td>{{ $inventario->fugas }}</td>
            </tr>
        </table>
        @if ($inventario->fotos->count() > 0)
            <br><br><br><br><br><br><br><br>
            <center>
                <strong>FOTOS</strong>
            </center>
            <table width="100%">
                <tr>
                    <th>SECCIÓN</th>
                    <th>DESCRIPCIÓN</th>
                    <th></th>
                </tr>
                @foreach ($inventario->fotos as $foto)
                    <tr>
                        <td>{{ $foto->seccion }}</td>
                        <td>{{ $foto->descripcion }}</td>
                        <td>
                            <br><br>
                            <a href="http://dotech.dyndns.biz:16666/dotech_api/public/storage/inventario_fotos/{{ $foto->foto }}"
                                href="_BLANK">
                                <img src="http://dotech.dyndns.biz:16666/dotech_api/public/storage/inventario_fotos/{{ $foto->foto }}"
                                    alt="{{ $foto->foto }}" width="300">
                            </a>
                            {{--  <a href="http://localhost/dotech_api/public/storage/inventario_fotos/{{ $foto->foto }}"
                                href="_BLANK">
                                <img src="http://localhost/dotech_api/public/storage/inventario_fotos/{{ $foto->foto }}"
                                    alt="{{ $foto->foto }}" width="300">  --}}
                            </a>
                        </td>
                    </tr>
                @endforeach
            </table>
        @endif
        </p>
    </main>
</body>

</html>
