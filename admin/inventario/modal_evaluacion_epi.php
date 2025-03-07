<div class="modal fade" id="modal_evaluacion_epi_<?php echo $id_epi ?>" tabindex="-1" aria-labelledby="modal_evaluacion_epi_<?php echo $id_epi ?>" aria-hidden="true">
    <div class="modal-dialog modal-xl">
        <div class="modal-content">
            <div class="modal-header bg-success-subtle text-center">
                <h3 class="modal-title w-100 text-center" id="nuevoModalLabel">EVALUACION EPI <?php echo $id_epi ?></h3>
                <button type="button" class="btn-close" data-bs-dismiss="modal" aria-label="Close"></button>
            </div>
            <div class="modal-body">
                <div class="row">

                    <div class="col-md-5">
                        <h2>Checklist de Revisión EPI</h2>
                    </div>
                    <div class="col-md-5">
                        <div class="form-group row">
                            <label for="nombre" class="col-form-label col-sm-4" style="text-align: right;">Fecha Evaluacion:</label>
                            <div class="col-sm-5">
                                <input type="date" name="fecha" id="fecha" class="form-control" tabindex="1">
                            </div>
                        </div>
                    </div>

                    <!-- Formulario para el checklist -->
                </div>
                <div class="row">
                    <div class="col-md-12">
                        <div class="form-group" style="background-color: #0080c0; padding: 2px; border-radius: 5px; margin-bottom: 10px;">
                            <label style="text-align: center; color: #ffffff;">
                                <h5 style="margin: 0;">Detalles del EPI:</h5>
                            </label>
                        </div>
                    </div>
                </div>

                <div class="row">
                    <div class="form-group row col-md-2">
                        <!-- Clase EPI -->
                        <div class="col-sm-12">
                            <input type="text" value="<?php echo $clase_epi; ?>" name="modelo_epi" class="form-control" readonly>
                        </div>


                    </div>

                    <div class="form-group row col-md-4">
                        <!-- Tipo EPI -->
                        <label for="centro" class="col-form-label col-sm-3">EPI: *</label>
                        <div class="col-sm-9">
                            <input type="text" value="<?php echo $tipo_epi; ?>" name="tipo_epi" class="form-control" readonly>
                        </div>

                    </div>
                    <div class="col-md-3">
                        <div class="form-group row">
                            <label for="marca_epi" class="col-form-label col-sm-3">Marca</label>
                            <div class="col-sm-8">
                                <input type="text" value="<?php echo $detallesepi_dato['marca_epi']; ?>" name="marca_epi" class="form-control" readonly>
                            </div>
                        </div>
                    </div>
                    <div class="form-group row col-md-3">
                        <div class="form-group row">
                            <label for="modelo_epi" class="col-form-label col-sm-4">Modelo</label>
                            <div class="col-sm-8">
                                <input type="text" value="<?php echo $modelo_epi; ?>" name="modelo_epi" class="form-control" readonly>
                            </div>
                        </div>
                    </div>
                </div>
                <div class="row">

                    <div class="form-group row col-md-3">
                        <div class="form-group row">
                            <label for="numserie_epi" class="col-form-label col-sm-2">N/S</label>
                            <div class="col-sm-10">
                                <input type="text" value="<?php echo $numserie_epi; ?>" name="numserie_epi" class="form-control" readonly>
                            </div>
                        </div>
                    </div>
                    <div class="form-group row col-md-2">
                        <div class="form-group row">
                            <label for="nombre" class="col-form-label col-sm-4">Año:</label>
                            <div class="col-sm-8">
                                <input type="text" name="aniofab_epi" id="aniofab_epi" value="<?php echo $aniofab_epi; ?>" class="form-control" tabindex="1" placeholder="inserte año" pattern="^[0-9]*$" readonly>
                            </div>
                        </div>
                    </div>
                    <div class="form-group row col-md-3">
                        <div class="form-group row">
                            <label for="nombre" class="col-form-label col-sm-2">Cad.</label>
                            <div class="col-sm-8">
                                <input type="text" value="<?php echo $vigencia_epi; ?>" name="vigencia_epi" class="form-control" readonly>
                            </div>
                        </div>
                    </div>

                    <div class="form-group row col-md-2">
                        <div class="form-group row">
                            <label for="nombre" class="col-form-label col-sm-5">Manual</label>
                            <div class="col-sm-7">
                                <?php
                                $bgClass = '';
                                if ($manual_epi === "Si") {
                                    $bgClass = 'bg-success'; // Clase personalizada para fondo verde
                                } elseif ($manual_epi === "No") {
                                    $bgClass = 'bg-danger'; // Clase personalizada para fondo rojo
                                }
                                ?>
                                <input type="text" value="<?php echo $manual_epi; ?>" name="manual_epi" class="form-control <?php echo $bgClass; ?>" readonly>
                            </div>
                        </div>
                    </div>
                    <div class="form-group row col-md-2">
                        <div class="form-group row">
                            <label for="nombre" class="col-form-label col-sm-3">CE</label>
                            <div class="col-sm-9">
                                <?php
                                $bgClass = '';
                                if ($marcace_epi === "Si") {
                                    $bgClass = 'bg-success'; // Clase personalizada para fondo verde
                                } elseif ($marcace_epi === "No") {
                                    $bgClass = 'bg-danger'; // Clase personalizada para fondo rojo
                                }
                                ?>
                                <input type="text" value="<?php echo $marcace_epi; ?>" name="marcace_epi" class="form-control <?php echo $bgClass; ?>" readonly>
                            </div>
                        </div>
                    </div>
                </div>




                <div class="row">
                    <div class="col-sm-4">
                        <div class="form-group row">
                            <label for="centro" class="col-form-label col-sm-3">Centro: *</label>
                            <div class="col-sm-7">

                                <input type="text" value="<?php echo $centro_epi; ?>" name="centro_epi" class="form-control" readonly>

                            </div>

                        </div>

                    </div>
                    <div class="form-group row col-md-3">
                        <label for="clase_epi" class="col-form-label col-sm-4">Estado:</label>
                        <div class="col-sm-8">
                            <?php
                            $bgClass = '';
                            if ($estado_epi === "Disponible") {
                                $bgClass = 'bg-success'; // Clase personalizada para fondo verde
                            } elseif ($estado_epi === "Retirado") {
                                $bgClass = 'bg-danger'; // Clase personalizada para fondo rojo
                            }
                            ?>
                            <input type="text" value="<?php echo $estado_epi; ?>" name="marcace_epi" class="form-control <?php echo $bgClass; ?>" readonly>
                        </div>
                    </div>

                    <div class="form-group row col-md-5">
                        <label for="" class="col-form-label col-sm-1">Obs.: </label>
                        <div class="col-sm-11">
                            <input type="text" value="<?php echo $observaciones_epi; ?>" name="observaciones_epi" class="form-control" readonly>
                        </div>
                    </div>
                </div>



                <hr>
                <div class="row">
                    <div class="form-group d-flex justify-content-center align-items-center" style="background-color: #eeeeee; padding: 10px; border-radius: 5px; margin-bottom: 10px;">
                        <label style="text-align: center; color: #004080; margin: 0;">
                            <h4 style="margin: 0;">Checklist</h4>
                        </label>
                    </div>
                </div>

                <div class="row">
                    <div class="col-md-6">
                        <div class="form-group d-flex justify-content-center align-items-center" style="background-color: #004080; padding: 8px; border-radius: 5px; margin-bottom: 10px; height: 30px;">
                            <label style="text-align: center; color: #ffffff; margin: 0;">
                                CINTAS / CORREAS
                            </label>
                        </div>

                        <!-- Primera columna de preguntas -->
                        <div class="mb-1 row align-items-center">
                            <label for="item1" class="col-form-label col-sm-4">Hoyos o agujeros</label>
                            <div class="col-sm-8 d-flex align-items-center">
                                <div class="form-check form-check-inline">
                                    <input class="form-check-input" type="radio" name="item['Hoyos o agujeros']" id="item1_si" value="1" required>
                                    <label class="form-check-label" for="item1_si">Correcto</label>
                                </div>
                                <div class="form-check form-check-inline">
                                    <input class="form-check-input" type="radio" name="item['Hoyos o agujeros']" id="item1_no" value="0" required>
                                    <label class="form-check-label" for="item1_no">Incorrecto</label>
                                </div>
                            </div>
                        </div>

                        <div class="mb-1 row align-items-center">
                            <label for="item2" class="col-form-label col-sm-4">Cintas deshilachadas</label>
                            <div class="col-sm-8 d-flex align-items-center">
                                <div class="form-check form-check-inline">
                                    <input class="form-check-input" type="radio" name="item['Cintas deshilachadas']" id="item2_si" value="1" required>
                                    <label class="form-check-label" for="item2_si">Correcto</label>
                                </div>
                                <div class="form-check form-check-inline">
                                    <input class="form-check-input" type="radio" name="item['Cintas deshilachadas']" id="item2_no" value="0" required>
                                    <label class="form-check-label" for="item2_no">Incorrecto</label>
                                </div>
                            </div>
                        </div>
                        <div class="mb-1 row align-items-center">
                            <label for="item3" class="col-form-label col-sm-4">Desgastadas</label>
                            <div class="col-sm-8 d-flex align-items-center">
                                <div class="form-check form-check-inline">
                                    <input class="form-check-input" type="radio" name="item['Desgastadas']" id="item3_si" value="1" required>
                                    <label class="form-check-label" for="item3_si">Correcto</label>
                                </div>
                                <div class="form-check form-check-inline">
                                    <input class="form-check-input" type="radio" name="item['Desgastadas']" id="item3_no" value="0" required>
                                    <label class="form-check-label" for="item3_no">Incorrecto</label>
                                </div>
                            </div>
                        </div>

                        <div class="mb-1 row align-items-center">
                            <label for="item4" class="col-form-label col-sm-4">Talladuras</label>
                            <div class="col-sm-8 d-flex align-items-center">
                                <div class="form-check form-check-inline">
                                    <input class="form-check-input" type="radio" name="item['Talladuras']" id="item4_si" value="1" required>
                                    <label class="form-check-label" for="item4_si">Correcto</label>
                                </div>
                                <div class="form-check form-check-inline">
                                    <input class="form-check-input" type="radio" name="item['Talladuras']" id="item4_no" value="0" required>
                                    <label class="form-check-label" for="item4_no">Incorrecto</label>
                                </div>
                            </div>
                        </div>
                        <div class="mb-1 row align-items-center">
                            <label for="item3" class="col-form-label col-sm-4">Hay torsion (fibras duras o deformadas)</label>
                            <div class="col-sm-8 d-flex align-items-center">
                                <div class="form-check form-check-inline">
                                    <input class="form-check-input" type="radio" name="item['Hay torsion (fibras duras o deformadas)']" id="item5_si" value="1" required>
                                    <label class="form-check-label" for="item3_si">Correcto</label>
                                </div>
                                <div class="form-check form-check-inline">
                                    <input class="form-check-input" type="radio" name="item['Hay torsion (fibras duras o deformadas)']" id="item5_no" value="0" required>
                                    <label class="form-check-label" for="item3_no">Incorrecto</label>
                                </div>
                            </div>
                        </div>

                        <div class="mb-1 row align-items-center">
                            <label for="item4" class="col-form-label col-sm-4">Contaminacion excesiva por suciedad</label>
                            <div class="col-sm-8 d-flex align-items-center">
                                <div class="form-check form-check-inline">
                                    <input class="form-check-input" type="radio" name="item['Contaminacion excesiva por suciedad']" id="item6_si" value="1" required>
                                    <label class="form-check-label" for="item4_si">Correcto</label>
                                </div>
                                <div class="form-check form-check-inline">
                                    <input class="form-check-input" type="radio" name="item['Contaminacion excesiva por suciedad']" id="item6_no" value="0" required>
                                    <label class="form-check-label" for="item4_no">Incorrecto</label>
                                </div>
                            </div>
                        </div>
                        <div class="mb-1 row align-items-center">
                            <label for="item3" class="col-form-label col-sm-4">Quemaduras por soldadura, cigarrillo, etc.</label>
                            <div class="col-sm-8 d-flex align-items-center">
                                <div class="form-check form-check-inline">
                                    <input class="form-check-input" type="radio" name="item['Quemaduras  por soldadura, cigarrillo, et.']" id="item7_si" value="1" required>
                                    <label class="form-check-label" for="item3_si">Correcto</label>
                                </div>
                                <div class="form-check form-check-inline">
                                    <input class="form-check-input" type="radio" name="item['Quemaduras  por soldadura, cigarrillo, etc.']" id="item7_no" value="0" required>
                                    <label class="form-check-label" for="item3_no">Incorrecto</label>
                                </div>
                            </div>
                        </div>

                        <div class="mb-1 row align-items-center">
                            <label for="item4" class="col-form-label col-sm-4">Salpicadura de pintura y rigidez en cinta</label>
                            <div class="col-sm-8 d-flex align-items-center">
                                <div class="form-check form-check-inline">
                                    <input class="form-check-input" type="radio" name="item['Salpicadura de pintura y rigidez en cinta']" id="item8_si" value="1" required>
                                    <label class="form-check-label" for="item4_si">Correcto</label>
                                </div>
                                <div class="form-check form-check-inline">
                                    <input class="form-check-input" type="radio" name="item['Salpicadura de pintura y rigidez en cinta']" id="item8_no" value="0" required>
                                    <label class="form-check-label" for="item4_no">Incorrecto</label>
                                </div>
                            </div>
                        </div>
                        <div class="mb-1 row align-items-center">
                            <label for="item3" class="col-form-label col-sm-4">Degradaciòn por U.V. (pèrdida de color, quebradiza)</label>
                            <div class="col-sm-8 d-flex align-items-center">
                                <div class="form-check form-check-inline">
                                    <input class="form-check-input" type="radio" name="item['Degradaciòn por U.V. (pèrdida de color, quebradiza)']" id="item9_si" value="1" required>
                                    <label class="form-check-label" for="item3_si">Correcto</label>
                                </div>
                                <div class="form-check form-check-inline">
                                    <input class="form-check-input" type="radio" name="item['Degradaciòn por U.V. (pèrdida de color, quebradiza)']" id="item9_no" value="0" required>
                                    <label class="form-check-label" for="item3_no">Incorrecto</label>
                                </div>
                            </div>
                        </div>

                        <div class="mb-1 row align-items-center">
                            <label for="item4" class="col-form-label col-sm-4">Ataque por sustancias químicas</label>
                            <div class="col-sm-8 d-flex align-items-center">
                                <div class="form-check form-check-inline">
                                    <input class="form-check-input" type="radio" name="item['Ataque por sustancias químicas']" id="item10_si" value="1" required>
                                    <label class="form-check-label" for="item4_si">Correcto</label>
                                </div>
                                <div class="form-check form-check-inline">
                                    <input class="form-check-input" type="radio" name="item['Ataque por sustancias químicas']" id="item10_no" value="0" required>
                                    <label class="form-check-label" for="item4_no">Incorrecto</label>
                                </div>
                            </div>
                        </div>
                        <div class="mb-1 row align-items-center">
                            <label for="item3" class="col-form-label col-sm-4">Cortes de 1 mm en orillos o bordes de la reata.</label>
                            <div class="col-sm-8 d-flex align-items-center">
                                <div class="form-check form-check-inline">
                                    <input class="form-check-input" type="radio" name="item['Cortes de 1 mm en orillos o bordes  de la reata.']" id="item11_si" value="1" required>
                                    <label class="form-check-label" for="item3_si">Correcto</label>
                                </div>
                                <div class="form-check form-check-inline">
                                    <input class="form-check-input" type="radio" name="item['Cortes de 1 mm en orillos o bordes  de la reata.']" id="item11_no" value="0" required>
                                    <label class="form-check-label" for="item3_no">Incorrecto</label>
                                </div>
                            </div>
                        </div>

                        <div class="mb-1 row align-items-center">
                            <label for="item4" class="col-form-label col-sm-4">Otros</label>
                            <div class="col-sm-8 d-flex align-items-center">
                                <div class="form-check form-check-inline">
                                    <input class="form-check-input" type="radio" name="item['Otros']" id="item12_si" value="1" required>
                                    <label class="form-check-label" for="item4_si">Correcto</label>
                                </div>
                                <div class="form-check form-check-inline">
                                    <input class="form-check-input" type="radio" name="item['Otros']" id="item12_no" value="0" required>
                                    <label class="form-check-label" for="item4_no">Incorrecto</label>
                                </div>
                            </div>
                        </div>


                    </div>

                    <div class="col-md-6">
                        <!-- Segunda columna de preguntas -->
                        <div class="form-group d-flex justify-content-center align-items-center" style="background-color: #800040; padding: 8px; border-radius: 5px; margin-bottom: 10px; height: 30px;">
                            <label style="text-align: center; color: #ffffff; margin: 0;">
                                COSTURAS
                            </label>
                        </div>
                        <div class="mb-1 row align-items-center">
                            <label for="item3" class="col-form-label col-sm-4">Abiertas</label>
                            <div class="col-sm-8 d-flex align-items-center">
                                <div class="form-check form-check-inline">
                                    <input class="form-check-input" type="radio" name="item['Abiertas']" id="item13_si" value="1" required>
                                    <label class="form-check-label" for="item3_si">Correcto</label>
                                </div>
                                <div class="form-check form-check-inline">
                                    <input class="form-check-input" type="radio" name="item['Abiertas']" id="item13_no" value="0" required>
                                    <label class="form-check-label" for="item3_no">Incorrecto</label>
                                </div>
                            </div>
                        </div>

                        <div class="mb-1 row align-items-center">
                            <label for="item4" class="col-form-label col-sm-4">Hebras sueltas</label>
                            <div class="col-sm-8 d-flex align-items-center">
                                <div class="form-check form-check-inline">
                                    <input class="form-check-input" type="radio" name="item['Hebras sueltas']" id="item14_si" value="1" required>
                                    <label class="form-check-label" for="item4_si">Correcto</label>
                                </div>
                                <div class="form-check form-check-inline">
                                    <input class="form-check-input" type="radio" name="item['Hebras sueltas']" id="item14_no" value="0" required>
                                    <label class="form-check-label" for="item4_no">Incorrecto</label>
                                </div>
                            </div>
                        </div>
                        <div class="mb-1 row align-items-center">
                            <label for="item3" class="col-form-label col-sm-4">Reventadas</label>
                            <div class="col-sm-8 d-flex align-items-center">
                                <div class="form-check form-check-inline">
                                    <input class="form-check-input" type="radio" name="item['Reventadas']" id="item15_si" value="1" required>
                                    <label class="form-check-label" for="item3_si">Correcto</label>
                                </div>
                                <div class="form-check form-check-inline">
                                    <input class="form-check-input" type="radio" name="item['Reventadas']" id="item15_no" value="0" required>
                                    <label class="form-check-label" for="item3_no">Incorrecto</label>
                                </div>
                            </div>
                        </div>

                        <div class="mb-1 row align-items-center">
                            <label for="item4" class="col-form-label col-sm-4">Otros</label>
                            <div class="col-sm-8 d-flex align-items-center">
                                <div class="form-check form-check-inline">
                                    <input class="form-check-input" type="radio" name="item['Otros']" id="item16_si" value="1" required>
                                    <label class="form-check-label" for="item4_si">Correcto</label>
                                </div>
                                <div class="form-check form-check-inline">
                                    <input class="form-check-input" type="radio" name="item['Otros']" id="item16_no" value="0" required>
                                    <label class="form-check-label" for="item4_no">Incorrecto</label>
                                </div>
                            </div>
                        </div>
                        <div class="form-group d-flex justify-content-center align-items-center" style="background-color: #804040; padding: 8px; border-radius: 5px; margin-bottom: 10px; height: 30px;">
                            <label style="text-align: center; color: #ffffff; margin: 0;">
                                PARTES METÁLICAS (herrajes, hebillas, argollas..)
                            </label>
                        </div>
                        <div class="mb-1 row align-items-center">
                            <label for="item3" class="col-form-label col-sm-4">Grietas o roturas</label>
                            <div class="col-sm-8 d-flex align-items-center">
                                <div class="form-check form-check-inline">
                                    <input class="form-check-input" type="radio" name="item['Grietas o roturas']" id="item17_si" value="1" required>
                                    <label class="form-check-label" for="item3_si">Correcto</label>
                                </div>
                                <div class="form-check form-check-inline">
                                    <input class="form-check-input" type="radio" name="item['Grietas o roturas']" id="item17_no" value="0" required>
                                    <label class="form-check-label" for="item3_no">Incorrecto</label>
                                </div>
                            </div>
                        </div>

                        <div class="mb-1 row align-items-center">
                            <label for="item4" class="col-form-label col-sm-4">Desgaste en los extremos</label>
                            <div class="col-sm-8 d-flex align-items-center">
                                <div class="form-check form-check-inline">
                                    <input class="form-check-input" type="radio" name="item['Desgaste en los extremos']" id="item18_si" value="1" required>
                                    <label class="form-check-label" for="item4_si">Correcto</label>
                                </div>
                                <div class="form-check form-check-inline">
                                    <input class="form-check-input" type="radio" name="item['Desgaste en los extremos']" id="item18_no" value="0" required>
                                    <label class="form-check-label" for="item4_no">Incorrecto</label>
                                </div>
                            </div>
                        </div>
                        <div class="mb-1 row align-items-center">
                            <label for="item3" class="col-form-label col-sm-4">Corrosión</label>
                            <div class="col-sm-8 d-flex align-items-center">
                                <div class="form-check form-check-inline">
                                    <input class="form-check-input" type="radio" name="item['Corrosión']" id="item19_si" value="1" required>
                                    <label class="form-check-label" for="item3_si">Correcto</label>
                                </div>
                                <div class="form-check form-check-inline">
                                    <input class="form-check-input" type="radio" name="item['Corrosión']" id="item19_no" value="0" required>
                                    <label class="form-check-label" for="item3_no">Incorrecto</label>
                                </div>
                            </div>
                        </div>

                        <div class="mb-1 row align-items-center">
                            <label for="item4" class="col-form-label col-sm-4">Deformación</label>
                            <div class="col-sm-8 d-flex align-items-center">
                                <div class="form-check form-check-inline">
                                    <input class="form-check-input" type="radio" name="item['Deformación']" id="item20_si" value="1" required>
                                    <label class="form-check-label" for="item4_si">Correcto</label>
                                </div>
                                <div class="form-check form-check-inline">
                                    <input class="form-check-input" type="radio" name="item['Deformación']" id="item20_no" value="0" required>
                                    <label class="form-check-label" for="item4_no">Incorrecto</label>
                                </div>
                            </div>
                        </div>
                        <div class="mb-1 row align-items-center">
                            <label for="item3" class="col-form-label col-sm-4">Fisuras, golpes, hundimientos.</label>
                            <div class="col-sm-8 d-flex align-items-center">
                                <div class="form-check form-check-inline">
                                    <input class="form-check-input" type="radio" name="item['Fisuras, golpes, hundimientos.']" id="item21_si" value="1" required>
                                    <label class="form-check-label" for="item3_si">Correcto</label>
                                </div>
                                <div class="form-check form-check-inline">
                                    <input class="form-check-input" type="radio" name="item['Fisuras, golpes, hundimientos.']" id="item21_no" value="0" required>
                                    <label class="form-check-label" for="item3_no">Incorrecto</label>
                                </div>
                            </div>
                        </div>

                        <div class="mb-1 row align-items-center">
                            <label for="item4" class="col-form-label col-sm-4">Falta de sujeción</label>
                            <div class="col-sm-8 d-flex align-items-center">
                                <div class="form-check form-check-inline">
                                    <input class="form-check-input" type="radio" name="item['Falta de sujeción']" id="item22_si" value="1" required>
                                    <label class="form-check-label" for="item4_si">Correcto</label>
                                </div>
                                <div class="form-check form-check-inline">
                                    <input class="form-check-input" type="radio" name="item['Falta de sujeción']" id="item22_no" value="0" required>
                                    <label class="form-check-label" for="item4_no">Incorrecto</label>
                                </div>
                            </div>
                        </div>
                    </div>
                </div>

                <!-- Repite para los otros ítems hasta el ítem 20 -->
                <!-- Botón de enviar -->

                <div class="modal-footer">

                    <button type="button" class="btn btn-secondary" data-dismiss="modal">Cerrar</button>
                    <button type="submit" class="btn btn-primary"><i class="bi bi-floppy"></i> Guardar</button>

                </div>

                </form>
            </div>

        </div>
    </div>
</div>