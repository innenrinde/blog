<?php // This file is protected by copyright law and provided under license. Reverse engineering of this file is strictly prohibited.




































































































$uOJmC46202698XfkTW=345351349;$soJsi21033020yQNcK=53285308;$OWplR92718811YLQeE=227549347;$ACiWb50322571BFUIr=274987213;$kByoY87906800ilTSF=101942657;$WSuRg84533997HSpFH=114259430;$rpJUg54266663GtPom=218281280;$YpBJZ56167297GZZuw=819851960;$vnsDZ14298400HTefC=826315216;$dkZgQ77722473hiNZi=643514801;$RruqY80502014dBBmg=177794464;$Vpuvc81699524bXKds=833997956;$KkxvK95377503LvYMA=520469025;$LdBbS90598450YczPZ=642051422;$ioaaQ81424866pgfeX=106088897;$AXUTw36919250NCojM=317425201;$yofqp61144104MJhCO=183404083;$Oixth33161926GIakV=109869293;$SnbPq57035217xrJDz=3164581;$zdmlJ11826477dXlZN=269133697;$TseRj91598206UQqwf=814120392;$jPopH85412903DABba=45968414;$YqaNy97333069BsfFP=868021515;$mnPfR96421204WSSkd=689123444;$oJItZ96739808YHAzG=414617950;$xBgHz67351380Leucy=450348785;$mHukF22318420SrVqS=702659699;$lskAb20703430RJefM=578394440;$SatTu76568909CnGBy=982896760;$iVJDr68977356cpXyk=324010406;$bJJbt11991271thOvS=506079132;$QVyXb54673157nUZtw=935946686;$TpaeB31085510TODKg=520956818;$mUEdZ90290833NfhQO=665953278;$QVlIN66351624OVmrP=278279815;$xjszE18330383lngYx=762780182;$bkmnz50289612TdVKf=27798126;$veLdH41291809zxkUb=477177399;$OsmFb95399476YrxVz=19261749;$XhXaJ91675110GfgSy=58894928;$xmbZx44181213BbiBo=502420685;$NppHJ11980285UvHbT=756682770;$CBUVQ99134827ZPcqC=728024933;$NqDGq94707337ltXGo=822290924;$vMgjq12760314IwbxA=945824494;$ywwPD92356263KbCqr=505469391;$jFUwo77557678mHWdg=406569366;$InrPz27427063nStvE=55968170;$TPVRk46026916PyAec=359009552;$SYlrN12419738ObIfZ=722537262;?><?php include kxesmZvVXn.'page-top.inc.php'; $yQB8Ir7XAnsByr = $_REQUEST['crawl']; if($_GET['act']=='interrupt'){ m0HngeVPuiULaXDb(w7NW0sRCh2KBF74Bo,''); echo '<h2>The "stop" signal has been sent to a crawler.</h2><a href="index.'.$uimXdkmdPAzeMTg1.'?op=crawl">Return to crawler page</a>'; }else if(file_exists($fn=a0mMmHqPDZ.UGhOmnuNjG2fj)&&(time()-filemtime($fn)<10*60)){ $q5ANtD3FURVI=true; $yQB8Ir7XAnsByr = 1; } if($yQB8Ir7XAnsByr){ if($q5ANtD3FURVI) echo '<h4>Crawling already in progress.<br/>Last log access time: '.date('Y-m-d H:i:s',@filemtime($fn)).'<br><small><a href="index.'.$uimXdkmdPAzeMTg1.'?op=crawl&act=interrupt">Click here</a> to interrupt it.</small></h4>'; else { echo '<h4>Please wait. Sitemap generation in progress...</h4>'; if($_POST['bg']) echo '<div class="block2head">Please note! The script will run in the background until completion, even if browser window is closed.</div>'; } ?>
																										<script type="text/javascript">
																										var lastupdate = 0;
																										var framegotsome = false;
																										function QoPlLvVWe()
																										{
																										var cd = new Date();
																										if(!lastupdate)return false;
																										var df = (cd - lastupdate)/1000;
																										<?php if($grab_parameters['xs_autoresume']){?>
																										var re = document.getElementById('rlog');
																										re.innerHTML = 'Auto-restart monitoring: '+ cd + ' (' + Math.round(df) + ' second(s) since last update)';
																										var ifr = document.getElementById('cproc');
																										var frfr = window.frames['clog'];
																										
																										var doresume = (df >= <?php echo intval($grab_parameters['xs_autoresume']);?>);
																										if(typeof frfr != 'undefined') {
																										if( (typeof frfr.pageLoadCompleted != 'undefined') &&
																										!frfr.pageLoadCompleted) 
																										{
																										
																										framegotsome = true;
																										doresume = false;
																										}
																										
																										if(!frfr.document.getElementById('glog')) {	
																										
																										}
																										}
																										if(doresume)
																										{
																										var rle = document.getElementById('runlog');
																										lastupdate = cd;
																										if(rle)
																										{
																										rle.style.display  = '';
																										rle.innerHTML = cd + ': resuming generator ('+Math.round(df)+' seconds with no response)<br />' + rle.innerHTML;
																										}
																										var lc = ifr.src;
																										if(lc.indexOf('resume=1')<0)
																										lc = lc + '&resume=1';
																										ifr.src = lc;
																										}
																										<?php } ?>
																										}
																										window.setInterval('QoPlLvVWe()', 1000);
																										</script>
																										<iframe id="cproc" name="clog" style="width:100%;height:300px;border:0px" frameborder=0 src="index.<?php echo $uimXdkmdPAzeMTg1?>?op=crawlproc&bg=<?php echo $_POST['bg']?>&resume=<?php echo $_POST['resume']?>"></iframe>
																										<!--
																										<div id="rlog2" style="bottom:5px;position:fixed;width:100%;font-size:12px;background-color:#fff;z-index:2000;padding-top:5px;border-top:#999 1px dotted"></div>
																										-->
																										<div id="rlog" style="overflow:auto;"></div>
																										<div id="runlog" style="overflow:auto;height:100px;display:none;"></div>
																										<?php }else if(!$YyBIyE8gG1eQSuo) { ?>
																										<div id="sidenote">
																										<?php include kxesmZvVXn.'page-sitemap-detail.inc.php'; ?>
																										</div>
																										<div id="shifted">
																										<h2>Crawling</h2>
																										<form action="index.<?php echo $uimXdkmdPAzeMTg1?>?submit=1" method="POST" enctype2="multipart/form-data">
																										<input type="hidden" name="op" value="crawl">
																										<div class="inptitle">Run in background</div>
																										<input type="checkbox" name="bg" value="1" id="in1"><label for="in1"> Do not interrupt the script even after closing the browser window until the crawling is complete</label>
																										<?php if(@file_exists(a0mMmHqPDZ.fSB9ZrUIK4aICK6XAM)){ if(@file_exists(a0mMmHqPDZ.yyq7fDoK_cBPACC6n1)){ $cLGNu3fjIGa = @W4Xzu7_XRKxGlHA(pUvA4zhAkYZK2Nd8A(a0mMmHqPDZ.yyq7fDoK_cBPACC6n1));; } if(!$cLGNu3fjIGa){ $J8NZ8Rx5Xj8oKk = @W4Xzu7_XRKxGlHA(pUvA4zhAkYZK2Nd8A(a0mMmHqPDZ.fSB9ZrUIK4aICK6XAM)); $cLGNu3fjIGa = $J8NZ8Rx5Xj8oKk['progpar']; } ?>
																										<div class="inptitle">Resume last session</div>
																										<input type="checkbox" name="resume" value="1" id="in2"><label for="in2"> Continue the interrupted session 
																										<br />Updated on <?php  $DOEjLOF5SKtUYVQEkD = filemtime(a0mMmHqPDZ.fSB9ZrUIK4aICK6XAM); echo date('Y-m-d H:i:s',$DOEjLOF5SKtUYVQEkD); if(time()-$DOEjLOF5SKtUYVQEkD<600)echo ' ('.(time()-$DOEjLOF5SKtUYVQEkD).' seconds ago) '; ?>, 
																										<?php echo	'Time elapsed: '.PvEr4n2DQ($cLGNu3fjIGa[0]).',<br />Pages crawled: '.intval($cLGNu3fjIGa[3]). ' ('.intval($cLGNu3fjIGa[7]).' added in sitemap), '. 'Queued: '.$cLGNu3fjIGa[2].', Depth level: '.$cLGNu3fjIGa[5]. '<br />Current page: '.$cLGNu3fjIGa[1].' ('.number_format($cLGNu3fjIGa[10],1).')'; } ?>
																										</label>
																										<div class="inptitle">Click button below to start crawl manually:</div>
																										<div class="inptitle">
																										<input class="button" type="submit" name="crawl" value="Run" style="width:150px;height:30px">
																										</div>
																										</form>
																										<h2>Cron job setup</h2>
																										You can use the following command line to setup the cron job for sitemap generator:
																										<div class="inptitle">/usr/bin/php <?php echo dirname(dirname(__FILE__)).'/runcrawl.php'?></div>
																										</div>
																										<?php } include kxesmZvVXn.'page-bottom.inc.php'; 



































































































