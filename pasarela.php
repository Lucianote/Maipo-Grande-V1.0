<form action="index.php?modulo=factura" method="post" id="payment-form">
    <table class="table table-striped table-inverse" id="tablaPasarela">
        <thead class="thead-inverse">
            <tr>
                <th>Imagen</th>
                <th>Nombre</th>
                <th>Cantidad</th>
                <th>Precio</th>
                <th>Total</th>
            </tr>
        </thead>
        <tbody>
        </tbody>
    </table>
    <div class="form-row">
        <h4 class="mt3">Datos de su tarjeta</h4>
        <div id="card-element" class="form-control">
            <!-- A Stripe Element will be inserted here. -->
        </div>
        <!-- Used to display form errors. -->
        <div id="card-errors" role="alert"></div>
    </div>
    <div class="mt-3">
        <h4>Terminos y condiciones</h4>
        Este contrato describe los términos y condiciones generales (los "Términos y Condiciones Generales") aplicables al uso de los servicios ofrecidos por MaipoGrande Limitada., RUT 77.465.231-1, ("los Servicios") dentro del sitio www.maipogrande.cl ("MaipoGrande" o el "sitio"). Cualquier persona que desee acceder y/o usar el sitio o los servicios podrá hacerlo sujetándose a los Términos y Condiciones Generales, junto con todas las demás políticas y principios que rigen MaipoGrande  y que son incorporados al presente por referencia.

CUALQUIER PERSONA QUE NO ACEPTE ESTOS TÉRMINOS Y CONDICIONES GENERALES, LOS CUALES TIENEN UN CARÁCTER OBLIGATORIO Y VINCULANTE, DEBERÁ ABSTENERSE DE UTILIZAR EL SITIO Y/O LOS SERVICIOS.
        <div class="form-check">
          <label class="form-check-label">
            <input type="checkbox" class="form-check-input" name="" id="" value="checkedValue" checked>
            Acepto los terminos y condiciones
          </label>
        </div>
    </div>
    <div class="mt-3">
        <a class="btn btn-warning" href="index.php?modulo=envio" role="button">Ir a envio</a>
        <button type="submit" class="btn btn-primary float-right">Pagar</button>
    </div>
</form>
