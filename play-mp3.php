<?php

header("Access-Control-Allow-Origin: *");

$musicString = '[
					{
						"play":"https://res.cloudinary.com/dqluxvgsf/video/upload/v1516531158/Burak_Yeter_-_Tuesday_ft._Danelle_Sandoval_z5pfzq.mp3",
						
						"name" : "Tuesday feat burak"
					},
					{
						"play":"https://res.cloudinary.com/dqluxvgsf/video/upload/v1516526726/Imagine_Dragons_-_Believer_Mp3Converter.net_odfw3e.mp3",
						
						"name" : "Imagine dragon - believer"
					},
					{
						"play":"https://res.cloudinary.com/dqluxvgsf/video/upload/v1516526431/Alan_Walker_-_All_Falls_Down_feat._Noah_Cyrus_with_Digital_Farm_Animals_ag6xov.mp3",
						
						"name" : "Alan walker - All falls down"
					},
					{
						"play":"https://res.cloudinary.com/dqluxvgsf/video/upload/v1516526186/Selena_Gomez_Marshmello_-_Wolves_mli2vv.mp3",
						
						"name" : "selena gomez - marshmello"
					},
					{
						"play":"https://res.cloudinary.com/dqluxvgsf/video/upload/v1516526018/Camila_Cabello_-_Havana_ft._Young_Thug_TULE_Remix_j0aved.mp3",
						
						"name" : "Camila cabello - Havana"
					},
					{
						"play":"https://res.cloudinary.com/dqluxvgsf/video/upload/v1516525839/The_Chainsmokers_-_All_We_Know_ft._Phoebe_Ryan_Jaydon_Lewis_NGO_Remix_i2vnw9.mp3",
						
						"name" : "The chainsmoker - All we know"
					},
					{
						"play":"https://res.cloudinary.com/dqluxvgsf/video/upload/v1516525665/Axwell_Ingrosso_-_Dreamer_ft._Trevor_Guthrie_Lyric_Video_nodvrj.mp3",
						
						"name" : "Axwell Ingrosso - Dreamer"
					},
					{
						"play":"https://res.cloudinary.com/dqluxvgsf/video/upload/v1516525380/The_Chainsmokers_-_Roses_Lyric_Video_ft._ROZES_cnm6d1.mp3",
						
						"name" : "The Chainsmoker - Rose"
					},
					{
						"play":"https://res.cloudinary.com/dqluxvgsf/video/upload/v1516524454/The_Chainsmokers_-_Dont_Let_Me_Down_Illenium_Remix_iazicc.mp3",
						
						"name" : "The Chainsmoker - don\'t let me down"
					},
					{
						"play":"https://res.cloudinary.com/dqluxvgsf/video/upload/v1516524239/Tom_Odell_-_Another_Love_Zwette_Edit_szbncx.mp3",
						
						"name" : "Tom odell - Another love"
					},
					{
						"play":"https://res.cloudinary.com/dqluxvgsf/video/upload/v1516524105/Sia_-_Cheap_Thrills_ft._Sean_Paul_Muffin_Remix_mqff1l.mp3",
						
						"name" : "Sia - Cheap thrills"
					},
					{
						"play":"https://res.cloudinary.com/dqluxvgsf/video/upload/v1516523978/Charlie_Puth_-_We_Dont_Talk_Anymore_ft._Selena_Gomez_BOXINLION_Remix_uvr8kw.mp3",
						
						"name" : "Charlie puth - We don\'t talk anymore"
					},
					{
						"play":"https://res.cloudinary.com/dqluxvgsf/video/upload/v1516523752/Clean_Bandit_-_Rockabye_ft._Sean_Paul_Anne-Marie_SHAKED_Remix_pnlh0f.mp3",
						
						"name" : "Clean bandit - Rockabye"
					},
					{
						"play":"https://res.cloudinary.com/dqluxvgsf/video/upload/v1516523595/Alan_Walker_Baby_Dont_Go_feat_Kelly_Clarkson_Official_Video_bjpcu0.mp3",
						
						"name" : "Alan walker - Baby don\'t go"
					},
					{
						"play":"https://res.cloudinary.com/dqluxvgsf/video/upload/v1516523317/Alan_Walker_-_The_Spectre_j1jlbj.mp3",
						
						"name" : "Alan walker - The Spectre"
					},
					{
						"play":"https://res.cloudinary.com/dqluxvgsf/video/upload/v1516523104/Imagine_Dragons_-_Whatever_It_Takes_l7mrrk.mp3",
						
						"name" : "Imagine dragons - Whatever it takes"
					},
					{
						"play":"https://res.cloudinary.com/dqluxvgsf/video/upload/v1516522845/ROBIN_SCHULZ_HUGEL_-_I_BELIEVE_IM_FINE_OFFICIAL_MUSIC_VIDEO_gj2ins.mp3",
						
						"name" : "Robin schulz - I believe I am fine"
					},
					{
						"play":"https://res.cloudinary.com/dqluxvgsf/video/upload/v1516522479/Jennifer_Lopez_-_On_The_Floor_ft._Pitbull_hbzbcm.mp3",
						
						"name" : "Jennifer lopez - On the floor"
					},
					{
						"play":"https://res.cloudinary.com/dqluxvgsf/video/upload/v1516522249/Lady_Gaga_-_Alejandro_tjjvlr.mp3",
						
						"name" : "Lady gaga - Alejandro"
					},
					{
						"play":"https://res.cloudinary.com/dqluxvgsf/video/upload/v1516522036/what_is_love_fftict.mp3",
						
						"name" : "What is love"
					},
					{
						"play":"https://res.cloudinary.com/dqluxvgsf/video/upload/v1520400970/Kygo_-_First_Time_tgxgqe.mp3",
						
						"name" : "Kygo first time"
					},
					{
						"play":"https://res.cloudinary.com/dqluxvgsf/video/upload/v1520401076/Lana_Del_Rey_-_Lust_For_Life_Official_Video_ft._The_Weeknd_gwjjwu.mp3",
						
						"name" : "Lush for life"
					},
					{
						"play":"https://res.cloudinary.com/dqluxvgsf/video/upload/v1520401163/Andra_-_Why_Official_Video_cg41x1.mp3",
						
						"name" : "Andra why"
					},
					{
						"play":"https://res.cloudinary.com/dqluxvgsf/video/upload/v1520856545/ROCKABYE_-_Clean_Bandit_Shirley_Setia_KHS_COVER_in_the_IGNIS_ur5vvn.mp3",
						
						"name" : "Clean bandit = remix"
					},
					{
						"play":"https://res.cloudinary.com/dqluxvgsf/video/upload/v1520843543/ROBIN_SCHULZ_MARC_SCIBILIA_-_UNFORGETTABLE_OFFICIAL_VIDEO_c48gzv.mp3",
						
						"name" : "ROBIN SCHULZ MARC SCIBILIA"
					},
					{
						"play":"https://res.cloudinary.com/dqluxvgsf/video/upload/v1521286965/Edward_Maya_Vika_Jigulina_-_Stereo_Love_Jay_Latune_Remix_p2yqwx.mp3",
						
						"name" : "Edward Maya Vika Jigulina - Stereo love"
					},
					{
						"play":"https://res.cloudinary.com/dqluxvgsf/video/upload/v1521290747/Legends_Never_Die_Alan_Walker_Remix_Worlds_2017_-_League_of_Legends_Mp3Converter.net_oo4i6u.mp3",
						
						"name" : "Legends Never Die"
					}
				]';

			$arrayJson = json_decode($musicString, true);

			$one_item = $arrayJson[rand(0, count($arrayJson) - 1)];

			$one_item_string = json_encode($one_item);

			echo '['.$one_item_string.']';
			exit;

?>