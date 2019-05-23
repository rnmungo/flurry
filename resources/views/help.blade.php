@extends('layouts.app')
@section('title', 'Ayuda')

@section('scripts')
    <script src="{{ asset('js/help.js') }}" defer></script>
@endsection
@section('style')
    <link href="{{ asset('css/help.css') }}" rel="stylesheet">
@endsection

@section('content') 
    <div class="row justify-content-center my-5">
        <h2>Sección de Ayuda</h2>
    </div>
    <div class="container">
        <div class="card border-primary my-3" style="width: 25rem;">
            <div class="card-header">Índice</div>
            <div class="card-body">
                1 - <a href="#listado_pedidos">Listado de Pedidos</a></br>
                2 - <a href="#nuevo_pedido"   >Generar Nuevo Pedido</a></br>
                3 - <a href="#pedido_detalle" >Detalle de Pedido</a></br>
                4 - <a href="#nuevo_cliente"  >Carga de Clientes</a></br>
                @if(Auth::user()->hasAnyRole(['Admin', 'Supervisor', 'Manager']))
                5 - <a href="#productos"      >Carga de Productos</a></br>
                6 - <a href="#gustos"         >Carga de Gustos</a></br>
                7 - <a href="#motivos_cadetes">Motivos de Cancelación y Cadetes</a></br>
                8 - <a href="#configuraciones">Configuraciones</a></br>
                9 - <a href="#config_personal">Configuracion Personal</a>
                @else
                5 - <a href="#config_personal">Configuracion Personal</a>
                @endif

            </div>
        </div>

        <div id="modal-div" class="modal">
            <span id="modal-close" class="close" title="Cerrar imagen">&times;</span>
            <img id="modal-img" class="modal-content">
            <div id="modal-caption"></div>
        </div>

        <div class="row mt-3">
            <div class="col-sm-12 text-left">
                <hr class="hr-fading">
                <section>
                    <h3 id="listado_pedidos">Listado de pedidos</h3>
                    <p>En la pantalla <b>Pedidos</b> pueden visualizarse todos los pedidos actuales, diferenciados por el estado en el que se encuentran. En la parte superior pueden generarse <a href="#nuevo_pedido">nuevos pedidos</a>.</br>
                    Esta página se recarga automáticamente cada 60 segundos. Esta funcionalidad puede @if(Auth::user()->hasAnyRole(['Admin', 'Supervisor', 'Manager']))<a href="#configuraciones">desactivarse</a>@else<b><u>desactivarse</u></b>@endif.</br>
                    En el caso de <b>pedidos entregados</b> se muestran sólo los del día actual, considerando que los días empiezan y terminan a las 6:00 am.
                    En cuanto a los <b>pedidos cancelados</b>, se listan aquellos que se encuentren en un rango de tres días hacia atrás. Esto puede @if(Auth::user()->hasAnyRole(['Admin', 'Supervisor', 'Manager']))<a href="#configuraciones">configurarse</a>@else<b><u>configurarse</u></b>@endif.</p>
                    <img class="border border-info help my-5" src="/imagenes/ayuda/listado_pedidos.png" alt="Listado de Pedidos" data-toggle="tooltip" data-placement="top" title="Click para ver imagen en pantalla completa" onclick="displayModal(this);" />
                    <p>Desde cualquier pedido puede clickearse el número del mismo para acceder al <a href="#pedido_detalle">detalle</a> del mismo.</br>
                    Los pedidos no entregados se colorean <span class="text-danger"><b>en rojo</b></span> cuando están atrasados, es decir, se crearon o reservaron hace más de un día.</br>
                    Además, este listado contiene información y acciones propias del <em>estado</em> de cada pedido.</p>
                    <dl>
                        <dt>Pedidos en preparación</dt>
                        <dd>Con el botón <img class="text-img" src="/imagenes/iconos/right-arrow.png" /> el pedido pasará a estado <b>Preparado</b>.</dd>
                        <dt>Pedidos preparados</dt>
                        <dd>
                            Al asignar un cadete, se ofrecerá la opción de <b>enviar</b> el pedido.<br>
                            Si se elige solamente asignar cadete, el pedido permanecerá en estado <b>Preparado</b> y se deberá pasar a <b>Enviado</b> de forma manual, es decir, accediendo al <a href="#pedido_detalle">detalle</a> del pedido.
                        </dd>
                        <dt>Pedidos enviados</dt>
                        <dd>
                            <b>Demora envío:</b> Se calcula en tiempo real. Es el tiempo transcurrido desde que se envió el pedido.<br>
                            <b>Demora total:</b> Se calcula en tiempo real. Es el tiempo transcurrido desde que se creó el pedido.
                        </dd>                   
                        <dd>Con el botón <img class="text-img" src="/imagenes/iconos/delivered.png" /> el pedido pasará a estado <b>Entregado</b>.</dd>
                        <dt>Pedidos entregados</dt>
                        <dd>Como el pedido ya fue entregado, se muestra el tiempo que transcurrió desde que se envió el pedido hasta que se finalizó, y desde que se creó hasta que finalizó, respectivamente.</dd>
                        <dt>Pedidos cancelados</dt>
                        <dd>Presionando <img class="text-img" src="/imagenes/iconos/back-1.png" /> el pedido se re-abrirá, pasando a estado <b>En preparación</b>.</dd>
                    </dl>
                    </br>
                    <h5>Listado de pedidos <label class="text-muted"> - En estado borrador</label></h5>
                    <p>En esta ventana, aparecen los pedidos en estado <b>borrador</b>. Los pedidos en estado borrador, son aquellos que se crearon y aún no han sido confirmados.</p>
                    <p>Para visualizar un listado con estos pedidos, puede hacerlo yendo al link de <b>Pedidos (Borrador)</b> ubicado en la barra de navegación.</p>
                    <img class="border border-info help my-5" src="/imagenes/ayuda/listado_pedidos2.png" alt="Listado de Pedidos en Estado Borrador" data-toggle="tooltip" data-placement="top" title="Click para ver imagen en pantalla completa" onclick="displayModal(this);" />
                    <p>Cabe aclarar que este listado debe ser revisado periódicamente, ya que si hubiesen pedidos en estado borrador que no hayan sido confirmados en ningún momento (por ejemplo, si ocurre un corte de luz mientras se toma un pedido), se deben de cancelar indicando un motivo a elección o retomar para finalizar.</p>
                    <div class="row my-5">
                        <div class="col-6 text-justify">
                            <h4>Cancelación</h4>
                            <p>Al hacer clic en el botón <label class="bg-danger text-white text-center rounded" style="width: 1.5rem;"><i class="fas fa-times"></i></label> para cancelar el pedido, aparecerá una ventana como la siguiente, consultando el motivo por el cual se está queriendo cancelar.</p></br>
                            <p>También se ofrece la posibilidad de retomar el pedido presionando el botón <b>editar</b> <label class="bg-info text-white text-center rounded" style="width: 1.5rem;"><i class="far fa-edit"></i></label>.</p>
                        </div>
                        <div class="col-6">
                            <img class="border border-info help" src="/imagenes/ayuda/listado_pedidos3.png" alt="Cancelación del Pedido" data-toggle="tooltip" data-placement="top" title="Click para ver imagen en pantalla completa" onclick="displayModal(this);" />
                        </div>
                    </div>
                    <a href="#navbarSupportedContent">Volver al índice...</a>
                    <hr class="hr-fading mt-4">
                </section>
                <section>                   
                    <h3 id="nuevo_pedido">Generar nuevo pedido</h3>
                    <p>Dentro del <a href="#listado_pedidos">Listado de Pedidos</a>, debe ingresar el número de teléfono o celular del contacto en la celda que indica 'Ingresar tel. / cel.'. El número debe contener entre 6 y 8 dígitos, por lo tanto, si el número pertenece a un celular, se debe colocar el número sin el prefijo '15'.</br>
                    Una vez colocado el número, deben presionar el botón 'Armar Pedido' o presionar ENTER. Si el cliente no se encuentra cargado en el sistema, la página lo redireccionará al formulario para cargar los datos. Para ver cómo realizar la carga, lea la siguiente <a href="#nuevo_cliente">sección</a>.</br>
                    Si el cliente se encontraba cargado (o luego de finalizar la carga de datos del cliente), los redireccionará a la ventana de preparación del pedido.</p>
                    <img class="border border-info help mt-5" src="/imagenes/ayuda/edicion_pedido_1.png" alt="Ventana de Edición del Pedido" data-toggle="tooltip" data-placement="top" title="Click para ver imagen en pantalla completa" onclick="displayModal(this);" />
                    <div class="row mt-5">
                        <div class="col-6 text-justify">
                            <h4>Selección de productos</h4>
                            <p>Aquí podrá seleccionar los productos. Al hacer clic sobre ellos, se añadirán al listado que se encuentra del lado derecho de la ventana.</br>Para un acceso rápido, también puede filtrar el nombre/alias del producto que está buscando con el buscador que se encuentra en la parte superior de la sección de productos.</br>Los productos automáticamente se ordenan por preferencia, esto quiere decir, que se ordenarán en base a cuales son los productos que más pide el cliente, en segundo lugar se ordenarán por los productos que más se piden en general y en tercer lugar por nombre.</p>
                        </div>
                        <div class="col-6">
                            <img class="border border-info help" src="/imagenes/ayuda/edicion_pedido_2.png" alt="Sección de Productos - Edición de Pedido" data-toggle="tooltip" data-placement="top" title="Click para ver imagen en pantalla completa" onclick="displayModal(this);" />                           
                        </div>
                    </div>
                    <div class="row my-5">
                        <div class="col-6">
                            <img class="border border-info help" src="/imagenes/ayuda/edicion_pedido_3.png" alt="Productos Seleccionados - Edición de Pedido" data-toggle="tooltip" data-placement="top" title="Click para ver imagen en pantalla completa" onclick="displayModal(this);" />                            
                        </div>
                        <div class="col-6 text-justify">
                            <h4>Productos seleccionados</h4>
                            <p>En este sector podrá gestionar los productos que fueron seleccionados. Si el producto lleva gustos y/o agregados, podrá configurar estos mismos haciendo clic en esta acción <img class="text-img" src="/imagenes/iconos/ice-cream1.png" />. También puede eliminar un producto haciendo clic en el botón <img class="text-img" src="/imagenes/iconos/eliminar-rojo.png" />.</p>
                        </div>
                    </div>
                    <h4>Configuración de gustos/agregados</h4>
                    <p>Al hacer clic en el botón <img class="text-img" src="/imagenes/iconos/ice-cream1.png" />, se abrirá una ventana donde podrá seleccionar los gustos del producto. Los gustos se ordenan automáticamente por preferencia, es decir, los gustos más pedidos por el cliente, luego los gustos más pedidos en general y por último en orden alfabético.</br>
                    También podrá seleccionar agregados del producto, o bien hacer clic sobre el gusto e indicar si el cliente tiene una preferencia sobre el gusto, es decir, si le gustaría que el producto se conforme por más o menos gusto del indicado. A continuación, podrá ver esto mismo en las imágenes.</br></p>
                    <div class="row mt-5">
                        <div class="col-6">
                            <img class="border border-info help" src="/imagenes/ayuda/edicion_pedido_6.png" alt="Selección de Gustos - Edición de Pedido" data-toggle="tooltip" data-placement="top" title="Click para ver imagen en pantalla completa" onclick="displayModal(this);" />
                        </div>
                        <div class="col-6">
                            <img class="border border-info help" src="/imagenes/ayuda/edicion_pedido_7.png" alt="Selección de Agregados - Edición de Pedido" data-toggle="tooltip" data-placement="top" title="Click para ver imagen en pantalla completa" onclick="displayModal(this);" />
                        </div>
                    </div>
                    <div class="row mt-5">
                        <div class="col-6 text-justify">
                            <h4>Acciones de un gusto dentro del gráfico</h4>
                            <p>Al hacer clic en un gusto dentro del gráfico de torta, el sistema le ofrecerá tres opciones importantes. En primer lugar, puede indicar si el cliente prefiere llevar más o menos de un gusto en particular (el que se haya clickeado). En segundo lugar, se puede eliminar el gusto seleccionado.</p>
                        </div>
                        <div class="col-6">
                            <img class="border border-info help" src="/imagenes/ayuda/edicion_pedido_9.png" alt="Acciones disponibles al hacer clic en un gusto del gráfico" data-toggle="tooltip" data-placement="top" title="Click para ver imagen en pantalla completa" onclick="displayModal(this);" />
                        </div>
                    </div>
                    <div class="row mt-5">
                        <div class="col-6">
                            <img class="border border-info help" src="/imagenes/ayuda/edicion_pedido_8.png" alt="Producto configurado completamente" data-toggle="tooltip" data-placement="top" title="Click para ver imagen en pantalla completa" onclick="displayModal(this);" />
                        </div>
                        <div class="col-6 text-justify">
                            <h4>Producto configurado</h4>
                            <p>Una vez seleccionado los gustos y/o agregados e indicado alguna referencia (si así se lo pidiesen), el producto quedará totalmente configurado. Debe realizar estos pasos con todos los productos que lleven gustos.</p>
                        </div>
                    </div>
                    <div class="row my-5">
                        <div class="col-6 text-justify">
                            <h4>Formulario del pedido</h4>
                            <p>Por último, deberá completar la sección de datos de pago/entrega. Los datos de la entrega se completan automáticamente con la información del cliente, pero puede modificarlos dentro del pedido.</br>
                            En la solapa 'Pago', deberá completar obligatoriamente: <b>Monto de pago</b>, <b>tipo de pago</b> (por defecto Efectivo) y <b>tipo de pedido</b> (por defecto Delivery).</br>
                            En cuanto al campo <b>Fecha y Hora de Reserva</b>, si es completado, el pedido será reservado automáticamente cuando sea confirmado.</br>
                            Una vez completados los datos, puede confirmar el pedido para finalizar la operación.</p>
                        </div>
                        <div class="col-6">
                            <img class="border border-info help" src="/imagenes/ayuda/edicion_pedido_4.png" alt="Formulario de pedido - Sección de Pago" data-toggle="tooltip" data-placement="top" title="Click para ver imagen en pantalla completa" onclick="displayModal(this);" />
                        </div>
                    </div>
                    <h4 class="mt-4">Modificación de datos del cliente (Opcional)</h4>
                    <p>Dentro de la ventana de configuración del pedido, podrá acceder a los datos del cliente para modificarlos y guardarlos. En la siguiente imagen se muestra el link con el nombre completo del cliente, el cuál, al hacer clic, despliega una ventana que contiene todos los datos. Esto permitiría normalizar la información para que los datos estén cargados correctamente, ya que deben cumplir ciertas validaciones.</p>
                    <img class="border border-info help my-5" src="/imagenes/ayuda/edicion_pedido_10.png" alt="Link del Cliente" data-toggle="tooltip" data-placement="top" title="Click para ver imagen en pantalla completa" onclick="displayModal(this);" />
                    <p>Aquí se podrá encontrar con dos íconos, los cuales indican: Comprador frecuente <img class="text-img" src="/imagenes/iconos/checked.png" /> y alerta por bromista <img class="text-img" src="/imagenes/iconos/alert.png" />.</br></br>
                    Luego de hacer clic, se abrirá la ventana de edición de datos del cliente.</p>
                    <img class="border border-info help my-5" src="/imagenes/ayuda/edicion_pedido_11.png" alt="Formulario del Cliente" data-toggle="tooltip" data-placement="top" title="Click para ver imagen en pantalla completa" onclick="displayModal(this);" />
                    <a href="#navbarSupportedContent">Volver al índice...</a>
                    <hr class="hr-fading mt-4">
                </section>
                <section>
                    <h3 id="pedido_detalle">Detalle del pedido</h3>
                    <p>En la vista detallada de un <b>Pedido</b> pueden visualizarse todos los datos disponibles del mismo. En la parte superior vemos que están divididos por pestañas.</br>
                    Los datos de entrega no necesariamente coinciden con la dirección del cliente, por eso desde acá podés ver ambos. Podés ver en la pestaña <b>Mapa</b> donde se entregó exactamente el pedido.</br>
                    Desde la pestaña <b>Contacto</b>, además de ver teléfonos y e-mail, podés acceder a las redes sociales del cliente.</p>
                    <div class="row mt-5">
                        <div class="col-6 my-auto">
                            <img class="border border-info img-fluid help" src="/imagenes/ayuda/vista_pedido_1.png" alt="Vista Detalle de un Pedido" data-toggle="tooltip" data-placement="top" title="Click para ver imagen en pantalla completa" onclick="displayModal(this);" />
                        </div>
                        <div class="col-6 my-auto">
                            <div class="col-12">
                                <img class="border border-info help" src="/imagenes/ayuda/vista_pedido_3.png" alt="Pestaña Contacto en Vista Detalle de un Pedido" data-toggle="tooltip" data-placement="top" title="Click para ver imagen en pantalla completa" onclick="displayModal(this);" />
                            </div>
                            <div class="col-12">
                                <img class="border border-info help" src="/imagenes/ayuda/vista_pedido_4.png" alt="Punto exacto de entrega de un Pedido." data-toggle="tooltip" data-placement="top" title="Click para ver imagen en pantalla completa" onclick="displayModal(this);" />
                            </div>
                        </div>
                    </div>
                    <div class="row my-5">
                        <div class="col-6 text-justify">
                            <h4>Detalle de productos</h4>
                            <p>En la sección <b>Detalle</b> se listan los productos comprendidos en el pedido. Si posicionás el mouse sobre ellos, podés ver el importe del producto. Si tiene gustos y/o agregados, también los vas a ver, y además si clickeás la imagen vas a ver la distribución de los gustos en el pote, tal como se ve al cargar un pedido.</p>
                        </div>
                        <div class="col-6 text-center">
                            <img class="border border-info help" src="/imagenes/ayuda/vista_pedido_2.png" alt="Detalle del Producto" data-toggle="tooltip" data-placement="top" title="Click para ver imagen en pantalla completa" onclick="displayModal(this);" />                         
                        </div>
                    </div>
                    <h4>Acciones</h4>
                    <p class="mb-1">Por último, la sección <b>Acciones</b> varía dependiendo del estado del pedido.</p>
                    <dl>
                        <dt>Borrador</dt>
                        <dd>Con el pedido en este estado, podés: <b>Cancelar</b> el pedido o <b>editarlo</b>.</dd>
                        <dt>En preparación / Preparado</dt>
                        <dd>En cualquiera de estos estados, podés: <b>Cancelar</b> el pedido, <b>editarlo</b>, asignar un cadete e indicar que fue <b>enviado</b> (en este último el pedido pasará a estado <b>Enviado</b> inmediatamente). También podés <b>imprimir</b> su remito.</dd>
                        <dt>Enviado</dt>
                        <dd>Si el pedido está enviado, podés: <b>Cancelarlo</b>, <b>imprimirlo</b> o <b>finalizarlo</b> (el pedido pasará a estado <b>Listo</b>).</dd>
                        <dt>Entregado</dt>
                        <dd>En esta instancia el pedido se considera finalizado. Podés <b>imprimirlo</b>.</dd>
                        <dt>Cancelado</dt>
                        <dd>Los pedidos cancelados pueden re-abrirse. En caso de re-abrirlo, el pedido pasa a estado <b>En preparación</b> para que puedas editar lo que necesites.</dd>
                    </dl>
                    <a href="#navbarSupportedContent">Volver al índice...</a>
                    <hr class="hr-fading mt-4">
                </section>
                <section>
                    <h3 id="nuevo_cliente">Carga de clientes</h3>
                    <p>Para la carga de clientes en el sistema, deberá tener en cuenta que los datos más importantes son, el nombre, apellido, teléfono fijo o celular respectivamente, calle, número de calle y localidad.
                    Con estos datos podrá realizar las acciones estándar. A continuación, explicaremos en detalle cada sección de datos a completar.</p>
                    <div class="row mt-5">
                        <div class="col-6 text-justify">
                            <h4>Información de contacto</h4>
                            <p>En esta sección, el nombre, apellido y teléfono/celular son importantes.
                            El teléfono o celular se utilizarán en el sistema para identificar al cliente en la toma del pedido.</br>
                            En cuanto al e-mail, si bien es opcional, se utilizará para el envío de e-mails a los clientes informando novedades o descuentos.</p>
                        </div>
                        <div class="col-6 text-center">
                            <img class="border border-info help" src="/imagenes/ayuda/clientes_1.png" alt="Datos personales del cliente" data-toggle="tooltip" data-placement="top" title="Click para ver imagen en pantalla completa" onclick="displayModal(this);" />                         
                        </div>
                    </div>
                    <div class="row mt-5">
                        <div class="col-6 text-center">
                            <img class="border border-info help" src="/imagenes/ayuda/clientes_2.png" alt="Domicilio del cliente" data-toggle="tooltip" data-placement="top" title="Click para ver imagen en pantalla completa" onclick="displayModal(this);" />
                        </div>
                        <div class="col-6 text-justify">
                            <h4>Comencemos a 'Mapear'</h4>
                            <p>Aquí los datos obligatorios son, la calle, el número de calle y la localidad. Estos tres datos son importantes para geolocalizar al cliente y poder guardar las coordenadas de su domicilio presionando el botón <b>~Geolocalizar~</b>. Esta acción también mostrará en pantalla un mapa de Google con la ubicación dada.</br>
                            El resto de los campos son opcionales y sirven a modo de información, para que, cuando se tome un pedido, se tenga una mayor precisión a la hora de enviarlo.</p>
                        </div>
                    </div>
                    <div class="row my-5">
                        <div class="col-6 text-justify">
                            <h4>Dale un like <i class="fas fa-thumbs-up"></i> a tu sistema!</h4>
                            <p>Este apartado servirá para almacenar tres medios de contacto más, Facebook, Instagram y Twitter.</br>
                            A modo de ejemplo, el dato que el cliente nos debe brindar es el siguiente:
                            Si nos facilitan un nombre de usuario en Instagram, la dirección que ven las personas desde el navegador es www.instagram.com/<b>{usuario}</b>/</br>
                            El dato que nos deben proporcionar es solo la sección que está entre llaves.</br>
                            Una vez tengamos este dato, lo ingresamos y presionamos el botón <b>~Validar~</b>, el cual nos llevará, en este caso, a la página de Instagram del cliente. Si efectivamente es un usuario de Instagram, debemos de marcar el check que se encuentra al lado del botón para indicar que se encuentra validado.</p>
                        </div>
                        <div class="col-6 text-center">
                            <img class="border border-info help" src="/imagenes/ayuda/clientes_3.png" alt="Redes sociales del cliente" data-toggle="tooltip" data-placement="top" title="Click para ver imagen en pantalla completa" onclick="displayModal(this);" />
                        </div>
                    </div>
                    <h5>Listado de clientes</h5>
                    <p>Si vamos a la opción <b>Clientes</b> desde el navegador, nos llevará a un listado completo de clientes, donde podrémos filtrar por nombre, apellido, teléfono, entre otros campos.</p>
                    <img class="border border-info help my-5" src="/imagenes/ayuda/clientes_4.png" alt="Listado de Clientes" data-toggle="tooltip" data-placement="top" title="Click para ver imagen en pantalla completa" onclick="displayModal(this);" />
                    <p>Desde este listado, se pueden realizar distintas acciones, tales como eliminar <label class="bg-danger text-white text-center rounded" style="width: 1.5rem;"><i class="far fa-trash-alt"></i></label> un cliente, ir a la ventana de edición <label class="bg-info text-white text-center rounded" style="width: 1.5rem;"><i class="far fa-edit"></i></label> para completar datos, o ir a la vista no editable del cliente haciendo clic en el número de teléfono o celular. En esta vista se detalla más información asociada al cliente, la cual detallaremos a continuación.</p>
                    <div class="row mt-5 mb-3">
                        <div class="col-6 text-center">
                            <img class="border border-info help" src="/imagenes/ayuda/clientes_5.png" alt="Vista no editable de un cliente" data-toggle="tooltip" data-placement="top" title="Click para ver imagen en pantalla completa" onclick="displayModal(this);" />
                        </div>
                        <div class="col-6 text-justify">
                            <h4>Vista no editable de un cliente</h4>
                            <p>Aquí podremos ver todos los datos del cliente agrupados por secciones (datos personales, domicilio, redes sociales y un mapa donde se muestra la dirección si está cargada). También se pueden visualizar datos estadísticos, como la fecha en que se dio de alta, el último pedido que realizó, la cantidad de dinero que lleva gastando en productos, entre otros datos, además de poder ver en la solapa siguiente un listado con los últimos pedidos.</br>Por último, en la sección de acciones se puede presionar el botón <b>~Editar~</b> para dirigirse al formulario del cliente y editarlo.</p>
                        </div>
                    </div>
                    <a href="#navbarSupportedContent">Volver al índice...</a>
                    <hr class="hr-fading mt-4">
                </section>
                @if(Auth::user()->hasAnyRole(['Admin', 'Supervisor', 'Manager']))
                <section>
                    <h3 id="productos">Carga de productos</h3>
                    <p>En esta sección se hará enfoque en solo algunos datos relevantes, el alias, el peso y la activación de si lleva gustos o no.</br>Para acceder al listado de productos, podemos ir al link que se encuentra en la barra de navegación. Dentro del listado podrá realizar funciones básicas, como agregar un nuevo producto, editar o eliminar uno existente.</p>
                    <img class="border border-info help mt-5" src="/imagenes/ayuda/productos_1.png" alt="Listado de Productos" data-toggle="tooltip" data-placement="top" title="Click para ver imagen en pantalla completa" onclick="displayModal(this);" />
                    <div class="row my-5">
                        <div class="col-6 text-justify">
                            <h4>Formulario de carga/modificación de un producto</h4>
                            <p>Aquí se podrán completar datos como el nombre completo del producto, una descripción (opcional), su precio, entre otros datos.</br>El alias es un campo que, de completarse, será mostrado en pantalla cuando se listen los productos en la carga de un <a href="#nuevo_pedido">pedido</a>. Si el nombre del producto es tan extenso que dificulta la vista en pantalla, el alias entrará en juego y se mostrará.</br>En cuanto al peso del producto, este campo es destinado a fines estadísticos, para saber los pesos de productos que fueron vendidos. Los pesos se representan en gramos (g).</br>El interruptor que indica si el producto lleva gustos o no, está destinado a ofrecer la posibilidad de cargar gustos de helado a un producto, hasta un límite de entre 1 y 5 gustos, indicados en el campo debajo.</p>
                        </div>
                        <div class="col-6 text-center">
                            <img class="border border-info help" src="/imagenes/ayuda/productos_2.png" alt="Formulario de Carga/Modificación de un Producto" data-toggle="tooltip" data-placement="top" title="Click para ver imagen en pantalla completa" onclick="displayModal(this);" />
                        </div>
                    </div>
                    <a href="#navbarSupportedContent">Volver al índice...</a>
                    <hr class="hr-fading mt-4">
                </section>
                <section>
                    <h3 id="gustos">Carga de gustos</h3>
                    <p>En la siguiente imagen, se puede ver un listado con todos los gustos que se encuentran cargados en el sistema. En él se se pueden realizar funciones básicas como agregar un nuevo gusto, editar o eliminar un gusto.</p>
                    <img class="border border-info help mt-5" src="/imagenes/ayuda/gustos_1.png" alt="Listado de Gustos" data-toggle="tooltip" data-placement="top" title="Click para ver imagen en pantalla completa" onclick="displayModal(this);" />
                    <div class="row my-5">
                        <div class="col-6 text-center">
                            <img class="border border-info help" src="/imagenes/ayuda/gustos_2.png" alt="Formulario de Carga/Modificación de un Gusto" data-toggle="tooltip" data-placement="top" title="Click para ver imagen en pantalla completa" onclick="displayModal(this);" />
                        </div>
                        <div class="col-6 text-justify">
                            <h4>Formulario de carga/modificación de un gusto</h4>
                            <p>Este Formulario consta de cuatro campos, el nombre del gusto, una descripción opcional, el color del gusto y un interruptor que indica si lleva texto en blanco.</br> En cuanto al color del gusto, este es un campo que solo influye en el color que aparecerá de fondo en todos los lugares donde se visualice un gusto, por ejemplo, dentro del armado de un pedido o mismo en el listado de los gustos.</br>Por otra parte, el interruptor que indica si tiene texto blanco, servirá para configurar si el color del texto será blanco o negro. Si un color de gusto es oscuro, deben de activar el interruptor de texto blanco para que sea legible.</p>
                        </div>
                    </div>
                    <a href="#navbarSupportedContent">Volver al índice...</a>
                    <hr class="hr-fading mt-4">
                </section>
                <section>
                    <h3 id="motivos_cadetes">Motivos de Cancelación y Cadetes</h3>
                    <p>Tanto los <b>motivos de cancelación</b> como los <b>cadetes</b> tienen las mismas funcionalidades y comportamiento. En este caso, usaremos como ejemplo el listado de cadetes.</p>
                    <div class="row mt-5">
                        <div class="col-6 text-center">
                            <img class="border border-info help" src="/imagenes/ayuda/motivos_cadetes_1.png" alt="Listado de Cadetes" data-toggle="tooltip" data-placement="top" title="Click para ver imagen en pantalla completa" onclick="displayModal(this);" />
                        </div>
                        <div class="col-6 text-left">
                            <h4>Listado de cadetes, carga, modificación y eliminación</h4>
                            <p>En la siguiente ventana, se puede visualizar el listado de todos los cadetes cargados en el sistema. Desde este listado, podemos editar los cadetes actuales, eliminarlos o cargar nuevos cadetes presionando el botón <b>~Nuevo~</b>. Si cargamos un nuevo cadete, les aparecerá un mensaje en pantalla solicitando el nombre.</br>Lo mismo sucederá en caso de querer modificarlo <label class="bg-info text-white text-center rounded" style="width: 1.5rem;"><i class="far fa-edit"></i></label> o eliminarlo <label class="bg-danger text-white text-center rounded" style="width: 1.5rem;"><i class="far fa-trash-alt"></i></label>.</p>
                        </div>
                    </div>
                	<div class="row my-5">
                        <div class="col-6 text-left">
                            <h4>Carga de cadetes</h4>
                            <p>La ventana siguiente es la que solicita el nombre del cliente. Esta misma ventana aparecerá en el caso de querer editar un cliente. Para el caso de eliminar un cliente solo se preguntará si se esta seguro de eliminarlo.</p>
                        </div>
                        <div class="col-6 text-center">
                			<img class="border border-info help" src="/imagenes/ayuda/motivos_cadetes_2.png" alt="Carga de Cadetes" data-toggle="tooltip" data-placement="top" title="Click para ver imagen en pantalla completa" onclick="displayModal(this);" />
                        </div>
                    </div>
                    <a href="#navbarSupportedContent">Volver al índice...</a>
                    <hr class="hr-fading mt-4">
                </section>
                <section>
                    <h3 id="configuraciones">Configuraciones</h3>
                    <p>Las configuraciones del sistema permiten establecer distintos comportamientos en su uso. A continuación, luego de ver la imagen de las configuraciones posibles, detallaré cada punto configurable.</p>
                    <img class="border border-info help my-5" src="/imagenes/ayuda/configuraciones_1.png" alt="Configuraciones Posibles" data-toggle="tooltip" data-placement="top" title="Click para ver imagen en pantalla completa" onclick="displayModal(this);" />
                    <dl>
                        <dt>~Tiempo de refresco~</dt>
                        <dd>Es el tiempo que demoran en refrescar automáticamente los listados de pedidos. Se representa en segundos. Para desactivarlo se debe colocar el valor cero.</dd>
                        <dt>~Días de pedidos cancelados~</dt>
                        <dd>Representa la cantidad de días hacia atrás a partir de la fecha actual en que se muestran los pedidos cancelados en el listado.</dd>
                        <dt>~Demoras admisibles~</dt>
                        <dd>El valor configurado indica la cantidad de minutos de demora permitida para los pedidos, si un pedido demora en total más tiempo que el configurado, se coloreará el pedido en naranja sobre el listado.</dd>
                        <dt>~Pedidos por página~</dt>
                        <dd>Representa la cantidad de filas visibles en los listados de pedidos, es decir, la cantidad de filas que se mostrarán por página.</dd>
                        <dt>~Alertas en pedidos pendientes~</dt>
                        <dd>Esta configuración activa o desactiva las alertas en el envío de pedidos y asignación de cadetes. Si se desactiva, no mostrará ventanas emergentes cuando se ejecuten estas acciones.</dd>
                    </dl>
                    <p>Estos valores pueden restablecerse por defecto presionando el botón <b>~Restablecer configuración~</b>.</br>Desde esta ventana se puede acceder al listado de usuarios presionando el botón <b>~Ver usuarios~</b>.</p>
                    <div class="row mt-5">
                        <div class="col-6 text-center">
                            <img class="border border-info help" src="/imagenes/ayuda/configuraciones_2.png" alt="Listado de Usuarios" data-toggle="tooltip" data-placement="top" title="Click para ver imagen en pantalla completa" onclick="displayModal(this);" />
                        </div>
                        <div class="col-6 text-justify">
                            <h4>Listado de usuarios</h4>
                            <p>En este listado tendrán acceso a realizar acciones comunes como crear un usuario, modificarlo o eliminarlo, excepto su usuario propio.</br>En cuanto al usuario propio, solo se puede modificar el avatar y la contraseña. Puede ver esto mismo en la siguiente <a href="#config_personal">sección</a></p>
                        </div>
                    </div>
                    <div class="row my-5">
                        <div class="col-6 text-justify">
                            <h4>Crear un usuario</h4>
                            <p>Aquí podrá completar un nombre de usuario, puede contener el nombre de la persona, un apodo o un alias (es a elección).</br>En cuanto al e-mail, este debe ser real, ya que se utilizará para el envío y recepción de e-mails dentro del sistema.</br>La contraseña viene acompañada de un detector de nivel de seguridad, el cual indicará si la contraseña es muy débil, débil, intermedia, fuerte o muy fuerte. Esta debe coincidir con el segundo campo de contraseña, de otra forma, no permitirá crear el usuario.</p>
                        </div>
                        <div class="col-6 text-center">
                            <img class="border border-info help" src="/imagenes/ayuda/configuraciones_3.png" alt="Formulario de Usuarios" data-toggle="tooltip" data-placement="top" title="Click para ver imagen en pantalla completa" onclick="displayModal(this);" />
                        </div>
                    </div>
                    <a href="#navbarSupportedContent">Volver al índice...</a>
                    <hr class="hr-fading mt-4">
                </section>
                @endif
                <section>
                	<h3 id="config_personal">Configuración Personal</h3>
                	<p>Todos los usuarios, pueden realizar dos configuraciones a gusto personal, las cuales son: Configurar el avatar y cambiar la contraseña. Deben acceder desde la barra de navegación en la parte superior-derecha.</p>
                	<img class="border border-info help mt-5" src="/imagenes/ayuda/config_personal_1.png" alt="Opciones de Usuario" data-toggle="tooltip" data-placement="top" title="Click para ver imagen en pantalla completa" onclick="displayModal(this);" />
                	<div class="row mt-5">
                        <div class="col-6 text-justify">
                            <h4>Avatar</h4>
                            <p>En esta ventana podrán seleccionar el avatar que desean para su usuario. Este avatar será visible solo en su usuario personal y pueden modificarlo con tan solo un clic.</p>
                        </div>
                        <div class="col-6 text-center">
                            <img class="border border-info help" src="/imagenes/ayuda/config_personal_2.png" alt="Selección de Avatar" data-toggle="tooltip" data-placement="top" title="Click para ver imagen en pantalla completa" onclick="displayModal(this);" />
                        </div>
                    </div>
                    <div class="row my-5">
                        <div class="col-6 text-center">
                            <img class="border border-info help" src="/imagenes/ayuda/config_personal_3.png" alt="Formulario de Modificación de Contraseña" data-toggle="tooltip" data-placement="top" title="Click para ver imagen en pantalla completa" onclick="displayModal(this);" />
                        </div>
                        <div class="col-6 text-justify">
                            <h4>Contraseña</h4>
                            <p>En este apartado, cabe remarcar que a la hora de modificar la contraseña, estas deben coincidir, de otra forma no podrán modificarla. Esta acción viene acompañada de un detector de nivel de seguridad, el cual indicará si su contraseña es muy débil, débil, intermedia, fuerte o muy fuerte. Una vez modifique la contraseña, la próxima vez que inicie sesión deberá hacerlo con la nueva contraseña.</p>
                        </div>
                    </div>
                	<a href="#navbarSupportedContent">Volver al índice...</a>
                    <hr class="hr-fading mt-4">
                </section>
            </div>
        </div>
    </div>
@endsection