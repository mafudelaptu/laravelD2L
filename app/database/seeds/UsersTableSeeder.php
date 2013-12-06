<?php

class UsersTableSeeder extends Seeder {

	public function run()
	{
		// Uncomment the below to wipe the table clean before populating
		 DB::table('users')->truncate();

		$users = array(

		);
		DB::select("INSERT INTO `users` VALUES 
			(76561198047012055, 'Mafu','http://media.steampowered.com/steamcommunity/public/images/avatars/a8/a8c1093d2282814559152587c9cf08226a100d82.jpg','http://media.steampowered.com/steamcommunity/public/images/avatars/a8/a8c1093d2282814559152587c9cf08226a100d82_full.jpg',1,1200,1386332036,0,1,'2013-12-06 13:54:50','2013-12-06 13:54:50'),
			(76561198047090512,'Ã…Â eid','http://media.steampowered.com/steamcommunity/public/images/avatars/8f/8f44feaff2752b9e8d2def8fe91a10e5f2611302.jpg','http://media.steampowered.com/steamcommunity/public/images/avatars/8f/8f44feaff2752b9e8d2def8fe91a10e5f2611302full.jpg',0,1200,1386332036,0,1,'2013-12-02 18:52:34','2013-12-02 18:52:34'

),
(76561198053022025,'ReiGnNn','http://media.steampowered.com/steamcommunity/public/images/avatars/fe/fef49e7fa7e1997310d705b2a6158ff8dc1cdfeb.jpg','http://media.steampowered.com/steamcommunity/public/images/avatars/fe/fef49e7fa7e1997310d705b2a6158ff8dc1cdfebfull.jpg',0,1200,1386332036,0,1,'2013-12-02 18:52:34','2013-12-02 18:52:34'

),
(76561197981132932,'Oi.Cheat0ff','http://media.steampowered.com/steamcommunity/public/images/avatars/55/5543fadc54659a7b12c68606f8966aaf20789c94.jpg','http://media.steampowered.com/steamcommunity/public/images/avatars/55/5543fadc54659a7b12c68606f8966aaf20789c94full.jpg',0,1200,1386332036,0,1,'2013-12-02 18:52:34','2013-12-02 18:52:34'

),
(76561198069231042,'[WPY].IAlwaysPlayNaked','http://media.steampowered.com/steamcommunity/public/images/avatars/07/0716af2592e8f382c8d57d610ebd46837d96402a.jpg','http://media.steampowered.com/steamcommunity/public/images/avatars/07/0716af2592e8f382c8d57d610ebd46837d96402afull.jpg',0,1200,1386332036,0,1,'2013-12-02 18:52:34','2013-12-02 18:52:34'

),
(76561197985307740,'AllEyesOn','http://media.steampowered.com/steamcommunity/public/images/avatars/05/057775d1a7dc2da69f23c150064a4cf0f8cc2a79.jpg','http://media.steampowered.com/steamcommunity/public/images/avatars/05/057775d1a7dc2da69f23c150064a4cf0f8cc2a79full.jpg',0,1200,1386332036,0,1,'2013-12-02 18:52:34','2013-12-02 18:52:34'

),
(76561198004601307,'Cpt.Spaghetti','http://media.steampowered.com/steamcommunity/public/images/avatars/ec/ecb7fd4d76cea2bfacfeb0be77fc9697942e4389.jpg','http://media.steampowered.com/steamcommunity/public/images/avatars/ec/ecb7fd4d76cea2bfacfeb0be77fc9697942e4389full.jpg',0,1200,1386332036,0,1,'2013-12-02 18:52:34','2013-12-02 18:52:34'

),
(76561198037624230,'WhiTe*Wolf','http://media.steampowered.com/steamcommunity/public/images/avatars/3e/3ef7f1b73aa8216a6a41887064b3f5c9075ad5e5.jpg','http://media.steampowered.com/steamcommunity/public/images/avatars/3e/3ef7f1b73aa8216a6a41887064b3f5c9075ad5e5full.jpg',0,1200,1386332036,0,1,'2013-12-02 18:52:34','2013-12-02 18:52:34'

),
(76561198054599044,'massiv','http://media.steampowered.com/steamcommunity/public/images/avatars/38/380009301f4898344b92934a2acf9b578663d94d.jpg','http://media.steampowered.com/steamcommunity/public/images/avatars/38/380009301f4898344b92934a2acf9b578663d94dfull.jpg',0,1200,1386332036,0,1,'2013-12-02 18:52:34','2013-12-02 18:52:34'

),
(76561198059055572,'LPK1NGZ  ÃƒÂ¢Ã¢â€žÂ¢Ã¢â‚¬Âº  Crosis','http://media.steampowered.com/steamcommunity/public/images/avatars/ba/ba8fcd05048596620ccd6fd9d8e6547aa9653d5b.jpg','http://media.steampowered.com/steamcommunity/public/images/avatars/ba/ba8fcd05048596620ccd6fd9d8e6547aa9653d5bfull.jpg',0,1200,1386332036,0,1,'2013-12-02 18:52:34','2013-12-02 18:52:34'

),
(76561198038124079,'^^','http://media.steampowered.com/steamcommunity/public/images/avatars/f9/f900e13255ad20af640d5edfac0414b6d28a157c.jpg','http://media.steampowered.com/steamcommunity/public/images/avatars/f9/f900e13255ad20af640d5edfac0414b6d28a157cfull.jpg',0,1200,1386332036,0,1,'2013-12-02 18:52:34','2013-12-02 18:52:34'

),
(76561198070613067,'Nico Nicolas Nico','http://media.steampowered.com/steamcommunity/public/images/avatars/d6/d65e61da90ff9fb9fef9b7c2b3cd55b91d4c81e0.jpg','http://media.steampowered.com/steamcommunity/public/images/avatars/d6/d65e61da90ff9fb9fef9b7c2b3cd55b91d4c81e0full.jpg',0,1200,1386332036,0,1,'2013-12-02 18:52:34','2013-12-02 18:52:34'

),
(76561198068123829,'FireSlayer','http://media.steampowered.com/steamcommunity/public/images/avatars/4c/4cac4c8e55c07232fc11fa9fefb87254d4b169d2.jpg','http://media.steampowered.com/steamcommunity/public/images/avatars/4c/4cac4c8e55c07232fc11fa9fefb87254d4b169d2full.jpg',0,1200,1386332036,0,1,'2013-12-02 18:52:34','2013-12-02 18:52:34'

),
(76561198045110502,'HosÃƒÂ© im Urin Yo','http://media.steampowered.com/steamcommunity/public/images/avatars/fd/fd1bbd5ad7836b716c3d5d0abfbbc1d276b14134.jpg','http://media.steampowered.com/steamcommunity/public/images/avatars/fd/fd1bbd5ad7836b716c3d5d0abfbbc1d276b14134full.jpg',0,1200,1386332036,0,1,'2013-12-02 18:52:34','2013-12-02 18:52:34'

),
(76561198058696036,'@DelavDota2','http://media.steampowered.com/steamcommunity/public/images/avatars/50/50a7ce4d532ebafbc62e902c39002b36807c3629.jpg','http://media.steampowered.com/steamcommunity/public/images/avatars/50/50a7ce4d532ebafbc62e902c39002b36807c3629full.jpg',0,1200,1386332036,0,1,'2013-12-02 18:52:34','2013-12-02 18:52:34'

),
(76561198065834339,'Ã¢â€žÂ¢DuC[VnÃ‚Â®___','http://media.steampowered.com/steamcommunity/public/images/avatars/02/0298f55be7a9cde0fe9369d99b990117470177f3.jpg','http://media.steampowered.com/steamcommunity/public/images/avatars/02/0298f55be7a9cde0fe9369d99b990117470177f3full.jpg',0,1200,1386332036,0,1,'2013-12-02 18:52:34','2013-12-02 18:52:34'

),
(76561198004433906,'[ESP*] Valiant','http://media.steampowered.com/steamcommunity/public/images/avatars/3e/3e4c6e1f6a517235b5f7d8230d4376edb92cc955.jpg','http://media.steampowered.com/steamcommunity/public/images/avatars/3e/3e4c6e1f6a517235b5f7d8230d4376edb92cc955full.jpg',0,1200,1386332036,0,1,'2013-12-02 18:52:34','2013-12-02 18:52:34'

),
(76561198002660146,'IN$','http://media.steampowered.com/steamcommunity/public/images/avatars/df/df89576b0cb210ee654212fbe98e1350c45656c2.jpg','http://media.steampowered.com/steamcommunity/public/images/avatars/df/df89576b0cb210ee654212fbe98e1350c45656c2full.jpg',0,1200,1386332036,0,1,'2013-12-02 18:52:34','2013-12-02 18:52:34'

),
(76561198047446432,'benizakura Ã¡Â¶Â Ã¡Â¶Â¸Ã¡Â¶Å“Ã¡ÂµÂ?Ã¡ÂµÂ§Ã¢â€šâ€™Ã¡ÂµÂ¤Ã£Æ’â€ž','http://media.steampowered.com/steamcommunity/public/images/avatars/1e/1ed336b5b67fa8b754dfb786260e8432367840fa.jpg','http://media.steampowered.com/steamcommunity/public/images/avatars/1e/1ed336b5b67fa8b754dfb786260e8432367840fafull.jpg',0,1200,1386332036,0,1,'2013-12-02 18:52:34','2013-12-02 18:52:34'

),
(76561198035337283,'Prosafe','http://media.steampowered.com/steamcommunity/public/images/avatars/dd/dde684c50090fc10c6f88555924434793c7ad4bd.jpg','http://media.steampowered.com/steamcommunity/public/images/avatars/dd/dde684c50090fc10c6f88555924434793c7ad4bdfull.jpg',0,1200,1386332036,0,1,'2013-12-02 18:52:34','2013-12-02 18:52:34'

),
(76561198029442897,'KunG','http://media.steampowered.com/steamcommunity/public/images/avatars/27/27a3163804632b4a6a7587ffcb99bf342d5973fa.jpg','http://media.steampowered.com/steamcommunity/public/images/avatars/27/27a3163804632b4a6a7587ffcb99bf342d5973fafull.jpg',0,1200,1386332036,0,1,'2013-12-02 18:52:34','2013-12-02 18:52:34'

),
(76561198045956581,'MicroKiss','http://media.steampowered.com/steamcommunity/public/images/avatars/4c/4c76064be169987500e4c7e228aabe3e33e1df47.jpg','http://media.steampowered.com/steamcommunity/public/images/avatars/4c/4c76064be169987500e4c7e228aabe3e33e1df47full.jpg',0,1200,1386332036,0,1,'2013-12-02 18:52:34','2013-12-02 18:52:34'

),
(76561198042039381,'player','http://media.steampowered.com/steamcommunity/public/images/avatars/f8/f8de58eb18a0cad87270ef1d1250c574498577fc.jpg','http://media.steampowered.com/steamcommunity/public/images/avatars/f8/f8de58eb18a0cad87270ef1d1250c574498577fcfull.jpg',0,1200,1386332036,0,1,'2013-12-02 18:52:34','2013-12-02 18:52:34'

),
(76561198029048138,'Trixie','http://media.steampowered.com/steamcommunity/public/images/avatars/b7/b7a1ae1222b47a3ce74b5309f34f8715367569e2.jpg','http://media.steampowered.com/steamcommunity/public/images/avatars/b7/b7a1ae1222b47a3ce74b5309f34f8715367569e2full.jpg',0,1200,1386332036,0,1,'2013-12-02 18:52:34','2013-12-02 18:52:34'

),
(76561197998170674,'Nuplajkz','http://media.steampowered.com/steamcommunity/public/images/avatars/ec/ec70c76c083ef0ea6fd0541ec32da8e204e8b0e5.jpg','http://media.steampowered.com/steamcommunity/public/images/avatars/ec/ec70c76c083ef0ea6fd0541ec32da8e204e8b0e5full.jpg',0,1200,1386332036,0,1,'2013-12-02 18:52:34','2013-12-02 18:52:34'

),
(76561198046989493,'ElPopelos','http://media.steampowered.com/steamcommunity/public/images/avatars/fe/fef49e7fa7e1997310d705b2a6158ff8dc1cdfeb.jpg','http://media.steampowered.com/steamcommunity/public/images/avatars/fe/fef49e7fa7e1997310d705b2a6158ff8dc1cdfeb_full.jpg',0,1200,1386332036,0,1,'2013-12-02 18:52:34','2013-12-02 18:52:34'

),
(76561198047032250,'^Patron^','http://media.steampowered.com/steamcommunity/public/images/avatars/2a/2a5769219ac882295ffd8c26c9b44f1721594d14.jpg','http://media.steampowered.com/steamcommunity/public/images/avatars/2a/2a5769219ac882295ffd8c26c9b44f1721594d14full.jpg',0,1200,1386332036,0,1,'2013-12-02 18:52:34','2013-12-02 18:52:34'

),
(76561198021469060,'[CSS]Pussywagon','http://media.steampowered.com/steamcommunity/public/images/avatars/fc/fc15db264892682c613a2d2233648bd5cd12bbad.jpg','http://media.steampowered.com/steamcommunity/public/images/avatars/fc/fc15db264892682c613a2d2233648bd5cd12bbadfull.jpg',0,1200,1386332036,0,1,'2013-12-02 18:52:34','2013-12-02 18:52:34'

),
(76561198002105997,'Ph]o[hx','http://media.steampowered.com/steamcommunity/public/images/avatars/0d/0d4620a94a17d2c7d08b00ace32b225c78a4791e.jpg','http://media.steampowered.com/steamcommunity/public/images/avatars/0d/0d4620a94a17d2c7d08b00ace32b225c78a4791efull.jpg',0,1200,1386332036,0,1,'2013-12-02 18:52:34','2013-12-02 18:52:34'

),
(76561198000851733,'WwD','http://media.steampowered.com/steamcommunity/public/images/avatars/45/45ba21785e8311d805ae35012e64e0a01c18f3fc.jpg','http://media.steampowered.com/steamcommunity/public/images/avatars/45/45ba21785e8311d805ae35012e64e0a01c18f3fcfull.jpg',0,1200,1386332036,0,1,'2013-12-02 18:52:34','2013-12-02 18:52:34'

),
(76561197989874562,'LuLatsch','http://media.steampowered.com/steamcommunity/public/images/avatars/43/43cb14b1aae4682ec6cadee9e4415824652efc16.jpg','http://media.steampowered.com/steamcommunity/public/images/avatars/43/43cb14b1aae4682ec6cadee9e4415824652efc16full.jpg',0,1200,1386332036,0,1,'2013-12-02 18:52:34','2013-12-02 18:52:34'

),
(76561197995716637,'Paticus Roth','http://media.steampowered.com/steamcommunity/public/images/avatars/22/22603b285e524814c2661f886b0a09788b68ac4c.jpg','http://media.steampowered.com/steamcommunity/public/images/avatars/22/22603b285e524814c2661f886b0a09788b68ac4cfull.jpg',0,1200,1386332036,0,1,'2013-12-02 18:52:34','2013-12-02 18:52:34'

),
(76561197989997771,'skvrko','http://media.steampowered.com/steamcommunity/public/images/avatars/fe/fef49e7fa7e1997310d705b2a6158ff8dc1cdfeb.jpg','http://media.steampowered.com/steamcommunity/public/images/avatars/fe/fef49e7fa7e1997310d705b2a6158ff8dc1cdfeb_full.jpg',0,1200,1386332036,0,1,'2013-12-02 18:52:34','2013-12-02 18:52:34'

),
(76561198008037671,'pong','http://media.steampowered.com/steamcommunity/public/images/avatars/fe/fef49e7fa7e1997310d705b2a6158ff8dc1cdfeb.jpg','http://media.steampowered.com/steamcommunity/public/images/avatars/fe/fef49e7fa7e1997310d705b2a6158ff8dc1cdfebfull.jpg',0,1200,1386332036,0,1,'2013-12-02 18:52:34','2013-12-02 18:52:34'

),
(76561197975157764,'TG. Akeldama','http://media.steampowered.com/steamcommunity/public/images/avatars/d7/d7eae4964e7bc1d32ffac664368691678b5e9cb8.jpg','http://media.steampowered.com/steamcommunity/public/images/avatars/d7/d7eae4964e7bc1d32ffac664368691678b5e9cb8full.jpg',0,1200,1386332036,0,1,'2013-12-02 18:52:34','2013-12-02 18:52:34'

),
(76561198015233022,'Venick8827','http://media.steampowered.com/steamcommunity/public/images/avatars/12/12d58969d151a914ab48d2ebb2acc5341e3f91f2.jpg','http://media.steampowered.com/steamcommunity/public/images/avatars/12/12d58969d151a914ab48d2ebb2acc5341e3f91f2full.jpg',0,1200,1386332036,0,1,'2013-12-02 18:52:34','2013-12-02 18:52:34'

),
(76561198038844848,'Rogesh','http://media.steampowered.com/steamcommunity/public/images/avatars/c9/c97e07d3992984471a7574c73295d32554792b02.jpg','http://media.steampowered.com/steamcommunity/public/images/avatars/c9/c97e07d3992984471a7574c73295d32554792b02full.jpg',0,1200,1386332036,0,1,'2013-12-02 18:52:34','2013-12-02 18:52:34'

),
(76561198058316058,'clap','http://media.steampowered.com/steamcommunity/public/images/avatars/f6/f6db15c4377bfd0ec95a0faf1a28136fe2d6d364.jpg','http://media.steampowered.com/steamcommunity/public/images/avatars/f6/f6db15c4377bfd0ec95a0faf1a28136fe2d6d364full.jpg',0,1200,1386332036,0,1,'2013-12-02 18:52:34','2013-12-02 18:52:34'

),
(76561197999849492,'natah187','http://media.steampowered.com/steamcommunity/public/images/avatars/2a/2a94515b5a185f8297c774d694bbb62d43a942df.jpg','http://media.steampowered.com/steamcommunity/public/images/avatars/2a/2a94515b5a185f8297c774d694bbb62d43a942dffull.jpg',0,1200,1386332036,0,1,'2013-12-02 18:52:34','2013-12-02 18:52:34'

),
(76561197990586193,'Ladel','http://media.steampowered.com/steamcommunity/public/images/avatars/50/506d0c9425934e42a2d6b794349b43c4dc148b6d.jpg','http://media.steampowered.com/steamcommunity/public/images/avatars/50/506d0c9425934e42a2d6b794349b43c4dc148b6dfull.jpg',0,1200,1386332036,0,1,'2013-12-02 18:52:34','2013-12-02 18:52:34'

),
(76561198008554398,'Franz','http://media.steampowered.com/steamcommunity/public/images/avatars/3b/3b398e00b8305845677b9730fe610e2cb9c91b93.jpg','http://media.steampowered.com/steamcommunity/public/images/avatars/3b/3b398e00b8305845677b9730fe610e2cb9c91b93full.jpg',0,1200,1386332036,0,1,'2013-12-02 18:52:34','2013-12-02 18:52:34'

),
(76561198065128622,'No.EsCaPe @ HearthStone','http://media.steampowered.com/steamcommunity/public/images/avatars/3b/3bac902b130a58eae5252ac80f9707eedb41532e.jpg','http://media.steampowered.com/steamcommunity/public/images/avatars/3b/3bac902b130a58eae5252ac80f9707eedb41532efull.jpg',0,1200,1386332036,0,1,'2013-12-02 18:52:34','2013-12-02 18:52:34'

),
(76561198053305105,'Shady.GG Kappa Keepo','http://media.steampowered.com/steamcommunity/public/images/avatars/5d/5d460a1b9995cc52beaaeccaf0d9a146af235994.jpg','http://media.steampowered.com/steamcommunity/public/images/avatars/5d/5d460a1b9995cc52beaaeccaf0d9a146af235994full.jpg',0,1200,1386332036,0,1,'2013-12-02 18:52:34','2013-12-02 18:52:34'

),
(76561198047073643,'Butterfly','http://media.steampowered.com/steamcommunity/public/images/avatars/f5/f5622d31c0e40d43488fd8a76f954abf077413e5.jpg','http://media.steampowered.com/steamcommunity/public/images/avatars/f5/f5622d31c0e40d43488fd8a76f954abf077413e5full.jpg',0,1200,1386332036,0,1,'2013-12-02 18:52:34','2013-12-02 18:52:34'

),
(76561198047128699,'TC | Sporting_SCP','http://media.steampowered.com/steamcommunity/public/images/avatars/a1/a1ad8e061f34e7f4f157fdc87f807868cffcc1d0.jpg','http://media.steampowered.com/steamcommunity/public/images/avatars/a1/a1ad8e061f34e7f4f157fdc87f807868cffcc1d0_full.jpg',0,1200,1386332036,0,1,'2013-12-02 18:52:34','2013-12-02 18:52:34'

),
(76561198047251069,'Yhenz','http://media.steampowered.com/steamcommunity/public/images/avatars/50/50118f141fcd05b4add9db1a7bae7cedfb031c20.jpg','http://media.steampowered.com/steamcommunity/public/images/avatars/50/50118f141fcd05b4add9db1a7bae7cedfb031c20full.jpg',0,1200,1386332036,0,1,'2013-12-02 18:52:34','2013-12-02 18:52:34'

),
(76561198053041930,'Yod[ÃƒÂ?@nTE]','http://media.steampowered.com/steamcommunity/public/images/avatars/63/63e130335c9c119a1fa8fb7947c8b83283e8adb2.jpg','http://media.steampowered.com/steamcommunity/public/images/avatars/63/63e130335c9c119a1fa8fb7947c8b83283e8adb2full.jpg',0,1200,1386332036,0,1,'2013-12-02 18:52:34','2013-12-02 18:52:34'

),
(76561197989436119,'GEMA.ab','http://media.steampowered.com/steamcommunity/public/images/avatars/fa/faa15b663d7f11dfb1fa3fef490c4899b7808e5c.jpg','http://media.steampowered.com/steamcommunity/public/images/avatars/fa/faa15b663d7f11dfb1fa3fef490c4899b7808e5cfull.jpg',0,1200,1386332036,0,1,'2013-12-02 18:52:34','2013-12-02 18:52:34'

),
(76561198049212341,'Masta.','http://media.steampowered.com/steamcommunity/public/images/avatars/f9/f93d4c1b9be2f5a736ef98e97d3125ed9134560d.jpg','http://media.steampowered.com/steamcommunity/public/images/avatars/f9/f93d4c1b9be2f5a736ef98e97d3125ed9134560dfull.jpg',0,1200,1386332036,0,1,'2013-12-02 18:52:34','2013-12-02 18:52:34'

),
(76561198048870734,'Avimux','http://media.steampowered.com/steamcommunity/public/images/avatars/2d/2d0f529e0bb6fc8548ec2438b9661a5bb625f1f6.jpg','http://media.steampowered.com/steamcommunity/public/images/avatars/2d/2d0f529e0bb6fc8548ec2438b9661a5bb625f1f6full.jpg',0,1200,1386332036,0,1,'2013-12-02 18:52:34','2013-12-02 18:52:34'

),
(76561198033607655,'@JtanDOTA','http://media.steampowered.com/steamcommunity/public/images/avatars/81/81ed6b245f0dc856045b4345547961d8425c5744.jpg','http://media.steampowered.com/steamcommunity/public/images/avatars/81/81ed6b245f0dc856045b4345547961d8425c5744full.jpg',0,1200,1386332036,0,1,'2013-12-02 18:52:34','2013-12-02 18:52:34'

),
(76561198051745050,'HaruMamberu','http://media.steampowered.com/steamcommunity/public/images/avatars/84/84a43fee3bb7ec9adc69516821e8b4019a8549e5.jpg','http://media.steampowered.com/steamcommunity/public/images/avatars/84/84a43fee3bb7ec9adc69516821e8b4019a8549e5full.jpg',0,1200,1386332036,0,1,'2013-12-02 18:52:34','2013-12-02 18:52:34'

),
(76561198032096273,'Kalle','http://media.steampowered.com/steamcommunity/public/images/avatars/ee/eef75511ba1f16b66e9ac45346e7c0f790a6551a.jpg','http://media.steampowered.com/steamcommunity/public/images/avatars/ee/eef75511ba1f16b66e9ac45346e7c0f790a6551afull.jpg',0,1200,1386332036,0,1,'2013-12-02 18:52:34','2013-12-02 18:52:34'

),
(76561198051637449,'iDez','http://media.steampowered.com/steamcommunity/public/images/avatars/45/45306e4aec362d8269b4baa87a32938e7f67e776.jpg','http://media.steampowered.com/steamcommunity/public/images/avatars/45/45306e4aec362d8269b4baa87a32938e7f67e776full.jpg',0,1200,1386332036,0,1,'2013-12-02 18:52:34','2013-12-02 18:52:34'

),
(76561198025034144,'SubZergling','http://media.steampowered.com/steamcommunity/public/images/avatars/99/99e98bb0d236ace5c1c5ed1be80a1bedd105bc08.jpg','http://media.steampowered.com/steamcommunity/public/images/avatars/99/99e98bb0d236ace5c1c5ed1be80a1bedd105bc08full.jpg',0,1200,1386332036,0,1,'2013-12-02 18:52:34','2013-12-02 18:52:34'

),
(76561198055559534,'@Swerve','http://media.steampowered.com/steamcommunity/public/images/avatars/09/099b6fc1f3f299ce9cdfc477fbe85d61782a4dd7.jpg','http://media.steampowered.com/steamcommunity/public/images/avatars/09/099b6fc1f3f299ce9cdfc477fbe85d61782a4dd7full.jpg',0,1200,1386332036,0,1,'2013-12-02 18:52:34','2013-12-02 18:52:34'

),
(76561198007075594,'Justin','http://media.steampowered.com/steamcommunity/public/images/avatars/96/961c73c3c45bbe48a9b1bf20bc97ffda671fb8ed.jpg','http://media.steampowered.com/steamcommunity/public/images/avatars/96/961c73c3c45bbe48a9b1bf20bc97ffda671fb8edfull.jpg',0,1200,1386332036,0,1,'2013-12-02 18:52:34','2013-12-02 18:52:34'

),
(76561198006223194,'Lust','http://media.steampowered.com/steamcommunity/public/images/avatars/ab/abb8fe0b85ccbd27ada6ff54eb49dcbd940d151a.jpg','http://media.steampowered.com/steamcommunity/public/images/avatars/ab/abb8fe0b85ccbd27ada6ff54eb49dcbd940d151afull.jpg',0,1200,1386332036,0,1,'2013-12-02 18:52:34','2013-12-02 18:52:34'

),
(76561198051022670,'Ignis','http://media.steampowered.com/steamcommunity/public/images/avatars/74/748554047c307b431bc1501ba956c0798c7f5075.jpg','http://media.steampowered.com/steamcommunity/public/images/avatars/74/748554047c307b431bc1501ba956c0798c7f5075full.jpg',0,1200,1386332036,0,1,'2013-12-02 18:52:34','2013-12-02 18:52:34'

),
(76561198024940145,'Kowiz','http://media.steampowered.com/steamcommunity/public/images/avatars/3a/3a383b6aaf33df9c50773e645cc6d34fa088556a.jpg','http://media.steampowered.com/steamcommunity/public/images/avatars/3a/3a383b6aaf33df9c50773e645cc6d34fa088556afull.jpg',0,1200,1386332036,0,1,'2013-12-02 18:52:34','2013-12-02 18:52:34'

),
(76561198016728127,'Try','http://media.steampowered.com/steamcommunity/public/images/avatars/76/76ed00061f1fb7c20d0cef80dd9a5c3543adfccc.jpg','http://media.steampowered.com/steamcommunity/public/images/avatars/76/76ed00061f1fb7c20d0cef80dd9a5c3543adfcccfull.jpg',0,1200,1386332036,0,1,'2013-12-02 18:52:34','2013-12-02 18:52:34'

),
(76561198045414054,'OeS.DTL','http://media.steampowered.com/steamcommunity/public/images/avatars/75/75b6b47d40ce5a37ead3c33582a504514a79750f.jpg','http://media.steampowered.com/steamcommunity/public/images/avatars/75/75b6b47d40ce5a37ead3c33582a504514a79750ffull.jpg',0,1200,1386332036,0,1,'2013-12-02 18:52:34','2013-12-02 18:52:34'

),
(76561198056155509,'Brungo Stungo','http://media.steampowered.com/steamcommunity/public/images/avatars/0f/0f7ba3a201a4f5ab87f2064a57bd8c4b5d5a1e9c.jpg','http://media.steampowered.com/steamcommunity/public/images/avatars/0f/0f7ba3a201a4f5ab87f2064a57bd8c4b5d5a1e9cfull.jpg',0,1200,1386332036,0,1,'2013-12-02 18:52:34','2013-12-02 18:52:34'

),
(76561198018392672,'hotbagels','http://media.steampowered.com/steamcommunity/public/images/avatars/9b/9b2d7ff3ecee28121fc85d135ee1f4b9b57b6222.jpg','http://media.steampowered.com/steamcommunity/public/images/avatars/9b/9b2d7ff3ecee28121fc85d135ee1f4b9b57b6222full.jpg',0,1200,1386332036,0,1,'2013-12-02 18:52:34','2013-12-02 18:52:34'

),
(76561198006291423,'Freecent','http://media.steampowered.com/steamcommunity/public/images/avatars/bf/bf81d8facfed80261a5f1359ec9940eaa2642bf0.jpg','http://media.steampowered.com/steamcommunity/public/images/avatars/bf/bf81d8facfed80261a5f1359ec9940eaa2642bf0full.jpg',0,1200,1386332036,0,1,'2013-12-02 18:52:34','2013-12-02 18:52:34'

),
(76561198011688646,'wacky','http://media.steampowered.com/steamcommunity/public/images/avatars/a6/a6613ff9ee1ce36459c32d532a013fa278740b72.jpg','http://media.steampowered.com/steamcommunity/public/images/avatars/a6/a6613ff9ee1ce36459c32d532a013fa278740b72full.jpg',0,1200,1386332036,0,1,'2013-12-02 18:52:34','2013-12-02 18:52:34'

),
(76561198047033049,'FeelinFrisky???','http://media.steampowered.com/steamcommunity/public/images/avatars/36/36dd3902cdf64a444972a67c65a7d960272922c7.jpg','http://media.steampowered.com/steamcommunity/public/images/avatars/36/36dd3902cdf64a444972a67c65a7d960272922c7full.jpg',0,1200,1386332036,0,1,'2013-12-02 18:52:34','2013-12-02 18:52:34'

),
(76561198068503054,'Noodle','http://media.steampowered.com/steamcommunity/public/images/avatars/19/19a6d0c6ea9ac31e78c4571c4958361dbbec7fd2.jpg','http://media.steampowered.com/steamcommunity/public/images/avatars/19/19a6d0c6ea9ac31e78c4571c4958361dbbec7fd2full.jpg',0,1200,1386332036,0,1,'2013-12-02 18:52:34','2013-12-02 18:52:34'

),
(76561198047038210,'VietCong','http://media.steampowered.com/steamcommunity/public/images/avatars/bf/bf585ad39b6cb36d734489ba4aa353c8910e4fa8.jpg','http://media.steampowered.com/steamcommunity/public/images/avatars/bf/bf585ad39b6cb36d734489ba4aa353c8910e4fa8full.jpg',0,1200,1386332036,0,1,'2013-12-02 18:52:34','2013-12-02 18:52:34'

),
(76561198014495467,'Woozie','http://media.steampowered.com/steamcommunity/public/images/avatars/96/96afe6bb0840037dd5476562bbc62b7f14d41c33.jpg','http://media.steampowered.com/steamcommunity/public/images/avatars/96/96afe6bb0840037dd5476562bbc62b7f14d41c33_full.jpg',0,1200,1386332036,0,1,'2013-12-02 18:52:34','2013-12-02 18:52:34'

),
(76561197981568128,'dW.Keen','http://media.steampowered.com/steamcommunity/public/images/avatars/a5/a5937ba3f603319edd049e9af798810e0866839c.jpg','http://media.steampowered.com/steamcommunity/public/images/avatars/a5/a5937ba3f603319edd049e9af798810e0866839cfull.jpg',0,1200,1386332036,0,1,'2013-12-02 18:52:34','2013-12-02 18:52:34'

),
(76561198048756827,'Shibe Doge','http://media.steampowered.com/steamcommunity/public/images/avatars/19/199bb847fa4ef032c66ace6aab776e493b70ec92.jpg','http://media.steampowered.com/steamcommunity/public/images/avatars/19/199bb847fa4ef032c66ace6aab776e493b70ec92full.jpg',0,1200,1386332036,0,1,'2013-12-02 18:52:34','2013-12-02 18:52:34'

),
(76561198064963796,'RiechMeinFuss','http://media.steampowered.com/steamcommunity/public/images/avatars/19/19f7f4bc1cd468d503de39614833c6f89776dbbb.jpg','http://media.steampowered.com/steamcommunity/public/images/avatars/19/19f7f4bc1cd468d503de39614833c6f89776dbbbfull.jpg',0,1200,1386332036,0,1,'2013-12-02 18:52:34','2013-12-02 18:52:34'

),
(76561198083017852,'FASFERGERGRS','http://media.steampowered.com/steamcommunity/public/images/avatars/ef/efe431efe8c465816297508780cd7d5428738efa.jpg','http://media.steampowered.com/steamcommunity/public/images/avatars/ef/efe431efe8c465816297508780cd7d5428738efafull.jpg',0,1200,1386332036,0,1,'2013-12-02 18:52:34','2013-12-02 18:52:34'

),
(76561198066813110,'EaglE Ã£Æ’â€ž','http://media.steampowered.com/steamcommunity/public/images/avatars/85/8554141c66c77c49c8ea20d5b8bcd5960aba2d0d.jpg','http://media.steampowered.com/steamcommunity/public/images/avatars/85/8554141c66c77c49c8ea20d5b8bcd5960aba2d0dfull.jpg',0,1200,1386332036,0,1,'2013-12-02 18:52:34','2013-12-02 18:52:34'

),
(76561198051801943,'thaa','http://media.steampowered.com/steamcommunity/public/images/avatars/f6/f6a9b81c3422b5c89da1e18075bf0a0684a2b7f1.jpg','http://media.steampowered.com/steamcommunity/public/images/avatars/f6/f6a9b81c3422b5c89da1e18075bf0a0684a2b7f1full.jpg',0,1200,1386332036,0,1,'2013-12-02 18:52:34','2013-12-02 18:52:34'

),
(76561198044383102,'Krautix','http://media.steampowered.com/steamcommunity/public/images/avatars/4c/4c8730d780b4fe8aaac478f83649918c9087370f.jpg','http://media.steampowered.com/steamcommunity/public/images/avatars/4c/4c8730d780b4fe8aaac478f83649918c9087370ffull.jpg',0,1200,1386332036,0,1,'2013-12-02 18:52:34','2013-12-02 18:52:34'

),
(76561198065060643,'June15th','http://media.steampowered.com/steamcommunity/public/images/avatars/88/886dd9ff2de9925716222c9f30502f9cefde37d7.jpg','http://media.steampowered.com/steamcommunity/public/images/avatars/88/886dd9ff2de9925716222c9f30502f9cefde37d7full.jpg',0,1200,1386332036,0,1,'2013-12-02 18:52:34','2013-12-02 18:52:34'

),
(76561198016670990,'Fusion_2309','http://media.steampowered.com/steamcommunity/public/images/avatars/64/648bebb151632949e770506d2a63363f2866530b.jpg','http://media.steampowered.com/steamcommunity/public/images/avatars/64/648bebb151632949e770506d2a63363f2866530bfull.jpg',0,1200,1386332036,0,1,'2013-12-02 18:52:34','2013-12-02 18:52:34'

),
(76561198049451351,'Captain Abgefahren','http://media.steampowered.com/steamcommunity/public/images/avatars/c2/c2b573ec59ebb8962220850876592fb4e6a045f4.jpg','http://media.steampowered.com/steamcommunity/public/images/avatars/c2/c2b573ec59ebb8962220850876592fb4e6a045f4full.jpg',0,1200,1386332036,0,1,'2013-12-02 18:52:34','2013-12-02 18:52:34'

),
(76561197989128831,'Captain Krokant','http://media.steampowered.com/steamcommunity/public/images/avatars/2b/2b5139710b1f1a3a8d8b22d2d1490fed9d204354.jpg','http://media.steampowered.com/steamcommunity/public/images/avatars/2b/2b5139710b1f1a3a8d8b22d2d1490fed9d204354full.jpg',0,1200,1386332036,0,1,'2013-12-02 18:52:34','2013-12-02 18:52:34'

),
(76561198044714839,'SDCÃ¢â€žÂ¢','http://media.steampowered.com/steamcommunity/public/images/avatars/b9/b9b2b62b8ffd372396d25a3c95e3b84f6cbf1996.jpg','http://media.steampowered.com/steamcommunity/public/images/avatars/b9/b9b2b62b8ffd372396d25a3c95e3b84f6cbf1996full.jpg',0,1200,1386332036,0,1,'2013-12-02 18:52:34','2013-12-02 18:52:34'

),
(76561198056288352,'Foobar','http://media.steampowered.com/steamcommunity/public/images/avatars/27/27d0654dcbead62425772d71cd2e2ac7d1a7e200.jpg','http://media.steampowered.com/steamcommunity/public/images/avatars/27/27d0654dcbead62425772d71cd2e2ac7d1a7e200full.jpg',0,1200,1386332036,0,1,'2013-12-02 18:52:34','2013-12-02 18:52:34'

),
(76561198019146233,'BucaTare','http://media.steampowered.com/steamcommunity/public/images/avatars/42/4281248b834c74ab99d59e0272ddb50275f6b78e.jpg','http://media.steampowered.com/steamcommunity/public/images/avatars/42/4281248b834c74ab99d59e0272ddb50275f6b78efull.jpg',0,1200,1386332036,0,1,'2013-12-02 18:52:34','2013-12-02 18:52:34'

),
(76561197961157577,'Larzzz','http://media.steampowered.com/steamcommunity/public/images/avatars/fe/fef49e7fa7e1997310d705b2a6158ff8dc1cdfeb.jpg','http://media.steampowered.com/steamcommunity/public/images/avatars/fe/fef49e7fa7e1997310d705b2a6158ff8dc1cdfeb_full.jpg',0,1200,1386332036,0,1,'2013-12-02 18:52:34','2013-12-02 18:52:34'

),
(76561198038376558,'Raichu','http://media.steampowered.com/steamcommunity/public/images/avatars/49/493d35c77f1eb60c506f703dc0b9638b0073cd0e.jpg','http://media.steampowered.com/steamcommunity/public/images/avatars/49/493d35c77f1eb60c506f703dc0b9638b0073cd0efull.jpg',0,1200,1386332036,0,1,'2013-12-02 18:52:34','2013-12-02 18:52:34'

),
(76561198003394490,'CaptainBabou','http://media.steampowered.com/steamcommunity/public/images/avatars/18/18c43986ab22dfd88be6417e10a30b1d1c7117a6.jpg','http://media.steampowered.com/steamcommunity/public/images/avatars/18/18c43986ab22dfd88be6417e10a30b1d1c7117a6full.jpg',0,1200,1386332036,0,1,'2013-12-02 18:52:34','2013-12-02 18:52:34'

),
(76561198047291620,'xp710','http://media.steampowered.com/steamcommunity/public/images/avatars/ba/ba111e059fb8cd130542cd132da0225a1e571b00.jpg','http://media.steampowered.com/steamcommunity/public/images/avatars/ba/ba111e059fb8cd130542cd132da0225a1e571b00full.jpg',0,1200,1386332036,0,1,'2013-12-02 18:52:34','2013-12-02 18:52:34'

),
(76561198002256520,'autopilot','http://media.steampowered.com/steamcommunity/public/images/avatars/1e/1efef621d1bcc0e56dadccf6d2b7b360b551bcf9.jpg','http://media.steampowered.com/steamcommunity/public/images/avatars/1e/1efef621d1bcc0e56dadccf6d2b7b360b551bcf9full.jpg',0,1200,1386332036,0,1,'2013-12-02 18:52:34','2013-12-02 18:52:34'

),
(76561197992176678,'FuCKmeImFAmous','http://media.steampowered.com/steamcommunity/public/images/avatars/06/06eb0287e65957382bed09e96fc5cbb00ab209aa.jpg','http://media.steampowered.com/steamcommunity/public/images/avatars/06/06eb0287e65957382bed09e96fc5cbb00ab209aafull.jpg',0,1200,1386332036,0,1,'2013-12-02 18:52:34','2013-12-02 18:52:34'

),
(76561198059730391,'iFlipy','http://media.steampowered.com/steamcommunity/public/images/avatars/16/169c8b6f8afbae56646074336c4d508d8a9a2fa8.jpg','http://media.steampowered.com/steamcommunity/public/images/avatars/16/169c8b6f8afbae56646074336c4d508d8a9a2fa8full.jpg',0,1200,1386332036,0,1,'2013-12-02 18:52:34','2013-12-02 18:52:34'

),
(76561197967710705,'relCORE','http://media.steampowered.com/steamcommunity/public/images/avatars/e5/e5390f3c48a207de7db693dd4ed96566fd0a3090.jpg','http://media.steampowered.com/steamcommunity/public/images/avatars/e5/e5390f3c48a207de7db693dd4ed96566fd0a3090full.jpg',0,1200,1386332036,0,1,'2013-12-02 18:52:34','2013-12-02 18:52:34'

),
(76561197985076961,'PeteyP','http://media.steampowered.com/steamcommunity/public/images/avatars/ba/ba94340fb7da697eedc4e135dbe5ce3b8db74b52.jpg','http://media.steampowered.com/steamcommunity/public/images/avatars/ba/ba94340fb7da697eedc4e135dbe5ce3b8db74b52full.jpg',0,1200,1386332036,0,1,'2013-12-02 18:52:34','2013-12-02 18:52:34'

),
(76561198044326933,'Rust in Peace','http://media.steampowered.com/steamcommunity/public/images/avatars/11/11358085925a3c11eb5b47f181f198742b96bc0f.jpg','http://media.steampowered.com/steamcommunity/public/images/avatars/11/11358085925a3c11eb5b47f181f198742b96bc0ffull.jpg',0,1200,1386332036,0,1,'2013-12-02 18:52:34','2013-12-02 18:52:34'

),
(76561197962286805,'Neverever','http://media.steampowered.com/steamcommunity/public/images/avatars/c3/c385acb0be7105a84b8a922346201d784d49555c.jpg','http://media.steampowered.com/steamcommunity/public/images/avatars/c3/c385acb0be7105a84b8a922346201d784d49555cfull.jpg',0,1200,1386332036,0,1,'2013-12-02 18:52:34','2013-12-02 18:52:34'

),
(76561197970827726,'HeinrichPimmler','http://media.steampowered.com/steamcommunity/public/images/avatars/24/24380cb0792d31b0be07994861103a14929a0019.jpg','http://media.steampowered.com/steamcommunity/public/images/avatars/24/24380cb0792d31b0be07994861103a14929a0019full.jpg',0,1200,1386332036,0,1,'2013-12-02 18:52:34','2013-12-02 18:52:34'

),
(76561197992316731,'TGW','http://media.steampowered.com/steamcommunity/public/images/avatars/aa/aa72467a6e002b6b9cd0f956b1d7cd6697d4481d.jpg','http://media.steampowered.com/steamcommunity/public/images/avatars/aa/aa72467a6e002b6b9cd0f956b1d7cd6697d4481dfull.jpg',0,1200,1386332036,0,1,'2013-12-02 18:52:34','2013-12-02 18:52:34'

),
(76561198068967615,'Scandalouz','http://media.steampowered.com/steamcommunity/public/images/avatars/c7/c75c45c625e18a725cd6d3e9574ced30abb71dc0.jpg','http://media.steampowered.com/steamcommunity/public/images/avatars/c7/c75c45c625e18a725cd6d3e9574ced30abb71dc0full.jpg',0,1200,1386332036,0,1,'2013-12-02 18:52:34','2013-12-02 18:52:34'

),
(76561198028451348,'Mickey Mouse','http://media.steampowered.com/steamcommunity/public/images/avatars/fb/fbb667a2f2f54b3151cce5769863946e9c96d2e7.jpg','http://media.steampowered.com/steamcommunity/public/images/avatars/fb/fbb667a2f2f54b3151cce5769863946e9c96d2e7full.jpg',0,1200,1386332036,0,1,'2013-12-02 18:52:34','2013-12-02 18:52:34'

),
(76561198078721452,'Herbalist','http://media.steampowered.com/steamcommunity/public/images/avatars/c6/c658b309dc2e979728fac566516a372039af485f.jpg','http://media.steampowered.com/steamcommunity/public/images/avatars/c6/c658b309dc2e979728fac566516a372039af485ffull.jpg',0,1200,1386332036,0,1,'2013-12-02 18:52:34','2013-12-02 18:52:34'

),
(76561198013674870,'Dr Lodrok','http://media.steampowered.com/steamcommunity/public/images/avatars/04/04513d5922b2ff2ef3c5d4e800fd57b5cb05453a.jpg','http://media.steampowered.com/steamcommunity/public/images/avatars/04/04513d5922b2ff2ef3c5d4e800fd57b5cb05453afull.jpg',0,1200,1386332036,0,1,'2013-12-02 18:52:34','2013-12-02 18:52:34'

),
(76561198062156654,'Fuzzeh','http://media.steampowered.com/steamcommunity/public/images/avatars/7b/7b80627844242aebbf4e6cb4cd71afee270eb060.jpg','http://media.steampowered.com/steamcommunity/public/images/avatars/7b/7b80627844242aebbf4e6cb4cd71afee270eb060full.jpg',0,1200,1386332036,0,1,'2013-12-02 18:52:34','2013-12-02 18:52:34'

),
(76561198057194544,'Moose','http://media.steampowered.com/steamcommunity/public/images/avatars/0a/0a2ff4e9f1ac014112c5c76ec78e44b5cb0414ba.jpg','http://media.steampowered.com/steamcommunity/public/images/avatars/0a/0a2ff4e9f1ac014112c5c76ec78e44b5cb0414bafull.jpg',0,1200,1386332036,0,1,'2013-12-02 18:52:34','2013-12-02 18:52:34'

),
(76561198031418913,'Kidades','http://media.steampowered.com/steamcommunity/public/images/avatars/8e/8e308ea0cebaf9511dbbd4d72bba180ec89ae3a5.jpg','http://media.steampowered.com/steamcommunity/public/images/avatars/8e/8e308ea0cebaf9511dbbd4d72bba180ec89ae3a5full.jpg',0,1200,1386332036,0,1,'2013-12-02 18:52:34','2013-12-02 18:52:34'

),
(76561197967237628,'ggg951','http://media.steampowered.com/steamcommunity/public/images/avatars/2f/2f493762d483cbc95187701b881f941572dc469a.jpg','http://media.steampowered.com/steamcommunity/public/images/avatars/2f/2f493762d483cbc95187701b881f941572dc469afull.jpg',0,1200,1386332036,0,1,'2013-12-02 18:52:34','2013-12-02 18:52:34'

),
(76561198058698916,'ThePowa','http://media.steampowered.com/steamcommunity/public/images/avatars/50/505032a9cbfdc1baa7c2c84cd88787db5ff0a299.jpg','http://media.steampowered.com/steamcommunity/public/images/avatars/50/505032a9cbfdc1baa7c2c84cd88787db5ff0a299full.jpg',0,1200,1386332036,0,1,'2013-12-02 18:52:34','2013-12-02 18:52:34'

),
(76561198047029012,'Fedaykin','http://media.steampowered.com/steamcommunity/public/images/avatars/6e/6e7ea64961e96afc97cc58edec13f3e1edb05459.jpg','http://media.steampowered.com/steamcommunity/public/images/avatars/6e/6e7ea64961e96afc97cc58edec13f3e1edb05459full.jpg',0,1200,1386332036,0,1,'2013-12-02 18:52:34','2013-12-02 18:52:34'

),
(76561197979393879,'Johnny J0int','http://media.steampowered.com/steamcommunity/public/images/avatars/da/da77685893d3ae5eaf890ecf45df0fe05a3907ed.jpg','http://media.steampowered.com/steamcommunity/public/images/avatars/da/da77685893d3ae5eaf890ecf45df0fe05a3907edfull.jpg',0,1200,1386332036,0,1,'2013-12-02 18:52:34','2013-12-02 18:52:34'

),
(76561197989131573,'[MF] Linse','http://media.steampowered.com/steamcommunity/public/images/avatars/6e/6e2329fccb75936c1c3cbdbd5d37a43986a1f4cf.jpg','http://media.steampowered.com/steamcommunity/public/images/avatars/6e/6e2329fccb75936c1c3cbdbd5d37a43986a1f4cffull.jpg',0,1200,1386332036,0,1,'2013-12-02 18:52:34','2013-12-02 18:52:34'

),
(76561197993520491,'Shin0-dA-Solomill0','http://media.steampowered.com/steamcommunity/public/images/avatars/40/40a47ee37a51f5baa80a72e26e6be5b64ef49276.jpg','http://media.steampowered.com/steamcommunity/public/images/avatars/40/40a47ee37a51f5baa80a72e26e6be5b64ef49276full.jpg',0,1200,1386332036,0,1,'2013-12-02 18:52:34','2013-12-02 18:52:34'

),
(76561198052975593,'Spook','http://media.steampowered.com/steamcommunity/public/images/avatars/68/682b93e9bcd7b8fec8dfe3cffe1aa5389c731244.jpg','http://media.steampowered.com/steamcommunity/public/images/avatars/68/682b93e9bcd7b8fec8dfe3cffe1aa5389c731244_full.jpg',0,1200,1386332036,0,1,'2013-12-02 18:52:34','2013-12-02 18:52:34'

),
(76561198047895226,'Pallys.Muted4Life','http://media.steampowered.com/steamcommunity/public/images/avatars/9d/9d7a0ccaa358001a56295ee62619c885170597c4.jpg','http://media.steampowered.com/steamcommunity/public/images/avatars/9d/9d7a0ccaa358001a56295ee62619c885170597c4full.jpg',0,1200,1386332036,0,1,'2013-12-02 18:52:34','2013-12-02 18:52:34'

),
(76561198027087061,'Bloodydead','http://media.steampowered.com/steamcommunity/public/images/avatars/21/218f4901175decc60c7e67b7001115f7d22f5902.jpg','http://media.steampowered.com/steamcommunity/public/images/avatars/21/218f4901175decc60c7e67b7001115f7d22f5902full.jpg',0,1200,1386332036,0,1,'2013-12-02 18:52:34','2013-12-02 18:52:34'

),
(76561198038928571,'TeroX','http://media.steampowered.com/steamcommunity/public/images/avatars/05/05b2d0c4c4c8641a0d35ace0dc44b8a58cc18284.jpg','http://media.steampowered.com/steamcommunity/public/images/avatars/05/05b2d0c4c4c8641a0d35ace0dc44b8a58cc18284full.jpg',0,1200,1386332036,0,1,'2013-12-02 18:52:34','2013-12-02 18:52:34'

),
(76561198002116938,'RaunoÃƒâ€šÃ‚Â®','http://media.steampowered.com/steamcommunity/public/images/avatars/9c/9cc4ab72cffe625a5d13de9645a30719970f8544.jpg','http://media.steampowered.com/steamcommunity/public/images/avatars/9c/9cc4ab72cffe625a5d13de9645a30719970f8544full.jpg',0,1200,1386332036,0,1,'2013-12-02 18:52:34','2013-12-02 18:52:34'

),
(76561197988126535,'shiro_himura','http://media.steampowered.com/steamcommunity/public/images/avatars/e0/e089b7b5d6c17ef332e4c22a76a75b608e6eca04.jpg','http://media.steampowered.com/steamcommunity/public/images/avatars/e0/e089b7b5d6c17ef332e4c22a76a75b608e6eca04full.jpg',0,1200,1386332036,0,1,'2013-12-02 18:52:34','2013-12-02 18:52:34'

),
(76561198028627989,'ezy','http://media.steampowered.com/steamcommunity/public/images/avatars/e9/e95fdeb7c9ae630c089e1d3399b01feaa947dc27.jpg','http://media.steampowered.com/steamcommunity/public/images/avatars/e9/e95fdeb7c9ae630c089e1d3399b01feaa947dc27full.jpg',0,1200,1386332036,0,1,'2013-12-02 18:52:34','2013-12-02 18:52:34'

),
(76561197981110875,'Qawaii Flamboyant Bubbles','http://media.steampowered.com/steamcommunity/public/images/avatars/a6/a6d6eb7793de0df942a0c93064f382d45b56193e.jpg','http://media.steampowered.com/steamcommunity/public/images/avatars/a6/a6d6eb7793de0df942a0c93064f382d45b56193efull.jpg',0,1200,1386332036,0,1,'2013-12-02 18:52:34','2013-12-02 18:52:34'

),
(76561198036262558,'What a playa','http://media.steampowered.com/steamcommunity/public/images/avatars/ee/ee3eff7a5cd31f99cc321bf580a249e7eaec8599.jpg','http://media.steampowered.com/steamcommunity/public/images/avatars/ee/ee3eff7a5cd31f99cc321bf580a249e7eaec8599full.jpg',0,1200,1386332036,0,1,'2013-12-02 18:52:34','2013-12-02 18:52:34'

),
(76561198045570229,'Almahid','http://media.steampowered.com/steamcommunity/public/images/avatars/65/65adf3dea37da1865ce7e59d76ead7aa5b1abc10.jpg','http://media.steampowered.com/steamcommunity/public/images/avatars/65/65adf3dea37da1865ce7e59d76ead7aa5b1abc10full.jpg',0,1200,1386332036,0,1,'2013-12-02 18:52:34','2013-12-02 18:52:34'

),
(76561198052294119,'TehFlash','http://media.steampowered.com/steamcommunity/public/images/avatars/02/02149ead5b0bd0fb43140ddb513a7f4befa3ea02.jpg','http://media.steampowered.com/steamcommunity/public/images/avatars/02/02149ead5b0bd0fb43140ddb513a7f4befa3ea02full.jpg',0,1200,1386332036,0,1,'2013-12-02 18:52:34','2013-12-02 18:52:34'

),
(76561198016368809,'Rabbey','http://media.steampowered.com/steamcommunity/public/images/avatars/c6/c643255a37bfbf8a0b01044eeb57836b15d7404d.jpg','http://media.steampowered.com/steamcommunity/public/images/avatars/c6/c643255a37bfbf8a0b01044eeb57836b15d7404d_full.jpg',0,1200,1386332036,0,1,'2013-12-02 18:52:34','2013-12-02 18:52:34'

),
(76561198034179992,'zelar','http://media.steampowered.com/steamcommunity/public/images/avatars/5f/5f9c62132e21a4171ac57ba21957a54d1faa2650.jpg','http://media.steampowered.com/steamcommunity/public/images/avatars/5f/5f9c62132e21a4171ac57ba21957a54d1faa2650full.jpg',0,1200,1386332036,0,1,'2013-12-02 18:52:34','2013-12-02 18:52:34'

),
(76561198045861360,'YellowPony','http://media.steampowered.com/steamcommunity/public/images/avatars/01/01b7da797102fcd5bad2b8c14020846526c7eb17.jpg','http://media.steampowered.com/steamcommunity/public/images/avatars/01/01b7da797102fcd5bad2b8c14020846526c7eb17full.jpg',0,1200,1386332036,0,1,'2013-12-02 18:52:34','2013-12-02 18:52:34'

),
(76561198077199729,'Xatsuna','http://media.steampowered.com/steamcommunity/public/images/avatars/cd/cdfffd4f40d4b764037d498cb9fc785c05328b12.jpg','http://media.steampowered.com/steamcommunity/public/images/avatars/cd/cdfffd4f40d4b764037d498cb9fc785c05328b12full.jpg',0,1200,1386332036,0,1,'2013-12-02 18:52:34','2013-12-02 18:52:34'

),
(76561198014332186,'Xiao-Lan','http://media.steampowered.com/steamcommunity/public/images/avatars/7d/7da02fc05dcf10fd04fe9f663084c8bab0e3a63f.jpg','http://media.steampowered.com/steamcommunity/public/images/avatars/7d/7da02fc05dcf10fd04fe9f663084c8bab0e3a63ffull.jpg',0,1200,1386332036,0,1,'2013-12-02 18:52:34','2013-12-02 18:52:34'

),
(76561198051663357,'KGT freddie','http://media.steampowered.com/steamcommunity/public/images/avatars/75/75bb44c03dc72a9d6dd3ae1c1bb7db0b5fcce678.jpg','http://media.steampowered.com/steamcommunity/public/images/avatars/75/75bb44c03dc72a9d6dd3ae1c1bb7db0b5fcce678full.jpg',0,1200,1386332036,0,1,'2013-12-02 18:52:34','2013-12-02 18:52:34'

),
(76561198047383225,'Nerkkrit','http://media.steampowered.com/steamcommunity/public/images/avatars/a0/a0b9e2b5aaa12ef2f7c055d9a574a4dcd3daa20b.jpg','http://media.steampowered.com/steamcommunity/public/images/avatars/a0/a0b9e2b5aaa12ef2f7c055d9a574a4dcd3daa20b_full.jpg',0,1200,1386332036,0,1,'2013-12-02 18:52:34','2013-12-02 18:52:34'

),
(76561198052805969,'Bob Loblaw','http://media.steampowered.com/steamcommunity/public/images/avatars/8c/8cda4ef1b9b5e34aa348032162c967d7889d8562.jpg','http://media.steampowered.com/steamcommunity/public/images/avatars/8c/8cda4ef1b9b5e34aa348032162c967d7889d8562full.jpg',0,1200,1386332036,0,1,'2013-12-02 18:52:34','2013-12-02 18:52:34'

),
(76561198025829119,'Tiny Nipples McGee','http://media.steampowered.com/steamcommunity/public/images/avatars/f5/f584cb7b02f9fde8e932254f6acf7c9dba4e039b.jpg','http://media.steampowered.com/steamcommunity/public/images/avatars/f5/f584cb7b02f9fde8e932254f6acf7c9dba4e039bfull.jpg',0,1200,1386332036,0,1,'2013-12-02 18:52:34','2013-12-02 18:52:34'

)");
		// Uncomment the below to run the seeder
		// DB::table('users')->insert($users);
	}

}
