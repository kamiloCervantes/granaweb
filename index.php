<?php

require_once 'lib/limonade.php';
// Application code goes here
function configure() {
    $env = $_SERVER['HTTP_HOST'] == 'certification-grana.org' ? ENV_DEVELOPMENT : ENV_PRODUCTION;
    $dsn = $env == ENV_PRODUCTION ? 'mysql:host=localhost;dbname=granawp' : 'mysql:host=localhost;dbname=granawp';
    $nombre_usuario = 'grana_limonade';
    $contrasena = 'danger89312011';
    $opciones = array(
        PDO::MYSQL_ATTR_INIT_COMMAND => 'SET NAMES utf8',
    ); 
    $db = new PDO($dsn, $nombre_usuario, $contrasena, $opciones);
    $db->setAttribute( PDO::ATTR_ERRMODE, PDO::ERRMODE_WARNING );
    option('env', $env);
    option('dsn', $dsn);
    option('db_conn', $db);
    option('debug', true);
}


 function not_found($errno, $errstr, $errfile=null, $errline=null)
    {
     $actual_link = "ftp://$_SERVER[HTTP_HOST]"."$_SERVER[REQUEST_URI]";
     $actual_link = str_replace('/sievas/public', '', $actual_link);
        set('errno', $errno);
        set('errstr', $errstr);
        set('errfile', $errfile);
        set('errline', $errline);
        var_dump($errno);
        var_dump($errstr);
        var_dump($errfile);
        var_dump($errline);
        var_dump($actual_link);
        header ("Location: ".$actual_link);
    }
    
    
function evaluadores_find_by_country($country)
{
  $pais = strtoupper($country);
	$db = option('db_conn');
	$sql = <<<SQL
	SELECT * 
	FROM grana_evaluadores 
  WHERE pais = :pais
	ORDER BY id ASC
SQL;
	$result = array();
	$stmt = $db->prepare($sql);
  $stmt->bindValue(':pais', $pais, PDO::PARAM_STR);
	if ($stmt->execute())
	{
		return $stmt->fetchAll(PDO::FETCH_ASSOC);
	}
	return false;
}   

function paises_find_all()
{
	$db = option('db_conn');
	$sql = <<<SQL
	SELECT * 
	FROM grana_evaluadores_paises 
	ORDER BY pais ASC
SQL;
	$result = array();
  $stmt = $db->prepare($sql);
	if ($stmt->execute())
	{
		return $stmt->fetchAll(PDO::FETCH_ASSOC);
	}
	return false;
}    

    
    
dispatch('/', 'index');
function index()
{
  return html('index.html.php', 'layout.php');
}

dispatch('/pages/weef2018', 'page_weef2018');
function page_weef2018()
{
  return html('weef.html.php', 'layout.php');
}

dispatch('/pages/famdh2017', 'page_famdh2017');
function page_famdh2017()
{
  return html('famdh.html.php', 'layout.php');
}

dispatch('/pages/galeria_videos', 'page_videos');
function page_videos()
{
  return html('videos.html.php', 'layout.php');
}

dispatch('/pages/contexto', 'page_contexto');
function page_contexto()
{
  return html('contexto.html.php', 'layout.php');
}

dispatch('/pages/mision', 'page_mision');
function page_mision()
{
  return html('mision.html.php', 'layout.php');
}

dispatch('/pages/directivos', 'page_directivo');
function page_directivo()
{
  return html('equipo.html.php', 'layout.php');
}

dispatch('/pages/evaluadores_old', 'page_evaluadores_old');
function page_evaluadores_old()
{
  return html('evaluadores.html.php', 'layout.php');
}

dispatch('/pages/evaluadores', 'page_evaluadores');
function page_evaluadores()
{
  $evaluadores = array();
  $paises = paises_find_all();

  foreach($paises as $p){
    $evaluadores[$p['pais']] = evaluadores_find_by_country($p['pais']);
  }
  set('paises', $paises);
  set('evaluadores', $evaluadores);
  return html('evaluadores2.html.php', 'layout.php');
}

dispatch('/pages/noticias', 'page_casos');
function page_casos()
{
  return html('casos.html.php', 'layout.php');
}

dispatch('/pages/servicios', 'page_servicios');
function page_servicios()
{
  return html('servicios.html.php', 'layout.php');
}

dispatch('/pages/programas', 'page_programas');
function page_programas()
{
  return html('programas.html.php', 'layout.php');
}

dispatch('/pages/antecedentes', 'page_antecedentes');
function page_antecedentes()
{
  return html('antecedentes.html.php', 'layout.php');
}

dispatch('/pages/evaluaciones_proceso', 'page_evaluaciones_proceso');
function page_evaluaciones_proceso()
{
  return html('evaluaciones_proceso.html.php', 'layout.php');
}

dispatch('/pages/evaluaciones_terminadas', 'page_evaluaciones_terminadas');
function page_evaluaciones_terminadas()
{
  return html('evaluaciones_terminadas.html.php', 'layout.php');
}

dispatch('/pages/organigrama', 'page_organigrama');
function page_organigrama()
{
  return html('organigrama.html.php', 'layout.php');
}

dispatch('/noticias/1', 'page_noticia_1');
function page_noticia_1()
{
  return html('noticias/noticia.1.php', 'layout.php');
}

dispatch('/noticias/2', 'page_noticia_2');
function page_noticia_2()
{
  return html('noticias/noticia.2.php', 'layout.php');
}

dispatch('/noticias/3', 'page_noticia_3');
function page_noticia_3()
{
  return html('noticias/noticia.3.php', 'layout.php');
}

dispatch('/noticias/4', 'page_noticia_4');
function page_noticia_4()
{
  return html('noticias/noticia.4.php', 'layout.php');
}




run();