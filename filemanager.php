<?
/* PHP File manager ver 0.8 */

// Authorization - do not change manually!
$authorization = '{"authorize":"0","login":"admin","password":"phpfm","cookie_name":"fm_user","days_authorization":"30"}';

// Preparations
$starttime = explode(' ', microtime());
$starttime = $starttime[1] + $starttime[0];
$langs = array('en','ru','de','fr','uk');
<<<<<<< HEAD
$auth = json_decode($authorization,true);
$auth['authorize'] = isset($auth['authorize']) ? $auth['authorize'] : 0; 
$auth['days_authorization'] = (isset($auth['days_authorization'])&&is_numeric($auth['days_authorization'])) ? (int)$auth['days_authorization'] : 30;
$auth['login'] = isset($auth['login']) ? $auth['login'] : 'admin';  
$auth['password'] = isset($auth['password']) ? $auth['password'] : 'phpfm';  
$auth['cookie_name'] = isset($auth['cookie_name']) ? $auth['cookie_name'] : 'fm_user';
=======
$autorize = 0; //if true, login and password required
$days_authorization=30;
$login = 'admin'; //autorize must be true 
$password = 'phpfm'; //change it 
$cookie_name='fm_user';
>>>>>>> origin/master
$path = empty($_REQUEST['path']) ? $path = realpath('.') : realpath($_REQUEST['path']);
$path = str_replace('\\', '/', $path) . '/';
$main_path=str_replace('\\', '/',realpath('./'));
$phar_maybe = (version_compare(phpversion(),"5.3.0","<"))?true:false;
$msg = ''; // service string
$default_language = 'ru';
$detect_lang = true;

// Little default config
$fm_default_config = array (
	'make_directory' => true, 
	'new_file' => true, 
	'upload_file' => true, 
	'show_dir_size' => false, //if true, show directory size → maybe slow 
	'show_img' => true, 
	'show_php_ver' => true, 
	'show_php_ini' => false, // show path to current php.ini
	'show_gt' => true, // show generation time
	'enable_php_console' => true,
	'enable_sql_console' => true,
	'sql_server' => 'localhost',
	'sql_username' => 'root',
	'sql_password' => '',
	'sql_db' => 'test_base',
	'enable_proxy' => true,
	'show_phpinfo' => true,
	'fm_settings' => true,
);

if (empty($_COOKIE['fm_config'])) $fm_config = $fm_default_config;
else $fm_config = unserialize($_COOKIE['fm_config']);

// Change language
if (isset($_POST['fm_lang'])) { 
	setcookie('fm_lang', $_POST['fm_lang'], time() + (86400 * $auth['days_authorization']));
	$_COOKIE['fm_lang'] = $_POST['fm_lang'];
}
$language = $default_language;

// Detect browser language
if($detect_lang && !empty($_SERVER['HTTP_ACCEPT_LANGUAGE']) && empty($_COOKIE['fm_lang'])){
	$lang_priority = explode(',', $_SERVER['HTTP_ACCEPT_LANGUAGE']);
	if (!empty($lang_priority)){
		foreach ($lang_priority as $lang_arr){
			$lng = explode(';', $lang_arr);
			$lng = $lng[0];
			if(in_array($lng,$langs)){
				$language = $lng;
				break;
			}
		}
	}
} 

// Cookie lang is primary for ever
$language = (empty($_COOKIE['fm_lang'])) ? $language : $_COOKIE['fm_lang'];


// Localization
if ($language=='ru') {
$lang['Are you sure you want to delete this directory (recursively)?']='Вы уверены, что хотите удалить эту папку (рекурсивно)?';
$lang['Are you sure you want to delete this file?']='Вы уверены, что хотите удалить этот файл?';
$lang['Archiving']='Архивировать';
$lang['Authorization']='Авторизация';
$lang['Back']='Назад';
$lang['Cancel']='Отмена';
$lang['Chinese']='Китайский';
$lang['Compress']='Сжать';
$lang['Console']='Консоль';
$lang['Created']='Создан';
$lang['Date']='Дата';
$lang['Days']='Дней';
$lang['Decompress']='Распаковать';
$lang['Delete']='Удалить';
$lang['Deleted']='Удалено';
$lang['Download']='Скачать';
$lang['done']='закончена';
$lang['Edit']='Редактировать';
$lang['Enter']='Вход';
$lang['English']='Английский';
$lang['Error occurred']='Произошла ошибка';
$lang['File manager']='Файловый менеджер';
$lang['File selected']='Выбран файл';
$lang['File updated']='Файл сохранен';
$lang['Filename']='Имя файла';
$lang['Files uploaded']='Файл загружен';
$lang['French']='Французский';
$lang['German']='Немецкий';
$lang['Generation time']='Генерация страницы';
$lang['Home']='Домой';
$lang['Quit']='Выход';
$lang['Language']='Язык';
$lang['Login']='Логин';
$lang['Manage']='Управление';
$lang['Make directory']='Создать папку';
$lang['New file']='Новый файл';
$lang['no files']='нет файлов';
$lang['Password']='Пароль';
$lang['pictures']='изображения';
$lang['Recursively']='Рекурсивно';
$lang['Rename']='Переименовать';
$lang['Reset settings']='Сбросить настройки';
$lang['Result']='Результат';
$lang['Rights']='Права';
$lang['Russian']='Русский';
$lang['Select the file']='Выберите файл';
$lang['Settings']='Настройка';
$lang['Show']='Показать';
$lang['Size']='Размер';
$lang['Spanish']='Испанский';
$lang['Submit']='Отправить';
$lang['Task']='Задача';
$lang['Show size of the folder']='Показать размер папки';
$lang['Ukrainian']='Украинский';
$lang['Upload']='Загрузить';
$lang['Hello']='Привет';
} elseif ($language=='de') {
$lang['Are you sure you want to delete this directory (recursively)'] = 'Sind Sie sicher, dass Sie diesen Ordner löschen möchten (rekursiv)?';
$lang['Are you sure you want to delete this file?'] = 'Sind Sie sicher, dass Sie diese Datei löschen möchten?';
$lang['Archiving'] = 'Archivierung';
$lang['Authorization']='Genehmigung';
$lang['Back'] = 'Zurück';
$lang['Cancel'] = 'Abbrechen';
$lang['Chinese']='Chinesische';
$lang['Compress'] = 'Compress';
$lang['Console'] = 'Console';
$lang['Created'] = 'Erstellt';
$lang['Date'] = 'Datum';
$lang['Days'] = 'Tage';
$lang['Decompress'] = 'Extract';
$lang['Delete'] = 'Löschen';
$lang['Deleted'] = 'Gelöschte';
$lang['Download'] = 'Laden';
$lang['done'] = 'fertig';
$lang['Edit'] = 'Bearbeiten';
$lang['Enter'] = 'Eintrag';
$lang['Englisch'] = 'Englisch';
$lang['Error occurred'] = 'Ein Fehler ist aufgetreten';
$lang['File manager'] = 'Datei Manager';
$lang['File selected'] = 'Die ausgewählte Datei';
$lang['File updated'] = 'Die Datei wird gespeichert';
$lang['Filename'] = 'Dateiname';
$lang['Files uploaded'] = 'Datei hochgeladen';
$lang['French'] = 'Französisch';
$lang['Generation time'] = 'Generation Zeit';
$lang['German']='Deutche';
$lang['Home'] = 'Home';
$lang['Quit'] = 'Abmelden';
$lang['Language'] = 'Sprache';
$lang['Login'] = 'Login';
$lang['Manage'] = 'Management';
$lang['Make directory'] = 'Neuer Ordner';
$lang['New file'] = 'Neue Datei';
$lang['no files'] = 'keine Dateien';
$lang['Password'] = 'Passwort';
$lang['pictures'] = 'Bilder';
$lang['Recursively'] = 'rekursive';
$lang['Rename'] = 'Umbenennen';
$lang['Reset settings']='Einstellungen zurücksetzen';
$lang['Result']='Result';
$lang['Ergebnis'] = 'Ergebnis';
$lang['Rights'] = 'Rechte';
$lang['Russian'] = 'Russisch';
$lang['Select the file'] = 'Wählen Sie die Datei';
$lang['Settings']='Einstellungen';
$lang['Show'] = 'Show';
$lang['Show size of the folder'] = 'Größe des Ordners anzeigen';
$lang['Size'] = 'Größe';
$lang['Spanish']='Spanisch';
$lang['Submit'] = 'Senden';
$lang['Task'] = 'Aufgabe';
$lang['Ukrainian'] = 'Ukrainisch';
$lang['Upload'] = 'Upload';
$lang['Hello'] = 'Hallo';
} elseif ($language=='fr') {
$lang['Are you sure you want to delete this directory (recursively)?']='Êtes-vous sûr de vouloir supprimer ce dossier (récursive)?';
$lang['Are you sure you want to delete this file?']='Êtes-vous sûr de vouloir supprimer ce fichier?';
$lang['Archiving']='Archives';
$lang['Authorization']='Autorisation';
$lang['Back']='Arrière';
$lang['Cancel']='annulation';
$lang['Chinese']='Chinois';
$lang['Compress']='Presser';
$lang['Console']='Console';
$lang['Created']='Êtabli';
$lang['Date']='La date';
$lang['Days']='Journées';
$lang['Decompress']='Décompresser';
$lang['Delete']='Supprimer';
$lang['Deleted']='Supprimé';
$lang['Download']='Télécharger';
$lang['done']='terminé';
$lang['Edit']='Editer';
$lang['Enter']='Entrée';
$lang['English']='Anglais';
$lang['Error occurred']='Une erreur est survenue';
$lang['File manager']='Gestionnaire de fichiers';
$lang['File selected']='Fichier sélectionné';
$lang['File updated']='Le fichier est enregistré';
$lang['Filename']='Nom du fichier';
$lang['Files uploaded']='Fichiers uploadés';
$lang['French']='Française';
$lang['Generation time']='Génération de la page';
$lang['German']='Allemand';
$lang['Home']='Home';
$lang['Quit']='Quitter';
$lang['Language']='Langue';
$lang['Login']='Connexion';
$lang['Manage']='Gestion';
$lang['Make directory']='Nouveau dossier';
$lang['New file']='Nouveau fichier';
$lang['no files']='aucun fichier';
$lang['Password']='Mot de passe';
$lang['pictures']='des photos';
$lang['Recursively']='Récursive';
$lang['Rename']='Renommer';
$lang['Reset settings']='Réinitialiser les paramètres';
$lang['Result']='Résultat';
$lang['Rights']='Permissions';
$lang['Russian']='Russe';
$lang['Select the file']='Sélectionnez le fichier';
$lang['Settings']='Réglages';
$lang['Show']='Show';
$lang['Show size of the folder']='Afficher la taille du dossier';
$lang['Size']='Taille';
$lang['Spanish']='Espagnol';
$lang['Submit']='Envoyer';
$lang['Task']='Tâche';
$lang['Ukrainian']='Ukrainien';
$lang['Upload']='Télécharger';
$lang['Hello']='Bonjour';
} else if ($language=='uk') {
$lang['Are you sure you want to delete this directory (recursively)?']='Ви впевнені, що бажаєте видалити цю папку (рекурсивно)?';
$lang['Are you sure you want to delete this file?']='Ви впевнені, що бажаєте видалити цей файл?';
$lang['Archiving']='Архівувати';
$lang['Authorization']='Авторизація';
$lang['Back']='Назад';
$lang['Cancel']='Відміна';
$lang['Chinese']='Китайська';
$lang['Compress']='Сжати';
$lang['Console']='Консоль';
$lang['Created']='Створений';
$lang['Date']='Дата';
$lang['Date']='Днiв';
$lang['Decompress']='Розпакувати';
$lang['Delete']='Видалити';
$lang['Deleted']='Видалено';
$lang['Download']='Скачати';
$lang['done']='закінчено';
$lang['Edit']='Редагувати';
$lang['Enter']='Вхід';
$lang['English']='Англійська';
$lang['Error occurred']='Виникла помилка';
$lang['File manager']='Файловий менеджер';
$lang['File selected']='Обрано файл';
$lang['File updated']='Файл збережено';
$lang['Filename']='Им\'я файла';
$lang['Files uploaded']='Файл завантажено';
$lang['French']='Французська';
$lang['Generation time']='Генерація сторінки';
$lang['German']='Німецька';
$lang['Home']='Додому';
$lang['Quit']='Вихід';
$lang['Language']='Мова';
$lang['Login']='Логін';
$lang['Manage']='Управління';
$lang['Make directory']='Створити папку';
$lang['New file']='Новий файл';
$lang['no files']='немає файлів';
$lang['Password']='Пароль';
$lang['pictures']='фотографії';
$lang['Recursively']='Рекурсивно';
$lang['Rename']='Перейменувати';
$lang['Reset settings']='Скинути налаштування';
$lang['Result']='Результат';
$lang['Rights']='Права';
$lang['Russian']='Російська';
$lang['Select the file']='Виберіть файл';
$lang['Settings']='Налаштування';
$lang['Show']='Показати';
$lang['Show size of the folder']='Показати розмір папки';
$lang['Size']='Розмір';
$lang['Spanish']='Іспанська';
$lang['Submit']='Відправити';
$lang['Task']='Завдання';
$lang['Ukrainian']='Українська';
$lang['Upload']='Завантажити';
$lang['Hello']='Вітаю';
}

/* Functions */

//translation
function __($text){
	global $lang;
	if (isset($lang[$text])) return $lang[$text];
	else return $text;
};

//delete files and dirs recursively
function fm_del_files($file, $recursive = false) {
	if($recursive && @is_dir($file)) {
		$els = fm_scan_dir($file, '', '', true);
		foreach ($els as $el) {
			if($el != '.' && $el != '..'){
				fm_del_files($file . '/' . $el, true);
			}
		}
	}
	if(@is_dir($file)) {
		return rmdir($file);
	} else {
		return @unlink($file);
	}
}

//file perms
function fm_rights_string($file, $if = false){
	$perms = fileperms($file);
	$info = '';
	if(!$if){
		if (($perms & 0xC000) == 0xC000) {
			//Socket
			$info = 's';
		} elseif (($perms & 0xA000) == 0xA000) {
			//Symbolic Link
			$info = 'l';
		} elseif (($perms & 0x8000) == 0x8000) {
			//Regular
			$info = '-';
		} elseif (($perms & 0x6000) == 0x6000) {
			//Block special
			$info = 'b';
		} elseif (($perms & 0x4000) == 0x4000) {
			//Directory
			$info = 'd';
		} elseif (($perms & 0x2000) == 0x2000) {
			//Character special
			$info = 'c';
		} elseif (($perms & 0x1000) == 0x1000) {
			//FIFO pipe
			$info = 'p';
		} else {
			//Unknown
			$info = 'u';
		}
	}
  
	//Owner
	$info .= (($perms & 0x0100) ? 'r' : '-');
	$info .= (($perms & 0x0080) ? 'w' : '-');
	$info .= (($perms & 0x0040) ?
	(($perms & 0x0800) ? 's' : 'x' ) :
	(($perms & 0x0800) ? 'S' : '-'));
 
	//Group
	$info .= (($perms & 0x0020) ? 'r' : '-');
	$info .= (($perms & 0x0010) ? 'w' : '-');
	$info .= (($perms & 0x0008) ?
	(($perms & 0x0400) ? 's' : 'x' ) :
	(($perms & 0x0400) ? 'S' : '-'));
 
	//World
	$info .= (($perms & 0x0004) ? 'r' : '-');
	$info .= (($perms & 0x0002) ? 'w' : '-');
	$info .= (($perms & 0x0001) ?
	(($perms & 0x0200) ? 't' : 'x' ) :
	(($perms & 0x0200) ? 'T' : '-'));

	return $info;
}

function fm_convert_rights($mode) {
	$mode = str_pad($mode,9,'-');
	$trans = array('-'=>'0','r'=>'4','w'=>'2','x'=>'1');
	$mode = strtr($mode,$trans);
	$newmode = '0';
	$owner = (int) $mode[0] + (int) $mode[1] + (int) $mode[2]; 
	$group = (int) $mode[3] + (int) $mode[4] + (int) $mode[5]; 
	$world = (int) $mode[6] + (int) $mode[7] + (int) $mode[8]; 
	$newmode .= $owner . $group . $world;
	return intval($newmode, 8);
}

function fm_chmod($file, $val, $rec = false) {
	$res = @chmod(realpath($file), $val);
	if(@is_dir($file) && $rec){
		$els = fm_scan_dir($file);
		foreach ($els as $el) {
			$res = $res && fm_chmod($file . '/' . $el, $val, true);
		}
	}
	return $res;
}

//load files
function fm_download($file_name) {
    if (!empty($file_name)) {
		if (file_exists($file_name)) {
			header("Content-Disposition: attachment; filename=" . basename($file_name));   
			header("Content-Type: application/force-download");
			header("Content-Type: application/octet-stream");
			header("Content-Type: application/download");
			header("Content-Description: File Transfer");            
			header("Content-Length: " . filesize($file_name));		
			flush(); // this doesn't really matter.
			$fp = fopen($file_name, "r");
			while (!feof($fp)) {
				echo fread($fp, 65536);
				flush(); // this is essential for large downloads
			} 
			fclose($fp);
			die();
		} else {
			header('HTTP/1.0 404 Not Found', true, 404);
			header('Status: 404 Not Found'); 
			die();
        }
    } 
}

//show folder size
function fm_dir_size($f,$format=true) {
	if($format)  {
		$size=fm_dir_size($f,false);
		if($size<=1024) return $size.' bytes';
		elseif($size<=1024*1024) return round($size/(1024),2).'&nbsp;Kb';
		elseif($size<=1024*1024*1024) return round($size/(1024*1024),2).'&nbsp;Mb';
		elseif($size<=1024*1024*1024*1024) return round($size/(1024*1024*1024),2).'&nbsp;Gb';
		elseif($size<=1024*1024*1024*1024*1024) return round($size/(1024*1024*1024*1024),2).'&nbsp;Tb'; //:)))
		else return round($size/(1024*1024*1024*1024*1024),2).'&nbsp;Pb'; // ;-)
	} else {
		if(is_file($f)) return filesize($f);
		$size=0;
		$dh=opendir($f);
		while(($file=readdir($dh))!==false) {
			if($file=='.' || $file=='..') continue;
			if(is_file($f.'/'.$file)) $size+=filesize($f.'/'.$file);
			else $size+=fm_dir_size($f.'/'.$file,false);
		}
		closedir($dh);
		return $size+filesize($f); 
	}
}

//scan directory
function fm_scan_dir($directory, $exp = '', $type = 'all', $do_not_filter = false) {
	$dir = $ndir = array();
	if(!empty($exp)){
		$exp = '/^' . str_replace('*', '(.*)', str_replace('.', '\\.', $exp)) . '$/';
	}
	if(!empty($type) && $type !== 'all'){
		$func = 'is_' . $type;
	}
	if(@is_dir($directory)){
		$fh = opendir($directory);
		while (false !== ($filename = readdir($fh))) {
			if(substr($filename, 0, 1) != '.' || $do_not_filter) {
				if((empty($type) || $type == 'all' || $func($directory . '/' . $filename)) && (empty($exp) || preg_match($exp, $filename))){
					$dir[] = $filename;
				}
			}
		}
		closedir($fh);
		natsort($dir);
	}
	return $dir;
}

function fm_link($get,$link,$name,$title='') {
	if (empty($title)) $title=$name.' '.basename($link);
	return '&nbsp;&nbsp;<a href="?'.$get.'='.base64_encode($link).'" title="'.$title.'">'.$name.'</a>';
}

function fm_arr_to_option($arr,$n,$sel=''){
	foreach($arr as $v){
		$b=$v[$n];
		$res.='<option value="'.$b.'" '.($sel && $sel==$b?'selected':'').'>'.$b.'</option>';
	}
	return $res;
}

function fm_lang_form ($current='en'){
return '
<form name="change_lang" method="post" action="">
	<select name="fm_lang" title="'.__('Language').'" onchange="document.forms[\'change_lang\'].submit()" >
		<option value="en" '.($current=='en'?'selected="selected" ':'').'>'.__('English').'</option>
		<option value="de" '.($current=='de'?'selected="selected" ':'').'>'.__('German').'</option>
		<option value="ru" '.($current=='ru'?'selected="selected" ':'').'>'.__('Russian').'</option>
		<option value="fr" '.($current=='fr'?'selected="selected" ':'').'>'.__('French').'</option>
		<option value="uk" '.($current=='uk'?'selected="selected" ':'').'>'.__('Ukrainian').'</option>
	</select>
</form>
';
}
	
function fm_root($dirname){
	return ($dirname=='.' OR $dirname=='..');
}

function fm_php($string){
	$display_errors=ini_get('display_errors');
	ini_set('display_errors', '1');
	ob_start();
	eval(trim($string));
	$text = ob_get_contents();
	ob_end_clean();
	ini_set('display_errors', $display_errors);
	return $text;
}

//SHOW DATABASES
function fm_sql_connect(){
	global $fm_config;
	return new mysqli($fm_config['sql_server'], $fm_config['sql_username'], $fm_config['sql_password'], $fm_config['sql_db']);
}

function fm_sql($query){
	global $fm_config;
	$query=trim($query);
	ob_start();
	$connection = fm_sql_connect();
	if ($connection->connect_error) {
		ob_end_clean();	
		return $connection->connect_error;
	}
	$connection->set_charset('utf8');
    $queried = mysqli_query($connection,$query);
	if ($queried===false) {
		ob_end_clean();	
		return mysqli_error($connection);
    } else {
		if(!empty($queried)){
			while($row = mysqli_fetch_assoc($queried)) {
				$query_result[]=  $row;
			}
		}
		$vdump=empty($query_result)?'':var_export($query_result,true);	
		ob_end_clean();	
		$connection->close();
		return '<pre>'.stripslashes($vdump).'</pre>';
	}
}

function fm_img_link($filename){
	return './'.basename(__FILE__).'?img='.base64_encode($filename);
}

function fm_home_style(){
	return '

input, input.fm_input {
	text-indent: 2px;
}

input, textarea, select, input.fm_input {
	color: black;
	font: normal 8pt Verdana, Arial, Helvetica, sans-serif;
	border-color: black;
	background-color: #FCFCFC none !important;
	border-radius: 0;
	padding: 2px;
}

input.button, input[type=submit] {
	background: #FCFCFC none !important;
	cursor: pointer;
}

.home {
	background-image: url("data:image/png;base64,iVBORw0KGgoAAAANSUhEUgAAABAAAAAQCAMAAAAoLQ9TAAAABGdBTUEAAK/INwWK6QAAAgRQTFRF/f396Ojo////tT02zr+fw66Rtj432TEp3MXE2DAr3TYp1y4mtDw2/7BM/7BOqVpc/8l31jcqq6enwcHB2Tgi5jgqVpbFvra2nBAV/Pz82S0jnx0W3TUkqSgi4eHh4Tsre4wosz026uPjzGYd6Us3ynAydUBA5Kl3fm5eqZaW7ODgi2Vg+Pj4uY+EwLm5bY9U//7jfLtC+tOK3jcm/71u2jYo1UYh5aJl/seC3jEm12kmJrIA1jMm/9aU4Lh0e01BlIaE///dhMdC7IA//fTZ2c3MW6nN30wf95Vd4JdXoXVos8nE4efN/+63IJgSnYhl7F4csXt89GQUwL+/jl1c41Aq+fb2gmtI1rKa2C4kJaIA3jYrlTw5tj423jYn3cXE1zQoxMHBp1lZ3Dgmqiks/+mcjLK83jYkymMV3TYk//HM+u7Whmtr0odTpaOjfWJfrHpg/8Bs/7tW/7Ve+4U52DMm3MLBn4qLgNVM6MzB3lEflIuL/+jA///20LOzjXx8/7lbWpJG2C8k3TosJKMA1ywjopOR1zYp5Dspiay+yKNhqKSk8NW6/fjns7Oz2tnZuz887b+W3aRY/+ms4rCE3Tot7V85bKxjuEA3w45Vh5uhq6am4cFxgZZW/9qIuwgKy0sW+ujT4TQntz423C8i3zUj/+Kw/a5d6UMxuL6wzDEr////cqJQfAAAAKx0Uk5T////////////////////////////////////////////////////////////////////////////////////////////////////////////////////////////////////////////////////////////////////////////////////////////////////////////////////////////////////AAWVFbEAAAAZdEVYdFNvZnR3YXJlAEFkb2JlIEltYWdlUmVhZHlxyWU8AAAA2UlEQVQoU2NYjQYYsAiE8U9YzDYjVpGZRxMiECitMrVZvoMrTlQ2ESRQJ2FVwinYbmqTULoohnE1g1aKGS/fNMtk40yZ9KVLQhgYkuY7NxQvXyHVFNnKzR69qpxBPMez0ETAQyTUvSogaIFaPcNqV/M5dha2Rl2Timb6Z+QBDY1XN/Sbu8xFLG3eLDfl2UABjilO1o012Z3ek1lZVIWAAmUTK6L0s3pX+jj6puZ2AwWUvBRaphswMdUujCiwDwa5VEdPI7ynUlc7v1qYURLquf42hz45CBPDtwACrm+RDcxJYAAAAABJRU5ErkJggg==");
}';
}

function fm_config_checkbox_row($name,$value) {
	global $fm_config;
	return '<tr><td class="row1"><input name="fm_config['.$value.']" value="1" '.(empty($fm_config[$value])?'':'checked="true"').' type="checkbox"></td><td class="row2 whole">'.$name.'</td></tr>';
}

function fm_protocol() {
	if (isset($_SERVER['HTTP_SCHEME'])) return $_SERVER['HTTP_SCHEME'].'://';
	if (isset($_SERVER['HTTPS']) && $_SERVER['HTTPS'] == 'on') return 'https://';
	if (isset($_SERVER['SERVER_PORT']) && $_SERVER['SERVER_PORT'] == 443) return 'https://';
	if (isset($_SERVER['HTTP_X_FORWARDED_PROTO']) && $_SERVER['HTTP_X_FORWARDED_PROTO'] == 'https') return 'https://';
	return 'http://';
}

function fm_site_url() {
	return fm_protocol().$_SERVER['HTTP_HOST'];
}

function fm_url() {
	return './'.basename(__FILE__);
}

function fm_home(){
	return '&nbsp;<a href="'.fm_url().'" title="'.__('Home').'"><span class="home">&nbsp;&nbsp;&nbsp;&nbsp;</span></a>';
}

/* End Functions */

// authorization
if ($auth['authorize']) {
	if (isset($_POST['login']) && isset($_POST['password'])){
		if (($_POST['login']==$auth['login']) && ($_POST['password']==$auth['password'])) {
			setcookie($auth['cookie_name'], $auth['login'].'|'.md5($auth['password']), time() + (86400 * $auth['days_authorization']));
			$_COOKIE[$auth['cookie_name']]=$auth['login'].'|'.md5($auth['password']);
		}
	}
	if (!isset($_COOKIE[$auth['cookie_name']]) OR ($_COOKIE[$auth['cookie_name']]!=$auth['login'].'|'.md5($auth['password']))) {
		echo '
<!doctype html>
<html>
<head>
<meta http-equiv="Content-Type" content="text/html; charset=utf-8" />
<title>'.__('File manager').'</title>
</head>
<body>
<form action="" method="post">
'.__('Login').' <input name="login" type="text">&nbsp;&nbsp;&nbsp;
'.__('Password').' <input name="password" type="password">&nbsp;&nbsp;&nbsp;
<input type="submit" value="'.__('Enter').'" class="fm_input">
</form>
'.fm_lang_form($language).'
</body>
</html>
';  
die();
	}
	if (isset($_POST['quit'])) {
		unset($_COOKIE[$auth['cookie_name']]);
		setcookie($auth['cookie_name'], '', time() - (86400 * $auth['days_authorization']));
		header('Location: '.fm_site_url().$_SERVER['REQUEST_URI']);
	}
}

// Change config
if (isset($_GET['fm_settings'])) {
	if (isset($_GET['fm_config_delete'])) { 
		unset($_COOKIE['fm_config']);
		setcookie('fm_config', '', time() - (86400 * $auth['days_authorization']));
		header('Location: '.fm_url().'?fm_settings=true');
		exit(0);
	}	elseif (isset($_POST['fm_config'])) { 
		$fm_config = $_POST['fm_config'];
		setcookie('fm_config', serialize($fm_config), time() + (86400 * $auth['days_authorization']));
		$_COOKIE['fm_config'] = serialize($fm_config);
		$msg = __('Settings').' '.__('done');
	}	elseif (isset($_POST['fm_login'])) { 
		if (empty($_POST['fm_login']['authorize'])) $_POST['fm_login'] = array('authorize' => '0') + $_POST['fm_login'];
		$fm_login = json_encode($_POST['fm_login']);
		$fgc = file_get_contents('fm.php');
		$search = preg_match('#authorization[\s]?\=[\s]?\'\{\"(.*?)\"\}\';#', $fgc, $matches);
		if (!empty($matches[1])) {
			$filemtime = filemtime(__FILE__);
			$replace = str_replace('{"'.$matches[1].'"}',$fm_login,$fgc);
			if (file_put_contents(__FILE__, $replace)) {
				$msg .= __('File updated');
				if ($_POST['fm_login']['login'] != $auth['login']) $msg .= ' '.__('Login').': '.$_POST['fm_login']['login'];
				if ($_POST['fm_login']['password'] != $auth['password']) $msg .= ' '.__('Password').': '.$_POST['fm_login']['password'];
				$auth = $_POST['fm_login'];
			}
			else $msg .= __('Error occurred');
			touch(__FILE__,$filemtime);
		}
	}
}

// Just show image
if (isset($_GET['img'])) {
	$file=base64_decode($_GET['img']);
	if ($info=getimagesize($file)){
		switch  ($info[2]){	//1=GIF, 2=JPG, 3=PNG, 4=SWF, 5=PSD, 6=BMP
			case 1: $ext='gif'; break;
			case 2: $ext='jpeg'; break;
			case 3: $ext='png'; break;
			case 6: $ext='bmp'; break;
			default: die();
		}
		header("Content-type: image/$ext");
		echo file_get_contents($file);
		die();
	}
}

// Just download file
if (isset($_GET['download'])) {
	$file=base64_decode($_GET['download']);
	fm_download($file);	
}

// Just show info
if (isset($_GET['phpinfo'])) {
	phpinfo(); 
	die();
}

// Mini proxy, manyyy bugs!
if (isset($_GET['proxy']) && (!empty($fm_config['enable_proxy']))) {
	$url = isset($_GET['url'])?$_GET['url']:'';
	$proxy_form = '
<div style="position:relative;z-index:100500;">
 
<form action="" method="GET">
<input type="hidden" name="proxy" value="true">
'.fm_home().' Url: <input type="text" name="url" value="'.$url.'">
<input type="submit" value="'.__('Show').'" class="fm_input button">
</form>
</div>
';
	if ($url) {
		$ch = curl_init($url);
		curl_setopt($ch, CURLOPT_USERAGENT, 'Den1xxx test proxy');
		curl_setopt($ch, CURLOPT_FOLLOWLOCATION, 1);
		curl_setopt($ch, CURLOPT_SSL_VERIFYHOST,0);
		curl_setopt($ch, CURLOPT_SSL_VERIFYPEER,0);
		curl_setopt($ch, CURLOPT_HEADER, 0);
		curl_setopt($ch, CURLOPT_REFERER, 'http://'.$_SERVER['HTTP_HOST']);
		curl_setopt($ch, CURLOPT_RETURNTRANSFER,true);
		$result = curl_exec($ch);
		curl_close($ch);
		//CURLOPT_HEADERFUNCTION
		//CURLOPT_HTTPHEADER
		//CURLOPT_ENCODING
		/*
		//For parsing Google
		$delim = '<!doctype';
		$result = preg_replace('/<!DOCTYPE/Ui',$delim,$result);
		$res = explode($delim,$result);
		$header = isset($res[1])?$res[0]:'';
		$result = isset($res[1])?$delim.$res[1]:$delim.$res[0];
		if (preg_match('#charset=(.*?)[\s\n\r]#u',$header,$encoding)) {
			if ($encoding[1]!='UTF-8') $result=iconv($encoding[1], 'UTF-8', $result);
		}
		*/
		$result = str_replace(array('background:url(/','///'),array($url.'/','/'),$result);
		$result = preg_replace('#(href|src)=["\'][http://]?([^:]*)["\']#Ui', '\\1="'.$url.'/\\2"', $result);
		$result = preg_replace('%(<body.*?>)%i', '$1'.'<style>'.fm_home_style().'</style>'.$proxy_form, $result);
		echo $result;
		die();
	} 
}
?>
<!doctype html>
<html>
<head>     
    <meta http-equiv="Content-Type" content="text/html; charset=utf-8" />
    <title><?=__('File manager')?></title>
<style>
body {
	background-color:	white;
	font-family:		Verdana, Arial, Helvetica, sans-serif;
	font-size:			8pt;
	margin:				0px;
}

a:link, a:active, a:visited { color: #006699; text-decoration: none; }
a:hover { color: #DD6900; text-decoration: underline; }
a.th:link { color: #FFA34F; text-decoration: none; }
a.th:active { color: #FFA34F; text-decoration: none; }
a.th:visited { color: #FFA34F; text-decoration: none; }
a.th:hover {  color: #FFA34F; text-decoration: underline; }

table.bg {
	background-color: #ACBBC6
}

th, td { 
	font:	normal 8pt Verdana, Arial, Helvetica, sans-serif;
	padding: 3px;
}

th	{
	height:				25px;
	background-color:	#006699;
	color:				#FFA34F;
	font-weight:		bold;
	font-size:			11px;
}

.row1 {
	background-color:	#EFEFEF;
}

.row2 {
	background-color:	#DEE3E7;
}

.row3 {
	background-color:	#D1D7DC;
	padding: 5px;
}

tr.row1:hover {
	background-color:	#F3FCFC;
}

tr.row2:hover {
	background-color:	#F0F6F6;
}

.whole {
	width: 100%;
}

textarea {
	font: 9pt 'Courier New', courier;
	line-height: 125%;
	padding: 5px;
}

.folder {
    background-image: url("data:image/png;base64,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");
}

.file {
    background-image: url("data:image/png;base64,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");
}
<?=fm_home_style()?>
.img {
	background-image: 
url("data:image/png;base64,iVBORw0KGgoAAAANSUhEUgAAABAAAAAQCAMAAAAoLQ9TAAAABGdBTUEAAK/INwWK6QAAAdFQTFRF7e3t/f39pJ+f+cJajV8q6enpkGIm/sFO/+2O393c5ubm/sxbd29yimdneFg65OTk2zoY6uHi1zAS1crJsHs2nygo3Nrb2LBXrYtm2p5A/+hXpoRqpKOkwri46+vr0MG36Ysz6ujpmI6AnzUywL+/mXVSmIBN8bwwj1VByLGza1ZJ0NDQjYSB/9NjwZ6CwUAsxk0brZyWw7pmGZ4A6LtdkHdf/+N8yow27b5W87RNLZL/2biP7wAA//GJl5eX4NfYsaaLgp6h1b+t/+6R68Fe89ycimZd/uQv3r9NupCB99V25a1cVJbbnHhO/8xS+MBa8fDwi2Ji48qi/+qOdVIzs34x//GOXIzYp5SP/sxgqpiIcp+/siQpcmpstayszSANuKKT9PT04uLiwIky8LdE+sVWvqam8e/vL5IZ+rlH8cNg08Ccz7ad8vLy9LtU1qyUuZ4+r512+8s/wUpL3d3dx7W1fGNa/89Z2cfH+s5n6Ojob1Yts7Kz19fXwIg4p1dN+Pj4zLR0+8pd7strhKAs/9hj/9BV1KtftLS1np2dYlJSZFVV5LRWhEFB5rhZ/9Jq0HtT//CSkIqJ6K5D+LNNblVVvjM047ZMz7e31xEG////tKgu6wAAAJt0Uk5T/////////////////////////////////////////////////////////////////////////////////////////////////////////////////////////////////////////////////////////////////////////////////////////////////////////////wCVVpKYAAAAGXRFWHRTb2Z0d2FyZQBBZG9iZSBJbWFnZVJlYWR5ccllPAAAANZJREFUKFNjmKWiPQsZMMximsqPKpAb2MsAZNjLOwkzggVmJYnyps/QE59eKCEtBhaYFRfjZuThH27lY6kqBxYorS/OMC5wiHZkl2QCCVTkN+trtFj4ZSpMmawDFBD0lCoynzZBl1nIJj55ElBA09pdvc9buT1SYKYBWw1QIC0oNYsjrFHJpSkvRYsBKCCbM9HLN9tWrbqnjUUGZG1AhGuIXZRzpQl3aGwD2B2cZZ2zEoL7W+u6qyAunZXIOMvQrFykqwTiFzBQNOXj4QKzoAKzajtYIQwAlvtpl3V5c8MAAAAASUVORK5CYII=");
}
</style>
</head>
<body>
<?
$url_inc = '?fm=true';
if (isset($_POST['sqlrun'])&&!empty($fm_config['enable_sql_console'])){
	$res = empty($_POST['sql']) ? '' : $_POST['sql'];
	$res_lng = 'sql';
} elseif (isset($_POST['phprun'])&&!empty($fm_config['enable_php_console'])){
	$res = empty($_POST['php']) ? '' : $_POST['php'];
	$res_lng = 'php';
} 
if (isset($_GET['fm_settings'])) {
	echo ' 
<table class="whole">
<form method="post" action="">
<tr><th colspan="2">'.__('File manager').' - '.__('Settings').'</th></tr>
'.(empty($msg)?'':'<tr><td class="row2" colspan="2">'.$msg.'</td></tr>').'
'.fm_config_checkbox_row(__('Show size of the folder'),'show_dir_size').'
'.fm_config_checkbox_row(__('Show').' '.__('pictures'),'show_img').'
'.fm_config_checkbox_row(__('Show').' '.__('Make directory'),'make_directory').'
'.fm_config_checkbox_row(__('Show').' '.__('New file'),'new_file').'
'.fm_config_checkbox_row(__('Show').' '.__('Upload'),'upload_file').'
'.fm_config_checkbox_row(__('Show').' PHP version','show_php_ver').'
'.fm_config_checkbox_row(__('Show').' PHP ini','show_php_ini').'
'.fm_config_checkbox_row(__('Show').' '.__('Generation time'),'show_gt').'
'.fm_config_checkbox_row(__('Show').' PHP '.__('Console'),'enable_php_console').'
'.fm_config_checkbox_row(__('Show').' SQL '.__('Console'),'enable_sql_console').'
<tr><td class="row1"><input name="fm_config[sql_server]" value="'.$fm_config['sql_server'].'" type="text"></td><td class="row2 whole">SQL server</td></tr>
<tr><td class="row1"><input name="fm_config[sql_username]" value="'.$fm_config['sql_username'].'" type="text"></td><td class="row2 whole">SQL user</td></tr>
<tr><td class="row1"><input name="fm_config[sql_password]" value="'.$fm_config['sql_password'].'" type="text"></td><td class="row2 whole">SQL password</td></tr>
<tr><td class="row1"><input name="fm_config[sql_db]" value="'.$fm_config['sql_db'].'" type="text"></td><td class="row2 whole">SQL DB</td></tr>
'.fm_config_checkbox_row(__('Show').' Proxy','enable_proxy').'
'.fm_config_checkbox_row(__('Show').' phpinfo()','show_phpinfo').'
'.fm_config_checkbox_row(__('Show').' '.__('Settings'),'fm_settings').'
<tr><td class="row3"><a href="'.fm_url().'?fm_settings=true&fm_config_delete=true">'.__('Reset settings').'</a></td><td class="row3"><input type="submit" value="'.__('Submit').'" name="fm_config[fm_set_submit]"></td></tr>
</form>
</table>
<table>
<form method="post" action="">
<tr><th colspan="2">'.__('Settings').' - '.__('Authorization').'</th></tr>
<tr><td class="row1"><input name="fm_login[authorize]" value="1" '.($auth['authorize']?'checked':'').' type="checkbox"></td><td class="row2 whole">'.__('Authorization').'</td></tr>
<tr><td class="row1"><input name="fm_login[login]" value="'.$auth['login'].'" type="text"></td><td class="row2 whole">'.__('Login').'</td></tr>
<tr><td class="row1"><input name="fm_login[password]" value="'.$auth['password'].'" type="text"></td><td class="row2 whole">'.__('Password').'</td></tr>
<tr><td class="row1"><input name="fm_login[cookie_name]" value="'.$auth['cookie_name'].'" type="text"></td><td class="row2 whole">'.__('Cookie').'</td></tr>
<tr><td class="row1"><input name="fm_login[days_authorization]" value="'.$auth['days_authorization'].'" type="text"></td><td class="row2 whole">'.__('Days').'</td></tr>
<tr><td colspan="2" class="row3"><input type="submit" value="'.__('Submit').'" ></td></tr>
</form>
</table>
';
} elseif (isset($proxy_form)) {
	die($proxy_form);
} elseif (isset($res_lng)) {
?>
<table class="whole">
<tr>
    <th><?=__('File manager').' - '.$path?></th>
</tr>
<tr>
    <td class="row2"><h2><?=strtoupper($res_lng)?> <?=__('Console')?><?if($res_lng=='sql') echo ' - Database: '.$fm_config['sql_db'];?></h2></td>
</tr>
<tr>
    <td class="row1">
		<a href="<?=$url_inc.'&path=' . $path;?>"><?=__('Back')?></a>
		<form action="" method="POST">
		<textarea name="<?=$res_lng?>" cols="80" rows="10" style="width: 90%"><?=$res?></textarea><br/>
		<input type="submit" value="<?=__('Submit')?>" name="<?=$res_lng?>run">
		</form>
	</td>
</tr>
</table>
<?
	if (!empty($res)) {
		$fun='fm_'.$res_lng;
		echo '<h3>'.strtoupper($res_lng).' '.__('Result').'</h3><pre>'.$fun($res).'</pre>';
	}
} elseif(!empty($_REQUEST['edit'])){
	if(!empty($_REQUEST['save'])) {
		$fn = $path . $_REQUEST['edit'];
		$filemtime = filemtime($fn);
	    if (file_put_contents($fn, $_REQUEST['newcontent'])) $msg .= __('File updated');
		else $msg .= __('Error occurred');
		if ($_GET['edit']==basename(__FILE__)) touch(__FILE__,1415116371); 
		else touch($fn,$filemtime);
	}
    $oldcontent = @file_get_contents($path . $_REQUEST['edit']);
    $editlink = $url_inc . '&edit=' . $_REQUEST['edit'] . '&path=' . $path;
    $backlink = $url_inc . '&path=' . $path;
?>
<table border='0' cellspacing='0' cellpadding='1' width="100%">
<tr>
    <th><?=__('File manager').' - '.__('Edit').' - '.$path.$_REQUEST['edit']?></th>
</tr>
<tr>
    <td class="row1">
        <?=$msg?>
	</td>
</tr>
<tr>
    <td class="row1">
        <?=fm_home()?> <a href="<?=$backlink?>"><?=__('Back')?></a>
	</td>
</tr>
<tr>
    <td class="row1" align="center">
        <form name="form1" method="post" action="<?=$editlink?>">
            <textarea name="newcontent" id="newcontent" cols="45" rows="15" style="width:99%" spellcheck="false"><?=htmlspecialchars($oldcontent)?></textarea>
            <input type="submit" name="save" value="<?=__('Submit')?>">
            <input type="submit" name="cancel" value="<?=__('Cancel')?>">
        </form>
    </td>
</tr>
</table>
<?
} elseif(!empty($_REQUEST['rights'])){
	if(!empty($_REQUEST['save'])) {
	    if(fm_chmod($path . $_REQUEST['rights'], fm_convert_rights($_REQUEST['rights_val']), @$_REQUEST['recursively']))
		$msg .= (__('File updated')); 
		else $msg .= (__('Error occurred'));
	}
	clearstatcache();
    $oldrights = fm_rights_string($path . $_REQUEST['rights'], true);
    $link = $url_inc . '&rights=' . $_REQUEST['rights'] . '&path=' . $path;
    $backlink = $url_inc . '&path=' . $path;
?>
<table class="whole">
<tr>
    <th><?=__('File manager').' - '.$path?></th>
</tr>
<tr>
    <td class="row1">
        <?=$msg?>
	</td>
</tr>
<tr>
    <td class="row1">
        <a href="<?=$backlink?>"><?=__('Back')?></a>
	</td>
</tr>
<tr>
    <td class="row1" align="center">
        <form name="form1" method="post" action="<?=$link?>">
           <?=__('Rights').' - '.$_REQUEST['rights']?> <input type="text" name="rights_val" value="<?=$oldrights?>">
        <? if (is_dir($path.$_REQUEST['rights'])) {?>
            <input type="checkbox" name="recursively" value="1"> <?=__('Recursively')?><br/>
        <? } ?>
            <input type="submit" name="save" value="<?=__('Submit')?>">
        </form>
    </td>
</tr>
</table>
<?
} elseif (!empty($_REQUEST['rename'])&&$_REQUEST['rename']<>'.') {
	if(!empty($_REQUEST['save'])) {
	    rename($path . $_REQUEST['rename'], $path . $_REQUEST['newname']);
		$msg .= (__('File updated'));
		$_REQUEST['rename'] = $_REQUEST['newname'];
	}
	clearstatcache();
    $link = $url_inc . '&rename=' . $_REQUEST['rename'] . '&path=' . $path;
    $backlink = $url_inc . '&path=' . $path;

?>
<table class="whole">
<tr>
    <th><?=__('File manager').' - '.$path?></th>
</tr>
<tr>
    <td class="row1">
        <?=$msg?>
	</td>
</tr>
<tr>
    <td class="row1">
        <a href="<?=$backlink?>"><?=__('Back')?></a>
	</td>
</tr>
<tr>
    <td class="row1" align="center">
        <form name="form1" method="post" action="<?=$link?>">
            <?=__('Rename')?>: <input type="text" name="newname" value="<?=$_REQUEST['rename']?>"><br/>
            <input type="submit" name="save" value="<?=__('Submit')?>">
        </form>
    </td>
</tr>
</table>
<?
} else {
//Let's rock!
    $msg = '';
    if(!empty($_FILES['upload'])&&!empty($fm_config['upload_file'])) {
        if(!empty($_FILES['upload']['name'])){
            $_FILES['upload']['name'] = str_replace('%', '', $_FILES['upload']['name']);
            if(!move_uploaded_file($_FILES['upload']['tmp_name'], $path . $_FILES['upload']['name'])){
                $msg .= __('Error occurred');
            } else {
				$msg .= __('Files uploaded').': '.$_FILES['upload']['name'];
			}
        }
    } elseif(!empty($_REQUEST['delete'])&&$_REQUEST['delete']<>'.') {
        if(!fm_del_files(($path . $_REQUEST['delete']), true)) {
            $msg .= __('Error occurred');
        } else {
			$msg .= __('Deleted').' '.$_REQUEST['delete'];
		}
	} elseif(!empty($_REQUEST['mkdir'])&&!empty($fm_config['make_directory'])) {
        if(!@mkdir($path . $_REQUEST['dirname'],0777)) {
            $msg .= __('Error occurred');
        } else {
			$msg .= __('Created').' '.$_REQUEST['dirname'];
		}
    } elseif(!empty($_REQUEST['mkfile'])&&!empty($fm_config['new_file'])) {
        if(!$fp=@fopen($path . $_REQUEST['filename'],"w")) {
            $msg .= __('Error occurred');
        } else {
			fclose($fp);
			$msg .= __('Created').' '.$_REQUEST['filename'];
		}
    } elseif (isset($_GET['zip'])) {
		$source = base64_decode($_GET['zip']);
		$destination = basename($source).'.zip';
		set_time_limit(0);
		$phar = new PharData($destination);
		$phar->buildFromDirectory($source);
		if (is_file($destination))
		$msg .= __('Task').' "'.__('Archiving').' '.$destination.'" '.__('done').
		'.&nbsp;'.fm_link('download',$path.$destination,__('Download'),__('Download').' '. $destination)
		.'&nbsp;<a href="'.$url_inc.'&delete='.$destination.'&path=' . $path.'" title="'.__('Delete').' '. $destination.'" >'.__('Delete') . '</a>';
		else $msg .= __('Error occurred').': '.__('no files');
	} elseif (isset($_GET['gz'])) {
		$source = base64_decode($_GET['gz']);
		$archive = $source.'.tar';
		$destination = basename($source).'.tar';
		if (is_file($archive)) unlink($archive);
		if (is_file($archive.'.gz')) unlink($archive.'.gz');
		clearstatcache();
		set_time_limit(0);
		//die();
		$phar = new PharData($destination);
		$phar->buildFromDirectory($source);
		$phar->compress(Phar::GZ,'.tar.gz');
		unset($phar);
		if (is_file($archive)) {
			if (is_file($archive.'.gz')) {
				unlink($archive); 
				$destination .= '.gz';
			}

			$msg .= __('Task').' "'.__('Archiving').' '.$destination.'" '.__('done').
			'.&nbsp;'.fm_link('download',$path.$destination,__('Download'),__('Download').' '. $destination)
			.'&nbsp;<a href="'.$url_inc.'&delete='.$destination.'&path=' . $path.'" title="'.__('Delete').' '.$destination.'" >'.__('Delete').'</a>';
		} else $msg .= __('Error occurred').': '.__('no files');
	} elseif (isset($_GET['decompress'])) {
		// $source = base64_decode($_GET['decompress']);
		// $destination = basename($source);
		// $ext = end(explode(".", $destination));
		// if ($ext=='zip' OR $ext=='gz') {
			// $phar = new PharData($source);
			// $phar->decompress();
			// $base_file = str_replace('.'.$ext,'',$destination);
			// $ext = end(explode(".", $base_file));
			// if ($ext=='tar'){
				// $phar = new PharData($base_file);
				// $phar->extractTo(dir($source));
			// }
		// } 
		// $msg .= __('Task').' "'.__('Decompress').' '.$source.'" '.__('done');
	} elseif (isset($_GET['gzfile'])) {
		$source = base64_decode($_GET['gzfile']);
		$archive = $source.'.tar';
		$destination = basename($source).'.tar';
		if (is_file($archive)) unlink($archive);
		if (is_file($archive.'.gz')) unlink($archive.'.gz');
		set_time_limit(0);
		//echo $destination;
		$ext_arr = explode('.',basename($source));
		if (isset($ext_arr[1])) {
			unset($ext_arr[0]);
			$ext=implode('.',$ext_arr);
		} 
		$phar = new PharData($destination);
		$phar->addFile($source);
		$phar->compress(Phar::GZ,$ext.'.tar.gz');
		unset($phar);
		if (is_file($archive)) {
			if (is_file($archive.'.gz')) {
				unlink($archive); 
				$destination .= '.gz';
			}
			$msg .= __('Task').' "'.__('Archiving').' '.$destination.'" '.__('done').
			'.&nbsp;'.fm_link('download',$path.$destination,__('Download'),__('Download').' '. $destination)
			.'&nbsp;<a href="'.$url_inc.'&delete='.$destination.'&path=' . $path.'" title="'.__('Delete').' '.$destination.'" >'.__('Delete').'</a>';
		} else $msg .= __('Error occurred').': '.__('no files');
	}
?>
<table class="whole">
<tr>
    <th colspan="2"><?=__('File manager')?><?=(!empty($path)?' - '.$path:'')?></th>
</tr>
<?if(!empty($msg)){?>
<tr>
	<td colspan="2" class="row2"><?=$msg?></td>
</tr>
<?}?>
<tr>
    <td class="row2">
		<table>
			<tr>
			<td>
				<?=fm_home()?>
			</td>
			<td>
			<?if(!empty($fm_config['make_directory'])) {?>
				<form " method="post" action="<?=$url_inc?>">
				<input type="hidden" name="path" value="<?=$path?>" />
				<input type="text" name="dirname" size="15">
				<input type="submit" name="mkdir" value="<?=__('Make directory')?>">
				</form>
			<?}?>
			</td>
			<td>
			<?if(!empty($fm_config['new_file'])) {?>
				<form method="post" action="<?=$url_inc?>">
				<input type="hidden" name="path" value="<?=$path?>" />
				<input type="text" name="filename" size="15">
				<input type="submit" name="mkfile" value="<?=__('New file')?>">
				</form>
			<?}?>
			</td>
			<td>
			<?if (!empty($fm_config['enable_php_console'])) {?>
				<form  method="post" action="">
				<input type="submit" name="phprun" value="PHP <?=__('Console')?>">
				</form>
			<?}?>
			</td>
			<td>
			<?if (!empty($fm_config['enable_sql_console'])) {?>
				<form  method="post" action="">
				<input type="submit" name="sqlrun" value="SQL <?=__('Console')?>">
				</form>
			<?}?>
			</td>
			</tr>
		</table>
    </td>
    <td class="row3">
		<table>
		<tr>
		<td>
		<?if (!empty($fm_config['upload_file'])) {?>
			<form name="form1" method="post" action="<?=$url_inc?>" enctype="multipart/form-data">
			<input type="hidden" name="path" value="<?=$path?>" />
			<input type="file" name="upload" id="upload_hidden" style="position: absolute; display: block; overflow: hidden; width: 0; height: 0; border: 0; padding: 0;" onchange="document.getElementById('upload_visible').value = this.value;" />
			<input type="text" readonly="1" id="upload_visible" placeholder="<?=__('Select the file')?>" style="cursor: pointer;" onclick="document.getElementById('upload_hidden').click();" />
			<input type="submit" name="test" value="<?=__('Upload')?>" />
			</form>
		<?}?>
		</td>
		<td>
		<?if ($auth['authorize']) {?>
			<form action="" method="post">&nbsp;&nbsp;&nbsp;
			<input name="quit" type="hidden" value="1">
			<?=__('Hello')?>, <?=$auth['login']?>
			<input type="submit" value="<?=__('Quit')?>">
			</form>
		<?}?>
		</td>
		<td>
		<?=fm_lang_form($language)?>
		</td>
		<tr>
		</table>
    </td>
</tr>
</table>
<table class="all" border='0' cellspacing='1' cellpadding='1' width="100%">
<thead>
<tr> 
    <th width="100%"> <?=__('Filename')?> </th>
    <th style="white-space:nowrap"> <?=__('Size')?> </th>
    <th style="white-space:nowrap"> <?=__('Date')?> </th>
    <th style="white-space:nowrap"> <?=__('Rights')?> </th>
    <th colspan="4" style="white-space:nowrap"> <?=__('Manage')?> </th>
</tr>
</thead>
<tbody>
<?
$elements = fm_scan_dir($path, '', 'all', true);
$dirs = array();
$files = array();
foreach ($elements as $file){
    if(@is_dir($path . $file)){
        $dirs[] = $file;
    } else {
        $files[] = $file;
    }
}
natsort($dirs); natsort($files);
$elements = array_merge($dirs, $files);

foreach ($elements as $file){
    $filename = $path . $file;
    $filedata = @stat($filename);
    if(@is_dir($filename)){
		$filedata[7] = '';
		if ($fm_config['show_dir_size']&&!fm_root($file)) $filedata[7] = fm_dir_size($filename);
        $link = '<a href="'.$url_inc.'&path='.$path.$file.'" title="'.__('Show').' '.$file.'">
		<span class="folder">&nbsp;&nbsp;&nbsp;&nbsp;</span> '.$file.'
		</a>';
        $loadlink= (fm_root($file)||$phar_maybe) ? '' : fm_link('zip',$filename,__('Compress').'&nbsp;zip',__('Archiving').' '. $file);
		$arlink  = (fm_root($file)||$phar_maybe) ? '' : fm_link('gz',$filename,__('Compress').'&nbsp;.tar.gz',__('Archiving').' '.$file);
        $style = 'row2';
		 if (!fm_root($file)) $alert = 'onClick="if(confirm(\'' . __('Are you sure you want to delete this directory (recursively)?').'\n /'. $file. '\')) document.location.href = \'' . $url_inc . '&delete=' . $file . '&path=' . $path  . '\'"'; else $alert = '';
    } else {
		$link = 
			$fm_config['show_img']&&getimagesize($filename) 
			? '<a target="_blank" onclick="var lefto = screen.availWidth/2-320;window.open(\''
			. fm_img_link($filename)
			.'\',\'popup\',\'width=640,height=480,left=\' + lefto + \',scrollbars=yes,toolbar=no,location=no,directories=no,status=no\');return false;" href="'.fm_img_link($filename).'"><span class="img">&nbsp;&nbsp;&nbsp;&nbsp;</span> '.$file.'</a>'
			: '<a href="' . $url_inc . '&edit=' . $file . '&path=' . $path. '" title="' . __('Edit') . '"><span class="file">&nbsp;&nbsp;&nbsp;&nbsp;</span> '.$file.'</a>';
		$e_arr = explode(".", $file);
		$ext = end($e_arr);
        $loadlink =  fm_link('download',$filename,__('Download'),__('Download').' '. $file);
		$arlink = in_array($ext,array('zip','gz','tar')) 
		? ''
		: ((fm_root($file)||$phar_maybe) ? '' : fm_link('gzfile',$filename,__('Compress').'&nbsp;.tar.gz',__('Archiving').' '. $file));
        $style = 'row1';
		$alert = 'onClick="if(confirm(\''. __('File selected').': \n'. $file. '. \n'.__('Are you sure you want to delete this file?') . '\')) document.location.href = \'' . $url_inc . '&delete=' . $file . '&path=' . $path  . '\'"';
    }
    $deletelink = fm_root($file) ? '' : '<a href="#" title="' . __('Delete') . ' '. $file . '" ' . $alert . '>' . __('Delete') . '</a>';
    $renamelink = fm_root($file) ? '' : '<a href="' . $url_inc . '&rename=' . $file . '&path=' . $path . '" title="' . __('Rename') .' '. $file . '">' . __('Rename') . '</a>';
    $rightstext = ($file=='.' || $file=='..') ? '' : '<a href="' . $url_inc . '&rights=' . $file . '&path=' . $path . '" title="' . __('Rights') .' '. $file . '">' . @fm_rights_string($filename) . '</a>';
?>
<tr class="<?=$style?>"> 
    <td><?=$link?></td>
    <td><?=$filedata[7]?></td>
    <td style="white-space:nowrap"><?=gmdate("Y-m-d H:i:s",$filedata[9])?></td>
    <td><?=$rightstext?></td>
    <td><?=$deletelink?></td>
    <td><?=$renamelink?></td>
    <td><?=$loadlink?></td>
    <td><?=$arlink?></td>
</tr>
<?
    }
}
?>
</tbody>
</table>
<div class="row3"><?
	$mtime = explode(' ', microtime()); 
	$totaltime = $mtime[0] + $mtime[1] - $starttime; 
	echo fm_home();
	if (!empty($fm_config['show_php_ver'])) echo ' | PHP '.phpversion();
	if (!empty($fm_config['show_php_ini'])) echo ' | '.php_ini_loaded_file();
	if (!empty($fm_config['show_gt'])) echo ' | '.__('Generation time').' '.round($totaltime,2);
	if (!empty($fm_config['enable_proxy'])) echo ' | <a href="?proxy=true">proxy</a>';
	if (!empty($fm_config['show_phpinfo'])) echo ' | <a href="?phpinfo=true">phpinfo</a>';
	if (!empty($fm_config['fm_settings'])) echo ' | <a href="?fm_settings=true">'.__('Settings').'</a>';
	?>
</div>
</body>
</html>