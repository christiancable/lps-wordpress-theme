<?php
/* 
custom function for LPS theme 
- christiancable@gmail.com
*/

define(
    "GOOGLE_SHEET_URL",
    'https://spreadsheets.google.com/feeds/list/11PaoMSCAv_hb34DEFM_8Dts9r2eZI0oPhFijH4rJRAM/od6/public/basic?alt=json'
);


function parseEvent($event)
{
    $evening = array();

    $evening['date'] = trim($event['title']['$t']);

    $specifics = explode(', description: ', $event['content']['$t']);
    if (isset($specifics[0])) {
        $evening['title'] = trim(substr($specifics[0], strlen('title: ')));
    } else {
        $evening['title'] = '';
    }
    if (isset($specifics[1])) {
        $evening['description'] = trim($specifics[1]);
    } else {
        $evening['description'] = '';
    }
    return $evening;
}

function renderEvening($evening)
{
    if (trim($evening['title']) == '' || trim($evening['date']) == '')
    {
        return '';
    }

    $evening['title'] = htmlspecialchars($evening['title']);
    $evening['description'] = htmlspecialchars($evening['description']);

    $search = array('&lt;strong&gt;','&lt;/strong&gt;');
    $replace = array('<strong>','</strong>');
    $evening['description'] = nl2br(str_ireplace($search, $replace, $evening['description']));

    $html = <<< HTML
<dt>{$evening['date']}</dt>
<dd><strong>{$evening['title']}</strong></dd>
HTML;

    if (strlen($evening['description']) != 0) {
        $html .= "<dd>{$evening['description']}</dd>";
    }
    return $html;
}

function renderProgramme()
{
    if (isset($content)) {
        $sheet = $content;
    } else {
        $sheet = GOOGLE_SHEET_URL;
    }
    $programmeJSON = file_get_contents($sheet);

    $output = '';

    if ($programmeJSON !== false) {
        $output .= '<dl class="programme">';
        $programme = json_decode($programmeJSON, true);
        $programmeData = ($programme['feed']['entry']);
        foreach ($programmeData as $event) {
            $evening = parseEvent($event);
            if (trim($evening['title']) !== '') {
                $output .= renderEvening($evening);
            }
        }
        $output .= '</dl>';
    } else {
        $output = 'Programme information not currently avaliable';
    }

    return $output;
}

add_shortcode('LPS_programme','renderProgramme');
?>