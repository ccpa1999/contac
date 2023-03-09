<ol class="breadcrumb">
    <li><a href="#">FIANZA LTDA</a></li>
    <li class="active">Perfil</li>
</ol>
<div class="panel-body panel-body-inputin switch-right-grid">
    <div class="row">
        <h3 class="blank1">Informacion Personal</h3>
    </div>
    <form id="formularioActualizarInformacionPersonal" action="javascript:void(0);">
        <div class="row">
            <div class="form-group">
                <label class="col-md-2 control-label">Usuario</label>
                <div class="col-md-6">
                    <div class="input-group input-icon right in-grp1">
                        <span class="input-group-addon">
                            <i class="fa fa-user"></i>
                        </span>
                        <input class="form-control1" required readonly type="text" name="usuario" 
                               value="<?= $usuario[0]['usuario'] ?>">
                    </div>
                </div>
                <div class="col-sm-2 jlkdfj1">
                    <p class="help-block">Nombre de Usuario</p>
                </div>
                <div class="clearfix"> </div>
            </div>
        </div>
        <div class="row">
            <div class="form-group">
                <label class="col-md-2 control-label">Nombre Completo</label>
                <div class="col-md-6">
                    <div class="input-group input-icon right in-grp1">
                        <span class="input-group-addon">
                            <i class="fa fa-user"></i>
                        </span>
                        <input class="form-control1" required type="text" name="nombre"
                               value="<?= $usuario[0]['nombre_completo'] ?>">
                    </div>
                </div>
                <div class="col-sm-2 jlkdfj1">
                    <p class="help-block">Nombre Completo</p>
                </div>
                <div class="clearfix"> </div>
            </div>
        </div>
        <div class="row">
            <div class="form-group">
                <label class="col-md-2 control-label">Contraseña</label>
                <div class="col-md-6">
                    <div class="input-group input-icon right in-grp1">
                        <span class="input-group-addon">
                            <i class="fa fa-key"></i>
                        </span>
                        <input class="form-control1"required  name="password"
                               type="password" placeholder="Contraseña">
                    </div>
                </div>
                <div class="col-sm-2 jlkdfj1">
                    <p class="help-block">Contraseña de Ingreso</p>
                </div>
                <div class="clearfix"> </div>
            </div>
        </div>
        <div class="row">
            <div class="form-group">
                <label class="col-md-2 control-label">Identificación</label>
                <div class="col-md-6">
                    <div class="input-group input-icon right in-grp1">
                        <span class="input-group-addon">
                            <i class="fa fa-credit-card"></i>
                        </span>
                        <input class="form-control1" required type="text" name="identificacion"
                               value="<?= $usuario[0]['identificacion'] ?>">
                    </div>
                </div>
                <div class="col-sm-2 jlkdfj1">
                    <p class="help-block">Su Numero de Identifiacion</p>
                </div>
                <div class="clearfix"> </div>
            </div>
        </div>
        <div class="row">
            <div class="form-group">
                <label class="col-md-2 control-label">Fecha Nacimiento</label>
                <div class="col-md-6">
                    <div class="input-group input-icon right in-grp1">
                        <span class="input-group-addon">
                            <i class="fa fa-key"></i>
                        </span>
                        <input class="form-control1 fecha" required type="text" name="fecha_nacimiento"
                               value="<?= $usuario[0]['fecha_nacimiento'] ?>">
                    </div>
                </div>
                <div class="col-sm-2 jlkdfj1">
                    <p class="help-block">Su Fecha de Nacimiento</p>
                </div>
                <div class="clearfix"> </div>
            </div>
        </div>
        <hr />
        <div class="row">
            <div class="col-md-6 col-md-offset-5">
                <button class="btn-success btn" type="submit">Guardar</button>
            </div>
        </div>
        <input type="hidden" name="metodo" value="actualizarInformacionPersonal">
    </form>
</div>

