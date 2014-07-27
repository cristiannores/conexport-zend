<?php

/* 
 * Creado por Cristian Nores.
 * @cristiannores

 */
return array(
    'visitante'=> array(
        "allow"=>array(
            "sitio-inicio",
            "sitio-acerca",
            "sitio-servicios",
            "sitio-contacto",
            "sitio-ingreso",
            "admin-login",
            
        ),
        "deny"=>array(
            "admin-inicio",
            "admin-bodega",
            "admin-cliente",
            "admin-usuario",
            "admin-administrador",
            "admin-material",
            "admin-nave",
            "admin-lote",
            "admin-contenedor",
            "admin-reporte-consolidacion",
            "admin-reporte-desconsolidacion",
            "admin-reporte-detaildamage",
            "admin-reporte-detaildiference",
            "admin-estadistica-global",
            'csn-file-manager',
        )
    ),
    'gerente'=> array(
        "allow"=>array(
            "sitio-inicio",
            "sitio-acerca",
            "sitio-servicios",
            "sitio-contacto",
            "sitio-ingreso",
            "paginator",
            "admin-inicio",
            "admin-login",
            "admin-bodega",
            "admin-cliente",
            "admin-usuario",
            "admin-administrador",
            "admin-material",
            "admin-nave",
            "admin-lote",
            "admin-contenedor",
            "admin-reporte-consolidacion",
            "admin-reporte-desconsolidacion",
            "admin-reporte-detaildamage",
            "admin-reporte-detaildiference",
            "admin-estadistica-global",
            'csn-file-manager',
            'csn-file-manager/default',
        ),
        "deny"=>array(
  

        )
    ),
    'supervisor'=> array(
        "allow"=>array(
            "sitio-inicio",
            "sitio-acerca",
            "sitio-servicios",
            "sitio-contacto",
            "sitio-ingreso",
            "admin-inicio",
            "admin-login",
            "admin-lote",
            "admin-contenedor",
            "admin-administrador",
            "admin-material",
            "admin-nave",
            "admin-reporte-consolidacion",
            "admin-reporte-desconsolidacion",
            "admin-reporte-detaildamage",
            "admin-reporte-detaildiference",
            "admin-estadistica-global",
            "admin-bodega",
            "admin-cliente",
            "paginator",
            'csn-file-manager',
            'csn-file-manager/default',
        ),
        "deny"=>array(
  
        "admin-usuario",
        )
    ),
    'inspector'=> array(
        "allow"=>array(
            "sitio-inicio",
            "sitio-acerca",
            "sitio-servicios",
            "sitio-contacto",
            "sitio-ingreso",
            "admin-inicio",
            "admin-login",
            "admin-lote",
            "admin-contenedor",
            "paginator",
        ),
        "deny"=>array(
            "admin-bodega",
            "admin-cliente",
            "admin-usuario",
            "admin-administrador",
            "admin-material",
            "admin-nave",
            "admin-reporte-consolidacion",
            "admin-reporte-desconsolidacion",
            "admin-reporte-detaildamage",
            "admin-reporte-detaildiference",
            "admin-estadistica-global",
            'csn-file-manager',
            
        )
    ),
    'cliente'=> array(
        "allow"=>array(
            "sitio-inicio",
            "sitio-acerca",
            "sitio-servicios",
            "sitio-contacto",
            "sitio-ingreso",
            "paginator",
            "admin-reporte-consolidacion",
            "admin-reporte-desconsolidacion",
            "admin-reporte-detaildamage",
            "admin-reporte-detaildiference",
            "admin-login",
            "admin-inicio",
        ),
        "deny"=>array(
            "admin-bodega",
            "admin-cliente",
            "admin-usuario",
            "admin-administrador",
            "admin-material",
            "admin-nave",
            "admin-estadistica-global",
            'csn-file-manager',
            "admin-lote",
            "admin-contenedor",
            
        )
    ),

);
