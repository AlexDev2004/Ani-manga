const classifs = ["Shonen","Seinen","Shojo","Josei","Kodomo"];

const genres = [
    ["Action","../img/genres/action.jpg"],
    ["Aventure","../img/genres/aventure.png"],
    ["Comédie","../img/genres/comedie.jpg"],
    ["Drame","../img/genres/drame.jpg"],
    ["Ecchi","../img/genres/ecchi.jpg"],
    ["Fantastique","../img/genres/fantasy.jpg"],
    ["Horreur","../img/genres/horreur.jpg"],
    ["Isekai","../img/genres/isekai.jpg"],
    ["Nekketsu","../img/genres/nekketsu.jpg"],
    ["Psychologique","../img/genres/psychologique.jpg"],
    ["Romance","../img/genres/romance.jpg"],
    ["Slice of Life","../img/genres/sliceOfLife.jpg"],
    ["Science-Fiction","../img/genres/sciencesFiction.jpg"],
    ["Surnaturel","../img/genres/surnaturel.jpg"],
    ["Thriller","../img/genres/thriller.jpg"]
];

const themes = [
    "Adolescence","Aliens / Extra-terrestres","Amitié","Amour","Animaux","Arcade","Arts martiaux","Assassinat","Autre monde",
    "Badminton","Bains","Basketball",
    "Club","Combats","Comédie musicale","Compétition","Crime","Cross-play",
    "Détective","Dragons",
    "École","Espionnage",
    "Famille","Fantômes","Futur",
    "Gastronomie","Gore","Guerre",
    "Harem","Homme au foyer","Homme-Bête",
    "Identité","Jeux-vidéo","LGBT+",
    "Magie","Maid","Malédiction","Mariage","Médium","Mensonges","Monde virtuel","Mort","Monstres","Musique","Mystère",
    "Organnisations secrètes","Otaku",
    "Poésie","Police","Politique","Post-apocalyptique","Pouvoirs psychiques",
    "Réincarnation",
    "School life","Scientifique","Shinigami","Shôjo-aï","Solitude","Sorcellerie","Société","Sources chaudes","Sport","Super pouvoirs","Survie","Survival game",
    "Tabac","Terrorisme","Tragique","Transformation","Travail",
    "Vengeance","Voyage temporel",
    "Yakuza","Yuri",
];

const auteurs = [
    {nom: "Aigamo Hiroyuki", image: "../img/auteurs/AigamoHiroyuki.jpg", historique: `Hiroyuki Aigamo est une illustratrice et mangaka japonaise . Bien qu'il s'agisse d'un pseudonyme masculin, elle est une femme. Elle était auparavant affiliée au groupe SNE et, depuis octobre 2020, elle en est membre associée. [ 1 ] Elle est la fondatrice et associée principale du collectif de créateurs DucQrews LLC . [ 2 ]
Parmi ses œuvres figure l'adaptation en bande dessinée d'Accel World ".`, link: `https://ja.wikipedia.org/wiki/%E5%90%88%E9%B4%A8%E3%81%B2%E3%82%8D%E3%82%86%E3%81%8D`},
    {nom: "Kawahara Reki", image: "../img/auteurs/KawaharaReki.jpg", historique: `Reki Kawahara a écrit le premier volume de Sword Art Online en 2002 et l'a présenté au Prix du roman de jeu Dengeki (電撃ゲーム小説大賞, Dengeki Game Shōsetsu Taishō?, désormais appelé Grand prix du roman Dengeki) mais le projet a été refusé car il dépassait le nombre de pages limite. Il l'a alors publié sur Internet sous le pseudonyme Fumio Kunori. En 2008, il participe de nouveau à la compétition avec son roman Accel World et a gagné le Grand prix. En plus de ce roman, l'éditeur ASCII Media Works a demandé à Reki Kawahara de reprendre son ancien projet, Sword Art Online, ce qu'il a accepté. La publication a alors commencé en avril 2009. L'auteur a également publié une série dérivée nommée Sword Art Online: Progressive.
En 2012, ses deux séries ont été adaptées en anime, Accel World à partir du 6 avril 2012 et Sword Art Online à partir du 7 juillet 2012. Reki double le personnage Tin Writer dans l’anime Accel World.
En 2014 est publié Zettai Naru Kodoku (Absolute Solitude), un light novel que l'auteur publiait sur son site personnel tout comme Sword Art Online.`, link: `https://fr.wikipedia.org/wiki/Reki_Kawahara`},
    {nom: "Nakamura Tamako", image: "../img/auteurs/blank.jpg", historique: `Tamako Nakamura est une mangaka japonaise.`, link: `https://www.nautiljon.com/people/nakamura+tamako.html`},
    // {nom: "", image: "", historique: ``, link: ``},
    // {nom: "", image: "", historique: ``, link: ``},
    // {nom: "", image: "", historique: ``, link: ``},
    // {nom: "", image: "", historique: ``, link: ``},
    // {nom: "", image: "", historique: ``, link: ``},
    // {nom: "", image: "", historique: ``, link: ``},
];

const editeurs = [
    {nom: "Ototo", image: "../img/editeurs/Ototo.jpg", historique: `Ototo est une maison d'édition française spécialisée dans le manga. Elle est créée en novembre 2011 par la société Euphor pour assurer la publication des mangas shōjo, shōnen et seinen, laissant les titres yaoi, yuri et hentai à Taifu Comics. Elle édite notamment plusieurs adaptations manga de light novel comme Sword Art Online ou Re:Zero.`, link: `https://fr.wikipedia.org/wiki/Ototo`},
    // {nom: "", image: "../img/editeurs/.jpg", historique: ``, link: ``},
    // {nom: "", image: "../img/editeurs/.jpg", historique: ``, link: ``},
    // {nom: "", image: "../img/editeurs/.jpg", historique: ``, link: ``},
    // {nom: "", image: "../img/editeurs/.jpg", historique: ``, link: ``},
    // {nom: "", image: "../img/editeurs/.jpg", historique: ``, link: ``},
    // {nom: "", image: "../img/editeurs/.jpg", historique: ``, link: ``},
];

const studios = [
    {nom: "A-1 Pictures", image: "../img/studios/A-1Pictures.jpg", historique: `A-1 Pictures Inc. (株式会社エー・ワン・ピクチャーズ, Kabushiki gaisha Ē Wan Pikuchāzu?) est un studio d'animation japonaise, filiale d'Aniplex, fondé en mai 2005.`, link: `https://fr.wikipedia.org/wiki/A-1_Pictures`},
    {nom: "Studio Bind", image: "../img/studios/StudioBind.jpg", historique: `Studio Bind est un studio d'animation japonais fondé en novembre 2018 grâce à un investissement conjoint de WHITE FOX et d' EGG FIRM . Son président est Ōtomo Hisaya, anciennement de 8-bit, et son siège social est situé dans l'arrondissement de Suginami, à Tokyo, avec un capital social de 5 millions de yens. La société a été créée dans le but de systématiser la promotion du projet d'adaptation en anime du light novel populaire « Mushoku Tensei : Réincarnation en chômeur ». En intégrant l'expérience de production de WHITE FOX et les capacités de planification d'EGG FIRM, elle vise à établir un système de production à long terme axé sur une seule propriété intellectuelle, s'efforçant ainsi de garantir la qualité des œuvres face à la tendance à la production de masse dans l'industrie de l'animation.`, link: `https://baike.baidu.com/fr/item/Studio%20Bind/1281941`},
    {nom: "SUNRISE", image: "../img/studios/Sunrise.jpg", historique: `Sunrise (サンライズ, Sanraizu?) est un studio d'animation japonaise, fondé en septembre 1972 et filiale depuis 1994 de Bandai.
Le studio a produit et animé de nombreuses séries comme Nicky Larson, Vision d'Escaflowne, Cowboy Bebop, Inu-Yasha, Gintama, Code Geass mais est aussi à l'origine de la grande saga des Gundam.`, link: `https://fr.wikipedia.org/wiki/Sunrise_(studio)`},
    // {nom: "", image: "../img/studios/.jpg", historique: ``, link: ``},
    // {nom: "", image: "../img/studios/.jpg", historique: ``, link: ``},
    // {nom: "", image: "../img/studios/.jpg", historique: ``, link: ``},
    // {nom: "", image: "../img/studios/.jpg", historique: ``, link: ``},
    // {nom: "", image: "../img/studios/.jpg", historique: ``, link: ``},
];

const diffusions = [
    {nom: "ADN", image: "../img/diffusions/ADN.jpg", historique: `Animation Digital Network, abrégé ADN, anciennement Anime Digital Network, est une plate-forme de VoD et simulcast née de la fusion entre KZPlay, appartenant à Kazé, et Genzai, appartenant à Kana Home Video, ayant pour thématique la diffusion de séries et longs métrages d'animation japonaise et franco-belge.`, link: `https://fr.wikipedia.org/wiki/Animation_Digital_Network`},
    {nom: "Crunchyroll", image: "../img/diffusions/Crunchyroll.jpg", historique: `Crunchyroll est un service de vidéo à la demande américain par abonnement appartenant à Sony Corporation. Le service distribue principalement des films et des séries télévisées produits par des médias d'Asie de l'Est, y compris des dessins animés japonais. Crunchyroll édite également des mangas et des jeux mobiles. Lancé mi-2006 par un groupe d'étudiants diplômés de l'Université de Californie à Berkeley en 2006, les services de Crunchyroll se sont progressivement développés pour compter plus de 100 millions d'utilisateurs enregistrés, répartis dans plus de 200 pays ou territoires à travers le monde, dont quatre millions d'utilisateurs abonnés.`, link: `https://fr.wikipedia.org/wiki/Crunchyroll`},
    {nom: "Netflix", image: "../img/diffusions/Netflix.jpg", historique: `Netflix est une entreprise internationale américaine active dans le secteur de l'industrie du divertissement. Fondé en 1997 à Scotts Valley (Santa Cruz) par Reed Hastings et Marc Randolph, le groupe est spécialisé dans la distribution et l'exploitation d'œuvres cinématographiques et télévisuelles, notamment par le biais d'une plateforme destinée au service de vidéo à la demande. Son siège social se situe à Los Gatos en Californie. Initialement, l'entreprise est uniquement présente dans le secteur de l'exploitation commerciale, par la fourniture d'un service en ligne de location et d'achat de DVD, livrés à domicile. Elle propose ensuite la location de ces vidéos, moyennant un abonnement mensuel. Le service de vidéo à la demande par abonnement est lancé en 2007. Depuis, l'entreprise s'est lancée dans la distribution d'un grand nombre de films et de séries télévisées ainsi que de créations originales, auxquelles elle consacre des investissements importants.`, link: `https://fr.wikipedia.org/wiki/Netflix`},
    // {nom: "", image: "../img/diffusions/.jpg", historique: ``, link: ``},
    // {nom: "", image: "../img/diffusions/.jpg", historique: ``, link: ``},
    // {nom: "", image: "../img/diffusions/.jpg", historique: ``, link: ``},
    // {nom: "", image: "../img/diffusions/.jpg", historique: ``, link: ``},
    // {nom: "", image: "../img/diffusions/.jpg", historique: ``, link: ``},
];  