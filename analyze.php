<?php
//
//require_once 'config.php';
//require_once 'libs/global.lib.php';
//require_once 'libs/translate.lib.php';
//require_once 'libs/logic.lib.php';
//require_once 'api/api_all.php';
//require_once 'api/api_functions.php';
//
//header("Content-Type: application/json");
//
//$json = '{"25":6.5287039160728,"3359":3.5,"3353":3.5,"3355":3.5,"3114":3.3,"3115":3.3,"3116":3.3,"3117":3.3,"3118":3.3,"3113":3.3,"3122":3.3,"3123":3.3,"313":3.3,"3141":3.3,"3151":3.3,"3313":3.3,"3112":3.3,"3119":3.3,"3111":3.3,"811":3.3,"74":3.3,"2152":3.1922359824181,"2153":3.1782821178436,"61":3,"2164":2.6,"2143":2.6,"2144":2.6,"2145":2.6,"2149":2.6,"2151":2.6,"2161":2.6,"2141":2.6,"2165":2.6,"2142":2.6,"3341":2.5,"3342":2.5,"3343":2.5,"3344":2.5,"4313":2.3,"4312":2.3,"4311":2.3,"3411":2.2,"3412":2.2,"3413":2.2,"3213":2.2,"3251":2.2,"3212":2.2,"3211":2.2,"3254":2.2,"3255":2.2,"3257":2.2,"3259":2.2,"2250":2.2,"521":2.1436378598213,"713":2.1,"711":2,"712":2,"8211":2,"9321":2,"8212":2,"8219":2,"73":2,"352":2,"62":2,"9329":2,"8172":2,"351":2,"5141":2,"814":2,"5164":1.91291629076,"5142":1.9,"5222":1.8605372905731,"5113":1.8516056060791,"8157":1.8,"8160":1.7,"753":1.7,"751":1.7,"5230":1.6566468715668,"5223":1.5768124341965,"3333":1.5,"3334":1.5,"3339":1.5,"53":1.4744454741478,"2261":1.4,"2262":1.4,"2212":1.4,"2211":1.4,"2263":1.4,"2265":1.4,"2266":1.4,"2269":1.4,"721":1.3,"722":1.3,"723":1.3,"2356":1.2,"5165":1.2,"2221":1.2,"2643":1.2,"2424":1.2,"2423":1.2,"2422":1.2,"2421":1.2,"2310":1.2,"2359":1.2,"2342":1.2,"2351":1.2,"2354":1.2,"2353":1.2,"2320":1.2,"413":1.2,"412":1.2,"411":1.2,"2352":1.2,"2355":1.2,"2341":1.2,"2330":1.2,"2621":1,"2611":1,"2612":1,"2619":1,"7522":1,"2622":1,"2413":1,"2412":1,"2411":1,"5245":0.9601055264473,"4226":0.766350877285,"962":0.73482403755188,"5244":0.5,"5221":0.5,"5243":0.5,"5241":0.5,"5242":0.5,"5246":0.3,"5249":0.3,"54":0.3,"832":0.3,"8331":0.3,"4323":0.3,"5131":0.3,"4322":0.3,"4321":0.3,"2434":0.2,"4222":0.2,"263":0.2,"2432":0.2,"2431":0.2,"3321":0.2,"3322":0.2,"3323":0.2,"5151":0.2,"4211":0.2,"4212":0.2,"4221":0.2,"3324":0.2,"4223":0.2,"4411":0.2,"4224":0.2,"4419":0.2,"4416":0.2,"4415":0.2,"4412":0.2,"2433":0.2,"4227":0.2,"4225":0.2,"9411":0.1,"95":0.1,"9334":0,"9312":0,"9333":0,"9332":0,"5132":0,"9313":0,"835":0,"834":0,"8332":0,"322":0,"342":0}';
//$category_ids = json_decode($json, true);
//$category_ids = array_filter($category_ids, function ($v) {
//  return $v >= 0;
//});
//
//var_dump($category_ids);
//
//$result = db_query('SELECT * from JOBS_CATEGORIES where CATEGORY_ID IN ('.implode(',', array_keys($category_ids)).')');
//
//$job_category_ids = array();
//while ($row = mysqli_fetch_assoc($result)) {
//  if (!isset($job_category_ids[$row['category_id']])) {
//    $job_category_ids[$row['category_id']] = array();
//  }
//
//  $job_category_ids[$row['category_id']][] = $row['job_id'];
//}
//
//$job_ids = array();
//foreach ($category_ids as $category_id => $value) {
//  if (!isset($job_category_ids[$category_id])) {
//    continue;
//  }
//
//  $found = array_slice($job_category_ids[$category_id], 0, 3);
//  foreach ($found as $job_id) {
//    $job_ids[$job_id] = $value;
//  }
//}
//
//arsort($job_ids);
//
//$result = db_query('SELECT * from JOBS where ID IN ('.implode(',', array_keys($job_ids)).')');
//$jobs = array();
//while ($row = mysqli_fetch_assoc($result)) {
//  $row = json_decode($row['json'], true);
//  $jobs[(int)$row['ilmoitusnumero']] = $row;
//}
//
//
//$result = array();
//foreach ($job_ids as $job_id => $value) {
//  if (isset($jobs[(int)$job_id])) {
//    $result[] = $jobs[(int)$job_id];
//  }
//}
//
//var_dump($result);
////var_dump($jobs);
////  $json = json_decode($row['json'], true);
////
////  if (!isset($json['tehtavanimi'])) {
////    continue;
////  }
////
////  if (!isset($json['palkkausteksti'])) {
////    continue;
////  }
////
////  if (!isset($json['tyopaikanOsoite'])) {
////    continue;
////  }
////
////  if (!isset($json['tyoaikatekstiYhdistetty'])) {
////    continue;
////  }
////
////  if (isset($json['sijainti'])) {
////    list($a, $b) = explode(',', $json['sijainti']);
////    $distance = distance($a, $b, 60.1811483, 24.8090845, "K") * 1000;
////    if ($distance < 500) {
////      $distance = '<500m';
////    } else {
////      if ($distance < 1000) {
////        $distance = '<1km';
////      } else {
////        if ($distance < 3000) {
////          $distance = '<3km';
////        } else {
////          if ($distance < 5000) {
////            $distance = '<5km';
////          } else {
////            if ($distance < 100000) {
////              $distance = '<100km';
////            } else {
////              $distance = '>100km';
////            }
////          }
////        }
////      }
////    }
////  } else if (isset($json['postitoimipaikka'])){
////    $distance = ucfirst($json['postitoimipaikka']);
////  } else {
////    $distance = 'Unknown';
////  }
////
////  $jobs[] = array(
////    'id'        => $json['ilmoitusnumero'],
////    'title'     => translate_query($lang, $json['tehtavanimi'], 'fi'),
////    'salary'    => translate_query($lang, $json['palkkausteksti'], 'fi'),
////    'address'   => $json['tyopaikanOsoite'],
////    'distance'  => $distance,
////    'work_time' => translate_query($lang, $json['tyoaikatekstiYhdistetty'], 'fi'),
////  );
////}
////
////if (count($jobs) > 50) {
////  $jobs = array_slice($jobs,0, rand(50, min(100, count($jobs))));
////}
//
////return $jobs;
//
//
////var_dump(_translate_request('ru', '3-vuorotyö', 'fi'));
////_db_init();
////_db_loadCategories();
//
////
////header("Content-Type: application/json");
////
////$items = array();
////
////list($jobs_count, $categories) = test_t3();
////$result = array();
////$j = 0;
////foreach ($categories as $category_id => $total_count) {
////  $count = 100;
////  $jobs = array();
////  for ($i = 0; $i < $total_count; $i += 100) {
////    $offset = $i;
////    $url = 'https://paikat.te-palvelut.fi/tpt-api/tyopaikat?valitutAmmattialat='.$category_id.'&ilmoitettuPvm=1&vuokrapaikka=---&sort=mainAmmattiRivino%20asc,%20tehtavanimi%20asc,%20tyonantajanNimi%20asc,%20viimeinenHakupaivamaara%20asc&kentat=ilmoitusnumero,tyokokemusammattikoodi,ammattiLevel3,tehtavanimi,tyokokemusammatti,tyonantajanNimi,kunta,ilmoituspaivamaara,hakuPaattyy,tyoaikatekstiYhdistetty,tyonKestoKoodi,tyonKesto,tyoaika,tyonKestoTekstiYhdistetty,hakemusOsoitetaan,maakunta,maa,hakuTyosuhdetyyppikoodi,hakuTyoaikakoodi,hakuTyonKestoKoodi&rows='
////      . $count . '&start=' . $offset . '&ss=true&facet.fkentat=hakuTyoaikakoodi,ammattikoodi,aluehaku,hakuTyonKestoKoodi,hakuTyosuhdetyyppikoodi,oppisopimus&facet.fsort=index&facet.flimit=-1';
////
////    $r = _request($url);
////    $docs = $r['response']['docs'];
////    if (!$docs) {
////      continue;
////    }
////
////    $jobs = array_merge($jobs, $docs);
////  }
////
////  $result[$category_id] = $jobs;
////  $j++;
////  echo $j.'/'.count($categories)."\n";
////}
////
//////
//////
////$json = json_encode($result);
////file_put_contents('jobs.json', $json);
//////
////
////function _request($url) {
////  $ch = curl_init();
////  curl_setopt($ch, CURLOPT_URL, $url);
////  curl_setopt($ch, CURLOPT_RETURNTRANSFER, true);
////  $server_output = curl_exec($ch);
////  curl_close($ch);
////
////  return json_decode($server_output, true);
////}
////
////function test_t3() {
////
////  $all_categories = test_it2();
////
////  $counters = array();
////  foreach ($all_categories as $category) {
////    $category_id = $category['koodi'];
////    $count = $category['count'];
////
////    if (!$category['count']) {
////      continue;
////    }
////
////    if (strlen($category_id) == 1) {
////      continue;
////    }
////
////    $counters[$category_id] = $count;
////  }
////
////  $result = array();
////  $jobs = 0;
////  foreach ($counters as $category_id => $count) {
////    for ($i = 1; $i <= strlen($category_id); $i++) {
////      $parent_id = substr($category_id, 0, $i - 1);
////      if (strlen($parent_id) > 0) {
////        $jobs -= (int)$result[$parent_id];
////        unset($result[$parent_id]);
////      }
////
////      $result[$category_id] = $count;
////      $jobs += $count;
////    }
////  }
////
////  return array($jobs, $result);
////}
////
////function stringToArray($s) {
////  $r = array();
////  for ($i = 0; $i < strlen($s); $i++)
////    $r[$i] = $s[$i];
////
////  return $r;
////}
////
////
////function test_it2() {
////  $r = json_decode(test_it(), true);
////
////  return $r;
////}
////
////function test_it() {
////  return '[
////{
////"koodi": "1",
////"kuvaus": "Johtajat",
////"count": 177
////},
////{
////"koodi": "11",
////"kuvaus": "Johtajat, ylimm?t virkamiehet ja j?rjest?jen jt",
////"count": 36
////},
////{
////"koodi": "111",
////"kuvaus": "Ylimm?t virkamiehet ja j?rjest?jen johtajat",
////"count": 27
////},
////{
////"koodi": "1111",
////"kuvaus": "Lains??t?j?t",
////"count": 0
////},
////{
////"koodi": "1112",
////"kuvaus": "Julkishallinnon ylimm?t virkamiehet",
////"count": 17
////},
////{
////"koodi": "1114",
////"kuvaus": "J?rjest?jen johtajat",
////"count": 10
////},
////{
////"koodi": "112",
////"kuvaus": "Toimitusjohtajat ja p??johtajat",
////"count": 9
////},
////{
////"koodi": "1120",
////"kuvaus": "Toimitusjohtajat ja p??johtajat",
////"count": 9
////},
////{
////"koodi": "12",
////"kuvaus": "Hallintojohtajat ja kaupalliset johtajat",
////"count": 47
////},
////{
////"koodi": "121",
////"kuvaus": "Liiketoiminta- ja hallintojohtajat",
////"count": 20
////},
////{
////"koodi": "1211",
////"kuvaus": "Talousjohtajat",
////"count": 3
////},
////{
////"koodi": "1212",
////"kuvaus": "Henkil?st?johtajat",
////"count": 5
////},
////{
////"koodi": "1213",
////"kuvaus": "Politiikka- ja suunnittelujohtajat",
////"count": 0
////},
////{
////"koodi": "1219",
////"kuvaus": "Muut hallintojohtajat ja kaupalliset johtajat",
////"count": 12
////},
////{
////"koodi": "122",
////"kuvaus": "Myynti-, markkinointi- ja kehitysjohtajat",
////"count": 27
////},
////{
////"koodi": "1221",
////"kuvaus": "Myynti- ja markkinointijohtajat",
////"count": 20
////},
////{
////"koodi": "1222",
////"kuvaus": "Mainos- ja tiedotusjohtajat",
////"count": 2
////},
////{
////"koodi": "1223",
////"kuvaus": "Tutkimus- ja kehitysjohtajat",
////"count": 5
////},
////{
////"koodi": "13",
////"kuvaus": "Tuotantotoiminnan, yhteiskunnan peruspalvelujen jt",
////"count": 74
////},
////{
////"koodi": "131",
////"kuvaus": "Maa-, mets?- ja kalatalouden johtajat",
////"count": 1
////},
////{
////"koodi": "1311",
////"kuvaus": "Maa- ja mets?talouden johtajat",
////"count": 1
////},
////{
////"koodi": "1312",
////"kuvaus": "Vesiviljely- ja kalatalouden johtajat",
////"count": 0
////},
////{
////"koodi": "132",
////"kuvaus": "Teollisuustuotanto-, kaivos-, rakennus-, jakelujt",
////"count": 20
////},
////{
////"koodi": "1321",
////"kuvaus": "Teollisuuden tuotantojohtajat",
////"count": 9
////},
////{
////"koodi": "1322",
////"kuvaus": "Kaivostoiminnan tuotantojohtajat",
////"count": 0
////},
////{
////"koodi": "1323",
////"kuvaus": "Rakennustoiminnan tuotantojohtajat",
////"count": 3
////},
////{
////"koodi": "1324",
////"kuvaus": "Hankinta- ja jakelujohtajat",
////"count": 9
////},
////{
////"koodi": "133",
////"kuvaus": "Tieto- ja viestint?teknologiajohtajat",
////"count": 1
////},
////{
////"koodi": "1330",
////"kuvaus": "Tieto- ja viestint?teknologiajohtajat",
////"count": 1
////},
////{
////"koodi": "134",
////"kuvaus": "Yhteiskunnan perus-, rahoitus-, vakuutuspalvelujt",
////"count": 52
////},
////{
////"koodi": "1341",
////"kuvaus": "Lastenhoidon johtajat",
////"count": 9
////},
////{
////"koodi": "1342",
////"kuvaus": "Terveydenhuollon johtajat",
////"count": 6
////},
////{
////"koodi": "1343",
////"kuvaus": "Vanhustenhuollon johtajat",
////"count": 4
////},
////{
////"koodi": "1344",
////"kuvaus": "Sosiaalihuollon johtajat",
////"count": 13
////},
////{
////"koodi": "1345",
////"kuvaus": "Opetusalan johtajat",
////"count": 8
////},
////{
////"koodi": "1346",
////"kuvaus": "Rahoitus- ja vakuutuspalvelujen johtajat",
////"count": 2
////},
////{
////"koodi": "1349",
////"kuvaus": "Muut yhteiskunnan palvelujen johtajat",
////"count": 10
////},
////{
////"koodi": "14",
////"kuvaus": "Hotelli-, ravintola-, kaupan, muiden palvelujen jt",
////"count": 20
////},
////{
////"koodi": "141",
////"kuvaus": "Hotellin- ja ravintolanjohtajat",
////"count": 7
////},
////{
////"koodi": "1411",
////"kuvaus": "Hotellinjohtajat",
////"count": 3
////},
////{
////"koodi": "1412",
////"kuvaus": "Ravintolanjohtajat",
////"count": 4
////},
////{
////"koodi": "142",
////"kuvaus": "V?hitt?is- ja tukkukaupan johtajat",
////"count": 0
////},
////{
////"koodi": "1420",
////"kuvaus": "V?hitt?is- ja tukkukaupan johtajat",
////"count": 0
////},
////{
////"koodi": "143",
////"kuvaus": "Muiden palvelualojen johtajat",
////"count": 13
////},
////{
////"koodi": "1431",
////"kuvaus": "Urheilu-, vapaa-aika- ja kulttuurikeskusten johtaj",
////"count": 6
////},
////{
////"koodi": "1439",
////"kuvaus": "Muut palvelualojen johtajat",
////"count": 7
////},
////{
////"koodi": "2",
////"kuvaus": "Erityisasiantuntijat",
////"count": 3330
////},
////{
////"koodi": "21",
////"kuvaus": "Luonnontieteiden ja tekniikan erityisasiantuntijat",
////"count": 1081
////},
////{
////"koodi": "211",
////"kuvaus": "Luonnon- ja geotieteen erityisasiantuntijat",
////"count": 16
////},
////{
////"koodi": "2111",
////"kuvaus": "Fyysikot ja astronomit",
////"count": 4
////},
////{
////"koodi": "2112",
////"kuvaus": "Meteorologit",
////"count": 0
////},
////{
////"koodi": "2113",
////"kuvaus": "Kemistit",
////"count": 6
////},
////{
////"koodi": "2114",
////"kuvaus": "Geologit ja geofyysikot",
////"count": 6
////},
////{
////"koodi": "212",
////"kuvaus": "Matematiikan ja tilastotieteen er.",
////"count": 4
////},
////{
////"koodi": "2120",
////"kuvaus": "Matemaatikot, aktuaarit ja tilastotieteilij?t",
////"count": 4
////},
////{
////"koodi": "213",
////"kuvaus": "Biotieteiden erityisasiantuntijat",
////"count": 28
////},
////{
////"koodi": "2131",
////"kuvaus": "Biologit, kasvi- ja el?intieteilij?t ym. er.",
////"count": 9
////},
////{
////"koodi": "2132",
////"kuvaus": "Maa-, mets?- ja kalatalouden er.",
////"count": 8
////},
////{
////"koodi": "2133",
////"kuvaus": "Ymp?rist?n- ja luonnonsuojelun er.",
////"count": 11
////},
////{
////"koodi": "214",
////"kuvaus": "Tekniikan erityisasiantuntijat (pl. s?hk?teknologi",
////"count": 669
////},
////{
////"koodi": "2141",
////"kuvaus": "Teollisen valmistuksen ja tuotantotekniikan er.",
////"count": 60
////},
////{
////"koodi": "2142",
////"kuvaus": "Maa- ja vesirakentamisen erityisasiantuntijat",
////"count": 214
////},
////{
////"koodi": "2143",
////"kuvaus": "Ymp?rist?tekniikan erityisasiantuntijat",
////"count": 11
////},
////{
////"koodi": "2144",
////"kuvaus": "Konetekniikan erityisasiantuntijat",
////"count": 228
////},
////{
////"koodi": "2145",
////"kuvaus": "Puunjalostuksen ja kemian prosessitekniikan er.",
////"count": 25
////},
////{
////"koodi": "2146",
////"kuvaus": "Kaivosteollisuuden, metallurgian ym. er.",
////"count": 4
////},
////{
////"koodi": "2149",
////"kuvaus": "Muut tekniikan erityisasiantuntijat",
////"count": 163
////},
////{
////"koodi": "215",
////"kuvaus": "S?hk?teknologian erityisasiantuntijat",
////"count": 313
////},
////{
////"koodi": "2151",
////"kuvaus": "S?hk?tekniikan erityisasiantuntijat",
////"count": 219
////},
////{
////"koodi": "2152",
////"kuvaus": "Elektroniikan erityisasiantuntijat",
////"count": 47
////},
////{
////"koodi": "2153",
////"kuvaus": "ICT-alan erityisasiantuntijat",
////"count": 58
////},
////{
////"koodi": "216",
////"kuvaus": "Arkkitehdit, suunnittelijat ja maanmittaajat",
////"count": 67
////},
////{
////"koodi": "2161",
////"kuvaus": "Talonrakennuksen arkkitehdit",
////"count": 27
////},
////{
////"koodi": "2162",
////"kuvaus": "Maisema-arkkitehdit",
////"count": 0
////},
////{
////"koodi": "2163",
////"kuvaus": "Tuote- ja vaatesuunnittelijat",
////"count": 6
////},
////{
////"koodi": "2164",
////"kuvaus": "Yhdyskunta- ja liikennesuunnittelijat",
////"count": 10
////},
////{
////"koodi": "2165",
////"kuvaus": "Kartoituksen ja maanmittauksen er.",
////"count": 21
////},
////{
////"koodi": "2166",
////"kuvaus": "Graafiset ja multimediasuunnittelijat",
////"count": 4
////},
////{
////"koodi": "22",
////"kuvaus": "Terveydenhuollon erityisasiantuntijat",
////"count": 314
////},
////{
////"koodi": "221",
////"kuvaus": "L??k?rit",
////"count": 145
////},
////{
////"koodi": "2211",
////"kuvaus": "Yleisl??k?rit",
////"count": 61
////},
////{
////"koodi": "2212",
////"kuvaus": "Ylil??k?rit ja erikoisl??k?rit",
////"count": 84
////},
////{
////"koodi": "222",
////"kuvaus": "Hoitoty?n erityisasiantuntijat",
////"count": 16
////},
////{
////"koodi": "2221",
////"kuvaus": "Ylihoitajat ja osastonhoitajat",
////"count": 16
////},
////{
////"koodi": "225",
////"kuvaus": "El?inl??k?rit",
////"count": 14
////},
////{
////"koodi": "2250",
////"kuvaus": "El?inl??k?rit",
////"count": 14
////},
////{
////"koodi": "226",
////"kuvaus": "Muut terveydenhuollon erityisasiantuntijat",
////"count": 139
////},
////{
////"koodi": "2261",
////"kuvaus": "Hammasl??k?rit",
////"count": 47
////},
////{
////"koodi": "2262",
////"kuvaus": "Proviisorit",
////"count": 3
////},
////{
////"koodi": "2263",
////"kuvaus": "Ymp?rist?terveyden ja ty?suojelun er.",
////"count": 4
////},
////{
////"koodi": "2265",
////"kuvaus": "Ravitsemusalan erityisasiantuntijat",
////"count": 6
////},
////{
////"koodi": "2266",
////"kuvaus": "Kuulontutkijat ja puheterapeutit",
////"count": 67
////},
////{
////"koodi": "2269",
////"kuvaus": "Muut luokittelemattomat terveydenhuollon er.",
////"count": 12
////},
////{
////"koodi": "23",
////"kuvaus": "Opettajat ja muut opetusalan erityisasiantuntijat",
////"count": 591
////},
////{
////"koodi": "231",
////"kuvaus": "Yliopisto- ja korkeakouluopettajat",
////"count": 77
////},
////{
////"koodi": "2310",
////"kuvaus": "Yliopistojen ja ammattikorkeakoulujen opettajat",
////"count": 77
////},
////{
////"koodi": "232",
////"kuvaus": "Ammatillisen koulutuksen opettajat",
////"count": 36
////},
////{
////"koodi": "2320",
////"kuvaus": "Ammatillisen koulutuksen opettajat",
////"count": 36
////},
////{
////"koodi": "233",
////"kuvaus": "Lukion ja peruskoulun yl?luokkien opettajat",
////"count": 91
////},
////{
////"koodi": "2330",
////"kuvaus": "Lukion ja peruskoulun yl?luokkien opettajat",
////"count": 91
////},
////{
////"koodi": "234",
////"kuvaus": "Peruskoulun alaluokkien opett., lastentarhanopett.",
////"count": 304
////},
////{
////"koodi": "2341",
////"kuvaus": "Peruskoulun alaluokkien opettajat",
////"count": 69
////},
////{
////"koodi": "2342",
////"kuvaus": "Lastentarhanopettajat",
////"count": 237
////},
////{
////"koodi": "235",
////"kuvaus": "Muut opetusalan erityisasiantuntijat",
////"count": 92
////},
////{
////"koodi": "2351",
////"kuvaus": "Opetusmenetelmien erityisasiantuntijat",
////"count": 16
////},
////{
////"koodi": "2352",
////"kuvaus": "Erityisopettajat",
////"count": 33
////},
////{
////"koodi": "2353",
////"kuvaus": "Muut kieltenopettajat",
////"count": 8
////},
////{
////"koodi": "2354",
////"kuvaus": "Muut musiikin opettajat",
////"count": 3
////},
////{
////"koodi": "2355",
////"kuvaus": "Muut taideaineiden opettajat",
////"count": 3
////},
////{
////"koodi": "2356",
////"kuvaus": "Muut tietotekniikan opettajat ja kouluttajat",
////"count": 2
////},
////{
////"koodi": "2359",
////"kuvaus": "Opinto-ohjaajat ja muut opetuksen er.",
////"count": 28
////},
////{
////"koodi": "24",
////"kuvaus": "Liike-el?m?n ja hallinnon erityisasiantuntijat",
////"count": 478
////},
////{
////"koodi": "241",
////"kuvaus": "Rahoitusalan erityisasiantuntijat",
////"count": 57
////},
////{
////"koodi": "2411",
////"kuvaus": "Laskentatoimen er. ja tilintarkastajat",
////"count": 39
////},
////{
////"koodi": "2412",
////"kuvaus": "Rahoitus- ja sijoitusneuvojat",
////"count": 10
////},
////{
////"koodi": "2413",
////"kuvaus": "Rahoitusanalyytikot",
////"count": 8
////},
////{
////"koodi": "242",
////"kuvaus": "Hallinnon erityisasiantuntijat",
////"count": 99
////},
////{
////"koodi": "2421",
////"kuvaus": "Johtamisen ja organisaatioiden er.",
////"count": 7
////},
////{
////"koodi": "2422",
////"kuvaus": "Hallinnon ja elinkeinojen kehitt?misen er.",
////"count": 21
////},
////{
////"koodi": "2423",
////"kuvaus": "Henkil?st?hallinnon er. ja urasuunnittelijat",
////"count": 65
////},
////{
////"koodi": "2424",
////"kuvaus": "Henkil?st?n kehitt?misen er. ja kouluttajat",
////"count": 7
////},
////{
////"koodi": "243",
////"kuvaus": "Myynnin, markkinoinnin ja tiedotuksen er.",
////"count": 324
////},
////{
////"koodi": "2431",
////"kuvaus": "Mainonnan ja markkinoinnin erityisasiantuntijat",
////"count": 288
////},
////{
////"koodi": "2432",
////"kuvaus": "Tiedottajat",
////"count": 19
////},
////{
////"koodi": "2433",
////"kuvaus": "Myynti-insin??rit ja l??ke-esittelij?t (pl. ICT)",
////"count": 4
////},
////{
////"koodi": "2434",
////"kuvaus": "Tieto- ja viestint?tekniikan myynnin er.",
////"count": 16
////},
////{
////"koodi": "25",
////"kuvaus": "Tieto- ja viestint?teknologian erityisasiantuntija",
////"count": 531
////},
////{
////"koodi": "251",
////"kuvaus": "Systeemity?n erityisasiantuntijat",
////"count": 474
////},
////{
////"koodi": "2511",
////"kuvaus": "Sovellusarkkitehdit",
////"count": 86
////},
////{
////"koodi": "2512",
////"kuvaus": "Sovellussuunnittelijat",
////"count": 189
////},
////{
////"koodi": "2513",
////"kuvaus": "Web- ja multimediakehitt?j?t",
////"count": 20
////},
////{
////"koodi": "2514",
////"kuvaus": "Sovellusohjelmoijat",
////"count": 90
////},
////{
////"koodi": "2519",
////"kuvaus": "Muut ohjelmisto- ja sovelluskehitt?j?t",
////"count": 98
////},
////{
////"koodi": "252",
////"kuvaus": "Tietokantojen,- verkkojen ja ohjelmistojen er.",
////"count": 62
////},
////{
////"koodi": "2521",
////"kuvaus": "Tietokantasuunnittelijat ja -vastaavat",
////"count": 28
////},
////{
////"koodi": "2522",
////"kuvaus": "Tietoj?rjestelmien yll?pit?j?t",
////"count": 11
////},
////{
////"koodi": "2523",
////"kuvaus": "Tietoverkkojen erityisasiantuntijat",
////"count": 19
////},
////{
////"koodi": "2529",
////"kuvaus": "Muut tietokanta- ja tietoverkkojen erityisasiantun",
////"count": 9
////},
////{
////"koodi": "26",
////"kuvaus": "Lainopilliset, sosiaalialan ja kulttuurialan er.",
////"count": 370
////},
////{
////"koodi": "261",
////"kuvaus": "Lainopilliset erityisasiantuntijat",
////"count": 29
////},
////{
////"koodi": "2611",
////"kuvaus": "Asianajajat",
////"count": 16
////},
////{
////"koodi": "2612",
////"kuvaus": "Tuomioistuinlakimiehet",
////"count": 2
////},
////{
////"koodi": "2619",
////"kuvaus": "Muut lainopilliset erityisasiantuntijat",
////"count": 11
////},
////{
////"koodi": "262",
////"kuvaus": "Kirjaston- ja arkistonhoitajat sek? museoalan er.",
////"count": 16
////},
////{
////"koodi": "2621",
////"kuvaus": "Arkistonhoitajat ja museoalan erityisasiantuntijat",
////"count": 5
////},
////{
////"koodi": "2622",
////"kuvaus": "Kirjastonhoitajat, informaatikot ym.",
////"count": 11
////},
////{
////"koodi": "263",
////"kuvaus": "Yhteiskunta- ja sosiaalialan sek? uskontojen er.",
////"count": 222
////},
////{
////"koodi": "2631",
////"kuvaus": "Ekonomistit",
////"count": 3
////},
////{
////"koodi": "2632",
////"kuvaus": "Yhteiskunta- ja kulttuuritutkijat",
////"count": 8
////},
////{
////"koodi": "2633",
////"kuvaus": "Historioitsijat, politiikan tutkijat ja filosofit",
////"count": 0
////},
////{
////"koodi": "2634",
////"kuvaus": "Psykologit",
////"count": 50
////},
////{
////"koodi": "2635",
////"kuvaus": "Sosiaality?n erityisasiantuntijat",
////"count": 160
////},
////{
////"koodi": "2636",
////"kuvaus": "Papit ym. uskonnollisen el?m?n er.",
////"count": 2
////},
////{
////"koodi": "264",
////"kuvaus": "Toimittajat, kirjailijat ja kielitieteilij?t",
////"count": 62
////},
////{
////"koodi": "2641",
////"kuvaus": "Kirjailijat ym.",
////"count": 0
////},
////{
////"koodi": "2642",
////"kuvaus": "Toimittajat",
////"count": 4
////},
////{
////"koodi": "2643",
////"kuvaus": "K??nt?j?t, tulkit ja muut kielitieteilij?t",
////"count": 58
////},
////{
////"koodi": "265",
////"kuvaus": "Taiteilijat",
////"count": 41
////},
////{
////"koodi": "2651",
////"kuvaus": "Kuvataiteilijat",
////"count": 2
////},
////{
////"koodi": "2652",
////"kuvaus": "Muusikot, laulajat ja s?velt?j?t",
////"count": 4
////},
////{
////"koodi": "2653",
////"kuvaus": "Tanssitaiteilijat ja koreografit",
////"count": 1
////},
////{
////"koodi": "2654",
////"kuvaus": "Ohjaajat ja tuottajat",
////"count": 11
////},
////{
////"koodi": "2655",
////"kuvaus": "N?yttelij?t",
////"count": 8
////},
////{
////"koodi": "2656",
////"kuvaus": "Juontajat, kuuluttajat ym.",
////"count": 10
////},
////{
////"koodi": "2659",
////"kuvaus": "Muut taiteilijat",
////"count": 5
////},
////{
////"koodi": "3",
////"kuvaus": "Asiantuntijat",
////"count": 2887
////},
////{
////"koodi": "31",
////"kuvaus": "Luonnontieteiden ja tekniikan asiantuntijat",
////"count": 448
////},
////{
////"koodi": "311",
////"kuvaus": "Fysiikan, kemian ja teknisten alojen asiantuntijat",
////"count": 188
////},
////{
////"koodi": "3111",
////"kuvaus": "Luonnontieteen tekniset asiantuntijat",
////"count": 1
////},
////{
////"koodi": "3112",
////"kuvaus": "Rakentamisen asiantuntijat",
////"count": 35
////},
////{
////"koodi": "3113",
////"kuvaus": "S?hk?tekniikan asiantuntijat",
////"count": 20
////},
////{
////"koodi": "3114",
////"kuvaus": "Elektroniikan asiantuntijat",
////"count": 13
////},
////{
////"koodi": "3115",
////"kuvaus": "Konetekniikan asiantuntijat",
////"count": 68
////},
////{
////"koodi": "3116",
////"kuvaus": "Kemian prosessitekniikan asiantuntijat",
////"count": 4
////},
////{
////"koodi": "3117",
////"kuvaus": "Kaivosteollisuuden ja metallurgian asiantuntijat",
////"count": 1
////},
////{
////"koodi": "3118",
////"kuvaus": "Tekniset piirt?j?t",
////"count": 19
////},
////{
////"koodi": "3119",
////"kuvaus": "Muut fysiikan, kemian ja teknisten alojen a.",
////"count": 43
////},
////{
////"koodi": "312",
////"kuvaus": "Ty?njt kaivos-, teollisuus- ja rakennustoiminnassa",
////"count": 235
////},
////{
////"koodi": "3121",
////"kuvaus": "Kaivosty?njohtajat",
////"count": 1
////},
////{
////"koodi": "3122",
////"kuvaus": "Teollisuuden ty?njohtajat",
////"count": 77
////},
////{
////"koodi": "3123",
////"kuvaus": "Rakennusalan ty?njohtajat",
////"count": 159
////},
////{
////"koodi": "313",
////"kuvaus": "Prosessinvalvonnan asiantuntijat",
////"count": 11
////},
////{
////"koodi": "3131",
////"kuvaus": "Voimalaitosten prosessinhoitajat",
////"count": 0
////},
////{
////"koodi": "3132",
////"kuvaus": "J?tteenpoltto-, vedenpuhdistuslaitos pros.hoitajat",
////"count": 3
////},
////{
////"koodi": "3133",
////"kuvaus": "Kemianteollisuuden prosessinhoitajat",
////"count": 6
////},
////{
////"koodi": "3134",
////"kuvaus": "?ljy- ja maakaasujalostamon prosessinhoitajat",
////"count": 0
////},
////{
////"koodi": "3135",
////"kuvaus": "Metallien jalostuksen prosessinhoitajat",
////"count": 1
////},
////{
////"koodi": "3139",
////"kuvaus": "Muut prosessinvalvonnan asiantuntijat",
////"count": 1
////},
////{
////"koodi": "314",
////"kuvaus": "Biotieteiden asiantuntijat",
////"count": 17
////},
////{
////"koodi": "3141",
////"kuvaus": "Laborantit ym.",
////"count": 17
////},
////{
////"koodi": "3142",
////"kuvaus": "Maa- ja kalatalousteknikot",
////"count": 0
////},
////{
////"koodi": "3143",
////"kuvaus": "Mets?talousteknikot",
////"count": 0
////},
////{
////"koodi": "315",
////"kuvaus": "Laiva-, lento-, satamaliikenne p??llik?t, ohjaajat",
////"count": 6
////},
////{
////"koodi": "3151",
////"kuvaus": "Laivojen konep??llik?t ja -mestarit",
////"count": 5
////},
////{
////"koodi": "3152",
////"kuvaus": "Vesiliikenteen per?miehet ja p??llik?t",
////"count": 1
////},
////{
////"koodi": "3153",
////"kuvaus": "Lentokapteenit ja -per?miehet",
////"count": 0
////},
////{
////"koodi": "3154",
////"kuvaus": "Lennonjohtajat",
////"count": 0
////},
////{
////"koodi": "3155",
////"kuvaus": "Lennonvalvonnan tekniset asiantuntijat",
////"count": 0
////},
////{
////"koodi": "32",
////"kuvaus": "Terveydenhuollon asiantuntijat",
////"count": 530
////},
////{
////"koodi": "321",
////"kuvaus": "Terveydenhuollon tekniset asiantuntijat",
////"count": 73
////},
////{
////"koodi": "3211",
////"kuvaus": "L??ketieteellisen kuvantamis- ja laitetekniikan a.",
////"count": 15
////},
////{
////"koodi": "3212",
////"kuvaus": "Bioanalyytikot (terveydenhuolto)",
////"count": 29
////},
////{
////"koodi": "3213",
////"kuvaus": "Farmaseutit",
////"count": 28
////},
////{
////"koodi": "3214",
////"kuvaus": "Hammas- ja apuv?lineteknikot",
////"count": 1
////},
////{
////"koodi": "322",
////"kuvaus": "Sairaanhoitajat, k?til?t ym.",
////"count": 311
////},
////{
////"koodi": "3221",
////"kuvaus": "Sairaanhoitajat ym.",
////"count": 309
////},
////{
////"koodi": "3222",
////"kuvaus": "K?til?t",
////"count": 3
////},
////{
////"koodi": "323",
////"kuvaus": "Luontais- ja vaihtoehtohoitajat",
////"count": 3
////},
////{
////"koodi": "3230",
////"kuvaus": "Luontais- ja vaihtoehtohoitajat",
////"count": 3
////},
////{
////"koodi": "324",
////"kuvaus": "Seminologit ym.",
////"count": 0
////},
////{
////"koodi": "3240",
////"kuvaus": "Seminologit ym.",
////"count": 0
////},
////{
////"koodi": "325",
////"kuvaus": "Muut terveydenhuollon asiantuntijat",
////"count": 144
////},
////{
////"koodi": "3251",
////"kuvaus": "Suuhygienistit",
////"count": 21
////},
////{
////"koodi": "3254",
////"kuvaus": "Optikot",
////"count": 4
////},
////{
////"koodi": "3255",
////"kuvaus": "Fysioterapeutit ym.",
////"count": 66
////},
////{
////"koodi": "3257",
////"kuvaus": "Terveys- ja ty?suojelutarkastajat",
////"count": 4
////},
////{
////"koodi": "3258",
////"kuvaus": "Sairaankuljetuksen ensihoitajat",
////"count": 0
////},
////{
////"koodi": "3259",
////"kuvaus": "Muut luokittelemattomat terveydenhuollon a.",
////"count": 54
////},
////{
////"koodi": "33",
////"kuvaus": "Liike-el?m?n ja hallinnon asiantuntijat",
////"count": 1381
////},
////{
////"koodi": "331",
////"kuvaus": "Rahoitus-, vakuutus-  ja laskentatoimen a.",
////"count": 144
////},
////{
////"koodi": "3311",
////"kuvaus": "Arvopaperi- ja valuuttakauppiaat",
////"count": 0
////},
////{
////"koodi": "3312",
////"kuvaus": "Luotto- ja laina-asiantuntijat",
////"count": 1
////},
////{
////"koodi": "3313",
////"kuvaus": "Kirjanpidon ja laskentatoimen asiantuntijat",
////"count": 138
////},
////{
////"koodi": "3314",
////"kuvaus": "Tilastointi- ja matematiikka-asiantuntijat",
////"count": 4
////},
////{
////"koodi": "3315",
////"kuvaus": "Arvioitsijat ja vahinkotarkastajat",
////"count": 1
////},
////{
////"koodi": "332",
////"kuvaus": "Myynti- ja ostoagentit",
////"count": 929
////},
////{
////"koodi": "3321",
////"kuvaus": "Vakuutusalan palvelumyyj?t",
////"count": 9
////},
////{
////"koodi": "3322",
////"kuvaus": "Myyntiedustajat",
////"count": 871
////},
////{
////"koodi": "3323",
////"kuvaus": "Sis??nostajat",
////"count": 50
////},
////{
////"koodi": "3324",
////"kuvaus": "Kaupanv?litt?j?t",
////"count": 3
////},
////{
////"koodi": "333",
////"kuvaus": "Yrityspalveluiden v?litt?j?t",
////"count": 157
////},
////{
////"koodi": "3331",
////"kuvaus": "Huolitsijat, tulli- ja laivanselvitt?j?t",
////"count": 5
////},
////{
////"koodi": "3332",
////"kuvaus": "Konferenssi- ja tapahtumaj?rjest?j?t",
////"count": 0
////},
////{
////"koodi": "3333",
////"kuvaus": "Ty?nv?litt?j?t",
////"count": 27
////},
////{
////"koodi": "3334",
////"kuvaus": "Kiinteist?nv?litt?j?t ja is?nn?itsij?t",
////"count": 98
////},
////{
////"koodi": "3339",
////"kuvaus": "Muut liike-el?m?n asiantuntijat",
////"count": 27
////},
////{
////"koodi": "334",
////"kuvaus": "Hallinnolliset ja erikoistuneet sihteerit",
////"count": 107
////},
////{
////"koodi": "3341",
////"kuvaus": "Toimistoty?n esimiehet",
////"count": 22
////},
////{
////"koodi": "3342",
////"kuvaus": "Asianajosihteerit",
////"count": 5
////},
////{
////"koodi": "3343",
////"kuvaus": "Johdon sihteerit ja osastosihteerit",
////"count": 67
////},
////{
////"koodi": "3344",
////"kuvaus": "Toimistosihteerit (terveydenhuolto)",
////"count": 13
////},
////{
////"koodi": "335",
////"kuvaus": "Julkishallinnon valmistelu- ja valvontavirkamiehet",
////"count": 54
////},
////{
////"koodi": "3351",
////"kuvaus": "Tulli- ja rajavirkamiehet",
////"count": 0
////},
////{
////"koodi": "3352",
////"kuvaus": "Verovalmistelijat ja -tarkastajat",
////"count": 0
////},
////{
////"koodi": "3353",
////"kuvaus": "Sosiaaliturvaetuuksien k?sittelij?t",
////"count": 13
////},
////{
////"koodi": "3354",
////"kuvaus": "Lupavirkamiehet",
////"count": 0
////},
////{
////"koodi": "3355",
////"kuvaus": "Komisariot ja ylikonstaapelit",
////"count": 6
////},
////{
////"koodi": "3359",
////"kuvaus": "Muut julkishallinnon valmistelu- ja valvontavmt",
////"count": 35
////},
////{
////"koodi": "34",
////"kuvaus": "Lakiavustajat ja sosiaali- ja kulttuurialan a.",
////"count": 483
////},
////{
////"koodi": "341",
////"kuvaus": "Lainopilliset a. ja sosiaalialan, seurakunnan tt",
////"count": 310
////},
////{
////"koodi": "3411",
////"kuvaus": "Lainopilliset avustajat ja j?rjest?alan asiantunti",
////"count": 24
////},
////{
////"koodi": "3412",
////"kuvaus": "Sosiaalialan ohjaajat ja neuvojat ym.",
////"count": 270
////},
////{
////"koodi": "3413",
////"kuvaus": "Seurakuntaty?ntekij?t",
////"count": 17
////},
////{
////"koodi": "342",
////"kuvaus": "Urheilijat, urheiluvalmentajat, liikunnanohjaajat",
////"count": 130
////},
////{
////"koodi": "3421",
////"kuvaus": "Urheilijat",
////"count": 0
////},
////{
////"koodi": "3422",
////"kuvaus": "Urheiluvalmentajat ja toimitsijat",
////"count": 19
////},
////{
////"koodi": "3423",
////"kuvaus": "Liikunnan ja vapaa-ajan ohjaajat",
////"count": 116
////},
////{
////"koodi": "343",
////"kuvaus": "Taide- ja kulttuurialan a. sek? keitti?p??llik?t",
////"count": 45
////},
////{
////"koodi": "3431",
////"kuvaus": "Valokuvaajat",
////"count": 1
////},
////{
////"koodi": "3432",
////"kuvaus": "Sisustussuunnittelijat ym.",
////"count": 3
////},
////{
////"koodi": "3433",
////"kuvaus": "Gallerioiden, museoiden, kirjastojen tekniset tt",
////"count": 0
////},
////{
////"koodi": "3434",
////"kuvaus": "Keitti?p??llik?t",
////"count": 36
////},
////{
////"koodi": "3435",
////"kuvaus": "Muut taide- ja kulttuurialan asiantuntijat",
////"count": 5
////},
////{
////"koodi": "35",
////"kuvaus": "Informaatio- ja tietoliikenneteknologian a.",
////"count": 62
////},
////{
////"koodi": "351",
////"kuvaus": "ICT-alan teknikot ja k?ytt?j?tukihenkil?t",
////"count": 58
////},
////{
////"koodi": "3511",
////"kuvaus": "K?yt?n operaattorit",
////"count": 11
////},
////{
////"koodi": "3512",
////"kuvaus": "K?yt?n tukihenkil?t",
////"count": 38
////},
////{
////"koodi": "3513",
////"kuvaus": "Tietoverkkoteknikot",
////"count": 7
////},
////{
////"koodi": "3514",
////"kuvaus": "Webmasterit ja -teknikot",
////"count": 2
////},
////{
////"koodi": "352",
////"kuvaus": "Teleliikenne- sek? radio- ja tv-teknikot",
////"count": 6
////},
////{
////"koodi": "3521",
////"kuvaus": "L?hetys- ja audiovisuaaliteknikot",
////"count": 5
////},
////{
////"koodi": "3522",
////"kuvaus": "Televiestinn?n tekniset asiantuntijat",
////"count": 1
////},
////{
////"koodi": "4",
////"kuvaus": "Toimisto- ja asiakaspalveluty?ntekij?t",
////"count": 640
////},
////{
////"koodi": "41",
////"kuvaus": "Toimistoty?ntekij?t",
////"count": 202
////},
////{
////"koodi": "411",
////"kuvaus": "Toimistoavustajat",
////"count": 13
////},
////{
////"koodi": "4110",
////"kuvaus": "Toimistoavustajat",
////"count": 13
////},
////{
////"koodi": "412",
////"kuvaus": "Yleissihteerit",
////"count": 186
////},
////{
////"koodi": "4120",
////"kuvaus": "Yleissihteerit",
////"count": 186
////},
////{
////"koodi": "413",
////"kuvaus": "Tekstink?sittelij?t ja tallentajat",
////"count": 4
////},
////{
////"koodi": "4131",
////"kuvaus": "Tekstink?sittelij?t",
////"count": 2
////},
////{
////"koodi": "4132",
////"kuvaus": "Tallentajat",
////"count": 2
////},
////{
////"koodi": "42",
////"kuvaus": "Asiakaspalveluty?ntekij?t",
////"count": 233
////},
////{
////"koodi": "421",
////"kuvaus": "Rahaliikenteen asiakaspalveluty?ntekij?t",
////"count": 29
////},
////{
////"koodi": "4211",
////"kuvaus": "Pankki- ym. toimihenkil?t",
////"count": 17
////},
////{
////"koodi": "4212",
////"kuvaus": "Vedonv?litt?j?t, bingo- ja kasinopelin hoitajat",
////"count": 11
////},
////{
////"koodi": "4213",
////"kuvaus": "Panttilainaajat",
////"count": 0
////},
////{
////"koodi": "4214",
////"kuvaus": "Maksujenperij?t",
////"count": 1
////},
////{
////"koodi": "422",
////"kuvaus": "Muut asiakaspalveluty?ntekij?t",
////"count": 205
////},
////{
////"koodi": "4221",
////"kuvaus": "Matkatoimistovirkailijat",
////"count": 3
////},
////{
////"koodi": "4222",
////"kuvaus": "Puhelinpalveluneuvojat",
////"count": 98
////},
////{
////"koodi": "4223",
////"kuvaus": "Puhelinvaihteenhoitajat",
////"count": 4
////},
////{
////"koodi": "4224",
////"kuvaus": "Hotellin vastaanottovirkailijat",
////"count": 32
////},
////{
////"koodi": "4225",
////"kuvaus": "Informaatiopisteen asiakasneuvojat",
////"count": 17
////},
////{
////"koodi": "4226",
////"kuvaus": "Vastaanoton ja neuvonnan hoitajat",
////"count": 28
////},
////{
////"koodi": "4227",
////"kuvaus": "Tutkimus- ja markkinatutkimushaastattelijat",
////"count": 24
////},
////{
////"koodi": "4229",
////"kuvaus": "Muut luokittelemattomat asiakaspalveluty?ntekij?t",
////"count": 0
////},
////{
////"koodi": "43",
////"kuvaus": "Laskennan ja varastoinnin toimistoty?ntekij?t",
////"count": 119
////},
////{
////"koodi": "431",
////"kuvaus": "Palkanlaskijat, vakuutusk?sittelij?t ym.",
////"count": 82
////},
////{
////"koodi": "4311",
////"kuvaus": "Taloushallinnon toimistoty?ntekij?t",
////"count": 50
////},
////{
////"koodi": "4312",
////"kuvaus": "Tilasto-, rahoitus- ja vakuutusalan toimistott",
////"count": 4
////},
////{
////"koodi": "4313",
////"kuvaus": "Palkanlaskijat",
////"count": 29
////},
////{
////"koodi": "432",
////"kuvaus": "Kuljetuksen ja varastoinnin toimistoty?ntekij?t",
////"count": 37
////},
////{
////"koodi": "4321",
////"kuvaus": "Varastonhoitajat ym.",
////"count": 20
////},
////{
////"koodi": "4322",
////"kuvaus": "Tuotannon valmistelijat",
////"count": 8
////},
////{
////"koodi": "4323",
////"kuvaus": "Kuljetuksen toimistoty?ntekij?t",
////"count": 12
////},
////{
////"koodi": "44",
////"kuvaus": "Muut toimisto- ja asiakaspalveluty?ntekij?t",
////"count": 91
////},
////{
////"koodi": "441",
////"kuvaus": "Muut toimisto- ja asiakaspalveluty?ntekij?t",
////"count": 91
////},
////{
////"koodi": "4411",
////"kuvaus": "Kirjastoty?ntekij?t",
////"count": 2
////},
////{
////"koodi": "4412",
////"kuvaus": "Postinkantajat ja -lajittelijat",
////"count": 57
////},
////{
////"koodi": "4413",
////"kuvaus": "Koodaajat, oikolukijat ym.",
////"count": 0
////},
////{
////"koodi": "4415",
////"kuvaus": "Arkistoty?ntekij?t",
////"count": 2
////},
////{
////"koodi": "4416",
////"kuvaus": "Henkil?st?hallinnon avustavat toimistoty?ntekij?t",
////"count": 23
////},
////{
////"koodi": "4419",
////"kuvaus": "Muut luokitt. toimisto- ja asiakaspalvelutt",
////"count": 7
////},
////{
////"koodi": "5",
////"kuvaus": "Palvelu- ja myyntity?ntekij?t",
////"count": 4577
////},
////{
////"koodi": "51",
////"kuvaus": "Palveluty?ntekij?t",
////"count": 1640
////},
////{
////"koodi": "511",
////"kuvaus": "Matkustuspalveluty?ntekij?t, kondukt??rit, oppaat",
////"count": 21
////},
////{
////"koodi": "5111",
////"kuvaus": "Lentoem?nn?t, purserit ym.",
////"count": 1
////},
////{
////"koodi": "5112",
////"kuvaus": "Kondukt??rit, lipuntarkastajat ym.",
////"count": 0
////},
////{
////"koodi": "5113",
////"kuvaus": "Matkaoppaat",
////"count": 20
////},
////{
////"koodi": "512",
////"kuvaus": "Ravintola- ja suurtalousty?ntekij?t",
////"count": 579
////},
////{
////"koodi": "5120",
////"kuvaus": "Ravintola- ja suurtalousty?ntekij?t",
////"count": 579
////},
////{
////"koodi": "513",
////"kuvaus": "Tarjoiluty?ntekij?t",
////"count": 376
////},
////{
////"koodi": "5131",
////"kuvaus": "Tarjoilijat",
////"count": 352
////},
////{
////"koodi": "5132",
////"kuvaus": "Baarimestarit",
////"count": 27
////},
////{
////"koodi": "514",
////"kuvaus": "Kampaajat, parturit, kosmetologit ym.",
////"count": 363
////},
////{
////"koodi": "5141",
////"kuvaus": "Kampaajat ja parturit",
////"count": 254
////},
////{
////"koodi": "5142",
////"kuvaus": "Kosmetologit ym.",
////"count": 122
////},
////{
////"koodi": "515",
////"kuvaus": "Kiinteist?huollon ja siivousty?n esimiehet",
////"count": 281
////},
////{
////"koodi": "5151",
////"kuvaus": "Siivousty?n esimiehet toimistot, hotellit jne.",
////"count": 48
////},
////{
////"koodi": "5152",
////"kuvaus": "Yksityiskotien taloudenhoitajat",
////"count": 0
////},
////{
////"koodi": "5153",
////"kuvaus": "Kiinteist?huollon ty?ntekij?t",
////"count": 235
////},
////{
////"koodi": "516",
////"kuvaus": "Muut henkil?kohtaisen palvelun ty?ntekij?t",
////"count": 29
////},
////{
////"koodi": "5161",
////"kuvaus": "Astrologit, ennustajat ym.",
////"count": 0
////},
////{
////"koodi": "5163",
////"kuvaus": "Hautauspalveluty?ntekij?t",
////"count": 0
////},
////{
////"koodi": "5164",
////"kuvaus": "El?intenhoitajat ja lemmikkiel?inten trimmaajat",
////"count": 17
////},
////{
////"koodi": "5165",
////"kuvaus": "Ajo-opettajat",
////"count": 12
////},
////{
////"koodi": "5169",
////"kuvaus": "Muut luokitt. henkil?kohtaisen palvelun tt",
////"count": 0
////},
////{
////"koodi": "52",
////"kuvaus": "Myyj?t, kauppiaat ym.",
////"count": 1549
////},
////{
////"koodi": "521",
////"kuvaus": "Katu- ja torikauppiaat",
////"count": 43
////},
////{
////"koodi": "5211",
////"kuvaus": "Kioski- ja torimyyj?t",
////"count": 43
////},
////{
////"koodi": "5212",
////"kuvaus": "Katumyyj?t (elintarvikkeet)",
////"count": 0
////},
////{
////"koodi": "522",
////"kuvaus": "Myyj?t ja kauppiaat",
////"count": 959
////},
////{
////"koodi": "5221",
////"kuvaus": "Kauppiaat (pienyritt?j?t)",
////"count": 104
////},
////{
////"koodi": "5222",
////"kuvaus": "Myym?l?esimiehet",
////"count": 49
////},
////{
////"koodi": "5223",
////"kuvaus": "Myyj?t",
////"count": 812
////},
////{
////"koodi": "523",
////"kuvaus": "Kassanhoitajat ja lipunmyyj?t",
////"count": 69
////},
////{
////"koodi": "5230",
////"kuvaus": "Kassanhoitajat ja lipunmyyj?t",
////"count": 69
////},
////{
////"koodi": "524",
////"kuvaus": "Muut myyntity?ntekij?t",
////"count": 503
////},
////{
////"koodi": "5241",
////"kuvaus": "Mallit",
////"count": 2
////},
////{
////"koodi": "5242",
////"kuvaus": "Tuote-esittelij?t",
////"count": 41
////},
////{
////"koodi": "5243",
////"kuvaus": "Suoramyyj?t",
////"count": 54
////},
////{
////"koodi": "5244",
////"kuvaus": "Puhelin- ja asiakaspalvelukeskusten myyj?t",
////"count": 173
////},
////{
////"koodi": "5245",
////"kuvaus": "Huoltamoty?ntekij?t",
////"count": 27
////},
////{
////"koodi": "5246",
////"kuvaus": "Kahvila- ja baarimyyj?t",
////"count": 96
////},
////{
////"koodi": "5249",
////"kuvaus": "Muut muualla luokittelemattomat myyntity?ntekij?t",
////"count": 135
////},
////{
////"koodi": "53",
////"kuvaus": "Hoivapalvelun ja terveydenhuollon ty?ntekij?t",
////"count": 1293
////},
////{
////"koodi": "531",
////"kuvaus": "Lastenhoitajat ja koulunk?yntiavustajat",
////"count": 286
////},
////{
////"koodi": "5311",
////"kuvaus": "Lastenhoitoty?ntekij?t",
////"count": 253
////},
////{
////"koodi": "5312",
////"kuvaus": "Koulunk?yntiavustajat",
////"count": 34
////},
////{
////"koodi": "532",
////"kuvaus": "L?hihoitajat, terveydenhuollon tt ja kodinhjat",
////"count": 1011
////},
////{
////"koodi": "5321",
////"kuvaus": "L?hihoitajat",
////"count": 403
////},
////{
////"koodi": "5322",
////"kuvaus": "Kodinhoitajat (kotipalvelutoiminta)",
////"count": 479
////},
////{
////"koodi": "5329",
////"kuvaus": "Muut terveydenhuoltoalan ty?ntekij?t",
////"count": 134
////},
////{
////"koodi": "54",
////"kuvaus": "Suojelu- ja vartiointity?ntekij?t",
////"count": 122
////},
////{
////"koodi": "541",
////"kuvaus": "Suojelu- ja vartiointity?ntekij?t",
////"count": 122
////},
////{
////"koodi": "5411",
////"kuvaus": "Palomiehet",
////"count": 16
////},
////{
////"koodi": "5412",
////"kuvaus": "Poliisit",
////"count": 3
////},
////{
////"koodi": "5413",
////"kuvaus": "Vanginvartijat",
////"count": 0
////},
////{
////"koodi": "5414",
////"kuvaus": "Vartijat",
////"count": 85
////},
////{
////"koodi": "5419",
////"kuvaus": "Muut suojelu- ja vartiointity?ntekij?t",
////"count": 18
////},
////{
////"koodi": "6",
////"kuvaus": "Maanviljelij?t, mets?ty?ntekij?t ym.",
////"count": 67
////},
////{
////"koodi": "61",
////"kuvaus": "Maanviljelij?t ja el?intenkasvattajat ym.",
////"count": 53
////},
////{
////"koodi": "611",
////"kuvaus": "Pelto- ja puutarhaviljelij?t",
////"count": 15
////},
////{
////"koodi": "6111",
////"kuvaus": "Pelto- ja avomaaviljelij?t",
////"count": 0
////},
////{
////"koodi": "6112",
////"kuvaus": "Hedelm?puiden ja pensaiden yms. kasvattajat",
////"count": 0
////},
////{
////"koodi": "6113",
////"kuvaus": "Puutarhurit, kasvihuoneviljelij?t ja -ty?ntekij?t",
////"count": 15
////},
////{
////"koodi": "6114",
////"kuvaus": "Yhd. maan- ja vihannesvilj., puutarhanhoidon harj.",
////"count": 0
////},
////{
////"koodi": "612",
////"kuvaus": "El?intenkasvattajat",
////"count": 24
////},
////{
////"koodi": "6121",
////"kuvaus": "Liha- ja lypsykarjan, kotiel?inten kasvattajat",
////"count": 21
////},
////{
////"koodi": "6122",
////"kuvaus": "Siipikarjankasvattajat",
////"count": 0
////},
////{
////"koodi": "6123",
////"kuvaus": "Mehil?istenhoitajat ym.",
////"count": 0
////},
////{
////"koodi": "6129",
////"kuvaus": "Muut el?inten kasvattajat ja hoitajat",
////"count": 3
////},
////{
////"koodi": "613",
////"kuvaus": "Yhd. maanviljelyn ja el?intenkasv. harjoittajat",
////"count": 15
////},
////{
////"koodi": "6130",
////"kuvaus": "Yhd. maanviljelyn ja el?intenkasv. harjoittajat",
////"count": 15
////},
////{
////"koodi": "62",
////"kuvaus": "Mets?- ja kalatalouden ty?ntekij?t",
////"count": 14
////},
////{
////"koodi": "621",
////"kuvaus": "Metsurit ja mets?ty?ntekij?t",
////"count": 14
////},
////{
////"koodi": "6210",
////"kuvaus": "Metsurit ja mets?ty?ntekij?t",
////"count": 14
////},
////{
////"koodi": "622",
////"kuvaus": "Kalanviljelij?t, kalastajat ja mets?st?j?t",
////"count": 0
////},
////{
////"koodi": "6221",
////"kuvaus": "Kalanviljelij?t ja -viljelyty?ntekij?t",
////"count": 0
////},
////{
////"koodi": "6222",
////"kuvaus": "Kalastajat",
////"count": 0
////},
////{
////"koodi": "6224",
////"kuvaus": "Riistanhoitajat ja mets?st?j?t",
////"count": 0
////},
////{
////"koodi": "7",
////"kuvaus": "Rakennus-, korjaus- ja valmistusty?ntekij?t",
////"count": 2598
////},
////{
////"koodi": "71",
////"kuvaus": "Rakennusty?ntekij?t ym. (pl. s?hk?asentajat)",
////"count": 1223
////},
////{
////"koodi": "711",
////"kuvaus": "Rakennusty?ntekij?t ym.",
////"count": 715
////},
////{
////"koodi": "7111",
////"kuvaus": "Talonrakentajat",
////"count": 278
////},
////{
////"koodi": "7112",
////"kuvaus": "Muurarit ym.",
////"count": 18
////},
////{
////"koodi": "7113",
////"kuvaus": "Kivenhakkaajat ja -leikkaajat ym.",
////"count": 5
////},
////{
////"koodi": "7114",
////"kuvaus": "Betonirakentajat ja raudoittajat",
////"count": 83
////},
////{
////"koodi": "7115",
////"kuvaus": "Kirvesmiehet ja rakennuspuusep?t",
////"count": 258
////},
////{
////"koodi": "7119",
////"kuvaus": "Muut rakennusty?ntekij?t",
////"count": 96
////},
////{
////"koodi": "712",
////"kuvaus": "Rakennusten viimeistelyty?ntekij?t",
////"count": 433
////},
////{
////"koodi": "7121",
////"kuvaus": "Kattoasentajat ja -korjaajat",
////"count": 65
////},
////{
////"koodi": "7122",
////"kuvaus": "Lattianp??llystysty?ntekij?t",
////"count": 58
////},
////{
////"koodi": "7123",
////"kuvaus": "Rappaajat",
////"count": 14
////},
////{
////"koodi": "7124",
////"kuvaus": "Erist?j?t",
////"count": 28
////},
////{
////"koodi": "7125",
////"kuvaus": "Lasinasentajat",
////"count": 10
////},
////{
////"koodi": "7126",
////"kuvaus": "Putkiasentajat",
////"count": 198
////},
////{
////"koodi": "7127",
////"kuvaus": "Ilmastointi- ja j??hdytyslaiteasentajat",
////"count": 65
////},
////{
////"koodi": "713",
////"kuvaus": "Maalarit ja rakennuspuhdistajat",
////"count": 86
////},
////{
////"koodi": "7131",
////"kuvaus": "Rakennusmaalarit ym.",
////"count": 28
////},
////{
////"koodi": "7132",
////"kuvaus": "Ruiskumaalaajat ja -lakkaajat",
////"count": 51
////},
////{
////"koodi": "7133",
////"kuvaus": "Rakennuspuhdistajat ja nuohoojat",
////"count": 8
////},
////{
////"koodi": "72",
////"kuvaus": "Konepaja- ja valimoty?ntt, asentajat ja korjaajat",
////"count": 927
////},
////{
////"koodi": "721",
////"kuvaus": "Valimoty?ntekij?t, hitsaajat, levysep?t ym.",
////"count": 294
////},
////{
////"koodi": "7211",
////"kuvaus": "Muotin- ja keernantekij?t",
////"count": 7
////},
////{
////"koodi": "7212",
////"kuvaus": "Hitsaajat ja kaasuleikkaajat",
////"count": 212
////},
////{
////"koodi": "7213",
////"kuvaus": "Ohutlevysep?t",
////"count": 79
////},
////{
////"koodi": "7214",
////"kuvaus": "Paksulevysep?t ja rautarakennety?ntekij?t",
////"count": 3
////},
////{
////"koodi": "7215",
////"kuvaus": "Kaapelin- ja k?ysienasentajat",
////"count": 1
////},
////{
////"koodi": "722",
////"kuvaus": "Sep?t, ty?kaluntekij?t ja koneenasettajat",
////"count": 254
////},
////{
////"koodi": "7221",
////"kuvaus": "Sep?t",
////"count": 1
////},
////{
////"koodi": "7222",
////"kuvaus": "Ty?kaluntekij?t ja lukkosep?t",
////"count": 20
////},
////{
////"koodi": "7223",
////"kuvaus": "Koneenasettajat ja koneistajat",
////"count": 169
////},
////{
////"koodi": "7224",
////"kuvaus": "Konehiojat, kiillottajat ja teroittajat",
////"count": 67
////},
////{
////"koodi": "723",
////"kuvaus": "Koneasentajat ja -korjaajat",
////"count": 390
////},
////{
////"koodi": "7231",
////"kuvaus": "Moottoriajoneuvojen asentajat ja korjaajat",
////"count": 255
////},
////{
////"koodi": "7232",
////"kuvaus": "Lentokoneasentajat ja -korjaajat",
////"count": 1
////},
////{
////"koodi": "7233",
////"kuvaus": "Maatalous-, teollisuuskoneasentajat ja -korjaajat",
////"count": 141
////},
////{
////"koodi": "7234",
////"kuvaus": "Polkupy?r?nkorjaajat ym.",
////"count": 0
////},
////{
////"koodi": "73",
////"kuvaus": "K?sity?tuotevalmistajat, hienomek., painoalan tt",
////"count": 19
////},
////{
////"koodi": "731",
////"kuvaus": "K?sity?tuotteiden valmistajat ja hienomekaanikot",
////"count": 11
////},
////{
////"koodi": "7311",
////"kuvaus": "Kellosep?t, hienomek.laitteiden tekij?t, korjaajat",
////"count": 8
////},
////{
////"koodi": "7312",
////"kuvaus": "Soittimien tekij?t ja viritt?j?t",
////"count": 0
////},
////{
////"koodi": "7313",
////"kuvaus": "Koru-, kulta- ja hopeasep?t",
////"count": 1
////},
////{
////"koodi": "7314",
////"kuvaus": "Saven- ja tiilenvalajat ja dreijaajat",
////"count": 0
////},
////{
////"koodi": "7315",
////"kuvaus": "Lasinpuhaltajat, -leikkaajat, -hiojat ja -viim.",
////"count": 2
////},
////{
////"koodi": "7316",
////"kuvaus": "Kaivertajat, etsaajat ja koristemaalarit",
////"count": 0
////},
////{
////"koodi": "7317",
////"kuvaus": "Puu-, kori-  yms. k?sity?tuotteiden tekij?t",
////"count": 0
////},
////{
////"koodi": "7318",
////"kuvaus": "Tekstiili-, nahka- yms. k?sity?tuotteiden tekij?t",
////"count": 0
////},
////{
////"koodi": "7319",
////"kuvaus": "Muut k?sity?ntekij?t",
////"count": 1
////},
////{
////"koodi": "732",
////"kuvaus": "Painoalan ty?ntekij?t",
////"count": 8
////},
////{
////"koodi": "7321",
////"kuvaus": "Painopinnanvalmistajat",
////"count": 1
////},
////{
////"koodi": "7322",
////"kuvaus": "Painajat",
////"count": 7
////},
////{
////"koodi": "7323",
////"kuvaus": "J?lkik?sittelij?t ja sitomoty?ntekij?t",
////"count": 1
////},
////{
////"koodi": "74",
////"kuvaus": "S?hk?- ja elektroniikka-alan ty?ntekij?t",
////"count": 355
////},
////{
////"koodi": "741",
////"kuvaus": "S?hk?laitteiden asentajat ja korjaajat",
////"count": 290
////},
////{
////"koodi": "7411",
////"kuvaus": "Rakennuss?hk?asentajat",
////"count": 202
////},
////{
////"koodi": "7412",
////"kuvaus": "Muut s?hk?asentajat",
////"count": 86
////},
////{
////"koodi": "7413",
////"kuvaus": "Linja-asentajat ja -korjaajat",
////"count": 8
////},
////{
////"koodi": "742",
////"kuvaus": "Elektroniikka- ja tietoliikenneasentajat ja -korj.",
////"count": 68
////},
////{
////"koodi": "7421",
////"kuvaus": "Elektr.- ja autom.laitteiden asentajat, korjaajat",
////"count": 47
////},
////{
////"koodi": "7422",
////"kuvaus": "Tieto- ja viestint?teknologian asentajat,korjaajat",
////"count": 21
////},
////{
////"koodi": "75",
////"kuvaus": "Elintarv.-,puuty?- ,vaatetus-, jalkinealan valm.tt",
////"count": 99
////},
////{
////"koodi": "751",
////"kuvaus": "Lihanleikkaajat, leipurit, meijeristit ym.",
////"count": 40
////},
////{
////"koodi": "7511",
////"kuvaus": "Lihanleikkaajat, kalank?sittelij?t ym.",
////"count": 10
////},
////{
////"koodi": "7512",
////"kuvaus": "Leipurit ja kondiittorit",
////"count": 27
////},
////{
////"koodi": "7513",
////"kuvaus": "Meijeristit, juustomestarit ym.",
////"count": 0
////},
////{
////"koodi": "7514",
////"kuvaus": "Hedelm?- ja vihannestuotteiden valmistajat",
////"count": 2
////},
////{
////"koodi": "7515",
////"kuvaus": "Ruokien ja juomien laaduntarkkailijat",
////"count": 1
////},
////{
////"koodi": "7516",
////"kuvaus": "Tupakkatuotteiden valmistajat",
////"count": 0
////},
////{
////"koodi": "752",
////"kuvaus": "Puutavaran k?sittelij?t, puusep?t ym.",
////"count": 28
////},
////{
////"koodi": "7521",
////"kuvaus": "Raakapuun k?sittelij?t",
////"count": 1
////},
////{
////"koodi": "7522",
////"kuvaus": "Huonekalupuusep?t ym.",
////"count": 15
////},
////{
////"koodi": "7523",
////"kuvaus": "Konepuusep?t",
////"count": 15
////},
////{
////"koodi": "753",
////"kuvaus": "Vaatetusalan ty?ntekij?t ym.",
////"count": 20
////},
////{
////"koodi": "7531",
////"kuvaus": "Vaatturit, pukuompelijat, turkkurit, hatuntekij?t",
////"count": 10
////},
////{
////"koodi": "7532",
////"kuvaus": "Leikkaajat ja mallimestarit",
////"count": 2
////},
////{
////"koodi": "7533",
////"kuvaus": "Koru- ja muut tekstiiliompelijat",
////"count": 0
////},
////{
////"koodi": "7534",
////"kuvaus": "Verhoilijat",
////"count": 4
////},
////{
////"koodi": "7535",
////"kuvaus": "Turkisten muokkaajat ja nahkurit",
////"count": 1
////},
////{
////"koodi": "7536",
////"kuvaus": "Suutarit ym.",
////"count": 3
////},
////{
////"koodi": "754",
////"kuvaus": "Muut p??luokkaan 7 luokiteltavat ty?ntekij?t",
////"count": 13
////},
////{
////"koodi": "7541",
////"kuvaus": "Vedenalaisty?ntekij?t",
////"count": 0
////},
////{
////"koodi": "7542",
////"kuvaus": "Panostajat ja r?j?ytt?j?t",
////"count": 3
////},
////{
////"koodi": "7543",
////"kuvaus": "Luokittelijat,laaduntarkkailijat, pl. ruoat,juomat",
////"count": 1
////},
////{
////"koodi": "7544",
////"kuvaus": "Savupuhdistajat, tuholais- ja rikkakasvintorjujat",
////"count": 1
////},
////{
////"koodi": "7549",
////"kuvaus": "Muut l. 7 muualla luokittelemattomat tt",
////"count": 8
////},
////{
////"koodi": "8",
////"kuvaus": "Prosessi- ja kuljetusty?ntekij?t",
////"count": 1110
////},
////{
////"koodi": "81",
////"kuvaus": "Prosessity?ntekij?t",
////"count": 235
////},
////{
////"koodi": "811",
////"kuvaus": "Kaivos- ja louhintaty?n koneenk?ytt?j?t",
////"count": 43
////},
////{
////"koodi": "8111",
////"kuvaus": "Kaivos- ja louhosty?ntekij?t",
////"count": 2
////},
////{
////"koodi": "8112",
////"kuvaus": "Rikastusty?ntekij?t",
////"count": 1
////},
////{
////"koodi": "8113",
////"kuvaus": "Iskuporaajat ja syv?kairaajat",
////"count": 9
////},
////{
////"koodi": "8114",
////"kuvaus": "Betonituote- ym. teollisuuden prosessity?ntekij?t",
////"count": 31
////},
////{
////"koodi": "812",
////"kuvaus": "Metalliteollisuuden prosessitt ja viimeistelij?t",
////"count": 16
////},
////{
////"koodi": "8121",
////"kuvaus": "Metalliteollisuuden prosessity?ntekij?t",
////"count": 10
////},
////{
////"koodi": "8122",
////"kuvaus": "Metallien teolliset p??llyst?j?t ja viimeistelij?t",
////"count": 6
////},
////{
////"koodi": "813",
////"kuvaus": "Kemianteoll., valokuvatuotteiden valm. prosessitt",
////"count": 13
////},
////{
////"koodi": "8131",
////"kuvaus": "Kemianteollisuuden prosessity?ntekij?t ym.",
////"count": 13
////},
////{
////"koodi": "8132",
////"kuvaus": "Valokuvatuotteiden valmist. prosessity?ntekij?t",
////"count": 0
////},
////{
////"koodi": "814",
////"kuvaus": "Kumi-, muovi- ja paperituotteiden valm. prosessitt",
////"count": 32
////},
////{
////"koodi": "8141",
////"kuvaus": "Kumituoteteollisuuden prosessity?ntekij?t",
////"count": 3
////},
////{
////"koodi": "8142",
////"kuvaus": "Muovituoteteollisuuden prosessity?ntekij?t",
////"count": 28
////},
////{
////"koodi": "8143",
////"kuvaus": "Paperituoteteollisuuden prosessity?ntekij?t",
////"count": 1
////},
////{
////"koodi": "815",
////"kuvaus": "Tekstiili-, turkis- ja nahkatuoteteoll. prosessitt",
////"count": 34
////},
////{
////"koodi": "8151",
////"kuvaus": "Kuitujenk?sitt.-, kehruu-,puolauskoneiden hoitajat",
////"count": 0
////},
////{
////"koodi": "8152",
////"kuvaus": "Kutoma- ja neulekoneiden hoitajat",
////"count": 1
////},
////{
////"koodi": "8153",
////"kuvaus": "Teollisuusompelijat",
////"count": 8
////},
////{
////"koodi": "8154",
////"kuvaus": "Valkaisu-, v?rj?ys- ja puhdistuskoneiden hoitajat",
////"count": 1
////},
////{
////"koodi": "8155",
////"kuvaus": "Turkisten ja nahkojen teolliset k?sitt., v?rj??j?t",
////"count": 0
////},
////{
////"koodi": "8156",
////"kuvaus": "Jalkine- ja laukkuteollisuuden prosessity?ntekij?t",
////"count": 1
////},
////{
////"koodi": "8157",
////"kuvaus": "Pesulaty?ntekij?t",
////"count": 21
////},
////{
////"koodi": "8159",
////"kuvaus": "Muut tekstiili-,turkis-,nahkatuoteteoll.prosessitt",
////"count": 2
////},
////{
////"koodi": "816",
////"kuvaus": "Elintarviketeollisuuden prosessity?ntekij?t",
////"count": 59
////},
////{
////"koodi": "8160",
////"kuvaus": "Elintarviketeollisuuden prosessity?ntekij?t",
////"count": 59
////},
////{
////"koodi": "817",
////"kuvaus": "Sahatavaran, paperin, kartongin valm. prosessitt",
////"count": 30
////},
////{
////"koodi": "8171",
////"kuvaus": "Paperimassan, paperin, kartongin valm. prosessitt",
////"count": 1
////},
////{
////"koodi": "8172",
////"kuvaus": "Puu- ja sahatavaran prosessity?ntekij?t",
////"count": 29
////},
////{
////"koodi": "818",
////"kuvaus": "Muut prosessity?ntekij?t",
////"count": 12
////},
////{
////"koodi": "8181",
////"kuvaus": "Lasi- ja keramiikkateollisuuden uunienhoitajat",
////"count": 0
////},
////{
////"koodi": "8182",
////"kuvaus": "H?yrykon.,l?mmityskattiloiden hoitajat,l?mmitt?j?t",
////"count": 0
////},
////{
////"koodi": "8183",
////"kuvaus": "Pakkaus-, pullotus- ja etik?intikoneiden hoitajat",
////"count": 0
////},
////{
////"koodi": "8189",
////"kuvaus": "Muut muualla luokittelemattomat prosessitt",
////"count": 12
////},
////{
////"koodi": "82",
////"kuvaus": "Teollisuustuotteiden kokoonpanijat",
////"count": 206
////},
////{
////"koodi": "821",
////"kuvaus": "Teollisuustuotteiden kokoonpanijat",
////"count": 206
////},
////{
////"koodi": "8211",
////"kuvaus": "Konepaja- ja metallituotteiden kokoonpanijat",
////"count": 145
////},
////{
////"koodi": "8212",
////"kuvaus": "S?hk?- ja elektroniikkalaitteiden kokoonpanijat",
////"count": 43
////},
////{
////"koodi": "8219",
////"kuvaus": "Muut teollisuustuotteiden kokoonpanijat",
////"count": 19
////},
////{
////"koodi": "83",
////"kuvaus": "Kuljetusty?ntekij?t",
////"count": 673
////},
////{
////"koodi": "831",
////"kuvaus": "Raideliikenteen kuljettajat ja ty?ntekij?t",
////"count": 0
////},
////{
////"koodi": "8311",
////"kuvaus": "Veturinkuljettajat",
////"count": 0
////},
////{
////"koodi": "8312",
////"kuvaus": "Jarru-, turvalaite- ja vaihdety?ntekij?t",
////"count": 0
////},
////{
////"koodi": "832",
////"kuvaus": "Henkil?- ja pakettiauton- sek? moottoripy?r?nkulj.",
////"count": 154
////},
////{
////"koodi": "8321",
////"kuvaus": "Moottoripy?r?l?hetit yms.",
////"count": 5
////},
////{
////"koodi": "8322",
////"kuvaus": "Henkil?-, taksi- ja pakettiautonkuljettajat",
////"count": 149
////},
////{
////"koodi": "833",
////"kuvaus": "Raskaiden moottoriajoneuvojen kuljettajat",
////"count": 335
////},
////{
////"koodi": "8331",
////"kuvaus": "Linja-auton- ja raitiovaununkuljettajat",
////"count": 34
////},
////{
////"koodi": "8332",
////"kuvaus": "Kuorma-auton ja erikoisajoneuvojen kuljettajat",
////"count": 301
////},
////{
////"koodi": "834",
////"kuvaus": "Ty?koneiden kuljettajat",
////"count": 185
////},
////{
////"koodi": "8341",
////"kuvaus": "Maa- ja mets?talousty?koneiden kuljettajat",
////"count": 30
////},
////{
////"koodi": "8342",
////"kuvaus": "Maansiirtokoneiden ym. kuljettajat",
////"count": 104
////},
////{
////"koodi": "8343",
////"kuvaus": "Nosturinkuljettajat",
////"count": 23
////},
////{
////"koodi": "8344",
////"kuvaus": "Ahtaajat ja trukinkuljettajat ym.",
////"count": 29
////},
////{
////"koodi": "835",
////"kuvaus": "Kansimiehist? ym. vesiliikenteen ty?ntekij?t",
////"count": 5
////},
////{
////"koodi": "8350",
////"kuvaus": "Kansimiehist? ym. vesiliikenteen ty?ntekij?t",
////"count": 5
////},
////{
////"koodi": "9",
////"kuvaus": "Muut ty?ntekij?t",
////"count": 1828
////},
////{
////"koodi": "91",
////"kuvaus": "Siivoojat, kotiapulaiset ja muut puhdistustt",
////"count": 830
////},
////{
////"koodi": "911",
////"kuvaus": "Koti-, hotelli- ja toimistosiivoojat ym.",
////"count": 806
////},
////{
////"koodi": "9111",
////"kuvaus": "Kotiapulaiset ja -siivoojat",
////"count": 90
////},
////{
////"koodi": "9112",
////"kuvaus": "Toimisto- ja laitossiivoojat ym.",
////"count": 718
////},
////{
////"koodi": "912",
////"kuvaus": "Ajoneuvojen puhdistajat, ikkunanpesij?t ym.",
////"count": 24
////},
////{
////"koodi": "9122",
////"kuvaus": "Ajoneuvojen pesij?t",
////"count": 22
////},
////{
////"koodi": "9123",
////"kuvaus": "Ikkunanpesij?t",
////"count": 0
////},
////{
////"koodi": "9129",
////"kuvaus": "Muut puhdistusty?ntekij?t",
////"count": 2
////},
////{
////"koodi": "92",
////"kuvaus": "Maa-, mets?- ja kalatalouden avustavat ty?ntekij?t",
////"count": 4
////},
////{
////"koodi": "921",
////"kuvaus": "Maa-, mets?- ja kalatalouden avustavat ty?ntekij?t",
////"count": 4
////},
////{
////"koodi": "9211",
////"kuvaus": "Maanviljelyn avustavat ty?ntekij?t",
////"count": 0
////},
////{
////"koodi": "9212",
////"kuvaus": "Karjankasvatuksen avustavat ty?ntekij?t",
////"count": 0
////},
////{
////"koodi": "9213",
////"kuvaus": "Yhd. maanviljelyn, karjankasvatuksen avustavat tt",
////"count": 2
////},
////{
////"koodi": "9214",
////"kuvaus": "Avustavat puutarhaty?ntekij?t",
////"count": 2
////},
////{
////"koodi": "9215",
////"kuvaus": "Mets?talouden avustavat ty?ntekij?t",
////"count": 0
////},
////{
////"koodi": "9216",
////"kuvaus": "Kalatalouden ja vesiviljelyn avustavat ty?ntekij?t",
////"count": 0
////},
////{
////"koodi": "93",
////"kuvaus": "Teollisuuden ja rakentamisen avustavat ty?ntekij?t",
////"count": 476
////},
////{
////"koodi": "931",
////"kuvaus": "Avustavat kaivos- ja rakennusty?ntekij?t",
////"count": 232
////},
////{
////"koodi": "9311",
////"kuvaus": "Kaivosten avustavat ty?ntekij?t",
////"count": 0
////},
////{
////"koodi": "9312",
////"kuvaus": "Maa- ja vesirakentamisen avustavat ty?ntekij?t",
////"count": 114
////},
////{
////"koodi": "9313",
////"kuvaus": "Rakennusalan avustavat ty?ntekij?t",
////"count": 119
////},
////{
////"koodi": "932",
////"kuvaus": "Valmistusalan avustavat ty?ntekij?t",
////"count": 15
////},
////{
////"koodi": "9321",
////"kuvaus": "K?sinpakkaajat",
////"count": 12
////},
////{
////"koodi": "9329",
////"kuvaus": "Muut valmistusalan avustavat ty?ntekij?t",
////"count": 3
////},
////{
////"koodi": "933",
////"kuvaus": "Rahdink?sittelij?t ja varastoty?ntekij?t ym.",
////"count": 229
////},
////{
////"koodi": "9332",
////"kuvaus": "El?invetoisten kulkuneuvojen kuljettajat",
////"count": 3
////},
////{
////"koodi": "9333",
////"kuvaus": "Rahdink?sittelij?t, varastoty?ntekij?t ym.",
////"count": 222
////},
////{
////"koodi": "9334",
////"kuvaus": "Hyllyjen t?ytt?j?t",
////"count": 4
////},
////{
////"koodi": "94",
////"kuvaus": "Avustavat keitti?- ja ruokaty?ntekij?t",
////"count": 372
////},
////{
////"koodi": "941",
////"kuvaus": "Avustavat keitti?- ja ruokaty?ntekij?t",
////"count": 372
////},
////{
////"koodi": "9411",
////"kuvaus": "Pikaruokaty?ntekij?t",
////"count": 73
////},
////{
////"koodi": "9412",
////"kuvaus": "Avustavat keitti?ty?ntekij?t",
////"count": 302
////},
////{
////"koodi": "95",
////"kuvaus": "Katumyyj?t, keng?nkiillottajat ym.",
////"count": 39
////},
////{
////"koodi": "951",
////"kuvaus": "Mainosten jakajat, keng?nkiillottajat ym.",
////"count": 39
////},
////{
////"koodi": "9510",
////"kuvaus": "Mainosten jakajat, keng?nkiillottajat ym.",
////"count": 39
////},
////{
////"koodi": "952",
////"kuvaus": "Katumyyj?t (pl. elintarvikkeet)",
////"count": 0
////},
////{
////"koodi": "9520",
////"kuvaus": "Katumyyj?t (pl. elintarvikkeet)",
////"count": 0
////},
////{
////"koodi": "96",
////"kuvaus": "Katujen puhtaanapidon ja j?tehuollon ty?ntekij?t",
////"count": 112
////},
////{
////"koodi": "961",
////"kuvaus": "J?tehuoltoty?ntekij?t",
////"count": 11
////},
////{
////"koodi": "9611",
////"kuvaus": "J?tteiden ker??j?t",
////"count": 7
////},
////{
////"koodi": "9612",
////"kuvaus": "J?tteiden lajittelijat",
////"count": 4
////},
////{
////"koodi": "9613",
////"kuvaus": "Kadunlakaisijat ym.",
////"count": 0
////},
////{
////"koodi": "962",
////"kuvaus": "Sanomalehtien jakajat, l?hetit ym.",
////"count": 101
////},
////{
////"koodi": "9621",
////"kuvaus": "Sanomalehtien jakajat, l?hetit ja kantajat",
////"count": 74
////},
////{
////"koodi": "9622",
////"kuvaus": "Satunnaist?iden tekij?t",
////"count": 7
////},
////{
////"koodi": "9623",
////"kuvaus": "Mittareiden lukijat ym.",
////"count": 0
////},
////{
////"koodi": "9629",
////"kuvaus": "Muut muualla luokittelemattomat ty?ntekij?t",
////"count": 20
////},
////{
////"koodi": "0",
////"kuvaus": "Sotilaat",
////"count": 3
////},
////{
////"koodi": "01",
////"kuvaus": "Upseerit",
////"count": 2
////},
////{
////"koodi": "011",
////"kuvaus": "Upseerit",
////"count": 2
////},
////{
////"koodi": "0110",
////"kuvaus": "Upseerit",
////"count": 2
////},
////{
////"koodi": "02",
////"kuvaus": "Aliupseerit",
////"count": 1
////},
////{
////"koodi": "021",
////"kuvaus": "Aliupseerit",
////"count": 1
////},
////{
////"koodi": "0210",
////"kuvaus": "Aliupseerit",
////"count": 1
////},
////{
////"koodi": "03",
////"kuvaus": "Sotilasammattihenkil?st?",
////"count": 0
////},
////{
////"koodi": "031",
////"kuvaus": "Sotilasammattihenkil?st?",
////"count": 0
////},
////{
////"koodi": "0310",
////"kuvaus": "Sotilasammattihenkil?st?",
////"count": 0
////},
////{
////"koodi": "X0",
////"kuvaus": "Yritt?j?t",
////"count": 174
////}
////]';
////}