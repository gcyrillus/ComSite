<?php
class ComSite extends plxPlugin {	 
	const BEGIN_CODE = '<?php' . PHP_EOL;
	const END_CODE = PHP_EOL . '?>';
    
	public function __construct($default_lang) {

		# appel du constructeur de la classe plxPlugin (obligatoire)
		parent::__construct($default_lang);
		
		# déclaration des hooks
		$this->addHook('plxShowLastComList', 'plxShowLastComList');
		

	}	
	public function plxShowLastComList(){ 
			echo self::BEGIN_CODE;
?>
 # Génération de notre motif
        if (empty($art_id))
            $motif = '/^[0-9]{4}.[0-9]{10}-[0-9]+.xml$/';
        else
            $motif = '/^' . str_pad($art_id, 4, '0', STR_PAD_LEFT) . '.[0-9]{10}-[0-9]+.xml$/';

        $count = 1;
        $datetime = date('YmdHi');
        # Nouvel objet plxGlob et récupération des fichiers
        $plxGlob_coms = clone $this->plxMotor->plxGlob_coms;
        if ($aFiles = $plxGlob_coms->query($motif, 'com', 'rsort', 0, false, 'before')) {
            $aComArtTitles = array(); # tableau contenant les titres des articles
            $isComArtTitle = (strpos($format, '#com_art_title') != FALSE) ? true : false;
            # On parcourt les fichiers des commentaires
            foreach ($aFiles as $v) {
                # On filtre si le commentaire appartient à un article d'une catégorie inactive
                if (isset($this->plxMotor->activeArts[substr($v, 0, 4)])) {
                    $com = $this->plxMotor->parseCommentaire(PLX_ROOT . $this->plxMotor->aConf['racine_commentaires'] . $v);
                    $artInfo = $this->plxMotor->artInfoFromFilename($this->plxMotor->plxGlob_arts->aFiles[$com['article']]);
                    if ($artInfo['artDate'] <= $datetime) { # on ne prends que les commentaires pour les articles publiés
                        if (empty($cat_ids) or preg_match('/(' . $cat_ids . ')/', $artInfo['catId'])) {
                            $url = '?article' . intval($com['article']) . '/' . $artInfo['artUrl'] . '#c' . $com['article'] . '-' . $com['index'];
                            $date = $com['date'];
                            $content = strip_tags($com['content']);
                            # On modifie nos motifs
                            $row = str_replace('L_SAID', L_SAID, $format);
                            $row = str_replace('#com_id', $com['index'], $row);
                            $row = str_replace('#com_url', $this->plxMotor->urlRewrite($url), $row);
                            $row = str_replace('#com_author', $com['author'], $row);
                            $row = str_replace('#com_site', $com['site'], $row);
                            while (preg_match('/#com_content\(([0-9]+)\)/', $row, $capture)) {
                                if ($com['author'] == 'admin')
                                    $row = str_replace('#com_content(' . $capture[1] . ')', plxUtils::strCut($content, $capture[1]), $row);
                                else
                                    $row = str_replace('#com_content(' . $capture[1] . ')', plxUtils::strCheck(plxUtils::strCut(plxUtils::strRevCheck($content), $capture[1])), $row);
                            }
                            $row = str_replace('#com_content', $content, $row);
                            $row = str_replace('#com_date', plxDate::formatDate($date, '#num_day/#num_month/#num_year(4)'), $row);
                            $row = str_replace('#com_hour', plxDate::formatDate($date, '#time'), $row);
                            $row = plxDate::formatDate($date, $row);
                            # récupération du titre de l'article
                            if ($isComArtTitle) {
                                if (isset($aComArtTitles[$com['article']])) {
                                    $row = str_replace('#com_art_title', $aComArtTitles[$com['article']], $row);
                                } else {
                                    if ($file = $this->plxMotor->plxGlob_arts->query('/^' . $com['article'] . '.(.*).xml$/')) {
                                        $art = $this->plxMotor->parseArticle(PLX_ROOT . $this->plxMotor->aConf['racine_articles'] . $file[0]);
                                        $aComArtTitles[$com['article']] = $art_title = $art['title'];
                                        $row = str_replace('#com_art_title', $art_title, $row);
                                    }
                                }
                            }
                            # On genère notre ligne
                            echo $row;
                            $count++;
                        }
                    }
                }
                if ($count > $max) break;
            }
        }
        //exit; 
        $format=''; // stoppe l'affichage
<?php
		echo self::END_CODE;
        
       }
}
?>
