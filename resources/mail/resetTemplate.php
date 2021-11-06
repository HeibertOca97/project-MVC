<div style="background-color:#eef9f8;font-family:-apple-system,BlinkMacSystemFont,'Segoe UI',Roboto,Helvetica,Arial,sans-serif,'Apple Color Emoji','Segoe UI Emoji','Segoe UI Symbol';font-size:16px;padding:25px 0;box-sizing:border-box;">
    <h1 style="text-align:center;margin-bottom:25px;color:#464646;font-size:22px">{{$appname}}</h1>
    <section style="max-width:600px;margin:auto;background-color:#fff;padding:25px;box-sizing:border-box;border-radius:10px">
        <div style="color:#718096">
            <p><strong>Hola!</strong>, {{$user}}</p>
            <p>Para cambiar tu clave por favor dar click en el siguiente enlace</p>
        </div>
        <div style="display:flex;margin:25px auto"><a href="{{$url}}" style="display:block;padding:8px 15px;text-align:center;color:#fff;background-color:#35b15f;text-decoration:none;border-radius:5px" target="_blank">Cambiar clave</a></div>
        <div style="color:#718096">
            <p>Si tienes alguna dificultad, por favor inténtalo pegando y copiando en tu navegador la siguiente dirección: {{$url}}</p>
            <p>Si no hiciste este requerimiento, puedes ignorarlo ya que expirará en 1 horas.</p>
        </div>
    </section>
    <footer style="font-size:12px;text-align:center;color:#718096;margin-top:30px;margin-bottom:30px">
        © {{$anio}} <span>{{$appname}}</span>. All rights reserved.
    </footer>
</div>