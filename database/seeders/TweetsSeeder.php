<?php

namespace Database\Seeders;

use App\Models\Twitter;
use Illuminate\Database\Seeder;

class TweetsSeeder extends Seeder
{
    /**
     * Run the database seeds.
     *
     * @return void
     */
    public function run()
    {
$twitters = array(
  array('id' => '2','tweet_id' => '1385165723404673025','tweet' => 'RT @SukirtiDwivedi: #Delhi #Covid19

"My wife will die. I will hold your feet but please admit her. I beg you. Have been turned back from 3…','tweet_timestamp' => '2021-04-22 09:36:58','avatar' => 'https://abs.twimg.com/images/themes/theme1/bg.png','username' => 'i_m_aswin','fullname' => 'அ','status' => '6','retweeted' => '0','json' => NULL,'created_at' => '2021-04-22 09:37:03','updated_at' => '2021-04-26 20:40:01'),
  array('id' => '3','tweet_id' => '1385165723442483200','tweet' => 'RT @RAinDiercks: Überraschung! In allen BL sind die Schulen wieder auf und... Ooops!! Die Positivraten in Sachen #Covid19 führen in der Alt…','tweet_timestamp' => '2021-04-22 09:36:58','avatar' => 'https://abs.twimg.com/images/themes/theme1/bg.png','username' => 'loveallfucksome','fullname' => 'Lilly','status' => '6','retweeted' => '0','json' => NULL,'created_at' => '2021-04-22 09:37:03','updated_at' => '2021-04-26 20:40:01'),
  array('id' => '4','tweet_id' => '1385165724914651138','tweet' => 'RT @Pranoydev12234: Beds Available:

Azad Nagar Hospital
Lucknow:

941504- 8891 (No Oxygen,100 General Beds )

RT for amplify

#COVIDEme…','tweet_timestamp' => '2021-04-22 09:36:58','avatar' => '','username' => 'tanu_sidfan','fullname' => 'Sid ki Shree ❤(💚Agastya 💘 Rumi💛BBB3💗)','status' => '6','retweeted' => '0','json' => NULL,'created_at' => '2021-04-22 09:37:04','updated_at' => '2021-04-26 20:40:01'),
  array('id' => '5','tweet_id' => '1385165725392793606','tweet' => 'RT @GargiRawat: How nice of Harish Salve to slip in an appeal to open Vedanta unit in Tuticorin that was closed due to environment concerns…','tweet_timestamp' => '2021-04-22 09:36:58','avatar' => 'https://abs.twimg.com/images/themes/theme1/bg.png','username' => 'kunuchavan','fullname' => 'Kunal Chavan🏹','status' => '6','retweeted' => '0','json' => NULL,'created_at' => '2021-04-22 09:37:04','updated_at' => '2021-04-26 20:40:02'),
  array('id' => '6','tweet_id' => '1385165725728337923','tweet' => 'RT @KanchanGupta: Capacity to produce oxygen is 7200 MT. Current demand is 8000 MT.
Sterlite has offered to produce 1000 MT of oxygen if al…','tweet_timestamp' => '2021-04-22 09:36:58','avatar' => 'https://abs.twimg.com/images/themes/theme1/bg.png','username' => 'pmdave49','fullname' => 'Pravin','status' => '6','retweeted' => '0','json' => NULL,'created_at' => '2021-04-22 09:37:04','updated_at' => '2021-04-26 20:40:02'),
  array('id' => '7','tweet_id' => '1385165726772875264','tweet' => 'RT @jjaranaz94: ¡#FelizJueves!

"#Patria ha sabido entrelazar la historia con la realidad, partiendo desde una ficción que tiene, paradójic…','tweet_timestamp' => '2021-04-22 09:36:59','avatar' => 'https://abs.twimg.com/images/themes/theme2/bg.gif','username' => 'jjaranaz94','fullname' => 'Jose Julio Aranaz','status' => '6','retweeted' => '0','json' => NULL,'created_at' => '2021-04-22 09:37:04','updated_at' => '2021-04-26 20:40:03'),
  array('id' => '8','tweet_id' => '1385165726885957632','tweet' => 'RT @aajtak: "इस आपदा में अगर हम हरियाणा, पंजाब, तमिलनाडु, गुजरात, पश्चिम बंगाल में बंट गए तो भारत नहीं बचेगा," @ArvindKejriwal (सीएम, दि…','tweet_timestamp' => '2021-04-22 09:36:59','avatar' => 'https://abs.twimg.com/images/themes/theme1/bg.png','username' => 'Son_Of_Sher','fullname' => 'भारत 🇮🇳 📿🚩','status' => '6','retweeted' => '0','json' => NULL,'created_at' => '2021-04-22 09:37:04','updated_at' => '2021-04-26 20:40:03'),
  array('id' => '9','tweet_id' => '1385165728051961856','tweet' => 'RT @GargiRawat: How nice of Harish Salve to slip in an appeal to open Vedanta unit in Tuticorin that was closed due to environment concerns…','tweet_timestamp' => '2021-04-22 09:36:59','avatar' => 'https://abs.twimg.com/images/themes/theme1/bg.png','username' => 'KUMARAN1573','fullname' => 'Political_Sanyasi','status' => '6','retweeted' => '0','json' => NULL,'created_at' => '2021-04-22 09:37:04','updated_at' => '2021-04-26 20:40:03'),
  array('id' => '10','tweet_id' => '1385165728194580486','tweet' => '🤮','tweet_timestamp' => '2021-04-22 09:36:59','avatar' => 'https://abs.twimg.com/images/themes/theme1/bg.png','username' => 'godisays','fullname' => 'Akhilesh Godi 🏳️‍🌈','status' => '6','retweeted' => '0','json' => NULL,'created_at' => '2021-04-22 09:37:04','updated_at' => '2021-04-26 20:40:03'),
  array('id' => '11','tweet_id' => '1385165728731516932','tweet' => 'RT @Pawankhera: Every single Indian is watching the Hon’ble Supreme Court of India...
एक एक भारतीय माननीय सर्वोच्च न्यायालय की ओर देख रहा…','tweet_timestamp' => '2021-04-22 09:36:59','avatar' => '','username' => 'Sarahpriya3','fullname' => 'Sarah priya','status' => '6','retweeted' => '0','json' => NULL,'created_at' => '2021-04-22 09:37:05','updated_at' => '2021-04-26 20:40:03'),
  array('id' => '12','tweet_id' => '1385165728794374144','tweet' => 'RT @AlpineFine: #Delhi
Oxygen Cylinders &amp; Cans Available in Delhi

#CovidIndiaInfo
#COVIDEmergency2021
#COVID19 https://t.co/6ij3hgKX8p','tweet_timestamp' => '2021-04-22 09:36:59','avatar' => '','username' => 'Poetics42522583','fullname' => '🦋Rinky🍁','status' => '6','retweeted' => '0','json' => NULL,'created_at' => '2021-04-22 09:37:05','updated_at' => '2021-04-26 20:40:03'),
  array('id' => '13','tweet_id' => '1385165729163628544','tweet' => 'RT @Percolator_HNJ: Een gedegen stukje speurwerk van @annstrikje n.a.v. de uitingen van een zelfbenoemde longarts op #Twitter, die de situa…','tweet_timestamp' => '2021-04-22 09:36:59','avatar' => 'https://abs.twimg.com/images/themes/theme1/bg.png','username' => 'ronlambalk','fullname' => '🇳🇱Рон Ламбалк','status' => '6','retweeted' => '0','json' => NULL,'created_at' => '2021-04-22 09:37:05','updated_at' => '2021-04-26 20:40:03'),
  array('id' => '14','tweet_id' => '1385165729327050753','tweet' => 'RT @SukirtiDwivedi: #Delhi #Covid19

"My wife will die. I will hold your feet but please admit her. I beg you. Have been turned back from 3…','tweet_timestamp' => '2021-04-22 09:36:59','avatar' => 'https://abs.twimg.com/images/themes/theme19/bg.gif','username' => 'abhishek_x3','fullname' => 'Abhishek','status' => '6','retweeted' => '0','json' => NULL,'created_at' => '2021-04-22 09:37:05','updated_at' => '2021-04-26 20:40:04'),
  array('id' => '15','tweet_id' => '1385165729880698890','tweet' => 'RT @DrEricDing: I cry for the India 🇮🇳. Brutal epidemic ravaging the country, and hospitals are completely overwhelmed. A staggering 300,00…','tweet_timestamp' => '2021-04-22 09:36:59','avatar' => 'https://abs.twimg.com/images/themes/theme1/bg.png','username' => 'MsEllCee','fullname' => 'Ms Ell Cee 😷💉💉','status' => '6','retweeted' => '0','json' => NULL,'created_at' => '2021-04-22 09:37:05','updated_at' => '2021-04-26 20:40:04'),
  array('id' => '16','tweet_id' => '1385165730451058689','tweet' => 'Not great. Not terrible.','tweet_timestamp' => '2021-04-22 09:36:59','avatar' => 'https://abs.twimg.com/images/themes/theme10/bg.gif','username' => 'orangsalji83','fullname' => 'snowman','status' => '6','retweeted' => '0','json' => NULL,'created_at' => '2021-04-22 09:37:05','updated_at' => '2021-04-26 20:40:04'),
  array('id' => '17','tweet_id' => '1385165730941833218','tweet' => '#EarthDay2021 #EarthDay #RadheTrailer #COVID19 @TSP_President @MukeshSharmaMLA','tweet_timestamp' => '2021-04-22 09:37:00','avatar' => 'https://abs.twimg.com/images/themes/theme1/bg.png','username' => 'sarfaraza024','fullname' => 'MD SARFARAZ ALAM','status' => '6','retweeted' => '0','json' => NULL,'created_at' => '2021-04-22 09:37:05','updated_at' => '2021-04-26 20:40:04'),
  array('id' => '18','tweet_id' => '1385165731482963970','tweet' => 'RT @OffLalanne: .Après les jeunesse communistes, les jeunesses hitlériennes voilà les jeunesses progressistes ! Toujours les mêmes au contr…','tweet_timestamp' => '2021-04-22 09:37:00','avatar' => 'https://abs.twimg.com/images/themes/theme1/bg.png','username' => 'Fredwar20','fullname' => 'Fred','status' => '6','retweeted' => '0','json' => NULL,'created_at' => '2021-04-22 09:37:06','updated_at' => '2021-04-26 20:40:04'),
  array('id' => '19','tweet_id' => '1385165731847827466','tweet' => 'RT @ieexplained: #QUIXPLAINED |😷 The US CDC says double masking could reduced exposure to #COVID19 by nearly 95%.

Here\'s a 🧵on how to doub…','tweet_timestamp' => '2021-04-22 09:37:00','avatar' => 'https://abs.twimg.com/images/themes/theme1/bg.png','username' => 'DOCTORONCO','fullname' => 'RB','status' => '6','retweeted' => '0','json' => NULL,'created_at' => '2021-04-22 09:37:06','updated_at' => '2021-04-26 20:40:04'),
  array('id' => '20','tweet_id' => '1385165731751411713','tweet' => '👵👴 Des de l\'inici de la #pandemia hem estat al costat dels professionals i la #gentgran

✅ En l\'espai especial sobre #COVID19 trobareu tota la normativa, protocols i eines útils sigui quin sigui el servei que oferiu

🔄 Tots documents actualitzats

👉 https://t.co/kr9MdXaEsf https://t.co/RBsJmLkDw6','tweet_timestamp' => '2021-04-22 09:37:00','avatar' => 'https://abs.twimg.com/images/themes/theme1/bg.png','username' => 'acragentgran','fullname' => 'ACRA','status' => '6','retweeted' => '0','json' => NULL,'created_at' => '2021-04-22 09:37:06','updated_at' => '2021-04-26 20:40:05'),
  array('id' => '21','tweet_id' => '1385165731839442949','tweet' => '#Italy #Virus #Epidemic #COVID2019 SARS-CoV-2 #Vangelo #coronavirus #DIO #Italiancovid #Cristo #Quarantine #Pandemic #EU #Italycovid #Italycoronavirus #Fear #coronavirusitalia #Paura #Coronavirus #Chiesa #SARSCoV2 #Italian #Cristianesimo #Gesù #COVID19
https://t.co/eYew1Fagcj https://t.co/HK1zRQ85ZY','tweet_timestamp' => '2021-04-22 09:37:00','avatar' => 'https://abs.twimg.com/images/themes/theme1/bg.png','username' => 'Mariusz_w36','fullname' => 'Mariusz','status' => '6','retweeted' => '0','json' => NULL,'created_at' => '2021-04-22 09:37:06','updated_at' => '2021-04-26 20:40:05'),
  array('id' => '22','tweet_id' => '1385165732137168903','tweet' => '#COVID19
#CovidIndiaInfo
#COVIDEmergency2021
#COVIDSecondWave
https://t.co/9zRKXYYa42','tweet_timestamp' => '2021-04-22 09:37:00','avatar' => '','username' => 'SidnaazMySukoon','fullname' => 'Nisha 💞 SidNaaz','status' => '6','retweeted' => '0','json' => NULL,'created_at' => '2021-04-22 09:37:06','updated_at' => '2021-04-26 20:40:05'),
  array('id' => '23','tweet_id' => '1385165733525704706','tweet' => 'RT @UNLazzarini: In #Gaza: must step up availability+acceptability of #COVID19 vaccines. @UNRWA involved in vaccination: it is safe and pro…','tweet_timestamp' => '2021-04-22 09:37:00','avatar' => 'https://abs.twimg.com/images/themes/theme1/bg.png','username' => 'ahmadalwazir','fullname' => 'Ahmad AlWazir','status' => '6','retweeted' => '0','json' => NULL,'created_at' => '2021-04-22 09:37:06','updated_at' => '2021-04-26 20:40:05'),
  array('id' => '24','tweet_id' => '1385165733626204161','tweet' => 'RT @AdultSpotDiffer: ワクチン接種が進む英国でインド変異株（B1617：二重突然変異株）が増加中。状況と勢いを考えると免疫回避の可能性があり、毒性によって今後問題になる可能性があります。

先ほどの検疫もインドからの飛行機。

免疫回避の可能性がある変異株の…','tweet_timestamp' => '2021-04-22 09:37:00','avatar' => 'https://abs.twimg.com/images/themes/theme1/bg.png','username' => '7_Heliodor','fullname' => '☤́octopus☤́','status' => '6','retweeted' => '0','json' => NULL,'created_at' => '2021-04-22 09:37:06','updated_at' => '2021-04-26 20:40:05'),
  array('id' => '25','tweet_id' => '1385165733714284545','tweet' => 'RT @LawrenceSellin: Is the circle of potential conspirators narrowing?

#COVID19 #corona #CCPVirus #UnrestrictedBiowarfare #UnrestrictedBio…','tweet_timestamp' => '2021-04-22 09:37:00','avatar' => '','username' => 'mautumnum','fullname' => 'mautumn','status' => '6','retweeted' => '0','json' => NULL,'created_at' => '2021-04-22 09:37:06','updated_at' => '2021-04-26 20:40:05'),
  array('id' => '26','tweet_id' => '1385165734188257280','tweet' => 'RT @KadianTweets: Let people die due to lack of Oxygen 👏👏👏👏 hamari 4 taali le lo aapki uchh vichaar pe','tweet_timestamp' => '2021-04-22 09:37:00','avatar' => '','username' => 'gsd_sultan','fullname' => 'जय भवानी','status' => '6','retweeted' => '0','json' => NULL,'created_at' => '2021-04-22 09:37:07','updated_at' => '2021-04-26 20:40:06'),
  array('id' => '27','tweet_id' => '1385165734922178565','tweet' => 'RT @COVIDNewsByMIB: #IndiaFightsCorona:

➡️Know about #COVID19 Severe Disease❗️

➡️If respiratory rate is more than 30 in adults then admis…','tweet_timestamp' => '2021-04-22 09:37:00','avatar' => '','username' => 'JhunuDr','fullname' => 'Dr Jhunu Mukherjee, MD ( Psy) Indian Railways','status' => '6','retweeted' => '0','json' => NULL,'created_at' => '2021-04-22 09:37:07','updated_at' => '2021-04-26 20:40:06'),
  array('id' => '28','tweet_id' => '1385165736155484166','tweet' => '@ABC @FiveThirtyEight This is my official comprehensive writing with supporting arguments regarding the interview with Dr. Geert Vanden Bossche and Dr. Philip McMillan about the serious dangers of this Covid-19 GMO mRNA Gene Therapy sold to the public as #COVID19 "Vaccine":

https://t.co/4NXhMyqhs0','tweet_timestamp' => '2021-04-22 09:37:01','avatar' => 'https://abs.twimg.com/images/themes/theme1/bg.png','username' => 'excellentsub','fullname' => 'Sub-Zero','status' => '6','retweeted' => '0','json' => NULL,'created_at' => '2021-04-22 09:37:07','updated_at' => '2021-04-26 20:40:06'),
  array('id' => '29','tweet_id' => '1385165736549797891','tweet' => 'RT @OffLalanne: .Après les jeunesse communistes, les jeunesses hitlériennes voilà les jeunesses progressistes ! Toujours les mêmes au contr…','tweet_timestamp' => '2021-04-22 09:37:01','avatar' => '','username' => 'polkareef','fullname' => 'Michel Polkareef','status' => '6','retweeted' => '0','json' => NULL,'created_at' => '2021-04-22 09:37:07','updated_at' => '2021-04-26 20:40:06'),
  array('id' => '30','tweet_id' => '1385165736948080645','tweet' => 'RT @rishabhhh_18: I have recently recovered from #COVID19 and I am willing to #DonatePlasma . My blood group is #AB+ and I am from #Chandig…','tweet_timestamp' => '2021-04-22 09:37:01','avatar' => '','username' => 'sannu_kiii','fullname' => '🥀','status' => '6','retweeted' => '0','json' => NULL,'created_at' => '2021-04-22 09:37:07','updated_at' => '2021-04-26 20:40:06'),
  array('id' => '31','tweet_id' => '1385165737275260929','tweet' => 'RT @journomayank: Where exactly is #COVID19?','tweet_timestamp' => '2021-04-22 09:37:01','avatar' => 'https://abs.twimg.com/images/themes/theme1/bg.png','username' => 'kedar_phoenix','fullname' => 'Kedar Kalambe','status' => '6','retweeted' => '0','json' => NULL,'created_at' => '2021-04-22 09:37:07','updated_at' => '2021-04-26 20:40:06'),
  array('id' => '33','tweet_id' => '1385165738432892929','tweet' => '#COVID19: 2,541 kes sembuh, kes aktif kini 22,014. - @KKMPutrajaya','tweet_timestamp' => '2021-04-22 09:37:01','avatar' => 'https://abs.twimg.com/images/themes/theme1/bg.png','username' => 'SinarOnline','fullname' => 'SinarOnline','status' => '6','retweeted' => '0','json' => NULL,'created_at' => '2021-04-22 09:37:08','updated_at' => '2021-04-26 20:40:07'),
  array('id' => '34','tweet_id' => '1385165739330473984','tweet' => 'RT @bhatvicky73: @aajtak @aajtak कुछ शर्म है कि नही ? दिल्ली के सरकारी स्कूल Rouse Avenue में बने #Covid बेड़ की तस्वीर को लखनऊ की बता रहे…','tweet_timestamp' => '2021-04-22 09:37:02','avatar' => 'https://abs.twimg.com/images/themes/theme1/bg.png','username' => 'RahulUrrahul','fullname' => 'CA Rahul Sharma','status' => '6','retweeted' => '0','json' => NULL,'created_at' => '2021-04-22 09:37:08','updated_at' => '2021-04-26 20:40:07'),
  array('id' => '35','tweet_id' => '1385165740135706624','tweet' => '#COVID19: Kelantan catat kes baharu tertinggi manakala Perlis tiada kes baharu. - @KKMPutrajaya','tweet_timestamp' => '2021-04-22 09:37:02','avatar' => 'https://abs.twimg.com/images/themes/theme1/bg.png','username' => 'SinarOnline','fullname' => 'SinarOnline','status' => '6','retweeted' => '0','json' => NULL,'created_at' => '2021-04-22 09:37:08','updated_at' => '2021-04-26 20:40:07'),
  array('id' => '36','tweet_id' => '1385165740442009602','tweet' => 'RT @JMPSimor: Every anti-lockdown, anti-masker, anti-vaccser should watch this.  Distressing.','tweet_timestamp' => '2021-04-22 09:37:02','avatar' => '','username' => 'Katheri40031822','fullname' => 'Katherine Farrell','status' => '6','retweeted' => '0','json' => NULL,'created_at' => '2021-04-22 09:37:08','updated_at' => '2021-04-26 20:40:07'),
  array('id' => '37','tweet_id' => '1385165740735537156','tweet' => 'RT @barandbench: #Breaking: Another hospital Saroj Super Specialty Hospital, Rohini has moved the Delhi High Court seeking urgent critical…','tweet_timestamp' => '2021-04-22 09:37:02','avatar' => 'https://abs.twimg.com/images/themes/theme9/bg.gif','username' => 'rahuljawa','fullname' => 'rahul jawa','status' => '6','retweeted' => '0','json' => NULL,'created_at' => '2021-04-22 09:37:08','updated_at' => '2021-04-26 20:40:07'),
  array('id' => '38','tweet_id' => '1385165742241312770','tweet' => 'RT @nsui: Rajya Sabha MP &amp; AICC Gujarat Incharge Shri @SATAVRAJEEV ji has been tested positive for #COVID19.

We pray for his speedy recove…','tweet_timestamp' => '2021-04-22 09:37:02','avatar' => 'https://abs.twimg.com/images/themes/theme1/bg.png','username' => 'ankushwithrg','fullname' => 'Ankush Bhatnagar','status' => '6','retweeted' => '0','json' => NULL,'created_at' => '2021-04-22 09:37:08','updated_at' => '2021-04-26 20:40:07'),
  array('id' => '39','tweet_id' => '1385165742937722890','tweet' => 'RT @KingstonHospNHS: Women who are breastfeeding can have the #COVID19 vaccination 🤱

Watch GP @DrNighatArif  explain why the JCVI recommen…','tweet_timestamp' => '2021-04-22 09:37:02','avatar' => 'https://abs.twimg.com/images/themes/theme1/bg.png','username' => 'diana_ward1','fullname' => 'Diana Ward','status' => '6','retweeted' => '0','json' => NULL,'created_at' => '2021-04-22 09:37:09','updated_at' => '2021-04-26 20:40:07'),
  array('id' => '40','tweet_id' => '1385165744279748612','tweet' => 'RT @AmbajipetaMBFC: 👌⭐ #MaheshBabu has self isolates himself in after his personal stylist tested positive for #COVID19 on the sets of #Sar…','tweet_timestamp' => '2021-04-22 09:37:03','avatar' => 'https://abs.twimg.com/images/themes/theme12/bg.gif','username' => 'urstrulycharanY','fullname' => '🔥 Cнαяαη Dнfм 💯 🔥 #SRH','status' => '6','retweeted' => '0','json' => NULL,'created_at' => '2021-04-22 09:37:09','updated_at' => '2021-04-26 20:40:08'),
  array('id' => '41','tweet_id' => '1385165744447508481','tweet' => 'RT @himantabiswa: In difficult times like these, critical for us all to come together and unitedly step up our strategies and action to com…','tweet_timestamp' => '2021-04-22 09:37:03','avatar' => '','username' => 'rajkumar9214','fullname' => 'rajkumar thakur','status' => '6','retweeted' => '0','json' => NULL,'created_at' => '2021-04-22 09:37:09','updated_at' => '2021-04-26 20:40:08'),
  array('id' => '42','tweet_id' => '1385165744422285318','tweet' => 'RT @m3update: https://t.co/ieR6aUBeSb 福岡県で268人が新型コロナ感染 https://t.co/3iu9xLFztZ #COVID19 #コロナウイルス #コロナ対策','tweet_timestamp' => '2021-04-22 09:37:03','avatar' => '','username' => 'HimatubuNet','fullname' => 'HimatubuNet','status' => '6','retweeted' => '0','json' => NULL,'created_at' => '2021-04-22 09:37:09','updated_at' => '2021-04-26 20:40:08'),
  array('id' => '43','tweet_id' => '1385165744627851268','tweet' => '#doublemaskup','tweet_timestamp' => '2021-04-22 09:37:03','avatar' => '','username' => 'surabhi82707088','fullname' => 'Surabhi💫','status' => '6','retweeted' => '0','json' => NULL,'created_at' => '2021-04-22 09:37:09','updated_at' => '2021-04-26 20:40:08'),
  array('id' => '44','tweet_id' => '1385165745336700932','tweet' => 'ESUT PROJECT TOPICS AND MATERIALS
Get Complete Project Chapter 1-5 at https://t.co/ZRzox0bsRz
#ESUT #ThursdayThoughts #COVID19 #coronavirus #Educa','tweet_timestamp' => '2021-04-22 09:37:03','avatar' => '','username' => 'topicsng','fullname' => 'Project topics and Research Materials','status' => '6','retweeted' => '0','json' => NULL,'created_at' => '2021-04-22 09:37:09','updated_at' => '2021-04-26 20:40:08'),
  array('id' => '45','tweet_id' => '1385165745282113538','tweet' => 'This is so heartbreaking to see. The woman trying to revive her brother by calling him, \'Balaajee\' will haunt my inner conscience for a very long time. Extremely sad, guilty &amp; depressing. Many more such stories and counting. There are no words.   #COVID19India #COVID19','tweet_timestamp' => '2021-04-22 09:37:03','avatar' => 'https://abs.twimg.com/images/themes/theme1/bg.png','username' => 'vijayarumugam','fullname' => 'Vijay Arumugam','status' => '6','retweeted' => '0','json' => NULL,'created_at' => '2021-04-22 09:37:09','updated_at' => '2021-04-26 20:40:08'),
  array('id' => '46','tweet_id' => '1385165746259435520','tweet' => 'RT @chaturon: ปัญหาของพลเอกประยุทธ์ไม่ได้อยู่ที่พูดเร็วไป แต่อยู่ที่พูดไปทั้งที่ตัวเองไม่เข้าใจเรื่องที่กำลังพูดอยู่ #โควิด19 #Covid19','tweet_timestamp' => '2021-04-22 09:37:03','avatar' => '','username' => 'taeyong_np','fullname' => '♡','status' => '6','retweeted' => '0','json' => NULL,'created_at' => '2021-04-22 09:37:10','updated_at' => '2021-04-26 20:40:09'),
  array('id' => '47','tweet_id' => '1385165746318102534','tweet' => 'RT @siddifam: 🚨DELHI🚨
#fabiflue Available at  Apollo pharmacy near Lady Hardinge medical College c.p
Verified
#COVIDEmergency
#COVIDSecond…','tweet_timestamp' => '2021-04-22 09:37:03','avatar' => '','username' => 'Alekyatelagare1','fullname' => 'Alekya 🙂','status' => '6','retweeted' => '0','json' => NULL,'created_at' => '2021-04-22 09:37:10','updated_at' => '2021-04-26 20:40:09'),
  array('id' => '48','tweet_id' => '1385165746456588292','tweet' => '2875 new cases 😭','tweet_timestamp' => '2021-04-22 09:37:03','avatar' => 'https://abs.twimg.com/images/themes/theme1/bg.png','username' => '__yanaaaaaaa','fullname' => 'vouloir 🍉🥑','status' => '6','retweeted' => '0','json' => NULL,'created_at' => '2021-04-22 09:37:10','updated_at' => '2021-04-26 20:40:09'),
  array('id' => '49','tweet_id' => '1385165746888577025','tweet' => 'RT @BheeshmaTalks: #MaheshBabu  won’t resume the shoot. Reportedly, the next schedule of the #SarkaruVaariPaata  will commence only in May…','tweet_timestamp' => '2021-04-22 09:37:03','avatar' => '','username' => 'DHFMFOREVER222','fullname' => 'అతడు 🔔','status' => '6','retweeted' => '0','json' => NULL,'created_at' => '2021-04-22 09:37:10','updated_at' => '2021-04-26 20:40:09'),
  array('id' => '50','tweet_id' => '1385165746897031170','tweet' => 'RT @TCHNetwork_CO: #Vaccines are available this Saturday in Telluride. Register here: https://t.co/dpaPqA9SHp https://t.co/xIQwCiQg36','tweet_timestamp' => '2021-04-22 09:37:03','avatar' => 'https://abs.twimg.com/images/themes/theme1/bg.png','username' => 'TellurideMC','fullname' => 'Telluride Regional Medical Center','status' => '6','retweeted' => '0','json' => NULL,'created_at' => '2021-04-22 09:37:10','updated_at' => '2021-04-26 20:40:09'),
  array('id' => '51','tweet_id' => '1385165746875998211','tweet' => 'RT @GargiRawat: How nice of Harish Salve to slip in an appeal to open Vedanta unit in Tuticorin that was closed due to environment concerns…','tweet_timestamp' => '2021-04-22 09:37:03','avatar' => 'https://abs.twimg.com/images/themes/theme1/bg.png','username' => 'iamsaaj','fullname' => 'Sajid','status' => '6','retweeted' => '0','json' => NULL,'created_at' => '2021-04-22 09:37:10','updated_at' => '2021-04-26 20:40:09'),
  array('id' => '53','tweet_id' => '1385165747542904833','tweet' => 'RT @m3update: https://t.co/ieR6aUBeSb 東京マーケット・サマリー（22日） https://t.co/tQuZTtIPuG #COVID19 #コロナウイルス #コロナ対策','tweet_timestamp' => '2021-04-22 09:37:04','avatar' => '','username' => 'HimatubuNet','fullname' => 'HimatubuNet','status' => '6','retweeted' => '0','json' => NULL,'created_at' => '2021-04-22 09:37:11','updated_at' => '2021-04-26 20:40:11'),
  array('id' => '54','tweet_id' => '1385165747630997504','tweet' => 'RT @GargiRawat: How nice of Harish Salve to slip in an appeal to open Vedanta unit in Tuticorin that was closed due to environment concerns…','tweet_timestamp' => '2021-04-22 09:37:04','avatar' => 'https://abs.twimg.com/images/themes/theme14/bg.gif','username' => 'clockroots','fullname' => 'Manav','status' => '6','retweeted' => '0','json' => NULL,'created_at' => '2021-04-22 09:37:11','updated_at' => '2021-04-26 20:40:10'),
  array('id' => '55','tweet_id' => '1385165748121657345','tweet' => 'RT @SukirtiDwivedi: #Delhi #Covid19

"My wife will die. I will hold your feet but please admit her. I beg you. Have been turned back from 3…','tweet_timestamp' => '2021-04-22 09:37:04','avatar' => '','username' => 'MrRahul002','fullname' => 'Rahul Singh','status' => '6','retweeted' => '0','json' => NULL,'created_at' => '2021-04-22 09:37:11','updated_at' => '2021-04-26 20:40:10'),
  array('id' => '56','tweet_id' => '1385165748499144708','tweet' => 'RT @m3update: https://t.co/ieR6aUBeSb 埼玉県で233人が新型コロナ感染 https://t.co/as4WQVZTyN #COVID19 #コロナウイルス #コロナ対策','tweet_timestamp' => '2021-04-22 09:37:04','avatar' => '','username' => 'HimatubuNet','fullname' => 'HimatubuNet','status' => '6','retweeted' => '0','json' => NULL,'created_at' => '2021-04-22 09:37:11','updated_at' => '2021-04-26 20:40:11'),
  array('id' => '57','tweet_id' => '1385165749547896835','tweet' => 'RT @m3update: https://t.co/ieR6aUBeSb 新型コロナ感染者が2日連続で5千人超 https://t.co/ffwZKcbfLo #COVID19 #コロナウイルス #コロナ対策','tweet_timestamp' => '2021-04-22 09:37:04','avatar' => '','username' => 'HimatubuNet','fullname' => 'HimatubuNet','status' => '6','retweeted' => '0','json' => NULL,'created_at' => '2021-04-22 09:37:11','updated_at' => '2021-04-26 20:40:10'),
  array('id' => '58','tweet_id' => '1385165749556154369','tweet' => 'RT @rohini_sgh: Vaccination has always been free in India. Even when we were a miserably poor country. It should continue to be free for ev…','tweet_timestamp' => '2021-04-22 09:37:04','avatar' => 'https://abs.twimg.com/images/themes/theme19/bg.gif','username' => 'iNamitaPrakash','fullname' => 'Namita','status' => '6','retweeted' => '0','json' => NULL,'created_at' => '2021-04-22 09:37:11','updated_at' => '2021-04-26 20:40:10'),
  array('id' => '59','tweet_id' => '1385165749677817858','tweet' => 'RT @kittybehal10: This is a cry for help!

Delhi’s Shanti Mukund Hospital has hardly any oxygen left.
The CEO breaks down on camera sayin…','tweet_timestamp' => '2021-04-22 09:37:04','avatar' => 'https://abs.twimg.com/images/themes/theme1/bg.png','username' => 'anshunandanpra4','fullname' => 'ER. ANSHU NANDAN PRASAD(भगवान राम भक्त🚩🕉)🇮🇳','status' => '6','retweeted' => '0','json' => NULL,'created_at' => '2021-04-22 09:37:11','updated_at' => '2021-04-26 20:40:10'),
  array('id' => '60','tweet_id' => '1385165749786845187','tweet' => 'RT @NewsDigestWeb: 【愛知県で新たに294人感染確認】

愛知県+294（合計31119人）
※県発表137人、名古屋市119人、豊田市5人、一宮市14人、岡崎市4人、豊橋市15人

詳細は下記URLより：
https://t.co/oEslL3ucOx

#…','tweet_timestamp' => '2021-04-22 09:37:04','avatar' => 'https://abs.twimg.com/images/themes/theme1/bg.png','username' => 'mamakaizoku','fullname' => 'りさ『BG 身辺警護人 2020 BOX』Blu-ray&DVD BOX 発売中','status' => '6','retweeted' => '0','json' => NULL,'created_at' => '2021-04-22 09:37:12','updated_at' => '2021-04-26 20:40:11'),
  array('id' => '61','tweet_id' => '1385165750139199488','tweet' => 'RT @SSMB_SHER: Superstar #MaheshBabu has self isolates himself in after his personal stylist tested positive for #COVID19 on the sets of #S…','tweet_timestamp' => '2021-04-22 09:37:04','avatar' => '','username' => 'vk_manikanta','fullname' => 'ManikantaVKMB','status' => '6','retweeted' => '0','json' => NULL,'created_at' => '2021-04-22 09:37:12','updated_at' => '2021-04-26 20:40:11'),
  array('id' => '62','tweet_id' => '1385165751338749954','tweet' => 'RT @SukirtiDwivedi: #Delhi #Covid19

"My wife will die. I will hold your feet but please admit her. I beg you. Have been turned back from 3…','tweet_timestamp' => '2021-04-22 09:37:04','avatar' => '','username' => 'RP17fan','fullname' => 'movie_buff','status' => '6','retweeted' => '0','json' => NULL,'created_at' => '2021-04-22 09:37:12','updated_at' => '2021-04-26 20:40:11'),
  array('id' => '63','tweet_id' => '1385165751762382849','tweet' => 'RT @karyn_nishi: Il y a du monde sur les quais et dans les trains aux heures de pointe à #Tokyo en pleine 4e vague épidémique, à la veille…','tweet_timestamp' => '2021-04-22 09:37:05','avatar' => 'https://abs.twimg.com/images/themes/theme17/bg.gif','username' => 'caecilia1122','fullname' => 'Caecilia','status' => '6','retweeted' => '0','json' => NULL,'created_at' => '2021-04-22 09:37:12','updated_at' => '2021-04-26 20:40:11'),
  array('id' => '64','tweet_id' => '1385165751946936325','tweet' => 'RT @ndtv: Watch | "The situation is grim. We have 140 #COVID19 patients": Pankaj Chawla, Trustee, Saroj Hospital, Delhi on shortage of #oxy…','tweet_timestamp' => '2021-04-22 09:37:05','avatar' => 'https://abs.twimg.com/images/themes/theme1/bg.png','username' => 'waghmareu8172','fullname' => 'urmila waghmare','status' => '6','retweeted' => '0','json' => NULL,'created_at' => '2021-04-22 09:37:12','updated_at' => '2021-04-26 20:40:11'),
  array('id' => '65','tweet_id' => '1385165752471224322','tweet' => 'RT @savechildrenvvv: インドで急速に拡がっているB.1.617(グラフの赤)は二重変異でワクチンでの抗体だけでなく自然免疫も回避するようなので個人的にはこれが流入したら誰も助からないのではと思っている…💦
日本は新しい変異株を検知しない検査でザルなのでもう入…','tweet_timestamp' => '2021-04-22 09:37:05','avatar' => '','username' => '652bC7pBEexI3sD','fullname' => 'flowerTail','status' => '6','retweeted' => '0','json' => NULL,'created_at' => '2021-04-22 09:37:13','updated_at' => '2021-04-26 20:40:11'),
  array('id' => '66','tweet_id' => '1385165752337145856','tweet' => 'Conoce las claves del RDL 6/2021, que recoge medidas complementarias para ayudar a #empresas y #autonomos afectados por la #COVID19 @CEOE_ES

👉https://t.co/Eam2K7HmfF','tweet_timestamp' => '2021-04-22 09:37:05','avatar' => 'https://abs.twimg.com/images/themes/theme1/bg.png','username' => 'CEOEdocs','fullname' => 'CEOE Documentos','status' => '6','retweeted' => '0','json' => NULL,'created_at' => '2021-04-22 09:37:13','updated_at' => '2021-04-26 20:40:12'),
  array('id' => '67','tweet_id' => '1385165753213542403','tweet' => 'RT @ieexplained: #QUIXPLAINED |😷 The US CDC says double masking could reduced exposure to #COVID19 by nearly 95%.

Here\'s a 🧵on how to doub…','tweet_timestamp' => '2021-04-22 09:37:05','avatar' => '','username' => 'SGXMabelmora','fullname' => 'Mabel','status' => '6','retweeted' => '0','json' => NULL,'created_at' => '2021-04-22 09:37:13','updated_at' => '2021-04-26 20:40:12'),
  array('id' => '68','tweet_id' => '1385165753813372930','tweet' => 'RT @polimernews: கோவாக்சின் தடுப்பூசி போட்ட பத்தாயிரத்தில் 4 பேருக்கு மட்டுமே கொரோனா தொற்று ஏற்பட்டுள்ளது: மத்திய சுகாதாரத்துறை #CoronaVacc…','tweet_timestamp' => '2021-04-22 09:37:05','avatar' => 'https://abs.twimg.com/images/themes/theme1/bg.png','username' => 'Kovaikathiravan','fullname' => 'Kathiravan','status' => '6','retweeted' => '0','json' => NULL,'created_at' => '2021-04-22 09:37:13','updated_at' => '2021-04-26 20:40:12'),
  array('id' => '69','tweet_id' => '1385165753754689540','tweet' => 'RT @RetourneRex: El Gobierno Federal está PROHIBIENDO que el gobierno de Jalisco vacune al personal médico y de enfermería del estado sólo…','tweet_timestamp' => '2021-04-22 09:37:05','avatar' => 'https://abs.twimg.com/images/themes/theme11/bg.gif','username' => 'mizpaidem','fullname' => 'Lex Luthor','status' => '6','retweeted' => '0','json' => NULL,'created_at' => '2021-04-22 09:37:13','updated_at' => '2021-04-26 20:40:12'),
  array('id' => '70','tweet_id' => '1385165753825906688','tweet' => 'RT @BheeshmaTalks: Superstar #MaheshBabu has self isolates himself in after his personal stylist tested positive for #COVID19 on the sets o…','tweet_timestamp' => '2021-04-22 09:37:05','avatar' => '','username' => 'DHFMFOREVER222','fullname' => 'అతడు 🔔','status' => '6','retweeted' => '0','json' => NULL,'created_at' => '2021-04-22 09:37:13','updated_at' => '2021-04-26 20:40:12'),
  array('id' => '71','tweet_id' => '1385165754983665666','tweet' => 'RT @IoDIreland: We have now moved on to the Q&amp;A session of our webinar with @MartinDShanahan, with some great questions from members on #ta…','tweet_timestamp' => '2021-04-22 09:37:05','avatar' => '','username' => 'SharonG11058173','fullname' => 'Sharon Gavin','status' => '6','retweeted' => '0','json' => NULL,'created_at' => '2021-04-22 09:37:14','updated_at' => '2021-04-26 20:40:12'),
  array('id' => '72','tweet_id' => '1385165756090966018','tweet' => 'RT @sanakadevar: Oxygen availabe :-
Location:- Muzaffarpur (bihar)
#Muzaffarpur #Bihar #COVIDEmergency2021 #COVID19 https://t.co/cMh7ZAaQWK','tweet_timestamp' => '2021-04-22 09:37:06','avatar' => '','username' => 'Vinutha48819712','fullname' => 'Vinutha','status' => '6','retweeted' => '0','json' => NULL,'created_at' => '2021-04-22 09:37:14','updated_at' => '2021-04-26 20:40:12'),
  array('id' => '73','tweet_id' => '1385165756275445765','tweet' => 'RT @KKMPutrajaya: Status Terkini #COVID19, 22 April 2021
Kes sembuh= 2,541
Jumlah kes sembuh= 361,267
Kes baharu positif= 2,875 (2,846 tem…','tweet_timestamp' => '2021-04-22 09:37:06','avatar' => 'https://abs.twimg.com/images/themes/theme1/bg.png','username' => '__yanaaaaaaa','fullname' => 'vouloir 🍉🥑','status' => '6','retweeted' => '0','json' => NULL,'created_at' => '2021-04-22 09:37:14','updated_at' => '2021-04-26 20:40:12'),
  array('id' => '74','tweet_id' => '1385165756422180867','tweet' => 'Kelantan mendahului, come on guysssss,
Higherrr!!! 🤟🏻','tweet_timestamp' => '2021-04-22 09:37:06','avatar' => 'https://abs.twimg.com/images/themes/theme1/bg.png','username' => 'DannyMiskani','fullname' => 'DM7','status' => '6','retweeted' => '0','json' => NULL,'created_at' => '2021-04-22 09:37:14','updated_at' => '2021-04-26 20:40:13'),
  array('id' => '75','tweet_id' => '1385165756841840640','tweet' => 'RT @2CJdmendzr71: #Venezuela🇻🇪 registró durante las últimas 24 horas 1.009 nuevos contagios de la #COVID19 Autoridades lamentaron los 21 ca…','tweet_timestamp' => '2021-04-22 09:37:06','avatar' => 'https://abs.twimg.com/images/themes/theme1/bg.png','username' => 'JuanAlejandroSG','fullname' => 'Juan Salazar','status' => '6','retweeted' => '0','json' => NULL,'created_at' => '2021-04-22 09:37:15','updated_at' => '2021-04-26 20:40:13'),
  array('id' => '76','tweet_id' => '1385165756816494594','tweet' => 'What have we come to ? Is this what we deserve and is this all we can expect ?','tweet_timestamp' => '2021-04-22 09:37:06','avatar' => 'https://abs.twimg.com/images/themes/theme1/bg.png','username' => 'devi_kutty','fullname' => 'Devi Lakshmikutty','status' => '6','retweeted' => '0','json' => NULL,'created_at' => '2021-04-22 09:37:15','updated_at' => '2021-04-26 20:40:13'),
  array('id' => '77','tweet_id' => '1385165759270113285','tweet' => 'अस्पताल के बाहर रो रही युवती का कहना है कि हॉस्पिटल कह रहा है कि ऑक्सीजन नहीं है, हम लोग यहां से कहां ले जाएंगे? यह लोग ऐसा कैसे कर सकते हैं?
#Lucknow #OxygenShortage #Covid19
https://t.co/odwwBpuZTX','tweet_timestamp' => '2021-04-22 09:37:06','avatar' => 'https://abs.twimg.com/images/themes/theme16/bg.gif','username' => 'aajtak','fullname' => 'AajTak','status' => '6','retweeted' => '0','json' => NULL,'created_at' => '2021-04-22 09:37:15','updated_at' => '2021-04-26 20:40:13'),
  array('id' => '78','tweet_id' => '1385165759995809799','tweet' => '@TeaPainUSA 570, 000 American deaths from #SARS_CoV_2 and Ben Carson is promoting #HydroxyChloroquine?
Perhaps, he is suffering the aftereffects of #COVID19?','tweet_timestamp' => '2021-04-22 09:37:06','avatar' => 'https://abs.twimg.com/images/themes/theme1/bg.png','username' => 'noelieululanib','fullname' => 'noel ululani woodard','status' => '6','retweeted' => '0','json' => NULL,'created_at' => '2021-04-22 09:37:15','updated_at' => '2021-04-26 20:40:13'),
  array('id' => '79','tweet_id' => '1385165760352317449','tweet' => 'RT @ANI: ADVISORY: At 5PM today, Dr Randeep Guleria Director AIIMS Delhi, Dr Devi Shetty, Chairman, Narayana Health and Dr Naresh Trehan, C…','tweet_timestamp' => '2021-04-22 09:37:07','avatar' => 'https://abs.twimg.com/images/themes/theme1/bg.png','username' => 'drreecha','fullname' => 'reecha veelu','status' => '6','retweeted' => '0','json' => NULL,'created_at' => '2021-04-22 09:37:15','updated_at' => '2021-04-26 20:40:13'),
  array('id' => '80','tweet_id' => '1385165760792772612','tweet' => 'RT @Mediavenir: 🇫🇷 ALERTE INFO - La limite de 10 kilomètres pourrait être levée dès le 2 mai. À la mi-mai, les terrasses, les commerces non…','tweet_timestamp' => '2021-04-22 09:37:07','avatar' => '','username' => 'meestihh','fullname' => 'ຕ','status' => '6','retweeted' => '0','json' => NULL,'created_at' => '2021-04-22 09:37:15','updated_at' => '2021-04-26 20:40:14'),
  array('id' => '81','tweet_id' => '1385165761212260355','tweet' => 'RT @GlobForumTBVax: 🔔DAILY SCHEDULE ALERT🔔

For the last day of the #VGFTB we bring you sessions on:
💉 BCG
📋 Leveraging #COVID19
💵 Fina…','tweet_timestamp' => '2021-04-22 09:37:07','avatar' => 'https://abs.twimg.com/images/themes/theme1/bg.png','username' => 'TheUnion_TBLH','fullname' => 'The Union','status' => '6','retweeted' => '0','json' => NULL,'created_at' => '2021-04-22 09:37:16','updated_at' => '2021-04-26 20:40:14'),
  array('id' => '82','tweet_id' => '1385165761992269825','tweet' => 'काम करने वाले बहाने नहीं करते https://t.co/6fjOkBITrr','tweet_timestamp' => '2021-04-22 09:37:07','avatar' => '','username' => 'FrYAt9DTz5LuE7Q','fullname' => 'सिंह अनिल','status' => '6','retweeted' => '0','json' => NULL,'created_at' => '2021-04-22 09:37:16','updated_at' => '2021-04-26 20:40:14'),
  array('id' => '83','tweet_id' => '1385165763762348032','tweet' => 'RT @JMPSimor: Every anti-lockdown, anti-masker, anti-vaccser should watch this.  Distressing. https://t.co/ERR8fKTHTP','tweet_timestamp' => '2021-04-22 09:37:07','avatar' => 'https://abs.twimg.com/images/themes/theme5/bg.gif','username' => 'ErikaBB','fullname' => 'Erika. Jacaroa do Pantanal','status' => '6','retweeted' => '0','json' => NULL,'created_at' => '2021-04-22 09:37:16','updated_at' => '2021-04-26 20:40:14'),
  array('id' => '85','tweet_id' => '1385165764471128066','tweet' => 'RT @FEMINALIST: #Agra #COVID19 Resources!! RT Amplify! https://t.co/12mUefEDmJ','tweet_timestamp' => '2021-04-22 09:37:08','avatar' => '','username' => 'Aksriv04','fullname' => 'Aakarshit RF ❤️','status' => '6','retweeted' => '0','json' => NULL,'created_at' => '2021-04-22 09:37:16','updated_at' => '2021-04-26 20:40:14'),
  array('id' => '86','tweet_id' => '1385165764693532672','tweet' => 'RT @avmkocaman: #Covid19 testi pozitif çıkan Derince Belediye Başkanımız kıymetli ağabeyim #ZekiAygün\'e geçmiş olsun dileklerimi iletiyorum…','tweet_timestamp' => '2021-04-22 09:37:08','avatar' => '','username' => 'OzgurBehic','fullname' => 'Behiç Özgür','status' => '6','retweeted' => '0','json' => NULL,'created_at' => '2021-04-22 09:37:16','updated_at' => '2021-04-26 20:40:14'),
  array('id' => '87','tweet_id' => '1385165765049864192','tweet' => 'RT @PawanDurani: Not a single hospital built in 7 years , but keep blaming centre ... This is AAP','tweet_timestamp' => '2021-04-22 09:37:08','avatar' => '','username' => 'ProudHindu45','fullname' => 'Anju Chopra🦋🦋','status' => '6','retweeted' => '0','json' => NULL,'created_at' => '2021-04-22 09:37:17','updated_at' => '2021-04-26 20:40:15'),
  array('id' => '88','tweet_id' => '1385165765289013252','tweet' => 'RT @rssurjewala: मोदी-खट्टर सरकारों का रोज़गार कार्यक्रम -
“अंतिम संस्कार कम्पनियाँ” ।

क्या ऐसे लोगों से उम्मीद थी कि वो देश-प्रदेश चलाएँ…','tweet_timestamp' => '2021-04-22 09:37:08','avatar' => 'https://abs.twimg.com/images/themes/theme1/bg.png','username' => 'mohddanish23','fullname' => 'mohddanish','status' => '6','retweeted' => '0','json' => NULL,'created_at' => '2021-04-22 09:37:17','updated_at' => '2021-04-26 20:40:15'),
  array('id' => '89','tweet_id' => '1385165767025446913','tweet' => 'RT @GargiRawat: How nice of Harish Salve to slip in an appeal to open Vedanta unit in Tuticorin that was closed due to environment concerns…','tweet_timestamp' => '2021-04-22 09:37:08','avatar' => 'https://abs.twimg.com/images/themes/theme1/bg.png','username' => 'HermesEloquence','fullname' => 'hermes','status' => '6','retweeted' => '0','json' => NULL,'created_at' => '2021-04-22 09:37:17','updated_at' => '2021-04-26 20:40:15'),
  array('id' => '90','tweet_id' => '1385165767159672833','tweet' => 'RT @SukirtiDwivedi: #Delhi #Covid19

"My wife will die. I will hold your feet but please admit her. I beg you. Have been turned back from 3…','tweet_timestamp' => '2021-04-22 09:37:08','avatar' => '','username' => 'TerraFredda','fullname' => 'Meer Hijjat','status' => '6','retweeted' => '0','json' => NULL,'created_at' => '2021-04-22 09:37:17','updated_at' => '2021-04-26 20:40:15'),
  array('id' => '91','tweet_id' => '1385165767528747010','tweet' => 'RT @LawrenceSellin: For #COVID19 detectives: After 2017, Biao He from Ningyi Jin\'s lab disappeared from the group that isolated the Zhousha…','tweet_timestamp' => '2021-04-22 09:37:08','avatar' => '','username' => '4VYrhIEkJAuGncS','fullname' => '春秋立夏','status' => '6','retweeted' => '0','json' => NULL,'created_at' => '2021-04-22 09:37:17','updated_at' => '2021-04-26 20:40:15'),
  array('id' => '92','tweet_id' => '1385165767818170368','tweet' => 'INFO
#pmrkemaman #MalaysiaPrihatin #covid19 #protectyourselftandyourfamily  #pkpp #tidakpastijangankongsi #kitajagakita #japentrg #kitateguhkitamenang #lindungdirilindungsemua','tweet_timestamp' => '2021-04-22 09:37:08','avatar' => '','username' => 'penkemamaninfo1','fullname' => 'PMR Daerah Kemaman','status' => '6','retweeted' => '0','json' => NULL,'created_at' => '2021-04-22 09:37:17','updated_at' => '2021-04-26 20:40:15'),
  array('id' => '94','tweet_id' => '1385165768858378241','tweet' => 'RT @girishmallya: #delhi #flometer for oxygen tank #COVIDEmergency2021 #needed','tweet_timestamp' => '2021-04-22 09:37:09','avatar' => 'https://abs.twimg.com/images/themes/theme13/bg.gif','username' => 'RushinaMG','fullname' => 'Rushina M Ghildiyal','status' => '6','retweeted' => '0','json' => NULL,'created_at' => '2021-04-22 09:37:18','updated_at' => '2021-04-26 20:40:15'),
  array('id' => '95','tweet_id' => '1385165769432993793','tweet' => 'RT @CIPE_ACGC: #Brazil\'s Supreme Court has ruled 10-1 to allow a Senate probe into Pres Bolsonaro\'s #COVID19 management

This comes on the…','tweet_timestamp' => '2021-04-22 09:37:09','avatar' => '','username' => 'FraudGlobal','fullname' => 'GLOBAL FRAUD WATCH','status' => '6','retweeted' => '0','json' => NULL,'created_at' => '2021-04-22 09:37:18','updated_at' => '2021-04-26 20:40:16'),
  array('id' => '96','tweet_id' => '1385165770477359105','tweet' => 'RT @SaketGokhale: The CJI retires tomorrow. Yet matter has been taken up today &amp; listed for tomorrow.

Of all the people, Harish Salve has…','tweet_timestamp' => '2021-04-22 09:37:09','avatar' => '','username' => 'NihalMirza_INC','fullname' => 'Nihal Mirza','status' => '6','retweeted' => '0','json' => NULL,'created_at' => '2021-04-22 09:37:18','updated_at' => '2021-04-26 20:40:16'),
  array('id' => '97','tweet_id' => '1385172986710220804','tweet' => 'RT @BheeshmaTalks: Superstar #MaheshBabu has self isolates himself in after his personal stylist tested positive for #COVID19 on the sets o…','tweet_timestamp' => '2021-04-22 10:05:49','avatar' => '','username' => 'pavan_kankatala','fullname' => 'Pavan kankatala','status' => '6','retweeted' => '0','json' => NULL,'created_at' => '2021-04-22 10:05:56','updated_at' => '2021-04-26 20:40:16'),
  array('id' => '98','tweet_id' => '1385172987142283272','tweet' => 'RT @Omirrorivy: this is what is happening in India right now.
(This video might be triggering for some people but it\'s just the tip of the…','tweet_timestamp' => '2021-04-22 10:05:50','avatar' => '','username' => 'DevSury54230939','fullname' => 'Dev Suryavanshi','status' => '6','retweeted' => '0','json' => NULL,'created_at' => '2021-04-22 10:05:58','updated_at' => '2021-04-26 20:40:16'),
  array('id' => '99','tweet_id' => '1385172987998097408','tweet' => 'RT @Percolator_HNJ: Even voor de duidelijkheid. Ik vind dat ieder mens de vrije keuze moet hebben om zich te laten vaccineren tegen #covid1…','tweet_timestamp' => '2021-04-22 10:05:50','avatar' => '','username' => 'awareness881','fullname' => '\'Rechts\' door Zee🇳🇱','status' => '6','retweeted' => '0','json' => NULL,'created_at' => '2021-04-22 10:05:59','updated_at' => '2021-04-26 20:40:16'),
  array('id' => '100','tweet_id' => '1385172989826592771','tweet' => 'company trip postpone lo','tweet_timestamp' => '2021-04-22 10:05:50','avatar' => '','username' => 'JamalThaRebel','fullname' => 'Hamba Picisan','status' => '6','retweeted' => '0','json' => NULL,'created_at' => '2021-04-22 10:05:59','updated_at' => '2021-04-26 20:40:16'),
  array('id' => '101','tweet_id' => '1385172990430572544','tweet' => 'RT @Thyview: #COVID19 Second strain is hitting people very hard

Please Wear mask all the time &amp; take necessary Precautions 🙏

Stay Safe Ev…','tweet_timestamp' => '2021-04-22 10:05:50','avatar' => '','username' => 'TammaChanikya','fullname' => 'sai____1609','status' => '6','retweeted' => '0','json' => NULL,'created_at' => '2021-04-22 10:06:02','updated_at' => '2021-04-26 20:41:13'),
  array('id' => '102','tweet_id' => '1385172989981847552','tweet' => 'RT @Nabiha_drdz: Plasma Donors Available In Ahmedabad

#Ahmedabad
#PlasmaDonor #COVIDSecondWaveInIndia #COVID19 https://t.co/6dmKMxOLmn','tweet_timestamp' => '2021-04-22 10:05:50','avatar' => '','username' => 'RupsaPramanikDZ','fullname' => 'Rupsa Pramanik |Check pinned for COVID Help','status' => '6','retweeted' => '0','json' => NULL,'created_at' => '2021-04-22 10:06:02','updated_at' => '2021-04-26 20:41:13'),
  array('id' => '103','tweet_id' => '1385172990694879235','tweet' => 'RT @DrEricDing: I cry for the India 🇮🇳. Brutal epidemic ravaging the country, and hospitals are completely overwhelmed. A staggering 300,00…','tweet_timestamp' => '2021-04-22 10:05:50','avatar' => 'https://abs.twimg.com/images/themes/theme19/bg.gif','username' => 'charlymorenog','fullname' => 'Charly Moreno','status' => '6','retweeted' => '0','json' => NULL,'created_at' => '2021-04-22 10:06:02','updated_at' => '2021-04-26 20:40:17'),
  array('id' => '104','tweet_id' => '1385172991302983680','tweet' => 'RT @Sootradhar: 🤦 Tarun Tejpal, Varavara Rao types get bail but arrest smokers 🤦

Indian Judiciary is cutting a sorry figure https://t.co/4…','tweet_timestamp' => '2021-04-22 10:05:51','avatar' => '','username' => 'ub3rc','fullname' => 'YARG','status' => '6','retweeted' => '0','json' => NULL,'created_at' => '2021-04-22 10:06:02','updated_at' => '2021-04-26 20:40:17'),
  array('id' => '105','tweet_id' => '1385172991890399233','tweet' => 'RT @MinEcoFinanzas: #Conoce || Balance Diario de la Comisión Presidencial para la Atención, Prevención y Control del #COVID19.

#PrevenirPo…','tweet_timestamp' => '2021-04-22 10:05:51','avatar' => '','username' => 'OnipcC','fullname' => 'Micke.C.ONIPC RGZ','status' => '6','retweeted' => '0','json' => NULL,'created_at' => '2021-04-22 10:06:02','updated_at' => '2021-04-26 20:40:17')
  );

    foreach($twitters as $twitter) {
        $tweet = new Twitter;
        $tweet->tweet_id = $twitter['tweet_id'];
        $tweet->tweet = $twitter['tweet'];
        $tweet->tweet_timestamp = $twitter['tweet_timestamp'];
        $tweet->avatar = $twitter['avatar'];
        $tweet->username = $twitter['username'];
        $tweet->fullname = $twitter['fullname'];
        $tweet->fullname = $twitter['fullname'];
        $tweet->status = 0;
        $tweet->json = null;
        $tweet->save();
    }

    $this->command->info('Total tweets: '.count($twitters));

    }
}
