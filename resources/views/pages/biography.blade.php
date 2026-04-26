@extends('layouts.app')
@section('title', 'Buraayyuu Abbaa Goosaa - Seenaa')
@section('content')
<style>
.bio-hero{background:linear-gradient(135deg,#1e3a8a 0%,#3b82f6 100%);color:white;text-align:center;padding:160px 0 80px;position:relative;overflow:hidden;margin-top:80px;}
.bio-wrap{max-width:1000px;margin:0 auto;padding:0 20px;}
.bio-sec{padding:60px 0;}
.bio-sec:nth-child(even){background:#f8fafc;}
.bio-box{background:white;border-radius:20px;padding:40px;box-shadow:0 8px 30px rgba(0,0,0,0.08);margin-bottom:30px;}
.bio-box h3{font-size:1.6rem;color:#1f2937;margin-bottom:20px;padding-bottom:12px;border-bottom:3px solid #3b82f6;display:flex;align-items:center;gap:12px;}
.bio-box h3 i{color:#3b82f6;}
.bio-box p{color:#4b5563;line-height:1.9;margin-bottom:16px;font-size:1.05rem;}
.bio-profile{display:grid;grid-template-columns:280px 1fr;gap:50px;align-items:start;background:white;border-radius:20px;padding:40px;box-shadow:0 8px 30px rgba(0,0,0,0.08);margin-bottom:30px;}
.bio-img-wrap{text-align:center;}
.bio-main-img{width:240px;height:290px;border-radius:15px;object-fit:cover;margin-bottom:15px;box-shadow:0 10px 25px rgba(0,0,0,0.2);}
.bio-badge{background:#3b82f6;color:white;padding:8px 18px;border-radius:20px;font-size:0.9rem;font-weight:600;display:inline-block;}
.bio-info h2{font-size:2.2rem;color:#1f2937;margin-bottom:10px;font-weight:700;}
.bio-info .sub{font-size:1.1rem;color:#6b7280;margin-bottom:20px;font-weight:500;}
.ach-grid{display:grid;grid-template-columns:repeat(auto-fit,minmax(280px,1fr));gap:25px;margin-top:30px;}
.ach-card{background:white;border-radius:15px;padding:30px;box-shadow:0 5px 15px rgba(0,0,0,0.08);text-align:center;transition:transform 0.3s;border-top:4px solid #3b82f6;}
.ach-card:hover{transform:translateY(-5px);}
.ach-card i{font-size:2.5rem;color:#3b82f6;margin-bottom:15px;display:block;}
.ach-card h4{font-size:1.1rem;color:#1f2937;margin-bottom:10px;font-weight:700;}
.ach-card p{color:#6b7280;line-height:1.6;font-size:0.95rem;}
.gal-grid{display:grid;grid-template-columns:repeat(auto-fit,minmax(220px,1fr));gap:20px;margin-top:25px;}
.gal-item{border-radius:12px;overflow:hidden;box-shadow:0 5px 15px rgba(0,0,0,0.1);height:200px;}
.gal-item img{width:100%;height:100%;object-fit:cover;transition:transform 0.4s;}
.gal-item:hover img{transform:scale(1.06);}
.gal-ph{width:100%;height:100%;background:linear-gradient(135deg,#1e3a8a,#3b82f6);display:flex;align-items:center;justify-content:center;flex-direction:column;gap:8px;}
.gal-ph i{font-size:2rem;color:rgba(255,255,255,0.4);}
.gal-ph span{color:rgba(255,255,255,0.5);font-size:0.8rem;}
@media(max-width:768px){.bio-profile{grid-template-columns:1fr;text-align:center;}.bio-main-img{width:180px;height:220px;}}
</style>

<section class="bio-hero">
<div class="bio-wrap" style="position:relative;z-index:2;">
<h1 style="font-size:clamp(2rem,5vw,3.5rem);font-weight:800;margin-bottom:15px;text-shadow:0 3px 15px rgba(0,0,0,0.3);">Buraayyuu Abbaa Goosaa</h1>
<p style="font-size:1.2rem;opacity:0.9;max-width:600px;margin:0 auto;">Seenaa Goota Haawwaa Galaan lola sadarkaa biyyaa irratti hirmaate.</p>
</div>
</section>

<section class="bio-sec">
<div class="bio-wrap">
@php $bc = \App\Models\PageSection::where('page','biography')->pluck('value','key'); @endphp
<div class="bio-profile">
<div class="bio-img-wrap">
@if(isset($bc['profile_image']) && $bc['profile_image'])
<img src="{{ asset('images/'.$bc['profile_image']) }}" alt="Buraayyuu" class="bio-main-img" onerror="this.style.display='none'">
@else
<div style="width:240px;height:290px;background:linear-gradient(135deg,#1e3a8a,#3b82f6);border-radius:15px;display:flex;align-items:center;justify-content:center;margin:0 auto 15px;"><i class="fas fa-user" style="font-size:5rem;color:rgba(255,255,255,0.3);"></i></div>
@endif
<div class="bio-badge">Goota Seenaa</div>
</div>
<div class="bio-info">
<h2>Buraayyuu Abbaa Goosaa</h2>
<p class="sub">Goota Aanaa Haawwaa Galaan - Jaarraa 19ffaa</p>
<p>Goota beekamaa fi Uummata isaa biratti jaallatamaa nama tureedha. Goosaan maqaa farda isaa yammuu ta'u inni sirriin maqaan isaa Buraayyuu Barii Oofaati. Bakki inni itti dhalatee guddate Godina Qellem Wallaggaa Aanaa Hawwaa Galaan ganda Gabaa Sanbata Duraa yookaan Gabaa Jaalallee keessattidha. Bara dhaloota isaa fi bara inni itti du'e ragaan kana nama jechisiisu yoo dhibellee haala bulchiinsa mootolee yeroo sana biyya bulchaa jiran irraa ka'uun naannoo jalqaba jaarraa 19ffaa keessa akka ture ragaan barreeffamaa tokko tokko ni ibsu. Iddoo inni itti du'e Aanaa Hawwaa Galaan Ganda mojoo yammuu ta'u iddoo inni itti awwaalame garuu ganduma itti dhalate gabaa sanbata duraa bataskaana mikaa'ilaatti. Maqaan Abbaa isaa Barii Oofaa yeroo jedhamu Haati isaa immoo maqaa Muujjee jedhamuun beekamti.</p>
</div>
</div>
</div>
</section>

<section class="bio-sec">
<div class="bio-wrap">
<div class="bio-box">
<h3><i class="fas fa-baby"></i> Bara Dhalootaa fi Jireenya Isaa Gara Jalqabaa</h3>
<p>Abbaan isaa qonnaan bulaa yammuu ta'u sanyiin isaa Doobbiidha. Sanyiin haadha isaa immoo Oottaa dha. maqaan haadha manaa goota kanaa Saasii Gumaa Oshoo nama jedhamtu yeroo taatu sanyiin ishees warra qeexawoodha. Buraayyu umurii dargaggummaa isaa jalqabee goota beekamaa akka ture Maanguddoon Obbo Tasammaa Daaqaa fi Obbo Shuumaa Caffoo seenaa maanguddoo umuriin isaan duraarraa dhaga'an irraa nuuf ibsaniiru. Haala guddina nafa isaa ilaalchisee hammanatti wanti adda isa godhu hin jiru jedhan. Haa ta'uutii garuu maanguddooleen kun akka nuuf ibsanitti haalli guddummaan qaama isaa baay'ee adda jechuun kan ibsan. innis harka isaa yeroo nama irra kaawwatu namni danda'ee akka jala hin teenye kanumaan kan walqabatu haati isaas ulfaatina qaamaanis adda jechuun himu. Akka fakkeenyaatti ulfaatina irraan kan ka'e teessuma sadii irra taa'uun cabsite jedhama. kana malees baqaqaan ija goota kanaa akka ija namaa dalga kan sararame osoo hin taane akka ija leencaa gubbaa gara gaditti sararamee kan baqaffameedha jedhu.</p>
<p>Haala nyaataa fi dhugaatii isaa ilaalchisee foon dheedhii fi farsoo bordeetti fayyadamuu isaati. Irra guddinaan goota kana wanti biraan adda isa taasisu waan hojjetu hundumatti ofitti amanamummaa qabaachuu isaati jedhama. keessumaa ammo jabina isaa keessaa eeboo mukatti darbachuun waraanee duubaan baasuu fi eeboo samaayiitti asii ol darbachuun muka qiltuu jedhamurra darbatee irra baasudhas jedhama. jabina isaan walqabsiisanii uummanni naannichaa sirbaan jaalala goota kanaaf qaban yammuu ibsan:</p>
<p style="font-style:italic;background:#f0f9ff;padding:20px;border-radius:10px;border-left:4px solid #3b82f6;">
Buraayyuu Abbaa Goosaa<br>
Kophaa diinaan lola<br>
Nama Ancootee dibu<br>
Gara ijoolleetti himu<br>
Nama jootee simu<br>
Gara nooleetti himu<br>
Muka fayyaa uree<br>
Utuu ka'ee dhufee<br>
Kan Buraayyuun gitu<br>
Tasumaayyuu hin jiru
</p>
<p>Dabalataan kan akka dinqisiifannaatti kaafamu haala darbannaa eeboo isaati. Haala Wal waraansa mootolee naannoo wajjin Buraayyuun taasiseen Jalqaba irratti gootni kun amalasaa keessaa inni tokko gidiraa yookaan rakkoo sabni isaa keessa jiruuf furmaata barbaachaaf kan adda of baasu ta'uusaa ilaalamaa tureera. kanuma irraa ka'uun Buraayyuu Abbaa Goosaa gara gootummaaatti akka dhufuuf kan isa kakaase sababni hedduun akka jiru ta'uu isaati innis hundeedhuma isaarraa kaanee yoo ilaalle ijoollee ja'an Sayyoo warri jedhaman Daallee, Garjeeda, Laaloo, Awuu, Galaanii fi Alaku turan isaan kun hundi waliif obbolaa jedhamu. Caaseffamni hidda latiinsa Oromoo irraa ka'ee jirus akka itti aanu kanatti ibsamee jira:</p>
<p style="font-style:italic;background:#f0f9ff;padding:20px;border-radius:10px;border-left:4px solid #3b82f6;">
Horo - Oromoo - Boorana - Samalloo - Gurraacha - Nagawoo - Odaa - Walaabu - Raayyaa<br>
Erga godhatee sirni Hidda latiinsa Oromoo as ga'ee Booda:<br>
Tuulama - Raayyaa - Macca godhate - Macca Ijoollee ja'a godhate<br>
Jaawwii - Liiban - Hoboo - Jidda - Buree - Daamot<br>
Yammuu ta'u Ja'an ijoollee macaa keessaa Hoboon Daadhii godhate. Daadhii ilmi Hoboo immoo ijoollee sagal godhate:<br>
Limmuu - Guduruu - Calliyaa - Leeqaa - Tummee - Naannoo - Sibuu - Yaabentuu - Sayyoo<br>
Yammuu godhatu salgan ijoollee Daadhii keessaa Akkayyuu fi Dullacha godhate.<br>
Akkayyuun immoo ijoollee sadii: Awuu - Galaan fi Alaku<br>
Awu immoo ijoollee lama godhate: Ergaa fi Guyyoo<br>
Alaku ijoollee Afur godhate: Baddeessoo - Beellee - Ootaa - Buunnoo turan.<br>
Galaan immoo ijoollee saddeet godhate:<br>
1.Filfilii 2.Haawwaa 3.Harreeree 4.Hamballaa 5.Karrayyuu 6.Guyyoo 7.Waachoo fi 8.Guutoodha.
</p>
<p>Ijoollee Ja'an sayyoo keessaa Awuu, Galaanii fi Alaku obbolaa yammuu ta'an sadan isaanii sababa lafaan baay'ee waldaangessanii jiranii fi mootoleen isaan yeros bulchaa turan laga lagaan walwaraanaa turan jedhama. Galaaniin yeros bulchaa kan ture Abbaa Dhaasaa yookaan maqaan isaa inni biroon Bakakkoo Tufaa yammuu ta'u Awuun bulchaa kan ture Abbaa Buraayyuu kan ta'e Barii Oofaa ture jedhama. kanumarraa ka'uun jalqaba jaarraa 19ffaatti yeroo mootoleen naannoo walwaraanaa turan keessa dhimma lafa babali'fannaaf jecha Abbaan Dhaasaa Abbaa Buraayyuu Barii Oofaa qabee lafa teessoo isaa kan ta'e Gabaa Roobii kan yeroo ammaa magaalaa guddoo Aanaa Haawwaa Galaan Gabaa Roobii jedhamtee waamamtutti fidee hidhe.</p>
<p>Yeroo kana Buraayyuun Umuriin isaa Dargaggeessa ture jedhu maanguddoonni olitti wabeeffanne kunneen. Buraayyu hidhamuu abbaa isaa kana wayita dhaga'u aarii guddaaan ka'ee Eeboo isaa qabatee farda isaa yaabbachuun gara magaalaa Gabaa Roobii iddoo Abbaan isaa kun itti hidhamee jiru dhaqe wayituma iddoo Abbaan isaa itti hidhamee jiru gahu asii maal hojjetta jedhee abbaa isaa kana gaafatu Abbaan isaas akkas jedhe "waanin hidhameef hinbeeku Abbaa Dhaasaatu naqabee asitti nahidhe yaa ilmakoo" jedhee deebiseef. yeroodhuma sana Abbaan Dhaasaa achuma taa'ee gaayyaa xuuxaa utuu jiruu Buraayyus dubbii Abbaa Dhaasaa kana barbaachaaf eeboo isaan harkatti cabse. akkuma kanaan Abbaan dhaasaa gaafa duukaa bu'u buraayyu kaachaan baqatee laga coqorsa jedhamee amma waamamu ce'uun daangaa Awuun keessa gaafa gahu waraana Abbaa Dhaasaatti gaafa gala itti galu sodaatanii booddee deebi'an jedhama.</p>
<p>Buraayyu egaa jaalala abbaa isaaf qabuuf jecha abbaa isaa harka Abbaa Dhaasaa jalaa baasuuf kanumaan abdii kan kutate hin turre. Karaa biraan itti adeemee Abbaa isaa mana hidhaa abba dhaasaa keessaa baasuun filannoo isaa isa lammaffaa ture. manatti galee utuu hin turin dhalataa Ganda Mojoo kan ta'e goota beekamaa kan ture Igguu Bocoloo nama jedhamu waliin mari'atee Ani Noolee deemeen waraana deggersaa gaafadhee dhufaatii ati immoo nama dhaqee teessoo abbaa Dhaasaa nuuf basaasu itti nuuf ergi jedheen jedhama. Itti fufuun Noolee gahee gaafan debi'ee dhufu magaalaa Haroo Jedhamtu kan yeroo ammaa gara bahaatti iddoo duriirraa fageenya kiilomeetira lama siquun machaaraa jedhamtee waamamtuu keessaan deggertoota isaa ajjeesa. manas gubaan dhufaatii atis gara abbaan dhaasaa jirutti waraana jiru ajjeesaa manas gubaa ol kottu jechuun waadaa galchisiifate. sanaan booda Bocolo basaasaaf kan itti gargaaraman nama tokko shaanxaa dhallaadduu irraa hojjetame baachisee akka nama daldalaaf deemuutti itti ergee naannoo abbaan dhaasaa taa'u naanneessiisee akka deebi'u taasise.</p>
<p>Buraayyu akkuma sanaan gara mana isaa deemuun haadha manaa isaa ofitti waamee rifeensa mataa ishee kara karaa baasee erga irraa haadchisiiseen booda garboota isaa wajjin gabaatti baase. itti aansuun farda isaa fe'atee xonboora duraa fi booda fardaatti hidhee ibiddas itti qabsiisuun gabaa facaasaa jedhamtu yeroo sadii naannesse jedhama. Kana malees haadha manaa isaa gabaa walakkaa dhaabee yammuu itti sirbu yeroo kana gabaan Buraayyu hin maraate jechuun baqatte. inni garuu hin maraanne lolaaf mala dhahaa jira malee. erga kana hundaa raawwatee booda Noolee dhaquun biyya Canqaa bulee biyya qanyaammaash Shuuramoo Noolee kaabbaa ga'e achumaanis waraana deggersaa gaafatee jennaan waraana hamma inni gaafate kenneef jedhama.</p>
<p>Waraana kana fudhatee utuu abbaan dhaasaa hin beekin dhufee machaaraa keessaa mana gubaa deggertoota Abbaa Dhaasaa warra ta'anis ajjeesaa akkuma jalqaba jedhameen Igguu Bocoloos dhaamsi geenyaan daangaa Awu irraa kaasee warreen gara Abbaa Dhaasaa ta'an ajjeese. Buraayyuu fi Igguu Bocoloon kana erga raawwatanii booda utuu abbaa Dhaasaatti hin bahin gaara Molee jedhamutti walitti ba'an yeroo ammaa kanallee iddoon molee jedhamee waamamu kun iddoo seena qabeessa kan awwaalli abbaa Dhaasaa itti argamudha.</p>
<p>Abbaan Dhaasaa yeruma Buraayyuun waraana isaa wajjin gaara molee gahuusaa dhaga'u waraana isaa fudhatee Aanaa Sayyoo keessa gaara Humbii sakkootti sokke jedhama. akkuma sanaan Buraayyuun immoo mana Abba Dhaasaatti qajeelee Abbaa isaa mana hidhaa Abbaa Dhaasaatii baasee gara Awuutti fudhatee gale. Boodarra Buraayyu waraana isaa fudhatee Abbaa Dhaasaa lafa inni jirutti duukaa bu'ee utuu hordofuu iddoo humii Sakkoo jedhamu kanatti bira gahuun Abbaa Dhaasaa waraana isaa wajjin booji'e jedhama. ergasii booda waraanni Abbaa dhaasaa fi waraanni Buraayyuu walii galuu walitti dabalamuun tokkummaa uumanii diina naannoo olla isaanii jiru loluu itti fufan.</p>
<p>Qajeelfama buraayyuu irraa darbuun yeroo sanaa kaasanii kan socho'anis mootoleen yeroo sana waliin qabsoo taasisanis Abeetuun Abbaa Ginbii mootii Anfilloo mootii alakuu akkasumas waraana yanboo laga Gaambeelaa fa'a turan. dursa egaa Alakuu wajjin wal waraananii alakuun erga lolanii mo'anii booda Abeetuun Abbaa Gimbii mootiin biyya Anfilloo immoo karaa badddaa saasii cabsee waraana isaa guuree yeroo dhufu iddoo Dajjaash Birruun qabateetti waraanni banamee namni hedduun erga dhumee booda Abeetuun Abbaa Ginbii baqannaadhaan ofirra deebi'ee sokke jedhama. waraana kana irratti hirmaachuuf kan dhaqan ijoolleen bocoloo kudha lama keessaa kudhan achirratti dhuman jedhama. isaan lamaan hafaniin buraayyu kottaa gala jennaaniin hin gallu waraana maqaatu gala malee mataan hin galu daangaa eegna malee jedhanii deebisaniif jedhama.</p>
<p>Utuu hin turin akkuma sanaan waraanni Abbaa Gimbii deebi'ee dhufee jennaan lama ta'anii waraana ishee harkatti hafte sana fixan jedhama. inni biraan ammo karaa kibba lixaa waraanni yanboo gambeellaa jedhamtu tokko dhuftee uummata baay'ee dhiphiftee jennaan Buraayyu waraana igguu Bocoloo fi Ruufoo wajjin ta'uun hanga waggaa tokkoo miillaan deemanii diina mana saamuuf qopha'aan kaan ajjeesanii kaan immoo booji'anii galan jedhama. achumaa deebi'anii waggaa utuu hin guutin si'a lammaffaaf Yanboon Gambeelaa kun daangaa darbuun saamichaa fi uummata ajjeesuu itti fuftee turte. Buraayyuunis dhaamsi isa gahee jennaan galgala gaaf tokkoo xurunbaa afuufsisaa kan na fakkaattan na duukaa ka'aa jedhee dhaamsa itti dabarse akkuma sanaan waraana isaa fudhatee guyyaa gaafa facaasaa irra yanboo Ganbeelaa kanatti gadi qajeele. kanumaan jaalalii inni hawwaasa biratti qabu dabalaa waan adeemeef akkasitti jaalala Braayyuu ibsatu:</p>
<p style="font-style:italic;background:#f0f9ff;padding:20px;border-radius:10px;border-left:4px solid #3b82f6;">
Guyyaa gaafa Facaasaa<br>
Baarootti gadi duulee<br>
Baaroo miillaan daakee<br>
Yanboo lagaa yaase<br>
Ishee tole jette<br>
Ashaboo baachisee<br>
Ishee hi'i jette<br>
Wacifoo nyaachise<br>
Baddaa Shawwaa baasee<br>
kan Buraayyuun simu<br>
tasumayyuu hin jiru.
</p>
</div>
</div>
</section>

<section class="bio-sec">
<div class="bio-wrap">
<div class="bio-box">
<h3><i class="fas fa-shield-alt"></i> Seenaa Waraana Biyyaalessaa Buraayyuun keessatti Hirmaate</h3>
<p>Buraayyuun erga naannootti goota beekamaa ta'een booda yeroo inni Jooteetti hin bulu jechuun gara waraana Minilikitti dhaqee dabalamuuf jecha Raas Tasammaa Naadoo gaafate ture. Raas Tasammaa Naadoo jedhamu kun naannoo Goree bulchaa kanturee fi Buraayyuu waliin walitti dhufeenya hoo'aa qabu turan yeroo Jooteen naannaa kana akka bulchuuf aangoon qaama olaanaa irraa itti kennamee turetti Buraayyu harka laatee itti hin bulle. sababni isaa miidhaaa warra fiwuudaalii yeroo sana Jootee jalatti oogganmuudhaan uummata naannoo isaa irratti geggeeffamaa ture balaaleffachuu irraa kan ka'eedha.</p>
<p>Sirna Abbootii lafaa yeroo sana keessatti maddi diinagdee lafa irratti kan xiyyeeffate ture. kanaaf fiwudaalonni lafa mootiin kenneef qonnaaf itti fayyadamu nama biroofis dabarsanii kennu turan. akkasumas mirga guutuu qabu turan, qonnaan bultoonni lafa fiwuudaalotaa irra jiraataa tajaajila irraa eegamu kennu malee gadi lakkisanii gara lafa yookiin naannoo biraa deemuuf mirga hin qaban turan. gabbartoonni kun abbootii lafaatiif gibira callaan kaffalaniin ala tajaajila humnaas kennaa turan kana malees gabbartoonni fiwudaalotaaf mana, dallaa, gonbisaa fi riqicha hojjechuu akkasumas burqaa bishaanii qulqulleessuu fi kkf dalagaa turan. dubartoonnii fi ijoolleen durbaa ammo jirbii fo'uu fi dhoqqee haruu, haadha warraa isaaniif qoraan cabsuu, hojii mana keessaa hojjechuu akkasumas bishaan fiduu fi kkf hojjechuun dirqma itti kennameedha. keessumaa kan nama gaddisiisuu fi kan nama suukanneessu gochaa sirni sun dargaggoorratti raawwacha ture keessaa hojii gurguddaa hojjechuu fi qarshii argatan guutummaatti fiwudaalota kanaaf geessuu irraa kan ka'e gaa'ila malee akka hafantu himama. rakkoo kanarraa kan ka'e yeroo dubartoonnis nama itti heeruman dhabanii haftuu ta'antu ture. kanumaan walqabsiisanii shamarreenii fi dardaran sirba waliin sirban qabu:</p>
<p style="font-style:italic;background:#f0f9ff;padding:20px;border-radius:10px;border-left:4px solid #3b82f6;">
Qeerroo Qeerro badaa raatuu<br>
Utuu isin jirtanii kontaadhaa nu haalaatu<br>
Inni dargaggeessaa ammo yeroo akkas jedhee shamarran jalaa qabutu ture<br>
Yammuun fuudhaakee kajeele<br>
Dajjaash Birruutu gadi qajeele<br>
Birriis lubbuun bitadheeraa<br>
Moofaas hedduu hidhadheera<br>
Qilxuu guddaa gamaa jala<br>
Dhokadheen darbuu kajeele<br>
Sichuu gaddaa mana teessa.<br>
Kan fuudheyyuu galchuu kajeele
</p>
<p>Kanumaafiyyuu Buraayyuun gochaan suukkanneessaan sirnoota kanaan uummata isaarratti adeemsifame sun inumaayyuu qabsoo isaa akka finiinsuuf isa kakaase malee gidiraa hawwaasicharra gahu taa'ee ilaaluu hin feene. diddaa kana irraa ka'uun Buraayyuun Minilikiin bira dhaquuf jecha Raas Tasammaa Naadoo bira dhaquun beekamtii gaafateen yaada inni itti dhiyeesse keessummeessuun beekamtii kenneef.</p>
<p>Sanaan Booda Buraayyuun Minilikiin bira dhaqee beekamtii argatee deebi'een booda yeroof gar biyyaatti gale. ergasii ka'ee Buraayyuudhaaf ergaan qaama olaanaarraa dhufuuf hunduma isaa karaa Raas Tasammaa Naadoo isa dhufuuf qofa fudhata ture. utuma kanaan jiruu waraanni Xaaliyaanii karaa Tigiraayiin waraana minilikirkatti fixxee jennaan Buraayyu waraana isaa qabatee akka duuluuf minilik irraa waamichi isa qaqqabe. Buraayyus waraana isaa nama 300 wajjin torban ja'a deemuun finfinnee gahe jedhama. akkuma minilikiin bira gaheen buraayyuun gaaffii akkas jedu gaafate nama waraana kana mo'atee deebi'uuf maaltu godhamaaf kan jedhu gaafate. minilikis nama waraana kana lolee injifatee galuuf waa lamatu ta'aaf jedhee deebise. Finfinnee keessaa lafa kutaa magaalaa tokko ni kennamaaf kan jedhuu fi naannoo dhaloota isaa keessaa sirni malkaanyaa akka hinseenne waadaan galaaf jedhe. kanaan booda Buraayyuunis waadaa lammeen kana erga hubatee booda haamilee guutuudhaan waraana isaa fudhatee gara dirree lolaatti qajeele akkuma waraanatti ba'aniin waraana Xaaliyaanii haga ajjeesan ajjeesanii kan hafan immoo booji'anii galan jedhama.</p>
<p>Barri kunis bara 1886 yeruma Aduwaadilii keessa jedhama. sababa waraana sana irratti buraayyu dhiigaan faalameef harkii fi guraadeen Buraayyuu dhiigni gidduutti qorruu irraan kan ka'e walciniinee walittii bahuu didnaan dhadhaa gidduutti naqanii adaan baasan jedhama. guyyootuma muraasa keessatti Buraayyuun injifannoo guddaadhaan deebi'uun isaa sun Minilikii fi qondaaltota isaa biratti dinqisiifannaa guddaa uumeera. itti aansuun nama waraana kana injifatee deebi'ee kennaatu kennama kan jedhu waadaa galameef.</p>
<p>Magaalaa Finfinnee keessaa iddoo har'a Buraayyuu jedhamee waamamu kenneef. kun ta'ee utuu jiruu gaaf tokko naannoo masaraa minilikitti namticha ajajaa waraana minilik ta'e tokkoo wajjin saddeeqa utuu taphatanii wajjin wal lolan jedhama. sababni wal dhabdee isaanii kunis buraayyuun namticha kana tapha saddeeqaa kanarratti isa mo'ee wayita jedhu namtichi aaree Gaallitti kanatu anuma mo'ee jechuun yammuu arrabsu Buraayyus akkuma sanaan kaballaadhaan maddii namichaa gaafa kabalu namtichi kunis aaree hamman si ajjeesutti si hin dhiisu akkas gurra keessa na kabaltee jedhee itti dhaadate. Buraayyus kottu walii baanaa yemmus namni mo'u ni baramaa jedhee deebiseef. akkuma sanaan mooticha minikitti wal baasanii waadaa akkas jedhu waliif galan innis akkana kan jedhu ture abbaan ajjeese biyya isaa fi Haadha manaa isa du'ee haa fudhatu kan jedhu ture. kanaan booda lachan isaanii farda isaanii yaabbatanii mi'a waraanaa guutuun iddoo itti wal beellaamanitti wal baafatan dursa namtichi ykn ajajaan kumaa sun gaafa itti darbatu eeboo namticha kanaa qabe. Eeboo lammaffaaf sadaffaa naminichi buraayyuutti darbatu kun Buraayyu immoo walitti qaba ture. Gaafa dabareen lolaa kun Buraayyuun gahu buraayyu jalqabumatti eeboo tokkoon qomatti darbachuun farda isaa irraa lafaan dhahee erga ajjeesee deebi'een booda akka waadaa isaaniitti biyya namtichaa fi haadha manaa isaa gaafa fuudhi jedhaniin silumaa didhaakoo bahuuf malee waa tokko barbaachaaf miti. ani biyyas haadha manaa isaas hin barbaadu jedhee deebiseef.</p>
<p>Buraayyu egaa kana hundumaa erga raawwateen booda minilikii fi haadha manaa isaa biratti baay'ee sodaatame. keessumaa haati manaa minilik kun isa Minilik Dajjaash Buraayyuu maqaa addaa kenneef isheen immoo mormitee gadi isa qabuuf jecha Baashaa Buraayyuu jettee moggaaste. ittuma fuftee sodaa isaaf qabdurraa kan ka'e isa ajjeesuuf tooftaa biraa minilikiin gorsuutti kaate. innis minilik farda namarraa fudhate tokko kan adda ta'e qaba ture. fardi kunis hafuura hamaan tuqamaa sababa ta'ee yoo nama ajjeesuu barbaadan farda kana yaabee akka lubbuun darbu itti fayyadamu turan. Farda kana namni yaabee yoo manaa bahe fuudhee deebisee hin galu ture. bakkeetti ajjeesee waan galuufidha. kanaaf buraayyuun ajjeesuu sababa barbaadaniif Buraayyuitti farda kana kennan innis farda kana yaabee yeroo deemuuf ka'u waraannisaa fardichi nama ajjeesuudhaan beekamaa waan tureef baay'ee yaaddaa'aniifii turan. Gadheen Gara cittetti korma waan ta'eef Buraayyus goota gara mureessaa fi waan jedhetti kan hin seessine waan tureef yoon du'ee karaatti hafes na barbaadaa jedheenii fardicha yaabbatee qajeele. Fardichi egaa hayyallaa, daggalaa fi bakka halletti ittiin bahee Buraayyu galgala kan qaamni isaa fi uffanni isaa ciccirme kun deebi'ee fardichuma yaabbatee manatti gale.</p>
<p>Mala haati manaa Minilik xaxxe kanaan utuu lubbuun isaa waa hin ta'in akkanatti deebi'ee galuun isaa kun isa dhumaaf mataa dhukkubbii itti ta'e. Gootni kun achi tutturuurraan aangoo minikirraa fudhata jettee sodaa guddaa keessa waan galteef akkas jettee minilikiin gorsite. Namichi jabaan kun aangoo waan sirkaa fudhatuuf waan waadaa galteef raawwadhuutii asii isa deemsisi jetteen. Minilikis Buraayyuun waamee akkuma kanaan dura waadaa galeef isa lammaffaa biyya naannoo ati keessatti dhalattee malkaanyaan akka hin seenne siif murteesseera jedheen. dabalataan uummanni kee simalee een yu jalatti akka hin bulle eebbisee siif kenneera jedheen jedhama. kana hundaa erga waadaa galee raawwatee fi booda qawwee wajagiraa 300 fi taabota 2 itti kennee geggeesse jedhama. Taabota kanas Buraayyu erguma galee tokko ganda mojo keessa iddoo dhummuugaa jedhamutti Bataskaana Joorgisii dhaabe.</p>
<p>Buraayyu egaa silumayyuu wanti qabsoo hammana gahuuf isa kakaase sirna malkaanyaa uummata isaarratti geggeeffamu balaaleffaachuu irraan kan ka'e waan ta'eef erga milkaa'ee galee booda biyya dhaloota isaa Awuutti deebi'ee Awuu guutummaa utuu malkaanyaan tokko illee hin seenin bulchaa ture jedhama. hawwaasni Buraayyuun jalatti buluu erga jalqabanii boqonnaa aara galfii guddaa argatan jedhama. sababiin isaa inni guddaan haalli bulchiinsa isaa akka abba lafaa yookaan malkaanyaatti hin gabbarsiisu waan ta'eef akkaataan uummatichi itti gabbarus buraayyuun qabeenya isaa waan galfatu irraa hammuma danda'e fedhii isaan geessaaf ture.</p>
</div>
</div>
</section>

<section class="bio-sec">
<div class="bio-wrap">
<div class="bio-box">
<h3><i class="fas fa-crown"></i> Hojii Hoggansa fi Siyaasaa</h3>
<p>Haalli siyaasa isaa waraanni yammuu dhufu isaa fi waraana isaa qofatu gara waraanaatti baha malee uummata hin rakkisan ture. Buraayyuu fi obbo Bocoloo qofatu leenjisee bobbaasa. yoo waraanni isaanii beel'anis warri kaan waan hojjetaniif yaa'anii midhaan fidanii nyaachisu turan. haalli buraayyuun akka tooftaatti itti fayyadamu yeroo waraana irratti bobba'u foon dheedhii korojoo isaa keessa kaa'eetu yoo ajjeesu du'aa diinaarra taa'ee foon dheedhii kana korojoo isaa keessaa muratee nyaata jedhama. sodaa kana irraa ka'uun Buraayyu nama nyaata jedhanii warroottan diina isaa ta'an jiganii baqatu jedhama. kana malees gootota jiran keessaa kan adda isa godhu yoo waraanatti bobba'u eeboo saddeet (8) gaachana isaatti dirachuun isa sagalaffaa immoo harka mirgaan qabachuun gara lolaatti baha.</p>
<p><strong>Bu'uurri Diinagdee Isaa:</strong> Haalli diinagdee isaa yeroo sana olla isaa kan jiru Birbirsa gabaa naaf dhaabaa jennaan gabaa birbirsa biratti dhaabaniif yeroo sana keessa rakkoon tokko hin jiru haala gaariin uummanni jiraachaa ture jedhama. ergasii kaasee haalli gabaa akkaataa gaariin naannoo dhuma gabaa dhaabbate kanatti omisha isaanii dhiyeeffachuun wal daldalaa turan jedhama. Buraayyu aakkataa inni uummataa wajjin jiraachaa ture keessaa inni tokko uummata dachaasuun gareen walitti fiduun haala hawwaasummaa fi diinagdee naannichaa irratti mari'achiisaa ture jedhama. Jaarsolii walitti waamee akkamiin naannaa keenya guddifanna akkamiin oolla akkamiin bullas haala kam nuuf wayya jechuun ittiin mari'ataa ture jedhama.</p>
</div>
</div>
</section>

<section class="bio-sec">
<div class="bio-wrap">
<div class="bio-box">
<h3><i class="fas fa-heart"></i> Akkaataa Du'a Buraayyuu</h3>
<p>Buraayyu akkuma achii galeen naannoosaa akka bulchuuf minilik eebbisee kenninaafiin booda naannoo Awuu guutummaa utuu malkaanyaan hin seenin ofii isaa qofa bulchaa turuun isaa ni yaadatama. kun kanaan osoo jiruu yeroo sirna malkaanyaa sana keessa Birruu kan jedhamu naannoo Aanaa sayyoo keessaa ganda Alaku Baddeessoo keessa taa'ee bulchaa ture. gandoota naannoo sanaa dabalatee akkuma beekamu Alakuu fi biyyi Buraayyuu kun waan walitti dhiyaataniif Birruun, Buraayyuun Kun cimaa waan ta'eef aangoo hamma asiitti nurkaa fudhachuun isaa hin oolu jedhee waan sodaateef karaa isa ittiin ajjeesu mala dhawuutti ka'e.</p>
<p>Malli saa kunis akka obbo Tasammaa Daaqaa fi Obbo Shuumaa Caffoo nutti himanitti Buraayyu akka waan baay'ee isa jaallateetti haadha isaa wajjiin wal barsiisee achumaan karaa hadha isaa kana qoricha itti goosisee ajjeesisuuf tooftaa qopheesse jedhan. sanaan booda akkuma sanaan Buraayyutti yaada kana gaafa dhiyeessu Buraayyus haadha isaa kanaan walbaree waliin jiraachuu jalqaban. Akkuma Birruufi haati isaa walii galan egaa haati isaa kun utuu Buraayyuu hin beekin qoricha itti goosifte. sanaan booda Buraayyutti dhukkubnisaa jabaa akka ta'e itti dhaga'amnaan Awutti deebi'ee gale. gaafuma mana isaatti galus itti hammaachuu irraan kan ka'e asii fi achi deemuu lawwaasha'ee manatti ol deebi'ee taa'e.</p>
<p>Boodarra itti cimuu dhukkubasaan kan of jibbee namni natti hin taphatin jedhee tarkaanfii of wareeguu ofirratti muurteesse. Sanaan booda hojjettoota mana isaatiin jaarsolii biyyaa naaf waamaa jedhe. jaarsoliin biyyaa yammuu dhufanis akkas ittiin jedhe. keessummoota baay'eetu yeroo dhiyoo asitti manakoo kana dhufa waan ta'eef waan nyaatamu qopheessaa itti dabalees manakoo kana keessaa fi karaa manakoo dhufu naaf tottolchaa ittiin jedhe. kanaan booda kutaa ciisicha isaatti ol galuun balbala cufachuun dhaqna isaa dhiqatee qawwee isaatti rasaasa itti naqatee afaan qawwee kororiimaatti ofkaa'ee abbuudduu miillasaa dhukaastuu qawweetti kaa'uun dhukaastuutti bu'uun of wareege jedhama. Sanaan booda Birruun du'uu Buraayyuu gaafa dhaga'u Bidiruu hoomii irraa tolfame Biyya Alakuu fuudhee dhaquun du'aasaa tottolchuun reeffa isaa Bataskaana Gabaa Sanbata Duraatti awwaalchise Jedhama.</p>
</div>

<div class="ach-grid">
<div class="ach-card"><i class="fas fa-fist-raised"></i><h4>Gootummaa</h4><p>Lola sadarkaa biyyaa irratti hirmaachuun gootummaa isaa agarsiise. Waraana Xaaliyaanii irratti injifannoo guddaa galmeesse.</p></div>
<div class="ach-card"><i class="fas fa-heart"></i><h4>Jaalala Sabaa</h4><p>Uummata isaa jaalala guddaan jaallate fi isaaniif wareegame. Sirna malkaanyaa balaaleffachuun uummata isaa bilisoomse.</p></div>
<div class="ach-card"><i class="fas fa-landmark"></i><h4>Seenaa Waaraa</h4><p>Maqaan isaa seenaa Aanaa Haawwaa Galaan keessatti bara baraan ni yaadatama. Magaalaan Finfinnee maqaa isaan moggaafamte.</p></div>
</div>
</div>
</section>

<a href="#" onclick="window.scrollTo({top:0,behavior:'smooth'});return false;" style="position:fixed;bottom:30px;right:30px;background:#3b82f6;color:white;width:50px;height:50px;border-radius:50%;display:flex;align-items:center;justify-content:center;text-decoration:none;box-shadow:0 5px 15px rgba(0,0,0,0.2);z-index:100;"><i class="fas fa-arrow-up"></i></a>

@endsection

