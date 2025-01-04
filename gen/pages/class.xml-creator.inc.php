<?php // This file is protected by copyright law and provided under license. Reverse engineering of this file is strictly prohibited.




































































































$pUrtG11518859LGtPG=293035553;$ByZAL76524964uplrt=986311310;$GwAMg66824036evrDH=491323395;$BrEcf86478577ECNUs=712415558;$hzMWe14551086uRPUD=57431549;$MTPkd45104065DGQmG=430715118;$XXLCa57200012iblzj=240110016;$fCEQN64901428oMrVL=390959991;$VSjvv37270813xdZfk=290108795;$ufaEW78370667ASCos=842900177;$UbZfW67263489tvBIe=457177887;$KMzTk18011779uWhbC=38285675;$lqAFX79678040meOPN=991067292;$akAAd86324768jaxwK=224866485;$BHxoG97014466ZxgIk=143527008;$hheUr35809631vERpM=653392609;$rCFIb51772766bJeFe=162307037;$PaluK68966370NaMuB=574614044;$AHgmi56452942mdlaK=298157379;$ZHEUQ28294983twBiX=238280792;$WWtBy43554993jxqYm=800828034;$yKzzL26295471wSPbw=893142853;$ammgT35578918NkKFT=921069001;$TmCYE85467835rMvdI=790950226;$TZKJA55024719XwToh=908630280;$YfcTg48312073bHbNB=181452911;$bVwEi34392395gtSBG=14261871;$xvuEp27328186ccqLj=313400909;$kVLML86181946zUJcz=485713776;$kyfHn45016174lodJK=437544220;$iyVgG52893372vCEDd=574735993;$fTobx33876037tfOdP=803632843;$nLqLU47026672LlmxS=531078522;$CuqCj16407775defLs=662416779;$vMpmQ91081849vKSxl=604491364;$fNrsk15111389yOviB=263646026;$flPXO27558899ZJStI=45724517;$LaRwY52486877HzaXF=856070588;$dTHis58957825gmJLv=103527984;$xRFpU61034241mmflt=691440460;$KcPEG27778625XjGQF=28651763;$YDNyE63253479ElQft=19505645;$GCLfj46521301NjkJM=70845855;$RzzqU81644593lGjne=89016143;$JaeOM47685852HKdIg=479860260;$Tmkoy48707580PnHVk=150721954;$ABNXh53772278mBdnC=506444977;$AcFFk76942444jEgBA=454373077;$aMJhf87280579bobmu=400350006;$Izdph98849183oktGk=250719513;?><?php if(!class_exists('XMLCreator')) { class XMLCreator { var $aWQSGn6KWTk7x4HBX3  = array(); var $Xm5TKOzcDly01EH2 = array('xml','','','','mobile'); var $mE5mRg2rujhrYAd59i9 = array(); var $cDlklVLqKAn_Xc = array(),  $gY_IcYa9NNIDgh7X_1 = array(),  $JJMpKsnUbJ = array(); var $a9Kya_3xGKImuvz = 1000; function A9WzwJYtTB0O3GkI69(&$jHdlUOSOV) { $PQ88kZzO1uRFvk = false; if(is_array($jHdlUOSOV)) foreach($jHdlUOSOV as $k=>$v){ if(strlen($k)>200){ $PQ88kZzO1uRFvk = true; $jHdlUOSOV[$k] = substr($v, 0, 200); } } } function nBJII2x1AG_zc($mE5mRg2rujhrYAd59i9, $urls_completed, $JnjWLFycu) { global $TS2WAQ4zWkdnI_, $ICDtF9k5qRIaFX; $ICDtF9k5qRIaFX = array();    $this->cf9WUidVAtiud = new gYT2DH5A_("pages/"); $this->mE5mRg2rujhrYAd59i9 = $mE5mRg2rujhrYAd59i9; if($this->mE5mRg2rujhrYAd59i9['xs_chlog_list_max']) $this->a9Kya_3xGKImuvz = $this->mE5mRg2rujhrYAd59i9['xs_chlog_list_max'];  $iM0z82gnwPfmE0lYG = basename($this->mE5mRg2rujhrYAd59i9['xs_smname']); $this->uurl_p = dirname($this->mE5mRg2rujhrYAd59i9['xs_smurl']).'/'; $this->furl_p = dirname($this->mE5mRg2rujhrYAd59i9['xs_smname']).'/'; $this->imgno = 0; $this->A18lnbzsiL = ($this->mE5mRg2rujhrYAd59i9['xs_compress']==1) ? '.gz' : ''; $this->cDlklVLqKAn_Xc = $this->gY_IcYa9NNIDgh7X_1 = $this->urls_prevrss = array(); if($this->mE5mRg2rujhrYAd59i9['xs_chlog']) $this->cDlklVLqKAn_Xc = $this->JAvBiMmjzH($iM0z82gnwPfmE0lYG); if($this->mE5mRg2rujhrYAd59i9['xs_rssinfo']) $this->urls_prevrss = $this->JAvBiMmjzH($this->mE5mRg2rujhrYAd59i9['xs_rssfilename'], $this->mE5mRg2rujhrYAd59i9['xs_rssage'], false, 1); if($this->mE5mRg2rujhrYAd59i9['xs_newsinfo']) $this->gY_IcYa9NNIDgh7X_1 = $this->JAvBiMmjzH($this->mE5mRg2rujhrYAd59i9['xs_newsfilename'], $this->mE5mRg2rujhrYAd59i9['xs_newsage']); $eX2N9ADyfLy6Jg9 = $Ut19te9V_i = array(); $this->eOThR9i3EU = ($this->mE5mRg2rujhrYAd59i9['xs_compress']==1) ? array('fopen' => 'gzopen', 'fwrite' => 'gzwrite', 'fclose' => 'gzclose' ) : array('fopen' => 'cVhR96lmkjBRF', 'fwrite' => 'fwrite', 'fclose' => 'fclose' ) ; $yIjmVkxO05cWS5gTB53 = strstr($this->mE5mRg2rujhrYAd59i9['xs_initurl'],'://www.');
																									 $J4vFT7Ito = $TS2WAQ4zWkdnI_.'/'; if(strstr($this->mE5mRg2rujhrYAd59i9['xs_initurl'],'https:')) $J4vFT7Ito = str_replace('http:', 'https:', $J4vFT7Ito); $Anwo83cgBW0AC = strstr($J4vFT7Ito,'://www.');
																									 $p1 = parse_url($this->mE5mRg2rujhrYAd59i9['xs_initurl']); $p2 = parse_url($J4vFT7Ito); if(str_replace('www.', '', $p1['host'])==str_replace('www.', '', $p2['host']))  { if($yIjmVkxO05cWS5gTB53 && !$Anwo83cgBW0AC)$J4vFT7Ito = str_replace('://', '://www.', $J4vFT7Ito);
																									 if(!$yIjmVkxO05cWS5gTB53 && $Anwo83cgBW0AC)$J4vFT7Ito = str_replace('://www.', '://', $J4vFT7Ito);
																									 } $this->mE5mRg2rujhrYAd59i9['gendom'] = $J4vFT7Ito; $this->aHYbmExGS2Xg9WZI($urls_completed, $eX2N9ADyfLy6Jg9); $this->fweJBhwTM1h(); if($this->mE5mRg2rujhrYAd59i9['xs_chlog']) { $g192oehb7n  = array_keys($this->JJMpKsnUbJ); $YnWE4QL8VN0xpL = array_slice(array_keys($this->cDlklVLqKAn_Xc), 0, $this->a9Kya_3xGKImuvz); } if($this->imgno)$this->aWQSGn6KWTk7x4HBX3[1]['xn'] = $this->imgno; if($this->videos_no)$this->aWQSGn6KWTk7x4HBX3[2]['xn'] = $this->videos_no; if($this->news_no)$this->aWQSGn6KWTk7x4HBX3[3]['xn'] = $this->news_no; $this->A9WzwJYtTB0O3GkI69($g192oehb7n); $this->A9WzwJYtTB0O3GkI69($YnWE4QL8VN0xpL); $uq8LJ8X9g0o = array_merge($JnjWLFycu, array( 'files'   => array(), 'rinfo'   => $this->aWQSGn6KWTk7x4HBX3, 'newurls' => $g192oehb7n, 'losturls'=> $YnWE4QL8VN0xpL, 'urls_ext'=> $JnjWLFycu['urls_ext'], 'images_no'  => $this->imgno, 'videos_no' => $this->videos_no, 'news_no'  => $this->newsno, 'rss_no'  => $this->rssno, 'rss_sm'  => $this->mE5mRg2rujhrYAd59i9['xs_rssfilename'], 'fail_files' => $ICDtF9k5qRIaFX, 'create_time' => time() )); $nU8Mj5ZUWIEjvw = array('u404', 'urls_ext', 'urls_list_skipped', 'newurls', 'losturls'); foreach($nU8Mj5ZUWIEjvw as $ca) $this->A9WzwJYtTB0O3GkI69($uq8LJ8X9g0o[$ca]); $F9VsKsac910 = date('Y-m-d H-i-s').'.log'; m0HngeVPuiULaXDb($F9VsKsac910,serialize($uq8LJ8X9g0o)); $this->cDlklVLqKAn_Xc = $this->JJMpKsnUbJ = $this->gY_IcYa9NNIDgh7X_1 = $this->urls_prevrss = array(); $eX2N9ADyfLy6Jg9 = array(); return $uq8LJ8X9g0o; } function C1ZRyst7ZYH($pf) { global $wVJwdqXebp; if(!$pf)return; $this->eOThR9i3EU['fwrite']($pf, $wVJwdqXebp[3]); $this->eOThR9i3EU['fclose']($pf); } function AUsclCf2r5Z($pf, $oFc4jrnPZGNmGhxz) { global $wVJwdqXebp; if(!$pf)return; $xs = $this->cf9WUidVAtiud->UhW8Rxuh0rGTpQQ($wVJwdqXebp[1], array('TYPE'.$oFc4jrnPZGNmGhxz=>true)); $this->eOThR9i3EU['fwrite']($pf, $xs); } function nNMzp2IgH7HiM($Ut19te9V_i) { $AasFqOeqKSJsYFP3O = ""; $M4MpKAUCS4w3 = vHwDy8urTbxymoY7y(yCwTqe5GDcta,  'sitemap_index_tpl.xml'); $zEyjCxqNkuX = file_get_contents(yCwTqe5GDcta.$M4MpKAUCS4w3); preg_match('#^(.*)%SITEMAPS_LIST_FROM%(.*)%SITEMAPS_LIST_TO%(.*)$#is', $zEyjCxqNkuX, $hAj_8ByddeCCh1lT); $hAj_8ByddeCCh1lT[1] = str_replace('%GEN_URL%', $this->mE5mRg2rujhrYAd59i9['gendom'], $hAj_8ByddeCCh1lT[1]); $QVcuW67y39PsmXB = preg_replace('#[^\\/]+?\.xml$#', '', $this->mE5mRg2rujhrYAd59i9['xs_smurl']); $hAj_8ByddeCCh1lT[1] = str_replace('%SM_BASE%', $QVcuW67y39PsmXB, $hAj_8ByddeCCh1lT[1]); for($i=0;$i<count($Ut19te9V_i);$i++) $AasFqOeqKSJsYFP3O.= $this->cf9WUidVAtiud->UhW8Rxuh0rGTpQQ($hAj_8ByddeCCh1lT[2], array( 'URL'=>$Ut19te9V_i[$i], 'LASTMOD'=>date('Y-m-d\TH:i:s+00:00') )); return $hAj_8ByddeCCh1lT[1] . $AasFqOeqKSJsYFP3O . $hAj_8ByddeCCh1lT[3]; } function vZKpEamsDiBU($UKtncM2wyxnKIuvU, $K08dPkTModx = false) { if($K08dPkTModx){ $t = htmlspecialchars($UKtncM2wyxnKIuvU); $t = preg_replace("#&amp;(\#[\w\d]+;)#", '&$1', $t); $t = preg_replace("#&amp;((gt|lt|quot|amp|apos);)#", '&$1', $t); $t = preg_replace('#[\x00-\x1F\x7F]#', ' ', $t); }else $t = str_replace("&", "&amp;", $UKtncM2wyxnKIuvU); if(function_exists('utf8_encode') && !$this->mE5mRg2rujhrYAd59i9['xs_utf8']) { $t = utf8_encode($t); } return $t; } function Ufz4hdNjXhLx60oBsLt($rPpV2duBzldWXxW3Mr) { global $K08dPkTModx; $l = str_replace("&amp;", "&", $rPpV2duBzldWXxW3Mr); $l = str_replace("&", "&amp;", $l); $l = strtr($l, $K08dPkTModx); if($this->mE5mRg2rujhrYAd59i9['xs_utf8']) { }else if(function_exists('utf8_encode')) $l = utf8_encode($l); return $l; } function XNUfCNwhY4T($mwH4bedMI2CoGuK5mcs) { $QmKaHsN_mnHEfYSpTEg = array( basename($this->mE5mRg2rujhrYAd59i9['xs_smname']),  $this->mE5mRg2rujhrYAd59i9['xs_imgfilename'], $this->mE5mRg2rujhrYAd59i9['xs_videofilename'], $this->mE5mRg2rujhrYAd59i9['xs_newsfilename'], $this->mE5mRg2rujhrYAd59i9['xs_mobilefilename'], ); if($mwH4bedMI2CoGuK5mcs['rinfo']) $this->aWQSGn6KWTk7x4HBX3 = $mwH4bedMI2CoGuK5mcs['rinfo']; foreach($this->Xm5TKOzcDly01EH2 as $oFc4jrnPZGNmGhxz=>$aeUWWdnqzr5WR) if($aeUWWdnqzr5WR) { $this->aWQSGn6KWTk7x4HBX3[$oFc4jrnPZGNmGhxz]['sitemap_file'] = $QmKaHsN_mnHEfYSpTEg[$oFc4jrnPZGNmGhxz]; $this->aWQSGn6KWTk7x4HBX3[$oFc4jrnPZGNmGhxz]['filenum'] = intval($mwH4bedMI2CoGuK5mcs['istart']/$this->UaofOtwTIyf)+1; if(!$mwH4bedMI2CoGuK5mcs['istart']) $this->T9mnmC3k9eENcJDb44Q($QmKaHsN_mnHEfYSpTEg[$oFc4jrnPZGNmGhxz]); } } function mVTd3cRsYoUPyznbMc() { global $ICDtF9k5qRIaFX; $H9ksmjIXr = 0; $l = false; foreach($this->Xm5TKOzcDly01EH2 as $oFc4jrnPZGNmGhxz=>$aeUWWdnqzr5WR) { $ri = &$this->aWQSGn6KWTk7x4HBX3[$oFc4jrnPZGNmGhxz]; $PfbhgdTernTpzDj = (($ri['xnp'] % $this->UaofOtwTIyf) == 0) && ($ri['xnp'] || !$ri['pf']); $l|=$PfbhgdTernTpzDj; if($this->sm_filesplit && $ri['xchs'] && $ri['xnp']) $PfbhgdTernTpzDj |= ($ri['xchs']/$ri['xnp']*($ri['xnp']+1)>$this->sm_filesplit); if( $PfbhgdTernTpzDj ) { $H9ksmjIXr++; $ri['xchs'] = $ri['xnp'] = 0; $this->C1ZRyst7ZYH($ri['pf']); if($ri['filenum'] == 2) { if(!copy(a0mMmHqPDZ . $ri['sitemap_file'].$this->A18lnbzsiL,  a0mMmHqPDZ.($_xu = ZW04gbhF9A8P(1,$ri['sitemap_file']).$this->A18lnbzsiL))) { $ICDtF9k5qRIaFX[] = a0mMmHqPDZ.$_xu; } $ri['urls'][0] = $this->uurl_p . $_xu; } $OoPd6StGvQeMdCboUV = (($ri['filenum']>1) ? ZW04gbhF9A8P($ri['filenum'],$ri['sitemap_file']) :$ri['sitemap_file']) . $this->A18lnbzsiL; $ri['urls'][] = $this->uurl_p . $OoPd6StGvQeMdCboUV; $ri['filenum']++; $ri['pf'] = $this->eOThR9i3EU['fopen'](a0mMmHqPDZ.$OoPd6StGvQeMdCboUV,'w'); if(!$ri['pf']) $ICDtF9k5qRIaFX[] = a0mMmHqPDZ.$OoPd6StGvQeMdCboUV; $this->AUsclCf2r5Z($ri['pf'], $oFc4jrnPZGNmGhxz); } } return $l; } function fslY6ssCNGE($Sg9qW4hdbZ, $wVJwdqXebp, $oFc4jrnPZGNmGhxz) { $Sg9qW4hdbZ['TYPE'.$oFc4jrnPZGNmGhxz] = true; $ri = &$this->aWQSGn6KWTk7x4HBX3[$oFc4jrnPZGNmGhxz]; if($ri['pf']) { $_xu = $this->cf9WUidVAtiud->UhW8Rxuh0rGTpQQ($wVJwdqXebp, $Sg9qW4hdbZ); $ri['xchs'] += strlen($_xu); $ri['xn']++; $ri['xnp']++; $this->eOThR9i3EU['fwrite']($ri['pf'], $_xu); } }  function zdUTg22HNObKCXmp() { foreach($this->aWQSGn6KWTk7x4HBX3 as $oFc4jrnPZGNmGhxz=>$ri) { $this->C1ZRyst7ZYH($ri['pf']); } } function fweJBhwTM1h() { foreach($this->Xm5TKOzcDly01EH2 as $oFc4jrnPZGNmGhxz=>$aeUWWdnqzr5WR) { $ri = &$this->aWQSGn6KWTk7x4HBX3[$oFc4jrnPZGNmGhxz]; if(count($ri['urls'])>1) { $xf = $this->nNMzp2IgH7HiM($ri['urls']); array_unshift($ri['urls'],  $this->uurl_p.m0HngeVPuiULaXDb($ri['sitemap_file'], $xf, a0mMmHqPDZ, ($this->mE5mRg2rujhrYAd59i9['xs_compress']==1)) ); } $this->uNFFhEr_Ldjz6gLuOb($ri['sitemap_file']); } } function hRkxxxwtG($elNljYZlpLLDN) { 
																									return $elNljYZlpLLDN;
																									}
																									function aHYbmExGS2Xg9WZI($urls_completed, &$eX2N9ADyfLy6Jg9)
																									{
																									global $wVJwdqXebp, $JHGRPqNtoGHGfef4Ke, $WFYPUhXuj, $sm_proc_list, $mwH4bedMI2CoGuK5mcs, $BV1pSxR54kpodwwaw, $ICDtF9k5qRIaFX;
																									$chfKQ2jb8QOC = $this->mE5mRg2rujhrYAd59i9['xs_chlog'];
																									$M4MpKAUCS4w3 = vHwDy8urTbxymoY7y(yCwTqe5GDcta,  'sitemap_xml_tpl.xml');
																									$zEyjCxqNkuX = file_get_contents(yCwTqe5GDcta.$M4MpKAUCS4w3);
																									preg_match('#^(.*)%URLS_LIST_FROM%(.*)%URLS_LIST_TO%(.*)$#is', $zEyjCxqNkuX, $wVJwdqXebp);
																									$wVJwdqXebp[1] = str_replace('www.xml-sitemaps.com', 'www.xml-sitemaps.com ('. pAo1GkXiqGnhFvayP.')', $wVJwdqXebp[1]);
																									$wVJwdqXebp[1] = str_replace('%GEN_URL%', $this->mE5mRg2rujhrYAd59i9['gendom'], $wVJwdqXebp[1]);
																									$QVcuW67y39PsmXB = preg_replace('#[^\\/]+?\.xml$#', '', $this->mE5mRg2rujhrYAd59i9['xs_smurl']);
																									$wVJwdqXebp[1] = str_replace('%SM_BASE%', $QVcuW67y39PsmXB, $wVJwdqXebp[1]);
																									if($this->mE5mRg2rujhrYAd59i9['xs_disable_xsl'])
																									$wVJwdqXebp[1] = preg_replace('#<\?xml-stylesheet.*\?>#', '', $wVJwdqXebp[1]);
																									if($this->mE5mRg2rujhrYAd59i9['xs_nobrand']){
																									$wVJwdqXebp[1] = str_replace('sitemap.xsl','sitemap_nb.xsl',$wVJwdqXebp[1]);
																									$wVJwdqXebp[1] = preg_replace('#<!-- created.*?>#','',$wVJwdqXebp[1]);
																									}
																									$LwDUDx9css267qOr = implode('', file(yCwTqe5GDcta.'sitemap_ror_tpl.xml'));
																									preg_match('#^(.*)%URLS_LIST_FROM%(.*)%URLS_LIST_TO%(.*)$#is', $LwDUDx9css267qOr, $JHGRPqNtoGHGfef4Ke);
																									$aSzeQB2V8mI9JsaPdj = implode('', file(yCwTqe5GDcta.'sitemap_rss_tpl.xml'));
																									preg_match('#^(.*)%URLS_LIST_FROM%(.*)%URLS_LIST_TO%(.*)$#is', $aSzeQB2V8mI9JsaPdj, $ECiIdFEhSN3p79);
																									$UIPYmw0UFeGY = implode('', file(yCwTqe5GDcta.'sitemap_base_tpl.xml'));
																									preg_match('#^(.*)%URLS_LIST_FROM%(.*)%URLS_LIST_TO%(.*)$#is', $UIPYmw0UFeGY, $WFYPUhXuj);
																									$this->UaofOtwTIyf = $this->mE5mRg2rujhrYAd59i9['xs_sm_size']?$this->mE5mRg2rujhrYAd59i9['xs_sm_size']:50000;
																									$this->sm_filesplit = $this->mE5mRg2rujhrYAd59i9['xs_sm_filesize']?$this->mE5mRg2rujhrYAd59i9['xs_sm_filesize']:10;
																									$this->sm_filesplit = max(intval($this->sm_filesplit*1024*1024),2000)-1000;
																									if(!$this->mE5mRg2rujhrYAd59i9['xs_imginfo'])
																									unset($this->Xm5TKOzcDly01EH2[1]);
																									if(!$this->mE5mRg2rujhrYAd59i9['xs_videoinfo'])
																									unset($this->Xm5TKOzcDly01EH2[2]);
																									if(!$this->mE5mRg2rujhrYAd59i9['xs_newsinfo'])
																									unset($this->Xm5TKOzcDly01EH2[3]);
																									if(!$this->mE5mRg2rujhrYAd59i9['xs_makemob'])
																									unset($this->Xm5TKOzcDly01EH2[4]);
																									if(!$this->mE5mRg2rujhrYAd59i9['xs_rssinfo'])
																									unset($this->Xm5TKOzcDly01EH2[5]);
																									$ctime = date('Y-m-d H:i:s');
																									$YXTA92G4TJCX = 0;
																									global $K08dPkTModx;
																									$tt = array('<','>');
																									foreach ($tt as $VJrkoghoW )
																									$K08dPkTModx[$VJrkoghoW] = '&#'.ord($VJrkoghoW).';';
																									for($i=0;$i<31;$i++)
																									$K08dPkTModx[chr($i)] = '&#'.$i.';';
																									$K08dPkTModx[chr(0)] = $K08dPkTModx[chr(10)] = $K08dPkTModx[chr(13)] = '';
																									$K08dPkTModx[' '] = '%20';
																									$pf = 0;
																									
																									$FYiNH6n7n6k = intval($mwH4bedMI2CoGuK5mcs['istart']);
																									$this->XNUfCNwhY4T($mwH4bedMI2CoGuK5mcs);
																									if($this->mE5mRg2rujhrYAd59i9['xs_maketxt'])
																									{
																									$R8zvvOHJCjp = $this->eOThR9i3EU['fopen'](Tl5grrNPKv7IY.$this->A18lnbzsiL, $FYiNH6n7n6k?'a':'w');
																									if(!$R8zvvOHJCjp)$ICDtF9k5qRIaFX[] = Tl5grrNPKv7IY.$this->A18lnbzsiL;
																									}
																									if($this->mE5mRg2rujhrYAd59i9['xs_makeror'])
																									{
																									$MY9uRPqbKXzuC = cVhR96lmkjBRF(Jh02oPSmnHw, $FYiNH6n7n6k?'a':'w');
																									$rc = str_replace('%INIT_URL%', $this->mE5mRg2rujhrYAd59i9['xs_initurl'], $JHGRPqNtoGHGfef4Ke[1]);
																									if($MY9uRPqbKXzuC)
																									fwrite($MY9uRPqbKXzuC, $rc);
																									else
																									$ICDtF9k5qRIaFX[] = Jh02oPSmnHw;
																									}
																									if($this->mE5mRg2rujhrYAd59i9['xs_rssinfo'])
																									{
																									$K2dHWcwY5bEP = uCIu22Zx7O4C0vkg_;
																									$Toy1DGI3eNLNBNIr = cVhR96lmkjBRF($K2dHWcwY5bEP, $FYiNH6n7n6k?'a':'w');
																									$rc = str_replace('%INIT_URL%', $this->mE5mRg2rujhrYAd59i9['xs_initurl'], $ECiIdFEhSN3p79[1]);
																									$rc = str_replace('%FEED_TITLE%', $this->mE5mRg2rujhrYAd59i9['xs_rsstitle'], $rc);
																									$rc = str_replace('%BUILD_DATE%', $ctime, $rc);
																									if($Toy1DGI3eNLNBNIr)
																									fwrite($Toy1DGI3eNLNBNIr, $rc);
																									else
																									$ICDtF9k5qRIaFX[] = $K2dHWcwY5bEP;
																									}
																									if($sm_proc_list)
																									foreach($sm_proc_list as $k=>$uLixYZtHVmoN4v7)
																									$sm_proc_list[$k]->PYyS9SPDWu0Pb3bvG8($this->mE5mRg2rujhrYAd59i9, $this->eOThR9i3EU, $this->cf9WUidVAtiud);
																									if($this->mE5mRg2rujhrYAd59i9['xs_write_delay'])
																									list($tJrSkNDeGtrN7kX, $els6pG4dU2RM20k) = explode('|',$this->mE5mRg2rujhrYAd59i9['xs_write_delay']);
																									for($i=$xn=$FYiNH6n7n6k;$i<count($urls_completed);$i++,$xn++)
																									{   
																									
																									
																									
																									if($i%100 == 0) {
																									W5mf7Y9Huk0KaQU6();
																									fTr9xtaaPTXU(" / $i / ".(time()-$_tm));
																									$_tm=time();
																									}
																									aRjeSjk24(array(
																									'cmd'=> 'info',
																									'id' => 'percprog',
																									'text'=> number_format($i*100/count($urls_completed),0).'%'
																									));
																									$H9ksmjIXr = $this->mVTd3cRsYoUPyznbMc();
																									if($H9ksmjIXr && ($i != $FYiNH6n7n6k))
																									{
																									m0HngeVPuiULaXDb($BV1pSxR54kpodwwaw,wJu5NxAjkFkQBpMse(array('istart'=>$i,'rinfo'=>$this->aWQSGn6KWTk7x4HBX3)));
																									}
																									if($this->mE5mRg2rujhrYAd59i9['xs_memsave'])
																									{
																									$cu = xn22ZOg5Ng($urls_completed[$i]);
																									}else
																									$cu = $urls_completed[$i];
																									if(!is_array($cu)) $cu = @unserialize($cu);
																									$l = $this->Ufz4hdNjXhLx60oBsLt($cu['link']);
																									$cu['link'] = $l;
																									$t = $this->vZKpEamsDiBU($cu['t']);
																									$d = $this->vZKpEamsDiBU($cu['d'] ? $cu['d'] : $cu['t'], true);
																									$dr1lN9apl = '';
																									if($cu['clm'])
																									$dr1lN9apl = $cu['clm'];
																									else
																									switch($this->mE5mRg2rujhrYAd59i9['xs_lastmod']){
																									case 1:$dr1lN9apl = $cu['lm']?$cu['lm']:$ctime;break;
																									case 2:$dr1lN9apl = $ctime;break;
																									case 3:$dr1lN9apl = $this->mE5mRg2rujhrYAd59i9['xs_lastmodtime'];break;
																									}
																									$GemKMfObNXtkeAmJ = $XnUbn0PvStizD = false;
																									if($cu['p'])
																									$p = $cu['p'];
																									else
																									{
																									$p = $this->mE5mRg2rujhrYAd59i9['xs_priority'];
																									if($this->mE5mRg2rujhrYAd59i9['xs_autopriority'])
																									{
																									$p = $p*pow($this->mE5mRg2rujhrYAd59i9['xs_descpriority']?$this->mE5mRg2rujhrYAd59i9['xs_descpriority']:0.8,$cu['o']);
																									if($this->cDlklVLqKAn_Xc)
																									{
																									$GemKMfObNXtkeAmJ = true;
																									$XnUbn0PvStizD = ($this->cDlklVLqKAn_Xc&&!isset($this->cDlklVLqKAn_Xc[$cu['link']]))||$this->gY_IcYa9NNIDgh7X_1[$cu['link']];
																									if($XnUbn0PvStizD)
																									$p=0.95;
																									}
																									$p = max(0.0001,min($p,1.0));
																									$p = @number_format($p, 4);
																									}
																									}
																									if($dr1lN9apl){
																									$dr1lN9apl = strtotime($dr1lN9apl);
																									$dr1lN9apl = gmdate('Y-m-d\TH:i:s+00:00',$dr1lN9apl);
																									}
																									$f = $cu['f']?$cu['f']:$this->mE5mRg2rujhrYAd59i9['xs_freq'];
																									$Sg9qW4hdbZ = array(
																									'URL'=>$l,
																									'TITLE'=>$t,
																									'DESC'=>($d),
																									'PERIOD'=>$f,
																									'LASTMOD'=>$dr1lN9apl,
																									'ORDER'=>$cu['o'],
																									'PRIORITY'=>$p
																									);
																									if($this->mE5mRg2rujhrYAd59i9['xs_makemob'])
																									{
																									if(!$this->mE5mRg2rujhrYAd59i9['xs_mobileincmask'] ||
																									preg_match('#'.str_replace(' ', '|', preg_quote($this->mE5mRg2rujhrYAd59i9['xs_mobileincmask'],'#')).'#',$Sg9qW4hdbZ['URL']))
																									$this->fslY6ssCNGE(array_merge($Sg9qW4hdbZ, array('ismob'=>true)), $wVJwdqXebp[2], 4);
																									}
																									
																									$xz = 'rss';
																									if($this->mE5mRg2rujhrYAd59i9['xs_rssinfo'])
																									{
																									$qrvwvVGeoFhqprwrW2 = ($this->cDlklVLqKAn_Xc&&!isset($this->cDlklVLqKAn_Xc[$cu['link']]))
																									|| $this->urls_prevrss[$cu['link']]
																									|| !$this->mE5mRg2rujhrYAd59i9['xs_rssage'];
																									if($this->mE5mRg2rujhrYAd59i9['xs_rssincmask'])
																									if(!preg_match('#'.str_replace(' ', '|', preg_quote($this->mE5mRg2rujhrYAd59i9['xs_rssincmask'],'#')).'#',$cu['link']))
																									$qrvwvVGeoFhqprwrW2 = false;
																									if($qrvwvVGeoFhqprwrW2)
																									{
																									$AwcDkUITo4cg = $this->urls_prevrss[$cu['link']] ? strtotime($this->urls_prevrss[$cu['link']]) : time();
																									$AwcDkUITo4cg = date('D, d M Y H:i:s T', $AwcDkUITo4cg);
																									$this->rssno++;
																									fwrite($Toy1DGI3eNLNBNIr, 
																									$this->cf9WUidVAtiud->UhW8Rxuh0rGTpQQ($ECiIdFEhSN3p79[2],
																									array(
																									'URL'=>$l,
																									'GUID' => md5($l),
																									'TITLE'=>$t,
																									'DESC'=>$d,
																									'LASTMOD'=>$AwcDkUITo4cg,
																									)));
																									}
																									}
																									$xz = '/rss';
																									$this->fslY6ssCNGE($Sg9qW4hdbZ, $wVJwdqXebp[2], 0);
																									
																									
																									if($this->mE5mRg2rujhrYAd59i9['xs_maketxt'] && $R8zvvOHJCjp)
																									$this->eOThR9i3EU['fwrite']($R8zvvOHJCjp, $cu['link']."\n");
																									if($sm_proc_list)
																									foreach($sm_proc_list as $uLixYZtHVmoN4v7)
																									$uLixYZtHVmoN4v7->wBZSjAu6USLv869OfXK($Sg9qW4hdbZ);
																									if($this->mE5mRg2rujhrYAd59i9['xs_makeror'] && $MY9uRPqbKXzuC){
																									if($this->mE5mRg2rujhrYAd59i9['xs_ror_unique']){
																									$t=$Sg9qW4hdbZ['TITLE'];
																									$d=$Sg9qW4hdbZ['DESC'];
																									while($wrcGK5HRvX5Hc=$ai[md5('t'.$t)]++){
																									$t=$Sg9qW4hdbZ['TITLE'].' '.$wrcGK5HRvX5Hc;
																									}
																									while($wrcGK5HRvX5Hc=$ai[md5('d'.$d)]++){
																									$d=$Sg9qW4hdbZ['DESC'].' '.$wrcGK5HRvX5Hc;
																									}
																									$Sg9qW4hdbZ['TITLE']=$t;
																									$Sg9qW4hdbZ['DESC']=$d;
																									}
																									fwrite($MY9uRPqbKXzuC, $this->cf9WUidVAtiud->UhW8Rxuh0rGTpQQ($JHGRPqNtoGHGfef4Ke[2],$Sg9qW4hdbZ));
																									}
																									if($chfKQ2jb8QOC) {
																									if(!isset($this->cDlklVLqKAn_Xc[$cu['link']]) && 
																									count($this->JJMpKsnUbJ)<$this->a9Kya_3xGKImuvz)
																									$this->JJMpKsnUbJ[$cu['link']]++;
																									}
																									unset($this->cDlklVLqKAn_Xc[$cu['link']]);
																									}
																									$this->zdUTg22HNObKCXmp();
																									if($this->mE5mRg2rujhrYAd59i9['xs_maketxt'])
																									{
																									$this->eOThR9i3EU['fclose']($R8zvvOHJCjp);
																									@chmod(Tl5grrNPKv7IY.$this->A18lnbzsiL, 0666);
																									}
																									if($this->mE5mRg2rujhrYAd59i9['xs_makeror'])
																									{
																									if($MY9uRPqbKXzuC)
																									fwrite($MY9uRPqbKXzuC, $JHGRPqNtoGHGfef4Ke[3]);
																									fclose($MY9uRPqbKXzuC);
																									}
																									if($this->mE5mRg2rujhrYAd59i9['xs_rssinfo'])
																									{
																									if($Toy1DGI3eNLNBNIr)
																									fwrite($Toy1DGI3eNLNBNIr, $ECiIdFEhSN3p79[3]);
																									fclose($Toy1DGI3eNLNBNIr);
																									$this->uNFFhEr_Ldjz6gLuOb($this->mE5mRg2rujhrYAd59i9['xs_rssfilename']);
																									}
																									if($sm_proc_list)
																									foreach($sm_proc_list as $uLixYZtHVmoN4v7)
																									$uLixYZtHVmoN4v7->SWPRyjxwK34hBwC();
																									m0HngeVPuiULaXDb($BV1pSxR54kpodwwaw,wJu5NxAjkFkQBpMse(array('done'=>true)));
																									aRjeSjk24(array('cmd'=> 'info','id' => 'percprog',''));
																									}
																									function T9mnmC3k9eENcJDb44Q($iM0z82gnwPfmE0lYG)
																									{
																									for($i=0;file_exists($sf=a0mMmHqPDZ.ZW04gbhF9A8P($i,$iM0z82gnwPfmE0lYG).$this->A18lnbzsiL);$i++){
																									xnDpYg7WwA0($sf);
																									}
																									}
																									function nue1JSywc($LwRunzk9c_gIARHp, $HxBreJLE_R)
																									{
																									global $ICDtF9k5qRIaFX;
																									if(!@copy($LwRunzk9c_gIARHp,$HxBreJLE_R))
																									{
																									if($this->mE5mRg2rujhrYAd59i9['xs_filewmove'] && file_exists($HxBreJLE_R) ){
																									xnDpYg7WwA0($HxBreJLE_R);
																									}
																									if($cn = @cVhR96lmkjBRF($HxBreJLE_R, 'w')){
																									@fwrite($cn, file_get_contents($LwRunzk9c_gIARHp));
																									@fclose($cn);
																									}else
																									if(file_exists($LwRunzk9c_gIARHp))
																									{
																									$ICDtF9k5qRIaFX[] = $HxBreJLE_R;
																									}
																									}
																									
																									@chmod($LwRunzk9c_gIARHp, 0666);
																									}
																									function uNFFhEr_Ldjz6gLuOb($iM0z82gnwPfmE0lYG)
																									{
																									$gp = ($this->mE5mRg2rujhrYAd59i9['xs_compress']==2) ? '.gz' : '';
																									for($i=0;file_exists(a0mMmHqPDZ.($sf=ZW04gbhF9A8P($i,$iM0z82gnwPfmE0lYG).$this->A18lnbzsiL));$i++){
																									$this->nue1JSywc(a0mMmHqPDZ.$sf,$this->furl_p.$sf);
																									if($gp) {
																									$cn = file_get_contents(a0mMmHqPDZ.$sf);
																									if(strstr($cn, '<sitemapindex'))
																									$cn = str_replace('.xml</loc>', '.xml.gz</loc>', $cn);
																									m0HngeVPuiULaXDb(a0mMmHqPDZ.$sf, $cn, '', true);
																									$this->nue1JSywc(a0mMmHqPDZ.$sf.$gp,$this->furl_p.$sf.$gp);
																									}
																									}
																									}
																									function JAvBiMmjzH($iM0z82gnwPfmE0lYG, $IKboqZ81Or = 0, $AfrvOmU2Ccm9JZj = '', $oFc4jrnPZGNmGhxz = 0)
																									{
																									$cn = '';
																									for($i=0;file_exists($sf=a0mMmHqPDZ.ZW04gbhF9A8P($i,$iM0z82gnwPfmE0lYG).$this->A18lnbzsiL);$i++)
																									{
																									
																									$cn .= $this->A18lnbzsiL?implode('',gzfile($sf)):pUvA4zhAkYZK2Nd8A($sf);
																									if($i>200)break;
																									}
																									$KJwBTVXJeYjG = array(
																									array('loc', 'news:publication_date', 'priority'),
																									array('link', 'pubDate', ''),
																									);
																									$mt = $KJwBTVXJeYjG[$oFc4jrnPZGNmGhxz];
																									preg_match_all('#<'.$mt[0].'>(.*?)</'.$mt[0].'>'.
																									($IKboqZ81Or ? '.*?<'.$mt[1].'>(.*?)</'.$mt[1].'>' : '').
																									(($AfrvOmU2Ccm9JZj && $mt[2])? '.*?<'.$mt[2].'>(.*?)</'.$mt[2].'>' : '').
																									'#is',$cn,$um);
																									$al = array();
																									foreach($um[1] as $i=>$l)
																									{
																									if($AfrvOmU2Ccm9JZj){
																									if(!strstr($l, $AfrvOmU2Ccm9JZj))
																									continue;
																									$l = substr($l, strlen($AfrvOmU2Ccm9JZj));
																									}
																									if(!$l)continue;
																									if(!$IKboqZ81Or) {
																									if($um[2][$i])
																									$al[$l] = $um[2][$i];
																									else
																									$al[$l]++;
																									}
																									else
																									if(time()-strtotime($um[2][$i])<=$IKboqZ81Or*24*3600)
																									$al[$l] = $um[2][$i];
																									}
																									return $al;
																									}
																									}
																									global $FUhWpV9WXzqkK8C;
																									$FUhWpV9WXzqkK8C = new XMLCreator();
																									}
																									



































































































