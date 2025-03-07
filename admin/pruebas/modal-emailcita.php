         <!--Modal email cita rm-->
         <div class="modal fade" id="modal-emailcita<?php echo $reconocimiento['id_reconocimiento']; ?>" tabindex="-1" aria-labelledby="exampleModalLabel">
             <div class="modal-dialog modal-xl">
                 <div class="modal-content">
                     <div class="modal-header" style="background-color:gold">
                         <h5 class="modal-title" id="modal-emailcita" style="color: black;"><i class="bi bi-person-lines-fill"></i>Recon. Médico - <?php echo $reconocimiento['nombre_tr'] ?> - Detalles</h5>
                         <button type="button" class="close" style="color:black;" data-bs-dismiss="modal" aria-label="Close">
                             <span aria-hidden="true">&times;</span>
                         </button>
                     </div>
                     <div class="modal-body">

                         <form action="../../app/controllers/reconocimientos/enviar_email.php" method="post" enctype="multipart/form-data">

                             <div class="row">
                                 <input type="text" id="id_reconocimiento" name="id_reconocimiento" value="<?php echo $id_reconocimiento ?>" class="form-control" hidden>

                                 <div class="col-sm-8">
                                     <div class="form-group row">
                                         <label for="nombre_tr" class="col-form-label col-sm-2">Nombre</label>
                                         <div class="col-sm-8">
                                             <input type="text" id="nombre_tr" name="nombre_tr" value="<?php echo $reconocimiento['nombre_tr'] ?>" class="form-control" readonly>
                                         </div>
                                     </div>
                                 </div>
                                 <div class="col-sm-4">
                                     <div class="form-group row">
                                         <label for="dni_tr" class="col-form-label col-sm-4">DNI/NIE</label>
                                         <div class="col-sm-8">
                                             <input type="text" id="dni_tr" name="dni_tr" class="form-control" value="<?php echo $reconocimiento['dni_tr'] ?>" readonly>
                                         </div>
                                     </div>
                                 </div>

                             </div>
                             <div class="row">
                                 <div class="col-sm-8">
                                     <div class="form-group row">
                                         <label for="categoria_tr" class="col-form-label col-sm-2">Puesto</label>
                                         <div class="col-sm-8">
                                             <input type="text" id="categoria_tr" name="categoria_tr" class="form-control" value="<?php echo $reconocimiento['nombre_cat'] ?>" readonly>
                                         </div>
                                     </div>
                                 </div>
                                 <div class="col-sm-4">
                                     <div class="form-group row">
                                         <label for="centro_tr" class="col-form-label col-sm-4">Centro</label>
                                         <div class="col-sm-8">
                                             <input type="text" id="centro_tr" name="centro_tr" class="form-control" value="<?php echo $reconocimiento['nombre_cen'] ?>" readonly>
                                         </div>
                                     </div>
                                 </div>
                                 <div class="col-sm-8">
                                     <div class="form-group row">
                                         <label for="centro_tr" class="col-form-label col-sm-2">Empresa</label>
                                         <div class="col-sm-9">
                                             <input type="text" id="razonsocial_emp" name="razonsocial_emp" class="form-control" value="<?php echo $reconocimiento['razonsocial_emp'] ?>" readonly>
                                         </div>
                                     </div>
                                 </div>

                                 </br>
                                 <hr>

                             </div>
                             <div class="row">
                                 <div class="col-md-12">
                                     <div class="form-group">
                                         <label for="">Destinatario email</label>
                                         <select name="destinatario" id="destinatario" class="form-control">
                                             <?php
                                                foreach ($emailsinteres_datos as $emailsinteres_dato) { ?>
                                                 <option value="<?php echo $emailsinteres_dato['email_ei']; ?>"><?php echo $emailsinteres_dato['nombre_ei'] ?> | <?php echo $emailsinteres_dato['email_ei'] ?></option>
                                             <?php
                                                }
                                                ?>
                                         </select>
                                     </div>
                                 </div>
                             </div>
                             </br>
                             <hr>
                             <div class="row">
                                 <div class="form-group">
                                     <label for="">Anotaciones / restricciones</label>
                                     <textarea class="form-control" name="anotaciones_crm" value="" rows="2"><?php echo $reconocimiento['anotaciones_rm'] ?></textarea>
                                 </div>
                             </div>

                             <div class="modal-footer">

                                 <button type="button" class="btn btn-secondary" data-bs-dismiss="modal">Cerrar</button>
                                 <button type="submit" class="btn btn-primary"><i class="bi bi-envelope-arrow-up"></i></i> Enviar</button>

                             </div>
                         </form>
                     </div>
                 </div>

             </div>


         </div>
         <!--fin modal-->