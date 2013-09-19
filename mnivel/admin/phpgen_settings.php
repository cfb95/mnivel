<?php

//  define('SHOW_VARIABLES', 1);
//  define('DEBUG_LEVEL', 1);

//  error_reporting(E_ALL ^ E_NOTICE);
//  ini_set('display_errors', 'On');

set_include_path('.' . PATH_SEPARATOR . get_include_path());


require_once 'components/utils/system_utils.php';

//  SystemUtils::DisableMagicQuotesRuntime();

SystemUtils::SetTimeZoneIfNeed('Europe/Belgrade');

function GetGlobalConnectionOptions()
{
    return array(
  'server' => '192.168.56.1',
  'port' => '5432',
  'username' => 'admin',
  'password' => 'admin',
  'database' => 'mnivel'
);
}

function GetPageInfos()
{
    $result = array();
    $result[] = array('caption' => 'Planes', 'short_caption' => 'Planes', 'filename' => 'public.plan.php', 'name' => 'public.plan');
    $result[] = array('caption' => 'Tipos Documentos', 'short_caption' => 'Tipos Documentos', 'filename' => 'public.tipo_documento.php', 'name' => 'public.tipo_documento');
    $result[] = array('caption' => 'Tipos de Operaciones', 'short_caption' => 'Tipos de Operaciones', 'filename' => 'public.tipo_operacion.php', 'name' => 'public.tipo_operacion');
    $result[] = array('caption' => 'Clientes', 'short_caption' => 'Clientes', 'filename' => 'public.cliente.php', 'name' => 'public.cliente');
    $result[] = array('caption' => 'Forma Pago', 'short_caption' => 'Forma Pago', 'filename' => 'public.forma_pago.php', 'name' => 'public.forma_pago');
    $result[] = array('caption' => 'Pais', 'short_caption' => 'Pais', 'filename' => 'public.pais.php', 'name' => 'public.pais');
    return $result;
}

function GetPagesHeader()
{
    return
    '';
}

function GetPagesFooter()
{
    return
        ''; 
    }

function ApplyCommonPageSettings($page, $grid)
{
    $page->SetShowUserAuthBar(true);
    $grid->BeforeUpdateRecord->AddListener('Global_BeforeUpdateHandler');
    $grid->BeforeDeleteRecord->AddListener('Global_BeforeDeleteHandler');
    $grid->BeforeInsertRecord->AddListener('Global_BeforeInsertHandler');
}

/*
  Default code page: 1252
*/
function GetAnsiEncoding() { return 'windows-1252'; }

function Global_BeforeUpdateHandler($rowData, &$cancel, &$message)
{
//cf
}

function Global_BeforeDeleteHandler($rowData, &$cancel, &$message)
{
//cf
}

function Global_BeforeInsertHandler($rowData, &$cancel, &$message)
{
//cf
}

function GetDefaultDateFormat()
{
    return 'Y-m-d';
}
?>