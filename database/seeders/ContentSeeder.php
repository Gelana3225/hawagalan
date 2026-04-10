<?php

namespace Database\Seeders;

use App\Models\PageSection;
use App\Models\Leader;
use App\Models\Service;
use App\Models\FarmingItem;
use App\Models\TourismAttraction;
use App\Models\ContactInfo;
use Illuminate\Database\Seeder;

class ContentSeeder extends Seeder
{
    public function run(): void
    {
        $this->seedPageSections();
        $this->seedLeaders();
        $this->seedServices();
        $this->seedFarmingItems();
        $this->seedTourismAttractions();
        $this->seedContactInfo();
    }

    private function seedPageSections(): void
    {
        PageSection::truncate();

        $sections = [
            // Home - Hero
            ['page' => 'home', 'section' => 'hero', 'key' => 'title', 'value' => 'AANAA HAAWWAA GALAAN'],
            ['page' => 'home', 'section' => 'hero', 'key' => 'subtitle', 'value' => 'BAGA GARA BULCHIINSA AANAA HAAWWAA GALAAN NAGAAN DHUFTAN!'],
            ['page' => 'home', 'section' => 'hero', 'key' => 'background_image', 'value' => 'images/ket.jpg'],

            // Home - About
            ['page' => 'home', 'section' => 'about', 'key' => 'title', 'value' => 'SEENAA HUNDEEFFAMA AANAA HAAWWAA GALAAN'],
            ['page' => 'home', 'section' => 'about', 'key' => 'body', 'value' => "Aanaan Hawwaa Galaan aanolee Godina Qellem Wallaggaa keessaa ishee tokko. Aanaan kun magaalaa Finfinnee irraa fageenya 624km, Magaalaa Godina Qellem Wallaggaa Dambi Doolloo irraa immoo kiilomeetira 27 irratti argamti. Aanaan kun Bahaan Aanaa Sadii Canqaa, Lixaan Aanaa Sayyoo, Kaabaan Aanaa Y/Walal, Kibbaan Godina Iluu Abbaa Booraatiin daangeffamti. Bal'inni lafa ishee Hektaara 47,003.1. Baayinni uumata aanichaa akka lakkoofsa uummataa bara 2007 taassifametti Dhi 58,573 Dha 60964 ida 119,573. Haalli qilleensa baramaa ishees badda dareen 36.7%, gammoojjiin 63.3% dha.\n\nQorannoo seenaa geggeeffamee fi yaada maanguddoota irraa fudhatameen aanaan kun barri isheen itti hundoofte bara kana jedhamee beekamuu baatus, bara gara dhuma bulchiinsa Minilikii fi dhufiinsa Hayile Sillaasee gidduutti namni maqaan isaa Abbaa Dhaasaa jedhamu gosa warra Maccaa fi Tuulamaa ta'e gandoota naannoo sana turan humnaan walitti fiduun iddoo tokkotti moggaasa maqaa Haawaa Galaan jedhuun akka bulan taassisuun yeroo dhuma sana irraa eegalee aanaan kun akka hundaa'e ibsa."],

            // Farming - Hero
            ['page' => 'farming', 'section' => 'hero', 'key' => 'title', 'value' => 'Hojiiwwan Damee Qonnaa Aanichaa'],
            ['page' => 'farming', 'section' => 'hero', 'key' => 'subtitle', 'value' => 'Qonnaa fi oomishaalee Aanaa Haawwaa Galaan: Buna, Qamadii, Boqqolloo, Beelladoota fi kkf.'],

            // Tourism - Hero
            ['page' => 'tourism', 'section' => 'hero', 'key' => 'title', 'value' => 'Tuurizimii fi Aadaa Aanaa Haawwaa Galaan'],
            ['page' => 'tourism', 'section' => 'hero', 'key' => 'subtitle', 'value' => 'Iddoowwan tuurizimii, aadaa fi goototaa seenaa Aanaa Haawwaa Galaan.'],

            // Biography
            ['page' => 'biography', 'section' => 'hero', 'key' => 'hero_title', 'value' => 'Buraayyuu Abbaa Goosaa'],
            ['page' => 'biography', 'section' => 'hero', 'key' => 'hero_subtitle', 'value' => 'Seenaa Goota Haawwaa Galaan lola sadarkaa biyyaa irratti hirmaate.'],
            ['page' => 'biography', 'section' => 'content', 'key' => 'intro', 'value' => "Buraayyuu Abbaa Goosaa eenyu?\nGoota beekamaa fi Uummata isaa biratti jaallatamaa nama tureedha. Goosaan maqaa farda isaa yammuu ta'u inni sirriin maqaan isaa Buraayyuu Barii Oofaati. Bakki inni itti dhalatee guddate Godina Qellem Wallaggaa Aanaa Hawwaa Galaan ganda Gabaa Sanbata Duraa yookaan Gabaa Jaalallee keessattidha. Bara dhaloota isaa fi bara inni itti du'e ragaan kana nama jechisiisu yoo dhibellee haala bulchiinsa mootolee yeroo sana biyya bulchaa jiran irraa ka'uun naannoo jalqaba jaarraa 19ffaa keessa akka ture ragaan barreeffamaa tokko tokko ni ibsu."],
            ['page' => 'biography', 'section' => 'content', 'key' => 'early_life', 'value' => "Abbaan isaa qonnaan bulaa yammuu ta'u sanyiin isaa Doobbiidha. Sanyiin haadha isaa immoo Oottaa dha. Maqaan haadha manaa goota kanaa Saasii Gumaa Oshoo nama jedhamtu yeroo taatu sanyiin ishees warra qeexawoodha. Buraayyu umurii dargaggummaa isaa jalqabee goota beekamaa akka ture Maanguddoon Obbo Tasammaa Daaqaa fi Obbo Shuumaa Caffoo seenaa maanguddoo umuriin isaan duraarraa dhaga'an irraa nuuf ibsaniiru."],
            ['page' => 'biography', 'section' => 'content', 'key' => 'military_career', 'value' => "Buraayyuun erga naannootti goota beekamaa ta'een booda yeroo inni Jooteetti hin bulu jechuun gara waraana Minilikitti dhaqee dabalamuuf jecha Raas Tasammaa Naadoo gaafate ture. Raas Tasammaa Naadoo jedhamu kun naannoo Goree bulchaa kanturee fi Buraayyuu waliin walitti dhufeenya hoo'aa qabu turan."],
        ];

        PageSection::insert($sections);
    }

    private function seedLeaders(): void
    {
        Leader::truncate();

        $leaders = [
            [
                'name' => 'Obbo Asaffaa Yoonaas Dibaabaa',
                'title' => 'Bulchaa Aanaa Haawwaa Galaan',
                'photo' => 'images/asaffaa.jpg',
                'description' => "Aanaan Haawwaa Galaan gandoota baadiyyaa 30 fi Bulchiinsa Magaalaa 2 qabdi. Akka Aanaa keenyaatti nageenya lammiilee tasgabbeessuu fi Aanaa keenya diinagdeedhaan utubuuf hojii bal'aan qindoomina sekteraalee Aanaa keenyaatiin Hojjetamaa jira. Nageenya biyyaa tasgabbeessuun dhimma xiyyeeffannoo guddaa argatee fi mallattoo uummata Aanaa keenyaa kan ta'e dammaqinaan nageenya isaa tikfachuu keessatti dorgomaa hin qabnu.\n\nOROOMIYAA NI IJAARRA, ITOOPHIYAA NI UTUBNA, GAANFA AFIRIKAA NI TASGABBEESSINA!",
                'sort_order' => 1,
                'is_visible' => true,
            ],
            [
                'name' => 'Obbo Tasfaa Shunnaa Bulchaa',
                'title' => 'I/G/Waajjira Paartii Badhaadhinaa Damee Aanaa Haawwaa Galaan',
                'photo' => 'images/tesfa.jpg',
                'description' => "Waajjirri Paartii Badhaadhinaa Damee Aanaa Haawwaa Galaan hundeeffama isaarraa eegalee hojii boonsaa kallattii hundaan fayyadamummaa sabaa fi sablammoota biyyattii mirkaneessu hedduu hojjetaa akkuma jiru Akka Aanaa haawwaa Galaanittis hojiiwwan hedduu hojjetaa kan jiru toora xiyyeeffannoo isaa qabatee gandoolee Baadiyyaa 30 fi Bulchiinsa Magaalaa 2 keessatti xiyyeeffannoon hojjetaa kan jiruu fi keessumaa Barri jijjiiramaa Aangoon harka oromoo galeen diinagdeen biyyattii sadarkaa sadarkaan hojjetamaa jiru daran kan jajjabeeffamudha.",
                'sort_order' => 2,
                'is_visible' => true,
            ],
            [
                'name' => 'Obbo Abbabe Tizaazuu Kuusaa',
                'title' => 'I/A/Bulchaa fi I/G/W/Qonnaa fi Lafaa Aanaa Haawwaa Galaan',
                'photo' => 'images/ababe.jpg',
                'description' => "Qonni bu'uura diinagdee hawwaasa keenyaa kan ta'e uummata biyyattii keessaa harki 85 ol Qonna irratti kan hundaa'eedha. Hawwaasni Aanaa Haawwaa Galaanis dhibbeentaan 90 ol jiruuf jireenyisaa qonnarratti kan xiyyeeffateedha. kanaaf maddi jireenya hawwaasa aanichaa qonnaan kan ifuudha. Aanicha keessatti qonna ammayyeessuun biyya keenya ceessisuuf karaa waajjira keenyaa hojii bal'aan hojjetamaa jira.",
                'sort_order' => 3,
                'is_visible' => true,
            ],
            [
                'name' => 'Obbo Zarihun Biqilaa Masaadii',
                'title' => 'I/G/ Mana Hojii Abbaa Alangaa Aanaa Haawwaa Galaan',
                'photo' => 'images/zerihun.jpg',
                'description' => "Kaayyoon Mana hojii Abbaa Alangaa yakkoota adda addaa mudatan seekteraalee mootummaa adda addaa waliin qindoomuun qorachuun olaantumaa seeraa mirkaneessuun haqi akka jiraatu taasisuudha. Kana malees akkaataa labsii fi qajeelfama taa'een nama hunda qixatti ilaaluun tajaajiluu, kana jechuun namni kamuu abbaa dhimmaa ta'ee gara waajjirichaa wayita dhufu sabaan, amantaan, aadaa fi afaaniin osoo adda hin qoodin tajaajila si'ataa fi qulqullina qabu kan kenninudha.",
                'sort_order' => 4,
                'is_visible' => true,
            ],
            [
                'name' => 'Dr. Tolasaa Raagaa',
                'title' => 'Hoji Geggeessaa Hospitaala Jalqabaa Aanaa Haawwaa Galaan',
                'photo' => 'images/tolosa.jpg',
                'description' => "Hospitaalli Jalqabaa Aanaa Haawwaa Galaan bara 2010 hojii tajaajila yaalaa guutuu ta'e kennuu kan jalqabe yammuu ta'u, Hawwaasa aanichaa bira darbee jiraattota gandoolee aanaa Ollaa jiran tajaajiluurratti kan argamu kaappitaala jalqabaa qarshii 100,000 qofaan kan jalqabe fi galii keessoo isaa guddisuuf hojjeteen waggoottan muraasa kanatti yeroo ammaa qarshii miliyoona 5 olirra kan jirudha.",
                'sort_order' => 5,
                'is_visible' => true,
            ],
            [
                'name' => 'Obbo Magarsaa Jabeessaa',
                'title' => 'Peresedaanti Mana Murtii Aanaa Haawwaa Galaan',
                'photo' => 'images/magarsaa.jpg',
                'description' => "Manni murtii Aanaa Haawwaa Galaan labsii 141/2000 keewwata 73 jalatti kan hundaa'e uummata Aanaa keenya hundaaf tajaajila qulqulluu fi si'ataa ta'e duudhaawwan saddeet bu'uura godhachuun tajaajilaa jirra. Kanumaan wal qabatee tajaajila haqa qabeessa aantummaa uummataa mirkanneessu hojiirra oolchinee hawwaasa keenya bifa qindaa'aa ta'een tajaajilaa jirra.",
                'sort_order' => 6,
                'is_visible' => true,
            ],
            [
                'name' => 'Obbo Geetahuun Immaanaa Dheeressaa',
                'title' => 'I/G/Waajjira Galiiwwani Aanaa Haawwaa Galaan',
                'photo' => 'images/getahun.jpg',
                'description' => "Waajjirri Galii misooma biyyaa itti fufsiisuu fi maddoonni galii sakatta'amanii seeraan akka galanii fi gosoonni galii sadan hojimaatasaa eegeen raawwachuun galii guddisuun misooma biyyaa itti fufsiisuu keessatti shoora olaanaa taphataa kan jiru karoorri sassaabbii galiis waggaa waggaan dabalaa kan jiru yammuu ta'u bara 2017 qarshii miliyoonni 100 fi miliyoonni 69 akka sassaabamu karoorfamee hojjetamaa tureen qarshiin miliyoonni 100 fi 11 sassaabamaniiru.",
                'sort_order' => 7,
                'is_visible' => true,
            ],
            [
                'name' => 'Obbo Gammachuu Yiggazuu Taaddasaa',
                'title' => 'I/G/W/ Eegumsa Fayyaa Aanaa Haawwaa Galaan',
                'photo' => 'images/gammachu.jpg',
                'description' => "Waajjirri Fayyaa Aanichaa Hawwaasa fayya buleessa ta'e horachuuf cimee hojjechaa jira. Hawaasni aanichaa hundumtuu tajaajila eegumsa fayyaa si'ataa fi qulqullina qabu akka argatuuf xiyyeeffannoon hojjetamaa kan jiru yammuu ta'u namni kamuu tajaajila yaala fayyaa salphaamatti akka argatuuf sadarkaa gandoolee aanichaatti tajaajilli kennamaa jira.",
                'sort_order' => 8,
                'is_visible' => true,
            ],
            [
                'name' => 'Obbo Duulaa Raggaasaa Hiikaa',
                'title' => 'Hoji Geggeessaa Mana Qopheessaa Magaalaa Gabaa Roobii',
                'photo' => 'images/duulaa.jpg',
                'description' => "Manni Qopheessaa Magaalaa gabaa Roobii hawwaasni magaalichaa tajaajila barbaachisu akka argatuuf cimee kan hojjetaa jiruu fi magaalattii magaalaa hawwattuu taasisuuf hojii cimaan hojjetamaa jira. Keessumaa hawwaasni magaalichaa diinagdeen akka of danda'uu fi hirkattummaa hawwaasa baadiyyaa jalaa akka bahuuf omishaaleen adda addaa kanneen akka horsiisa lukkuu, oomisha killee fi loon aannanii dhiyeessuun karaa mana qopheessaa magaalichaa xiyyeeffannoon hojjetamaa jira.",
                'sort_order' => 9,
                'is_visible' => true,
            ],
            [
                'name' => 'Obbo Guuttataa Efireem Maammoo',
                'title' => 'Itti Gaafatamaa Waajjira Barnootaa Aanaa Haawwaa Galaan',
                'photo' => 'images/guuttataa.jpg',
                'description' => "Biyyi tokko guddachuuf humna barate gahaatti omishachuun murteessaa ta'uusaatiin biyyi keenyas barnootarratti xiyyeeffannoon hojjechaa jirti. Akka Aanaa Haawwaa Galaanittis lammii barnootaan gahoomee biyyicha bakka bu'uun gohoominaan biyyattii akka ceesisuuf manneen barnootaa sadarkaa 1ffaa fi 2ffaa 48 ol ta'an hojii baruu fi barsiisuurratti argamu.",
                'sort_order' => 10,
                'is_visible' => true,
            ],
            [
                'name' => 'Aadde Seenaa Tarrafee Yaadataa',
                'title' => 'Itti Gaafatamtuu Waajjira Dhimmoota Gurmaa\'insa Uummataa A/H/Galaan',
                'photo' => 'images/sena.jpg',
                'description' => "Mootummaan Caaseffama Hojii fi hojimaataa lafa qabsiisuuf hojjeteen akkuma Mootummaa Jabaa sadarkaa gandaarratti hundeessuuf hojjeteen Seekteraaleen mootummaa akka walitti makaman taasiseen seekteroonni aanichaa 4 Waajjira Dhimma Dubartootaaf Daa'immanii, Waajjira Ispoortii, waajjira Aadaa fi Tuurizimii fi Waajjirri Hawwaasummaatiin walitti makamanii Waajjira Dhimmoota Gurmaa'insa Uummataa ta'an.",
                'sort_order' => 11,
                'is_visible' => true,
            ],
        ];

        Leader::insert($leaders);
    }

    private function seedServices(): void
    {
        Service::truncate();

        $services = [
            ['name' => 'Tajaajila Barnootaa', 'description' => 'Manneen barnootaa sadarkaa 1ffaa fi 2ffaa 48 ol ta\'an hojii baruu fi barsiisuurratti argamu.', 'icon' => 'fas fa-graduation-cap', 'sort_order' => 1, 'is_visible' => true],
            ['name' => 'Tajaajila Fayyaa', 'description' => 'Hospitaalli Jalqabaa Aanaa Haawwaa Galaan saatii 24 guutuu tajaajilaa kan jirudha.', 'icon' => 'fas fa-hospital', 'sort_order' => 2, 'is_visible' => true],
            ['name' => 'Tajaajila Qonnaa', 'description' => 'Qonna ammayyeessuun biyya keenya ceessisuuf karaa waajjira qonnaa hojii bal\'aan hojjetamaa jira.', 'icon' => 'fas fa-seedling', 'sort_order' => 3, 'is_visible' => true],
            ['name' => 'Tajaajila Seeraa', 'description' => 'Mana Murtii Aanaa Haawwaa Galaan tajaajila qulqulluu fi si\'ataa ta\'e duudhaawwan saddeet bu\'uura godhachuun tajaajilaa jirra.', 'icon' => 'fas fa-balance-scale', 'sort_order' => 4, 'is_visible' => true],
            ['name' => 'Tajaajila Galii', 'description' => 'Waajjirri Galii misooma biyyaa itti fufsiisuu fi maddoonni galii sakatta\'amanii seeraan akka galanii hojjetamaa jira.', 'icon' => 'fas fa-coins', 'sort_order' => 5, 'is_visible' => true],
            ['name' => 'Misoomaa Magaalaa', 'description' => 'Magaalattiin pilaanii qindaa\'aa ta\'e akka qabaattuuf akkasumas hawwatamummaa magaalaa keenyaa dabaluuf cimnee hojjechaa jirra.', 'icon' => 'fas fa-city', 'sort_order' => 6, 'is_visible' => true],
        ];

        Service::insert($services);
    }

    private function seedFarmingItems(): void
    {
        FarmingItem::truncate();

        $items = [
            ['label' => 'Biqilaa', 'image' => 'images/biqilaa.jpg', 'alt_text' => 'Biqilaa (Seventeenth Crop)', 'sort_order' => 1, 'is_visible' => true],
            ['label' => 'Buna', 'image' => 'images/buna.jpg', 'alt_text' => 'Buna (Coffee)', 'sort_order' => 2, 'is_visible' => true],
            ['label' => 'Buna', 'image' => 'images/buna1.jpg', 'alt_text' => 'Buna (Coffee Field)', 'sort_order' => 3, 'is_visible' => true],
            ['label' => 'Muuzii', 'image' => 'images/muuzii1.jpg', 'alt_text' => 'Muuzii (Banana)', 'sort_order' => 4, 'is_visible' => true],
            ['label' => 'Muuzii', 'image' => 'images/muuzii2.jpg', 'alt_text' => 'Muuzii (Banana Farm)', 'sort_order' => 5, 'is_visible' => true],
            ['label' => 'Oomisha Killee', 'image' => 'images/omisha killee.jpg', 'alt_text' => 'Omisha Killee (Egg Production)', 'sort_order' => 6, 'is_visible' => true],
            ['label' => 'Qamadii', 'image' => 'images/qamadii.jpg', 'alt_text' => 'Qamadii (Wheat)', 'sort_order' => 7, 'is_visible' => true],
            ['label' => 'Paappayyaa', 'image' => 'images/pappayya.jpg', 'alt_text' => 'Pappayya (Papaya)', 'sort_order' => 8, 'is_visible' => true],
            ['label' => 'Raafuu Maraa', 'image' => 'images/raafuu.jpg', 'alt_text' => 'Raafuu (Collard Greens)', 'sort_order' => 9, 'is_visible' => true],
            ['label' => 'Salaaxa', 'image' => 'images/qoosta.jpg', 'alt_text' => 'Salaaxa (Custard Apple)', 'sort_order' => 10, 'is_visible' => true],
            ['label' => 'Hundee Diimaa', 'image' => 'images/hundee-diimaa.jpg', 'alt_text' => 'Hundee Diimaa (Red Root)', 'sort_order' => 11, 'is_visible' => true],
            ['label' => 'Muuzii', 'image' => 'images/muuzii.jpg', 'alt_text' => 'Muuzii (Banana Harvest)', 'sort_order' => 12, 'is_visible' => true],
            ['label' => 'Qullubbii Diimaa', 'image' => 'images/qullubbii-diimaa.jpg', 'alt_text' => 'Qullubbii Diimaa (Red Pepper)', 'sort_order' => 13, 'is_visible' => true],
            ['label' => 'Jallisii', 'image' => 'images/jallisii.jpg', 'alt_text' => 'Jallisii (Irrigation)', 'sort_order' => 14, 'is_visible' => true],
            ['label' => 'Ruuzii', 'image' => 'images/ruuzii.jpg', 'alt_text' => 'Ruuzii (Rice)', 'sort_order' => 15, 'is_visible' => true],
            ['label' => 'Nuugii', 'image' => 'images/nuugii.jpg', 'alt_text' => 'Nuugii (Niger Seed)', 'sort_order' => 16, 'is_visible' => true],
            ['label' => 'Biqilaa Bunaa', 'image' => 'images/biqilaa-bunaa.jpg', 'alt_text' => 'Biqilaa Bunaa (Coffee Seedling)', 'sort_order' => 17, 'is_visible' => true],
            ['label' => 'Misooma Bunaa', 'image' => 'images/misooma-bunaa.jpg', 'alt_text' => 'Misooma Bunaa (Coffee Development)', 'sort_order' => 18, 'is_visible' => true],
            ['label' => 'Horsiisa Lukkuu', 'image' => 'images/horsiisa-lukkuu.jpg', 'alt_text' => 'Horsiisa Lukkuu (Poultry Farming)', 'sort_order' => 19, 'is_visible' => true],
            ['label' => 'Oomisha Killee', 'image' => 'images/killee.jpg', 'alt_text' => 'Killee (Eggs)', 'sort_order' => 20, 'is_visible' => true],
            ['label' => 'Furdisa Loonii', 'image' => 'images/furdisa-loonii.jpg', 'alt_text' => 'Furdisa Loonii (Cattle Fattening)', 'sort_order' => 21, 'is_visible' => true],
            ['label' => 'Furdisa Hoolaa', 'image' => 'images/hoolaa.jpg', 'alt_text' => 'Hoolaa (Sheep Fattening)', 'sort_order' => 22, 'is_visible' => true],
            ['label' => 'Loon Aannanii', 'image' => 'images/loon_aannanii.jpg', 'alt_text' => 'Loon Aannanii (Dairy Cow)', 'sort_order' => 23, 'is_visible' => true],
            ['label' => 'Aannan', 'image' => 'images/aannan.jpg', 'alt_text' => 'Aannan (Milk)', 'sort_order' => 24, 'is_visible' => true],
            ['label' => 'Boqqolloo', 'image' => 'images/boqqolloo.jpg', 'alt_text' => 'Boqqolloo (Corn)', 'sort_order' => 25, 'is_visible' => true],
            ['label' => 'Ashaaraa Magariisa', 'image' => 'images/ashaaraa1.jpg', 'alt_text' => 'Ashaaraa Magariisa (Green Reforestation)', 'sort_order' => 26, 'is_visible' => true],
            ['label' => 'Ashaaraa Magariisa', 'image' => 'images/ashaaraa2.jpg', 'alt_text' => 'Ashaaraa Magariisa 2', 'sort_order' => 27, 'is_visible' => true],
            ['label' => 'Ashaaraa Magariisa', 'image' => 'images/ashaaraa3.jpg', 'alt_text' => 'Ashaaraa Magariisa 3', 'sort_order' => 28, 'is_visible' => true],
        ];

        FarmingItem::insert($items);
    }

    private function seedTourismAttractions(): void
    {
        TourismAttraction::truncate();

        $attractions = [
            [
                'name' => 'Buraayyuu Abbaa Goosaa',
                'description' => 'Goota beekamaa fi Uummata isaa biratti jaallatamaa nama tureedha. Seenaa isaa lola Aduwaa fi gootummaa isaa Aanaa Haawwaa Galaan keessatti beekamaa dha.',
                'image' => 'images/burayu.jpg',
                'category' => 'history',
                'features' => json_encode(['Seenaa', 'Aadaa', 'Gootummaa']),
                'sort_order' => 1,
                'is_visible' => true,
            ],
            [
                'name' => 'Fincaa\'a Qexoo',
                'description' => 'Iddoo tuurizimii beekamaa Aanaa Haawwaa Galaan keessaa tokko. Bishaaniin badhaatuudha.',
                'image' => 'images/ket.jpg',
                'category' => 'nature',
                'features' => json_encode(['Bishaanii', 'Uumama', 'Tuurizimii']),
                'sort_order' => 2,
                'is_visible' => true,
            ],
            [
                'name' => 'Nooraa Waaqayyoo',
                'description' => 'Iddoo aadaa fi amantaa Aanaa Haawwaa Galaan keessaa tokko.',
                'image' => 'images/nooraa.png',
                'category' => 'culture',
                'features' => json_encode(['Aadaa', 'Amantaa', 'Seenaa']),
                'sort_order' => 3,
                'is_visible' => true,
            ],
            [
                'name' => 'Bosona Birbir',
                'description' => 'Bosona uumamaa Aanaa Haawwaa Galaan keessaa tokko. Bineensota adda addaa fi biqiltoota uumamaa qabdi.',
                'image' => 'images/birbir.png',
                'category' => 'nature',
                'features' => json_encode(['Bosona', 'Bineensota', 'Uumama']),
                'sort_order' => 4,
                'is_visible' => true,
            ],
        ];

        TourismAttraction::insert($attractions);
    }

    private function seedContactInfo(): void
    {
        ContactInfo::truncate();

        $contacts = [
            ['key' => 'address', 'value' => 'Gabaa Roobii, Aanaa Haawwaa Galaan, Qellem Wallaggaa, Oromiyaa, Itoophiyaa', 'label' => 'Address'],
            ['key' => 'phone', 'value' => '+251 57 XXX XXXX', 'label' => 'Phone'],
            ['key' => 'email', 'value' => 'info@haawwaagalaan.gov.et', 'label' => 'Email'],
            ['key' => 'telegram', 'value' => '@hawwaa_galaan', 'label' => 'Telegram'],
            ['key' => 'facebook', 'value' => 'Haawwaa Galaan', 'label' => 'Facebook'],
        ];

        ContactInfo::insert($contacts);
    }
}
