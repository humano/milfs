<?php
 function simpleText($html){
 
	$html = str_replace('&ndash;','-',$html);
	$html = str_replace('&quot;','"',$html);
	$html = preg_replace('/\&amp;(nbsp);/','&${1};',$html);
 
	//formatting
	// bold
	$html = preg_replace('/\'\'\'([^\n\']+)\'\'\'/','<strong>${1}</strong>',$html);
	// emphasized
	$html = preg_replace('/\'\'([^\'\n]+)\'\'?/','<em>${1}</em>',$html);
	//interwiki links
	$html = preg_replace_callback('/\[\[([^\|\n\]:]+)[\|]([^\]]+)\]\]/','helper_interwikilinks',$html);
	// without text
	$html = preg_replace_callback('/\[\[([^\|\n\]:]+)\]\]/','helper_interwikilinks',$html);
	// 
	//$html = preg_replace('/{{([^}]+)+}}/','Interwiki: ${1}+${2}+${3}',$html);
	$html = preg_replace('/{{([^\|\n\}]+)([\|]?([^\}]+))+\}\}/','Interwiki: ${1} &raquo; ${3}',$html);
	// Template
	//$html = preg_replace('/{{([^}]*)}}/',' ',$html);
	// categories
	//$html = preg_replace('/\[\[([^\|\n\]]+)([\|]([^\]]+))?\]\]/','',$html);
	$html = preg_replace('/\[\[([^\|\n\]]{2})([\:]([^\]]+))?\]\]/','Translation: ${1} &raquo; ${3}',$html);
	$html = preg_replace('/\[\[([^\|\n\]]+)([\:]([^\]]+))?\]\]/','Category: ${1} - ${2}',$html);
	// image
	$html = preg_replace('/\[\[([^\|\n\]]+)([\|]([^\]]+))+\]\]/','Image: ${0}+${1}+${2}+${3}',$html);
	
	//links
	//$html = preg_replace('/\[([^\[\]\|\n\': ]+)\]/','<a href="${1}">${1}</a>',$html);
	$html = preg_replace_callback('/\[([^\[\]\|\n\': ]+)\]/','helper_externlinks',$html);
	// with text
	//$html = preg_replace('/\[([^\[\]\|\n\' ]+)[\| ]([^\]\']+)\]/','<a href="${1}">${2}</a>',$html);
	$html = preg_replace_callback('/\[([^\[\]\|\n\' ]+)[\| ]([^\]\']+)\]/','helper_externlinks',$html);
	
	// allowed tags
	$html = preg_replace('/&lt;(\/?)(small|sup|sub|u)&gt;/','<${1}${2}>',$html);
	
	$html = preg_replace('/\n*&lt;br *\/?&gt;\n*/',"\n",$html);
	$html = preg_replace('/&lt;(\/?)(math|pre|code|nowiki)&gt;/','<${1}pre>',$html);
	$html = preg_replace('/&lt;!--/','<!--',$html);
	$html = preg_replace('/--&gt;/',' -->',$html);
 
	// headings
	for($i=7;$i>0;$i--){
		$html = preg_replace(
			'/\n+[=]{'.$i.'}([^=]+)[=]{'.$i.'}\n*/',
			'<h'.$i.'>${1}</h'.$i.'>',
			$html
		);
	}
	
	//lists
	$html = preg_replace(
		'/(\n[ ]*[^#* ][^\n]*)\n(([ ]*[*]([^\n]*)\n)+)/',
		'${1}<ul>'."\n".'${2}'.'</ul>'."\n",
		$html
	);
	$html = preg_replace(
		'/(\n[ ]*[^#* ][^\n]*)\n(([ ]*[#]([^\n]*)\n)+)/',
		'${1}<ol>'."\n".'${2}'.'</ol>'."\n",
		$html
	);
	$html = preg_replace('/\n[ ]*[\*#]+([^\n]*)/','<li>${1}</li>',$html);
	
	$html = preg_replace('/----/','<hr />',$html);
 
	//$html = nl2br($html);
	// line breaks
	$html = preg_replace('/[\n\r]{4}/',"<br/><br/>",$html);
	$html = preg_replace('/[\n\r]{2}/',"<br/>",$html);
	
	$html = preg_replace('/[>]<br\/>[<]/',"><",$html);
 
	return $html;
}
function helper_externlinks($matches){
	$target = $matches[1];
	$text = empty($matches[2])?$matches[1]:$matches[2];
	return '<a href="'.$target.'">'.$text.'</a>';
}
function helper_interwikilinks($matches){
	$target = $matches[1];
	$text = empty($matches[2])?$matches[1]:$matches[2];
	$class=" class=\"dunno\" ";
	/*static $links_checked_interwiki = 0;
	if(!$_GET["nocache"] && ++$links_checked_interwiki<10){
		$data = cachedFunc("getPos",$target);
		if($data["pos"]) $class = " class=\"exists\" "; $class = " class=\"notexists\" ";
	}*/
	return '<a '.$class.' href="?pages='.$target.'">'.$text.'</a>';
}
function convertTables($text){
	$lines = explode("\n",$text);
	$innertable = 0;
	$innertabledata = array();
	foreach($lines as $line){
		//echo "<pre>".++$i.": ".htmlspecialchars($line)."</pre>";
		$line = str_replace("position:relative","",$line);
		$line = str_replace("position:absolute","",$line);
		if(substr($line,0,2) == '{|'){
			// inner table
			//echo "<p>beginning inner table #$innertable</p>";
			$innertable++;
		}
		$innertabledata[$innertable] .= $line . "\n";
		if($innertable){
			// we're inside
			if(substr($line,0,2) == '|}'){
				$innertableconverted = convertTable($innertabledata[$innertable]);
				$innertabledata[$innertable] = "";
				$innertable--;
				$innertabledata[$innertable] .= $innertableconverted."\n";
			}
		}
	}
	return $innertabledata[0];
}

function convertTable($intext){
	$text = $intext;
	$lines = explode("\n",$text);
	$intable = false;
	
	//var_dump($lines);
	foreach($lines as $line){
		$line = trim($line);
		if(substr($line,0,1) == '{'){
			//begin of the table
			$stuff = explode('| ',substr($line,1),2);
			$tableopen = true;
			$table = "<table ".$stuff[0].">\n";
		} else if(substr($line,0,1) == '|'){
			// table related
			$line = substr($line,1);
			if(substr($line,0,5) == '-----'){
				// row break
				if($thopen)
					$table .="</th>\n";
				if($tdopen)
					$table .="</td>\n";
				if($rowopen)
					$table .="\t</tr>\n";
				$table .= "\t<tr>\n";
				$rowopen = true;
				$tdopen = false;
				$thopen = false;
			}else if(substr($line,0,1) == '}'){
				// table end
				break;
			}else{
				// td
				$stuff = explode('| ',$line,2);
				if($tdopen)
					$table .="</td>\n";
				if(count($stuff)==1)
					$table .= "\t\t<td>".simpleText($stuff[0]);
				else
					$table .= "\t\t<td ".$stuff[0].">".
						simpleText($stuff[1]);
				$tdopen = true;
			}
		} else if(substr($line,0,1) == '!'){
			// th
			$stuff = explode('| ',substr($line,1),2);
			if($thopen)
				$table .="</th>\n";
			if(count($stuff)==1)
				$table .= "\t\t<th>".simpleText($stuff[0]);
			else
				$table .= "\t\t<th ".$stuff[0].">".
					simpleText($stuff[1]);
			$thopen = true;
		}else{
			// plain text
			$table .= simpleText($line) ."\n";
		}
		//echo "<pre>".++$i.": ".htmlspecialchars($line)."</pre>";
		//echo "<p>Table so far: <pre>".htmlspecialchars($table)."</pre></p>";
	}
	if($thopen)
		$table .="</th>\n";
	if($tdopen)
		$table .="</td>\n";
	if($rowopen)
		$table .="\t</tr>\n";
	if($tableopen)
		$table .="</table>\n";
	//echo "<hr />";
	//echo "<p>Table at the end: <pre>".htmlspecialchars($table)."</pre></p>";
	//echo $table;	
	return $table;
}
