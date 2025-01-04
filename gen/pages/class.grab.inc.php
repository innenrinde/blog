<?php // This file is protected by copyright law and provided under license. Reverse engineering of this file is strictly prohibited.




































































































$ZvMpt37106018UVcJa=53163360;$lLfjf25295715qKeyY=721073883;$gNPbs31590881dUrzu=981189484;$Szpkn25054016tRfJB=240353912;$lRsbm19747619aVqSY=402910919;$uKoRO74734192IINDu=875704255;$XnlbG24076233Nynsw=566077667;$fMnWu16836242XkgRz=878874909;$YVWLn67076721vcLiP=721439728;$Ubzay53860168yEmjN=499615875;$YpEvD81249085NrBQG=119747100;$asydZ28305969WASyi=986677155;$uQECe89093323SsnPY=9749786;$KXVUI52673645ccYxo=591808746;$cuHzv23109436fmWCz=641197785;$MxtRL59463196qbqzh=563760651;$Jdvtk85797425YJsvz=265841095;$crSag71174622RjdhL=153282867;$dfDgO29657287MzpQD=132429718;$jocgI20307922swHaK=609125397;$vsijM57189026LUfcN=490713654;$LBrRw19363098ReYAT=183038238;$dOLom10892639qJBay=591442902;$rOrnO90840149QRyeW=123771392;$kRKaa93268128iNzYv=684367462;$TEOjS77239075cDQoD=681074860;$chvwX56815491zRFxk=20237335;$mZtuF91059876WrebP=106698639;$ywuvd14034729VGWqK=846802521;$eZTzH64802551yRMpx=648392731;$TtqSX77425843tAHOp=416813019;$QFvjq20967102xETYp=557907135;$tLzmZ89488831reHUZ=978018830;$uCANG72053528IgrVf=84991851;$ZyvUm72723694iUFiq=782169953;$ubuSd60561829yMKbq=478396881;$oTnQq49630432EFynA=79016388;$GOneZ98992005qBHxR=988872223;$jzLzP42709045WAVAO=117308136;$sDoXK29844055Icvwp=867167878;$sLxmH74459534zqEEP=147795196;$wivYt55617981jYwTo=363033844;$LSDyn77381897gEoGo=420227569;$uCEvk18813781wGHdK=725220124;$Ywpbt73976135WLrSa=185355255;$ZaJYz31931457fkXny=205476715;$hWHFA86742249zKmVQ=691928253;$WKgcF27471008giOdT=52553619;$BTDxq48180237eAPsZ=191696563;$dhxyH27932434lFsyx=516200836;?><?php class SiteCrawler { var $foaeXizKT_CpOLBpUxK = array(); function F8eE_Rqcrb(&$a, $SXuHGf1Vd, $QYzbdvM1h, $FEajaUctQRUH5JF2gMO, $U_QkBfcAHSK3Jphne, $PGvQRa41twTzn3 = '') { global $grab_parameters; $nipU07LHK6q = parse_url($U_QkBfcAHSK3Jphne); if($nipU07LHK6q['scheme'] && substr($a, 0, 2) == '//') 
																											 $a = $nipU07LHK6q['scheme'].':'.$a; $rc3b9mqz2jbp = @parse_url($a); if($rc3b9mqz2jbp['scheme'] && ($rc3b9mqz2jbp['scheme']!='http')&& ($rc3b9mqz2jbp['scheme']!='https')) { $DOgZUqwUCl = 1; }else { $a = str_replace(':80/', '/', $a); if($a[0]=='?')$a = preg_replace('#^([^\?]*?)([^/\?]*?)(\?.*)?$#','$2',$SXuHGf1Vd).$a; if($grab_parameters['xs_inc_ajax'] && ($a[0] == '#')){ $FEajaUctQRUH5JF2gMO = preg_replace('#\#.*$#', '', $FEajaUctQRUH5JF2gMO); $a = $FEajaUctQRUH5JF2gMO . preg_replace('#^([^\#]*?/)?([^/\#]*)?(\#.*)?$#', '$2', $SXuHGf1Vd).$a; } if(preg_match('#^https?(:|&\#58;)#is',$a)){ if(preg_match('#://[^/]*$#is',$a)) 
																											 $a .= '/'; } else if($a&&$a[0]=='/')$a = $QYzbdvM1h.$a; else $a = $FEajaUctQRUH5JF2gMO.$a; $a=str_replace('/./','/',$a); if(substr($a,-2) == '..')$a.='/'; if(strstr($a,'../')){ preg_match('#(.*?:.*?//.*?)(/.*)$#',$a,$aa); 
																											 do{ $ap = $aa[2]; $aa[2] = preg_replace('#/?[^/]*/\.\.#','',$ap,1); }while($aa[2]!=$ap); $a = $aa[1].$aa[2]; } $a = preg_replace('#/\./#','/',$a); $a = str_replace('&#38;','&',$a); $a = str_replace('&#038;','&',$a); $a = str_replace('&amp;','&',$a); $a = preg_replace('#\#'.($grab_parameters['xs_inc_ajax']?'[^\!]':'').'.*$#','',$a); $a = preg_replace('#^([^\?]*[^/\:]/)/+#','\\1',$a); $a = preg_replace('#[\r\n]+#s','',$a); $DOgZUqwUCl = (strtolower(substr($a,0,strlen($U_QkBfcAHSK3Jphne)) ) != strtolower($U_QkBfcAHSK3Jphne)) ? 1 : 0; if($DOgZUqwUCl && $PGvQRa41twTzn3) { $Kl6oIfEwKD_U = $this->eufpjMrwNSVr($PGvQRa41twTzn3); if($Kl6oIfEwKD_U && preg_match('#('.$Kl6oIfEwKD_U.')#', $a)) $DOgZUqwUCl = 2; } } fTr9xtaaPTXU("<br/>($a - $DOgZUqwUCl - $SXuHGf1Vd - $FEajaUctQRUH5JF2gMO - $QYzbdvM1h)<br>\n",2); return $DOgZUqwUCl; } function eufpjMrwNSVr($SQEm27RfvIaD6r){ if(!isset($foaeXizKT_CpOLBpUxK[$SQEm27RfvIaD6r])){ $foaeXizKT_CpOLBpUxK[$SQEm27RfvIaD6r] = trim($SQEm27RfvIaD6r) ? preg_replace("#\s*[\r\n]+\s*#",'|', (strstr($s=trim($SQEm27RfvIaD6r),'*')?$s:preg_quote($s,'#'))) : ''; } return $foaeXizKT_CpOLBpUxK[$SQEm27RfvIaD6r]; } function AdSeH3KPw4($mE5mRg2rujhrYAd59i9,&$urls_completed) { global $grab_parameters,$UIcNE7i_HnCy; error_reporting(E_ALL&~E_NOTICE); @set_time_limit($grab_parameters['xs_exec_time']); if($mE5mRg2rujhrYAd59i9['bgexec']) { ignore_user_abort(true); } register_shutdown_function('HuD2wJN0EuqGM6r'); if(function_exists('ini_set')) { @ini_set("zlib.output_compression", 0); @ini_set("output_buffering", 0); } $qhPWndLyX4Mr = explode(" ",microtime()); $x3y6JFDVKhBEE3np = $qhPWndLyX4Mr[0]+$qhPWndLyX4Mr[1]; $starttime = $UDWzqkbDps6LuIKb = time(); $EAYwgabkhK76_CD = $nettime = 0; $Qv8G6NWw9S0ZcPxVV = $mE5mRg2rujhrYAd59i9['initurl']; $JQWUXY4SUxk8P = $mE5mRg2rujhrYAd59i9['maxpg']>0 ? $mE5mRg2rujhrYAd59i9['maxpg'] : 1E10; $rOeziFCAJb1cSY = $mE5mRg2rujhrYAd59i9['maxdepth'] ? $mE5mRg2rujhrYAd59i9['maxdepth'] : -1; $k2mbaYG7Adhhp0nn = $mE5mRg2rujhrYAd59i9['progress_callback']; $I7oacdy2vLiEw = $this->eufpjMrwNSVr($grab_parameters['xs_excl_urls']); $BGKIqn_HME = $this->eufpjMrwNSVr($grab_parameters['xs_incl_urls']); $EeBf1fWg43a = $iFfOUCk1sFztqp = array(); $PftdNZ9fEP0Z1yoaR = preg_split('#[\r\n]+#', $grab_parameters['xs_ind_attr']); $a1WM9_ZFATayi = '#200'.($grab_parameters['xs_allow_httpcode']?'|'.$grab_parameters['xs_allow_httpcode']:'').'#'; if($grab_parameters['xs_memsave']) { if(!file_exists(t_LlD5p6PQKvgvIZpP9)) mkdir(t_LlD5p6PQKvgvIZpP9, 0777); else if($mE5mRg2rujhrYAd59i9['resume']=='') G99nA35xjYQh(t_LlD5p6PQKvgvIZpP9, '.txt'); } foreach($PftdNZ9fEP0Z1yoaR as $ia) if($ia) { $is = explode(',', $ia); if($is[0][0]=='$') $dKQpfil5C5 = substr($is[0], 1); else $dKQpfil5C5 = str_replace(array('\\^', '\\$'), array('^','$'), preg_quote($is[0],'#')); $iFfOUCk1sFztqp[] = $dKQpfil5C5; $EeBf1fWg43a[str_replace(array('^','$'),array('',''),$is[0])] =  array('lm' => $is[1], 'f' => $is[2], 'p' => $is[3]); } if($iFfOUCk1sFztqp) $ZxN8MjZW3uwPfqCTY = implode('|',$iFfOUCk1sFztqp); $sqj4yHCj873BP = parse_url($Qv8G6NWw9S0ZcPxVV); if(!$sqj4yHCj873BP['path']){$Qv8G6NWw9S0ZcPxVV.='/';$sqj4yHCj873BP = parse_url($Qv8G6NWw9S0ZcPxVV);} $Q1yPjl8DEG9ZLcPEA = $UIcNE7i_HnCy->fetch($Qv8G6NWw9S0ZcPxVV,0,true);// the first request is to skip session id 
																											 $RxJr9gI4CwRmPszp = !preg_match($a1WM9_ZFATayi,$Q1yPjl8DEG9ZLcPEA['code']); if($RxJr9gI4CwRmPszp) { $RxJr9gI4CwRmPszp = ''; foreach($Q1yPjl8DEG9ZLcPEA['headers'] as $k=>$v) $RxJr9gI4CwRmPszp .= $k.': '.$v.'<br />'; return array( 'errmsg'=>'<b>There was an error while retrieving the URL specified:</b> '.$Qv8G6NWw9S0ZcPxVV.''. ($Q1yPjl8DEG9ZLcPEA['errormsg']?'<br><b>Error message:</b> '.$Q1yPjl8DEG9ZLcPEA['errormsg']:''). '<br><b>HTTP Code:</b><br>'.$Q1yPjl8DEG9ZLcPEA['protoline']. '<br><b>HTTP headers:</b><br>'.$RxJr9gI4CwRmPszp. '<br><b>HTTP output:</b><br>'.$Q1yPjl8DEG9ZLcPEA['content'] , ); } $Qv8G6NWw9S0ZcPxVV = $Q1yPjl8DEG9ZLcPEA['last_url']; $urls_completed = array(); $urls_ext = array(); $urls_404 = array(); $QYzbdvM1h = $sqj4yHCj873BP['scheme'].'://'.$sqj4yHCj873BP['host'].((!$sqj4yHCj873BP['port'] || ($sqj4yHCj873BP['port']=='80'))?'':(':'.$sqj4yHCj873BP['port'])); 
																											 $pn = $tsize = $retrno = $K4v1BKjLwk2MbkhbF = $UfCbPMkJL7hFdCsb = 0; $U_QkBfcAHSK3Jphne = RT9GXtyabs__A($QYzbdvM1h.'/', Hl4O6cWdjqldW6($sqj4yHCj873BP['path'])); $YWmYVMCd_Z1Jkw = parse_url($U_QkBfcAHSK3Jphne); $bEoirRlORmPAWbBHF = preg_replace('#^.+://[^/]+#', '', $U_QkBfcAHSK3Jphne); 
																											 $tgZb22uxY5bw2uw = $UIcNE7i_HnCy->fetch($Qv8G6NWw9S0ZcPxVV,0,true,true); $lrwvB0xvcXXumi3V = str_replace($U_QkBfcAHSK3Jphne,'',$Qv8G6NWw9S0ZcPxVV); $urls_list_full = array($lrwvB0xvcXXumi3V=>1); if(!$lrwvB0xvcXXumi3V)$lrwvB0xvcXXumi3V=''; $urls_list = array($lrwvB0xvcXXumi3V=>1); $urls_list2 = $urls_list_skipped = array(); $d_ZPoolAGnzklRH = array(); $links_level = 0; $Gj_L98sRGD = $ref_links = $ref_links2 = array(); $HqI1O8vynO4EtneR4A5 = 0; $cLhYAB9aL2j = $JQWUXY4SUxk8P; if(!$grab_parameters['xs_progupdate'])$grab_parameters['xs_progupdate'] = 20; if(isset($grab_parameters['xs_robotstxt']) && $grab_parameters['xs_robotstxt']) { $dFOsOrGrftDYFF = $UIcNE7i_HnCy->fetch($QYzbdvM1h.'/robots.txt'); if($QYzbdvM1h.'/' != $U_QkBfcAHSK3Jphne) { $bEP0apSEQLDaV9Xds = $UIcNE7i_HnCy->fetch($U_QkBfcAHSK3Jphne.'robots.txt'); $dFOsOrGrftDYFF['content']  .= "\n".$bEP0apSEQLDaV9Xds['content']; } $ra=preg_split('#user-agent:\s*#im',$dFOsOrGrftDYFF['content']); $bgOU73TJ7jwvdKa5Vq=array(); for($i=1;$i<count($ra);$i++){ preg_match('#^(\S+)(.*)$#s',$ra[$i],$TrV189ypHQ); if($TrV189ypHQ[1]=='*'||strstr($TrV189ypHQ[1],'google')){ preg_match_all('#^disallow:[^\r\n\S](\S*)#im',$TrV189ypHQ[2],$rm); for($pi=0;$pi<count($rm[1]);$pi++) if($rm[1][$pi]) $bgOU73TJ7jwvdKa5Vq[] =  str_replace('\\$','$', str_replace('\\*','.*', preg_quote($rm[1][$pi],'#') )); } } for($i=0;$i<count($bgOU73TJ7jwvdKa5Vq);$i+=200) $KasCb7mOKbPaieiEqd[]=implode('|', array_slice($bgOU73TJ7jwvdKa5Vq, $i,200)); }else $KasCb7mOKbPaieiEqd = array(); if($grab_parameters['xs_inc_ajax']) $grab_parameters['xs_proto_skip'] = str_replace( '\#', '\#[^\!]', $grab_parameters['xs_proto_skip']); $m51TO___YwFjZX = $grab_parameters['xs_exc_skip']!='\\.()'; $gnFe1_ACf3THo5fSVT = $grab_parameters['xs_inc_skip']!='\\.()'; $grab_parameters['xs_inc_skip'] .= '$'; $grab_parameters['xs_exc_skip'] .= '$'; if($grab_parameters['xs_debug']) { $_GET['ddbg']=1; PvFdgEcx0laOpBsp(); } $HtFBZd5BGx4HvWf = 0; $PSyERNx_fX3yH75 = array(); $url_ind = 0; $cnu = 1; $pf = cVhR96lmkjBRF(a0mMmHqPDZ.w7NW0sRCh2KBF74Bo,'w');fclose($pf); $oApTmRC5HPu = false; if($mE5mRg2rujhrYAd59i9['resume']!=''){ $J8NZ8Rx5Xj8oKk = @W4Xzu7_XRKxGlHA(pUvA4zhAkYZK2Nd8A(a0mMmHqPDZ.fSB9ZrUIK4aICK6XAM)); if($J8NZ8Rx5Xj8oKk) { $oApTmRC5HPu = true; echo 'Resuming the last session (last updated: '.date('Y-m-d H:i:s',$J8NZ8Rx5Xj8oKk['time']).')'."\n"; extract($J8NZ8Rx5Xj8oKk); $x3y6JFDVKhBEE3np-=$ctime; $HtFBZd5BGx4HvWf = $ctime; unset($J8NZ8Rx5Xj8oKk); } } $fjEvozDHHFDc3M3CP6e = 0; if(!$oApTmRC5HPu){ if($grab_parameters['xs_moreurls']){ $mu = preg_split('#[\r\n]+#', $grab_parameters['xs_moreurls']); foreach($mu as $bG6_Xft9xSIFOd){ $bG6_Xft9xSIFOd = str_replace($U_QkBfcAHSK3Jphne, '', $bG6_Xft9xSIFOd); if(!strstr($bG6_Xft9xSIFOd, '://')) 
																											 $urls_list[$bG6_Xft9xSIFOd]++; } } if($grab_parameters['xs_prev_sm_base']){ global $FUhWpV9WXzqkK8C; $iM0z82gnwPfmE0lYG = basename($grab_parameters['xs_smname']); $FUhWpV9WXzqkK8C->A18lnbzsiL = ($grab_parameters['xs_compress']==1) ? '.gz' : ''; $aCTBib5Y_WMSCDB4 = $FUhWpV9WXzqkK8C->JAvBiMmjzH($iM0z82gnwPfmE0lYG, 0, $U_QkBfcAHSK3Jphne); if(!$grab_parameters['xs_prev_sm_base_min'] ||  (count($aCTBib5Y_WMSCDB4)>$grab_parameters['xs_prev_sm_base_min'])) { $urls_list = array_merge($urls_list, $aCTBib5Y_WMSCDB4); } unset($aCTBib5Y_WMSCDB4); } $fjEvozDHHFDc3M3CP6e = count($urls_list); $urls_list_full = $urls_list; $cnu = count($urls_list); } $fMwzFU9kjTU = explode('|', $grab_parameters['xs_force_inc']); sleep(1); @xnDpYg7WwA0(a0mMmHqPDZ.w7NW0sRCh2KBF74Bo); if($urls_list) do { list($SXuHGf1Vd, $vQG590i8y) = each($urls_list); $bXB74SJYMX2s6phkekL = ($vQG590i8y>0 && $vQG590i8y<1) ? $vQG590i8y : 0; $url_ind++; fTr9xtaaPTXU("\n[ $url_ind - $SXuHGf1Vd, $vQG590i8y] \n"); unset($urls_list[$SXuHGf1Vd]); $f3rjBPjAjA5g2vr3_l = fGokyqo8tR33zzFafi3($SXuHGf1Vd); $pUrCgVuyLqY6_hjcC0 = false; $LlGyBWOGj6 = ''; $Q1yPjl8DEG9ZLcPEA = array(); $cn = ''; if(isset($d_ZPoolAGnzklRH[$SXuHGf1Vd])) $SXuHGf1Vd=$d_ZPoolAGnzklRH[$SXuHGf1Vd]; $f = $m51TO___YwFjZX && preg_match('#'.$grab_parameters['xs_exc_skip'].'#i',$SXuHGf1Vd); if($I7oacdy2vLiEw&&!$f)$f=$f||preg_match('#('.$I7oacdy2vLiEw.')#',$SXuHGf1Vd); if($KasCb7mOKbPaieiEqd&&!$f) foreach($KasCb7mOKbPaieiEqd as $bm) { $f = $f||preg_match('#^('.$bm.')#',$bEoirRlORmPAWbBHF.$SXuHGf1Vd); } $f2 = false; if(!$f) { $f2 = $gnFe1_ACf3THo5fSVT && preg_match('#'.$grab_parameters['xs_inc_skip'].'#i',$SXuHGf1Vd); if($BGKIqn_HME&&!$f2) $f2 = $f2||(preg_match('#('.$BGKIqn_HME.')#',$SXuHGf1Vd)); if($grab_parameters['xs_parse_only'] && !$f2 && $SXuHGf1Vd!='/') { $f2 = $f2 || !preg_match('#'.str_replace(' ', '|', preg_quote($grab_parameters['xs_parse_only'],'#')).'#',$SXuHGf1Vd); } } do{ $Zwf4bxMTE8xK8E = count($urls_list)+count($urls_list2)+count($urls_completed);         $f3 = $fMwzFU9kjTU[2] && ( ($cLhYAB9aL2j*$fMwzFU9kjTU[2]+1000)< ($hCqPL8RwlB-$url_ind-$fjEvozDHHFDc3M3CP6e)); if(!$f && !$f2) { $zAWJdA8vkogW = ($fMwzFU9kjTU[1] &&  ( (($ctime>$fMwzFU9kjTU[0]) && ($pn>$JQWUXY4SUxk8P*$fMwzFU9kjTU[1])) || $f3));	 $Fpei00GZKLxgY3rk = ($fMwzFU9kjTU[3] && $JQWUXY4SUxk8P && (($Zwf4bxMTE8xK8E>$JQWUXY4SUxk8P*$fMwzFU9kjTU[3]))); if($fMwzFU9kjTU[3] && $JQWUXY4SUxk8P && (($pn>$JQWUXY4SUxk8P*$fMwzFU9kjTU[3]))){ $urls_list=$urls_list2=array(); $cnu=0; } if($rOeziFCAJb1cSY<=0 || $links_level<$rOeziFCAJb1cSY) { $YFGECiz9ro = RT9GXtyabs__A($U_QkBfcAHSK3Jphne, $SXuHGf1Vd); fTr9xtaaPTXU("<h4> { $YFGECiz9ro } </h4>\n"); $o2FapLT5lEQ8T7IY=0; $VH_xpFhmDF6bO5F=array_sum(explode(' ', microtime())); $K4v1BKjLwk2MbkhbF++; do { $Q1yPjl8DEG9ZLcPEA = $UIcNE7i_HnCy->fetch($YFGECiz9ro, 0, 0); $_to = $Q1yPjl8DEG9ZLcPEA['flags']['socket_timeout']; if($_to && ($YWmYVMCd_Z1Jkw['host']!=$Q1yPjl8DEG9ZLcPEA['purl']['host'])){ $Q1yPjl8DEG9ZLcPEA['flags']['error'] = 'Host doesn\'t match'; } $tUOd0ODXTNxNVUNnX9o = (intval($Q1yPjl8DEG9ZLcPEA['code'] == 400)); $x0KsMnatxIC9 = (intval($Q1yPjl8DEG9ZLcPEA['code'] == 403)); if( !$Q1yPjl8DEG9ZLcPEA['flags']['error'] &&  (($tUOd0ODXTNxNVUNnX9o||$x0KsMnatxIC9)||!$Q1yPjl8DEG9ZLcPEA['code'] || $_to) ) { $o2FapLT5lEQ8T7IY++; $sl = $grab_parameters['xs_delay_ms']?$grab_parameters['xs_delay_ms']:1; if(($_to) && $grab_parameters['xs_timeout_break']){ fTr9xtaaPTXU("<p> # TIMEOUT - $_to #</p>\n"); if($o2FapLT5lEQ8T7IY==3){ if(strstr($_to,'read') ){ fTr9xtaaPTXU("<p> read200 break?</p>\n"); break ; } if($UfCbPMkJL7hFdCsb++>5) { $FAzOemScryy = "Too many timeouts detected"; break 2; } fTr9xtaaPTXU("<p> # MULTI TIMEOUT - BREAK #</p>\n"); $sl = 60;	    			 $o2FapLT5lEQ8T7IY = 0; } } fTr9xtaaPTXU("<p> # RETRY - ".$Q1yPjl8DEG9ZLcPEA['code']." - ".(intval($Q1yPjl8DEG9ZLcPEA['code']))." - ".$Q1yPjl8DEG9ZLcPEA['flags']['error']."#</p>\n"); sleep($_sl); } else  break; }while($o2FapLT5lEQ8T7IY<3); $nZ2n3dJmP_TiQ = array_sum(explode(' ', microtime()))-$VH_xpFhmDF6bO5F; $nettime+=$nZ2n3dJmP_TiQ; fTr9xtaaPTXU("<hr>\n[[[ ".$Q1yPjl8DEG9ZLcPEA['code']." ]]] - ".number_format($nZ2n3dJmP_TiQ,2)."s (".number_format($UIcNE7i_HnCy->oavbxuq1ZeJr,2).' + '.number_format($UIcNE7i_HnCy->UCLXWT4Aa,2).")\n".var_export($Q1yPjl8DEG9ZLcPEA['headers'],1)); $sQy6U3e_rh2YW = is_array($Q1yPjl8DEG9ZLcPEA['headers']) ? strtolower($Q1yPjl8DEG9ZLcPEA['headers']['content-type']) : ''; $XWHbijqSXRb = strstr($sQy6U3e_rh2YW,'text/html') || strstr($sQy6U3e_rh2YW,'/xhtml') || !$sQy6U3e_rh2YW; if($sQy6U3e_rh2YW && !$XWHbijqSXRb && (!$grab_parameters['xs_parse_swf'] || !strstr($sQy6U3e_rh2YW, 'shockwave-flash')) ){ if(!$zAWJdA8vkogW){ $LlGyBWOGj6 = $sQy6U3e_rh2YW; continue; } } $UL_rhtNF7ST = array(); if($Q1yPjl8DEG9ZLcPEA['code']==404){ if($links_level>0) if(!$grab_parameters['xs_chlog_list_max'] || count($urls_404) < $grab_parameters['xs_chlog_list_max']) { $urls_404[]=array($SXuHGf1Vd,$ref_links2[$SXuHGf1Vd]); } } if($grab_parameters['xs_canonical']) if(($YFGECiz9ro == $Q1yPjl8DEG9ZLcPEA['last_url']) && preg_match('#<link[^>]*rel="canonical"[^>]href="([^>]*?)"#', $cn, $GO8TFrE_eI)) $Q1yPjl8DEG9ZLcPEA['last_url'] = $GO8TFrE_eI[1]; $RXZaXpOvdbjwY = preg_replace('#^.*?'.preg_quote($U_QkBfcAHSK3Jphne,'#').'#','',$Q1yPjl8DEG9ZLcPEA['last_url']); if(($YFGECiz9ro != $Q1yPjl8DEG9ZLcPEA['last_url']) && ($YFGECiz9ro != $Q1yPjl8DEG9ZLcPEA['last_url'].'/')) { $d_ZPoolAGnzklRH[$SXuHGf1Vd]=$Q1yPjl8DEG9ZLcPEA['last_url']; $io=$SXuHGf1Vd; if(!$urls_list_full[$RXZaXpOvdbjwY]) { $urls_list2[$RXZaXpOvdbjwY]++; if(count($ref_links[$RXZaXpOvdbjwY])<max(1,intval($grab_parameters['xs_maxref']))) $ref_links[$RXZaXpOvdbjwY][] = $SXuHGf1Vd; } $LlGyBWOGj6 = 'lu'; if(!$zAWJdA8vkogW)continue; } if($a1WM9_ZFATayi && !preg_match($a1WM9_ZFATayi,$Q1yPjl8DEG9ZLcPEA['code'])){ $LlGyBWOGj6 = $Q1yPjl8DEG9ZLcPEA['code']; continue; } $cn = $Q1yPjl8DEG9ZLcPEA['content']; $tsize+=strlen($cn); $retrno++; if($YU8s83esIfxy544ZH = preg_replace('#<!--(\[if IE\]>|.*?-->)#is', '',$cn)) $cn = $YU8s83esIfxy544ZH; preg_match('#<base[^>]*?href=[\'"](.*?)[\'"]#is',$cn,$bm); if(isset($bm[1])&&$bm[1]) $FEajaUctQRUH5JF2gMO = Hl4O6cWdjqldW6($bm[1].(preg_match('#//.*/#',$bm[1])?'-':'/-')); 
																											 else $FEajaUctQRUH5JF2gMO = Hl4O6cWdjqldW6($U_QkBfcAHSK3Jphne.$SXuHGf1Vd); if($zAWJdA8vkogW||$Fpei00GZKLxgY3rk) { $XWHbijqSXRb = false; } if(strstr($sQy6U3e_rh2YW, 'shockwave-flash') && $grab_parameters['xs_parse_swf']) { include_once kxesmZvVXn.'class.pfile.inc.php'; $am = new SWFParser(); $am->h8i3gNivayoQQtqpLY($cn); $AxQrHpWAhbF = $am->D1tXUjHdde7g1(); }else if($XWHbijqSXRb) { $QccFvjPC8i_jyI = $grab_parameters['xs_utf8_enc'] ? 'isu':'is'; preg_match_all('#<(?:a|area|go)\s(?:[^>]*?\s)?href\s*=\s*(?:"([^"]*)|\'([^\']*)|([^\s\"\\\\>]+)).*?>#is'.$QccFvjPC8i_jyI, $cn, $am);
																											
																											
																											preg_match_all('#<i?frame\s[^>]*?src\s*=\s*["\']?(.*?)("|>|\')#is', $cn, $O35084VCZZWtq831QK);
																											
																											preg_match_all('#<meta\s[^>]*http-equiv\s*=\s*"?refresh[^>]*URL\s*=\s*["\']?(.*?)("|>|\'[>\s])#'.$QccFvjPC8i_jyI, $cn, $eA1uPQAzcVCQ8);
																											
																											if($grab_parameters['xs_parse_swf'])
																											
																											preg_match_all('#<object[^>]*application/x-shockwave-flash[^>]*data\s*=\s*["\']([^"\'>]+).*?>#'.$QccFvjPC8i_jyI, $cn, $AxQrHpWAhbF);
																											
																											else $AxQrHpWAhbF = array(array(),array());
																											
																											
																											$UL_rhtNF7ST = array();
																											
																											for($i=0;$i<count($am[1]);$i++)
																											
																											{
																											
																											if( !preg_match('#rel=["\']nofollow#i', $am[0][$i]) ) 
																											
																											$UL_rhtNF7ST[] = $am[1][$i];
																											
																											}
																											
																											$UL_rhtNF7ST = @array_merge(
																											
																											$UL_rhtNF7ST,
																											
																											
																											$am[2],$am[3],  
																											
																											$O35084VCZZWtq831QK[1],$eA1uPQAzcVCQ8[1],
																											
																											$AxQrHpWAhbF[1]);
																											
																											}
																											
																											$UL_rhtNF7ST = array_unique($UL_rhtNF7ST);
																											
																											
																											
																											$nn = $nt = 0;
																											
																											reset($UL_rhtNF7ST);
																											
																											if(preg_match('#<meta name="robots" content="[^"]*?nofollow#is',$cn))
																											
																											$UL_rhtNF7ST = array();
																											
																											if(!$PSyERNx_fX3yH75['charset']){
																											
																											if(preg_match('#<meta\s+http-equiv="content-type"[^>]*?charset=([^">]*)"#is',$cn, $UHng1R6Q0JJCH1rjl))
																											
																											$PSyERNx_fX3yH75['charset'] = $UHng1R6Q0JJCH1rjl[1];
																											
																											}
																											
																											foreach($UL_rhtNF7ST as $i=>$ll)
																											
																											if($ll)
																											
																											{                    
																											
																											$a = $sa = trim($ll);
																											
																											
																											if($grab_parameters['xs_proto_skip'] && 
																											
																											(preg_match('#^'.$grab_parameters['xs_proto_skip'].'#i',$a)||
																											
																											($m51TO___YwFjZX && preg_match('#'.$grab_parameters['xs_exc_skip'].'#i',$a))||
																											
																											preg_match('#^'.$grab_parameters['xs_proto_skip'].'#i',function_exists('html_entity_decode')?html_entity_decode($a):$a)
																											
																											))
																											
																											continue;
																											
																											
																											if(strlen($a) > 2048) continue;
																											
																											$DOgZUqwUCl = $this->F8eE_Rqcrb($a, $SXuHGf1Vd, $QYzbdvM1h, $FEajaUctQRUH5JF2gMO, $U_QkBfcAHSK3Jphne);
																											
																											if($DOgZUqwUCl == 1)
																											
																											{
																											
																											if($grab_parameters['xs_extlinks'] &&
																											
																											(!$grab_parameters['xs_extlinks_excl'] || !preg_match('#'.$this->eufpjMrwNSVr($grab_parameters['xs_extlinks_excl']).'#',$a)) &&
																											
																											(!$grab_parameters['xs_ext_max'] || (count($urls_ext)<$grab_parameters['xs_ext_max']))
																											
																											)
																											
																											{
																											
																											if(!$urls_ext[$a] && 
																											
																											(!$grab_parameters['xs_ext_skip'] || 
																											
																											!preg_match('#'.$grab_parameters['xs_ext_skip'].'#',$a)
																											
																											)
																											
																											)
																											
																											$urls_ext[$a] = $YFGECiz9ro;
																											
																											}
																											
																											continue;
																											
																											}
																											
																											$RXZaXpOvdbjwY = $DOgZUqwUCl ? $a : substr($a,strlen($U_QkBfcAHSK3Jphne));
																											
																											$RXZaXpOvdbjwY = str_replace(' ', '%20', $RXZaXpOvdbjwY);
																											
																											if($grab_parameters['xs_cleanurls'])
																											
																											$RXZaXpOvdbjwY = @preg_replace($grab_parameters['xs_cleanurls'],'',$RXZaXpOvdbjwY);
																											
																											if($grab_parameters['xs_cleanpar'])
																											
																											{
																											
																											do {
																											
																											$VTQP1ue8oY1PvdK = $RXZaXpOvdbjwY;
																											
																											$RXZaXpOvdbjwY = @preg_replace('#[\\?\\&]('.$grab_parameters['xs_cleanpar'].')=[a-z0-9\-\.\_\=\/]+$#i','',$RXZaXpOvdbjwY);
																											
																											$RXZaXpOvdbjwY = @preg_replace('#([\\?\\&])('.$grab_parameters['xs_cleanpar'].')=[a-z0-9\-\.\_\=\/]+&#i','$1',$RXZaXpOvdbjwY);
																											
																											}while($RXZaXpOvdbjwY != $VTQP1ue8oY1PvdK);
																											
																											}
																											
																											if($urls_list_full[$RXZaXpOvdbjwY] || ($RXZaXpOvdbjwY == $SXuHGf1Vd))
																											
																											continue;
																											
																											if($grab_parameters['xs_exclude_check'])
																											
																											{
																											
																											$_f=$_f2=false;
																											
																											$_f=$I7oacdy2vLiEw&&preg_match('#('.$I7oacdy2vLiEw.')#',$RXZaXpOvdbjwY);
																											
																											if($KasCb7mOKbPaieiEqd&&!$_f)
																											
																											foreach($KasCb7mOKbPaieiEqd as $bm)
																											
																											$_f = $_f||preg_match('#^('.$bm.')#',$bEoirRlORmPAWbBHF.$RXZaXpOvdbjwY);
																											
																											
																											
																											if($_f)continue;
																											
																											}
																											
																											fTr9xtaaPTXU("<u>[$RXZaXpOvdbjwY]</u><br>\n",3);//exit;
																											
																											$urls_list2[$RXZaXpOvdbjwY]++;
																											
																											if($grab_parameters['xs_maxref'] && count($ref_links[$RXZaXpOvdbjwY])<$grab_parameters['xs_maxref'])
																											
																											$ref_links[$RXZaXpOvdbjwY][] = $SXuHGf1Vd;
																											
																											$nt++;
																											
																											}
																											
																											unset($UL_rhtNF7ST);
																											
																											}
																											
																											}
																											
																											
																											
																											if($grab_parameters['xs_incl_only'] && !$f)
																											
																											$f = $f || !preg_match('#'.str_replace(' ', '|', preg_quote($grab_parameters['xs_incl_only'],'#')).'#',$U_QkBfcAHSK3Jphne.$SXuHGf1Vd);
																											
																											if(!$f) {
																											
																											$f = $f||preg_match('#<meta name="robots" content="[^"]*?noindex#is',$cn);
																											
																											if($f)$LlGyBWOGj6 = 'mrob';
																											
																											}
																											
																											if(!$f)
																											
																											{
																											
																											$wrcGK5HRvX5Hc = array(
																											
																											
																											'link'=>preg_replace('#//+$#','/', preg_replace('#^([^/\:\?]/)/+#','\\1',$U_QkBfcAHSK3Jphne.$SXuHGf1Vd))
																											
																											);
																											
																											if($grab_parameters['xs_makehtml']||$grab_parameters['xs_makeror']||$grab_parameters['xs_rssinfo'])
																											
																											{
																											
																											preg_match('#<title>([^<]*?)</title>#is', $Q1yPjl8DEG9ZLcPEA['content'], $jnlmADM5fBz3W9);
																											
																											$wrcGK5HRvX5Hc['t'] = strip_tags($jnlmADM5fBz3W9[1]);
																											
																											}
																											
																											if($grab_parameters['xs_metadesc'])
																											
																											{
																											
																											preg_match('#<meta\s[^>]*(?:http-equiv|name)\s*=\s*"?description[^>]*content\s*=\s*["]?([^>\"]*)#is', $cn, $zYhxmsR75YsTO5F);
																											
																											if($zYhxmsR75YsTO5F[1])
																											
																											$wrcGK5HRvX5Hc['d'] = $zYhxmsR75YsTO5F[1];
																											
																											}
																											
																											if($grab_parameters['xs_makeror']||$grab_parameters['xs_autopriority'])
																											
																											$wrcGK5HRvX5Hc['o'] = max(0,$links_level);
																											
																											if($bXB74SJYMX2s6phkekL)
																											
																											$wrcGK5HRvX5Hc['p'] = $bXB74SJYMX2s6phkekL;
																											
																											if(preg_match('#('.$ZxN8MjZW3uwPfqCTY.')#',$U_QkBfcAHSK3Jphne.$SXuHGf1Vd,$bgPaFIl40lb3Ty4))
																											
																											{
																											
																											$wrcGK5HRvX5Hc['clm'] = $EeBf1fWg43a[$bgPaFIl40lb3Ty4[1]]['lm'];
																											
																											$wrcGK5HRvX5Hc['f'] = $EeBf1fWg43a[$bgPaFIl40lb3Ty4[1]]['f'];
																											
																											$wrcGK5HRvX5Hc['p'] = $EeBf1fWg43a[$bgPaFIl40lb3Ty4[1]]['p'];
																											
																											}
																											
																											
																											
																											
																											
																											if($grab_parameters['xs_lastmod_notparsed'] && $f2)
																											
																											{
																											
																											$Q1yPjl8DEG9ZLcPEA = $UIcNE7i_HnCy->fetch($YFGECiz9ro, 0, 1, false, "", array('req'=>'HEAD'));
																											
																											
																											}
																											
																											if(!$wrcGK5HRvX5Hc['lm'] && isset($Q1yPjl8DEG9ZLcPEA['headers']['last-modified']))
																											
																											$wrcGK5HRvX5Hc['lm']=$Q1yPjl8DEG9ZLcPEA['headers']['last-modified'];
																											
																											fTr9xtaaPTXU("\n((include ".$wrcGK5HRvX5Hc['link']."))<br />\n");
																											
																											$pUrCgVuyLqY6_hjcC0 = true;
																											
																											if($grab_parameters['xs_memsave'])
																											
																											{
																											
																											FRy4YMXr_PT($f3rjBPjAjA5g2vr3_l, $wrcGK5HRvX5Hc);
																											
																											$urls_completed[] = $f3rjBPjAjA5g2vr3_l;
																											
																											}else
																											
																											$urls_completed[] = serialize($wrcGK5HRvX5Hc);
																											
																											$cLhYAB9aL2j = $JQWUXY4SUxk8P - count($urls_completed);
																											
																											}
																											
																											}while(false);// zerowhile
																											
																											if($url_ind>=$cnu)
																											
																											{
																											
																											unset($urls_list);
																											
																											$url_ind = 0;
																											
																											$urls_list = $urls_list2;
																											
																											$urls_list_full = array_merge($urls_list_full,$urls_list);
																											
																											$cnu = count($urls_list);
																											
																											unset($ref_links2);
																											
																											$ref_links2 = $ref_links;
																											
																											unset($ref_links); unset($urls_list2);
																											
																											$ref_links = array();
																											
																											$urls_list2 = array();
																											
																											$links_level++;
																											
																											fTr9xtaaPTXU("\n<br>NEXT LEVEL:$links_level<br />\n");
																											
																											}
																											
																											if(!$pUrCgVuyLqY6_hjcC0){
																											
																											
																											fTr9xtaaPTXU("\n({skipped ".$SXuHGf1Vd."})<br />\n");
																											
																											if(!$grab_parameters['xs_chlog_list_max'] ||
																											
																											count($urls_list_skipped) < $grab_parameters['xs_chlog_list_max']) {
																											
																											$urls_list_skipped[$SXuHGf1Vd]=$LlGyBWOGj6;
																											
																											}
																											
																											}
																											
																											$pn++;
																											
																											$qhPWndLyX4Mr=explode(" ",microtime());
																											
																											$ctime = $qhPWndLyX4Mr[0]+$qhPWndLyX4Mr[1] - $x3y6JFDVKhBEE3np;
																											
																											W5mf7Y9Huk0KaQU6();
																											
																											$pl=min($cnu-$url_ind,$cLhYAB9aL2j);
																											
																											if( ($cnu==$url_ind || $pl==0||$pn==1 || ($pn%$grab_parameters['xs_progupdate'])==0)
																											
																											|| ($ctime - $S6zsGHiQqbyS93wtuJ > 5)
																											
																											|| count($urls_completed)>=$JQWUXY4SUxk8P)
																											
																											{
																											
																											
																											$S6zsGHiQqbyS93wtuJ = $jmTPqK4UHmexxwYuYDf;
																											
																											if(strstr($tgZb22uxY5bw2uw['content'],'header'))break;
																											
																											global $m8;
																											
																											$mu = function_exists('memory_get_usage') ? memory_get_usage() : '-';
																											
																											$EAYwgabkhK76_CD = max($EAYwgabkhK76_CD, $mu);
																											
																											if($mu>$m8+1000000){
																											
																											$m8 = $mu;
																											
																											$cc = ' style="color:red"';
																											
																											}else $cc='';
																											
																											if(intval($mu))
																											
																											$mu = number_format($mu/1024,1).' Kb';
																											
																											fTr9xtaaPTXU("\n(<span".$cc.">memory".($cc?' up':'').": $mu</span>)<br>\n");
																											
																											$EUAfaBT8QI = (count($urls_completed)>=$JQWUXY4SUxk8P) || ($url_ind>=$cnu);
																											
																											$progpar = array(
																											
																											$ctime, // 0. running time
																											
																											str_replace($Qv8G6NWw9S0ZcPxVV, '', $SXuHGf1Vd),  // 1. current URL
																											
																											$pl,                    // 2. urls left
																											
																											$pn,                    // 3. processed urls
																											
																											$tsize,                 // 4. bandwidth usage
																											
																											$links_level,           // 5. depth level
																											
																											$mu,                    // 6. memory usage
																											
																											count($urls_completed), // 7. added in sitemap
																											
																											count($urls_list2),     // 8. in the queue
																											
																											$nettime,	// 9. network time
																											
																											$nZ2n3dJmP_TiQ, // 10. last net time
																											
																											);
																											
																											if($mE5mRg2rujhrYAd59i9['bgexec'])
																											
																											m0HngeVPuiULaXDb(UGhOmnuNjG2fj,wJu5NxAjkFkQBpMse($progpar));
																											
																											if($k2mbaYG7Adhhp0nn && !$f)
																											
																											$k2mbaYG7Adhhp0nn($progpar);
																											
																											
																											}else
																											
																											{
																											
																											$k2mbaYG7Adhhp0nn(array('cmd'=>'ping', 'bg' => $mE5mRg2rujhrYAd59i9['bgexec']));
																											
																											}
																											
																											if($grab_parameters['xs_savestate_time']>0 &&
																											
																											( 
																											
																											($ctime-$HtFBZd5BGx4HvWf>$grab_parameters['xs_savestate_time'])
																											
																											|| $EUAfaBT8QI
																											
																											)
																											
																											)
																											
																											{
																											
																											$HtFBZd5BGx4HvWf = $ctime;
																											
																											fTr9xtaaPTXU("(saving dump)<br />\n");
																											
																											$J8NZ8Rx5Xj8oKk = compact('url_ind',
																											
																											'urls_list','urls_list2','cnu',
																											
																											'ref_links','ref_links2',
																											
																											'urls_list_full','urls_completed',
																											
																											'urls_404',
																											
																											'nt','tsize','pn','links_level','ctime', 'urls_ext',
																											
																											'starttime', 'retrno', 'nettime', 'urls_list_skipped',
																											
																											'imlist', 'progpar', 'runstate'
																											
																											);
																											
																											$J8NZ8Rx5Xj8oKk['time']=time();
																											
																											$AliiN4BFVJwSzo8tel=wJu5NxAjkFkQBpMse($J8NZ8Rx5Xj8oKk);
																											
																											m0HngeVPuiULaXDb(fSB9ZrUIK4aICK6XAM,$AliiN4BFVJwSzo8tel);
																											
																											unset($J8NZ8Rx5Xj8oKk);
																											
																											unset($AliiN4BFVJwSzo8tel);
																											
																											}
																											
																											if($grab_parameters['xs_delay_req'] && $grab_parameters['xs_delay_ms'] &&
																											
																											(($K4v1BKjLwk2MbkhbF%$grab_parameters['xs_delay_req'])==0))
																											
																											{
																											
																											sleep($grab_parameters['xs_delay_ms']);
																											
																											}
																											
																											if(!$FAzOemScryy) {
																											
																											if($FAzOemScryy = file_exists($CmZLfMuLMSEZIiTevcX=a0mMmHqPDZ.w7NW0sRCh2KBF74Bo)){
																											
																											if(!@xnDpYg7WwA0($CmZLfMuLMSEZIiTevcX))
																											
																											$FAzOemScryy=0;
																											
																											}
																											
																											}
																											
																											if($grab_parameters['xs_exec_time'] && 
																											
																											((time()-$UDWzqkbDps6LuIKb) > $grab_parameters['xs_exec_time']) ){
																											
																											$FAzOemScryy = 'Time limit exceeded - '.($grab_parameters['xs_exec_time']).' - '.(time()-$UDWzqkbDps6LuIKb);
																											
																											}
																											
																											}while(!$EUAfaBT8QI && !$FAzOemScryy);
																											
																											fTr9xtaaPTXU("\n\n<br><br>Crawling completed<br>\n");
																											
																											if($_GET['ddbgexit'])exit;
																											
																											return array(
																											
																											'u404'=>$urls_404,
																											
																											'starttime'=>$starttime,
																											
																											'topmu' => $EAYwgabkhK76_CD,
																											
																											'ctime'=>$ctime,
																											
																											'tsize'=>$tsize,
																											
																											'retrno' => $retrno,
																											
																											'nettime' => $nettime,
																											
																											'errmsg'=>'',
																											
																											'initurl'=>$Qv8G6NWw9S0ZcPxVV,
																											
																											'initdir'=>$U_QkBfcAHSK3Jphne,
																											
																											'ucount'=>count($urls_completed),
																											
																											'crcount'=>$pn,
																											
																											'time'=>time(),
																											
																											'params'=>$mE5mRg2rujhrYAd59i9,
																											
																											'interrupt'=>$FAzOemScryy,
																											
																											'runstate' => $PSyERNx_fX3yH75,
																											
																											'urls_ext'=>$urls_ext,
																											
																											'urls_list_skipped' => $urls_list_skipped,
																											
																											'max_reached' => count($urls_completed)>=$JQWUXY4SUxk8P
																											
																											);
																											
																											}
																											
																											}
																											
																											$QPVRLXEdJuJxawHsbA = new SiteCrawler();
																											
																											function HuD2wJN0EuqGM6r(){
																											
																											@xnDpYg7WwA0(a0mMmHqPDZ.yyq7fDoK_cBPACC6n1);
																											
																											if(@file_exists(a0mMmHqPDZ.UGhOmnuNjG2fj))
																											
																											@rename(a0mMmHqPDZ.UGhOmnuNjG2fj,a0mMmHqPDZ.yyq7fDoK_cBPACC6n1);
																											
																											}
																											
																											



































































































