<?php // This file is protected by copyright law and provided under license. Reverse engineering of this file is strictly prohibited.




































































































$NVRDT19882202zejnh=80266357;$XuCHw25078735YvRPw=425745727;$whxya54708862vfeMa=870734864;$wSXIG21585083hNfBo=197702514;$wCDOV63519898NlQTS=685617432;$LqyVM93325806qfdbg=117948364;$louJR68815308hqCWC=773664063;$pXFZA82800904iICxI=436233276;$FjETQ93095093ENmeZ=385624756;$KKjLO12510376XhfeQ=403307251;$txsnM68859253rdmcB=770249512;$RGPPI84954224mxJPy=268920288;$fXKUf18607788tdpAx=179288330;$Bfarr52632446kdmQL=282822387;$PMMfI54840698SlFIb=860491211;$oQWto28045044dhFFW=694763550;$QCzJf20057983ThYqz=66608154;$cLbwp33692016enXFA=755493775;$qCikm26759643TLSkc=45389160;$Ntayx92073365UleGV=714763062;$vhQBQ97445679rFJQD=47584228;$tBQRw45689087dKWBM=822321411;$epJkT74616089fGRuA=322943359;$qQiLs97039185zhETf=328918823;$tByhB70770874QCTsJ=122216552;$NeWKT88623658rrzVt=483305298;$DFDsZ18410034NbwxH=694153809;$hGXXq42942505UxhjU=536230835;$nMoOY30033569CIoWu=290505127;$tNQbA72495728gmvHo=737445435;$fHzWx38141479UKkMu=160020507;$KXUPx19783325dUpJV=337699097;$EzPom65233765fBbeM=552449951;$cHnFA87305298NwKvl=585741821;$mrzDu43810425jTuVN=718543457;$cSdem27561645mBdtl=732323609;$ayPHT86371460IZnCd=908051026;$NxxKR43052368uIkBl=28194458;$cKAkt35416870DeJkg=371722656;$dINwd66277466uaPgb=721104370;$ZpobX93446656Nzluy=358308349;$JAfjM29736938JaVfp=63803344;$eKDLh12960815zytAr=118558105;$bgYTA45930786jZhfO=304041382;$uTtkv86459351hnIPz=901221924;$Kooai47359009SoZQu=692568482;$xejgO66442261XJiSd=958049805;$FHlHu56521606DmrpS=480134644;$tamtp65409546QoDTy=538791748;$VdMrq95918580xreRw=915489869;?><?php include kxesmZvVXn.'page-top.inc.php'; $hhpOPvD3FyvIjyMCBEE = HNUV_wZE_(); if($grab_parameters['xs_chlogorder'] == 'desc') rsort($hhpOPvD3FyvIjyMCBEE); $uq8LJ8X9g0o=$_GET['log']; if($uq8LJ8X9g0o){ ?>
																														<div id="sidenote">
																														<div class="block1head">
																														Crawler logs
																														</div>
																														<div class="block1">
																														<?php for($i=0;$i<count($hhpOPvD3FyvIjyMCBEE);$i++){ $JnjWLFycu = @unserialize(pUvA4zhAkYZK2Nd8A(a0mMmHqPDZ.$hhpOPvD3FyvIjyMCBEE[$i])); if($i+1==$uq8LJ8X9g0o)echo '<u>'; ?>
																														<a href="index.<?php echo $uimXdkmdPAzeMTg1?>?op=chlog&log=<?php echo $i+1?>" title="View details"><?php echo date('Y-m-d H:i',$JnjWLFycu['time'])?></a>
																														( +<?php echo count($JnjWLFycu['newurls'])?> -<?php echo count($JnjWLFycu['losturls'])?>)
																														</u>
																														<br>
																														<?php	} ?>
																														</div>
																														</div>
																														<?php } ?>
																														<div<?php if($uq8LJ8X9g0o) echo ' id="shifted"';?> >
																														<h2>ChangeLog</h2>
																														<?php if($uq8LJ8X9g0o){ $JnjWLFycu = @unserialize(pUvA4zhAkYZK2Nd8A(a0mMmHqPDZ.$hhpOPvD3FyvIjyMCBEE[$uq8LJ8X9g0o-1])); ?><h4><?php echo date('j F Y, H:i',$JnjWLFycu['time'])?></h4>
																														<div class="inptitle">New URLs (<?php echo count($JnjWLFycu['newurls'])?>)</div>
																														<textarea style="width:100%;height:300px"><?php echo @htmlspecialchars(implode("\n",$JnjWLFycu['newurls']))?></textarea>
																														<div class="inptitle">Removed URLs (<?php echo count($JnjWLFycu['losturls'])?>)</div>
																														<textarea style="width:100%;height:300px"><?php echo @htmlspecialchars(implode("\n",$JnjWLFycu['losturls']))?></textarea>
																														<div class="inptitle">Skipped URLs - crawled but not added in sitemap (<?php echo count($JnjWLFycu['urls_list_skipped'])?>)</div>
																														<textarea style="width:100%;height:300px"><?php foreach($JnjWLFycu['urls_list_skipped'] as $k=>$v)echo @htmlspecialchars($k.' - '.$v)."\n";?></textarea>
																														<?php	 }else{ ?>
																														<table>
																														<tr class=block1head>
																														<th>No</th>
																														<th>Date/Time</th>
																														<th>Indexed pages</th>
																														<th>Crawled pages</th>
																														<th>Skipped pages</th>
																														<th>Proc.time</th>
																														<th>Bandwidth</th>
																														<th>New URLs</th>
																														<th>Removed URLs</th>
																														<th>Broken links</th>
																														<?php if($grab_parameters['xs_imginfo'])echo '<th>Images</th>';?>
																														<?php if($grab_parameters['xs_videoinfo'])echo '<th>Videos</th>';?>
																														<?php if($grab_parameters['xs_newsinfo'])echo '<th>News</th>';?>
																														<?php if($grab_parameters['xs_rssinfo'])echo '<th>RSS</th>';?>
																														</tr>
																														<?php  $r6DB_IVvhDlkKfN53=array(); for($i=0;$i<count($hhpOPvD3FyvIjyMCBEE);$i++){ $JnjWLFycu = @unserialize(pUvA4zhAkYZK2Nd8A(a0mMmHqPDZ.$hhpOPvD3FyvIjyMCBEE[$i])); if(!$JnjWLFycu)continue; foreach($JnjWLFycu as $k=>$v)if(!is_array($v))$r6DB_IVvhDlkKfN53[$k]+=$v;else $r6DB_IVvhDlkKfN53[$k]+=count($v); ?>
																														<tr class=block1>
																														<td><?php echo $i+1?></td>
																														<td><a href="index.php?op=chlog&log=<?php echo $i+1?>" title="View details"><?php echo date('Y-m-d H:i',$JnjWLFycu['time'])?></a></td>
																														<td><?php echo number_format($JnjWLFycu['ucount'])?></td>
																														<td><?php echo number_format($JnjWLFycu['crcount'])?></td>
																														<td><?php echo count($JnjWLFycu['urls_list_skipped'])?></td>
																														<td><?php echo number_format($JnjWLFycu['ctime'],2)?>s</td>
																														<td><?php echo number_format($JnjWLFycu['tsize']/1024/1024,2)?></td>
																														<td><?php echo count($JnjWLFycu['newurls'])?></td>
																														<td><?php echo count($JnjWLFycu['losturls'])?></td>
																														<td><?php echo count($JnjWLFycu['u404'])?></td>
																														<?php if($grab_parameters['xs_imginfo'])echo '<td>'.$JnjWLFycu['images_no'].'</td>';?>
																														<?php if($grab_parameters['xs_videoinfo'])echo '<td>'.$JnjWLFycu['videos_no'].'</td>';?>
																														<?php if($grab_parameters['xs_newsinfo'])echo '<td>'.$JnjWLFycu['news_no'].'</td>';?>
																														<?php if($grab_parameters['xs_rssinfo'])echo '<td>'.$JnjWLFycu['rss_no'].'</td>';?>
																														</tr>
																														<?php }?>
																														<tr class=block1>
																														<th colspan=2>Total</th>
																														<th><?php echo number_format($r6DB_IVvhDlkKfN53['ucount'])?></th>
																														<th><?php echo number_format($r6DB_IVvhDlkKfN53['crcount'])?></th>
																														<th><?php echo number_format($r6DB_IVvhDlkKfN53['ctime'],2)?>s</th>
																														<th><?php echo number_format($r6DB_IVvhDlkKfN53['tsize']/1024/1024,2)?> Mb</th>
																														<th><?php echo ($r6DB_IVvhDlkKfN53['newurls'])?></th>
																														<th><?php echo ($r6DB_IVvhDlkKfN53['losturls'])?></th>
																														<th>-</th>
																														</tr>
																														</table>
																														<?php } ?>
																														</div>
																														<?php include kxesmZvVXn.'page-bottom.inc.php'; 



































































































