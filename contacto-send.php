<?php
$datos=$_REQUEST['datos'];
if ($datos=="")    /* despliega el formulario */
{
    ?>
<div id="formulario">    
    <div id="datos"> 
        <div class="col-md-8 sm-m-top-30">   
            <form method="POST" action="<?php echo htmlentities($_SERVER['PHP_SELF']); ?>" enctype="multipart/form-data">
            <input type="hidden" name="datos" value="submit">
                <div class="row">
                    <div class="col-sm-6">
                        <div class="form-group">
                            <input id="name" name="name" type="text" placeholder="Nombre" class="form-control" required="">
                        </div> 
                    </div>
                    <div class="col-sm-6">
                        <div class="form-group">
                            <input id="email" name="email" type="text" placeholder="Email" class="form-control" required="">
                        </div>                  
                    </div>
                    <div class="col-sm-6">
                        <div class="form-group">
                            <input id="phone" name="phone" type="text" placeholder="Teléfono" class="form-control" required="">
                        </div>
                    </div>
                    <div class="col-sm-6">
                        <div class="form-group">
                            <input id="empresa" name="empresa" type="text" placeholder="Empresa" class="form-control" required="">
                        </div>
                    </div>
                    <div class="col-sm-12">
                        <div class="form-group">
                            <textarea class="form-control" id="comments" name="comments" rows="6" placeholder="Mensaje" required=""></textarea>
                        </div>
                        <div class="g-recaptcha" data-sitekey="6LdG_B0UAAAAANNxu9qBLyM1wtDAHUX8b1TumFFS"></div>
                        <div class="form-group text-center">
                            <button class="btn btn-primary" type="submit">ENVIAR</button>
                        </div>

                    </div>
                </div>              
            </form>             
        </div>
    </div>
</div>
<?php
    } 
else                /* Envia los datos */
    {
    $nombre=$_REQUEST['name'];
    $mail=$_REQUEST['email'];
    $mensaje=$_REQUEST['comments'];
    if (($nombre=="")||($mail=="")||($mensaje==""))
        {
        echo "<p>Los campos marcados con un ".'"*"'." son obligatorios, por favor llena <a href=\"\">el formulario</a> de nuevo.</p>";
        }
    else{   
   
$para="info@acodemexico.com"; 
$subject="Formulario de contacto";  
    $dia = date("d/m/Y");
    $dif_horario = "-0"; /* IMPORTANTE ajustar diferencia de horario en base al mail recibido */
    $ajuste_horas = ($dif_horario * 3600);
    $hora = date("H:i",time() + $ajuste_horas);
    $mail = $_POST['email'];
    if (strlen($mail)<8)
        $mail="clientes_sin_correo@nada.com";
    $contenido = "
    Para: $para<br>
            El Mensaje se envió el <b>$dia</b> a las $hora<br>
            Enviado desde el sitio web AlphaCode México/
<br>
<br>
<br>            
<table width='650' border='1' bordercolor='#000000' cellspacing='0' cellpadding='5'>
                <tr>
                    <td align=left width='120'>
                        Nombre: 
                    </td>
                    <td width='530'>
                        {$_POST['name']}
                    </td>
                </tr>
                <tr>
                    <td align=left width='120'>
                        Mail: 
                    </td>
                    <td width='530'>
                        {$_POST['email']}
                    </td>
                </tr>
                <tr>
                    <td align=left width='120'>
                        Teléfono: 
                    </td>
                    <td width='530'>
                        {$_POST['phone']}
                    </td>
                </tr>
                <tr>
                    <td align=left width='120'>
                        Empresa: 
                    </td>
                    <td width='530'>
                        {$_POST['empresa']}
                    </td>
                </tr>
                <tr>
                    <td align=left width='120' valign='top'>
                        Mensaje: 
                        <p>&nbsp;</td>
                    <td width='530' valign='top'>
                        {$_POST['comments']}
                    </td>
                </table>
            <!-- Form de captura:  {$_SERVER['PHP_SELF']} -->
            <!-- Procesa form: {$_SERVER['PHP_SELF']} -->
    ";
    $headers  = "MIME-Version: 1.0\n";
    $headers .= "Content-type: text/html; charset=utf-8\n";
    //$headers .= "Bcc: beto@agenciafa.mx"."\n";
    $headers .= "Reply-To: $mail"."\n";
    $headers .= "From: $mail";
    echo "<!--para: $para - de: {$_POST['name']}  -->";
    mail($para, $subject, $contenido, $headers);

    echo ("<h2 class='enviado'>Gracias por Contactarnos!</h2><h2 class='enviado'>Su información se ha enviado exitosamente.</h2>");
        }
    }  
?>